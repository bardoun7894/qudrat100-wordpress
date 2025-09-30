<?php
/**
 * Main template file
 * This is the most generic template file in a WordPress theme
 */

get_header(); ?>

<main class="container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="post">
                <h2 class="post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                
                <div class="post-meta">
                    <span>Posted on <?php the_date(); ?> by <?php the_author(); ?></span>
                    <span> | Categories: <?php the_category(', '); ?></span>
                </div>
                
                <div class="post-content">
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>">Read More...</a>
                </div>
            </article>
        <?php endwhile; ?>
        
        <!-- Pagination -->
        <div class="pagination">
            <?php 
            echo paginate_links(array(
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;'
            )); 
            ?>
        </div>
        
    <?php else : ?>
        <article class="post">
            <h2>No posts found</h2>
            <p>Sorry, no posts were found. Try searching for something else.</p>
        </article>
    <?php endif; ?>
</main>

<?php get_footer(); ?>