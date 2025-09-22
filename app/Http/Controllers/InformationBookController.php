<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class InformationBookController extends Controller
{
    public function show(Book $book)
    {
        return view('book.information', compact('book'));
    }
}
