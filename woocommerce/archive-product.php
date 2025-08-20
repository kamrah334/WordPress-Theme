
<?php get_header(); ?>

<div class="bg-gray-50 min-h-screen pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 fade-in">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Our Products</h1>
                    <p class="text-lg text-gray-600">Discover our complete collection of premium products</p>
                </div>
                
                <!-- Sort & Filter Controls -->
                <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                    <select class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                        <option>Sort by Latest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Most Popular</option>
                    </select>
                    <button class="lg:hidden bg-purple-600 text-white px-6 py-3 rounded-xl hover:bg-purple-700 transition-colors">
                        <i class="fas fa-filter mr-2"></i>
                        Filters
                    </button>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <aside class="lg:w-80 space-y-6">
                <div class="bg-white rounded-2xl shadow-lg p-6 fade-in">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Categories</h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="ml-3 text-gray-700">Electronics</span>
                            <span class="ml-auto text-sm text-gray-500">(24)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="ml-3 text-gray-700">Accessories</span>
                            <span class="ml-auto text-sm text-gray-500">(18)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="ml-3 text-gray-700">Fashion</span>
                            <span class="ml-auto text-sm text-gray-500">(12)</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 fade-in">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Price Range</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <input type="number" placeholder="Min" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                            <span class="text-gray-500">-</span>
                            <input type="number" placeholder="Max" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        </div>
                        <button class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            Apply
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 fade-in">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Rating</h3>
                    <div class="space-y-3">
                        <?php for ($rating = 5; $rating >= 1; $rating--) : ?>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="ml-3 flex items-center">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <i class="fas fa-star <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?> text-sm"></i>
                                <?php endfor; ?>
                                <span class="ml-2 text-gray-700">& up</span>
                            </span>
                        </label>
                        <?php endfor; ?>
                    </div>
                </div>
            </aside>

            <!-- Products Grid -->
            <main class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                    <?php
                    // Sample products for demonstration
                    $products = [
                        ['name' => 'Premium Wireless Headphones', 'price' => '$299.99', 'sale' => '$199.99', 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop', 'rating' => 5, 'reviews' => 128],
                        ['name' => 'Smart Watch Elite', 'price' => '$399.99', 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=400&fit=crop', 'rating' => 5, 'reviews' => 89],
                        ['name' => 'Wireless Earbuds Pro', 'price' => '$179.99', 'image' => 'https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?w=400&h=400&fit=crop', 'rating' => 4, 'reviews' => 245],
                        ['name' => 'Smart Laptop Pro', 'price' => '$1,299.99', 'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=400&fit=crop', 'rating' => 5, 'reviews' => 67],
                        ['name' => 'Professional Camera', 'price' => '$899.99', 'image' => 'https://images.unsplash.com/photo-1606983340126-99ab4feaa64a?w=400&h=400&fit=crop', 'rating' => 4, 'reviews' => 156],
                        ['name' => 'Gaming Controller Pro', 'price' => '$79.99', 'image' => 'https://images.unsplash.com/photo-1592840194977-8fae8b3ea549?w=400&h=400&fit=crop', 'rating' => 5, 'reviews' => 324]
                    ];
                    
                    foreach ($products as $product) :
                    ?>
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 fade-in">
                        <div class="relative overflow-hidden rounded-t-2xl">
                            <img src="<?php echo esc_url($product['image']); ?>" 
                                 alt="<?php echo esc_attr($product['name']); ?>" 
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            
                            <?php if (isset($product['sale'])) : ?>
                            <div class="absolute top-4 left-4">
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    Sale
                                </span>
                            </div>
                            <?php endif; ?>
                            
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-700 p-2 rounded-full shadow-lg transition-all">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 space-x-2">
                                    <button class="bg-white text-purple-600 px-4 py-2 rounded-full font-semibold hover:bg-purple-600 hover:text-white transition-colors">
                                        <i class="fas fa-eye mr-1"></i>
                                        Quick View
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <i class="fas fa-star <?php echo $i <= $product['rating'] ? 'text-yellow-400' : 'text-gray-300'; ?> text-sm"></i>
                                    <?php endfor; ?>
                                    <span class="ml-2 text-sm text-gray-500">(<?php echo $product['reviews']; ?>)</span>
                                </div>
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors">
                                <?php echo esc_html($product['name']); ?>
                            </h3>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <?php if (isset($product['sale'])) : ?>
                                        <span class="text-2xl font-bold text-red-500"><?php echo esc_html($product['sale']); ?></span>
                                        <span class="text-lg text-gray-500 line-through"><?php echo esc_html($product['price']); ?></span>
                                    <?php else : ?>
                                        <span class="text-2xl font-bold text-purple-600"><?php echo esc_html($product['price']); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <button class="bg-purple-600 hover:bg-purple-700 text-white p-3 rounded-xl transition-colors">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center fade-in">
                    <nav class="flex items-center space-x-2">
                        <button class="px-4 py-2 text-gray-500 hover:text-purple-600 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-4 py-2 bg-purple-600 text-white rounded-lg">1</button>
                        <button class="px-4 py-2 text-gray-700 hover:text-purple-600 transition-colors">2</button>
                        <button class="px-4 py-2 text-gray-700 hover:text-purple-600 transition-colors">3</button>
                        <span class="px-2">...</span>
                        <button class="px-4 py-2 text-gray-700 hover:text-purple-600 transition-colors">10</button>
                        <button class="px-4 py-2 text-gray-500 hover:text-purple-600 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </main>
        </div>
    </div>
</div>

<?php get_footer(); ?>
