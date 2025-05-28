<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
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

        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .profile-header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            object-fit: cover;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-email {
            font-size: 1rem;
            opacity: 0.9;
        }

        .profile-body {
            padding: 30px;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .info-item {
            display: flex;
            margin-bottom: 15px;
        }

        .info-label {
            width: 120px;
            font-weight: 600;
            color: #7f8c8d;
        }

        .info-value {
            flex: 1;
            color: #2c3e50;
        }

        .order-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .order-id {
            font-weight: 600;
            color: #2c3e50;
        }

        .order-date {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .order-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-delivered {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .order-items {
            margin-top: 10px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 50px;
            height: 50px;
            object-fit: contain;
            margin-right: 15px;
            border-radius: 5px;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .item-price {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .item-quantity {
            background-color: #f1f1f1;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
            color: #2c3e50;
        }

        .order-total {
            text-align: right;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            font-weight: 600;
            color: #2c3e50;
        }

        .edit-profile-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-profile-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
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

        .stats-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stat-card {
            flex: 1;
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin: 0 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #3498db;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 0.9rem;
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
        <a href="{{ route('user.cart') }}"><i class="fas fa-shopping-cart me-1"></i> Cart</a>
        <a href="{{ route('user.profile') }}" class="active"><i class="fas fa-user me-1"></i> Profile</a>
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

            <div class="profile-card">
                <div class="profile-header">
                    <img src="{{ Auth::user()->profile_image_url }}" alt="{{ Auth::user()->name }}" class="profile-image">
                    <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                    <p class="profile-email">{{ Auth::user()->email }}</p>
                </div>

                <div class="profile-body">
                    <!-- User Stats -->
                    <div class="stats-container">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="stat-value">{{ $totalOrders ?? 0 }}</div>
                            <div class="stat-label">Total Orders</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="stat-value">{{ $totalItems ?? 0 }}</div>
                            <div class="stat-label">Items Purchased</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="stat-value">{{ $totalSpent ?? 0 }} DH</div>
                            <div class="stat-label">Total Spent</div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="profile-section">
                        <h3 class="section-title">Personal Information</h3>
                        
                        <div class="info-item">
                            <div class="info-label">Name:</div>
                            <div class="info-value">{{ Auth::user()->name }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Email:</div>
                            <div class="info-value">{{ Auth::user()->email }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Phone:</div>
                            <div class="info-value">{{ Auth::user()->phone ?? 'Not provided' }}</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Address:</div>
                            <div class="info-value">{{ Auth::user()->address ?? 'Not provided' }}</div>
                        </div>
                        
                        <div class="text-end mt-3">
                            <a href="{{ route('user.profile.edit') }}" class="edit-profile-btn">
                                <i class="fas fa-edit me-1"></i> Edit Profile
                            </a>
                        </div>
                    </div>

                    <!-- Order History -->
                    <div class="profile-section">
                        <h3 class="section-title">Order History</h3>
                        
                        @forelse($orders ?? [] as $order)
                            <div class="order-card">
                                <div class="order-header">
                                    <div class="order-id">Order #{{ $order->id }}</div>
                                    <div class="order-date">{{ $order->created_at->format('M d, Y') }}</div>
                                    
                                    @php
                                        $statusClass = 'status-pending';
                                        if ($order->status === 'en_cours') $statusClass = 'status-processing';
                                        elseif ($order->status === 'livrée') $statusClass = 'status-delivered';
                                        elseif ($order->status === 'annulée') $statusClass = 'status-cancelled';
                                    @endphp
                                    
                                    <div class="order-status {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </div>
                                </div>
                                
                                <div class="order-items">
                                    @foreach($order->orderItems as $item)
                                        <div class="order-item">
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="item-image">
                                            <div class="item-details">
                                                <div class="item-name">{{ $item->product->name }}</div>
                                                <div class="item-price">{{ $item->price }} DH</div>
                                            </div>
                                            <div class="item-quantity">
                                                x{{ $item->quantity }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="order-total">
                                    Total: {{ $order->total }} DH
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i> You haven't placed any orders yet.
                            </div>
                        @endforelse
                    </div>
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