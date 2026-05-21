<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('product.category')
                          ->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'       => 'required|exists:products,id',
            'customer_name'    => 'required|string|max:100',
            'quantity'         => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            'status'           => 'required|in:pending,success,cancelled',
        ]);

        $product     = Product::findOrFail($request->product_id);
        $total_price = $product->price * $request->quantity;

        Transaction::create([
            'product_id'       => $request->product_id,
            'customer_name'    => $request->customer_name,
            'quantity'         => $request->quantity,
            'total_price'      => $total_price,
            'transaction_date' => $request->transaction_date,
            'status'           => $request->status,
        ]);

        return redirect()->route('transactions.index')
                         ->with('success', 'Transaksi berhasil dicatat!');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('product.category');
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $products = Product::all();
        return view('transactions.edit', compact('transaction', 'products'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'product_id'       => 'required|exists:products,id',
            'customer_name'    => 'required|string|max:100',
            'quantity'         => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            'status'           => 'required|in:pending,success,cancelled',
        ]);

        $product     = Product::findOrFail($request->product_id);
        $total_price = $product->price * $request->quantity;

        $transaction->update([
            'product_id'       => $request->product_id,
            'customer_name'    => $request->customer_name,
            'quantity'         => $request->quantity,
            'total_price'      => $total_price,
            'transaction_date' => $request->transaction_date,
            'status'           => $request->status,
        ]);

        return redirect()->route('transactions.index')
                         ->with('success', 'Transaksi berhasil diupdate!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')
                         ->with('success', 'Transaksi berhasil dihapus!');
    }
}
