<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

Route::resource('products', App\Http\Controllers\ProductController::class);
Route::resource('customers', App\Http\Controllers\CustomerController::class);
Route::resource('suppliers', App\Http\Controllers\SupplierController::class);
Route::resource('stock-arrivals', App\Http\Controllers\StockArrivalController::class);
Route::resource('orders', App\Http\Controllers\OrderController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);


Route::get('/', function () {
    return view('Accueil');
});


Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register');

// Admin routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('home', [DashboardController::class, 'home'])->name('home');

// User routes
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/products/browse', [UserController::class, 'browseProducts'])->name('products.browse');
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
Route::get('/user/cart', [UserController::class, 'cart'])->name('user.cart');
Route::post('/user/cart/add', [UserController::class, 'addToCart'])->name('user.cart.add');
Route::post('/user/cart/update', [UserController::class, 'updateCart'])->name('user.cart.update');
Route::post('/user/cart/remove', [UserController::class, 'removeFromCart'])->name('user.cart.remove');
Route::post('/user/order/create', [UserController::class, 'createOrder'])->name('user.order.create');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Defensive: Redirect GET /logout to dashboard to avoid MethodNotAllowed error
Route::get('/logout', function () {
    return redirect('/dashboard');
});

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::get(
    'produits',
    function () {
        return view('products.index');
    }
);

Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit'); {
    return view('suppliers.index');
};

Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit'); {
    return view('customers.index');
};

Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit'); {
    return view('orders.index');
};
