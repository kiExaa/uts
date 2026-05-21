<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $totalCategories   = \App\Models\Category::count();
    $totalProducts     = \App\Models\Product::count();
    $totalTransactions = \App\Models\Transaction::count();
    $totalRevenue      = \App\Models\Transaction::where('status', 'success')->sum('total_price');

    return view('dashboard', compact('totalCategories', 'totalProducts', 'totalTransactions', 'totalRevenue'));
});

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('transactions', TransactionController::class);
