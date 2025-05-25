<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalOrders = Order::count();
        $lowStockProducts = Product::where('quantity', '<', 10)->get();
        $lowStockCount = $lowStockProducts->count();
        
        // You would also fetch recent activities here from your activity log
        
        return view('dashboard', compact(
            'totalProducts',
            'totalSuppliers',
            'totalOrders',
            'lowStockProducts',
            'lowStockCount'
        )); 
    }

    public function home()
    {
        return view('home');
    }
}
