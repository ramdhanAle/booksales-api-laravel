<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;

use App\Models\Genre;
use App\Models\Author;

Route::get('/', function () {
    $genres = Genre::all();
    $authors = Author::all();
    return view('welcome', [
        'genres' => $genres,
        'authors' => $authors
    ]);
});

Route::get('/genres', [GenreController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']);
