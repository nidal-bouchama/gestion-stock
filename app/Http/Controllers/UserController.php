<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Constructor to apply auth middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the user dashboard.
     */
    public function dashboard(): View
    {
        // Get featured products (for example, the 6 most recent products)
        $featuredProducts = Product::latest()->take(6)->get();
        
        // Sample recent updates - in a real app, you might have an announcements table
        $recentUpdates = collect([
            (object)[
                'message' => 'Welcome to our new product catalog system!',
                'created_at' => now()->subDays(2),
            ],
            (object)[
                'message' => 'Check out our latest products in the catalog.',
                'created_at' => now()->subDays(5),
            ],
        ]);
        
        return view('user_dashboard', compact('featuredProducts', 'recentUpdates'));
    }
    
    /**
     * Show the products browse page.
     */
    public function browseProducts(): View
    {
        // Get all products
        $products = Product::with('category')->get();
        
        // Get all categories for filtering
        $categories = Category::all();
        
        return view('products.browse', compact('products', 'categories'));
    }
    
    /**
     * Show the user profile page.
     */
    public function profile(): View
    {
        $user = Auth::user();
        
        // Get user's orders with items
        $orders = Order::where('customer_id', $user->id)
            ->with(['orderItems.product'])
            ->latest()
            ->get();
            
        // Calculate statistics
        $totalOrders = $orders->count();
        $totalItems = $orders->sum(function($order) {
            return $order->orderItems->sum('quantity');
        });
        $totalSpent = $orders->sum(function($order) {
            return $order->orderItems->sum(function($item) {
                return $item->price * $item->quantity;
            });
        });
        
        return view('user.profile', compact('orders', 'totalOrders', 'totalItems', 'totalSpent'));
    }
    
    /**
     * Show the edit profile page.
     */
    public function editProfile(): View
    {
        return view('user.edit_profile');
    }
    
    /**
     * Update the user profile.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete('profiles/' . $user->profile_image);
            }
            
            $imagePath = $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = basename($imagePath);
        }
        
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->save();
        
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }
    
    /**
     * Show the shopping cart.
     */
    public function cart(): View
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $subtotal = 0;
        
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
                $subtotal += $product->price * $quantity;
            }
        }
        
        // Calculate order totals
        $shipping = count($cartItems) > 0 ? 30 : 0; // Example shipping cost
        $tax = $subtotal * 0.2; // Example tax rate (20%)
        $total = $subtotal + $shipping + $tax;
        $totalItems = array_sum(array_column($cartItems, 'quantity'));
        
        return view('user.cart', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total', 'totalItems'));
    }
    
    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'sometimes|integer|min:1',
        ]);
        
        $productId = $validated['product_id'];
        $quantity = $validated['quantity'] ?? 1;
        
        $product = Product::find($productId);
        
        // Check if product exists and is in stock
        if (!$product || $product->quantity <= 0) {
            return back()->with('error', 'Product is out of stock');
        }
        
        // Get current cart
        $cart = Session::get('cart', []);
        
        // Add or update product in cart
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }
        
        // Make sure quantity doesn't exceed available stock
        if ($cart[$productId] > $product->quantity) {
            $cart[$productId] = $product->quantity;
        }
        
        // Save cart back to session
        Session::put('cart', $cart);
        
        return back()->with('success', 'Product added to cart');
    }
    
    /**
     * Update cart item quantity.
     */
    public function updateCart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'action' => 'required|in:increase,decrease',
        ]);
        
        $productId = $validated['product_id'];
        $action = $validated['action'];
        
        // Get current cart
        $cart = Session::get('cart', []);
        
        if (!isset($cart[$productId])) {
            return back()->with('error', 'Product not found in cart');
        }
        
        $product = Product::find($productId);
        
        if ($action === 'increase') {
            // Check stock before increasing
            if ($cart[$productId] < $product->quantity) {
                $cart[$productId]++;
            }
        } else {
            // Decrease quantity, remove if it becomes 0
            $cart[$productId]--;
            if ($cart[$productId] <= 0) {
                unset($cart[$productId]);
            }
        }
        
        // Save cart back to session
        Session::put('cart', $cart);
        
        return back()->with('success', 'Cart updated');
    }
    
    /**
     * Remove an item from the cart.
     */
    public function removeFromCart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        
        $productId = $validated['product_id'];
        
        // Get current cart
        $cart = Session::get('cart', []);
        
        // Remove product from cart
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }
        
        return back()->with('success', 'Product removed from cart');
    }
    
    /**
     * Create a new order from the cart.
     */
    public function createOrder(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }
        
        // Start a database transaction
        DB::beginTransaction();
        
        try {
            // Create a new order
            $order = new Order();
            $order->customer_id = $user->id;
            $order->order_date = now();
            $order->status = 'en_attente'; // Pending status
            $order->save();
            
            $total = 0;
            
            // Add order items
            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);
                
                if ($product && $product->quantity >= $quantity) {
                    // Create order item
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $productId;
                    $orderItem->quantity = $quantity;
                    $orderItem->price = $product->price;
                    $orderItem->save();
                    
                    // Update product quantity
                    $product->quantity -= $quantity;
                    $product->save();
                    
                    // Add to total
                    $total += $product->price * $quantity;
                }
            }
            
            // Update order with total
            $order->total = $total;
            $order->save();
            
            // Clear the cart
            Session::forget('cart');
            
            // Commit the transaction
            DB::commit();
            
            return redirect()->route('user.profile')->with('success', 'Order placed successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            return back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
}