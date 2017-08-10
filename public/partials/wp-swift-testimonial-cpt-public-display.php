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
function get_testimonial_organisation($id) {
    if(get_field('organisation', $id)){
        $organisation = get_field('organisation', $id);
        if( get_field('website', $id) ) {
            $website = get_field('website', $id);
            $organisation = '<a href="'.$website.'" target="_blank">'.$organisation.'</a>';
        }
    } 
    return $organisation;   
}
ob_start();
wp_reset_query();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array( 
    'post_type' => 'testimonial', 
    'posts_per_page' => 10, 
    'paged' => $paged,
);
global $wp_query;
$wp_query = new WP_Query($args);
if ( have_posts() ) : ?>

    <?php 
    $class = 'odd';  
    while ( have_posts() ) : 

        the_post(); 
        $id = get_the_id(); 
        $class = ($class == 'even' ? 'odd' : 'even'); 

        ?><div class="testimonial <?php echo $class ?>">
            <?php if ($class==='odd'): ?>
                <i class="fa fa-quote-left icon"></i>
            <?php elseif ($class==='even') : ?>
                <i class="fa fa-quote-right icon"></i>
            <?php endif ?>
            <pre><?php //echo $class ?></pre>
            <div class="testimonial-content"><?php the_content();?></div>
            <div class="testimonial-meta">
                <div class="testimonial-header"><?php the_title() ?></div>
                <?php 
                    $pos_org='';
                    if(get_field('position', $id)){
                        $pos_org = get_field('position', $id);
                    }
                    if(get_field('organisation', $id)){
                        if($pos_org){
                            $pos_org .= ', '.get_testimonial_organisation($id);
                        }
                        else {
                            $pos_org = get_testimonial_organisation($id);
                        }
                    }
                    if ($pos_org): ?>
                        <div class="testimonial-position-organisation"><?php echo $pos_org ?></div>
                    <?php endif ?>
            </div><!-- @end .testimonial-meta -->
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