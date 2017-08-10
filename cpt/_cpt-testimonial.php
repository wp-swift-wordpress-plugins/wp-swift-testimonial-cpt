<?php
function cptui_register_my_cpts_testimonial() {
	/**
	 * Post Type: Testimonials.
	 */	
	$labels = array(
		"name" => __( 'Testimonials', '' ),
		"singular_name" => __( 'Testimonial', '' ),
	);

	$options = get_option( 'wp_swift_testimonial_cpt_settings' );

	$supports = array( "title", "editor" );

	if (isset($options['wp_swift_testimonial_cpt_checkbox_support_featured_image'])) {
		$supports[] = "thumbnail";
	}

	if (isset($options['wp_swift_testimonial_cpt_checkbox_support_excerpt'])) {
		$supports[] = "excerpt";
	}

	$args = array(
		"label" => __( 'Testimonials', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "testimonial", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 10,
		"menu_icon" => "dashicons-testimonial",
		"supports" => $supports,
	);

	register_post_type( "testimonial", $args );
}
add_action( 'init', 'cptui_register_my_cpts_testimonial' );

