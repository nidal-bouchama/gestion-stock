<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Orders Management</title>
    <link rel="icon" type="image" href="{{ asset('Images/logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Orders/Index.css') }}">
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
                    <li><a href="{{ route('suppliers.index') }}"><i class="fas fa-truck"></i> Suppliers</a></li>
                    <li><a href="{{ route('customers.index') }}"><i class="fas fa-users"></i> Customers</a></li>
                    <li><a href="{{ route('orders.index') }}" class="active"><i class="fas fa-shopping-cart"></i>
                            Orders</a>
                    </li>
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
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card orders-card">
                        <div class="card-body">
                            <h1 class="mb-4"><i class="fas fa-file-invoice me-2"></i> Order Management</h1>

                            <!-- Create Order Form -->
                            <div class="mb-5">
                                <h3 class="mb-3"><i class="fas fa-plus-circle me-2"></i> Create New Order</h3>
                                <form action="{{ route('orders.store') }}" method="POST" id="orderForm"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6 customer-select-container">
                                            <label for="customer_id" class="form-label">Customer</label>
                                            <select class="form-control select2-customer" id="customer_id"
                                                name="customer_id" required>
                                                <option value="">Search customer...</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        data-phone="{{ $customer->phone ?? '' }}"
                                                        data-address="{{ $customer->address ?? '' }}">
                                                        {{ $customer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a customer.</div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="order_date" class="form-label">Order Date</label>
                                            <input type="text" class="form-control datepicker" id="order_date"
                                                name="order_date"
                                                value="{{ old('order_date', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                                required>
                                            <div class="invalid-feedback">Please select a valid date.</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="customer-details alert alert-info mt-3" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p><strong>Email:</strong> <span id="customer-email">-</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p><strong>Phone:</strong> <span id="customer-phone">-</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p><strong>Address:</strong> <span
                                                                id="customer-address">-</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($errors->any())
                                            <div class="col-12">
                                                <div class="alert alert-danger">
                                                    <ul class="mb-0">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Create Order
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <hr class="my-4">

                            <!-- Orders List -->
                            <div class="mt-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h2><i class="fas fa-list me-2"></i> Orders List</h2>
                                    <div class="search-box">
                                        <i class="fas fa-search"></i>
                                        <input type="text" id="searchOrders" class="form-control"
                                            placeholder="Search orders...">
                                    </div>
                                </div>

                                @if ($orders->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="ordersTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Created</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                                        <td>
                                                            {{ $order->order_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $order->order_date)->format('M d, Y') : 'N/A' }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = 'status-pending';
                                                                if ($order->status === 'completed') {
                                                                    $statusClass = 'status-completed';
                                                                } elseif ($order->status === 'processing') {
                                                                    $statusClass = 'status-processing';
                                                                }
                                                            @endphp
                                                            <span class="status-badge {{ $statusClass }}">
                                                                {{ ucfirst($order->status ?? 'pending') }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                                        <td class="action-buttons">
                                                            <a href="{{ route('orders.edit', $order->id) }}"
                                                                class="btn btn-warning btn-sm"
                                                                data-bs-toggle="tooltip" title="Edit Order">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('orders.destroy', $order->id) }}"
                                                                method="POST" class="d-inline delete-order-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="tooltip" title="Delete Order">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                            <a href="{{ route('orders.show', $order->id) }}"
                                                                class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                                                title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="d-flex justify-content-end mt-3">
                                        {{ $orders->links() }}
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i> No orders found.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved. | Designed with nidal
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for customer selection with search
            $('.select2-customer').select2({
                placeholder: "Search customer...",
                allowClear: true,
                width: '100%',
                minimumInputLength: 1,
                templateResult: function(customer) {
                    if (!customer.id) return customer.text;

                    var $container = $(
                        '<div class="select2-customer-result">' +
                        '<span class="customer-name">' + customer.text.split(' - ')[0] + '</span>' +
                        '<small class="text-muted d-block">' + customer.text.split(' - ')[1] +
                        '</small>' +
                        '</div>'
                    );

                    return $container;
                },
                templateSelection: function(customer) {
                    if (!customer.id) return customer.text;

                    // Show just the name when selected
                    return $('<span>' + customer.text.split(' - ')[0] + '</span>');
                }
            });

            // Initialize date picker
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                defaultDate: "today"
            });

            // Show customer details when a customer is selected
            $('#customer_id').change(function() {
                const selectedOption = $(this).find('option:selected');
                const email = selectedOption.data('email');
                const phone = selectedOption.data('phone');
                const address = selectedOption.data('address');

                if (selectedOption.val()) {
                    $('#customer-email').text(email || '-');
                    $('#customer-phone').text(phone || '-');
                    $('#customer-address').text(address || '-');
                    $('.customer-details').fadeIn();
                } else {
                    $('.customer-details').fadeOut();
                }
            });

            // Form validation
            (function() {
                'use strict';

                var forms = document.querySelectorAll('.needs-validation');

                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }

                            form.classList.add('was-validated');
                        }, false);
                    });
            })();

            // Search functionality
            $('#searchOrders').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('#ordersTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Delete confirmation with SweetAlert
            $('.delete-order-form').on('submit', function(e) {
                e.preventDefault();
                const form = this;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Notification for successful actions
            @if (session('success'))
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
</body>

</html>
