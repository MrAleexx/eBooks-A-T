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
                    <h3 class="text-xl font-bold text-[#04050E] mb-6 pb-4 border-b border-[#272b30]/10">Información del
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
                            <span class="text-[#04050E] capitalize">{{ $order->payment->payment_method ?? 'N/A' }}</span>
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
                    <h3 class="text-xl font-bold text-[#04050E] mb-6 pb-4 border-b border-[#272b30]/10">Productos</h3>

                    <div class="space-y-4">
                        @foreach ($order->orderDetails as $detail)
                            <div class="flex items-center gap-4 p-4 border border-[#272b30]/10 rounded-lg">
                                <x-book-image :image="$detail->book->image" :title="$detail->book->title"
                                    class="w-16 h-20 object-cover rounded-md" />
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-[#04050E] text-sm line-clamp-2">{{ $detail->book->title }}
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

        @if ($order->payment && $order->payment->voucher_image)
            <!-- Comprobante de pago -->
            <div class="mt-8 bg-white rounded-2xl shadow-lg border border-[#272b30]/10 p-6">
                <h3 class="text-xl font-bold text-[#04050E] mb-6 text-center">Comprobante de Pago</h3>

                <div class="flex flex-col lg:flex-row gap-8 items-center">
                    <!-- Imagen del comprobante -->
                    <div class="lg:w-1/2 text-center">
                        <img src="{{ Storage::url($order->payment->voucher_image) }}" alt="Comprobante de pago"
                            class="max-w-full lg:max-w-md rounded-lg mx-auto shadow-md">
                    </div>

                    <!-- Botones de reclamación -->
                    <div class="lg:w-1/2">
                        <div class="text-center mb-6">
                            <p class="text-[#272b30]/80 mb-4">¿Ya realizaste el pago? Reclama tus libros:</p>

                            @php
                                $phone = '51942784270';
                                $email = 'alextaya@hotmail.com';
                                $bookNames = $order->orderDetails->pluck('book.title')->join(', ');
                                $whatsappMessage = urlencode(
                                    "Hola, he completado mi pago y quiero reclamar los siguientes libros: {$bookNames}. Número de pedido: #{$order->id}",
                                );
                                $emailSubject = urlencode("Reclamación de Pedido #{$order->id}");
                                $emailBody = urlencode(
                                    "Hola,\n\nHe completado mi pago y quiero reclamar los siguientes libros:\n\n- " .
                                        $order->orderDetails->pluck('book.title')->join("\n- ") .
                                        "\n\nNúmero de pedido: #{$order->id}\nTotal pagado: S/ " .
                                        number_format($order->orderDetails->sum('subtotal'), 2) .
                                        "\n\nAdjunto comprobante de pago.\n\nSaludos cordiales",
                                );
                            @endphp

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-md mx-auto">
                                <!-- WhatsApp -->
                                <a href="https://wa.me/{{ $phone }}?text={{ $whatsappMessage }}" target="_blank"
                                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                    </svg>
                                    WhatsApp
                                </a>

                                <!-- Email -->
                                <a href="mailto:{{ $email }}?subject=Reclamación%20de%20Pedido%20%23{{ $order->id }}&body={{ $emailBody }}"
                                    target="_blank"
                                    class="bg-[#052f5a] hover:bg-[#041f3f] text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                    </svg>
                                    Email
                                </a>
                            </div>
                        </div>

                        <div class="bg-[#272b30]/5 rounded-lg p-4 border border-[#272b30]/10">
                            <p class="text-[#272b30]/60 text-sm text-center">
                                También puedes enviar un correo directamente a:
                                <strong class="text-[#04050E]">alextaya@hotmail.com</strong> incluyendo el número de pedido
                                #{{ $order->id }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
