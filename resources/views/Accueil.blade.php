<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality Roofing Solutions</title>
    <style>
        /* Global Styles */
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --accent-color: #3498db;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            line-height: 1.6;
            color: var(--dark-color);
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .btn {
            display: inline-block;
            background: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        /* Header & Navigation */
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        .logo span {
            color: var(--secondary-color);
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 30px;
        }
        
        .nav-links a {
            transition: color 0.3s ease;
        }
        
        .nav-links a:hover {
            color: var(--secondary-color);
        }
        
        .phone {
            font-weight: bold;
            color: var(--secondary-color);
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            padding-top: 80px;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        
        /* Forms */
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 40px auto;
        }
        
        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-color);
        }
        
        .required::after {
            content: " *";
            color: var(--secondary-color);
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 30px;
            border-radius: 10px;
            width: 80%;
            max-width: 500px;
            position: relative;
            animation: modalopen 0.5s;
        }
        
        @keyframes modalopen {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        /* Tabs */
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .tab-btn {
            padding: 10px 20px;
            background: #ddd;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .tab-btn.active {
            background: var(--primary-color);
            color: white;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .form-container {
                padding: 20px;
            }
        }
        .login-btn {
            display: inline-block;
            background: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .login-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }
        
        .forgot-password a {
            color: #7f8c8d;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .forgot-password a:hover {
            color: #3498db;
        }
    </style>
</head>
<body>
    <!-- Header & Navigation -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">Gestion <span>Stock</span> Web</div>
                <ul class="nav-links">
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#projects">Add stock</a></li>
                    <li><a href="#" id="quoteBtn">Get Started</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Our Website</h1>
            <p>Suivi, Organisation, Optimisation.</p>
            <a href="#" class="btn" id="heroQuoteBtn">Get Started</a>
        </div>
    </section>

    <!-- Quote Modal -->
    <div id="quoteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            
            <div class="tabs">
                <button class="tab-btn active" data-tab="login">Login</button>
                <button class="tab-btn" data-tab="register">Register</button>
            </div>
            
            <!-- Quote Form -->
            <div id="login" class="tab-content active">
                <h2>Login</h2>
                <form id="loginForm" method="POST" action="{{ route('login')}}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input type="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="required">Password</label>
                        <input type="password" id="password" required>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                
                <div class="forgot-password">
                    <a href="#">Forgot your password?</a>
                </div>
            </div>        
            </form>
            <!-- Registration Form -->
            <div id="register" class="tab-content">
                <h2>Register</h2>
                <form id="registerForm" action="{{ route('register')}}" method="POST">
                    <div class="form-group">
                        <label for="regFirstName" class="required">First name</label>
                        <input type="text" id="regFirstName" required>
                    </div>
                    <div class="form-group">
                        <label for="regLastName" class="required">Last name</label>
                        <input type="text" id="regLastName" required>
                    </div>
                    <div class="form-group">
                        <label for="regEmail" class="required">Email</label>
                        <input type="email" id="regEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="regPassword" class="required">Password</label>
                        <input type="password" id="regPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="regConfirmPassword" class="required">Confirm Password</label>
                        <input type="password" id="regConfirmPassword" required>
                    </div>
                    <button type="submit" class="btn">Register</button>
                </form>
            </div>
        </div>
    </div>
    <section id="about" class="about-section" style="padding: 80px 0; background-color: #f9f9f9;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                <h2 style="font-size: 2.5rem; color: #2c3e50; position: relative; display: inline-block;">
                    About
                    <span style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background-color: #e74c3c;"></span>
                </h2>
            </div>
            
            <div class="about-content" style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h3 style="font-size: 1.8rem; color: #2c3e50; margin-bottom: 20px;">Our Mission</h3>
                <p style="font-size: 1.1rem; line-height: 1.6; color: #555;">
                    A stock management website is a digital platform designed to help businesses efficiently track and manage their inventory. It allows users to monitor stock levels, process orders, and streamline supply chain operations. Key features typically include real-time inventory updates, reporting tools for analyzing trends, and alerts for low stock levels. This tool enhances operational efficiency, reduces costs, and supports informed decision-making, ultimately leading to better resource management and increased profitability.
                </p>
                <div class="mission-points" style="display: flex; justify-content: space-around; flex-wrap: wrap; margin-top: 40px;">
                    <div class="point" style="flex: 1; min-width: 200px; margin: 15px; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h4 style="color: #e74c3c; margin-bottom: 10px;">Quality Materials</h4>
                        <p>reliable inventory items that meet standards for durability and performance, ensuring efficient operations and customer satisfaction.</p>
                    </div>
                    <div class="point" style="flex: 1; min-width: 200px; margin: 15px; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                    <h4 style="color: #e74c3c; margin-bottom: 10px;">Customer Focus</h4>
                    <p>stock management involves prioritizing customer needs and preferences in inventory decisions, ensuring product availability, timely delivery, and responsive service to enhance satisfaction and loyalty.</p>
                </div>
            <!-- Services Section -->
<section id="services" class="services-section" style="padding: 80px 0; background-color: #fff;">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 2.5rem; color: #2c3e50; position: relative; display: inline-block;">
                Our Services
                <span style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background-color: #e74c3c;"></span>
            </h2>
            <p style="font-size: 1.2rem; color: #555; margin-top: 20px;">Stock Management Solutions</p>
        </div>

        <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">

            <!-- Inventory Tracking -->
            <div class="service-card" style="background: #f9f9f9; border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <div class="service-image" style="height: 200px; overflow: hidden; background-color: #e3f2fd; display: flex; align-items: center; justify-content: center;">
                    <img src="https://cdn-icons-png.flaticon.com/512/3144/3144456.png" alt="Inventory Tracking" style="width: 120px; height: 120px; object-fit: contain;">
                </div>
                <div class="service-content" style="padding: 25px;">
                    <h3 style="font-size: 1.5rem; color: #2c3e50; margin-bottom: 15px;">Inventory Tracking</h3>
                    <p style="color: #666; margin-bottom: 20px; line-height: 1.6;">
                        Real-time inventory tracking with barcode scanning and automated stock level alerts. 
                        Monitor your products across multiple warehouses with our comprehensive system.
                    </p>
                    <div class="service-categories" style="margin-bottom: 20px;">
                        <span style="display: inline-block; background: #e74c3c; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; margin-right: 8px; margin-bottom: 8px;">Real-time</span>
                        <span style="display: inline-block; background: #3498db; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; margin-right: 8px; margin-bottom: 8px;">Barcode</span>
                    </div>
                    <a href="#quote" class="btn" style="display: inline-block; background: #e74c3c; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background 0.3s ease;">Learn More</a>
                </div>
            </div>

            <!-- Stock Analytics -->
            <div class="service-card" style="background: #f9f9f9; border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <div class="service-image" style="height: 200px; overflow: hidden; background-color: #e8f5e9; display: flex; align-items: center; justify-content: center;">
                    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132693.png" alt="Stock Analytics" style="width: 120px; height: 120px; object-fit: contain;">
                </div>
                <div class="service-content" style="padding: 25px;">
                    <h3 style="font-size: 1.5rem; color: #2c3e50; margin-bottom: 15px;">Stock Analytics</h3>
                    <p style="color: #666; margin-bottom: 20px; line-height: 1.6;">
                        Powerful analytics dashboard showing stock movement, turnover rates, and forecasting. 
                        Make data-driven decisions with our comprehensive reporting tools.
                    </p>
                    <div class="service-categories" style="margin-bottom: 20px;">
                        <span style="display: inline-block; background: #2ecc71; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; margin-right: 8px; margin-bottom: 8px;">Reports</span>
                        <span style="display: inline-block; background: #9b59b6; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; margin-right: 8px; margin-bottom: 8px;">Forecasting</span>
                    </div>
                    <a href="#quote" class="btn" style="display: inline-block; background: #e74c3c; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background 0.3s ease;">Learn More</a>
                </div>
            </div>

            <!-- Order Management -->
            <div class="service-card" style="background: #f9f9f9; border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <div class="service-image" style="height: 200px; overflow: hidden; background-color: #fff3e0; display: flex; align-items: center; justify-content: center;">
                    <img src="https://cdn-icons-png.flaticon.com/512/3058/3058979.png" alt="Order Management" style="width: 120px; height: 120px; object-fit: contain;">
                </div>
                <div class="service-content" style="padding: 25px;">
                    <h3 style="font-size: 1.5rem; color: #2c3e50; margin-bottom: 15px;">Order Management</h3>
                    <p style="color: #666; margin-bottom: 20px; line-height: 1.6;">
                        Streamline your purchase and sales orders with automated workflows. 
                        Track orders from creation to fulfillment with full audit trails.
                    </p>
                    <div class="service-categories" style="margin-bottom: 20px;">
                        <span style="display: inline-block; background: #3498db; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; margin-right: 8px; margin-bottom: 8px;">Purchase</span>
                        <span style="display: inline-block; background: #e74c3c; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; margin-right: 8px; margin-bottom: 8px;">Sales</span>
                    </div>
                    <a href="#quote" class="btn" style="display: inline-block; background: #e74c3c; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; transition: background 0.3s ease;">Learn More</a>
                </div>
            </div>

        </div>
    </div>
</section>
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
    </script>
    <script>
            <script>
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
            console.log('Login attempt with:', { email, password });
            
            // For demo purposes - show success message
            alert('Login successful! (This is a demo)');
            
            // Reset form
            this.reset();
        });
    </script>
    </script>
</body>
</html>