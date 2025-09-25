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
            $cart = $this->cartService->getCart();
            $voucherPath = $request->file('voucher')->store('vouchers', 'public');

            $order = $this->orderService->createOrder($cart, 'email', $voucherPath);

            // Enviar email
            Mail::to(auth()->user()->email)
                ->send(new PedidoConfirmado($cart, auth()->user(), $voucherPath));

            $this->cartService->clearCart();

            return redirect()->route('bookmart')
                ->with('success', '¡Pedido realizado con éxito! Se envió el comprobante por correo.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al procesar el pedido. Por favor, intenta nuevamente.');
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
