<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers Management</title>
    <link rel="icon" type="image" href="Images/logo.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Suppliers/Index.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                    <li><a href="{{ route('products.index') }}"><i class="fas fa-box"></i> Products</a></li>
                    <li><a href="{{ route('suppliers.index') }}" class="active"><i class="fas fa-truck"></i> Suppliers</a></li>
                    <li><a href="{{ route('customers.index') }}"><i class="fas fa-users"></i> Customers</a></li>
                    <li><a href="{{ route('orders.index') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                    <li><a href="{{ route('stock-arrivals.index') }}"><i class="fas fa-dolly"></i> Stock Arrivals</a></li>
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card suppliers-card">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="fas fa-truck me-2"></i>Suppliers Management</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Add New Supplier</h5>
                                <button class="btn btn-sm btn-outline-secondary" id="toggleFormBtn">
                                    <i class="fas fa-plus me-1"></i> Toggle Form
                                </button>
                            </div>

                            <form action="{{ route('suppliers.store') }}" method="POST" class="mb-4" id="supplierForm" style="display: none;">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Supplier Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="John Doe">
                                        </div>
                                        <div class="mb-3">
                                            <label for="contact_info" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ old('contact_info') }}" placeholder="example@gmail.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="(212) 6 12 34 56 78" value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Save Supplier
                                    </button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Suppliers List</h5>
                                <div class="input-group" style="max-width: 300px;">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search suppliers...">
                                    <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            @if (isset($suppliers) && count($suppliers) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover" id="suppliersTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Phone</th>
                                                <th>Created At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($suppliers as $supplier)
                                                <tr>
                                                    <td>{{ $supplier->name }}</td>
                                                    <td>{{ $supplier->contact_info }}</td>
                                                    <td>{{ $supplier->phone }}</td>
                                                    <td>{{ date('M d, Y', strtotime($supplier->created_at)) }}</td>
                                                    <td class="action-buttons text-center">
                                                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline delete-supplier-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash-alt"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> No suppliers found.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved. | Designed with nidal
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle form visibility
            const toggleFormBtn = document.getElementById('toggleFormBtn');
            const supplierForm = document.getElementById('supplierForm');

            toggleFormBtn.addEventListener('click', function() {
                if (supplierForm.style.display === 'none') {
                    supplierForm.style.display = 'block';
                    toggleFormBtn.innerHTML = '<i class="fas fa-minus me-1"></i> Hide Form';
                } else {
                    supplierForm.style.display = 'none';
                    toggleFormBtn.innerHTML = '<i class="fas fa-plus me-1"></i> Show Form';
                }
            });

            // Delete supplier with SweetAlert2
            document.querySelectorAll('.delete-supplier-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const supplierName = this.closest('tr').querySelector('td:first-child').textContent;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Do you want to delete supplier "${supplierName}"? This action cannot be undone.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="fas fa-trash-alt"></i> Yes, delete it!',
                        cancelButtonText: '<i class="fas fa-times"></i> Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            const tableRows = document.querySelectorAll('#suppliersTable tbody tr');

            function filterSuppliers() {
                const searchTerm = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const nameCell = row.querySelector('td:nth-child(1)');
                    const contactCell = row.querySelector('td:nth-child(2)');
                    const phoneCell = row.querySelector('td:nth-child(3)');
                    
                    const name = nameCell ? nameCell.textContent.toLowerCase() : '';
                    const contact = contactCell ? contactCell.textContent.toLowerCase() : '';
                    const phone = phoneCell ? phoneCell.textContent.toLowerCase() : '';
                    
                    if (name.includes(searchTerm) || contact.includes(searchTerm) || phone.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchBtn.addEventListener('click', filterSuppliers);
            searchInput.addEventListener('keyup', filterSuppliers);

            // Auto-focus on first input when form is shown
            toggleFormBtn.addEventListener('click', function() {
                if (supplierForm.style.display === 'block') {
                    document.getElementById('name').focus();
                }
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
            const navLinks = document.querySelectorAll('.nav-links a:not(.logout-btn)');
            navLinks.forEach(link => {
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
        });
    </script>
</body>
</html>