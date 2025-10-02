<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        // Información Básica
        'title',
        'author',
        'description',

        // Identificadores
        'isbn',
        'isbn13',
        'deposito_legal',

        // Información Editorial - TODOS LOS CAMPOS
        'publisher',
        'publisher_address',
        'publisher_email',
        'publisher_city',

        // Detalles Técnicos
        'language',
        'pages',
        'publication',
        'edition',
        'file_format',
        'file_size',
        'screen_reader_supported',
        'accessibility_features',

        // Información Comercial
        'price',
        'reading_age',
        'publication_url',

        // Archivos
        'image',
        'pdf_file',

        // Estados
        'is_new',
        'active',
        'downloadable',
        'pre_order',
        'published_at'
    ];

    protected $casts = [
        'publication' => 'date',
        'published_at' => 'datetime',
        'price' => 'decimal:2',
        'pages' => 'integer',
        'is_new' => 'boolean',
        'active' => 'boolean',
        'downloadable' => 'boolean',
        'pre_order' => 'boolean',
        'screen_reader_supported' => 'boolean',
        'accessibility_features' => 'array',
    ];

    // Relación con contribuidores
    public function contributors(): HasMany
    {
        return $this->hasMany(BookContributor::class);
    }

    // Relación con contenido/índice
    public function contents(): HasMany
    {
        return $this->hasMany(BookContent::class);
    }

    // Accesor para el autor principal (compatibilidad hacia atrás)
    public function getMainAuthorAttribute()
    {
        return $this->author;
    }

    // Accesor para obtener todos los autores
    public function getAllAuthorsAttribute()
    {
        if ($this->contributors->where('contributor_type', 'author')->count() > 0) {
            return $this->contributors->where('contributor_type', 'author')
                ->sortBy('sequence_number')
                ->pluck('full_name')
                ->implode(', ');
        }

        return $this->author;
    }

    // Accesor para editores
    public function getEditorsAttribute()
    {
        return $this->contributors->where('contributor_type', 'editor')
            ->sortBy('sequence_number')
            ->pluck('full_name')
            ->implode(', ');
    }

    // Scope para libros activos
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    // Scope para libros descargables
    public function scopeDownloadable($query)
    {
        return $query->where('downloadable', true);
    }
}
