<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Services\ActivityService;

class ProductController extends Controller
{
    public function index()
    {
        // Eager load the category relationship
        $products = Product::with('category')->get();
        $categories = Category::withCount('products')->get(); // Keep this if needed elsewhere in the view
        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all(); // Assuming you have a Category model
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
        'name' => 'required|string|max:150',
        'category_id' => 'required|exists:categories,id', // Add category_id validation
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $product = new Product();

    // Handle image upload
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $product->image = basename($path); // Store only the filename
    }

    $product->name = $validated['name'];
    $product->category_id = $validated['category_id']; // Save category_id
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->quantity = $validated['quantity'];
    $product->save();

    // Log activity
    ActivityService::log(
        "Added new product: {$product->name}",
        'product',
        'create',
        $product
    );

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->image_url = $product->image
            ? asset('storage/products/' . $product->image)
            : asset('Images/default-product.png');
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id', // Add category_id validation
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
            // Keep the existing image if no new one is uploaded
            $validated['image'] = $product->image;
        }

        // Update the product including category_id
        $product->update($validated);

        // Log activity
        ActivityService::log(
            "Updated product: {$product->name}",
            'product',
            'update',
            $product
        );

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Store product name before deletion for activity log
        $productName = $product->name;
        
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

        // Log activity
        ActivityService::log(
            "Deleted product: {$productName}",
            'product',
            'delete',
            null,
            'fas fa-trash'
        );

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
