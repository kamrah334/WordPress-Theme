<?php get_header(); ?>

<!-- Hero Section -->
<section class="bg-gradient-to-br from-purple-900 via-purple-700 to-indigo-800 text-white py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="fade-in">
                <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Premium Products for 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">
                        Modern Living
                    </span>
                </h1>
                <p class="text-xl text-gray-200 mb-8 leading-relaxed">
                    Discover our curated collection of high-quality products designed to enhance your lifestyle with cutting-edge technology and exceptional design.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/shop" class="btn-primary text-lg px-8 py-4">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        Shop Now
                    </a>
                    <a href="#featured" class="btn-secondary text-lg px-8 py-4 bg-transparent border-2 border-white text-white hover:bg-white hover:text-purple-700">
                        <i class="fas fa-arrow-down mr-2"></i>
                        Explore Products
                    </a>
                </div>
            </div>
            <div class="fade-in">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-3xl blur-2xl opacity-30 transform rotate-6"></div>
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=400&fit=crop" 
                         alt="Premium Products" 
                         class="relative rounded-3xl shadow-2xl transform hover:scale-105 transition-transform duration-300">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Shopora?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">We're committed to providing you with the best products and exceptional customer service</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow fade-in">
                <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-blue-500 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-shipping-fast text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Free Shipping</h3>
                <p class="text-gray-600">Fast delivery on orders over $50. No hidden fees, just quality products delivered to your door.</p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow fade-in">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Secure Payment</h3>
                <p class="text-gray-600">Your payment information is protected with bank-level security and encryption.</p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow fade-in">
                <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-undo text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Easy Returns</h3>
                <p class="text-gray-600">30-day hassle-free returns. Not satisfied? Send it back for a full refund.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section id="featured" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
            <p class="text-xl text-gray-600">Hand-picked selection of our most popular and innovative products</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            // Sample featured products data
            $featured_products = [
                [
                    'name' => 'Premium Wireless Headphones',
                    'price' => '$299.99',
                    'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&h=300&fit=crop',
                    'rating' => 5
                ],
                [
                    'name' => 'Smart Laptop Pro',
                    'price' => '$1,299.99',
                    'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b888a853?w=300&h=300&fit=crop',
                    'rating' => 5
                ],
                [
                    'name' => 'Smartphone Pro Max',
                    'price' => '$999.99',
                    'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300&h=300&fit=crop',
                    'rating' => 4
                ],
                [
                    'name' => 'Smart Watch Elite',
                    'price' => '$399.99',
                    'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&h=300&fit=crop',
                    'rating' => 5
                ]
            ];

            foreach ($featured_products as $index => $product) :
            ?>
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 fade-in">
                <div class="relative overflow-hidden rounded-t-2xl">
                    <img src="<?php echo esc_url($product['image']); ?>" 
                         alt="<?php echo esc_attr($product['name']); ?>" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 right-4">
                        <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Featured
                        </span>
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                        <button class="bg-white text-purple-600 px-6 py-3 rounded-full font-semibold opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Add to Cart
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <i class="fas fa-star <?php echo $i <= $product['rating'] ? 'text-yellow-400' : 'text-gray-300'; ?> text-sm"></i>
                        <?php endfor; ?>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo esc_html($product['name']); ?></h3>
                    <p class="text-2xl font-bold text-purple-600"><?php echo esc_html($product['price']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12 fade-in">
            <a href="/shop" class="btn-primary text-lg px-8 py-4">
                <i class="fas fa-store mr-2"></i>
                View All Products
            </a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-20 bg-gradient-to-r from-purple-600 to-indigo-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center fade-in">
        <h2 class="text-4xl font-bold text-white mb-4">Stay Updated</h2>
        <p class="text-xl text-purple-100 mb-8">Subscribe to our newsletter for exclusive deals and product updates</p>

        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="email" 
                   placeholder="Enter your email" 
                   class="flex-1 px-6 py-4 rounded-full border-0 focus:ring-4 focus:ring-white focus:ring-opacity-50 text-gray-900">
            <button type="submit" 
                    class="bg-white text-purple-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                Subscribe
            </button>
        </form>
    </div>
</section>

<?php get_footer(); ?>