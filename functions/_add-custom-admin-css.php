<?php
/**
 * Add stylesheet to WordPress backend
 */
function add_stylesheet_to_admin() {
    wp_enqueue_style( 'prefix-style', get_template_directory_uri().'/functions-includes/custom-post-types/testimonial/_admin-style.css', __FILE__ );
}
add_action( 'admin_enqueue_scripts', 'add_stylesheet_to_admin' );