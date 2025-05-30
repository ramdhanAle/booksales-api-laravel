<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Berikut implementasi routing sesuai instruksi:
| - Read All (index) dan Show bisa diakses publik
| - Create, Update, Destroy hanya untuk admin
| - Transaksi: Create/Update/Show untuk customer, Read All/Destroy untuk admin
*/

// Route utama
Route::get('/', function () {
    return response()->json([
        'app' => 'BookSales API',
        'version' => '1.0',
        'status' => 'running'
    ]);
});

// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// API Version 1 Routes
Route::prefix('v1')->group(function () {
    // Public Routes (No Authentication Needed)
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{author}', [AuthorController::class, 'show']);
    
    Route::get('/genres', [GenreController::class, 'index']);
    Route::get('/genres/{genre}', [GenreController::class, 'show']);
    
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{book}', [BookController::class, 'show']);

    // Authenticated Routes
    Route::middleware('auth:sanctum')->group(function () {
        // Customer Routes
        Route::post('/transactions', [TransactionController::class, 'store']);
        Route::put('/transactions/{transaction}', [TransactionController::class, 'update']);
        Route::get('/transactions/{transaction}', [TransactionController::class, 'show']);

        // Admin Routes
        Route::middleware('role:admin')->group(function () {
            // Author Admin Routes
            Route::post('/authors', [AuthorController::class, 'store']);
            Route::put('/authors/{author}', [AuthorController::class, 'update']);
            Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);
            
            // Genre Admin Routes
            Route::post('/genres', [GenreController::class, 'store']);
            Route::put('/genres/{genre}', [GenreController::class, 'update']);
            Route::delete('/genres/{genre}', [GenreController::class, 'destroy']);

            // Book Admin Routes
            Route::post('/books', [BookController::class, 'store']);
            Route::put('/books/{book}', [BookController::class, 'update']);
            Route::delete('/books/{book}', [BookController::class, 'destroy']);
            
            // Transaction Admin Routes
            Route::get('/transactions', [TransactionController::class, 'index']);
            Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy']);
        });
    });
});