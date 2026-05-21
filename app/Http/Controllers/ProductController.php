<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('category_id', 'name', 'description', 'price', 'stock');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                               ->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        $product->load('category', 'transactions');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('category_id', 'name', 'description', 'price', 'stock');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')
                               ->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }
}
