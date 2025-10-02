<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Primero modificar campos existentes para mayor capacidad
            $table->string('title', 255)->change();
            $table->string('author', 255)->change();
            $table->string('editorial', 255)->change();
            $table->string('isbn', 20)->change(); // Cambiar de bigInteger a string
            $table->string('language', 10)->change(); // Códigos ISO más cortos

            // Nuevos campos basados en datos de Amazon
            $table->string('asin', 20)->nullable()->after('isbn');
            $table->string('isbn13', 20)->nullable()->after('isbn');
            $table->string('edition', 100)->default('1er')->after('publication');
            $table->string('file_size', 50)->nullable()->after('pages');
            $table->string('file_format', 10)->default('PDF')->after('file_size');

            // Características de accesibilidad
            $table->boolean('screen_reader_supported')->default(true)->after('format');
            $table->boolean('enhanced_typesetting')->default(true)->after('screen_reader_supported');
            $table->boolean('page_flip_enabled')->default(true)->after('enhanced_typesetting');
            $table->boolean('word_wise_enabled')->default(false)->after('page_flip_enabled');

            // Información de audiencia
            $table->string('reading_age', 50)->nullable()->after('description');

            // Información editorial extendida
            $table->string('publisher_address', 500)->nullable()->after('editorial');
            $table->string('publisher_email', 100)->nullable()->after('publisher_address');
            $table->string('publisher_city', 100)->nullable()->after('publisher_email');

            // Información legal y comercial
            $table->string('deposito_legal', 50)->nullable()->after('isbn13');
            $table->string('publication_url', 500)->nullable()->after('publication');

            // Campos de control
            $table->boolean('active')->default(true)->after('is_new');
            $table->boolean('downloadable')->default(true)->after('active');
            $table->boolean('pre_order')->default(false)->after('downloadable');
            $table->timestamp('published_at')->nullable()->after('pre_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Revertir cambios en campos existentes
            $table->string('title', 100)->change();
            $table->string('author', 60)->change();
            $table->string('editorial', 60)->change();
            $table->bigInteger('isbn')->change();
            $table->string('language', 30)->change();
            
            // Eliminar nuevos campos
            $table->dropColumn([
                'asin', 'isbn13', 'edition', 'file_size', 'file_format',
                'screen_reader_supported', 'enhanced_typesetting', 'page_flip_enabled',
                'word_wise_enabled', 'reading_age', 'publisher_address',
                'publisher_email', 'publisher_city', 'deposito_legal',
                'publication_url', 'active', 'downloadable', 'pre_order', 'published_at'
            ]);
        });
    }
};
