<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image" href="{{ asset('Images/logo.svg') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: rgb(44, 62, 80);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        .navbar a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 20px;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .navbar a:hover {
            color: #ffc107;
            background-color: rgba(255,255,255,0.1);
        }
        
        .navbar a.active {
            background-color: rgba(40,167,69,0.2);
            color: #28a745;
        }
        
        .logout-btn {
            background-color: #dc3545;
            color: white !important;
            font-weight: bold;
            padding: 8px 15px !important;
            border-radius: 20px;
            transition: all 0.3s ease;
            margin-left: auto;
        }
        
        .logout-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .logo-text {
            font-weight: bold;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            margin-right: 30px;
        }
        
        .logo-text span:first-child { color: rgb(193, 0, 0); }
        .logo-text span:nth-child(2) { color: white; }
        .logo-text span:last-child { color: #2ecc71; }

        .main-content {
            margin-top: 30px;
            padding: 20px;
            margin-bottom: 60px;
        }

        .cart-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .cart-header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 20px;
            position: relative;
        }

        .cart-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .cart-body {
            padding: 20px;
        }

        .cart-item {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-right: 20px;
            border-radius: 5px;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .item-price {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .item-total {
            font-weight: 600;
            color: #2c3e50;
        }

        .item-actions {
            display: flex;
            align-items: center;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .quantity-btn {
            background: #f1f1f1;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .quantity-btn:hover {
            background: #e0e0e0;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            font-weight: 600;
            margin: 0 10px;
        }

        .remove-btn {
            background: #f8d7da;
            color: #721c24;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .remove-btn:hover {
            background: #f5c6cb;
        }

        .cart-summary {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .summary-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-label {
            color: #7f8c8d;
        }

        .summary-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            font-size: 1.2rem;
        }

        .summary-total-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .summary-total-value {
            font-weight: 700;
            color: #2c3e50;
        }

        .checkout-btn {
            background: #27ae60;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-weight: 600;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            background: #219653;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3);
        }

        .checkout-btn:disabled {
            background: #95a5a6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .empty-cart {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-cart-icon {
            font-size: 4rem;
            color: #bdc3c7;
            margin-bottom: 20px;
        }

        .empty-cart-message {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .continue-shopping-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .continue-shopping-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        footer {
            background-color: rgb(44, 62, 80);
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 100;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo-text">
            <span>Gestion</span>
            <span>Stock</span>
            <span>Web</span>
        </div>
        <a href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i> Home</a>
        <a href="{{ route('products.browse') }}"><i class="fas fa-box me-1"></i> Products</a>
        <a href="{{ route('user.cart') }}" class="active"><i class="fas fa-shopping-cart me-1"></i> Cart</a>
        <a href="{{ route('user.profile') }}"><i class="fas fa-user me-1"></i> Profile</a>
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

            <div class="cart-card">
                <div class="cart-header">
                    <h2 class="cart-title"><i class="fas fa-shopping-cart me-2"></i> Your Shopping Cart</h2>
                </div>

                <div class="cart-body">
                    @if(count($cartItems ?? []) > 0)
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Cart Items -->
                                @foreach($cartItems as $item)
                                    <div class="cart-item">
                                        <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}" class="item-image">
                                        
                                        <div class="item-details">
                                            <div class="item-name">{{ $item['product']->name }}</div>
                                            <div class="item-price">{{ $item['product']->price }} DH per unit</div>
                                            <div class="item-total">Total: {{ $item['product']->price * $item['quantity'] }} DH</div>
                                        </div>
                                        
                                        <div class="item-actions">
                                            <form action="{{ route('user.cart.update') }}" method="POST" class="quantity-control">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                                <button type="submit" name="action" value="decrease" class="quantity-btn" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="quantity-input" value="{{ $item['quantity'] }}" readonly>
                                                <button type="submit" name="action" value="increase" class="quantity-btn" {{ $item['quantity'] >= $item['product']->quantity ? 'disabled' : '' }}>
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('user.cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                                <button type="submit" class="remove-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="col-md-4">
                                <!-- Cart Summary -->
                                <div class="cart-summary">
                                    <h3 class="summary-title">Order Summary</h3>
                                    
                                    <div class="summary-item">
                                        <div class="summary-label">Subtotal ({{ $totalItems }} items)</div>
                                        <div class="summary-value">{{ $subtotal }} DH</div>
                                    </div>
                                    
                                    <div class="summary-item">
                                        <div class="summary-label">Shipping</div>
                                        <div class="summary-value">{{ $shipping }} DH</div>
                                    </div>
                                    
                                    <div class="summary-item">
                                        <div class="summary-label">Tax</div>
                                        <div class="summary-value">{{ $tax }} DH</div>
                                    </div>
                                    
                                    <div class="summary-total">
                                        <div class="summary-total-label">Total</div>
                                        <div class="summary-total-value">{{ $total }} DH</div>
                                    </div>
                                    
                                    <form action="{{ route('user.order.create') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="checkout-btn">
                                            <i class="fas fa-check me-2"></i> Checkout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="empty-cart">
                            <div class="empty-cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="empty-cart-message">
                                Your cart is empty
                            </div>
                            <a href="{{ route('products.browse') }}" class="continue-shopping-btn">
                                <i class="fas fa-box me-2"></i> Browse Products
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>