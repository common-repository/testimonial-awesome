<?php

	$args = array (
		'p'              => $testimonial_awesome_select_testimonial,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
		'post_type'         => 'testimonial-awesome', // YOUR POST TYPE

	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() && $testimonial_awesome_select_testimonial != '' ) {

		wp_enqueue_style( 'ta-testimonial-awesome-fontawesome', plugin_dir_url('README.txt') . TESTIMONIAL_AWESOME_NAME . '/public/css/fontawesome.min.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-testimonial-awesome-thaw-flexgrid', plugin_dir_url('README.txt') . TESTIMONIAL_AWESOME_NAME . '/public/css/thaw-flexgrid.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-testimonial-awesome-style', plugin_dir_url('README.txt') . TESTIMONIAL_AWESOME_NAME . '/public/css/testimonial-awesome-public.css', array(), '', 'all' );

		while ( $query->have_posts() ) {

		$query->the_post();

			$testimonial_style = carbon_get_post_meta( get_the_ID(), 'testimonial_style_choice' );

			if($testimonial_style == 'testimonial-style-3') {
				$testimonial_style_part = TESTIMONIAL_AWESOME_DIR .'/public/testimonial-styles/testimonial-style-3.php';
			}
			elseif($testimonial_style == 'testimonial-style-4') {
				$testimonial_style_part = TESTIMONIAL_AWESOME_DIR .'/public/testimonial-styles/testimonial-style-4.php';
			}
			elseif($testimonial_style == 'testimonial-style-8') {
				$testimonial_style_part = TESTIMONIAL_AWESOME_DIR .'/public/testimonial-styles/testimonial-style-8.php';
			}
			elseif($testimonial_style == 'testimonial-style-14-grid') {
				$testimonial_style_part = TESTIMONIAL_AWESOME_DIR .'/public/testimonial-styles/testimonial-style-14-grid.php';
			}
			elseif($testimonial_style == 'testimonial-style-15-grid') {
				$testimonial_style_part = TESTIMONIAL_AWESOME_DIR .'/public/testimonial-styles/testimonial-style-15-grid.php';
			}
			elseif($testimonial_style == 'testimonial-style-14-carousel') {
				$testimonial_style_part = TESTIMONIAL_AWESOME_DIR .'/public/testimonial-styles/testimonial-style-14-carousel.php';
			}
			elseif($testimonial_style == 'testimonial-style-15-carousel') {
				$testimonial_style_part = TESTIMONIAL_AWESOME_DIR .'/public/testimonial-styles/testimonial-style-15-carousel.php';
			}
			include $testimonial_style_part;
		}
	} else {
		// no posts found
		return esc_html__( 'Sorry You have set no html for this slug...', 'testimonial-awesome' );

	}