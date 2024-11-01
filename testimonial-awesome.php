<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themesawesome.com/
 * @since             1.0.0
 * @package           Testimonial_Awesome
 *
 * @wordpress-plugin
 * Plugin Name:       Testimonial Awesome
 * Plugin URI:        https://testimonial.themesawesome.com/
 * Description:       Testimonial Awesome is an awesome plugin that helps You to create the Testimonials interface element into your WordPress Site.
 * Version:           1.0.1
 * Author:            Themes Awesome
 * Author URI:        https://themesawesome.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       testimonial-awesome
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TESTIMONIAL_AWESOME_VERSION', '1.0.1' );

define( 'TESTIMONIAL_AWESOME', __FILE__ );

define( 'TESTIMONIAL_AWESOME_BASENAME', plugin_basename( TESTIMONIAL_AWESOME ) );

define( 'TESTIMONIAL_AWESOME_NAME', trim( dirname( TESTIMONIAL_AWESOME_BASENAME ), '/' ) );

define( 'TESTIMONIAL_AWESOME_DIR', untrailingslashit( dirname( TESTIMONIAL_AWESOME ) ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-testimonial-awesome-activator.php
 */
function activate_testimonial_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-awesome-activator.php';
	Testimonial_Awesome_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-testimonial-awesome-deactivator.php
 */
function deactivate_testimonial_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-awesome-deactivator.php';
	Testimonial_Awesome_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_testimonial_awesome' );
register_deactivation_hook( __FILE__, 'deactivate_testimonial_awesome' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-awesome.php';

require plugin_dir_path( __FILE__ ) . 'testimonial-awesome-post-type.php';

require_once plugin_dir_path( __FILE__ ).'includes/element-helper.php';
require_once plugin_dir_path( __FILE__ ).'public/partials/get-views-part.php';

function testimonial_awesome_new_elements(){
  require_once plugin_dir_path( __FILE__ ).'elementor-widgets/testimonials/testimonial-control.php';
}

add_action('elementor/widgets/widgets_registered','testimonial_awesome_new_elements');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_testimonial_awesome() {

	$plugin = new Testimonial_Awesome();
	$plugin->run();

}
run_testimonial_awesome();

/* Shortcode Function */
add_filter('manage_testimonial-awesome_posts_columns', function($columns) {
	return array_merge($columns, ['shortcode' => __('Shortcode', 'testimonial-awesome')]);
});
 
add_action('manage_testimonial-awesome_posts_custom_column', function($column_key, $post_id) {
	echo '<pre"><code>[testimonial_awesome id="'. esc_attr( $post_id ) .'"]</code></pre>';
}, 10, 2);

add_filter( 'single_template', 'testimonial_awesome_post_custom_template', 50, 1 );
function testimonial_awesome_post_custom_template( $template ) {

	if ( is_singular( 'testimonial-awesome' ) ) {
		$template = TESTIMONIAL_AWESOME_DIR . '/single-testimonial-awesome.php';
	}
	
	return $template;
}


add_action( 'after_setup_theme', 'testimonial_awesome_crb_load' );
function testimonial_awesome_crb_load() {
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'elementor/preview/enqueue_styles', function() {
	wp_enqueue_style( 'ta-testimonial-awesome-swiper', plugin_dir_url( __FILE__ ) . 'public/css/swiper.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-testimonial-awesome-fontawesome', plugin_dir_url( __FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-testimonial-awesome-thaw-flexgrid', plugin_dir_url( __FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-testimonial-awesome-style', plugin_dir_url( __FILE__ ) . 'public/css/testimonial-awesome-public.css', array(), '', 'all' );

	wp_enqueue_script( 'ta-testimonial-awesome-swiper', plugin_dir_url( __FILE__ ) . 'public/js/swiper.min.js', array( 'jquery' ), '', false );
} );

function testimonial_awesome( $atts ) {

	// Get Attributes
	extract( shortcode_atts(
			array(
				'id' => ''   // DEFAULT SLUG SET TO EMPTY
			), $atts )
	);

	// WP_Query arguments
	$args = array (
		'page_id'              =>  $id,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
		'post_type'         => 'testimonial-awesome', // YOUR POST TYPE

	);
	ob_start();

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() && $id != '' ) {

		wp_enqueue_style( 'ta-testimonial-awesome-fontawesome', plugin_dir_url( __FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-testimonial-awesome-thaw-flexgrid', plugin_dir_url( __FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-testimonial-awesome-style', plugin_dir_url( __FILE__ ) . 'public/css/testimonial-awesome-public.css', array(), '', 'all' );

		while ( $query->have_posts() ) {

			$query->the_post();

			$testimonial_style = carbon_get_post_meta( get_the_ID(), 'testimonial_style_choice' );

			if($testimonial_style == 'testimonial-style-3') {
				$testimonial_style_part = dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-3.php';
			}
			elseif($testimonial_style == 'testimonial-style-4') {
				$testimonial_style_part = dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-4.php';
			}
			elseif($testimonial_style == 'testimonial-style-8') {
				$testimonial_style_part = dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-8.php';
			}
			elseif($testimonial_style == 'testimonial-style-14-grid') {
				$testimonial_style_part = dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-14-grid.php';
			}
			elseif($testimonial_style == 'testimonial-style-15-grid') {
				$testimonial_style_part = dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-15-grid.php';
			}
			elseif($testimonial_style == 'testimonial-style-14-carousel') {
				$testimonial_style_part = dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-14-carousel.php';
			}
			elseif($testimonial_style == 'testimonial-style-15-carousel') {
				$testimonial_style_part = dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-15-carousel.php';
			}
			include_once $testimonial_style_part;
		}
	} else {
		// no posts found
		return esc_html__( 'Sorry You have set no html for this slug...', 'testimonial-awesome' );

	}


// Restore original Post Data
	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode( 'testimonial_awesome', 'testimonial_awesome' );

function testimonial_awesome_select_testimonial_post() {
	$testimonials_array = array();

	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'testimonial-awesome',
	);

	$testimonials = get_posts($args);

	foreach( $testimonials as $post ) { setup_postdata( $post );
		$testimonials_array[$post->ID] = $post->post_title;
	}

	return $testimonials_array;

	wp_reset_postdata();
}

add_action( 'wp_head', 'testimonial_awesome_fonts_custom_styles', 10 );
function testimonial_awesome_fonts_custom_styles() {

	$testimonial_awesome_custom_args = array(
		'post_type'         => 'testimonial-awesome',
		'posts_per_page'    => -1,
	);
	$testimonial_awesome_custom = new WP_Query($testimonial_awesome_custom_args);
	if ($testimonial_awesome_custom->have_posts()) : ?>

	<style>
		<?php while($testimonial_awesome_custom->have_posts()) : $testimonial_awesome_custom->the_post();
			
		$testimonial_name_color = carbon_get_post_meta( get_the_ID(), 'testimonial_name_color' );
		$testimonial_job_color = carbon_get_post_meta( get_the_ID(), 'testimonial_job_color' );
		$testimonial_bio_color = carbon_get_post_meta( get_the_ID(), 'testimonial_bio_color' );
		$testimonial_quote_color = carbon_get_post_meta( get_the_ID(), 'testimonial_quote_color' );
		$testimonial_icon_color = carbon_get_post_meta( get_the_ID(), 'testimonial_icon_color' );
		$testimonial_icon_bg_color = carbon_get_post_meta( get_the_ID(), 'testimonial_icon_bg_color' );
		$testimonial_icon_color_hover = carbon_get_post_meta( get_the_ID(), 'testimonial_icon_color_hover' );
		$testimonial_icon_bg_color_hover = carbon_get_post_meta( get_the_ID(), 'testimonial_icon_bg_color_hover' );
		$testimonial_padding = carbon_get_post_meta( get_the_ID(), 'testimonial_padding' );

		// style 1
		$testimonial_style1_height = carbon_get_post_meta( get_the_ID(), 'testimonial_style1_height' );
 
		// style 10
		$testimonial_10_overlay_color = carbon_get_post_meta( get_the_ID(), 'testimonial_10_overlay_color' );

		// style 11
		$testimonial_name_bg_color = carbon_get_post_meta( get_the_ID(), 'testimonial_name_bg_color' );

		// style 19
		$testimonial_style19_height = carbon_get_post_meta( get_the_ID(), 'testimonial_style19_height' ); 

		// Carousel
		$testimonial_slider_arrow = carbon_get_post_meta( get_the_ID(), 'testimonial_slider_arrow' ); 
		$testimonial_slider_dots = carbon_get_post_meta( get_the_ID(), 'testimonial_slider_dots' ); 


		if(!empty($testimonial_name_color)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .testimonial-name h1, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> h1.testimonial-name, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .testimonial-name {
				color: <?php echo esc_html($testimonial_name_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($testimonial_job_color)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .testimonial-job span, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> span.testimonial-job {
				color: <?php echo esc_html($testimonial_job_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($testimonial_bio_color)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .testimonial-bio p, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> p.testimonial-bio, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .testimonial-bio blockquote{
				color: <?php echo esc_html($testimonial_bio_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($testimonial_quote_color)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .testimonial-bio blockquote:before, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .testimonial-bio blockquote:after{
				color: <?php echo esc_html($testimonial_quote_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($testimonial_icon_color)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .social-item a, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> a.social-item {
				color: <?php echo esc_html($testimonial_icon_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($testimonial_icon_bg_color)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .social-item a, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> a.social-item {
				background-color: <?php echo esc_html($testimonial_icon_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($testimonial_icon_color_hover)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .social-item a:hover, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> a.social-item:hover, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .testimonial-block .inner-box:hover .social-icons li a {
				color: <?php echo esc_html($testimonial_icon_color_hover); ?>;
			}
		<?php } ?>

		<?php if(!empty($testimonial_icon_bg_color_hover)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .social-item a:hover, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> a.social-item:hover {
				background-color: <?php echo esc_html($testimonial_icon_bg_color_hover); ?>;
			}
		<?php } ?>

		<?php if(!empty($testimonial_padding)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .grid,
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?>.grid {
				gap: <?php echo esc_html($testimonial_padding); ?>px;
			}
		<?php } ?>

		<?php if(!empty($testimonial_style19_height)) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?>.testi-style-sembilanbelas .defilee__outer {
				height: <?php echo intval($testimonial_style19_height); ?>px;
				max-height: <?php echo intval($testimonial_style19_height); ?>px;
			}
		<?php } ?>

		<?php if(!empty($testimonial_style1_height) ) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .sl-slider-wrapper, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .sl-slider {
				height: <?php echo intval($testimonial_style1_height); ?>px !important; 
			}
		<?php } ?>

		<?php if(!empty($testimonial_name_bg_color) ) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .testi-style-sebelas .testimonial-name {
				background: <?php echo esc_html($testimonial_name_bg_color); ?>; 
			}
		<?php } ?>

		<?php if(!empty($testimonial_slider_arrow) ) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-button-next:after, .testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-button-prev:after {
				color: <?php echo esc_html($testimonial_slider_arrow); ?>; 
			}
		<?php } ?>

		<?php if(!empty($testimonial_slider_dots) ) { ?>
			.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-pagination-bullet {
				background: <?php echo esc_html($testimonial_slider_dots); ?> !important; 
			}
		<?php } ?>

	 
		<?php endwhile; wp_reset_postdata(); ?>
	</style>

<?php endif;
}