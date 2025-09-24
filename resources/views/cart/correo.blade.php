@extends('layouts.app')

@section('titulo', 'Confirmar Pedido por Correo')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-[#04050E] mb-2">Confirmar Pedido por Correo</h2>
            <p class="text-[#272b30]/60">Recibirás la confirmación de tu pedido por correo electrónico</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Resumen del carrito -->
            <div class="lg:w-1/2">
                <x-cart-summary :cart="$cart" :total="$total" />
            </div>

            <!-- Formulario de correo -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-2xl shadow-lg border border-[#272b30]/10 p-6">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-[#272b30]/10">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-[#272b30] to-[#1a1d21] rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#04050E]">Confirmación por Correo</h3>
                            <p class="text-[#272b30]/60 text-sm">Te enviaremos los detalles de tu pedido</p>
                        </div>
                    </div>

                    <form action="{{ route('cart.enviarCorreo') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-4">
                            <!-- Información del usuario -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[#04050E] font-semibold mb-2">Usuario</label>
                                    <div class="p-3 bg-[#272b30]/5 rounded-lg border border-[#272b30]/10">
                                        <span class="text-[#04050E]">{{ Auth::user()->name }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[#04050E] font-semibold mb-2">Correo</label>
                                    <div class="p-3 bg-[#272b30]/5 rounded-lg border border-[#272b30]/10">
                                        <span class="text-[#04050E]">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[#04050E] font-semibold mb-2">Estado del pedido</label>
                                <div class="p-3 bg-[#052f5a]/5 rounded-lg border border-[#052f5a]/10">
                                    <span class="text-[#052f5a] font-medium">Pendiente de confirmación</span>
                                </div>
                            </div>

                            <!-- Comprobante de pago -->
                            <div>
                                <label class="block text-[#04050E] font-semibold mb-3">Comprobante de pago</label>

                                <div
                                    class="border-2 border-dashed border-[#272b30]/20 rounded-xl p-6 text-center hover:border-[#ea9216] transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#272b30]/40 mx-auto mb-3"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>

                                    <input type="file" name="voucher" accept="image/*"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>

                                    <p class="text-[#272b30]/60 mb-1">Haz clic para subir tu comprobante</p>
                                    <p class="text-[#272b30]/40 text-xs">Formatos: JPEG, PNG, JPG, GIF (Máx. 2MB)</p>
                                </div>

                                @error('voucher')
                                    <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-[#272b30] to-[#1a1d21] hover:from-[#1a1d21] hover:to-[#272b30] text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 mt-4">
                                Enviar Pedido por Correo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
