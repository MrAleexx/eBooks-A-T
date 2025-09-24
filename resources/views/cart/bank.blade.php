@extends('layouts.app')

@section('titulo', 'Transferencia Bancaria')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <h2 class="text-3xl font-bold mb-8 text-center text-[#04050E]">Transferencia Bancaria</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <x-cart-summary :cart="$cart" :total="$total" />

            <x-payment-form method="bank_transfer"
                accountInfo='
                    <p class="mb-1">BCP: <strong class="text-[#ea9216]">25593579417098</strong></p>
                    <p>CCI: <strong class="text-[#ea9216]">00225519357941709881</strong></p>
                '
                :action="route('cart.process')" buttonText="Confirmar Transferencia" />
        </div>
    </section>
@endsection
