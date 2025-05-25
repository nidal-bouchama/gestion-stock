<?php

namespace App\Http\Controllers;

use App\Models\StockArrival;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;

class StockArrivalController extends Controller
{
    public function index()
    {
        $stockArrivals = StockArrival::with(['supplier', 'product'])->get();
        return view('stock_arrivals.index', compact('stockArrivals'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('stock_arrivals.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'arrival_date' => 'required|date',
        ]);
        StockArrival::create($validated);
        return redirect()->route('stock-arrivals.index')->with('success', 'Arrivée de stock ajoutée avec succès.');
    }

    public function edit(StockArrival $stockArrival)
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('stock_arrivals.edit', compact('stockArrival', 'suppliers', 'products'));
    }

    public function update(Request $request, StockArrival $stockArrival)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'arrival_date' => 'required|date',
        ]);
        $stockArrival->update($validated);
        return redirect()->route('stock-arrivals.index')->with('success', 'Arrivée de stock modifiée avec succès.');
    }

    public function destroy(StockArrival $stockArrival)
    {
        $stockArrival->delete();
        return redirect()->route('stock-arrivals.index')->with('success', 'Arrivée de stock supprimée avec succès.');
    }
}
