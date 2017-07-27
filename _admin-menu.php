<?php
add_action( 'admin_menu', 'wp_swift_testimonial_cpt_add_admin_menu' );
add_action( 'admin_init', 'wp_swift_testimonial_cpt_settings_init' );

/*
 * This determines the location the settings page
 * It are listed under Settings unless the other plugin 'wp_swift_admin_menu' is activated
 */
function wp_swift_testimonial_cpt_add_admin_menu(  ) { 
	if ( get_option( 'wp_swift_admin_menu' ) ) {
        add_submenu_page( 'wp-swift-admin-menu', 'WP Swift: Testimonials CPT', 'Testimonials', 'manage_options', 'wp_swift_testimonials_cpt', 'wp_swift_testimonial_cpt_options_page' );
    }
    else {
        add_options_page( 'WP Swift: Testimonials CPT', 'Testimonials', 'manage_options', 'wp_swift_testimonials_cpt', 'wp_swift_testimonial_cpt_options_page' );
    }
}


function wp_swift_testimonial_cpt_settings_init(  ) { 

	register_setting( 'pluginPage', 'wp_swift_testimonial_cpt_settings' );

	add_settings_section(
		'wp_swift_testimonial_cpt_pluginPage_section', 
		__( 'Settings Page', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_select_field_show_method', 
		__( 'Show Method', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_select_field_show_method_render', 
		'pluginPage', 
		'wp_swift_testimonial_cpt_pluginPage_section' 
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_select_field_page', 
		__( 'Select Page', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_select_field_page_render', 
		'pluginPage', 
		'wp_swift_testimonial_cpt_pluginPage_section' 
	);

	// add_settings_field( 
	// 	'wp_swift_testimonial_cpt_checkbox_field_1', 
	// 	__( 'Settings field description', 'wp-swift-testimonial-cpt' ), 
	// 	'wp_swift_testimonial_cpt_checkbox_field_1_render', 
	// 	'pluginPage', 
	// 	'wp_swift_testimonial_cpt_pluginPage_section' 
	// );

}


function wp_swift_testimonial_cpt_select_field_page_render(  ) { 

	$options = get_option( 'wp_swift_testimonial_cpt_settings' );
	$args = array(
		'posts_per_page'   => 50,
		'post_type'        => 'page',
	);
	$posts_array = get_posts( $args );
	?>
	<select name='wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_select_field_page]'>
		<?php foreach ($posts_array as $key => $post): ?>
			<option value="<?php echo $post->ID; ?>" <?php 
			// selected( $options['wp_swift_testimonial_cpt_select_field_page'], $post->ID ); 
			is_select_set('wp_swift_testimonial_cpt_select_field_page', $options, $post->ID);

			?>><?php echo $post->post_title; ?></option>
		<?php endforeach ?>
	</select>

<?php

}

if (!function_exists('is_select_set')) {
	function is_select_set($name, $options, $value) {
	    if (isset($options[$name]) && $options[$name] == $value) {
	        echo 'selected';
	    }
	}
}

function wp_swift_testimonial_cpt_select_field_show_method_render(  ) { 

	$options = get_option( 'wp_swift_testimonial_cpt_settings' );
	?>
	<select name='wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_select_field_show_method]'>
		<option></option>
		<option value="shortcode" <?php is_select_set( 'wp_swift_testimonial_cpt_select_field_show_method', $options, 'shortcode' ); ?>>Shortcode</option>
		<option value="content" <?php is_select_set( 'wp_swift_testimonial_cpt_select_field_show_method', $options, 'content' ); ?>>After Page Content</option>
		<option value="template" <?php is_select_set( 'wp_swift_testimonial_cpt_select_field_show_method', $options, 'template' ); ?>>Template</option>
	</select>
	<!-- (You use a PHP function) -->
<?php

}
function wp_swift_testimonial_cpt_checkbox_field_1_render(  ) { 

	$options = get_option( 'wp_swift_testimonial_cpt_settings' );
	?>
	<input type='checkbox' name='wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_field_1]' <?php checked( $options['wp_swift_testimonial_cpt_checkbox_field_1'], 1 ); ?> value='1'>
	<?php

}


function wp_swift_testimonial_cpt_settings_section_callback(  ) { 

	echo __( 'WordPress custom post type for testimonials.', 'wp-swift-testimonial-cpt' );

}


function wp_swift_testimonial_cpt_options_page(  ) { 
$options = get_option( 'wp_swift_testimonial_cpt_settings' );
echo "<pre>"; var_dump($options); echo "</pre>";
	?>
	<form action='options.php' method='post'>

		<h2>WP Swift: Testimonials CPT</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}