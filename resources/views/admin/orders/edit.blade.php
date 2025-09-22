@extends('admin.layout')

@section('title', 'Editar Orden')
@section('subtitle', 'Modificar estado de la orden')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold">Editar Orden #{{ $order->id }}</h3>
        </div>

        <div class="px-6 py-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Formulario de Edición -->
                <div>
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="bg-gray-50 p-6 rounded-lg mb-6">
                            <h4 class="text-lg font-semibold mb-4">Actualizar Estado</h4>

                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Estado de la
                                    Orden *</label>
                                <select id="status" name="status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <option value="pending"
                                        {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pendiente
                                    </option>
                                    <option value="paid" {{ old('status', $order->status) == 'paid' ? 'selected' : '' }}>
                                        Pagado</option>
                                    <option value="cancelled"
                                        {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelado
                                    </option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition-colors duration-200">
                                Actualizar Estado
                            </button>
                        </div>
                    </form>

                    <!-- Gestión de Pago -->
                    @if ($order->payment)
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold mb-4">Gestión de Pago</h4>

                            <form action="{{ route('admin.orders.updatePaymentStatus', $order) }}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">Estado
                                        del Pago *</label>
                                    <select id="payment_status" name="payment_status" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                                        <option value="pending"
                                            {{ old('payment_status', $order->payment->status) == 'pending' ? 'selected' : '' }}>
                                            Pendiente</option>
                                        <option value="confirmed"
                                            {{ old('payment_status', $order->payment->status) == 'confirmed' ? 'selected' : '' }}>
                                            Aprobado</option>
                                        <option value="rejected"
                                            {{ old('payment_status', $order->payment->status) == 'rejected' ? 'selected' : '' }}>
                                            Rechazado</option>
                                    </select>
                                    @error('payment_status')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="w-full bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200">
                                    Actualizar Estado de Pago
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Resumen de la Orden -->
                <div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold mb-4">Resumen de la Orden</h4>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Orden ID:</span>
                                <span class="font-semibold">#{{ $order->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Fecha:</span>
                                <span class="font-semibold">{{ $order->order_date->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Cliente:</span>
                                <span class="font-semibold">{{ $order->user->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Estado Actual:</span>
                                <span class="font-semibold">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full
                                    {{ $order->status === 'paid'
                                        ? 'bg-green-100 text-green-800'
                                        : ($order->status === 'pending'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total:</span>
                                <span class="font-semibold text-green-600">
                                    S/ {{ number_format($order->orderDetails->sum('subtotal'), 2) }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h5 class="text-sm font-medium text-gray-600 mb-2">Productos:</h5>
                            <div class="space-y-2">
                                @foreach ($order->orderDetails as $detail)
                                    <div class="flex justify-between text-sm">
                                        <span>{{ $detail->book->title }} (x{{ $detail->quantity }})</span>
                                        <span>S/ {{ number_format($detail->subtotal, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
