<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class testimonial_awesome_post_block extends Widget_Base {

	public function get_name() {
		return 'testimonial_awesome-post-block';
	}

	public function get_title() {
		return __( 'Testimonials', 'testimonial-awesome' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'testimonial_awesome-general-category' ];
	}

	protected function _register_controls() {
		/*-----------------------------------------------------------------------------------
			POST BLOCK INDEX
			1. POST SETTING
		-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/*  1. POST SETTING
		/*-----------------------------------------------------------------------------------*/
		$this->start_controls_section(
			'section_testimonial_awesome_post_block_post_setting',
			[
				'label' => __( 'Post Setting', 'testimonial-awesome' ),
			]
		);

		$this->add_control(
			'testimonial_awesome_select_testimonial',
			[
				'label' => __( 'Select Testimonial', 'gedung' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => testimonial_awesome_select_testimonial_post(),
				'description' => __( 'Select post order by (default to latest post).', 'gedung' ),
			]
		);

		$this->end_controls_section();
		/*-----------------------------------------------------------------------------------
			end of post block post setting
		-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
		'section_testimonial_awesome_block_setting',
			[
				'label' => esc_html__( 'Title', 'testimonial-awesome' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_testimonial_awesome_fff_setting',
			[
				'name' => 'fff_schemes_notice',
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( '<p>In order to customize fonts, let&#39;s upgrade to pro</p><br /><a href="https://1.envato.market/yddKb" class="btn-buy" target="_blank">Upgrade to Pro</a>', 'testimonial-awesome' ), Settings::get_url() ),
				'content_classes' => 'fasgag',
				'render_type' => 'ui',
			]
		);
	}

	protected function render() {

		$instance = $this->get_settings();

		/*-----------------------------------------------------------------------------------*/
		/*  VARIABLES LIST
		/*-----------------------------------------------------------------------------------*/

		/* POST SETTING VARIBALES */
		$testimonial_awesome_select_testimonial 			= ! empty( $instance['testimonial_awesome_select_testimonial'] ) ? $instance['testimonial_awesome_select_testimonial'] : '';


		/* end of variables list */


		/*-----------------------------------------------------------------------------------*/
		/*  THE CONDITIONAL AREA
		/*-----------------------------------------------------------------------------------*/

		include ( plugin_dir_path(__FILE__).'tpl/testimonial-block.php' );

		?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new testimonial_awesome_post_block() );