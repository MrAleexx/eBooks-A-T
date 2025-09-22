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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('author', 60);
            $table->string('editorial', 60);
            $table->bigInteger('isbn')->unique();
            $table->string('language', 30);
            $table->integer('pages');
            $table->date('publication');
            $table->string('format', 20);
            $table->decimal('price', 10, 2);
            $table->string('image', 255);
            $table->text('description')->nullable();
            $table->boolean('is_new')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
