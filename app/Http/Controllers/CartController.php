<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Services\CartService;
use App\Services\OrderService;
use App\Mail\PedidoConfirmado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function __construct(
        private CartService $cartService,
        private OrderService $orderService
    ) {}

    public function index()
    {
        return view('cart.index', [
            'cart' => $this->cartService->getCart(),
            'total' => $this->cartService->getTotal()
        ]);
    }

    /**
     * Agregar libro al carrito
     */
    public function add(Request $request, $book)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:5'
        ]);

        $bookModel = \App\Models\Book::findOrFail($book);

        $this->cartService->addItem([
            'id' => $bookModel->id,
            'title' => $bookModel->title,
            'author' => $bookModel->author,
            'price' => $bookModel->price,
            'image' => $bookModel->image,
        ], $request->quantity);

        return redirect()->back()->with('success', 'Libro añadido al carrito');
    }

    /**
     * Actualizar cantidad (para Livewire)
     */
    public function update(Request $request, $id)
    {
        // Este método probablemente lo maneje Livewire
        return redirect()->back();
    }

    /**
     * Eliminar item del carrito
     */
    public function remove($id)
    {
        if ($itemTitle = $this->cartService->removeItem($id)) {
            return redirect()->back()->with('success', "{$itemTitle} eliminado del carrito");
        }

        return redirect()->back()->with('error', 'Item no encontrado en el carrito');
    }

    public function checkout()
    {
        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        return view('cart.checkout', [
            'cart' => $this->cartService->getCart(),
            'total' => $this->cartService->getTotal()
        ]);
    }

    public function processCheckout(CheckoutRequest $request)
    {
        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        $cart = $this->cartService->getCart();
        $voucherPath = $request->file('voucher')->store('vouchers', 'public');

        $order = $this->orderService->createOrder(
            $cart,
            $request->payment_method,
            $voucherPath
        );

        $this->cartService->clearCart();

        return redirect()->route('orders.show', $order->id)
            ->with('success', '¡Pedido realizado con éxito! Espera la confirmación de tu pago.');
    }

    public function enviarCorreo(CheckoutRequest $request)
    {
        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        try {
            \Log::info('=== INICIANDO ENVIAR CORREO ===');

            $cart = $this->cartService->getCart();
            \Log::info('Carrito obtenido:', ['items_count' => count($cart)]);

            $voucherPath = $request->file('voucher')->store('vouchers', 'public');
            \Log::info('Voucher guardado:', ['path' => $voucherPath]);

            // Crear la orden
            $order = $this->orderService->createOrder($cart, 'email', $voucherPath);

            \Log::info('Orden creada:', [
                'order_id' => $order->id ?? 'NO_ID',
                'order_class' => get_class($order),
                'order_data' => $order->toArray()
            ]);

            if (!$order || !$order->id) {
                \Log::error('ERROR: La orden no tiene ID');
                return redirect()->route('cart.index')
                    ->with('error', 'Error al crear la orden. Por favor, contacta al soporte.');
            }

            // Calcular total para el email
            $total = $this->cartService->getTotal();

            // Intentar enviar email (pero no fallar si hay error)
            try {
                \Log::info('Enviando email...');
                Mail::to(auth()->user()->email)
                    ->send(new PedidoConfirmado($cart, auth()->user(), $voucherPath, $total));
                \Log::info('Email enviado exitosamente');
            } catch (\Exception $emailException) {
                \Log::error('Error al enviar email, pero continuando con el proceso: ' . $emailException->getMessage());
                // No re-lanzamos la excepción, continuamos con el proceso
            }

            $this->cartService->clearCart();
            \Log::info('Carrito limpiado, redirigiendo a orders.show');

            return redirect()->route('orders.show', $order->id)
                ->with('success', '¡Pedido realizado con éxito! ' .
                    (isset($emailException) ? 'El pedido se creó pero hubo un error al enviar el correo.' : 'Revisa tu correo para la confirmación.'));
        } catch (\Exception $e) {
            \Log::error('ERROR en enviarCorreo: ' . $e->getMessage());
            \Log::error('TRACE: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    // Métodos de visualización
    public function yape()
    {
        return $this->showPaymentView('yape');
    }

    public function plin()
    {
        return $this->showPaymentView('plin');
    }

    public function bank()
    {
        return $this->showPaymentView('bank');
    }

    public function correo()
    {
        return $this->showPaymentView('correo');
    }

    private function showPaymentView(string $method)
    {
        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        return view("cart.{$method}", [
            'cart' => $this->cartService->getCart(),
            'total' => $this->cartService->getTotal()
        ]);
    }
}
