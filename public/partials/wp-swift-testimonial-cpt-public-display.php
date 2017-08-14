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
    'posts_per_page' => 10, 
    'paged' => $paged,
);
$wp_swift_testimonial_cpt_checkbox_markup_icon = false; 
$options = get_option( 'wp_swift_testimonial_cpt_settings' );
if (isset($options['wp_swift_testimonial_cpt_checkbox_markup_icon'])) {
    $wp_swift_testimonial_cpt_checkbox_markup_icon = true; 
}

global $wp_query;
$wp_query = new WP_Query($args);
if ( have_posts() ) :
    $count = 0;
    $class = 'odd';
     
    while ( have_posts() ) : 

        the_post(); 
        $id = get_the_id(); 
        $count++;
        $class = ($class == 'even' ? 'odd' : 'even'); 
        $count_class = ''; 
        if ($count === 1) {
            $count_class .= ' first';
        }
        elseif ($count === $wp_query->post_count) {
            $count_class .= ' last';
        }
        ?><div class="testimonial <?php echo $class; echo $count_class; ?> testimonial-cpt-<?php echo $id ?>">
            
            <?php if ($wp_swift_testimonial_cpt_checkbox_markup_icon): ?>
                <?php if ($class==='odd'): ?>
                    <i class="fa fa-quote-left icon"></i>
                <?php elseif ($class==='even') : ?>
                    <i class="fa fa-quote-right icon"></i>
                <?php endif ?>
            <?php endif ?>

            <div class="testimonial-content"><?php 
                the_content();
            ?></div><!-- @end .testimonial-content -->

            <div class="testimonial-meta">
                <div class="testimonial-header"><?php 
                    the_title() 
                ?></div><!-- @end .testimonial-header -->
                <?php 
                    $pos_org='';
                    if(get_field('position', $id)){
                        $pos_org = get_field('position', $id);
                    }
                    if(get_field('organisation', $id)){
                        if($pos_org){
                            $pos_org .= ', '.wp_swift_get_testimonial_organisation($id);
                        }
                        else {
                            $pos_org = wp_swift_get_testimonial_organisation($id);
                        }
                    }
                    if ($pos_org): ?>
                        <div class="testimonial-position-organisation"><?php 
                            echo $pos_org 
                        ?></div><!-- @end .testimonial-position-organisation -->
                    <?php endif ?>
                    <?php if ( has_post_thumbnail( $id ) ) : ?>
                        <div class="testimonial-image">
                             <img alt="<?php echo get_the_title($id); ?>" src="<?php echo the_post_thumbnail_url('large', $id); ?>"> 
                        </div>
                    <?php endif ?>
            </div><!-- @end .testimonial-meta -->
            <div class="clearfix"></div>

        </div><!-- @end .testimonial --><?php 
    endwhile;

endif; // End have_posts() check.

/* Then the pagination links */
/* Display navigation to next/previous pages when applicable */
if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) :
?><nav id="post-nav">
    <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
    <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
</nav><?php
endif;
wp_reset_query();
$html = ob_get_contents();
ob_end_clean();