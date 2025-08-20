<?php get_header(); ?>

<div class="py-16">
    <div class="max-w-4xl mx-auto px-4">
        <?php while (have_posts()) : the_post(); ?>
            <article>
                <h1 class="text-4xl font-bold mb-4"><?php the_title(); ?></h1>
                <div class="text-gray-600 mb-8">
                    <?php the_date(); ?> by <?php the_author(); ?>
                </div>
                <div class="prose max-w-none">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>