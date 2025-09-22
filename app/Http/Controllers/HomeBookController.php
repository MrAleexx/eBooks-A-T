<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeBookController extends Controller
{
    public function __invoke()
    {
        $books = Book::all();
        return view('books', compact('books'));
    }
}
