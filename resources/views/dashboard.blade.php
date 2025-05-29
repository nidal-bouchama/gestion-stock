<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image" href="Images/logo.svg">
    {{-- <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> --}} {{-- Assuming styles are moved inline --}}

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif; /* Match Accueil font */
        }

        html, body {
            height: 100%; /* Ensure html and body take full height */
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('{{ asset('Images/background-img.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Use min-height for sticky footer */
            color: #2c3e50; /* Match Accueil text color */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header styles matching Accueil */
        header {
            background: #5d87b7;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2px 0; /* Match Accueil padding */
        }

        .logo-text { /* Renamed from .logo in Accueil, but styles match */
            font-weight: bold;
            font-size: 1.5rem;
            display: flex; /* Ensure spans are inline-flex */
            align-items: center;
        }

        .logo-text span:first-child {
            color: #e74c3c; /* Match Accueil color */
        }

        .logo-text span:nth-child(2) {
            color: white;
        }

        .logo-text span:last-child {
            color: white; /* Match Accueil color */
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
            margin: 0; /* Remove default ul margin */
            padding: 0; /* Remove default ul padding */
        }

        .nav-links li {
            display: inline-block; /* Ensure list items are inline */
        }

        .nav-links a {
            color: #2c3e50; /* Match Accueil color */
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            padding: 8px 12px; /* Add some padding for click area */
            border-radius: 4px;
        }

        .nav-links a:hover {
            color: #e74c3c;
        }

        .nav-links a.active { /* Style for active link */
             color: #e74c3c;
             /* Optional: add a subtle background or border */
             /* background-color: rgba(231, 76, 60, 0.1); */
        }

        .logout-btn { /* Styled to match .register-btn, .login-btn in Accueil */
            background: #e74c3c !important; /* Use !important to override bootstrap */
            color: #fff !important;
            padding: 7px 18px !important; /* Use !important to override bootstrap */
            border-radius: 20px !important; /* Use !important to override bootstrap */
            transition: background 0.2s;
            font-weight: 500; /* Match Accueil font-weight */
        }

        .logout-btn:hover {
            background: #c0392b !important; /* Use !important to override bootstrap */
            color: #fff !important;
        }


        .main-content {
            margin-top: 30px;
            padding: 20px;
            flex-grow: 1; /* Allow main content to grow and push footer down */
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .dashboard-title {
            font-weight: 700;
            color: #2c3e50;
        }

        .dashboard-welcome {
            color: #636e72;
        }

        .stats-card {
            background: linear-gradient(135deg, #2980b9, #3498db);
            color: white;
        }

        .stats-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .stats-number {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .card-title {
            font-weight: 700;
            color: #34495e;
        }

        .quick-action {
            transition: all 0.3s ease; /* Added ease */
            border: none;
            position: relative;
            overflow: hidden;
        }

        .quick-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .action-icon {
            background: rgba(255, 255, 255, 0.2);
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
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .quick-actions-container,
        .low-stock-container { /* Apply transition to both containers */
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .quick-actions-container.collapsed,
        .low-stock-container.collapsed { /* Apply collapsed class to both */
            max-height: 0 !important; /* Use !important to ensure collapse */
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


        /* Footer styles matching Accueil */
        footer {
            background: #222 !important; /* Use !important to override bootstrap */
            color: #fff;
            text-align: center;
            padding: 25px 0 15px 0;
            font-size: 1rem;
            margin-top: auto; /* Push footer to the bottom */
            width: 100%;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px 5px; /* Adjusted padding */
            }
            .nav-links {
                gap: 15px; /* Reduce gap on smaller screens */
            }
            .nav-links a {
                padding: 5px 8px; /* Reduce padding on smaller screens */
            }
            .logout-btn {
                 padding: 5px 10px !important; /* Reduce padding on smaller screens */
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo-text">
                    <span>Gestion</span>
                    <span>Stock</span>
                    <span>Web</span>
                </div>
                <ul class="nav-links">
                    <li><a href="{{ route('dashboard') }}" class="active"><i class="fas fa-tachometer-alt"></i> Home</a>
                    </li>
                    <li><a href="{{ route('products.index') }}"><i class="fas fa-box"></i> Products</a></li>
                    <li><a href="{{ route('suppliers.index') }}"><i class="fas fa-truck"></i> Suppliers</a></li>
                    <li><a href="{{ route('customers.index') }}"><i class="fas fa-users"></i> Customers</a></li>
                    <li><a href="{{ route('orders.index') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                    <li><a href="{{ route('stock-arrivals.index') }}"><i class="fas fa-dolly"></i> Stock Arrivals</a>
                    </li>
                    <li>
                        <a href="#" class="logout-btn"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="main-content">
        <div class="container"> {{-- Added container around main content --}}
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
                                    <a href="{{ route('products.create') }}"
                                        class="btn btn-primary quick-action mb-2 action-btn">
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

                                    <a href="{{ route('stock-arrivals.create') }}"
                                        class="btn btn-success quick-action mb-2 action-btn">
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

                                    <a href="{{ route('orders.create') }}"
                                        class="btn btn-info quick-action mb-2 action-btn">
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

                                    <a href="{{ route('categories.create') }}"
                                        class="btn btn-warning quick-action action-btn">
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
                            <h5 class="card-title mb-4">
                                Low Stock Alerts
                                <button class="btn btn-sm btn-outline-secondary float-end" id="toggleLowStock">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </h5>
                            <div class="low-stock-container"> {{-- Removed inline style --}}
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
            // Quick Actions toggle
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
                    container.classList.add('collapsed'); // Add collapsed class
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    container.style.maxHeight = container.scrollHeight + "px";
                     container.classList.remove('collapsed'); // Remove collapsed class
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });

            // Low Stock toggle
            const toggleLowStockBtn = document.getElementById('toggleLowStock');
            const lowStockContainer = document.querySelector('.low-stock-container');
            const lowStockIcon = toggleLowStockBtn.querySelector('i');
            let isLowStockCollapsed = false;

            // Set initial height for low stock container
            lowStockContainer.style.maxHeight = lowStockContainer.scrollHeight + "px";

            toggleLowStockBtn.addEventListener('click', function() {
                isLowStockCollapsed = !isLowStockCollapsed;

                if (isLowStockCollapsed) {
                    lowStockContainer.style.maxHeight = "0px";
                    lowStockContainer.classList.add('collapsed'); // Add collapsed class
                    lowStockIcon.classList.remove('fa-chevron-down');
                    lowStockIcon.classList.add('fa-chevron-up');
                } else {
                    lowStockContainer.style.maxHeight = lowStockContainer.scrollHeight + "px";
                    lowStockContainer.classList.remove('collapsed'); // Remove collapsed class
                    lowStockIcon.classList.remove('fa-chevron-up');
                    lowStockIcon.classList.add('fa-chevron-down');
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
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved. | Designed with nidal
    </footer>
</body>

</html>
