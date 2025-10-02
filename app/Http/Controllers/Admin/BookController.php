<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        \Log::info('🎯 INICIANDO STORE BOOK', $request->all());

        // DEBUG: Ver qué datos llegan
        dd([
            'request_data' => $request->all(),
            'files_received' => $request->files->all(),
            'has_is_new' => $request->has('is_new'),
            'has_active' => $request->has('active'),
            'has_downloadable' => $request->has('downloadable'),
            'has_pre_order' => $request->has('pre_order'),
            'has_screen_reader_supported' => $request->has('screen_reader_supported'),
        ]);

        $validated = $request->validate([
            // Información Básica
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',

            // Identificadores
            'isbn' => 'required|string|unique:books,isbn',
            'isbn13' => 'nullable|string|max:20',
            'deposito_legal' => 'nullable|string|max:50',

            // Información Editorial
            'publisher' => 'required|string|max:255',
            'publisher_address' => 'nullable|string|max:500',
            'publisher_email' => 'nullable|email|max:100',
            'publisher_city' => 'nullable|string|max:100',

            // Detalles Técnicos
            'language' => 'required|string|max:50',
            'pages' => 'required|integer|min:1',
            'publication' => 'required|date',
            'edition' => 'required|string|max:100',
            'file_format' => 'required|string|max:50',
            'file_size' => 'nullable|string|max:50',
            'screen_reader_supported' => 'boolean',
            'accessibility_features' => 'nullable|string',

            // Información Comercial
            'price' => 'required|numeric|min:0',
            'reading_age' => 'nullable|string|max:50',
            'publication_url' => 'nullable|url|max:500',

            // Archivos
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',

            // Estados
            'is_new' => 'boolean',
            'active' => 'boolean',
            'downloadable' => 'boolean',
            'pre_order' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        // Procesar archivos
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('books/pdfs', 'public');
        }

        // Procesar checkboxes
        $validated['is_new'] = $request->has('is_new');
        $validated['active'] = $request->has('active');
        $validated['downloadable'] = $request->has('downloadable');
        $validated['pre_order'] = $request->has('pre_order');
        $validated['screen_reader_supported'] = $request->has('screen_reader_supported');

        \Log::info('📝 DATOS VALIDADOS PARA CREAR:', $validated);

        try {
            $book = Book::create($validated);
            \Log::info('✅ LIBRO CREADO EXITOSAMENTE', ['id' => $book->id, 'title' => $book->title]);

            return redirect()->route('admin.books.index')
                ->with('success', 'Libro creado exitosamente.');
        } catch (\Exception $e) {
            \Log::error('❌ ERROR CREANDO LIBRO:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Error al crear el libro: ' . $e->getMessage());
        }
    }

    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        \Log::info('🔄 INICIANDO UPDATE BOOK', [
            'book_id' => $book->id,
            'request_data' => $request->all(),
            'current_book_data' => $book->toArray()
        ]);

        // ✅ NO HAY dd() - EL PROCESO CONTINÚA

        $validated = $request->validate([
            // Información Básica
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',

            // Identificadores
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'isbn13' => 'nullable|string|max:20',
            'deposito_legal' => 'nullable|string|max:50',

            // Información Editorial
            'publisher' => 'required|string|max:255',
            'publisher_address' => 'nullable|string|max:500',
            'publisher_email' => 'nullable|email|max:100',
            'publisher_city' => 'nullable|string|max:100',

            // Detalles Técnicos
            'language' => 'required|string|max:50',
            'pages' => 'required|integer|min:1',
            'publication' => 'required|date',
            'edition' => 'required|string|max:100',
            'file_format' => 'required|string|max:50',
            'file_size' => 'nullable|string|max:50',
            'screen_reader_supported' => 'boolean',
            'accessibility_features' => 'nullable|string',

            // Información Comercial
            'price' => 'required|numeric|min:0',
            'reading_age' => 'nullable|string|max:50',
            'publication_url' => 'nullable|url|max:500',

            // Archivos
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',

            // Estados
            'is_new' => 'boolean',
            'active' => 'boolean',
            'downloadable' => 'boolean',
            'pre_order' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        // Procesar archivos
        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            if ($book->pdf_file) {
                Storage::disk('public')->delete($book->pdf_file);
            }
            $validated['pdf_file'] = $request->file('pdf_file')->store('books/pdfs', 'public');
        }

        // Procesar checkboxes - CORRECTO
        $validated['is_new'] = $request->boolean('is_new');
        $validated['active'] = $request->boolean('active');
        $validated['downloadable'] = $request->boolean('downloadable');
        $validated['pre_order'] = $request->boolean('pre_order');
        $validated['screen_reader_supported'] = $request->boolean('screen_reader_supported');

        \Log::info('📝 DATOS VALIDADOS PARA ACTUALIZAR:', $validated);

        try {
            $book->update($validated);
            \Log::info('✅ LIBRO ACTUALIZADO EXITOSAMENTE', ['id' => $book->id, 'title' => $book->title]);

            return redirect()->route('admin.books.index')
                ->with('success', 'Libro actualizado exitosamente.');
        } catch (\Exception $e) {
            \Log::error('❌ ERROR ACTUALIZANDO LIBRO:', [
                'book_id' => $book->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Error al actualizar el libro: ' . $e->getMessage());
        }
    }

    public function destroy(Book $book)
    {
        \Log::info('🗑️ ELIMINANDO LIBRO', ['id' => $book->id, 'title' => $book->title]);

        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        if ($book->pdf_file) {
            Storage::disk('public')->delete($book->pdf_file);
        }

        $book->delete();

        \Log::info('✅ LIBRO ELIMINADO EXITOSAMENTE', ['id' => $book->id]);

        return redirect()->route('admin.books.index')
            ->with('success', 'Libro eliminado exitosamente.');
    }
}
