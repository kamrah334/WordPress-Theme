
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Shopora Premium Commerce</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="woocommerce woocommerce-page">

<!-- Header -->
<header class="site-header">
    <div class="container">
        <div class="header-content">
            <a href="index.php" class="site-logo">
                <i class="fas fa-shopping-bag"></i>
                Shopora Premium
            </a>
            
            <nav class="main-navigation">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php" class="current">Shop</a></li>
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
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="shop-container">
    <div class="container">
        <header class="woocommerce-products-header">
            <h1 class="woocommerce-products-header__title page-title">Shop</h1>
            <p>Discover our premium collection of carefully curated products</p>
        </header>

        <div class="shop-layout has-sidebar">
            <aside class="shop-sidebar">
                <section class="widget filter-section">
                    <h4 class="widget-title">Filter by Price</h4>
                    <div class="price-filter">
                        <input type="range" min="0" max="2000" value="1000" class="price-slider">
                        <div class="price-inputs">
                            <input type="number" placeholder="Min" value="0">
                            <input type="number" placeholder="Max" value="2000">
                        </div>
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </section>

                <section class="widget filter-section">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="product-categories">
                        <li><a href="#">Electronics <span>(24)</span></a></li>
                        <li><a href="#">Accessories <span>(18)</span></a></li>
                        <li><a href="#">Audio <span>(12)</span></a></li>
                        <li><a href="#">Smart Devices <span>(15)</span></a></li>
                        <li><a href="#">Gaming <span>(8)</span></a></li>
                    </ul>
                </section>

                <section class="widget filter-section">
                    <h4 class="widget-title">Filter by Brand</h4>
                    <div class="brand-filters">
                        <label><input type="checkbox"> TechPro <span>(12)</span></label>
                        <label><input type="checkbox"> SmartLife <span>(8)</span></label>
                        <label><input type="checkbox"> AudioMax <span>(6)</span></label>
                        <label><input type="checkbox"> GameZone <span>(4)</span></label>
                    </div>
                </section>
            </aside>

            <div class="shop-main">
                <div class="shop-toolbar">
                    <div class="toolbar-left">
                        <p class="woocommerce-result-count">Showing 1–12 of 48 results</p>
                    </div>
                    <div class="toolbar-right">
                        <select class="orderby">
                            <option value="menu_order">Default sorting</option>
                            <option value="popularity">Sort by popularity</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="date">Sort by latest</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                    </div>
                </div>

                <ul class="products woocommerce">
                    <li class="product">
                        <a href="product.php" class="woocommerce-LoopProduct-link">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-headphones" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <h2 class="woocommerce-loop-product__title">Premium Wireless Headphones</h2>
                        </a>
                        <span class="price">
                            <del><span class="woocommerce-Price-amount">$399.00</span></del>
                            <ins><span class="woocommerce-Price-amount">$299.00</span></ins>
                        </span>
                        <a href="cart.php" class="button add_to_cart_button">Add to cart</a>
                        <span class="onsale">Sale!</span>
                    </li>

                    <li class="product">
                        <a href="product.php" class="woocommerce-LoopProduct-link">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-laptop" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <h2 class="woocommerce-loop-product__title">Smart Laptop Pro</h2>
                        </a>
                        <span class="price">
                            <span class="woocommerce-Price-amount">$1,299.00</span>
                        </span>
                        <a href="cart.php" class="button add_to_cart_button">Add to cart</a>
                    </li>

                    <li class="product">
                        <a href="product.php" class="woocommerce-LoopProduct-link">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-mobile-alt" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <h2 class="woocommerce-loop-product__title">Smartphone Pro Max</h2>
                        </a>
                        <span class="price">
                            <span class="woocommerce-Price-amount">$899.00</span>
                        </span>
                        <a href="cart.php" class="button add_to_cart_button">Add to cart</a>
                    </li>

                    <li class="product">
                        <a href="product.php" class="woocommerce-LoopProduct-link">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-watch" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <h2 class="woocommerce-loop-product__title">Smart Watch Elite</h2>
                        </a>
                        <span class="price">
                            <span class="woocommerce-Price-amount">$399.00</span>
                        </span>
                        <a href="cart.php" class="button add_to_cart_button">Add to cart</a>
                    </li>

                    <li class="product">
                        <a href="product.php" class="woocommerce-LoopProduct-link">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-camera" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <h2 class="woocommerce-loop-product__title">Digital Camera 4K</h2>
                        </a>
                        <span class="price">
                            <span class="woocommerce-Price-amount">$799.00</span>
                        </span>
                        <a href="cart.php" class="button add_to_cart_button">Add to cart</a>
                    </li>

                    <li class="product">
                        <a href="product.php" class="woocommerce-LoopProduct-link">
                            <div class="product-image-container">
                                <div class="product-placeholder">
                                    <i class="fas fa-gamepad" style="font-size: 3rem; color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <h2 class="woocommerce-loop-product__title">Gaming Controller Pro</h2>
                        </a>
                        <span class="price">
                            <span class="woocommerce-Price-amount">$89.00</span>
                        </span>
                        <a href="cart.php" class="button add_to_cart_button">Add to cart</a>
                    </li>
                </ul>

                <nav class="woocommerce-pagination">
                    <ul class="page-numbers">
                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="#">2</a></li>
                        <li><a class="page-numbers" href="#">3</a></li>
                        <li><a class="next page-numbers" href="#">→</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Premium Commerce</h3>
                <p>Your trusted partner for premium products and exceptional customer service.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
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
