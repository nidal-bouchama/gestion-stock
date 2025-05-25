<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
        }

        .navbar {
            background-color: rgb(44, 62, 80);
            padding: 1rem 2rem;
        }

        .logo-text {
            font-weight: bold;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            margin-right: 30px;
        }

        .logo-text span:first-child {
            color: rgb(193, 0, 0);
        }

        .logo-text span:nth-child(2) {
            color: white;
        }

        .logo-text span:last-child {
            color: #2ecc71;
        }

        .main-content {
            margin: 2rem 0;
            flex: 1;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: rgb(44, 62, 80);
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
        }

        /* Add these new styles */
        .split-layout {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 2rem;
            padding: 2rem;
        }

        .form-panel {
            position: sticky;
            top: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
            height: fit-content;
        }

        .form-panel:hover {
            transform: translateY(-5px);
        }

        .list-panel {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }

        .form-control {
            border-left: none;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .btn-submit {
            background: linear-gradient(45deg, #2ecc71, #27ae60);
            border: none;
            width: 100%;
            padding: 0.8rem;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
        }

        @media (max-width: 992px) {
            .split-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar">
        <div class="logo-text">
            <span>Gestion</span>
            <span>Stock</span>
            <span>Web</span>
        </div>
        <div class="ms-auto">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light me-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('logout') }}" class="btn btn-danger"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="split-layout">
        <!-- Add Category Form -->
        <div class="form-panel">
            <h4 class="mb-4">
                <i class="fas fa-plus-circle text-success"></i> Add New Category
            </h4>
            <form id="categoryForm" action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Category Name</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-folder text-primary"></i>
                        </span>
                        <input type="text" class="form-control" name="name" id="name" required
                            placeholder="Enter category name">
                    </div>
                    <div class="invalid-feedback">Please enter a category name.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Description</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-align-left text-secondary"></i>
                        </span>
                        <textarea class="form-control" name="description" id="description" rows="3"
                            placeholder="Enter category description"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-submit" id="submitBtn">
                    <i class="fas fa-save me-2"></i> Save Category
                </button>
            </form>
        </div>

        <!-- Categories List -->
        <div class="list-panel">
            <h4 class="mb-4">
                <i class="fas fa-list text-primary"></i> Categories List
            </h4>
            <div class="table-responsive">
                <table id="categoriesTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Products</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                <i class="fas fa-folder me-2 text-warning"></i>
                                {{ $category->name }}
                            </td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $category->products_count ?? 0 }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $category->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $category->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; {{ date('Y') }} Gestion Stock Web. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable with improved performance
            const table = $('#categoriesTable').DataTable({
                pageLength: 10,
                ordering: true,
                searching: true,
                responsive: true,
                processing: true,
                dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center"ip>',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search categories...",
                    lengthMenu: "Show _MENU_ entries",
                },
                initComplete: function() {
                    $('.dataTables_filter input').addClass('form-control-sm');
                    $('.dataTables_length select').addClass('form-select-sm');
                }
            });

            // Form validation and submission
            const form = $('#categoryForm');
            const submitBtn = $('#submitBtn');

            form.on('submit', function(e) {
                e.preventDefault();

                const nameInput = $('#name');
                if (!nameInput.val().trim()) {
                    nameInput.addClass('is-invalid');
                    return;
                }

                submitBtn.prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin me-2"></i> Saving...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        table.ajax.reload();
                        form[0].reset();
                        submitBtn.html('<i class="fas fa-check me-2"></i> Saved!')
                            .removeClass('btn-primary').addClass('btn-success');

                        setTimeout(() => {
                            submitBtn.prop('disabled', false)
                                .html('<i class="fas fa-save me-2"></i> Save Category')
                                .removeClass('btn-success').addClass('btn-primary');
                        }, 2000);
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false)
                            .html('<i class="fas fa-save me-2"></i> Save Category');
                        alert('Error saving category: ' + xhr.responseText);
                    }
                });
            });

            // Real-time validation
            $('#name').on('input', function() {
                $(this).removeClass('is-invalid');
            });

            // Delete handler
            $('.delete-btn').on('click', function() {
                const categoryId = $(this).data('id');
                if (confirm('Are you sure you want to delete this category?')) {
                    $.post(`/categories/${categoryId}`, {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    }).done(function() {
                        window.location.reload();
                    }).fail(function() {
                        alert('Error deleting category');
                    });
                }
            });

            // Edit handler
            $('.edit-btn').on('click', function() {
                const categoryId = $(this).data('id');
                window.location.href = `/categories/${categoryId}/edit`;
            });
        });
    </script>
</body>

</html>
