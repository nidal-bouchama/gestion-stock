<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image" href="Images/logo.svg">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    
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

        header {
            background-color: #2c3e50;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .logo span:first-child { color: rgb(193, 0, 0); }
        .logo span:nth-child(2) { color: white; }
        .logo span:last-child { color: #2ecc71; }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        body {
            background-image: url('Images/home-hero-bg.jpg'); /* Replace with actual image URL */
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2c3e50;
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
        .main-content {
            margin-top: 30px;
            padding: 20px;
        }
        .dashboard-card {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 12px;
            transition: transform 0.2s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .dashboard-title { font-weight: 700; color: #2c3e50; }
        .dashboard-welcome { color: #636e72; }
        .stats-card { background: linear-gradient(135deg, #2980b9, #3498db); color: white; }
        .stats-icon { font-size: 2.5rem; opacity: 0.8; }
        .stats-number { font-size: 1.8rem; font-weight: bold; }
        .card-title {
            font-weight: 700;
            color: #34495e;
        }
        .quick-action {
            transition: all 0.3s;
        }
        .quick-action:hover {
            transform: scale(1.05);
        }
        .low-stock-alert {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 6px;
        }
        .activity-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        footer {
            background-color: rgb(44, 62, 80);
            color: white;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px 5px 5px 5px;
            }
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

        .quick-action {
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .quick-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .action-icon {
            background: rgba(255,255,255,0.2);
            padding: 10px;
            border-radius: 8px;
            margin-right: 15px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-content {
            text-align: left;
        }

        .action-title {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .action-desc {
            display: block;
            font-size: 0.75rem;
            opacity: 0.8;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .quick-actions-container {
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .quick-actions-container.collapsed {
            max-height: 0;
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
        <a href="{{ route('dashboard') }}" class="active"><i class="fas fa-tachometer-alt me-1"></i> Home</a>
        <a href="{{ route('products.index') }}"><i class="fas fa-box me-1"></i> Products</a>
        <a href="{{ route('suppliers.index') }}"><i class="fas fa-truck me-1"></i> Suppliers</a>
        <a href="{{ route('customers.index') }}"><i class="fas fa-users me-1"></i> Customers</a>
        <a href="{{ route('orders.index') }}"><i class="fas fa-shopping-cart me-1"></i> Orders</a>
        <a href="{{ route('stock-arrivals.index') }}"><i class="fas fa-dolly me-1"></i> Stock Arrivals</a>
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="main-content">
        <div class="container-fluid">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card dashboard-card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Products</h6>
                                    <div class="stats-number">{{ $totalProducts ?? 0 }}</div>
                                </div>
                                <i class="fas fa-box stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card dashboard-card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Suppliers</h6>
                                    <div class="stats-number">{{ $totalSuppliers ?? 0 }}</div>
                                </div>
                                <i class="fas fa-truck stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card dashboard-card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Orders</h6>
                                    <div class="stats-number">{{ $totalOrders ?? 0 }}</div>
                                </div>
                                <i class="fas fa-shopping-cart stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card dashboard-card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Low Stock Items</h6>
                                    <div class="stats-number">{{ $lowStockCount ?? 0 }}</div>
                                </div>
                                <i class="fas fa-exclamation-triangle stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Quick Actions -->
                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-bolt me-2"></i>Quick Actions
                                <button class="btn btn-sm btn-outline-secondary float-end" id="toggleActions">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </h5>
                            <div class="quick-actions-container">
                                <div class="d-grid gap-2 fade-in">
                                    <a href="{{ route('products.create') }}" class="btn btn-primary quick-action mb-2 action-btn">
                                        <div class="d-flex align-items-center">
                                            <div class="action-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="action-content">
                                                <span class="action-title">Add New Product</span>
                                                <small class="action-desc">Create a new product entry</small>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <a href="{{ route('stock-arrivals.create') }}" class="btn btn-success quick-action mb-2 action-btn">
                                        <div class="d-flex align-items-center">
                                            <div class="action-icon">
                                                <i class="fas fa-truck"></i>
                                            </div>
                                            <div class="action-content">
                                                <span class="action-title">Record Stock Arrival</span>
                                                <small class="action-desc">Log new stock arrivals</small>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <a href="{{ route('orders.create') }}" class="btn btn-info quick-action mb-2 action-btn">
                                        <div class="d-flex align-items-center">
                                            <div class="action-icon">
                                                <i class="fas fa-cart-plus"></i>
                                            </div>
                                            <div class="action-content">
                                                <span class="action-title">Create New Order</span>
                                                <small class="action-desc">Process a new order</small>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="{{ route('categories.create') }}" class="btn btn-warning quick-action action-btn">
                                        <div class="d-flex align-items-center">
                                            <div class="action-icon">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                            <div class="action-content">
                                                <span class="action-title">Create New Category</span>
                                                <small class="action-desc">Add product categories</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Alerts -->
                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Low Stock Alerts</h5>
                            @forelse($lowStockProducts ?? [] as $product)
                                <div class="low-stock-alert">
                                    <strong>{{ $product->name }}</strong>
                                    <div class="small">Current Stock: {{ $product->quantity }}</div>
                                </div>
                            @empty
                                <p class="text-muted">No low stock alerts</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Recent Activities</h5>
                            @forelse($recentActivities ?? [] as $activity)
                                <div class="activity-item">
                                    <div class="d-flex align-items-center">
                                        <i class="{{ $activity->icon ?? 'fas fa-circle' }} me-2"></i>
                                        <div>
                                            <div>{{ $activity->description }}</div>
                                            <small class="text-muted">{{ $activity->created_at }}</small>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No recent activities</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleActions');
            const container = document.querySelector('.quick-actions-container');
            const icon = toggleBtn.querySelector('i');
            let isCollapsed = false;

            // Set initial height
            container.style.maxHeight = container.scrollHeight + "px";

            toggleBtn.addEventListener('click', function() {
                isCollapsed = !isCollapsed;
                
                if (isCollapsed) {
                    container.style.maxHeight = "0px";
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    container.style.maxHeight = container.scrollHeight + "px";
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });

            // Add hover effect
            const actionBtns = document.querySelectorAll('.action-btn');
            actionBtns.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved.
    </footer>
</body>
</html>
