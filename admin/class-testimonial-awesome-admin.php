<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themesawesome.com/
 * @since      1.0.0
 *
 * @package    Testimonial_Awesome
 * @subpackage Testimonial_Awesome/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Testimonial_Awesome
 * @subpackage Testimonial_Awesome/admin
 * @author     Themes Awesome <admin@themesawesome>
 */
class Testimonial_Awesome_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('admin_menu', array( $this, 'addPluginAdminMenu' ), 9);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Testimonial_Awesome_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Testimonial_Awesome_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/testimonial-awesome-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Testimonial_Awesome_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Testimonial_Awesome_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/testimonial-awesome-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function addPluginAdminMenu() {
		global $submenu;
		$submenu['edit.php?post_type=testimonial-awesome'][] = array('Documentation', 'manage_options', 'https://themesawesome.zendesk.com/hc/en-us/categories/360004250771-Testimonial-Awesome');
		$submenu['edit.php?post_type=testimonial-awesome'][] = array('Go Pro', 'manage_options', 'https://1.envato.market/yddKb');
	}


}
