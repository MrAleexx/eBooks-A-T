@extends('layouts.app')

@section('titulo', 'Finalizar Compra')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-[#04050E] mb-2">Finalizar Compra</h2>
            <p class="text-[#272b30]/60">Completa tu pedido seleccionando un método de pago</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Resumen del carrito -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-lg border border-[#272b30]/10 p-6">
                    <h3 class="text-xl font-bold text-[#04050E] mb-6 pb-4 border-b border-[#272b30]/10">Resumen de tu Pedido
                    </h3>

                    <!-- Lista de productos -->
                    <div class="space-y-4 mb-6">
                        @foreach ($cart as $item)
                            <div class="flex items-center gap-4 p-4 border border-[#272b30]/10 rounded-lg">
                                <x-book-image :image="$item['image']" :title="$item['title']"
                                    class="w-16 h-20 object-cover rounded-md" />
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-[#04050E] text-sm line-clamp-2">{{ $item['title'] }}</h4>
                                    <p class="text-[#272b30]/60 text-xs">{{ $item['author'] }}</p>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-[#272b30]/80 text-sm">Cantidad: {{ $item['quantity'] }}</span>
                                        <span class="text-[#ea9216] font-bold">S/
                                            {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Totales -->
                    <div class="border-t border-[#272b30]/10 pt-4 space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-[#272b30]/80">Subtotal</span>
                            <span class="text-[#04050E] font-semibold">S/ {{ number_format($total, 2) }}</span>
                        </div>

                        <!-- Nota sobre exoneración de IGV -->
                        <div class="bg-[#052f5a]/5 border border-[#052f5a]/10 rounded-lg p-3">
                            <div class="flex items-start gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#052f5a] mt-0.5 flex-shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-[#052f5a] text-xs">
                                    <strong>Libros exonerados del IGV</strong> según Ley Peruana
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-2 border-t border-[#272b30]/10">
                            <span class="text-[#04050E] font-bold text-lg">Total a pagar</span>
                            <span class="text-[#ea9216] font-bold text-xl">S/ {{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="mt-6 bg-white rounded-2xl shadow-lg border border-[#272b30]/10 p-6">
                    <h4 class="font-semibold text-[#04050E] mb-4">Información importante</h4>
                    <ul class="text-[#272b30]/60 text-sm space-y-2">
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#ea9216] mt-0.5 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Una vez realizado el pago, recibirás una confirmación por correo electrónico</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#ea9216] mt-0.5 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>El tiempo de entrega es de 3-5 días hábiles dentro de Lima Metropolitana</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#ea9216] mt-0.5 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Para provincias, el tiempo de entrega puede variar entre 5-10 días hábiles</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Métodos de pago -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-lg border border-[#272b30]/10 p-6 sticky top-6">
                    <h3 class="text-xl font-bold text-[#04050E] mb-6 pb-4 border-b border-[#272b30]/10">Selecciona tu Método
                        de Pago</h3>

                    <div class="space-y-4">
                        <!-- Yape y Plin -->
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('cart.yape') }}"
                                class="group text-center bg-white border-2 border-[#ea9216] hover:bg-[#ea9216] text-[#04050E] font-semibold py-4 px-3 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 mb-2 text-[#ea9216] group-hover:text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                    </svg>
                                    <span class="text-sm font-medium group-hover:text-white">Yape</span>
                                </div>
                            </a>

                            <a href="{{ route('cart.plin') }}"
                                class="group text-center bg-white border-2 border-[#ea9216] hover:bg-[#ea9216] text-[#04050E] font-semibold py-4 px-3 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 mb-2 text-[#ea9216] group-hover:text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    <span class="text-sm font-medium group-hover:text-white">Plin</span>
                                </div>
                            </a>
                        </div>

                        <!-- Cuenta Bancaria -->
                        <a href="{{ route('cart.bank') }}"
                            class="group flex items-center justify-between bg-white border-2 border-[#052f5a] hover:bg-[#052f5a] text-[#04050E] hover:text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-[#052f5a] group-hover:text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                <span>Cuenta Bancaria</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        <!-- Correo electrónico -->
                        <a href="{{ route('cart.correo') }}"
                            class="group flex items-center justify-between bg-white border-2 border-[#272b30] hover:bg-[#272b30] text-[#04050E] hover:text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-[#272b30] group-hover:text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Correo electrónico</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Información de seguridad -->
                    <div class="mt-6 pt-6 border-t border-[#272b30]/10">
                        <div class="flex items-center gap-2 text-[#272b30]/60 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Pago seguro y encriptado</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
