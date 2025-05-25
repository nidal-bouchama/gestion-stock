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
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <span>Gestion</span>
                    <span>Stock</span>
                    <span>Web</span>
                </div>
                <ul class="nav-links">
                    <li><a href="#about"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="#services"><i class="fas fa-cogs"></i> Services</a></li>
                    <li><a href="/register" class="register-btn"><i class="fas fa-user-plus"></i> Register</a></li>
                    <li><a href="/login" class="login-btn"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Transform Your Inventory Management</h1>
            <p>Suivi, Organisation, Optimisation.</p>
        </div>
    </section>


    <section id="about" class="about-section" style="padding: 80px 0; background-color: #f9f9f9;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                <h2 style="font-size: 2.5rem; color: #2c3e50; position: relative; display: inline-block;">
                    About
                    <span
                        style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background-color: #e74c3c;"></span>
                </h2>
            </div>

            <div class="about-content" style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h3 style="font-size: 1.8rem; color: #2c3e50; margin-bottom: 20px;">Our Mission</h3>
                <p style="font-size: 1.1rem; line-height: 1.6; color: #555;">
                    A stock management website is a digital platform designed to help businesses efficiently track and
                    manage their inventory. It allows users to monitor stock levels, process orders, and streamline
                    supply chain operations. Key features typically include real-time inventory updates, reporting tools
                    for analyzing trends, and alerts for low stock levels. This tool enhances operational efficiency,
                    reduces costs, and supports informed decision-making, ultimately leading to better resource
                    management and increased profitability.
                </p>
                <div class="mission-points"
                    style="display: flex; justify-content: space-around; flex-wrap: wrap; margin-top: 40px;">
                    <div class="point"
                        style="flex: 1; min-width: 200px; margin: 15px; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h4 style="color: #e74c3c; margin-bottom: 10px;">Quality Materials</h4>
                        <p>reliable inventory items that meet standards for durability and performance, ensuring
                            efficient operations and customer satisfaction.</p>
                    </div>
                    <div class="point"
                        style="flex: 1; min-width: 200px; margin: 15px; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h4 style="color: #e74c3c; margin-bottom: 10px;">Customer Focus</h4>
                        <p>stock management involves prioritizing customer needs and preferences in inventory decisions,
                            ensuring product availability, timely delivery, and responsive service to enhance
                            satisfaction and loyalty.</p>
                    </div>
                    <!-- Services Section -->
                    <section id="services" class="services-section" style="padding: 80px 0; background-color: #fff;">
                        <div class="container">
                            <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                                <h2
                                    style="font-size: 2.5rem; color: #2c3e50; position: relative; display: inline-block;">
                                    Our Premium Services
                                    <span
                                        style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background-color: #e74c3c;"></span>
                                </h2>
                                <p style="font-size: 1.2rem; color: #555; margin-top: 20px;">Comprehensive solutions for
                                    your inventory management needs</p>
                            </div>

                            <div class="services-grid"
                                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">

                                <!-- Inventory Management -->
                                <div class="service-card"
                                    style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.3s ease; position: relative;">
                                    <div class="service-badge"
                                        style="position: absolute; top: 15px; right: 15px; background: #e74c3c; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">
                                        HOT</div>
                                    <div class="service-image"
                                        style="height: 200px; overflow: hidden; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); display: flex; align-items: center; justify-content: center; position: relative;">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3144/3144456.png"
                                            alt="Inventory Management"
                                            style="width: 120px; height: 120px; object-fit: contain; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));">
                                        <div class="service-icon"
                                            style="position: absolute; bottom: -25px; right: 25px; width: 60px; height: 60px; background: #e74c3c; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);">
                                            <i class="fas fa-boxes" style="color: white; font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="service-content" style="padding: 30px 25px 25px;">
                                        <h3
                                            style="font-size: 1.5rem; color: #2c3e50; margin-bottom: 15px; position: relative; padding-bottom: 10px;">
                                            Inventory Management
                                            <span
                                                style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: #e74c3c;"></span>
                                        </h3>
                                        <p
                                            style="color: #666; margin-bottom: 20px; line-height: 1.6; min-height: 72px;">
                                            Complete control over your stock with real-time tracking, automated alerts,
                                            and multi-warehouse support.
                                        </p>
                                        <ul style="margin-bottom: 20px; padding-left: 20px; color: #555;">
                                            <li style="margin-bottom: 8px;">Real-time stock monitoring</li>
                                            <li style="margin-bottom: 8px;">Barcode scanning integration</li>
                                            <li style="margin-bottom: 8px;">Automated low stock alerts</li>
                                        </ul>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center;">
                                            <a href="/products" class="btn"
                                                style="display: inline-block; background: #e74c3c; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: all 0.3s ease; font-weight: 500;">
                                                Explore <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                            <span style="font-size: 0.9rem; color: #e74c3c; font-weight: 600;">
                                                <i class="fas fa-star"></i> 4.9/5
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier Management -->
                                <div class="service-card"
                                    style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.3s ease; position: relative;">
                                    <div class="service-image"
                                        style="height: 200px; overflow: hidden; background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); display: flex; align-items: center; justify-content: center; position: relative;">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3058/3058979.png"
                                            alt="Supplier Management"
                                            style="width: 120px; height: 120px; object-fit: contain; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));">
                                        <div class="service-icon"
                                            style="position: absolute; bottom: -25px; right: 25px; width: 60px; height: 60px; background: #2ecc71; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);">
                                            <i class="fas fa-truck" style="color: white; font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="service-content" style="padding: 30px 25px 25px;">
                                        <h3
                                            style="font-size: 1.5rem; color: #2c3e50; margin-bottom: 15px; position: relative; padding-bottom: 10px;">
                                            Supplier Network
                                            <span
                                                style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: #2ecc71;"></span>
                                        </h3>
                                        <p
                                            style="color: #666; margin-bottom: 20px; line-height: 1.6; min-height: 72px;">
                                            Streamline your supplier relationships with centralized contact management
                                            and performance tracking.
                                        </p>
                                        <ul style="margin-bottom: 20px; padding-left: 20px; color: #555;">
                                            <li style="margin-bottom: 8px;">Supplier performance metrics</li>
                                            <li style="margin-bottom: 8px;">Automated reordering</li>
                                            <li style="margin-bottom: 8px;">Contact management</li>
                                        </ul>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center;">
                                            <a href="/suppliers" class="btn"
                                                style="display: inline-block; background: #2ecc71; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: all 0.3s ease; font-weight: 500;">
                                                Explore <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                            <span style="font-size: 0.9rem; color: #2ecc71; font-weight: 600;">
                                                <i class="fas fa-star"></i> 4.7/5
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Processing -->
                                <div class="service-card"
                                    style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.3s ease; position: relative;">
                                    <div class="service-badge"
                                        style="position: absolute; top: 15px; right: 15px; background: #3498db; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;">
                                        NEW</div>
                                    <div class="service-image"
                                        style="height: 200px; overflow: hidden; background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%); display: flex; align-items: center; justify-content: center; position: relative;">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3132/3132693.png"
                                            alt="Order Processing"
                                            style="width: 120px; height: 120px; object-fit: contain; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));">
                                        <div class="service-icon"
                                            style="position: absolute; bottom: -25px; right: 25px; width: 60px; height: 60px; background: #3498db; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);">
                                            <i class="fas fa-shopping-cart"
                                                style="color: white; font-size: 1.5rem;"></i>
                                        </div>
                                    </div>
                                    <div class="service-content" style="padding: 30px 25px 25px;">
                                        <h3
                                            style="font-size: 1.5rem; color: #2c3e50; margin-bottom: 15px; position: relative; padding-bottom: 10px;">
                                            Order Management
                                            <span
                                                style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: #3498db;"></span>
                                        </h3>
                                        <p
                                            style="color: #666; margin-bottom: 20px; line-height: 1.6; min-height: 72px;">
                                            Efficient order processing from creation to fulfillment with automated
                                            workflows and tracking.
                                        </p>
                                        <ul style="margin-bottom: 20px; padding-left: 20px; color: #555;">
                                            <li style="margin-bottom: 8px;">Customer order tracking</li>
                                            <li style="margin-bottom: 8px;">Automated workflows</li>
                                            <li style="margin-bottom: 8px;">Full audit trails</li>
                                        </ul>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center;">
                                            <a href="/orders" class="btn"
                                                style="display: inline-block; background: #3498db; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: all 0.3s ease; font-weight: 500;">
                                                Explore <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                            <span style="font-size: 0.9rem; color: #3498db; font-weight: 600;">
                                                <i class="fas fa-star"></i> 4.8/5
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Additional CTA -->
                            <div style="text-align: center; margin-top: 60px;">
                                <h3 style="font-size: 1.8rem; color: #2c3e50; margin-bottom: 20px;">Ready to Transform
                                    Your Inventory Management?</h3>
                                <p
                                    style="font-size: 1.1rem; color: #555; max-width: 700px; margin: 0 auto 30px; line-height: 1.6;">
                                    Our comprehensive suite of tools is designed to streamline your operations, reduce
                                    costs, and improve efficiency.
                                </p>
                                <a href="/register" class="btn"
                                    style="display: inline-block; background: #e74c3c; color: white; padding: 12px 30px; border-radius: 30px; text-decoration: none; transition: all 0.3s ease; font-weight: 600; font-size: 1.1rem; box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);">
                                    Get Started Now <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </section>
                    <footer>
                        &copy; {{ date('Y') }} Gestion Stock Web. All rights reserved.
                    </footer>
                    <script>
                        // Modal functionality
                        const modal = document.getElementById("quoteModal");
                        const quoteBtn = document.getElementById("quoteBtn");
                        const heroQuoteBtn = document.getElementById("heroQuoteBtn");
                        const closeBtn = document.querySelector(".close");
                        const tabBtns = document.querySelectorAll(".tab-btn");
                        const tabContents = document.querySelectorAll(".tab-content");

                        // Open modal when quote button is clicked
                        quoteBtn.addEventListener("click", function(e) {
                            e.preventDefault();
                            modal.style.display = "block";
                        });

                        heroQuoteBtn.addEventListener("click", function(e) {
                            e.preventDefault();
                            modal.style.display = "block";
                        });

                        // Close modal when X is clicked
                        closeBtn.addEventListener("click", function() {
                            modal.style.display = "none";
                        });

                        // Close modal when clicking outside
                        window.addEventListener("click", function(e) {
                            if (e.target === modal) {
                                modal.style.display = "none";
                            }
                        });

                        // Tab functionality
                        tabBtns.forEach(btn => {
                            btn.addEventListener("click", function() {
                                const tabId = this.getAttribute("data-tab");

                                // Remove active class from all buttons and contents
                                tabBtns.forEach(btn => btn.classList.remove("active"));
                                tabContents.forEach(content => content.classList.remove("active"));

                                // Add active class to clicked button and corresponding content
                                this.classList.add("active");
                                document.getElementById(tabId).classList.add("active");
                            });
                        });

                        // Form submission
                        document.getElementById("quoteForm").addEventListener("submit", function(e) {
                            e.preventDefault();
                            alert("Thank you for your quote request! We'll contact you soon.");
                            modal.style.display = "none";
                            this.reset();
                        });

                        document.getElementById("registerForm").addEventListener("submit", function(e) {
                            e.preventDefault();
                            const password = document.getElementById("regPassword").value;
                            const confirmPassword = document.getElementById("regConfirmPassword").value;

                            if (password !== confirmPassword) {
                                alert("Passwords don't match!");
                                return;
                            }

                            alert("Registration successful! You can now log in.");
                            modal.style.display = "none";
                            this.reset();
                        });
                        document.getElementById('loginForm').addEventListener('submit', function(e) {
                            e.preventDefault();

                            const email = document.getElementById('email').value;
                            const password = document.getElementById('password').value;

                            // Basic validation
                            if (!email || !password) {
                                alert('Please fill in all required fields');
                                return;
                            }

                            // Here you would typically send the data to your server
                            console.log('Login attempt with:', {
                                email,
                                password
                            });

                            // For demo purposes - show success message
                            alert('Login successful! (This is a demo)');

                            // Reset form
                            this.reset();
                        });
                    </script>
</body>

</html>
