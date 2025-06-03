<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Categories/Index.css') }}">
</head>

<body>
    <!-- Header -->
    <nav class="navbar">
        <div class="logo-text">
            <span>Gestion</span>
            <span>Stock</span>
            <span>Web</span>
        </div>
        <div class="nav-buttons">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
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
                        @foreach ($categories as $category)
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
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
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
    <script src="asset{{('js/IndexCategorie
    .js')}}"></script>
</body>

</html>
