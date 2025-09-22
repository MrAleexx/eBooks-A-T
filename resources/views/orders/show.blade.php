@extends('layouts.app')

@section('titulo', 'Detalle del Pedido #' . $order->id)

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <h2 class="text-2xl font-bold mb-6">Detalle del Pedido #{{ $order->id }}</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Detalles del pedido -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Información del Pedido</h3>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Fecha:</span>
                        <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Estado:</span>
                        <span
                            class="px-2 py-1 rounded text-xs
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
                    <div class="flex justify-between">
                        <span class="text-gray-600">Método de pago:</span>
                        <span class="capitalize">{{ $order->payment->payment_method ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Estado de pago:</span>
                        <span
                            class="px-2 py-1 rounded text-xs 
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

            <!-- Productos del pedido -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Productos</h3>

                @foreach ($order->orderDetails as $detail)
                    <div class="flex justify-between items-center border-b py-3">
                        <div class="flex items-center">
                            <x-book-image :image="$detail->book->image" :title="$detail->book->title" class="w-12 h-16 object-cover rounded" />
                            <div class="ml-3">
                                <h4 class="font-medium">{{ $detail->book->title }}</h4>
                                <p class="text-sm text-gray-600">Cantidad: {{ $detail->quantity }}</p>
                            </div>
                        </div>
                        <span class="text-orange-600 font-bold">S/ {{ number_format($detail->subtotal, 2) }}</span>
                    </div>
                @endforeach

                <div class="flex justify-between items-center mt-4 pt-4">
                    <span class="text-lg font-semibold">Total:</span>
                    <span class="text-orange-600 font-bold text-xl">S/
                        {{ number_format($order->orderDetails->sum('subtotal'), 2) }}</span>
                </div>
            </div>
        </div>

        @if ($order->payment && $order->payment->voucher_image)
            <div class="mt-8 bg-white rounded-lg shadow p-6 text-center">
                <h3 class="text-xl font-semibold mb-4">Comprobante de Pago</h3>
                <img src="{{ Storage::url($order->payment->voucher_image) }}" alt="Comprobante de pago"
                    class="max-w-xs rounded-lg mx-auto mb-4">

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

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <!-- WhatsApp -->
                    <a href="https://wa.me/{{ $phone }}?text={{ $whatsappMessage }}" target="_blank"
                        onclick="setTimeout(() => window.location.href='{{ route('book.index', ['success' => 1]) }}', 1000)"
                        class="bg-green-700 hover:bg-green-800 text-white font-semibold py-3 px-6 rounded inline-flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="mr-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M18.497 4.409a10 10 0 0 1 -10.36 16.828l-.223 -.098l-4.759 .849l-.11 .011a1 1 0 0 1 -.11 0l-.102 -.013l-.108 -.024l-.105 -.037l-.099 -.047l-.093 -.058l-.014 -.011l-.012 -.007l-.086 -.073l-.077 -.08l-.067 -.088l-.056 -.094l-.034 -.07l-.04 -.108l-.028 -.128l-.012 -.102a1 1 0 0 1 0 -.125l.012 -.1l.024 -.11l.045 -.122l1.433 -3.304l-.009 -.014a10 10 0 0 1 1.549 -12.454l.215 -.203a10 10 0 0 1 13.226 -.217m-8.997 3.09a1.5 1.5 0 0 0 -1.5 1.5v1a6 6 0 0 0 6 6h1a1.5 1.5 0 0 0 0 -3h-1l-.144 .007a1.5 1.5 0 0 0 -1.128 .697l-.042 .074l-.022 -.007a4.01 4.01 0 0 1 -2.435 -2.435l-.008 -.023l.075 -.041a1.5 1.5 0 0 0 .704 -1.272v-1a1.5 1.5 0 0 0 -1.5 -1.5" />
                        </svg>
                        Reclamar por WhatsApp
                    </a>

                    <!-- Email -->
                    <a href="mailto:{{ $email }}?subject=Reclamación%20de%20Pedido%20%23{{ $order->id }}&body={{ $emailBody }}"
                        target="_blank"
                        onclick="setTimeout(() => window.location.href='{{ route('book.index', ['success' => 1]) }}', 1000)"
                        class="bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 px-6 rounded inline-flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="mr-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                            <path d="M3 7l9 6l9 -6" />
                        </svg>
                        Reclamar por Email
                    </a>
                </div>

                <p class="text-sm text-gray-600 mt-4">
                    También puedes enviar un correo directamente a:
                    <strong>alextaya@hotmail.com</strong> incluyendo el número de pedido #{{ $order->id }}
                </p>
            </div>
        @endif
    </section>
@endsection
