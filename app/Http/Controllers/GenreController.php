<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Book;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return response()->json([
            'success' => true,
            'data' => $genres
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255'
        ]);

        $genre = Genre::create($validated);

        return response()->json([
            'success' => true,
            'data' => $genre
        ], 201);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json(['data' => $book]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'author_id' => 'sometimes|exists:authors,id'
        ]);

        $book->update($validated);
        return response()->json(['data' => $book]);
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}