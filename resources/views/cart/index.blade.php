@extends('layouts.app')

@section('titulo', 'Carrito de Compras')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <h2 class="text-2xl font-bold mb-6">Tu Carrito de Compras</h2>

        @if (count($cart) > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="hidden md:grid grid-cols-5 gap-4 p-4 bg-gray-100 font-semibold">
                    <div class="col-span-2">Producto</div>
                    <div>Precio</div>
                    <div>Cantidad</div>
                    <div>Total</div>
                </div>

                @foreach ($cart as $item)
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 p-4 border-b">
                        <div class="col-span-2 flex items-center">
                            <x-book-image :image="$item['image']" :title="$item['title']" class="w-16 h-24 object-cover rounded" />
                            <div class="ml-4">
                                <h3 class="font-semibold">{{ $item['title'] }}</h3>
                                <p class="text-sm text-gray-600">{{ $item['author'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <span class="md:hidden font-semibold mr-2">Precio: </span>
                            <span class="text-orange-600 font-bold">S/ {{ number_format($item['price'], 2) }}</span>
                        </div>

                        <div class="flex items-center">
                            <span class="md:hidden font-semibold mr-2">Cantidad: </span>
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    max="5" class="w-16 border rounded-md p-2 text-center">
                                <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                        <path
                                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <span class="md:hidden font-semibold mr-2">Total: </span>
                                <span class="text-orange-600 font-bold">S/
                                    {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="p-4 bg-gray-50 flex justify-between items-center">
                    <div class="text-xl font-bold">
                        Total: S/ {{ number_format($total, 2) }}
                    </div>
                    <a href="{{ route('cart.checkout') }}"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded font-semibold">
                        Proceder al Pago
                    </a>
                </div>
            </div>
        @else
            <div class="text-center py-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="text-2xl font-semibold mt-4">Tu carrito está vacío</h3>
                <p class="text-gray-600 mt-2">Agrega algunos libros para comenzar a comprar</p>
                <a href="{{ route('homebook') }}"
                    class="inline-block mt-4 bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded font-semibold">
                    Explorar Libros
                </a>
            </div>
        @endif
    </section>
@endsection
