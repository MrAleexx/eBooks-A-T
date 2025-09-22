<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load(['user', 'orderDetails.book', 'payment']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $this->authorize('update', $order);
        $order->load(['user', 'orderDetails.book', 'payment']);
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'paid'];
        return view('admin.orders.edit', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        $this->authorize('update', $order);
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,paid'
        ]);
        $order->update($validated);
        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Estado de la orden actualizado exitosamente.');
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);
        $order->orderDetails()->delete();
        $order->payment()->delete();
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Orden eliminada exitosamente.');
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $this->authorize('updateStatus', $order);
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,confirmed,rejected'
        ]);

        if ($order->payment) {
            $order->payment->update(['status' => $validated['payment_status']]);
            if ($validated['payment_status'] === 'confirmed') {
                $order->update(['status' => 'paid']);
            } elseif ($validated['payment_status'] === 'rejected') {
                $order->update(['status' => 'cancelled']);
            }
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Estado de pago actualizado exitosamente.');
    }
}
