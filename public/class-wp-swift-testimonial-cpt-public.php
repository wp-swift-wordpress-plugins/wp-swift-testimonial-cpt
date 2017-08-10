<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/wp-swift-wordpress-plugins
 * @since      1.0.0
 *
 * @package    Wp_Swift_Testimonial_Cpt
 * @subpackage Wp_Swift_Testimonial_Cpt/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Swift_Testimonial_Cpt
 * @subpackage Wp_Swift_Testimonial_Cpt/public
 * @author     Gary Swift <garyswiftmail@gmail.com>
 */
class Wp_Swift_Testimonial_Cpt_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_styles_admin') );
		// add_action( 'wp_enqueue_style', array($this, 'enqueue_styles'), 100 );
		add_shortcode( 'testimonials', array($this, 'testimonials_func') );

	}


	// [testimonials foo="foo-value"]
	public function testimonials_func( $atts ) {
	    // $a = shortcode_atts( array(
	    //     'foo' => 'something',
	    //     'bar' => 'something else',
	    // ), $atts );
	    // return "foo = {$a['foo']}";
	    $html='';
		require_once plugin_dir_path( __FILE__ ) . 'partials/wp-swift-testimonial-cpt-public-display.php';
		return $html;
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Swift_Testimonial_Cpt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Swift_Testimonial_Cpt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$options = get_option( 'wp_swift_testimonial_cpt_settings' );
		if (isset($options['wp_swift_testimonial_cpt_checkbox_load_css'])) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-swift-testimonial-cpt-public.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles_admin() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Swift_Testimonial_Cpt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Swift_Testimonial_Cpt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-swift-testimonial-cpt-admin.css', array(), $this->version, 'all' );

	}
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Swift_Testimonial_Cpt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Swift_Testimonial_Cpt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-swift-testimonial-cpt-public.js', array( 'jquery' ), $this->version, false );

	}

}
/*
 * Fucntion that does the samething as the shortcode
 */
function wp_swift_testimonials_func( $atts ) {
    // $a = shortcode_atts( array(
    //     'foo' => 'something',
    //     'bar' => 'something else',
    // ), $atts );
    // return "foo = {$a['foo']}";
    $html='';
	require_once plugin_dir_path( __FILE__ ) . 'partials/wp-swift-testimonial-cpt-public-display.php';
	return $html;
}
/*
 * Helper function that can wrap the organisation in a link
 */
function wp_swift_get_testimonial_organisation($id) {
    if(get_field('organisation', $id)){
        $organisation = get_field('organisation', $id);
        if( get_field('website', $id) ) {
            $website = get_field('website', $id);
            $organisation = '<a href="'.$website.'" target="_blank">'.$organisation.'</a>';
        }
    } 
    return $organisation;   
}