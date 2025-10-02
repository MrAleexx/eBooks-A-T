<?php
// app/Models/BookContent.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookContent extends Model
{
    protected $fillable = [
        'book_id',
        'chapter_title',
        'chapter_number',
        'page_start',
        'page_end',
        'description',
        'sort_order',
        'level'
    ];

    protected $casts = [
        'chapter_number' => 'integer',
        'page_start' => 'integer',
        'page_end' => 'integer',
        'sort_order' => 'integer'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
