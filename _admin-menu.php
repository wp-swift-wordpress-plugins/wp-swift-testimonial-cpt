<?php
add_action( 'admin_menu', 'wp_swift_testimonial_cpt_add_admin_menu' );
add_action( 'admin_init', 'wp_swift_testimonial_cpt_settings_init' );


function wp_swift_testimonial_cpt_add_admin_menu(  ) { 

	add_options_page( 'WP Swift: Testimonials CPT', 'Testimonials', 'manage_options', 'wp_swift_testimonials_cpt', 'wp_swift_testimonial_cpt_options_page' );

}


function wp_swift_testimonial_cpt_settings_init(  ) { 

	register_setting( 'pluginPage', 'wp_swift_testimonial_cpt_settings' );

	add_settings_section(
		'wp_swift_testimonial_cpt_pluginPage_section', 
		__( 'Your section description', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_select_field_page', 
		__( 'Settings field description', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_select_field_page_render', 
		'pluginPage', 
		'wp_swift_testimonial_cpt_pluginPage_section' 
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_checkbox_field_1', 
		__( 'Settings field description', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_checkbox_field_1_render', 
		'pluginPage', 
		'wp_swift_testimonial_cpt_pluginPage_section' 
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_checkbox_field_2', 
		__( 'Settings field description', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_checkbox_field_2_render', 
		'pluginPage', 
		'wp_swift_testimonial_cpt_pluginPage_section' 
	);


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
			<option value="<?php echo $post->ID; ?>" <?php selected( $options['wp_swift_testimonial_cpt_select_field_page'], 2 ); ?>><?php echo $post->post_title; ?></option>
		<?php endforeach ?>
	</select>

<?php

}


function wp_swift_testimonial_cpt_checkbox_field_1_render(  ) { 

	$options = get_option( 'wp_swift_testimonial_cpt_settings' );
	?>
	<input type='checkbox' name='wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_field_1]' <?php checked( $options['wp_swift_testimonial_cpt_checkbox_field_1'], 1 ); ?> value='1'>
	<?php

}


function wp_swift_testimonial_cpt_checkbox_field_2_render(  ) { 

	$options = get_option( 'wp_swift_testimonial_cpt_settings' );
	?>
	<input type='checkbox' name='wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_field_2]' <?php checked( $options['wp_swift_testimonial_cpt_checkbox_field_2'], 1 ); ?> value='1'>
	<?php

}


function wp_swift_testimonial_cpt_settings_section_callback(  ) { 

	echo __( 'This section description', 'wp-swift-testimonial-cpt' );

}


function wp_swift_testimonial_cpt_options_page(  ) { 

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