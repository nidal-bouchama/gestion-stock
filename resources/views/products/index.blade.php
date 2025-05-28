<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link rel="icon" type="image" href="Images/logo.svg" alt="Logo">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Product/Index.css') }}">
</head>

<body>
    <nav class="navbar">
        <div class="logo-text">
            <span>Gestion</span>
            <span>Stock</span>
            <span>Web</span>
        </div>
        <a href="/dashboard"><i class="fas fa-tachometer-alt me-1"></i> Home</a>
        <a href="/products" class="active"><i class="fas fa-box me-1"></i> Products</a>
        <a href="/suppliers"><i class="fas fa-truck me-1"></i> Suppliers</a>
        <a href="/customers"><i class="fas fa-users me-1"></i> Customers</a>
        <a href="/orders"><i class="fas fa-shopping-cart me-1"></i> Orders</a>
        <a href="/stock-arrivals"><i class="fas fa-dolly me-1"></i> Stock Arrivals</a>
        <div class="ms-auto">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="logout-btn"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="fas fa-sign-out-alt me-1"></i> Logout</a>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="row">
            <!-- Products List Card -->
            <div class="col-12">
                <div class="card product-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-list me-2"></i> List of Products
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Product
                            </a>
                            <div class="form-group mb-0">
                                <input type="text" class="form-control form-control-sm" id="searchProduct"
                                    placeholder="Search..." style="width: 200px;">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                        <div class="row" id="productsContainer">
                            @if ($products->count() > 0)
                                @foreach ($products as $product)
                                    <div class="col-md-6 col-lg-4 mb-3 product-item-wrapper">
                                        <div class="product-item">
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                class="mb-2" style="max-width: 200px; max-height: 200px;"
                                                onerror="this.onerror=null;this.src='{{ asset('Images/default-product.png') }}';">
                                            <h5 class="product-name">{{ $product->name }}</h5>
                                            <p class="text-muted small">{{ Str::limit($product->description, 60) }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-primary rounded-pill">{{ $product->price }}
                                                    DH</span>
                                                <span class="badge bg-secondary rounded-pill">Stock:
                                                    {{ $product->quantity }}</span>
                                            </div>
                                            <div class="action-buttons">
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete-confirm"
                                                        data-id="{{ $product->id }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> No products found.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Gestion Stock Web. All rights reserved.
    </footer>

    <!-- Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm the suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Modal -->
    <div class="modal fade" id="categoriesModal" tabindex="-1" aria-labelledby="categoriesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoriesModalLabel">
                        <i class="fas fa-folder me-2"></i>Categories List
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Products Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories ?? [] as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description ?? 'No description' }}</td>
                                        <td>{{ $category->products_count ?? 0 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No categories found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> New Category
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete confirmation functionality
            let productIdToDelete = null;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            
            // Set up event listeners for all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-confirm');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    productIdToDelete = this.getAttribute('data-id');
                    deleteModal.show();
                });
            });
            
            // Handle the confirmation button click
            const confirmDeleteButton = document.getElementById('confirmDelete');
            confirmDeleteButton.addEventListener('click', function() {
                if (productIdToDelete) {
                    // Find the form for this product and submit it
                    const form = document.querySelector(`button[data-id="${productIdToDelete}"]`).closest('form');
                    form.submit();
                }
                deleteModal.hide();
            });

            // Button hover effects with enhanced animations
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '';
                });
            });

            // Navbar links hover effects
            const navbarLinks = document.querySelectorAll('.navbar a:not(.logout-btn)');
            navbarLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = 'rgba(255,255,255,0.1)';
                    }
                });

                link.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = '';
                    }
                });
            });

            // Form input focus effects
            const formInputs = document.querySelectorAll('.form-control');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                    this.parentElement.style.transition = 'transform 0.3s ease';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = '';
                });
            });

            // Product card hover effects
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

            // Search functionality
            const searchInput = document.getElementById('searchProduct');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const productWrappers = document.querySelectorAll('.product-item-wrapper');

                    productWrappers.forEach(wrapper => {
                        const productName = wrapper.querySelector('.product-name').textContent
                            .toLowerCase();
                        if (productName.includes(searchTerm)) {
                            wrapper.style.display = '';
                        } else {
                            wrapper.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>

</body>

</html>
