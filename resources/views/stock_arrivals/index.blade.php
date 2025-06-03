<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Stock Arrivals Management</title>
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" media="print"
        onload="this.media='all'">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"
        media="print" onload="this.media='all'">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.css" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link rel="icon" type="image" href="Images/logo.svg">
    <link rel="stylesheet" href="{{ asset('css/Stock_arrivals/Index.css') }}">
</head>

<body>
    <!-- Loading spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>

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
                    <li><a href="{{ route('orders.index') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                    <li><a href="{{ route('stock-arrivals.index') }}" class="active"><i class="fas fa-dolly"></i> Stock
                            Arrivals</a></li>
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

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card stock-arrivals-card">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-dolly me-2"></i> Stock Arrivals Management</h2>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="{{ route('stock-arrivals.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i> New Arrival
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table id="stockArrivalsTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Arrival Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stockArrivals as $arrival)
                                        <tr>
                                            <td>{{ $arrival->supplier->name ?? 'N/A' }}</td>
                                            <td>{{ $arrival->product->name ?? 'N/A' }}</td>
                                            <td>{{ $arrival->quantity }}</td>
                                            <td>{{ \Carbon\Carbon::parse($arrival->arrival_date)->format('M d, Y') }}
                                            </td>
                                            <td class="action-buttons">
                                                <a href="{{ route('stock-arrivals.edit', $arrival->id) }}"
                                                    class="btn btn-sm btn-warning" data-bs-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('stock-arrivals.destroy', $arrival->id) }}"
                                                    method="POST" class="d-inline delete-arrival-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="tooltip" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a href="#" class="btn btn-sm btn-info view-details"
                                                    data-bs-toggle="tooltip" title="View Details"
                                                    data-id="{{ $arrival->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick Actions Button -->
    <div class="quick-actions-btn" id="quickActionsBtn">
        <i class="fas fa-bolt"></i>
    </div>

    <!-- Quick Actions Menu -->
    <div class="dropdown-menu dropdown-menu-end p-2" id="quickActionsMenu"
        style="position: fixed; bottom: 100px; right: 30px; display: none; min-width: 200px;">
        <button class="dropdown-item" type="button" id="exportExcelBtn">
            <i class="fas fa-file-excel text-success me-2"></i>Export to Excel
        </button>
        <button class="dropdown-item" type="button" id="printTableBtn">
            <i class="fas fa-print text-primary me-2"></i>Print Table
        </button>
        <button class="dropdown-item" type="button" id="refreshDataBtn">
            <i class="fas fa-sync-alt text-info me-2"></i>Refresh Data
        </button>
    </div>

    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved.
    </footer>

    <!-- JavaScript Libraries - Load with defer -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    <!-- Inline JavaScript with performance optimizations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading spinner
            const loadingSpinner = document.getElementById('loadingSpinner');
            loadingSpinner.style.display = 'flex';

            // Quick Actions functionality
            const quickActionsBtn = document.getElementById('quickActionsBtn');
            const quickActionsMenu = document.getElementById('quickActionsMenu');
            
            // Toggle menu on quick actions button click
            quickActionsBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                quickActionsMenu.style.display = quickActionsMenu.style.display === 'none' ? 'block' : 'none';
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!quickActionsMenu.contains(e.target) && e.target !== quickActionsBtn) {
                    quickActionsMenu.style.display = 'none';
                }
            });

            // Export to Excel functionality
            document.getElementById('exportExcelBtn').addEventListener('click', function() {
                let table = $('#stockArrivalsTable').DataTable();
                let data = table.data().toArray();
                
                // Create CSV content
                let csvContent = "Supplier,Product,Quantity,Arrival Date\n";
                data.forEach(function(row) {
                    csvContent += row.join(',') + "\n";
                });

                // Create and trigger download
                const blob = new Blob([csvContent], { type: 'text/csv' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.setAttribute('hidden', '');
                a.setAttribute('href', url);
                a.setAttribute('download', 'stock_arrivals.csv');
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            });

            // Print Table functionality
            document.getElementById('printTableBtn').addEventListener('click', function() {
                window.print();
            });

            // Refresh Data functionality
            document.getElementById('refreshDataBtn').addEventListener('click', function() {
                loadingSpinner.style.display = 'flex';
                window.location.reload();
            });

            // Initialize when window loads
            window.addEventListener('load', function() {
                // Hide loading spinner
                loadingSpinner.style.display = 'none';

                // Initialize DataTable
                const table = $('#stockArrivalsTable').DataTable({
                    responsive: true,
                    language: {
                        searchPlaceholder: "Search...",
                    },
                    dom: '<"top"f>rt<"bottom"lip><"clear">'
                });

                // Search functionality
                document.getElementById('searchInput')?.addEventListener('keyup', function() {
                    table.search(this.value).draw();
                });

                // Delete confirmation with SweetAlert
                $('.delete-arrival-form').on('submit', function(e) {
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
                            // Show loading spinner
                            loadingSpinner.style.display = 'flex';
                            form.submit();
                        }
                    });
                });

                // Success notifications
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

            // Service worker registration for PWA capabilities
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/service-worker.js').then(
                        function(registration) {
                            console.log('ServiceWorker registration successful');
                        },
                        function(err) {
                            console.log('ServiceWorker registration failed: ', err);
                        }
                    );
                });
            }
        });
    </script>
</body>

</html>
