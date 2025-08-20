
<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        <aside class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Product Categories</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">Electronics</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">Fashion</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">Home & Garden</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">Sports</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-purple-600 transition-colors">Books</a></li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Price Range</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        <span class="text-gray-600">Under $50</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        <span class="text-gray-600">$50 - $100</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        <span class="text-gray-600">$100 - $200</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        <span class="text-gray-600">Over $200</span>
                    </label>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Rating</h3>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        </div>
                    </label>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="lg:w-3/4">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4 sm:mb-0">Our Products</h1>
                <div class="flex items-center space-x-4">
                    <select class="border border-gray-300 rounded-lg px-4 py-2">
                        <option>Sort by: Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest</option>
                        <option>Best Selling</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                $products = [
                    [
                        'name' => 'Premium Wireless Headphones',
                        'price' => '$129.99',
                        'image' => '/assets/images/headphones.jpg',
                        'rating' => 5,
                        'sale' => false
                    ],
                    [
                        'name' => 'Smart Watch Elite',
                        'price' => '$249.99',
                        'image' => '/assets/images/smartwatch.jpg', 
                        'rating' => 4,
                        'sale' => true,
                        'original_price' => '$299.99'
                    ],
                    [
                        'name' => 'Wireless Earbuds Pro',
                        'price' => '$89.99',
                        'image' => '/assets/images/earbuds.jpg',
                        'rating' => 5,
                        'sale' => false
                    ],
                    [
                        'name' => 'Wireless Keyboard Pro',
                        'price' => '$159.99',
                        'image' => '/assets/images/keyboard.jpg',
                        'rating' => 4,
                        'sale' => false
                    ],
                    [
                        'name' => 'Smart Laptop Pro',
                        'price' => '$899.99',
                        'image' => '/assets/images/laptop.jpg',
                        'rating' => 5,
                        'sale' => true,
                        'original_price' => '$1099.99'
                    ],
                    [
                        'name' => 'Professional Camera',
                        'price' => '$599.99',
                        'image' => '/assets/images/camera.jpg',
                        'rating' => 4,
                        'sale' => false
                    ]
                ];

                foreach ($products as $product): ?>
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                        <div class="relative overflow-hidden bg-gray-100 h-64">
                            <div class="w-full h-full bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-purple-300"></i>
                            </div>
                            <?php if ($product['sale']): ?>
                                <span class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">Sale</span>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <div class="space-x-2">
                                    <button class="bg-white text-gray-900 p-2 rounded-full hover:bg-purple-600 hover:text-white transition-colors">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="bg-white text-gray-900 p-2 rounded-full hover:bg-purple-600 hover:text-white transition-colors">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="bg-purple-600 text-white p-2 rounded-full hover:bg-purple-700 transition-colors">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                                <a href="/product"><?php echo esc_html($product['name']); ?></a>
                            </h3>
                            <div class="flex items-center mb-3">
                                <div class="flex text-yellow-400 mr-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star<?php echo $i <= $product['rating'] ? '' : ' text-gray-300'; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-gray-500 text-sm">(<?php echo rand(10, 50); ?> reviews)</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="text-xl font-bold text-purple-600"><?php echo esc_html($product['price']); ?></span>
                                    <?php if (isset($product['original_price'])): ?>
                                        <span class="text-sm text-gray-500 line-through"><?php echo esc_html($product['original_price']); ?></span>
                                    <?php endif; ?>
                                </div>
                                <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors text-sm font-medium">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <nav class="flex space-x-2">
                    <a href="#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Previous</a>
                    <a href="#" class="px-4 py-2 bg-purple-600 text-white rounded-lg">1</a>
                    <a href="#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">2</a>
                    <a href="#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">3</a>
                    <a href="#" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Next</a>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
