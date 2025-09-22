<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderDetails.book')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderDetails.book', 'payment');

        return view('orders.show', compact('order'));
    }

    public function repeat(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $cart = Session::get('cart', []);

        foreach ($order->orderDetails as $detail) {
            if (isset($cart[$detail->book_id])) {
                $cart[$detail->book_id]['quantity'] += $detail->quantity;
            } else {
                $cart[$detail->book_id] = [
                    'id' => $detail->book_id,
                    'title' => $detail->book->title,
                    'author' => $detail->book->author,
                    'price' => $detail->book->price,
                    'image' => $detail->book->image,
                    'quantity' => $detail->quantity
                ];
            }
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Productos añadidos al carrito');
    }
}
