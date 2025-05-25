<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->map(function ($product) {
            return $product;
        });

        $categories = Category::withCount('products')->get();
        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all(); // Assuming you have a Category model
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = basename($imagePath);
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    public function edit(Product $product)
    {
        $categories = Category::all(); // Assuming you have a Category model
        $product->image_url = $product->image ? asset('storage/products/' . $product->image) : asset('Images/default-product.png');
        return view('products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = basename($imagePath);
        } else {
            // If no new image is uploaded, keep the old image
            $validated['image'] = $product->image;
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            // Delete from order_items
            DB::table('order_items')->where('product_id', $product->id)->delete();

            // Delete from stock_arrivals
            DB::table('stock_arrivals')->where('product_id', $product->id)->delete();

            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }
            // Delete the product
            $product->delete();
        });

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
