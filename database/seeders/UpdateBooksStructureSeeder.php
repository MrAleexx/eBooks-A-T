<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateBooksStructureSeeder extends Seeder
{
    public function run(): void
    {
        // Actualizar libros existentes con valores por defecto
        DB::table('books')->update([
            'file_format' => 'PDF',
            'screen_reader_supported' => true,
            'enhanced_typesetting' => true,
            'page_flip_enabled' => true,
            'active' => true,
            'downloadable' => true,
            'updated_at' => now(),
        ]);

        // Insertar el libro ejemplo del Manual del Docente Innovador
        $bookId = DB::table('books')->insertGetId([
            'title' => 'Manual del Docente Innovador aplicando IA Generativa (Spanish Edition)',
            'author' => 'Pedro Alex Taya Yactayo', // Autor principal
            'editorial' => 'Pedro Alex Taya Yactayo',
            'isbn' => '9786120313879', // ISBN sin guiones
            'isbn13' => '978-612-03-1387-9',
            'asin' => 'B0FPMX34B2',
            'language' => 'es',
            'pages' => 108,
            'publication' => '2025-09-30',
            'edition' => '1er',
            'format' => 'Kindle',
            'file_format' => 'PDF',
            'file_size' => '2.8 MB',
            'price' => 10.00,
            'image' => 'manual-docente-innovador-ia.jpg',
            'pdf_file' => 'manual-docente-innovador-ia.pdf',
            'description' => 'Este libro nace de la necesidad de apoyar al maestro en su tarea diaria. Aquí encontrarás un banco de 1,440 prompts maestros para EBR/EBA, diseñados como pequeñas llaves que abren puertas a nuevas formas de planificar, enseñar y evaluar. Cada prompt es una invitación a mirar la clase con otros ojos, a experimentar estrategias distintas y a descubrir cómo la inteligencia artificial puede ser un aliado creativo y cercano.',
            'screen_reader_supported' => true,
            'enhanced_typesetting' => true,
            'page_flip_enabled' => true,
            'word_wise_enabled' => false,
            'reading_age' => 'De 14 a 18 años',
            'publisher_address' => 'Calle las Moras Mz. I Lt. 5 Urb. Libertad – San Vicente - Cañete',
            'publisher_email' => 'alextaya@hotmail.com',
            'publisher_city' => 'Lima – Perú',
            'deposito_legal' => '2025-09348',
            'publication_url' => 'https://a.co/d/6PzR4rD',
            'is_new' => true,
            'active' => true,
            'downloadable' => true,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insertar los contribuidores (autores)
        DB::table('book_contributors')->insert([
            [
                'book_id' => $bookId,
                'contributor_type' => 'author',
                'full_name' => 'Pedro Alex Taya Yactayo',
                'email' => 'alextaya@hotmail.com',
                'sequence_number' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => $bookId,
                'contributor_type' => 'author',
                'full_name' => 'Tania Elizabeth Urcia Casas',
                'email' => null,
                'sequence_number' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Insertar el índice/contenido del libro
        $chapters = [
            ['Créditos', 1],
            ['Dedicatoria', 2],
            ['Autores', 3],
            ['Presentación', 4],
            ['Índice General', 5],
            ['1. Ingresando a trabajar con ChatGPT', 6],
            ['2. ¿Qué es un Prompt?', 7],
            ['3. ¿Qué es un Prompt Maestro?', 8],
            ['4. Cómo usar los prompts en ChatGPT', 9],
            ['5. Nivel Inicial', 10],
            ['6. Nivel Primaria', 11],
            ['7. Nivel Secundaria', 12],
            ['8. Nivel Básica Alternativa', 13],
            ['Conclusión', 14],
        ];

        foreach ($chapters as $index => $chapter) {
            DB::table('book_contents')->insert([
                'book_id' => $bookId,
                'chapter_title' => $chapter[0],
                'chapter_number' => $index + 1,
                'page_start' => $chapter[1],
                'sort_order' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
