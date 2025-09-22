@extends('layouts.app')

@section('titulo', 'Página Principal')

@section('contenido')
    <section class="my-10 container mx-auto px-3">
        <div class="w-full mt-5">
            <div class="max-w-4xl rounded-lg grid grid-cols-1 md:grid-cols-[auto_1fr] gap-6 px-6">
                <div class="relative flex justify-center md:justify-start"> {{-- Centrar en móvil --}}
                    <x-book-image :image="$book->image" :title="$book->title" class="w-40 h-56 rounded-lg shadow-md" />
                    @if ($book->is_new)
                        <span
                            class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                            Nuevo
                        </span>
                    @endif
                </div>

                <div class="flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold">{{ $book->title }}</h2>
                        <p class="text-gray-600">{{ $book->author }}</p>
                        <p class="text-2xl text-gray-950 font-semibold mt-4">S/ {{ number_format($book->price, 2) }}</p>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center gap-2">
                            <form action="{{ route('cart.add', $book) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="cursor-pointer bg-orange-400 hover:bg-orange-500 text-white px-5 py-2 rounded-md font-semibold transition-colors duration-300">
                                    AÑADIR AL CARRITO
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="5"
                                    class="w-16 border rounded-md p-2 text-center" />
                            </form>
                        </div>

                        <div class="mt-4 flex flex-col gap-2 text-blue-900 text-sm font-medium">
                            {{-- <a href="#" class="hover:underline">Añadir comentario</a> --}}
                            <a href="#" class="hover:underline">Compartir</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-4xl px-6 mt-10">
                <div class="flex gap-4 border-b border-gray-400 pb-2">
                    <a href=""
                        class="text-blue-900 font-semibold hover:text-blue-700 transition-colors duration-300 text-xl">Más
                        Informacion</a>
                    {{-- <a href="" class="text-gray-900 font-semibold hover:text-gray-700 transition-colors duration-300 text-xl">Comentarios</a> --}}
                </div>

                <div class="mt-5">
                    <h5 class="mt-2 text-blue-900 font-semibold">Resumen:</h5>
                    <p class="text-sm">{{ $book->description }}</p>
                    <h5 class="mt-4 text-blue-900 font-semibold">Detalles de producto</h5>
                    <ul class="mt-1 space-y-1">
                        <li class="flex text-sm">
                            <span class="w-40">Peso:</span>
                            <strong class="text-blue-900">0.5kg</strong>
                        </li>
                        <li class="flex text-sm">
                            <span class="w-40">Nombre del autor:</span>
                            <strong class="text-blue-900">{{ $book->author }}</strong>
                        </li>
                        <li class="flex text-sm">
                            <span class="w-40">Editorial:</span>
                            <strong class="text-blue-900">{{ $book->editorial }}</strong>
                        </li>
                        <li class="flex text-sm">
                            <span class="w-40">Alto:</span>
                            <strong class="text-blue-900">24.00 cm</strong>
                        </li>
                        <li class="flex text-sm">
                            <span class="w-40">Ancho:</span>
                            <strong class="text-blue-900">17.00 cm</strong>
                        </li>
                        <li class="flex text-sm">
                            <span class="w-40">Saga:</span>
                            <strong class="text-blue-900">Educación</strong>
                        </li>
                        <li class="flex text-sm">
                            <span class="w-40">Formato:</span>
                            <strong class="text-blue-900">{{ $book->format }}</strong>
                        </li>
                        <li class="flex text-sm">
                            <span class="w-40">Número de Páginas:</span>
                            <strong class="text-blue-900">{{ $book->pages }}</strong>
                        </li>
                        <li class="flex text-sm">
                            <span class="w-40">ISBN:</span>
                            <strong class="text-blue-900">{{ $book->isbn }}</strong>
                        </li>
                        <li class="flex text-sm">
                            <span class="w-40">ASIN:</span>
                            <strong class="text-blue-900">B0FPMX34B2</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="px-6 mt-10">
            <h1 class="text-xl font-bold mb-6 text-blue-900">Índice General</h1>


<ul class="list-disc list-inside space-y-2 text-sm">
<li>Créditos</li>
<li>Dedicatoria</li>
<li>Autores</li>
<li>Presentación</li>
<li>Índice General</li>
<li class="list-none">1. Ingresando a trabajar con ChatGPT</li>
<li class="list-none">2. ¿Qué es un Prompt?</li>
<li class="list-none">3. ¿Qué es un Prompt Maestro?</li>
<li class="list-none">4. Cómo usar los prompts en ChatGPT</li>
<li class="list-none">
5. Nivel Inicial
<ul class="list-disc list-inside ml-6 space-y-1">
<li>Banco de Prompts por Áreas Curriculares (140)</li>
   <ul class="ml-6">
    <li class="flex items-center gap-2"> <span class="w-2 h-2 border border-black rounded-full bg-white"></span> Personal Social</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Psicomotriz</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Comunicación</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Castellano como Segunda Lengua</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Descubrimiento del Mundo</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Matemática</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Ciencia y Tecnología</li>
</ul>
<li>Banco de Prompts Maestros – Educación Inicial (180)</li>
<ul class="ml-6">
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Unidades Didácticas</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Sesiones de Clase</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Evaluaciones</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Estrategias y Presentaciones</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Rúbricas</li>
    <li class="flex items-center gap-2"><span class="w-2 h-2 border border-black rounded-full bg-white"></span>Otras Actividades</li>
</ul>
</ul>
</li>
<li class="list-none">
6. Nivel Primaria
<ul class="list-disc list-inside ml-6 space-y-1">
<li>Banco de Prompts por Áreas Curriculares (180)</li>
<li>Banco de Prompts Maestros – Educación Primaria (180)</li>
</ul>
</li>
<li class="list-none">
7. Nivel Secundaria
<ul class="list-disc list-inside ml-6 space-y-1">
<li>Banco de Prompts por Áreas Curriculares (200)</li>
<li>Banco de Prompts Maestros – Educación Secundaria (180)</li>
</ul>
</li>
<li class="list-none">
8. Nivel Básica Alternativa
<ul class="list-disc list-inside ml-6 space-y-1">
<li>Banco de Prompts por Áreas Curriculares (200)</li>
<li>Banco de Prompts Maestros – Educación Básica Alternativa (180)</li>
</ul>
</li>
<li class="list-none">Conclusión</li>
</ul>
        </div>
    </section>
@endsection
