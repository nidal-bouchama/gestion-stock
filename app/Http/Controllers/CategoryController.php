<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\ActivityService;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::withCount('products')->get();
            return view('categories.index', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error in CategoryController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load categories.');
        }
    }

    public function create()
    {
        return redirect()->route('categories.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);
        $category = Category::create($validated);
        
        // Log activity
        ActivityService::log(
            "Added new category: {$category->name}",
            'category',
            'create',
            $category
        );
        
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
        ]);
        $category->update($validated);
        
        // Log activity
        ActivityService::log(
            "Updated category: {$category->name}",
            'category',
            'update',
            $category
        );
        
        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Category $category)
    {
        try {
            // Store category name before deletion for activity log
            $categoryName = $category->name;
            
            DB::transaction(function () use ($category) {
                // Check for related products
                if ($category->products()->count() > 0) {
                    throw new \Exception('Cannot delete category with associated products');
                }
                $category->delete();
            });
            
            // Log activity
            ActivityService::log(
                "Deleted category: {$categoryName}",
                'category',
                'delete',
                null,
                'fas fa-trash'
            );
            
            return redirect()->route('categories.index')
                ->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')
                ->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }
}
