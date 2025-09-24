@extends('layouts.app')

@section('titulo', 'Confirmar Pedido por Correo')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <h2 class="text-3xl font-bold mb-8 text-center text-[#04050E]">Confirmar Pedido por Correo</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <x-cart-summary :cart="$cart" :total="$total" />

            <div class="bg-[#eeeeee] rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-6 text-[#04050E]">Confirmación por Correo</h3>

                <form action="{{ route('cart.enviarCorreo') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[#04050E] font-medium mb-2">Usuario:
                                <input type="text" class="w-full border border-[#272b30]/30 rounded-md p-3 bg-[#eeeeee]"
                                    value="{{ Auth::user()->name }}" readonly>
                            </label>
                        </div>

                        <div>
                            <label class="block text-[#04050E] font-medium mb-2">Correo:
                                <input type="email" class="w-full border border-[#272b30]/30 rounded-md p-3 bg-[#eeeeee]"
                                    value="{{ Auth::user()->email }}" readonly>
                            </label>
                        </div>

                        <div>
                            <label class="block text-[#04050E] font-medium mb-2">Estado:
                                <input type="text" class="w-full border border-[#272b30]/30 rounded-md p-3 bg-[#eeeeee]"
                                    value="Pendiente de confirmación" readonly>
                            </label>
                        </div>

                        <div>
                            <label class="block text-[#04050E] font-medium mb-2">Título del primer libro:
                                <input type="text" class="w-full border border-[#272b30]/30 rounded-md p-3 bg-[#eeeeee]"
                                    value="{{ $cart[array_key_first($cart)]['title'] }}" readonly>
                            </label>
                        </div>

                        <div>
                            <label class="block text-[#04050E] font-medium mb-2">Subir comprobante de pago:
                                <input type="file" name="voucher" accept="image/*"
                                    class="w-full border border-[#272b30]/30 rounded-md p-2 focus:border-[#ea9216] focus:ring focus:ring-[#ea9216]/20 transition-colors"
                                    required>
                            </label>
                            <p class="text-sm text-[#272b30]/60 mt-1">Formatos aceptados: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                            @error('voucher')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-[#ea9216] hover:bg-[#d88310] text-[#04050E] font-semibold py-3 px-4 rounded-md transition-colors duration-300 hover:shadow-lg mt-4">
                            Enviar Pedido por Correo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
