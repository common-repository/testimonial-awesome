<?php
/*-----------------------------------------------------------------------------------*/
/* TImeline Awesome Post Type
/*-----------------------------------------------------------------------------------*/


add_action('init', 'testimonial_awesome_register');

function testimonial_awesome_register() {

	$labels = array(
		'name'                => esc_html_x( 'Testimonials', 'Post Type General Name', 'testimonial-awesome' ),
		'singular_name'       => esc_html_x( 'Testimonials', 'Post Type Singular Name', 'testimonial-awesome' ),
		'menu_name'           => esc_html__( 'Testimonials', 'testimonial-awesome' ),
		'parent_item_colon'   => esc_html__( 'Parent Testimonials:', 'testimonial-awesome' ),
		'all_items'           => esc_html__( 'All Testimonials', 'testimonial-awesome' ),
		'view_item'           => esc_html__( 'View Testimonials', 'testimonial-awesome' ),
		'add_new_item'        => esc_html__( 'Add New Testimonials', 'testimonial-awesome' ),
		'add_new'             => esc_html__( 'Add New', 'testimonial-awesome' ),
		'edit_item'           => esc_html__( 'Edit Testimonials', 'testimonial-awesome' ),
		'update_item'         => esc_html__( 'Update Testimonials', 'testimonial-awesome' ),
		'search_items'        => esc_html__( 'Search Testimonials', 'testimonial-awesome' ),
		'not_found'           => esc_html__( 'Not found', 'testimonial-awesome' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'testimonial-awesome' ),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => 'testimonials',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'rewrite'            => array( 'slug' => 'testimonials' ),
		'supports'           => array('title'),
		'menu_position'       => 7,
		'has_archive'           => false,
		'exclude_from_search'   => true,


	);
	register_post_type( 'testimonial-awesome', $args );

}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'testimonial_awesome_field_in_post' );
function testimonial_awesome_field_in_post() {

	require dirname( __FILE__ ) . '/testimonial-awesome-ctrl.php';

	Container::make( 'post_meta', 'testimonial_repeater_cont', esc_html('Testimonial Awesome') )
	->where( 'post_type', '=', 'testimonial-awesome' )
	->set_priority( 'high' )

	->add_tab(  __( 'Layout' ), array(
		Field::make( 'select', 'testimonial_style_choice', esc_html__( 'Select Style', 'testimonial-awesome' ) )
		->add_options( array(
			'testimonial-style-3' => 'Unique Tilu',
			'testimonial-style-4' => 'Unique Opat',
			'testimonial-style-8' => 'Unique Dalapan',
			'testimonial-style-14-grid' => 'Unique Opatbelas Grid',
			'testimonial-style-15-grid' => 'Unique Limabelas Grid',
			'testimonial-style-14-carousel' => 'Unique Opatbelas Carousel',
			'testimonial-style-15-carousel' => 'Unique Limabelas Carousel',
		) ),

		Field::make( 'select', 'testimonial_style_choice_grid_col', esc_html__( 'Select Column', 'testimonial-awesome' ) )
		->set_width( 50 )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-grid',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-grid',
				'compare' => '=',
			),
		  
		) )
		->add_options( array(
			'12' => '1',
			'6' => '2',
			'4' => '3',
			'3' => '4',
		) ),
		
		Field::make( 'text', 'testimonial_padding', esc_html__( 'Padding', 'testimonial-awesome' ) )
		->set_width( 50 )
		->set_attribute( 'placeholder', '30' )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-grid',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-grid',
				'compare' => '=',
			),
		) ),

		Field::make( 'select', 'testimonial_choose_column', esc_html__( 'Select Column', 'testimonial-awesome' ) )
		->set_width( 50 )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-3',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-carousel',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-carousel',
				'compare' => '=',
			),
		) )
		->add_options( array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		) ),

		Field::make( 'select', 'testimonial_choose_column_tablet', esc_html__( 'Select Column on Tablet', 'testimonial-awesome' ) )
		->set_width( 50 )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-carousel',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-carousel',
				'compare' => '=',
			),
		) )
		->add_options( array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		) ),

		Field::make( 'select', 'testimonial_choose_column_mobile', esc_html__( 'Select Column on Mobile', 'testimonial-awesome' ) )
		->set_width( 50 )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-carousel',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-carousel',
				'compare' => '=',
			),
		) )
		->add_options( array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		) ),

		Field::make( 'text', 'testimonial_space_item', esc_html__( 'Space Items', 'testimonial-awesome' ) )
		->set_attribute( 'placeholder', '50' )
		->set_width( 50 )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-3',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-carousel',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-carousel',
				'compare' => '=',
			),
		) ),
		Field::make( 'checkbox', 'testimonial_use_arrow', esc_html__( 'Use Arrow Navigation', 'testimonial-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-carousel',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-carousel',
				'compare' => '=',
			),
		) )
		->set_width( 25 )
		->set_option_value( 'yes' ),

		Field::make( 'checkbox', 'testimonial_use_pagination', esc_html__( 'Use Pagination', 'testimonial-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-carousel',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-carousel',
				'compare' => '=',
			),
		) )
		->set_width( 25 )
		->set_option_value( 'yes' ),

		Field::make( 'checkbox', 'testimonial_use_autoplay', esc_html__( 'Use Autoplay', 'testimonial-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-carousel',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-carousel',
				'compare' => '=',
			),
		) )
		->set_width( 25 )
		->set_option_value( 'yes' ),

		Field::make( 'checkbox', 'testimonial_use_loop', esc_html__( 'Loop', 'testimonial-awesome' ) )
		->set_conditional_logic( array(
			'relation' => 'OR',
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-14-carousel',
				'compare' => '=',
			),
			array(
				'field' => 'testimonial_style_choice',
				'value' => 'testimonial-style-15-carousel',
				'compare' => '=',
			),
		) )
		->set_width( 25 )
		->set_option_value( 'yes' ),


		Field::make( 'text', 'testimonial_autoplay_speed', esc_html__( 'Autoplay Speed (in Millisecond)', 'testimonial-awesome' ) )
		->set_attribute( 'placeholder', '2500' )
		->set_width( 50 )
		->set_conditional_logic( array(
			'relation' => 'AND',
			array(
				'field' => 'testimonial_use_autoplay',
				'value' => true,
				'compare' => '=',
			),
		) ),


	))
  
	->add_tab(  __( 'Content' ), array(
		Field::make( 'complex', 'testimonial_items', esc_html__( 'Testimonial Items', 'testimonial-awesome' ) )
		->set_layout( 'tabbed-horizontal' )
		->add_fields( array(
				Field::make( 'text', 'testimonial_item_name', esc_html__( 'Author Name', 'testimonial-awesome' ) )
				->set_attribute( 'placeholder', 'John Doe' )
				->set_width( 40 ),

				Field::make( 'text', 'testimonial_job', esc_html__( 'Author Job', 'testimonial-awesome' ) )
				->set_attribute( 'placeholder', 'CEO' )
				->set_width( 25 ),

				Field::make( 'textarea', 'testimonial_item_bio', esc_html__( 'Testimonial Quote', 'testimonial-awesome' ) )
				->set_attribute( 'placeholder', 'Put your text here...' )
				->set_width( 80 ),

				Field::make( 'image', 'testimonial_item_img', esc_html__( 'Testimonial Image', 'testimonial-awesome' ) )
				->set_width( 20 ) ,

				Field::make( 'textarea', 'testimonial_desc', esc_html__( 'Author Description', 'testimonial-awesome' ) )
				->set_attribute( 'placeholder', 'Put your text here...' )
				->set_conditional_logic( array(
					array(
						'field' => 'parent.testimonial_style_choice',
						'value' => 'testimonial-style-4',
						'compare' => '=',
					)
				) ),

				Field::make( 'separator', 'testimonial_custom_option', 'Optional' ),
				
				Field::make( 'complex', 'testimonial_items_socials', esc_html__( 'Testimonial Social', 'testimonial-awesome' ) )
				->set_layout( 'tabbed-horizontal' )
				->add_fields( array(

					Field::make( 'icon', 'testimonial_item_social_icon', esc_html__( 'Icon', 'testimonial-awesome' ) )
					->set_width( 40 ),
					Field::make( 'text', 'testimonial_item_social_link', esc_html__( 'Testimonial Link', 'testimonial-awesome' ) )
					->set_attribute( 'placeholder', 'http://' )
					->set_width( 40 ),
				))
				->set_default_value( array(
					array(
					),
				) ),
		) )
		->set_default_value( array(
			array(
			),
		) ),
	))
	->add_tab(  __( 'Customize' ), array(
		Field::make( 'html', 'asfafaf' )
	   	->set_html( '<p>In order to customize colors, let&#39;s upgrade to pro</p><a href="https://1.envato.market/yddKb" target="_blank" class="btn-buy">Upgrade to Pro</a>' )	
		
	));

	// For Gutenberg Blocks
	Block::make( esc_html( 'Testimonial Awesome' ) )
	->add_fields( array(
		Field::make( 'association', 'testimonial_gutenberg_block', esc_html__( 'Testimonial Awesome Post', 'testimonial-awesome' ) )
		->set_min( 1 )
		->set_max( 1 )
		->set_types( array(
			array(
				'type'      => 'post',
				'post_type' => 'testimonial-awesome',
			)
		) )
	) )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		require dirname( __FILE__ ) .'/gutenberg-blocks/testimonial-block.php';
	} );

}