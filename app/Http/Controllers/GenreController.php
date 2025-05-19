<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
    $genres = Book::select('genre')->distinct()->get();
    return view('index', ['genres' => $genres]);
    }
}