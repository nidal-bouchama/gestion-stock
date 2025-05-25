<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Stock Web - @yield('title', 'Login')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    <link rel="icon" type="image" href="Images/logo.svg">
    <link rel="shortcut icon" type="image" href="Images/logo.svg">
    @yield('styles')
</head>

<body>
    <header>
        <div class="logo">
            <span>Gestion</span>
            <span>Stock</span>
            <span>Web</span>
        </div>
        <div class="back-btn-container">
            <button onclick="window.location.href='/'" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back
            </button>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; 2025 Gestion Stock Web. All rights reserved.
    </footer>

    @yield('scripts')
</body>

</html>
