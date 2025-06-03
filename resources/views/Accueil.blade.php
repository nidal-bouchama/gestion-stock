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