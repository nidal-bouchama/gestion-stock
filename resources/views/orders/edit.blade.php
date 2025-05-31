<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Order</title>
    <!-- Favicon -->
    <link rel="icon" type="image" href="{{ asset('Images/logo.svg') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/Orders/edit.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg"> <!-- Updated color -->
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="logo-text">
                <span style="color: #e74c3c;">Gestion</span>
                <span style="color: white;">Stock</span>
                <span style="color: #27ae60;">Web</span>
            </div>
            <div>
                <a href="{{ route('orders.index') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="main-content container mt-4">
        <div class="card orders-card">
            <div class="card-body">
                <h4 class="mb-3"><i class="fas fa-edit me-2"></i>Edit Order #{{ $order->id }}</h4>
                <form action="{{ route('orders.update', $order->id) }}" method="POST" id="editOrderForm"
                    class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6 customer-select-container">
                            <label for="customer_id" class="form-label">Customer</label>
                            <select class="form-control select2-customer" id="customer_id" name="customer_id" required>
                                <option value="">Select customer...</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" data-email="{{ $customer->email ?? '' }}"
                                        data-phone="{{ $customer->phone ?? '' }}"
                                        data-address="{{ $customer->address ?? '' }}"
                                        {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a customer.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="order_date" class="form-label">Order Date</label>
                            <input type="text" class="form-control datepicker" id="order_date" name="order_date"
                                value="{{ old('order_date', $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                required>
                            <div class="invalid-feedback">Please select a valid date.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option value="">Select payment method...</option>
                                <option value="cash" {{ $order->payment_method == 'cash' ? 'selected' : '' }}>Cash
                                </option>
                                <option value="credit_card"
                                    {{ $order->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card
                                </option>
                                <option value="bank_transfer"
                                    {{ $order->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer
                                </option>
                                <option value="other" {{ $order->payment_method == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="customer-details alert alert-info mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Email:</strong> <span
                                                id="customer-email">{{ $order->customer->email ?? '-' }}</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Phone:</strong> <span
                                                id="customer-phone">{{ $order->customer->phone ?? '-' }}</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Address:</strong> <span
                                                id="customer-address">{{ $order->customer->address ?? '-' }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <h4 class="mb-3"><i class="fas fa-boxes me-2"></i> Order Items</h4>
                            <div class="table-responsive">
                                <table class="table order-items-table" id="orderItemsTable">
                                    <thead>
                                        <tr>
                                            <th width="40%">Product</th>
                                            <th width="15%">Price</th>
                                            <th width="15%">Quantity</th>
                                            <th width="15%">Total</th>
                                            <th width="15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr class="order-item">
                                                <td>
                                                    <select class="form-control product-select select2-product"
                                                        name="items[{{ $loop->index }}][product_id]" required>
                                                        <option value="">Select product...</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                data-price="{{ $product->price }}"
                                                                data-stock="{{ $product->stock }}"
                                                                {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                                {{ $product->name }} (Stock: {{ $product->stock }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control item-price"
                                                        name="items[{{ $loop->index }}][price]"
                                                        value="{{ old('items.' . $loop->index . '.price', $item->price) }}"
                                                        step="0.01" min="0" required>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control item-quantity"
                                                        name="items[{{ $loop->index }}][quantity]"
                                                        value="{{ old('items.' . $loop->index . '.quantity', $item->quantity) }}"
                                                        min="1" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control item-total"
                                                        value="{{ number_format($item->price * $item->quantity, 2) }}"
                                                        readonly>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-item-btn">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-end mt-2">
                                <button type="button" class="btn btn-success btn-sm" id="addItemBtn">
                                    <i class="fas fa-plus me-1"></i> Add Item
                                </button>
                            </div>
                        </div>

                        <div class="col-md-6 offset-md-6">
                            <div class="total-summary">
                                <h5>Order Summary</h5>
                                <div class="total-summary-item">
                                    <span>Subtotal:</span>
                                    <span
                                        id="subtotal">{{ number_format($order->items->sum(function ($item) {return $item->price * $item->quantity;}),2) }}</span>
                                </div>
                                <div class="total-summary-item">
                                    <span>Tax ({{ $order->tax_rate ?? 0 }}%):</span>
                                    <span
                                        id="taxAmount">{{ number_format(($order->items->sum(function ($item) {return $item->price * $item->quantity;}) *($order->tax_rate ?? 0)) /100,2) }}</span>
                                </div>
                                <div class="total-summary-item">
                                    <span>Discount:</span>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="discount" name="discount"
                                            value="{{ old('discount', $order->discount ?? 0) }}" step="0.01"
                                            min="0">
                                        <span class="input-group-text">DH</span>
                                    </div>
                                </div>
                                <div class="total-summary-item">
                                    <span>Shipping:</span>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="shipping" name="shipping"
                                            value="{{ old('shipping', $order->shipping ?? 0) }}" step="0.01"
                                            min="0">
                                        <span class="input-group-text">DH</span>
                                    </div>
                                </div>
                                <div class="total-summary-item total">
                                    <span>Total:</span>
                                    <span id="grandTotal">DH{{ number_format($order->total_amount, 2) }}</span>
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

                        <div class="col-12 mt-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button type="button" class="btn btn-danger me-2" id="cancelOrderBtn"
                                        {{ $order->status == 'cancelled' ? 'disabled' : '' }}>
                                        <i class="fas fa-times me-1"></i> Cancel Order
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved.
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for customer selection
            $('.select2-customer').select2({
                placeholder: "Search customer...",
                allowClear: true,
                width: '100%',
                minimumInputLength: 1
            });

            // Initialize Select2 for product selection
            $('.select2-product').select2({
                placeholder: "Search product...",
                allowClear: true,
                width: '100%',
                minimumInputLength: 1,
                templateResult: function(product) {
                    if (!product.id) return product.text;

                    var stock = $(product.element).data('stock');
                    var stockClass = stock > 0 ? 'text-success' : 'text-danger';

                    return $(
                        '<div>' +
                        '<span>' + product.text.split(' (Stock:')[0] + '</span>' +
                        '<small class="' + stockClass + '"> (Stock: ' + stock + ')</small>' +
                        '</div>'
                    );
                }
            });

            // Initialize date picker
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                defaultDate: "{{ $order->order_date ? $order->order_date : \Carbon\Carbon::now()->format('Y-m-d') }}"
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

            // Trigger change event to show initial customer details
            $('#customer_id').trigger('change');

            // Add new item row
            let itemIndex = {{ $order->items->count() }};
            $('#addItemBtn').click(function() {
                const newRow = `
                    <tr class="order-item">
                        <td>
                            <select class="form-control product-select select2-product" name="items[${itemIndex}][product_id]" required>
                                <option value="">Select product...</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" 
                                        data-price="{{ $product->price }}"
                                        data-stock="{{ $product->stock }}">
                                        {{ $product->name }} (Stock: {{ $product->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control item-price" name="items[${itemIndex}][price]" value="0.00" step="0.01" min="0" required>
                        </td>
                        <td>
                            <input type="number" class="form-control item-quantity" name="items[${itemIndex}][quantity]" value="1" min="1" required>
                        </td>
                        <td>
                            <input type="text" class="form-control item-total" value="0.00" readonly>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm remove-item-btn">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;

                $('#orderItemsTable tbody').append(newRow);
                $('.select2-product').last().select2({
                    placeholder: "Search product...",
                    allowClear: true,
                    width: '100%',
                    minimumInputLength: 1,
                    templateResult: function(product) {
                        if (!product.id) return product.text;

                        var stock = $(product.element).data('stock');
                        var stockClass = stock > 0 ? 'text-success' : 'text-danger';

                        return $(
                            '<div>' +
                            '<span>' + product.text.split(' (Stock:')[0] + '</span>' +
                            '<small class="' + stockClass + '"> (Stock: ' + stock +
                            ')</small>' +
                            '</div>'
                        );
                    }
                });

                itemIndex++;
            });

            // Remove item row
            $(document).on('click', '.remove-item-btn', function() {
                const row = $(this).closest('tr');
                if ($('#orderItemsTable tbody tr').length > 1) {
                    row.fadeOut(300, function() {
                        row.remove();
                        calculateTotals();
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Cannot remove',
                        text: 'An order must have at least one item',
                        timer: 2000
                    });
                }
            });

            // Calculate item total when price or quantity changes
            $(document).on('change input', '.item-price, .item-quantity', function() {
                const row = $(this).closest('tr');
                const price = parseFloat(row.find('.item-price').val()) || 0;
                const quantity = parseInt(row.find('.item-quantity').val()) || 0;
                const total = (price * quantity).toFixed(2);

                row.find('.item-total').val(total);
                calculateTotals();
            });

            // Update price when product is selected
            $(document).on('change', '.product-select', function() {
                const selectedOption = $(this).find('option:selected');
                const price = selectedOption.data('price') || 0;
                const row = $(this).closest('tr');

                row.find('.item-price').val(price).trigger('change');

                // Check stock availability
                const stock = selectedOption.data('stock') || 0;
                const quantityInput = row.find('.item-quantity');

                if (stock <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Out of Stock',
                        text: 'This product is currently out of stock',
                        timer: 2000
                    });
                }

                // Set max quantity based on stock
                quantityInput.attr('max', stock);
            });

            // Calculate discount, shipping and totals
            $(document).on('change input', '#discount, #shipping', function() {
                calculateTotals();
            });

            // Calculate all totals
            function calculateTotals() {
                let subtotal = 0;

                $('.order-item').each(function() {
                    const price = parseFloat($(this).find('.item-price').val()) || 0;
                    const quantity = parseInt($(this).find('.item-quantity').val()) || 0;
                    subtotal += price * quantity;
                });

                const taxRate = {{ $order->tax_rate ?? 0 }};
                const taxAmount = subtotal * taxRate / 100;
                const discount = parseFloat($('#discount').val()) || 0;
                const shipping = parseFloat($('#shipping').val()) || 0;
                const grandTotal = subtotal + taxAmount + shipping - discount;

                $('#subtotal').text('DH' + subtotal.toFixed(2));
                $('#taxAmount').text('DH' + taxAmount.toFixed(2));
                $('#grandTotal').text('DH' + grandTotal.toFixed(2));
            }

            // Cancel order button
            $('#cancelOrderBtn').click(function() {
                Swal.fire({
                    title: 'Cancel Order',
                    text: 'Are you sure you want to cancel this order?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#status').val('cancelled');
                        $('#editOrderForm').submit();
                    }
                });
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
