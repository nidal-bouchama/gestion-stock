<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="icon" type="image" href="{{ asset('Images/logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Product/Edit.css') }}">
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
        }

        .navbar {
            background: var(--primary-color);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .logo-text span:first-child {
            color: var(--accent-color);
        }

        .logo-text span:nth-child(2) {
            color: white;
        }

        .logo-text span:last-child {
            color: var(--success-color);
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-back {
            background: #95a5a6;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: #7f8c8d;
            color: white;
        }

        .logout-btn {
            background: var(--accent-color);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: #c0392b;
            color: white;
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
        <div class="nav-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
            <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </a>
        </div>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <div class="container mt-4">
        <div class="card product-edit-card shadow-sm">
            <div class="row g-0">
                <!-- Product Image Column -->
                <div class="col-md-5">
                    <div class="product-image-container">
                        <img src="{{ $product->image_url ?? asset('Images/default-product.png') }}" alt="Product Image" class="product-image img-fluid" id="product-image-preview" onerror="this.onerror=null;this.src='{{ asset('Images/default-product.png') }}';">
                        <div class="mt-3">
                            <input type="file" id="image-upload" style="display: none;" accept="image/*" name="image">
                            <button type="button" class="image-upload-btn" onclick="document.getElementById('image-upload').click()">
                                <i class="fas fa-camera me-2"></i> Upload Image
                            </button>
                        </div>
                        <div class="product-meta">
                            <div class="meta-item">
                                <i class="fas fa-barcode"></i> REF: {{ $product->id ?? 'N/A' }}
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i> Date: {{ date('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Column -->
                <div class="col-md-7">
                    <div class="form-container">
                        <h2 class="card-title">Edit Product</h2>
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name product</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price (DH)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">DH</span>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">-- Select a category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Changes</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fas fa-times me-1"></i> Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm the suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image preview functionality
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('product-image-preview').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const price = document.getElementById('price').value;
            if (price <= 0) {
                alert('Le prix doit être supérieur à 0');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>