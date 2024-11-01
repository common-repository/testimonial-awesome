<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

Container::make( 'post_meta', 'side_shortcode', esc_html__( 'Shortcode', 'testimonial-awesome' ) )
	->where( 'post_type', '=', 'testimonial-awesome' )
	->set_context( 'side' )
	->set_priority( 'default' )
	->add_fields( array(

	Field::make( 'html', 'testimonial_style', esc_html__( 'Section Description', 'testimonial-awesome' ) )
		->set_html( sprintf( '<div class="shortcode-wrap-ta"><code id="shortcode_testimonial_to_copy"></code></div>', __( 'Here, you can add some useful description for the fields below / above this text.' ) ) ),
));
