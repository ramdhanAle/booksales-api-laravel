<?php

namespace App\Http\Controllers;

use App\Models\Genre;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }
}