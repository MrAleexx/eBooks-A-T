@extends('layouts.app')

@section('titulo', 'Página Principal')

@section('contenido')
    <div class="w-full h-[70vh] bg-cover bg-center" style="background-image: url('{{ asset('img/header.jpg') }}');">
        {{-- <div class="w-full h-full flex items-center justify-center bg-black/60"> --}}
        {{-- <h1 class="text-4xl md:text-6xl font-bold text-white">
                Bienvenido a <span class="text-orange-400">BookMart</span>
            </h1> --}}
        {{-- </div> --}}
    </div>

    {{-- <section class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 px-3 space-x-4">
        <x-card-list >
            <x-slot:subtitulo>
                Nuevos Lanzamientos
            </x-slot:subtitulo>
    
            <x-slot:titulo>
                Colección de Ficción 2025
            </x-slot:titulo>
        </x-card-list>

        <x-card-list >
            <x-slot:subtitulo>
                Nuevos Lanzamientos
            </x-slot:subtitulo>
    
            <x-slot:titulo>
                Colección de Ficción 2025
            </x-slot:titulo>
        </x-card-list>
        
        <x-card-list >
            <x-slot:subtitulo>
                Nuevos Lanzamientos
            </x-slot:subtitulo>
    
            <x-slot:titulo>
                Colección de Ficción 2025
            </x-slot:titulo>
        </x-card-list>
    </section> --}}

    <section class="my-10">
        <h2 class="text-center text-2xl font-bold mb-10 uppercase">Libro en tendencia</h2>
        <div class="container mx-auto flex flex-wrap justify-center gap-4">
            <a href="{{ route('bookmart.book', ['book' => $book->id]) }}"
                class="w-40 md:w-48 bg-white rounded-lg shadow group relative">
                <div class="relative">
                    <x-book-image :image="$book->image" :title="$book->title" class="w-full rounded-t-lg"/>
                        <button
                            class="cursor-pointer absolute inset-x-0 bottom-2 mx-auto w-11/12 bg-orange-400 hover:bg-orange-500 text-sm font-bold py-2 rounded opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 ease-in-out">
                            Añadir al Carrito
                        </button>
                </div>

                <div class="p-2 text-center space-y-1.5">
                    <p class="text-sm text-gray-700 truncate">
                        {{ $book->title }}
                    </p>
                    <span class="text-orange-600 font-bold">S/ {{ number_format($book->price, 2) }}</span>
                </div>
            </a>
        </div>

    </section>
@endsection
