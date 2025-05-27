<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\validation\ValidationException;
use illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function show(string $id)
    {
        try {
            $author = Author::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $author
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 404);
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            $author = Author::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:authors,email,'.$id,
                'bio' => 'nullable|string'
            ]);
            
            $author->update($validated);
            
            return response()->json([
                'success' => true,
                'data' => $author
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }
    public function destroy(string $id)
    {
        try {
            $author = Author::findOrFail($id);
            $author->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Author deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Author not found'
            ], 404);
        }
    }
}