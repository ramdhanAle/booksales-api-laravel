<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{    
    public function welcome()
    {
        return response()->json([
            'message' => 'Welcome to BookSales API'
        ]);
    }
    public function index()
    {
        $books = Book::all();
        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'required|integer'
        ]);

        $book = Book::create($validated);
        return response()->json([
            'success' => true,
            'data' => $book], 201);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $book]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'author_id' => 'sometimes|exists:authors,id',
            'published_year' => 'sometimes|integer'
        ]);

        $book->update($validated);
        return response()->json([
            'success' => true,
            'data' => $book]);
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}