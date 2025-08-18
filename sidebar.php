<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Shopora_Premium_Commerce
 */

// Check if this is a development environment without WordPress
$is_dev_mode = !function_exists('is_active_sidebar');

if (!$is_dev_mode && !is_active_sidebar('sidebar-1')) {
    return;
}
?>

<div id="secondary" class="widget-area space-y-6">
    <?php if ($is_dev_mode) : ?>
        <!-- Demo Sidebar Content for Development -->

        <!-- Search Widget -->
        <div class="widget bg-gray-50 p-4 rounded-lg">
            <h3 class="widget-title text-lg font-semibold mb-4">Search</h3>
            <form class="flex">
                <input type="search" placeholder="Search..." class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-r-lg hover:bg-purple-700 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Recent Posts Widget -->
        <div class="widget bg-gray-50 p-4 rounded-lg">
            <h3 class="widget-title text-lg font-semibold mb-4">Recent Posts</h3>
            <ul class="space-y-3">
                <li>
                    <a href="#" class="block text-gray-700 hover:text-purple-600 transition-colors">
                        <div class="text-sm font-medium">How to Build a Modern Website</div>
                        <div class="text-xs text-gray-500 mt-1">January 15, 2024</div>
                    </a>
                </li>
                <li>
                    <a href="#" class="block text-gray-700 hover:text-purple-600 transition-colors">
                        <div class="text-sm font-medium">WordPress Theme Development Tips</div>
                        <div class="text-xs text-gray-500 mt-1">January 12, 2024</div>
                    </a>
                </li>
                <li>
                    <a href="#" class="block text-gray-700 hover:text-purple-600 transition-colors">
                        <div class="text-sm font-medium">E-commerce Best Practices</div>
                        <div class="text-xs text-gray-500 mt-1">January 10, 2024</div>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Categories Widget -->
        <div class="widget bg-gray-50 p-4 rounded-lg">
            <h3 class="widget-title text-lg font-semibold mb-4">Categories</h3>
            <ul class="space-y-2">
                <li><a href="#" class="text-gray-700 hover:text-purple-600 transition-colors flex justify-between">WordPress <span class="text-gray-400">(5)</span></a></li>
                <li><a href="#" class="text-gray-700 hover:text-purple-600 transition-colors flex justify-between">Design <span class="text-gray-400">(3)</span></a></li>
                <li><a href="#" class="text-gray-700 hover:text-purple-600 transition-colors flex justify-between">Development <span class="text-gray-400">(7)</span></a></li>
                <li><a href="#" class="text-gray-700 hover:text-purple-600 transition-colors flex justify-between">E-commerce <span class="text-gray-400">(4)</span></a></li>
            </ul>
        </div>

        <!-- Tags Widget -->
        <div class="widget bg-gray-50 p-4 rounded-lg">
            <h3 class="widget-title text-lg font-semibold mb-4">Tags</h3>
            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">WordPress</span>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">PHP</span>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">JavaScript</span>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">CSS</span>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">HTML</span>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Responsive</span>
            </div>
        </div>

    <?php else : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php endif; ?>
</div><!-- #secondary -->