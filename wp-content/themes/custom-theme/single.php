<?php
/**
 * Single post template
 */

get_header(); ?>

<main class="container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="post">
                <h1 class="post-title"><?php the_title(); ?></h1>
                
                <div class="post-meta">
                    <span>Posted on <?php the_date(); ?> by <?php the_author(); ?></span>
                    <span> | Categories: <?php the_category(', '); ?></span>
                    <?php if (has_tag()) : ?>
                        <span> | Tags: <?php the_tags('', ', ', ''); ?></span>
                    <?php endif; ?>
                </div>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                
                <!-- Custom field example -->
                <?php 
                $custom_field = get_post_meta(get_the_ID(), '_custom_field', true);
                if ($custom_field) : ?>
                    <div class="custom-field">
                        <strong>Custom Field:</strong> <?php echo esc_html($custom_field); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Post navigation -->
                <div class="post-navigation">
                    <?php 
                    previous_post_link('<div class="nav-previous">%link</div>', '&laquo; %title');
                    next_post_link('<div class="nav-next">%link</div>', '%title &raquo;');
                    ?>
                </div>
            </article>
            
            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comments-section">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
            
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>