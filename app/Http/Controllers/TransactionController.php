<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi lebih ketat dengan mengecek stok buku
        $validated = $request->validate([
            'book_id' => [
                'required',
                'integer',
                Rule::exists('books', 'id')->where(function ($query) {
                    $query->where('stock', '>', 0); // Hanya buku dengan stok > 0
                })
            ],
            'quantity' => 'required|integer|min:1|max:10' // Batas maksimal 10
        ]);

        DB::beginTransaction();
        try {
            $book = Book::findOrFail($validated['book_id']);

            // Validasi stok cukup
            if ($book->stock < $validated['quantity']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok buku tidak mencukupi',
                    'available_stock' => $book->stock,
                    'requested_quantity' => $validated['quantity']
                ], 422);
            }

            $transaction = auth()->user()->transactions()->create([
                'book_id' => $book->id,
                'quantity' => $validated['quantity'],
                'total_price' => $book->price * $validated['quantity'],
                'status' => 'pending',
            ]);

            // Kurangi stok buku
            $book->decrement('stock', $validated['quantity']);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $transaction,
                'message' => 'Transaksi berhasil dibuat'
            ], 201);

        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan',
                'available_books' => Book::where('stock', '>', 0)->pluck('id')
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        return response()->json([
            'success' => true,
            'data' => $transaction->load('book')
        ]);
    }
}