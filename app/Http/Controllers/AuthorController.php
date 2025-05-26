<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return response()->json([
            'success' => true,
            'data' => $authors
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'bio' => 'nullable|string'
        ]);

        $authors = Author::create($validated);

        return response()->json([
            'success' => true,
            'data' => $authors
        ], 201);
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
            'nama' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:authors,email,' . $book->id,
            'bio' => 'sometimes|string|max:255'
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