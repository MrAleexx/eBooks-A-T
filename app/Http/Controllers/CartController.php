<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Mail\PedidoConfirmado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    private const CART_EMPTY_MESSAGE = 'Tu carrito está vacío';
    
    public function index()
    {
        return view('cart.index');
    }

    public function add(Request $request, Book $book)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:5'
        ]);

        $cart = Session::get('cart', []);

        if (isset($cart[$book->id])) {
            $cart[$book->id]['quantity'] += $request->quantity;
        } else {
            $cart[$book->id] = [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'price' => $book->price,
                'image' => $book->image,
                'quantity' => $request->quantity
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Libro añadido al carrito');
    }

    
    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', self::CART_EMPTY_MESSAGE);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:yape,plin,bank_transfer,email',
            'voucher' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', self::CART_EMPTY_MESSAGE);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_date' => now(),
            'status' => 'pending'
        ]);

        $total = 0;

        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;

            OrderDetail::create([
                'order_id' => $order->id,
                'book_id' => $item['id'],
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal
            ]);
        }

        $voucherPath = $request->file('voucher')->store('vouchers', 'public');

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'amount' => $total,
            'payment_date' => now(),
            'voucher_image' => $voucherPath,
            'status' => 'pending'
        ]);

        Session::forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', '¡Pedido realizado con éxito! Espera la confirmación de tu pago.');
    }

    public function yape()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', self::CART_EMPTY_MESSAGE);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.yape', compact('cart', 'total'));
    }

    public function plin()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', self::CART_EMPTY_MESSAGE);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.plin', compact('cart', 'total'));
    }

    public function bank()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', self::CART_EMPTY_MESSAGE);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.bank', compact('cart', 'total'));
    }

    public function correo()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', self::CART_EMPTY_MESSAGE);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.correo', compact('cart', 'total'));
    }


    public function enviarCorreo(Request $request)
    {
        $request->validate([
            'voucher' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', self::CART_EMPTY_MESSAGE);
        }

        $user = Auth::user();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        try {

            // Crear orden
            $order = Order::create([
                'user_id' => $user->id,
                'order_date' => now(),
                'status' => 'pending'
            ]);

            // Guardar detalles
            foreach ($cart as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'book_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            // Guardar comprobante
            $voucherPath = $request->file('voucher')->store('vouchers', 'public');

            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'email',
                'amount' => $total,
                'payment_date' => now(),
                'voucher_image' => $voucherPath,
                'status' => 'pending'
            ]);

            // Enviar email
            Mail::to($user->email)  // Enviar al cliente que compró
                ->send(new PedidoConfirmado($cart, $user, $voucherPath));

            // Limpiar carrito
            Session::forget('cart');

            return redirect()->route('bookmart')
                ->with('success', '¡Pedido realizado con éxito! Se envió el comprobante por correo.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al procesar el pedido. Por favor, intenta nuevamente.');
        }
    }
}
