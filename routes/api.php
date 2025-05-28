<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Berikut implementasi routing sesuai instruksi:
| - Read All (index) dan Show bisa diakses publik
| - Create, Update, Destroy hanya untuk admin
*/

// Route utama
Route::get('/', function () {
    return response()->json([
        'app' => 'BookSales API',
        'version' => '1.0',
        'status' => 'running'
    ]);
});

// API Version 1 Routes
Route::prefix('v1')->group(function () {
    // Public Routes (No Authentication Needed)
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{id}', [AuthorController::class, 'show']);
    
    Route::get('/genres', [GenreController::class, 'index']);
    Route::get('/genres/{id}', [GenreController::class, 'show']);
    
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);

    // Protected Routes (Admin Only)
    Route::middleware(['auth:api', 'role:admin'])->group(function () {
        // Author Admin Routes
        Route::post('/authors', [AuthorController::class, 'store']);
        Route::put('/authors/{id}', [AuthorController::class, 'update']);
        Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);
        
        // Genre Admin Routes
        Route::post('/genres', [GenreController::class, 'store']);
        Route::put('/genres/{id}', [GenreController::class, 'update']);
        Route::delete('/genres/{id}', [GenreController::class, 'destroy']);

        // Book Admin Routes
        Route::post('/books', [BookController::class, 'store']);
        Route::put('/books/{id}', [BookController::class, 'update']);
        Route::delete('/books/{id}', [BookController::class, 'destroy']);
    });
});