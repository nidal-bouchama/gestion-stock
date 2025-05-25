<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('home', [DashboardController::class, 'home'])->name('home');

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
