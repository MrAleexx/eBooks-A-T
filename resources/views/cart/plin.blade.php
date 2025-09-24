@extends('layouts.app')

@section('titulo', 'Pago con Plin')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <h2 class="text-3xl font-bold mb-8 text-center text-[#04050E]">Pago con Plin</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <x-cart-summary :cart="$cart" :total="$total" />

            <x-payment-form method="plin" accountInfo='Plin: <strong class="text-[#ea9216]">942784270</strong>'
                :action="route('cart.process')" buttonText="Confirmar Pedido con Plin" />
        </div>
    </section>
@endsection
