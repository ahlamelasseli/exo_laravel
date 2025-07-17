<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        if (auth()->user()->isAdmin() || auth()->id() == $product->user_id) {
            return view('products.edit', compact('product'));
        }
        
        abort(403, 'Unauthorized action.');
    }

    public function update(Request $request, Product $product)
    {
        if (!auth()->user()->isAdmin() && auth()->id() != $product->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
