<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->latest()->paginate(10);
        $customers = Customer::all();
        return view('orders.index', compact('orders', 'customers'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'status' => 'required|string',
        ]);
        $order = Order::create($validated);
        return redirect()->route('orders.index')->with('success', 'Commande ajoutée avec succès.');
    }

    public function edit(Order $order)
    {
        $order->load('items.product', 'customer'); // This ensures items are loaded

        return view('orders.edit', [
            'order' => $order,
            'customers' => Customer::all(),
            'products' => Product::all()
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'status' => 'required|string',
        ]);
        $order->update($validated);
        return redirect()->route('orders.index')->with('success', 'Commande modifiée avec succès.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès.');
    }
}
