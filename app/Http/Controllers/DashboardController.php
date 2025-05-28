<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Order;
use App\Services\ActivityService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalOrders = Order::count();
        $lowStockProducts = Product::where('quantity', '<', 10)->get();
        $lowStockCount = $lowStockProducts->count();
        
        // Get recent activities
        $recentActivities = ActivityService::getRecent(10);
        
        // If no activities are found (new installation), create some sample activities
        if ($recentActivities->isEmpty()) {
            // Get recent products
            $recentProducts = Product::latest()->take(3)->get();
            foreach ($recentProducts as $product) {
                ActivityService::log(
                    "Product added: {$product->name}",
                    'product',
                    'create',
                    $product
                );
            }
            
            // Get recent orders
            $recentOrders = Order::latest()->take(3)->get();
            foreach ($recentOrders as $order) {
                ActivityService::log(
                    "Order #{$order->id} created",
                    'order',
                    'create',
                    $order
                );
            }
            
            // Fetch activities again after creating samples
            $recentActivities = ActivityService::getRecent(10);
        }
        
        return view('dashboard', compact(
            'totalProducts',
            'totalSuppliers',
            'totalOrders',
            'lowStockProducts',
            'lowStockCount',
            'recentActivities'
        )); 
    }

    public function home()
    {
        return view('home');
    }
}
