<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .dashboard-card {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 12px;
            transition: transform 0.2s;
            margin-bottom: 20px;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .welcome-section {
            text-align: center;
            padding: 40px 20px;
            color: white;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .welcome-section p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .card-title {
            font-weight: 700;
            color: #34495e;
        }

        .product-item {
            padding: 15px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .product-image {
            width: 100%;
            height: 150px;
            object-fit: contain;
            margin-bottom: 10px;
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
        <a href="{{ route('user.dashboard') }}" class="active"><i class="fas fa-tachometer-alt me-1"></i> Home</a>
        <a href="{{ route('products.browse') }}"><i class="fas fa-box me-1"></i> Products</a>
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="welcome-section">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>Browse our product catalog and explore what we have to offer.</p>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <!-- Featured Products -->
                <div class="col-12">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><i class="fas fa-star me-2"></i>Featured Products</h5>
                            
                            <div class="row">
                                @forelse($featuredProducts ?? [] as $product)
                                    <div class="col-md-4 mb-4">
                                        <div class="product-item">
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image"
                                                onerror="this.onerror=null;this.src='{{ asset('Images/default-product.png') }}';">
                                            <h5>{{ $product->name }}</h5>
                                            <p class="text-muted small">{{ Str::limit($product->description, 60) }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-primary rounded-pill">{{ $product->price }} DH</span>
                                                <span class="badge bg-secondary rounded-pill">Stock: {{ $product->quantity }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i> No featured products available at the moment.
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Updates -->
                <div class="col-12">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><i class="fas fa-bell me-2"></i>Recent Updates</h5>
                            
                            @forelse($recentUpdates ?? [] as $update)
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> {{ $update->message }}
                                    <small class="text-muted d-block mt-1">{{ $update->created_at->diffForHumans() }}</small>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> No recent updates available.
                                </div>
                            @endforelse
                        </div>
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
    </script>
</body>
</html>