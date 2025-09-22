@extends('layouts.app')

@section('titulo', 'Mis Libros')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <h2 class="text-center text-2xl font-bold mb-10 uppercase">Mis Libros Comprados</h2>

        @if(request()->has('success'))
            <div id="successMessage" class="container mx-auto text-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                <p class="mb-3">
    🎉 Tu compra se ha realizado correctamente.
    <br>
    Una vez enviado el mensaje, habilitaremos el libro de tu compra en la plataforma.
</p>
            </div>
        @endif


        @if ($purchasedItems->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach ($purchasedItems as $item)
                    <div
                        class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 group relative flex flex-col">
                        <!-- Imagen -->
                        <a href="{{ route('user.books.show', $item->book) }}" class="block">
                            <div class="relative">
                                <img src="{{ $item->book->image ?? 'https://via.placeholder.com/150x200?text=Sin+imagen'  }}" alt="{{ $item->book->title }}"
                                    class="w-full h-60 object-cover rounded-t-lg">
                                <span
                                    class="absolute top-2 left-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                    Comprado
                                </span>
                            </div>
                        </a>

                        <!-- Info + botón con flex -->
                        <div class="p-4 flex flex-col flex-1">
                            <a href="{{ route('user.books.show', $item->book) }}" class="block">
                                <h3
                                    class="font-semibold text-lg mb-1 line-clamp-2 hover:text-orange-500 transition-colors duration-300">
                                    {{ $item->book->title }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $item->book->author }}</p>
                            </a>

                            <div class="flex justify-between items-center">
                                <span class="text-green-600 font-bold">Comprado</span>
                                <span class="text-sm text-gray-500">Cantidad: {{ $item->quantity }}</span>
                            </div>

                            <div class="mt-2 text-sm text-gray-500">
                                <p>Fecha compra: {{ $item->order->created_at->format('d/m/Y') }}</p>
                            </div>

                            <!-- Botón siempre al fondo -->
                            <div class="mt-auto">
                                <a href="{{ route('user.books.show', $item->book) }}"
                                    class="block w-full bg-orange-500 hover:bg-orange-600 text-white text-center py-2 rounded font-semibold transition-colors duration-300">
                                    Leer Ahora
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h3 class="text-2xl font-semibold mt-4">No tienes libros comprados</h3>
                <p class="text-gray-600 mt-2">Explora nuestro catálogo y encuentra tu próximo libro favorito</p>
                <a href="{{ route('homebook') }}"
                    class="inline-block mt-4 bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded font-semibold">
                    Explorar Libros
                </a>
            </div>
        @endif
    </section>
@endsection

@section('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
