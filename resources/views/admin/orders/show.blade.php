@extends('admin.layout')

@section('title', 'Detalles de la Orden')
@section('subtitle', 'Información completa de la orden')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold">Orden #{{ $order->id }}</h3>
            <div class="flex space-x-2">
                <a href="{{ route('admin.orders.edit', $order) }}"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200">
                    ✏️ Editar
                </a>
                <a href="{{ route('admin.orders.index') }}"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                    ← Volver
                </a>
            </div>
        </div>

        <div class="px-6 py-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Información de la Orden -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h4 class="text-lg font-semibold mb-4">Detalles de la Orden</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <h5 class="text-sm font-medium text-gray-500">Fecha de la Orden</h5>
                                <p class="text-lg font-semibold">{{ $order->order_date->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <h5 class="text-sm font-medium text-gray-500">Estado</h5>
                                <p class="text-lg font-semibold">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full
                                    {{ $order->status === 'paid'
                                        ? 'bg-green-100 text-green-800'
                                        : ($order->status === 'pending'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <h5 class="text-sm font-medium text-gray-500">Total</h5>
                                <p class="text-lg font-semibold text-green-600">
                                    S/ {{ number_format($order->orderDetails->sum('subtotal'), 2) }}
                                </p>
                            </div>
                            <div>
                                <h5 class="text-sm font-medium text-gray-500">Items</h5>
                                <p class="text-lg font-semibold">{{ $order->orderDetails->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Items de la Orden -->
                    <div class="bg-white border border-gray-200 rounded-lg mb-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h4 class="text-lg font-semibold">Productos</h4>
                        </div>

                        <div class="p-6">
                            @foreach ($order->orderDetails as $detail)
                                <div
                                    class="flex items-center justify-between py-4 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                                    <div class="flex items-center">
                                        @if ($detail->book->image)
                                            <x-book-image :image="$detail->book->image" :title="$detail->book->title"
                                                class="w-16 h-20 object-cover rounded mr-4"/>
                                            @else
                                                <div
                                                    class="w-16 h-20 bg-gray-200 rounded flex items-center justify-center mr-4">
                                                    📖
                                                </div>
                                        @endif
                                        <div>
                                            <h5 class="font-semibold">{{ $detail->book->title }}</h5>
                                            <p class="text-sm text-gray-600">{{ $detail->book->author }}</p>
                                            <p class="text-sm text-gray-600">Cantidad: {{ $detail->quantity }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold">S/ {{ number_format($detail->subtotal, 2) }}</p>
                                        <p class="text-sm text-gray-600">S/
                                            {{ number_format($detail->subtotal / $detail->quantity, 2) }} c/u</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Información del Cliente y Pago -->
                <div class="lg:col-span-1">
                    <!-- Información del Cliente -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h4 class="text-lg font-semibold mb-4">Información del Cliente</h4>

                        <div class="flex items-center mb-4">
                            <div
                                class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                {{ strtoupper(substr($order->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="font-semibold">{{ $order->user->name }} {{ $order->user->last_name }}</h5>
                                <p class="text-sm text-gray-600">{{ $order->user->email }}</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">DNI:</span>
                                <span class="font-semibold">{{ $order->user->dni }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Teléfono:</span>
                                <span class="font-semibold">{{ $order->user->phone }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total de Órdenes:</span>
                                <span class="font-semibold">{{ $order->user->orders->count() }}</span>
                            </div>
                        </div>

                        <a href="{{ route('admin.users.show', $order->user) }}"
                            class="mt-4 w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200 block text-center">
                            Ver Perfil del Cliente
                        </a>
                    </div>

                    <!-- Información de Pago -->
                    @if ($order->payment)
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold mb-4">Información de Pago</h4>

                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Método:</span>
                                    <span class="font-semibold">{{ ucfirst($order->payment->payment_method) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Monto:</span>
                                    <span class="font-semibold">S/ {{ number_format($order->payment->amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Fecha:</span>
                                    <span
                                        class="font-semibold">{{ $order->payment->payment_date->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Estado:</span>
                                    <span class="font-semibold">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full
                                    {{ $order->payment->status === 'confirmed'
                                        ? 'bg-green-100 text-green-800'
                                        : ($order->payment->status === 'pending'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($order->payment->status) }}
                                        </span>
                                    </span>
                                </div>
                            </div>

                            @if ($order->payment->voucher_image)
                                <div class="mt-4">
                                    <h5 class="text-sm font-medium text-gray-600 mb-2">Comprobante:</h5>
                                    <img src="{{ asset('storage/' . $order->payment->voucher_image) }}"
                                        alt="Comprobante de pago" class="w-full h-32 object-contain border rounded">
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
