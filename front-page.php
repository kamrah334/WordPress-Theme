<?php get_header(); ?>

<div class="site-main">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-purple-900 via-purple-700 to-indigo-800 text-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl lg:text-6xl font-bold mb-6">Welcome to Shopora</h1>
                <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto">Your premium e-commerce destination for quality products and exceptional service.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/shop" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-purple-700 hover:to-indigo-700 transition-all">
                        <i class="fas fa-shopping-bag mr-2"></i>Shop Now
                    </a>
                    <a href="/page-about.php" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-purple-700 transition-all">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
                <p class="text-xl text-gray-600">Discover our most popular items</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow">
                    <div class="h-64 bg-gradient-to-br from-yellow-100 to-orange-200 flex items-center justify-center">
                        <i class="fas fa-headphones text-6xl text-yellow-600"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Premium Headphones</h3>
                        <p class="text-gray-600 mb-4">High-quality wireless headphones with noise cancellation</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-purple-600">$129.99</span>
                            <a href="/product" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">View</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow">
                    <div class="h-64 bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center">
                        <i class="fas fa-laptop text-6xl text-blue-600"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Smart Laptop</h3>
                        <p class="text-gray-600 mb-4">Powerful laptop for work and entertainment</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-purple-600">$899.99</span>
                            <a href="/product" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">View</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-shadow">
                    <div class="h-64 bg-gradient-to-br from-green-100 to-emerald-200 flex items-center justify-center">
                        <i class="fas fa-camera text-6xl text-green-600"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Pro Camera</h3>
                        <p class="text-gray-600 mb-4">Professional camera for stunning photography</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-purple-600">$599.99</span>
                            <a href="/product" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Us?</h2>
                <p class="text-xl text-gray-600">Premium quality meets exceptional service</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shipping-fast text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Free Shipping</h3>
                    <p class="text-gray-600">Fast delivery worldwide with tracking</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Secure Payment</h3>
                    <p class="text-gray-600">Your payment information is always safe</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-undo text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Easy Returns</h3>
                    <p class="text-gray-600">30-day hassle-free return policy</p>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>