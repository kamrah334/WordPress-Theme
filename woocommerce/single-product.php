
<?php get_header(); ?>

<div class="bg-gray-50 min-h-screen pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8 fade-in">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="/" class="hover:text-purple-600 transition-colors">Home</a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li><a href="/shop" class="hover:text-purple-600 transition-colors">Shop</a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li class="text-gray-900">Wireless Headphones</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Product Gallery -->
            <div class="fade-in">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="aspect-square bg-gray-100 relative">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=600&fit=crop" 
                             alt="Wireless Headphones" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4">
                            <button class="bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-700 p-3 rounded-full shadow-lg transition-all">
                                <i class="fas fa-expand text-lg"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="p-4">
                        <div class="flex space-x-2 overflow-x-auto">
                            <button class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg border-2 border-purple-600 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=80&h=80&fit=crop" 
                                     alt="View 1" class="w-full h-full object-cover">
                            </button>
                            <button class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg border border-gray-200 overflow-hidden hover:border-purple-600 transition-colors">
                                <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?w=80&h=80&fit=crop" 
                                     alt="View 2" class="w-full h-full object-cover">
                            </button>
                            <button class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg border border-gray-200 overflow-hidden hover:border-purple-600 transition-colors">
                                <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?w=80&h=80&fit=crop" 
                                     alt="View 3" class="w-full h-full object-cover">
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="fade-in">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <!-- Product Title & Rating -->
                    <div class="mb-6">
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Premium Wireless Headphones</h1>
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex items-center">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <i class="fas fa-star text-yellow-400"></i>
                                <?php endfor; ?>
                            </div>
                            <span class="text-gray-600">(128 reviews)</span>
                            <a href="#reviews" class="text-purple-600 hover:text-purple-700 transition-colors">Write a review</a>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            High-quality sound meets premium comfort. These wireless headphones deliver exceptional audio quality with industry-leading noise cancellation technology.
                        </p>
                    </div>

                    <!-- Price -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="text-4xl font-bold text-purple-600">$199.99</span>
                            <span class="text-2xl text-gray-500 line-through">$299.99</span>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">33% OFF</span>
                        </div>
                        <p class="text-green-600 font-medium">
                            <i class="fas fa-check mr-2"></i>
                            In stock - Ready to ship
                        </p>
                    </div>

                    <!-- Product Options -->
                    <div class="space-y-6 mb-8">
                        <!-- Color Selection -->
                        <div>
                            <label class="block text-lg font-semibold text-gray-900 mb-3">Color</label>
                            <div class="flex space-x-3">
                                <button class="w-10 h-10 bg-black rounded-full border-2 border-purple-600 shadow-lg"></button>
                                <button class="w-10 h-10 bg-white rounded-full border-2 border-gray-300 shadow-lg hover:border-purple-600 transition-colors"></button>
                                <button class="w-10 h-10 bg-blue-600 rounded-full border-2 border-gray-300 shadow-lg hover:border-purple-600 transition-colors"></button>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label class="block text-lg font-semibold text-gray-900 mb-3">Quantity</label>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button class="px-4 py-2 hover:bg-gray-100 transition-colors">-</button>
                                    <input type="number" value="1" min="1" class="w-16 text-center border-0 focus:ring-0">
                                    <button class="px-4 py-2 hover:bg-gray-100 transition-colors">+</button>
                                </div>
                                <span class="text-gray-600">Only 5 left in stock</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4 mb-8">
                        <button class="w-full bg-gradient-to-r from-purple-600 to-purple-700 text-white py-4 rounded-xl font-semibold text-lg hover:from-purple-700 hover:to-purple-800 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Add to Cart
                        </button>
                        <button class="w-full bg-yellow-400 text-gray-900 py-4 rounded-xl font-semibold text-lg hover:bg-yellow-500 transition-colors">
                            <i class="fas fa-bolt mr-2"></i>
                            Buy Now
                        </button>
                        <button class="w-full border-2 border-gray-300 text-gray-700 py-4 rounded-xl font-semibold text-lg hover:border-purple-600 hover:text-purple-600 transition-colors">
                            <i class="fas fa-heart mr-2"></i>
                            Add to Wishlist
                        </button>
                    </div>

                    <!-- Features -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Key Features</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                Active Noise Cancellation
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                30-hour Battery Life
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                Premium Audio Quality
                            </li>
                            <li class="flex items-center text-gray-700">
                                <i class="fas fa-check text-green-500 mr-3"></i>
                                Comfortable Design
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="bg-white rounded-2xl shadow-lg mb-16 fade-in">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-8 pt-6">
                    <button class="pb-4 border-b-2 border-purple-600 text-purple-600 font-semibold">Description</button>
                    <button class="pb-4 text-gray-500 hover:text-gray-700 transition-colors">Specifications</button>
                    <button class="pb-4 text-gray-500 hover:text-gray-700 transition-colors">Reviews (128)</button>
                    <button class="pb-4 text-gray-500 hover:text-gray-700 transition-colors">Shipping</button>
                </nav>
            </div>
            
            <div class="p-8">
                <div class="prose max-w-none">
                    <h3>Premium Audio Experience</h3>
                    <p>Experience music like never before with our premium wireless headphones. Featuring advanced noise cancellation technology and high-fidelity audio drivers, these headphones deliver crystal-clear sound quality that brings your music to life.</p>
                    
                    <h3>Comfort & Design</h3>
                    <p>Engineered for extended wear, these headphones feature memory foam ear cushions and an adjustable headband that ensures comfort during long listening sessions. The sleek, modern design makes them perfect for both professional and casual use.</p>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <section class="mb-16 fade-in">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $related_products = [
                    ['name' => 'Wireless Earbuds Pro', 'price' => '$179.99', 'image' => 'https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?w=300&h=300&fit=crop'],
                    ['name' => 'Smart Watch Elite', 'price' => '$399.99', 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&h=300&fit=crop'],
                    ['name' => 'Portable Speaker', 'price' => '$129.99', 'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=300&h=300&fit=crop'],
                    ['name' => 'Gaming Headset', 'price' => '$249.99', 'image' => 'https://images.unsplash.com/photo-1599669454699-248893623440?w=300&h=300&fit=crop']
                ];
                
                foreach ($related_products as $product) :
                ?>
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative overflow-hidden rounded-t-2xl">
                        <img src="<?php echo esc_url($product['image']); ?>" 
                             alt="<?php echo esc_attr($product['name']); ?>" 
                             class="w-full h-48 object-cover hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2"><?php echo esc_html($product['name']); ?></h3>
                        <p class="text-lg font-bold text-purple-600"><?php echo esc_html($product['price']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>
