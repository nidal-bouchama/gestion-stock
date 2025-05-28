<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Stock Web - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    <link rel="icon" type="image" href="Images/logo.svg">
    <link rel="shortcut icon" type="image" href="Images/logo.svg">
    <style>
        .btn-back:hover {
            background: #7f8c8d;
            color: yellow;
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="logo-text">
            <span>Gestion</span>
            <span>Stock</span>
            <span>Web</span>
        </div>
        <div class="nav-buttons">
            <a href="/" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
        </div>
    </header>

    <!-- Main Login Form -->
    <main>
        <div class="login-container">
            <div class="login-header">
                <h1>Login</h1>
            </div>

            @if(session('error'))
                <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="example@gmail.com"
                        value="{{ old('email') }}" required autofocus
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="********" required
                            class="form-control @error('password') is-invalid @enderror">
                        <span class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="/forgot-password">Forgot password?</a>
                    </div>
                </div>

                <button type="submit" class="login-button">Login</button>

                <div class="signup-link">
                    Don't have an account? <a href="{{ route('register') }}">Sign up</a>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        &copy; 2025 Gestion Stock Web. All rights reserved.
    </footer>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
