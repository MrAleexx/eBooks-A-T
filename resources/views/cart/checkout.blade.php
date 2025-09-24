@extends('layouts.app')

@section('titulo', 'Finalizar Compra')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <h2 class="text-3xl font-bold mb-8 text-center text-[#04050E]">Finalizar Compra</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <x-cart-summary :cart="$cart" :total="$total" />

            <div class="bg-[#eeeeee] rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-6 text-[#04050E]">Método de Pago</h3>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('cart.yape') }}"
                            class="text-center bg-[#ea9216] hover:bg-[#d88310] text-[#04050E] font-semibold py-4 px-4 rounded-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                            Yape
                        </a>
                        <a href="{{ route('cart.plin') }}"
                            class="text-center bg-[#ea9216] hover:bg-[#d88310] text-[#04050E] font-semibold py-4 px-4 rounded-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                            Plin
                        </a>
                    </div>

                    <a href="{{ route('cart.bank') }}"
                        class="block text-center bg-[#052f5a] hover:bg-[#041f3f] text-[#eeeeee] font-semibold py-4 px-4 rounded-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                        Cuenta Bancaria
                    </a>

                    <a href="{{ route('cart.correo') }}"
                        class="block text-center bg-[#272b30] hover:bg-[#1a1d21] text-[#eeeeee] font-semibold py-4 px-4 rounded-md transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                        Correo electrónico
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
