<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Author;

class BookController extends Controller
{
    public function welcome()
    {
        $genres = Genre::withCount('books')->get();
        $authors = Author::withCount('books')->get();
        
        return view('welcome', compact('genres', 'authors'));
    }
    
    public function index()
    {
        // ... implementasi untuk route /books
    }
}