@extends('admin.layout')

@section('title', 'Detalles del Libro')
@section('subtitle', 'Información completa del libro')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold">Detalles del Libro</h3>
            <div class="flex space-x-2">
                <a href="{{ route('admin.books.edit', $book) }}"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200">
                    ✏️ Editar
                </a>
                <a href="{{ route('admin.books.index') }}"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                    ← Volver
                </a>
            </div>
        </div>

        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Imagen del Libro -->
                <div class="md:col-span-1">
                    @if ($book->image)
                        <x-book-image :image="$book->image" :title="$book->title"
                            class="w-full h-150 object-cover rounded-lg shadow"/>
                    @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center text-6xl">
                            📖
                        </div>
                    @endif
                </div>

                <!-- Información del Libro -->
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $book->title }}</h2>
                    <p class="text-lg text-gray-600 mb-4">por {{ $book->author }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500">Editorial</h4>
                            <p class="text-lg font-semibold">{{ $book->editorial }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500">ISBN</h4>
                            <p class="text-lg font-semibold">{{ $book->isbn }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500">Precio</h4>
                            <p class="text-lg font-semibold text-green-600">S/ {{ number_format($book->price, 2) }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500">Formato</h4>
                            <p class="text-lg font-semibold">{{ $book->format }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500">Páginas</h4>
                            <p class="text-lg font-semibold">{{ $book->pages }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500">Idioma</h4>
                            <p class="text-lg font-semibold">{{ $book->language }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500">Publicación</h4>
                            <p class="text-lg font-semibold">{{ $book->publication->format('d/m/Y') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500">Estado</h4>
                            <p class="text-lg font-semibold">
                                <span
                                    class="px-2 py-1 text-xs rounded-full 
                                {{ $book->is_new ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $book->is_new ? 'Nuevo' : 'Usado' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Descripción</h4>
                        <p class="text-gray-700 leading-relaxed">{{ $book->description }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Información Adicional</h4>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="text-gray-600">Creado:</div>
                            <div class="text-gray-900">{{ $book->created_at->format('d/m/Y H:i') }}</div>

                            <div class="text-gray-600">Actualizado:</div>
                            <div class="text-gray-900">{{ $book->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
