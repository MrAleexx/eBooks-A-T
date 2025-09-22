<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $book = Book::inRandomOrder()->first();
        return view('principal', compact('book'));
    }
}
