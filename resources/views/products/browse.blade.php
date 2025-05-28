e<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image" href="Images/logo.svg">
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

        .product-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .product-item {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.12);
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 10px 0;
            color: #2c3e50;
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

        .category-filter {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .category-btn {
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .category-btn.active {
            background-color: #2c3e50;
            border-color: #2c3e50;
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
        <a href="{{ route('products.browse') }}" class="active"><i class="fas fa-box me-1"></i> Products</a>
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="main-content">
        <div class="container">
            <!-- Category Filter -->
            <div class="category-filter">
                <h5 class="mb-3"><i class="fas fa-filter me-2"></i>Filter by Category</h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary category-btn active" data-category="all">All</button>
                    @foreach($categories ?? [] as $category)
                        <button class="btn btn-sm btn-outline-primary category-btn" data-category="{{ $category->id }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchProduct" placeholder="Search products...">
                </div>
            </div>

            <!-- Products Grid -->
            <div class="card product-card">
                <div class="card-header">
                    <h5><i class="fas fa-box me-2"></i>Available Products</h5>
                </div>
                <div class="card-body">
                    <div class="row" id="productsContainer">
                        @forelse($products ?? [] as $product)
                            <div class="col-md-4 col-lg-3 mb-4 product-item-wrapper" data-category="{{ $product->category_id ?? 'none' }}">
                                <div class="product-item">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="mb-2" 
                                        style="max-width: 150px; max-height: 150px;"
                                        onerror="this.onerror=null;this.src='{{ asset('Images/default-product.png') }}';">
                                    <h5 class="product-name">{{ $product->name }}</h5>
                                    <p class="text-muted small">{{ Str::limit($product->description, 60) }}</p>
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <span class="badge bg-primary rounded-pill">{{ $product->price }} DH</span>
                                        <span class="badge bg-secondary rounded-pill">Stock: {{ $product->quantity }}</span>
                                    </div>
                                    
                                    <div class="mt-3 w-100">
                                        <form action="{{ route('user.cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-success btn-sm w-100" {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                                <i class="fas fa-cart-plus me-1"></i> Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> No products found.
                                </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Product search functionality
            const searchInput = document.getElementById('searchProduct');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const productWrappers = document.querySelectorAll('.product-item-wrapper');

                    productWrappers.forEach(wrapper => {
                        const productName = wrapper.querySelector('.product-name').textContent.toLowerCase();
                        const productDescription = wrapper.querySelector('p').textContent.toLowerCase();
                        
                        if (productName.includes(searchTerm) || productDescription.includes(searchTerm)) {
                            wrapper.style.display = '';
                        } else {
                            wrapper.style.display = 'none';
                        }
                    });
                });
            }

            // Category filter functionality
            const categoryButtons = document.querySelectorAll('.category-btn');
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    categoryButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    const category = this.getAttribute('data-category');
                    const productWrappers = document.querySelectorAll('.product-item-wrapper');
                    
                    productWrappers.forEach(wrapper => {
                        if (category === 'all' || wrapper.getAttribute('data-category') === category) {
                            wrapper.style.display = '';
                        } else {
                            wrapper.style.display = 'none';
                        }
                    });
                });
            });

            // Product hover effects
            const productItems = document.querySelectorAll('.product-item');
            productItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 8px 16px rgba(0,0,0,0.12)';
                });

                item.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '0 4px 8px rgba(0,0,0,0.08)';
                });
            });
        });
    </script>
</body>
</html>