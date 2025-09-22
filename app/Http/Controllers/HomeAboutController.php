<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeAboutController extends Controller
{
    public function __invoke()
    {
        return view('about');
    }
}
