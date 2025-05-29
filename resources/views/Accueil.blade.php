<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Stock Web</title>
    <link rel="icon" type="image" href="Images/logo.svg">
    <link rel="stylesheet" href="{{ asset('css/Accueil.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: #5d87b7;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2px 0;
        }

        .logo span {
            font-weight: bold;
            font-size: 1.5rem;
            color: #e74c3c;
            margin-right: 1px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #e74c3c;
        }

        .register-btn,
        .login-btn {
            background: #e74c3c;
            color: #fff !important;
            padding: 7px 18px;
            border-radius: 20px;
            transition: background 0.2s;
        }

        .register-btn:hover,
        .login-btn:hover {
            background: #c0392b;
        }

        .hero {
            background: linear-gradient(120deg, rgba(231, 76, 60, 0.7) 0%, rgba(52, 152, 219, 0.7) 100%), url('{{ asset('Images/background-img.jpg') }}') no-repeat center center;
            background-size: cover;
            color: #fff;
            padding: 90px 0 70px 0;
            text-align: center;
            position: relative;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 18px;
            font-weight: 700;
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 30px;
        }

        .hero-content .cta-btn {
            background: #fff;
            color: #e74c3c;
            padding: 14px 38px;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
            transition: background 0.2s, color 0.2s;
        }

        .hero-content .cta-btn:hover {
            background: #e74c3c;
            color: #fff;
        }

        .stats-section {
            background: #fff;
            padding: 50px 0;
            display: flex;
            justify-content: center;
            gap: 60px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .stat {
            text-align: center;
        }

        .stat i {
            font-size: 2.5rem;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .stat h3 {
            font-size: 2rem;
            margin: 0;
            color: #2c3e50;
        }

        .stat p {
            color: #555;
            margin: 8px 0 0 0;
            font-size: 1.1rem;
        }

        .features-section {
            background: #f9f9f9;
            padding: 70px 0;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 35px;
        }

        .feature-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            padding: 35px 25px;
            text-align: center;
            transition: transform 0.2s;
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.03);
        }

        .feature-card i {
            font-size: 2.2rem;
            color: #3498db;
            margin-bottom: 15px;
        }

        .feature-card h4 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .feature-card p {
            color: #666;
            font-size: 1rem;
        }

        .about-section {
            padding: 80px 0;
            background: #fff;
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .about-content h3 {
            font-size: 1.7rem;
            color: #2c3e50;
            margin-bottom: 18px;
        }

        .about-content p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.7;
        }

        .testimonials-section {
            background: #f9f9f9;
            padding: 70px 0;
        }

        .testimonials-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .testimonials-header h2 {
            font-size: 2.2rem;
            color: #2c3e50;
        }

        .testimonials-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .testimonial-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            padding: 30px 25px;
            max-width: 340px;
            text-align: center;
        }

        .testimonial-card img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .testimonial-card p {
            color: #555;
            font-size: 1rem;
            margin-bottom: 12px;
        }

        .testimonial-card h5 {
            color: #e74c3c;
            font-size: 1.1rem;
            margin: 0;
        }

        .testimonial-card span {
            color: #888;
            font-size: 0.95rem;
        }

        footer {
            background: #222;
            color: #fff;
            text-align: center;
            padding: 25px 0 15px 0;
            font-size: 1rem;
            margin-top: 40px;
        }
    </style>

<body>
    <!-- Header & Navigation -->
    <header>        <div class="container">
            <nav>
                <div class="logo">
                    <span>Gestion</span>
                    <span>Stock</span>
                    <span>Web</span>
                </div>
                <ul class="nav-links">
                    <li><a href="#about"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="#features"><i class="fas fa-star"></i> Features</a></li>
                    <li><a href="#testimonials"><i class="fas fa-users"></i> Testimonials</a></li>
                    <li><a href="/register"><i class="fas fa-user-pen"></i> Sign Up</a></li>
                    <li><a href="/login"><i class="fas fa-right-to-bracket"></i> Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Empower Your Inventory Management</h1>
            <p>Modern, intuitive, and powerful tools for seamless stock control and business growth.</p>
            <a href="/register" class="cta-btn">Get Started Free <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="stat">
            <i class="fas fa-box"></i>
            <h3>12,000+</h3>
            <p>Products Managed</p>
        </div>
        <div class="stat">
            <i class="fas fa-users"></i>
            <h3>2,500+</h3>
            <p>Active Users</p>
        </div>
        <div class="stat">
            <i class="fas fa-warehouse"></i>
            <h3>50+</h3>
            <p>Warehouses</p>
        </div>
        <div class="stat">
            <i class="fas fa-globe"></i>
            <h3>15</h3>
            <p>Countries Served</p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                <h2 style="font-size: 2.2rem; color: #2c3e50;">Key Features</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-chart-line"></i>
                    <h4>Real-Time Analytics</h4>
                    <p>Monitor your inventory and sales with up-to-date dashboards and smart insights.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-bell"></i>
                    <h4>Automated Alerts</h4>
                    <p>Get instant notifications for low stock, order status, and supplier updates.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>Mobile Friendly</h4>
                    <p>Manage your stock on the go with a responsive and intuitive interface.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-lock"></i>
                    <h4>Secure & Reliable</h4>
                    <p>Advanced security and backup features to keep your data safe and accessible.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 40px;">
                <h2 style="font-size: 2.2rem; color: #2c3e50;">About Us</h2>
            </div>
            <div class="about-content">
                <h3>Our Mission</h3>
                <p>
                    Gestion Stock Web is dedicated to helping businesses of all sizes streamline their inventory
                    processes, reduce costs, and maximize efficiency. Our platform offers real-time tracking, insightful
                    analytics, and seamless integration with your workflow.
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials-section">
        <div class="container">
            <div class="testimonials-header">
                <h2>What Our Clients Say</h2>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client 1">
                    <p>“Gestion Stock Web has transformed the way we manage our inventory. The real-time analytics and
                        alerts are game changers!”</p>
                    <h5>Ali Ben Salah</h5>
                    <span>Operations Manager</span>
                </div>
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client 2">
                    <p>“The platform is intuitive and mobile-friendly. Our team can now track stock from anywhere,
                        anytime.”</p>
                    <h5>Sarah El Amrani</h5>
                    <span>Warehouse Supervisor</span>
                </div>
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Client 3">
                    <p>“Excellent support and robust features. Highly recommended for any business looking to optimize
                        inventory.”</p>
                    <h5>Mohamed Khelifi</h5>
                    <span>Business Owner</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved. | Designed with nidal
    </footer>
</body>

</html>
