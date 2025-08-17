
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopora Premium Commerce Theme - Demo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="home front-page">

<!-- Header -->
<header class="site-header">
    <div class="container">
        <div class="header-content">
            <a href="#" class="site-logo">
                <i class="fas fa-shopping-bag"></i>
                Shopora Premium
            </a>
            
            <nav class="main-navigation">
                <ul>
                    <li><a href="#" class="current">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <a href="#" class="search-toggle">
                    <i class="fas fa-search"></i>
                </a>
                <a href="cart.php" class="cart-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">3</span>
                </a>
                <button class="mobile-menu-btn">
                    <span class="hamburger"></span>
                    <span class="hamburger"></span>
                    <span class="hamburger"></span>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<main id="primary" class="site-main front-page">
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Premium Products for Modern Living</h1>
                    <p>Discover our curated collection of high-quality products designed to enhance your lifestyle.</p>
                    <div class="hero-buttons">
                        <a href="shop.php" class="btn btn-primary">
                            <i class="fas fa-shopping-bag"></i>
                            Shop Now
                        </a>
                        <a href="about.php" class="btn btn-secondary">
                            <i class="fas fa-info-circle"></i>
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="hero-dashboard">
                        <div class="dashboard-card">
                            <div class="dashboard-header">
                                <h3>Analytics Dashboard</h3>
                                <div class="dashboard-stats">
                                    <span class="stat">
                                        <i class="fas fa-arrow-up"></i>
                                        +12%
                                    </span>
                                    <span class="stat">
                                        <i class="fas fa-arrow-up"></i>
                                        +8%
                                    </span>
                                    <span class="stat">
                                        <i class="fas fa-arrow-down"></i>
                                        -3%
                                    </span>
                                </div>
                            </div>
                            <div class="dashboard-chart">
                                <svg viewBox="0 0 300 150" class="chart-svg">
                                    <polyline points="0,140 30,120 60,100 90,80 120,60 150,70 180,50 210,40 240,30 270,20 300,10" stroke="currentColor" fill="none" stroke-width="3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Featured Products Section -->
    <section class="featured-products">
        <div class="container">
            <div class="section-header">
                <h2>Featured Products</h2>
                <p>Discover our most popular items, carefully selected for their quality and innovation</p>
            </div>
            
            <div class="products-grid">
                <div class="product-card fade-in">
                    <div class="product-image-container">
                        <div class="product-placeholder">
                            <i class="fas fa-headphones" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                        <span class="sale-badge">Sale!</span>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">
                            <a href="product.php">Premium Wireless Headphones</a>
                        </h3>
                        <div class="product-price">
                            <del>$399.00</del> $299.00
                        </div>
                        <div class="product-actions">
                            <a href="product.php" class="btn btn-primary">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="product-card fade-in">
                    <div class="product-image-container">
                        <div class="product-placeholder">
                            <i class="fas fa-laptop" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">
                            <a href="product.php">Smart Laptop Pro</a>
                        </h3>
                        <div class="product-price">$1,299.00</div>
                        <div class="product-actions">
                            <a href="product.php" class="btn btn-primary">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="product-card fade-in">
                    <div class="product-image-container">
                        <div class="product-placeholder">
                            <i class="fas fa-mobile-alt" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">
                            <a href="product.php">Smartphone Pro Max</a>
                        </h3>
                        <div class="product-price">$899.00</div>
                        <div class="product-actions">
                            <a href="product.php" class="btn btn-primary">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="product-card fade-in">
                    <div class="product-image-container">
                        <div class="product-placeholder">
                            <i class="fas fa-watch" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">
                            <a href="product.php">Smart Watch Elite</a>
                        </h3>
                        <div class="product-price">$399.00</div>
                        <div class="product-actions">
                            <a href="product.php" class="btn btn-primary">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="product-card fade-in">
                    <div class="product-image-container">
                        <div class="product-placeholder">
                            <i class="fas fa-camera" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">
                            <a href="product.php">Digital Camera 4K</a>
                        </h3>
                        <div class="product-price">$799.00</div>
                        <div class="product-actions">
                            <a href="product.php" class="btn btn-primary">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="product-card fade-in">
                    <div class="product-image-container">
                        <div class="product-placeholder">
                            <i class="fas fa-gamepad" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">
                            <a href="product.php">Gaming Controller Pro</a>
                        </h3>
                        <div class="product-price">$89.00</div>
                        <div class="product-actions">
                            <a href="product.php" class="btn btn-primary">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="section-footer">
                <a href="shop.php" class="btn btn-primary btn-large">
                    <i class="fas fa-arrow-right"></i>
                    View All Products
                </a>
            </div>
        </div>
    </section>
    
    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Premium Commerce</h2>
                    <p class="about-intro">We are dedicated to bringing you the finest selection of premium products that combine quality, innovation, and style.</p>
                    <p>With years of experience in the industry, we understand what our customers value most: exceptional quality, reliable service, and competitive prices. Our team carefully curates each item to ensure it meets our high standards.</p>
                    <ul class="about-features">
                        <li><i class="fas fa-check"></i> Premium quality materials</li>
                        <li><i class="fas fa-check"></i> Fast and reliable shipping</li>
                        <li><i class="fas fa-check"></i> 30-day money-back guarantee</li>
                        <li><i class="fas fa-check"></i> 24/7 customer support</li>
                        <li><i class="fas fa-check"></i> Secure payment processing</li>
                    </ul>
                    <a href="about.php" class="btn btn-primary">
                        Learn More About Us
                    </a>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&fit=crop&crop=center" alt="Our team at work" />
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>What Our Customers Say</h2>
                <p>Don't just take our word for it - here's what our satisfied customers have to say</p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card slide-up">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Outstanding quality and exceptional service. I've been a customer for over 2 years and have never been disappointed. Highly recommended!"</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face" alt="Sarah Johnson" class="author-avatar" />
                        <div class="author-info">
                            <h4>Sarah Johnson</h4>
                            <span>Verified Customer</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card slide-up">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"The product quality is amazing and the customer service is top-notch. Fast shipping and easy returns make shopping here a pleasure."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face" alt="Michael Chen" class="author-avatar" />
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <span>Regular Customer</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card slide-up">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"I love the variety of products and the attention to detail. Every purchase has exceeded my expectations. This is my go-to store!"</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face" alt="Emily Rodriguez" class="author-avatar" />
                        <div class="author-info">
                            <h4>Emily Rodriguez</h4>
                            <span>Premium Member</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact/CTA Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h2>Get in Touch</h2>
                    <p>Have questions about our products or need assistance? We're here to help! Contact us today and experience our exceptional customer service.</p>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+1 (555) 123-4567</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>hello@premiumcommerce.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Business Ave, Suite 100, City, State 12345</span>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <a href="#" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h3>Send Us a Message</h3>
                    <form id="contact-form" class="contact-form-wrapper">
                        <div class="form-group">
                            <label for="contact-name">Full Name</label>
                            <input type="text" id="contact-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email Address</label>
                            <input type="email" id="contact-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-subject">Subject</label>
                            <input type="text" id="contact-subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-message">Message</label>
                            <textarea id="contact-message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Premium Commerce</h3>
                <p>Your trusted partner for premium products and exceptional customer service.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Customer Service</h3>
                <ul>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Size Guide</a></li>
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Newsletter</h3>
                <p>Subscribe to get updates on new products and exclusive offers.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2024 Premium Commerce. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
