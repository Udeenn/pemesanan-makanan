<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Product;
use App\Models\M_Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = M_Transaction::with(['product'])->get();

        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);

        return view('transactions.index', compact('transactions'));
    }

    public function create(){
        $transactions = M_Transaction::all();
        return view('admin.transactions.create', compact('transactions'));
    }

    public function edit($id){
        $transactions = M_Transaction::findOrFail($id);
        $products = M_Product::all();
        return view('transactions.edit', compact('transactions', 'products'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:tb_product,id_product',
            'total' => 'required|integer|min:1',
        ]);

        $transaction = M_Transaction::findOrFail($id);
        $transaction->update($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'buyerName' => 'required|string|max:255',
            'product_id' => 'required|exists:tb_product,id_product',
            'total' => 'required|integer|min:1',
        ]);

        $product = M_Product::findOrFail($request->product_id);

        $transaction = M_Transaction::create([
            'buyerName' => $request->buyerName,
            'product_id' => $request->product_id,
            'product_price' => $product->product_price,
            'total' => $request->total,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat',
            'data' => $transaction
        ]);
    }

    public function show($id){
        $transaction = M_Transaction::with('product')->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }
    

    public function destroy($id)
    {
        $transaction = M_Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        $transaction->delete();

        return redirect()->route('transactions.index')
        ->with('success', 'Transaksi berhasil dihapus.');
    }
}
