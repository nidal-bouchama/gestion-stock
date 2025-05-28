<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image" href="{{ asset('Images/logo.svg') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: rgb(44, 62, 80);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        .navbar a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 20px;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .navbar a:hover {
            color: #ffc107;
            background-color: rgba(255,255,255,0.1);
        }
        
        .navbar a.active {
            background-color: rgba(40,167,69,0.2);
            color: #28a745;
        }
        
        .logout-btn {
            background-color: #dc3545;
            color: white !important;
            font-weight: bold;
            padding: 8px 15px !important;
            border-radius: 20px;
            transition: all 0.3s ease;
            margin-left: auto;
        }
        
        .logout-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .logo-text {
            font-weight: bold;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            margin-right: 30px;
        }
        
        .logo-text span:first-child { color: rgb(193, 0, 0); }
        .logo-text span:nth-child(2) { color: white; }
        .logo-text span:last-child { color: #2ecc71; }

        .main-content {
            margin-top: 30px;
            padding: 20px;
            margin-bottom: 60px;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .profile-header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 20px;
            position: relative;
        }

        .profile-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .profile-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .profile-image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-image-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }

        .image-upload-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-upload-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .save-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .save-btn:hover {
            background-color: #219653;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3);
        }

        .cancel-btn {
            background-color: #95a5a6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .cancel-btn:hover {
            background-color: #7f8c8d;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(149, 165, 166, 0.3);
        }

        footer {
            background-color: rgb(44, 62, 80);
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 100;
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
        <a href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i> Home</a>
        <a href="{{ route('products.browse') }}"><i class="fas fa-box me-1"></i> Products</a>
        <a href="{{ route('user.cart') }}"><i class="fas fa-shopping-cart me-1"></i> Cart</a>
        <a href="{{ route('user.profile') }}" class="active"><i class="fas fa-user me-1"></i> Profile</a>
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="main-content">
        <div class="container">
            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

            <div class="profile-card">
                <div class="profile-header">
                    <h2 class="profile-title"><i class="fas fa-user-edit me-2"></i> Edit Profile</h2>
                </div>

                <div class="profile-body">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="profile-image-container">
                            <img src="{{ Auth::user()->profile_image_url }}" alt="{{ Auth::user()->name }}" class="profile-image-preview" id="profile-image-preview">
                            <div>
                                <input type="file" id="profile-image" name="profile_image" style="display: none;" accept="image/*">
                                <button type="button" class="image-upload-btn" onclick="document.getElementById('profile-image').click()">
                                    <i class="fas fa-camera me-2"></i> Change Profile Picture
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                            <small class="text-muted">Email cannot be changed</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                            @error('phone')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <textarea id="address" name="address" class="form-control" rows="3">{{ Auth::user()->address }}</textarea>
                            @error('address')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('user.profile') }}" class="cancel-btn">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                            <button type="submit" class="save-btn">
                                <i class="fas fa-save me-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image preview functionality
        document.getElementById('profile-image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profile-image-preview').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>