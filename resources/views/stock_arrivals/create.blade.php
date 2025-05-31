<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock Arrival</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="icon" type="image" href="{{ asset('Images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/stock_arrivals/create.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="logo-text">
                <span>Gestion</span>
                <span>Stock</span>
                <span>Web</span>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <a href="{{ route('stock-arrivals.index') }}" class="back-btn"><i class="fas fa-arrow-left me-2"></i>
                    Back</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card stock-arrivals-card">
                    <div class="card-body p-4">
                        <h1 class="stock-arrivals-title">Add Stock Arrivals</h1>
                        <form id="stockArrivalForm" action="{{ route('stock-arrivals.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="supplier_id" class="form-label">Supplier <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" id="supplier_id" name="supplier_id" required>
                                    <option value="">Select a supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            data-contact="{{ $supplier->contact_info }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                <div class="supplier-info mt-2">
                                    <div class="info-title">Contact Information:</div>
                                    <div id="supplierContact" class="text-muted"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="product_id" class="form-label">Product <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" id="product_id" name="product_id" required>
                                    <option value="">Select a product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            data-category="{{ $product->category->name ?? 'N/A' }}"
                                            data-price="{{ number_format($product->price, 2) }}"
                                            data-stock="{{ $product->quantity }}">
                                            {{ $product->name }} (Current Stock: {{ $product->quantity }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="product-info mt-2">
                                    <div>
                                        <div class="mb-2">
                                            <div class="info-title">Category:</div>
                                            <div id="productCategory" class="text-muted"></div>
                                        </div>
                                        <div class="mb-2">
                                            <div class="info-title">Price:</div>
                                            <div id="productPrice" class="text-muted"></div>
                                        </div>
                                        <div>
                                            <div class="info-title">Current Stock:</div>
                                            <div id="productStock" class="text-muted"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="quantity" class="form-label">Quantity <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                                    value="{{ old('quantity') }}" required>
                                <small class="text-muted">Enter the number of units received</small>
                            </div>

                            <div class="mb-4">
                                <label for="arrival_date" class="form-label">Arrival Date <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control datepicker" id="arrival_date"
                                    name="arrival_date" value="{{ old('arrival_date', date('Y-m-d')) }}" required>
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
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i> Add Arrival
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
                defaultDate: "today",
                maxDate: "today"
            });

            // Supplier selection change
            $('#supplier_id').on('change', function() {
                const selectedOption = $(this).find('option:selected');
                const contactInfo = selectedOption.data('contact');

                if (contactInfo) {
                    $('.supplier-info').fadeIn();
                    $('#supplierContact').text(contactInfo);
                } else {
                    $('.supplier-info').fadeOut();
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
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Processing...');

                // Submit form via AJAX
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Stock arrival has been added successfully.',
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