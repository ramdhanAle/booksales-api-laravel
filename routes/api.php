<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Models\Genre;
use App\Models\Author;

// Route utama dengan data dari controller
Route::get('/', function () {
    return response()->json([
        'app' => 'BookSales API',
        'version' => '1.0',
        'status' => 'running'
    ]);
});
// Route alternatif jika ingin tetap pakai closure
/*
Route::get('/', function () {
    $genres = Genre::withCount('books')->get();
    $authors = Author::withCount('books')->get();
    return view('welcome', compact('genres', 'authors'));
});
*/

// books
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);

// genres
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{id}', [GenreController::class, 'show']);
Route::post('/genres', [GenreController::class, 'store']);
Route::put('/genres/{id}', [GenreController::class, 'update']);
Route::delete('/genres/{id}', [GenreController::class, 'destroy']);


// authors
Route::get('/authors', [AuthorController::class, 'index']); 
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::post('/authors', [AuthorController::class, 'store']);
Route::put('/authors/{id}', [AuthorController::class, 'update']);
Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);