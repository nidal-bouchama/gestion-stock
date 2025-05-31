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
        url('..Images/background-img.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }        .navbar {
            background: #5d87b7;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
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
        }        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            width: 100%;
        }

        .card-header {
            background: #5d87b7;
            color: white;
            border-radius: 20px 20px 0 0 !important;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        .card-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.1) 100%);
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }        .input-group {
            width: 100%;
            margin-bottom: 1rem;
            transition: transform 0.2s;
        }

        .input-group:focus-within {
            transform: translateY(-2px);
        }

        .input-group-text {
            background-color: #5d87b7;
            border: 1px solid #5d87b7;
            color: white;
            border-right: none;
            width: 45px;
            justify-content: center;
        }        .form-control,
        .form-select {
            border: 1px solid #e1e8ef;
            padding: 0.65rem;
            height: 42px;
            font-size: 0.95rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            transition: all 0.2s;
            width: 100%;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 3px rgba(93, 135, 183, 0.15);
            border-color: #5d87b7;
        }

        textarea.form-control {
            height: auto;
            width: 100%;
            resize: vertical;
            min-height: 100px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #5d87b7 0%, #4a6c93 100%);
            border: none;
            padding: 0.8rem 2rem;
            transition: all 0.3s;
            width: 100%;
            margin: 1rem 0;
            display: block;
            font-weight: 600;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            font-size: 1rem;
        }.btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #e7557c 0%, #d64d72 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(231, 85, 124, 0.3);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .image-preview {
            max-width: 200px;
            border-radius: 12px;
            margin-top: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .image-preview:hover {
            transform: scale(1.02);
        }

        /* Custom styling for file input */
        input[type="file"] {
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        /* Required field indicator */
        .form-label span.required {
            color: #e7557c;
            margin-left: 4px;
        }

        /* Card body enhanced padding */
        .card-body {
            padding: 2rem !important;
        }footer {
            background: #000 !important;
            color: #fff;
            text-align: center;
            padding: 25px 0 15px 0;
            font-size: 1rem;
            margin-top: 40px;
        }.nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-back {
            color: #2c3e50;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            color: #e74c3c;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo-text">
            <span>Gestion</span>
            <span>Stock</span>
            <span>Web</span>
        </div>
        <div class="nav-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>Back
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5 class="mb-0">
                                <i class="fas fa-plus-circle me-2"></i>Add New Product
                            </h5>
                        </div>
                        <div class="card-body p-4 d-flex flex-column align-items-center">
                            <form id="productForm" action="{{ route('products.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">                                    <label class="form-label">Product Name <span class="required">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        <input type="text" class="form-control" name="name" required placeholder="Enter product name">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Category <span class="required">*</span></label>
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
                                </div>                                <div class="mb-3">
                                    <label class="form-label">Price *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">DH</span>
                                        <input type="number" step="0.01" class="form-control" name="price"
                                            required>

                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Quantity *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                        <input type="number" class="form-control" name="quantity" required>
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
