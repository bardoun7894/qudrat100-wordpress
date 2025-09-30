<?php
/**
 * Page template for static pages
 */

get_header(); ?>

<main class="container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="page">
                <h1 class="page-title"><?php the_title(); ?></h1>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="page-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
                
                <!-- Custom page functionality can be added here -->
                <?php 
                // Example: Display child pages
                $children = get_pages(array('child_of' => get_the_ID()));
                if ($children) : ?>
                    <div class="child-pages">
                        <h3>Related Pages:</h3>
                        <ul>
                            <?php foreach ($children as $child) : ?>
                                <li><a href="<?php echo get_permalink($child->ID); ?>"><?php echo $child->post_title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>