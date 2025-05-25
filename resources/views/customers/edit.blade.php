<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customers</title>
    <link rel="icon" type="image" href="{{ asset('Images/logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Customers/Edit.css') }}">
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
            background: #e74c3c;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: #c0392b;
            color: white;
            box-shadow: 0 0 10px rgba(231, 76, 60, 0.8);
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
            <a href="{{ route('customers.index') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
            <a href="#" class="logout-btn"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="main-content">
        <div class="card edit-card">
            <div class="card-header">
                <h2><i class="fas fa-user-edit me-2"></i>Edit Customer</h2>
                <div>
                    <span class="badge bg-primary">ID: {{ $customer->id }}</span>
                    <span class="badge bg-secondary ms-2">Created: {{ $customer->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            <div class="form-section">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> Please correct the following errors:
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form id="editCustomerForm" action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $customer->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                id="address" name="address" value="{{ old('address', $customer->address) }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Gestion Stock Web. All rights reserved.
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Form submission handling
            $('#editCustomerForm').on('submit', function(e) {
                const submitBtn = $('#submitBtn');
                submitBtn.prop('disabled', true);
                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'
                );

                // Validate required fields
                const nameInput = $('#name');
                if (!nameInput.val().trim()) {
                    e.preventDefault();
                    nameInput.addClass('is-invalid');
                    submitBtn.prop('disabled', false);
                    submitBtn.html('<i class="fas fa-save me-1"></i> Save Changes');
                    return;
                }
            });

            // Remove validation errors when typing
            $('.form-control').on('input', function() {
                $(this).removeClass('is-invalid');
            });

            // Phone number formatting
            $('#phone').on('input', function() {
                this.value = this.value.replace(/[^0-9+]/g, '');
            });

            // Focus the first field with error or the first field
            @if ($errors->any())
                $('input.is-invalid').first().focus();
            @else
                $('#name').focus();
            @endif
        });
    </script>
</body>

</html>
