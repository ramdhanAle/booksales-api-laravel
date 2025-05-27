<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Book;
use Illuminate\Http\Request;
use illuminate\Validation\ValidationException;
use illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function show(string $id)
    {
        try {
            $genre = Genre::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $genre
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $genre = Genre::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);
            
            $genre->update($validated);
            
            return response()->json([
                'success' => true,
                'data' => $genre
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
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
            $genre = Genre::findOrFail($id);
            $genre->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Genre deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }
    }
}