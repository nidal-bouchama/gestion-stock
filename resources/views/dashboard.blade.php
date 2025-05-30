<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image" href="Images/logo.svg">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <span>Gestion</span>
                    <span>Stock</span>
                    <span>Web</span>
                </div>
                <ul class="nav-links">
                    <li><a href="{{ route('dashboard') }}" class="active">
                            <i class="fas fa-tachometer-alt"></i> Home</a>
                    </li>
                    <li><a href="{{ route('products.index') }}">
                            <i class="fas fa-box"></i> Products</a>
                    </li>
                    <li><a href="{{ route('suppliers.index') }}">
                            <i class="fas fa-truck"></i> Suppliers</a>
                    </li>
                    <li><a href="{{ route('customers.index') }}">
                            <i class="fas fa-users"></i> Customers</a>
                    </li>
                    <li><a href="{{ route('orders.index') }}">
                            <i class="fas fa-shopping-cart"></i> Orders</a>
                    </li>
                    <li><a href="{{ route('stock-arrivals.index') }}">
                            <i class="fas fa-dolly"></i> Stock Arrivals</a>
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
