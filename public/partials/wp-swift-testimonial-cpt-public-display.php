<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/wp-swift-wordpress-plugins
 * @since      1.0.0
 *
 * @package    Wp_Swift_Testimonial_Cpt
 * @subpackage Wp_Swift_Testimonial_Cpt/public/partials
 */
ob_start();
wp_reset_query();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array( 
    'post_type' => 'testimonial', 
    'posts_per_page' => 8, 
    'paged' => $paged,
);
global $wp_query;
$wp_query = new WP_Query($args);
if ( have_posts() ) : ?>

    <?php 
    while ( have_posts() ) : the_post(); ?>
    
        <div class="testimonial">
            <div class="testimonial-content"><?php the_content();?></div>
            <h5 class="testimonial-header"><?php the_title() ?></h5>
            <div class="clearfix"></div>
        </div>

        <?php 
    endwhile; ?>

    <?php
endif; // End have_posts() check.
/* Then the pagination links */
/* Display navigation to next/previous pages when applicable */ ?>
<?php if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) { ?>
<nav id="post-nav">
    <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
    <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
</nav>
<?php }
wp_reset_query();
$html = ob_get_contents();
ob_end_clean();