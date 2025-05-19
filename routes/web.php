<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Models\Genre;
use App\Models\Author;

// Route utama dengan data dari controller
Route::get('/', [BookController::class, 'welcome']);

// Route alternatif jika ingin tetap pakai closure
/*
Route::get('/', function () {
    $genres = Genre::withCount('books')->get();
    $authors = Author::withCount('books')->get();
    return view('welcome', compact('genres', 'authors'));
});
*/

Route::get('/genres', [GenreController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']); 
Route::get('/books', [BookController::class, 'index']);