@extends('admin.layout')

@section('title', 'Editar Libro')
@section('subtitle', 'Modificar información del libro')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold">Editar Libro: {{ $book->title }}</h3>
        </div>

        <div class="px-6 py-4">
            <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Columna Izquierda -->
                    <div>
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título *</label>
                            <input type="text" id="title" name="title" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                value="{{ old('title', $book->title) }}">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Autor *</label>
                            <input type="text" id="author" name="author" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                value="{{ old('author', $book->author) }}">
                            @error('author')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="editorial" class="block text-sm font-medium text-gray-700 mb-2">Editorial *</label>
                            <input type="text" id="editorial" name="editorial" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                value="{{ old('editorial', $book->editorial) }}">
                            @error('editorial')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">ISBN *</label>
                            <input type="text" id="isbn" name="isbn" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                value="{{ old('isbn', $book->isbn) }}">
                            @error('isbn')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Imagen Actual</label>
                            @if ($book->image)
                                <x-book-image :image="$book->image" :title="$book->title"
                                    class="w-20 h-28 object-cover rounded mb-2" />
                            @else
                                <div class="w-20 h-28 bg-gray-200 rounded flex items-center justify-center mb-2">
                                    📖
                                </div>
                            @endif

                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Nueva Imagen</label>
                            <input type="file" id="image" name="image"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                accept="image/*">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Campo para PDF -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">PDF Actual</label>
                            @if ($book->pdf_file)
                                <div class="flex items-center mb-2">
                                    <svg class="w-8 h-8 text-red-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-sm text-gray-600">PDF disponible</span>
                                </div>
                            @else
                                <div class="w-full bg-gray-100 rounded p-3 text-center mb-2">
                                    <span class="text-sm text-gray-500">No hay PDF cargado</span>
                                </div>
                            @endif

                            <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-2">Nuevo PDF</label>
                            <input type="file" id="pdf_file" name="pdf_file"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                accept=".pdf">
                            <p class="text-xs text-gray-500 mt-1">Formatos aceptados: PDF (máximo 10MB)</p>
                            @error('pdf_file')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Precio *</label>
                            <input type="number" id="price" name="price" step="0.01" min="0" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                value="{{ old('price', $book->price) }}">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="pages" class="block text-sm font-medium text-gray-700 mb-2">Páginas *</label>
                                <input type="number" id="pages" name="pages" min="1" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    value="{{ old('pages', $book->pages) }}">
                                @error('pages')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="format" class="block text-sm font-medium text-gray-700 mb-2">Formato
                                    *</label>
                                <select id="format" name="format" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <option value="">Seleccionar</option>
                                    <option value="Tapa blanda"
                                        {{ old('format', $book->format) == 'Tapa blanda' ? 'selected' : '' }}>Tapa blanda
                                    </option>
                                    <option value="Tapa dura"
                                        {{ old('format', $book->format) == 'Tapa dura' ? 'selected' : '' }}>Tapa dura
                                    </option>
                                    <option value="Digital"
                                        {{ old('format', $book->format) == 'Digital' ? 'selected' : '' }}>Digital</option>
                                </select>
                                @error('format')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="language" class="block text-sm font-medium text-gray-700 mb-2">Idioma *</label>
                            <input type="text" id="language" name="language" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                value="{{ old('language', $book->language) }}">
                            @error('language')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="publication" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Publicación
                        *</label>
                    <input type="date" id="publication" name="publication" required
                        class="w-full md:w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        value="{{ old('publication', $book->publication->format('Y-m-d')) }}">
                    @error('publication')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción *</label>
                    <textarea id="description" name="description" rows="4" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">{{ old('description', $book->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_new" value="1"
                            class="rounded border-gray-300 text-orange-600 focus:ring-orange-500"
                            {{ old('is_new', $book->is_new) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">¿Es un libro nuevo?</span>
                    </label>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.books.index') }}"
                        class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition-colors duration-200">
                        Actualizar Libro
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
