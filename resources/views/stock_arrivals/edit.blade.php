<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stock Arrival</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="icon" type="image" href="{{ asset('Images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/Stock_arrivals/edit.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="logo-text">
                <span>Gestion</span>
                <span>Stock</span>
                <span>Web</span>
            </div>
            <a href="{{ route('stock-arrivals.index') }}" class="back-btn ms-auto"><i class="fas fa-arrow-left me-2"></i>
                Back</a>
        </div>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="edit-card">
                    <div class="form-section">
                        <h1 class="stock-arrivals-title">Edit Stock Arrival</h1>

                        <div class="arrival-meta mb-4">
                            <div class="meta-item">
                                <span class="meta-label">Arrival ID:</span>
                                <span>{{ $stockArrival->id }}</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Created At:</span>
                                <span>{{ \Carbon\Carbon::parse($stockArrival->created_at)->format('M d, Y H:i') }}</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Last Updated:</span>
                                <span>{{ \Carbon\Carbon::parse($stockArrival->updated_at)->format('M d, Y H:i') }}</span>
                            </div>
                        </div>

                        <form id="stockArrivalForm" action="{{ route('stock-arrivals.update', $stockArrival->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-4">
                                <label for="supplier_id" class="form-label">Supplier <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" id="supplier_id" name="supplier_id" required>
                                    <option value="">Select a supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" data-contact="{{ $supplier->contact_info }}"
                                            {{ $stockArrival->supplier_id == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="supplier-info mt-2">
                                    <div class="info-title">Contact Information:</div>
                                    <div id="supplierContact" class="text-muted">
                                        {{ $stockArrival->supplier->contact_info ?? '' }}</div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="product_id" class="form-label">Product <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" id="product_id" name="product_id" required>
                                    <option value="">Select a product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            data-category="{{ $product->category->name ?? 'N/A' }}"
                                            data-price="{{ number_format($product->price, 2) }}"
                                            data-stock="{{ $product->quantity }}"
                                            {{ $stockArrival->product_id == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} (Current Stock: {{ $product->quantity }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="product-info mt-2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-title">Category:</div>
                                            <div id="productCategory" class="text-muted">
                                                {{ $stockArrival->product->category->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-title">Price:</div>
                                            <div id="productPrice" class="text-muted">
                                                {{ number_format($stockArrival->product->price ?? 0, 2) }} DH
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-title">Current Stock:</div>
                                            <div id="productStock" class="text-muted">
                                                {{ $stockArrival->product->quantity ?? 0 }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="quantity" class="form-label">Quantity <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    min="1" value="{{ old('quantity', $stockArrival->quantity) }}" required>
                                <small class="text-muted">Enter the number of units received</small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="arrival_date" class="form-label">Arrival Date <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control datepicker" id="arrival_date"
                                    name="arrival_date"
                                    value="{{ old('arrival_date', $stockArrival->arrival_date) }}" required>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h5 class="alert-heading">Error!</h5>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href='{{ route('stock-arrivals.index') }}'">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-warning text-white">
                                    <i class="fas fa-save me-2"></i> Update Arrival
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved.
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });

            // Initialize datepicker
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                defaultDate: "{{ $stockArrival->arrival_date }}",
                maxDate: "today"
            });

            // Show supplier info if supplier is selected
            @if ($stockArrival->supplier_id)
                $('.supplier-info').show();
            @endif

            // Show product info if product is selected
            @if ($stockArrival->product_id)
                $('.product-info').show();
            @endif

            // Supplier selection change
            $('#supplier_id').on('change', function() {
                const selectedOption = $(this).find('option:selected');
                const contactInfo = selectedOption.data('contact');

                if (contactInfo) {
                    $('.supplier-info').fadeIn();
                    $('#supplierContact').text(contactInfo);
                } else {
                    $('.supplier-info').fadeOut();
                    $('#supplierContact').text('');
                }
            });

            // Product selection change
            $('#product_id').on('change', function() {
                const selectedOption = $(this).find('option:selected');
                const category = selectedOption.data('category');
                const price = selectedOption.data('price');
                const stock = selectedOption.data('stock');

                if (category || price || stock) {
                    $('.product-info').fadeIn();
                    $('#productCategory').text(category || 'N/A');
                    $('#productPrice').text((price && price !== '0.00') ? price + ' DH' : 'N/A');
                    $('#productStock').text(stock || '0');
                } else {
                    $('.product-info').fadeOut();
                }
            });

            // Form submission handling
            $('#stockArrivalForm').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');
                const originalText = submitBtn.html();

                // Show loading state
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Updating...');

                // Submit form via AJAX
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Stock arrival has been updated successfully.',
                            icon: 'success',
                            confirmButtonColor: '#3498db',
                        }).then((result) => {
                            window.location.href =
                                "{{ route('stock-arrivals.index') }}";
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = '';
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors) {
                                errorMessage += errors[key][0] + '\n';
                            }
                        }

                        Swal.fire({
                            title: 'Error!',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonColor: '#e74c3c',
                        });
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false);
                        submitBtn.html(originalText);
                    }
                });
            });

            // Quantity validation
            $('#quantity').on('input', function() {
                if ($(this).val() < 1) {
                    $(this).val(1);
                }
            });
        });
    </script>
</body>

</html>
