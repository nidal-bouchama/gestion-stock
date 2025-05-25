<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="icon" type="image" href="{{ asset('Images/logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
        }

        body {
                background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
        url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .top-nav {
            background: var(--primary-color);
            padding: 1rem;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .main-content {
            flex: 1;
            padding: 2rem 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1rem;
        }

        .form-label {
            font-weight: 500;
            color: #2c3e50;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }

        .form-control,
        .form-select {
            border-left: none;
            padding: 0.6rem;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: #34495e;
            transform: translateY(-2px);
        }

        .image-preview {
            max-width: 200px;
            border-radius: 10px;
            margin-top: 1rem;
        }

        footer {
            background: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
        }

        .btn-back {
            background: #95a5a6;
            color: white;
            border: none;
        }

        .btn-back:hover {
            background: #7f8c8d;
        }

        .top-buttons {
            display: flex;
            gap: 1rem;
        }
    </style>
</head>

<body>
    <!-- Top Navigation -->
    <nav class="top-nav d-flex justify-content-between align-items-center">
        <div class="logo-text">
            <span>Gestion</span>
            <span>Stock</span>
            <span>Web</span>
        </div>
        <div class="top-buttons">
            <a href="{{ route('products.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-plus-circle me-2"></i>Add New Product
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form id="productForm" action="{{ route('products.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Product Name *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Category *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-folder"></i></span>
                                        <select class="form-select" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Price *</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            <input type="number" step="0.01" class="form-control" name="price"
                                                required>
                                            <span class="input-group-text">DH</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Quantity *</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                            <input type="number" class="form-control" name="quantity" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Product Image</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        <input type="file" class="form-control" name="image" id="image"
                                            accept="image/*">
                                    </div>
                                    <div id="imagePreview"></div>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Save Product
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; 2025 Gestion Stock Web. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview functionality
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `
                            <img src="${e.target.result}" class="image-preview mt-3" alt="Preview">
                        `;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Form validation
            const form = document.getElementById('productForm');
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                        // Create error message if it doesn't exist
                        if (!field.nextElementSibling?.classList.contains('invalid-feedback')) {
                            const feedback = document.createElement('div');
                            feedback.className = 'invalid-feedback';
                            feedback.textContent = 'This field is required';
                            field.parentNode.appendChild(feedback);
                        }
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });

            // Remove validation styling on input
            const inputs = form.querySelectorAll('.form-control, .form-select');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                    const feedback = this.nextElementSibling;
                    if (feedback?.classList.contains('invalid-feedback')) {
                        feedback.remove();
                    }
                });
            });
        });
    </script>
</body>

</html>
