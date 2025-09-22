@extends('layouts.app')

@section('titulo', 'Finalizar Compra')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <h2 class="text-2xl font-bold mb-6 text-center">Finalizar Compra</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Resumen de tu pedido</h3>

                @foreach ($cart as $item)
                    <div class="flex justify-between items-center border-b py-3">
                        <div class="flex items-center">
                            <x-book-image :image="$item['image']" :title="$item['title']" class="h-30 object-cover rounded" />
                            <div class="ml-3">
                                <h4 class="font-medium">{{ $item['title'] }}</h4>
                                <p class="text-sm text-gray-600">Cantidad: {{ $item['quantity'] }}</p>
                            </div>
                        </div>
                        <span class="text-orange-600 font-bold">S/
                            {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                @endforeach

                <div class="flex justify-between items-center mt-4 pt-4">
                    <span class="text-lg font-semibold">Total:</span>
                    <span class="text-orange-600 font-bold text-xl">S/ {{ number_format($total, 2) }}</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Método de Pago</h3>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Selecciona método de pago:</label>
                    <div class="flex flex-col space-y-2">
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('cart.yape') }}"
                                class="text-center w-full bg-orange-400 hover:bg-orange-500 text-white py-3 px-4 rounded font-semibold transition-colors duration-300">Yape</a>
                            <a href="{{ route('cart.plin') }}"
                                class="text-center w-full bg-orange-400 hover:bg-orange-500 text-white py-3 px-4 rounded font-semibold transition-colors duration-300">Plin</a>
                        </div>
                        <a href="{{ route('cart.bank') }}"
                            class="text-center w-full bg-orange-400 hover:bg-orange-500 text-white py-3 px-4 rounded font-semibold transition-colors duration-300">Cuenta
                            Bancaria</a>
                        <a href="{{ route('cart.correo') }}"
                            class="text-center w-full bg-orange-400 hover:bg-orange-500 text-white py-3 px-4 rounded font-semibold transition-colors duration-300">Correo
                            electrónico
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
