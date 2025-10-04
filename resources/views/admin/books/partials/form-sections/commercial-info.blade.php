{{-- resources/views/admin/books/partials/form-sections/commercial-info.blade.php --}}
<div class="bg-white rounded-lg border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-shopping-cart text-green-500 mr-2"></i>
        Información Comercial
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                <i class="fas fa-tag text-gray-400 mr-2 text-xs"></i>
                Precio (S/) *
            </label>
            <input type="number" id="price" name="price" step="0.01" min="0" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                value="{{ old('price', $book->price ?? '') }}">
            @error('price')
                <p class="text-red-500 text-sm mt-1 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="reading_age" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                <i class="fas fa-user-friends text-gray-400 mr-2 text-xs"></i>
                Edad de Lectura
            </label>
            <input type="text" id="reading_age" name="reading_age"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                value="{{ old('reading_age', $book->reading_age ?? '') }}" placeholder="De 14 a 18 años">
        </div>

        <div>
            <label for="publication_url" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                <i class="fas fa-link text-gray-400 mr-2 text-xs"></i>
                URL de Publicación
            </label>
            <input type="url" id="publication_url" name="publication_url"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                value="{{ old('publication_url', $book->publication_url ?? '') }}" placeholder="https://a.co/d/...">
        </div>
    </div>
</div>
