<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function createOrder(array $cart, string $paymentMethod, string $voucherPath): Order
    {

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_date' => now(),
            'status' => 'pending'
        ]);

        $this->createOrderDetails($order, $cart);
        $this->createPayment($order, $this->calculateTotal($cart), $paymentMethod, $voucherPath);

        return $order;
    }

    private function createOrderDetails(Order $order, array $cart): void
    {
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'book_id' => $item['id'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }
    }

    private function createPayment(Order $order, float $total, string $paymentMethod, string $voucherPath): void
    {

        \Log::info('Creating payment', [
            'order_id' => $order->id,
            'voucher_path' => $voucherPath,
            'full_path' => storage_path('app/public/' . $voucherPath)
        ]);

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $paymentMethod,
            'amount' => $total,
            'payment_date' => now(),
            'voucher_image' => $voucherPath,
            'status' => 'pending'
        ]);
    }

    public function calculateTotal(array $cart): float
    {
        return array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }
}
