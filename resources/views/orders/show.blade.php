        @extends('layouts.app')

        @section('titulo', 'Detalle del Pedido #' . $order->id)

        @section('contenido')
            <section class="my-10 container mx-auto px-3">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-[#04050E] mb-2">Detalle del Pedido #{{ $order->id }}</h2>
                    <p class="text-[#272b30]/60">Revisa los detalles y estado de tu pedido</p>
                </div>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Información del pedido -->
                    <div class="lg:w-1/2">
                        <div class="bg-white rounded-2xl shadow-lg border border-[#272b30]/10 p-6">
                            <h3 class="text-xl font-bold text-[#04050E] mb-6 pb-4 border-b border-[#272b30]/10">Información
                                del
                                Pedido</h3>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-[#272b30]/80 font-medium">Fecha:</span>
                                    <span class="text-[#04050E]">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-[#272b30]/80 font-medium">Estado:</span>
                                    <span
                                        class="px-3 py-1 rounded-full text-sm font-medium
                                        @if ($order->status == 'paid') bg-green-100 text-green-800
                                        @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        @if ($order->status == 'paid')
                                            Pagado
                                        @elseif($order->status == 'pending')
                                            Pendiente
                                        @else
                                            Cancelado
                                        @endif
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-[#272b30]/80 font-medium">Método de pago:</span>
                                    <span
                                        class="text-[#04050E] capitalize">{{ $order->payment->payment_method ?? 'N/A' }}</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-[#272b30]/80 font-medium">Estado de pago:</span>
                                    <span
                                        class="px-3 py-1 rounded-full text-sm font-medium
                                        @if ($order->payment->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($order->payment->status == 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        @if ($order->payment->status == 'confirmed')
                                            Confirmado
                                        @elseif($order->payment->status == 'pending')
                                            Pendiente
                                        @elseif($order->payment->status == 'rejected')
                                            Rechazado
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Productos del pedido -->
                    <div class="lg:w-1/2">
                        <div class="bg-white rounded-2xl shadow-lg border border-[#272b30]/10 p-6">
                            <h3 class="text-xl font-bold text-[#04050E] mb-6 pb-4 border-b border-[#272b30]/10">Productos
                            </h3>

                            <div class="space-y-4">
                                @foreach ($order->orderDetails as $detail)
                                    <div class="flex items-center gap-4 p-4 border border-[#272b30]/10 rounded-lg">
                                        <x-book-image :image="$detail->book->image" :title="$detail->book->title"
                                            class="w-16 h-20 object-cover rounded-md" />
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-[#04050E] text-sm line-clamp-2">
                                                {{ $detail->book->title }}
                                            </h4>
                                            <p class="text-[#272b30]/60 text-xs mt-1">Cantidad: {{ $detail->quantity }}</p>
                                            <div class="flex justify-between items-center mt-2">
                                                <span class="text-[#272b30]/80 text-sm">Precio unitario:</span>
                                                <span class="text-[#ea9216] font-bold">S/
                                                    {{ number_format($detail->book->price, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex justify-between items-center mt-6 pt-4 border-t border-[#272b30]/10">
                                <span class="text-[#04050E] font-bold text-lg">Total:</span>
                                <span class="text-[#ea9216] font-bold text-xl">S/
                                    {{ number_format($order->orderDetails->sum('subtotal'), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($order->payment && $order->payment->voucher_image && $order->payment->voucher_exists)
                    <!-- Comprobante de pago -->
                    <div class="mt-8 bg-white rounded-2xl shadow-lg border border-[#272b30]/10 p-6">
                        <h3 class="text-xl font-bold text-[#04050E] mb-6 text-center">Comprobante de Pago</h3>

                        <div class="flex flex-col lg:flex-row gap-8 items-center">
                            <!-- Imagen del comprobante -->
                            <div class="lg:w-1/2 text-center">
                                <div class="relative inline-block">
                                    <img src="{{ $order->payment->voucher_url }}"
                                        alt="Comprobante de pago del pedido #{{ $order->id }}"
                                        class="max-w-full lg:max-w-md rounded-lg mx-auto shadow-md border border-[#272b30]/10">

                                    <!-- Botón para ver imagen en grande -->
                                    <a href="{{ $order->payment->voucher_url }}" target="_blank"
                                        class="absolute top-2 right-2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3-3H7" />
                                        </svg>
                                    </a>
                                </div>

                                <!-- Información adicional del comprobante -->
                                <div class="mt-4 text-center">
                                    <p class="text-[#272b30]/60 text-sm">
                                        <strong>Método de pago:</strong>
                                        <span class="text-[#04050E] capitalize">
                                            @if ($order->payment->payment_method == 'bank_transfer')
                                                Transferencia Bancaria
                                            @elseif($order->payment->payment_method == 'email')
                                                Confirmación por Correo
                                            @else
                                                {{ $order->payment->payment_method }}
                                            @endif
                                        </span>
                                    </p>
                                    <p class="text-[#272b30]/60 text-sm mt-1">
                                        <strong>Subido el:</strong>
                                        <span
                                            class="text-[#04050E]">{{ $order->payment->created_at->format('d/m/Y H:i') }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- ... resto del código de botones de reclamación ... -->
                        </div>
                    </div>
                @elseif($order->payment && $order->payment->voucher_image && !$order->payment->voucher_exists)
                    <!-- Mensaje de error si el comprobante no se encuentra -->
                    <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-2xl p-6">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-400 mx-auto mb-3"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <h3 class="text-lg font-bold text-yellow-800 mb-2">Comprobante no disponible</h3>
                            <p class="text-yellow-700">El archivo del comprobante no se encuentra en el sistema.</p>
                            <p class="text-yellow-600 text-sm mt-2">Por favor, contacta al administrador.</p>
                        </div>
                    </div>
                @endif
            </section>
        @endsection
