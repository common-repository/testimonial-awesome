<?php get_header();

$template = get_template();

global $wp;

if ( have_posts() ):

    wp_enqueue_style( 'ta-testimonial-awesome-fontawesome', plugin_dir_url( __FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
    wp_enqueue_style( 'ta-testimonial-awesome-thaw-flexgrid', plugin_dir_url( __FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
    wp_enqueue_style( 'ta-testimonial-awesome-style', plugin_dir_url( __FILE__ ) . 'public/css/testimonial-awesome-public.css', array(), '', 'all' );

while ( have_posts() ) : the_post();

	$testimonial_style = carbon_get_post_meta( get_the_ID(), 'testimonial_style_choice' );

    if($testimonial_style == 'testimonial-style-3') {
        echo '<div class="testimonial-container">';
            include_once  dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-3.php';
        echo '</div>';
    }
    elseif($testimonial_style == 'testimonial-style-4') {
        include_once  dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-4.php';
    }
    elseif($testimonial_style == 'testimonial-style-8') {
        include_once  dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-8.php';
    }
    elseif($testimonial_style == 'testimonial-style-14-grid') {
        include_once  dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-14-grid.php';
    }
    elseif($testimonial_style == 'testimonial-style-15-grid') {
        include_once  dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-15-grid.php';
    }
    elseif($testimonial_style == 'testimonial-style-14-carousel') {
        include_once  dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-14-carousel.php';
    }
    elseif($testimonial_style == 'testimonial-style-15-carousel') {
        include_once  dirname( __FILE__ ) .'/public/testimonial-styles/testimonial-style-15-carousel.php';
    }
   

$template = get_template();

endwhile; 
endif;
wp_reset_postdata();
get_footer(); ?>