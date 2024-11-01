<?php
namespace Elementor;

function testimonial_awesome_general_elementor_init(){
	Plugin::instance()->elements_manager->add_category(
		'testimonial_awesome-general-category',
		[
			'title'  => 'Testimonial Awesome',
			'icon' => 'font'
		],
		1
	);
}
add_action('elementor/init','Elementor\testimonial_awesome_general_elementor_init');
