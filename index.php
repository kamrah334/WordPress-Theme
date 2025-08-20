<?php get_header(); ?>

<div class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Blog</h1>

        <?php if (have_posts()) : ?>
            <div class="space-y-8">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-2xl font-bold mb-4">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="text-gray-600 mb-4">
                            <?php the_date(); ?> by <?php the_author(); ?>
                        </div>
                        <div class="text-gray-700">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>