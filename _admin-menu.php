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

	/*
	 * Settings page
	 */
	register_setting( 'settings_page', 'wp_swift_testimonial_cpt_settings' );

	add_settings_section(
		'wp_swift_testimonial_cpt_settings_page_section', 
		__( 'Settings Page', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_settings_section_callback', 
		'settings_page'
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_checkbox_load_css', 
		__( 'Load Public CSS', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_checkbox_load_css_render', 
		'settings_page', 
		'wp_swift_testimonial_cpt_settings_page_section' 
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_checkbox_supports', 
		__( 'CPT Support', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_checkbox_supports_render', 
		'settings_page', 
		'wp_swift_testimonial_cpt_settings_page_section' 
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_checkbox_markup', 
		__( 'Extra Markup', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_checkbox_markup_render', 
		'settings_page', 
		'wp_swift_testimonial_cpt_settings_page_section' 
	);
	// add_settings_field( 
	// 	'wp_swift_testimonial_cpt_select_field_show_method', 
	// 	__( 'Show Method', 'wp-swift-testimonial-cpt' ), 
	// 	'wp_swift_testimonial_cpt_select_field_show_method_render', 
	// 	'settings_page', 
	// 	'wp_swift_testimonial_cpt_settings_page_section' 
	// );

	// add_settings_field( 
	// 	'wp_swift_testimonial_cpt_select_field_page', 
	// 	__( 'Select Page', 'wp-swift-testimonial-cpt' ), 
	// 	'wp_swift_testimonial_cpt_select_field_page_render', 
	// 	'settings_page', 
	// 	'wp_swift_testimonial_cpt_settings_page_section' 
	// );

	/*
	 * Help page
	 */
	register_setting( 'help_page', 'wp_swift_testimonial_cpt_help' );

	add_settings_section(
		'wp_swift_testimonial_cpt_help_page_section', 
		__( 'Help Page', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_help_section_callback', 
		'help_page'
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_help_shortcode', 
		__( 'Shortcodes', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_help_shortcode_render', 
		'help_page', 
		'wp_swift_testimonial_cpt_help_page_section' 
	);

	add_settings_field( 
		'wp_swift_testimonial_cpt_help_php_function', 
		__( 'PHP Code', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_help_php_function_render', 
		'help_page', 
		'wp_swift_testimonial_cpt_help_page_section' 
	);	

	add_settings_field( 
		'wp_swift_testimonial_cpt_help_sass_function', 
		__( 'Sass Code', 'wp-swift-testimonial-cpt' ), 
		'wp_swift_testimonial_cpt_help_sass_function_render', 
		'help_page', 
		'wp_swift_testimonial_cpt_help_page_section' 
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
			<option value="<?php echo $post->ID; ?>" <?php 
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
function wp_swift_testimonial_cpt_checkbox_load_css_render(  ) { 

	$options = get_option( 'wp_swift_testimonial_cpt_settings' );
	?>
	<input type="checkbox" value="1" name='wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_load_css]' <?php 
		if (isset($options['wp_swift_testimonial_cpt_checkbox_load_css'])) {
			checked( $options['wp_swift_testimonial_cpt_checkbox_load_css'], 1 ); 
		}
		?>><small>Use the plugin to load a CSS file.</small>
	<?php
}
function wp_swift_testimonial_cpt_checkbox_supports_render( ) { 

	$options = get_option( 'wp_swift_testimonial_cpt_settings' );
	?>
	<input type="checkbox" value="1" name='wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_support_featured_image]' <?php 
		if (isset($options['wp_swift_testimonial_cpt_checkbox_support_featured_image'])) {
			checked( $options['wp_swift_testimonial_cpt_checkbox_support_featured_image'], 1 ); 
		}
		?>><label for="wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_support_featured_image]">Featured Image</label>
	<br>
	<input type="checkbox" value="1" name='wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_support_excerpt]' <?php 
		if (isset($options['wp_swift_testimonial_cpt_checkbox_support_excerpt'])) {
			checked( $options['wp_swift_testimonial_cpt_checkbox_support_excerpt'], 1 ); 
		}
		?>><label for="wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_support_excerpt]">Excerpt</label>
	<?php
}
function wp_swift_testimonial_cpt_checkbox_markup_render( ) {

	$options = get_option( 'wp_swift_testimonial_cpt_settings' );
	?>
	<input type="checkbox" value="1" name='wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_markup_icon]' <?php 
		if (isset($options['wp_swift_testimonial_cpt_checkbox_markup_icon'])) {
			checked( $options['wp_swift_testimonial_cpt_checkbox_markup_icon'], 1 ); 
		}
	?>><label for="wp_swift_testimonial_cpt_settings[wp_swift_testimonial_cpt_checkbox_markup_icon]">Show Quote Icon</label><?php
}
function wp_swift_testimonial_cpt_help_shortcode_render( ) { 
?>
<pre class="prettyprint custom">
// WordPress shortcode

[testimonials]
</pre>
<?php
}


function wp_swift_testimonial_cpt_help_php_function_render(  ) { 
?>
<pre class="prettyprint lang-php custom">
// Render the testimonials

if (function_exists('wp_swift_testimonials_func')) {
  echo wp_swift_testimonials_func();
}
</pre>
<?php
}

function wp_swift_testimonial_cpt_help_sass_function_render(  ) { 
?>
<p>Sample sass code</p>
<pre class="prettyprint lang-scss custom">
.testimonial {
	background-color: rgba($primary-color, 0.05);
	padding: 20px;
	margin-bottom: 40px;
	.icon {
		color: $primary-color;
		font-size: 60px;
		padding-bottom: 10px;
	}
	.testimonial-content {
		font-size: 105%;
	}	
	.testimonial-meta {
		padding-top: 15px;
		clear: all;
		border-top: 1px solid rgba($primary-color, 0.5);

	}
	.testimonial-header {
		font-size: 125%;
		font-family: $header-font-family;
	}
	.testimonial-position-organisation {
		font-style: italic;
		font-weight: bold;
	}
}
.testimonial.even {
	border-left: 3px solid $primary-color;
	.testimonial-meta {
		text-align: right;
	}
	.icon {
		padding-left: 10px;
		float: right;
	}
}
.testimonial.odd {
	border-right: 3px solid $primary-color;
	.icon {
		padding-right: 10px;
		float: left;
	}
}
</pre>
<?php
}

function wp_swift_testimonial_cpt_settings_section_callback(  ) { 

	echo __( 'WordPress custom post type for testimonials.', 'wp-swift-testimonial-cpt' );

}
function wp_swift_testimonial_cpt_help_section_callback(  ) { 
	?><p>To render the <b>Testimonials</b> onto a webpage there are two options: PHP code and WordPress <a href="https://codex.wordpress.org/Shortcode" target="_blank">Shortcodes</a>.</p><?php
}
function wp_swift_testimonial_cpt_options_page(  ) { 
?><div id="wp-swift-testimonial-cpt-options-page" class="wrap">

	<h1>WP Swift: Testimonials CPT</h1>

	<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'settings_page'; ?>

	<h2 class="nav-tab-wrapper">
	    <a href="?page=wp_swift_testimonials_cpt&tab=settings_page" class="nav-tab <?php echo $active_tab == 'settings_page' ? 'nav-tab-active' : ''; ?>">Settings</a>
	    <a href="?page=wp_swift_testimonials_cpt&tab=help_page" class="nav-tab <?php echo $active_tab == 'help_page' ? 'nav-tab-active' : ''; ?>">Help Page</a>
	</h2>

		<?php
			if ($active_tab == 'settings_page') {
				echo "<form action='options.php' method='post'>";
				settings_fields( 'settings_page' );
				do_settings_sections( 'settings_page' );
				submit_button();
				echo "</form>";
			}
			elseif ($active_tab == 'help_page'){
				
				settings_fields( 'help_page' );
				do_settings_sections( 'help_page' );
				
			}
		?>
</div><!-- @end #wp-swift-testimonial-cpt-options-page --><?php
}