<?php

// Testimonial Title
function testimonial_title_view($content) { ?>
	<div class="testimonial-name">
		<h1><?php echo esc_html($content); ?></h1>
	</div>
<?php }

// Testimonial Avatar
function testimonial_avatar_view($content) { ?>
	<div class="testimonial-avatar">
		<?php echo wp_get_attachment_image( $content, 'full' ); ?>
	</div>
<?php }

// Testimonial Job
function testimonial_job_view($content) { ?>
	<div class="testimonial-job">
		<span><?php echo esc_html($content); ?></span>
	</div>
<?php }

// Testimonial Bio
function testimonial_bio_view($content) { ?>
	<div class="testimonial-bio">
		<p><?php echo wp_specialchars_decode($content); ?></p>
	</div>
<?php }

// Testimonial Bio Blockquote
function testimonial_bio_blockquote_view($content) { ?>
	<div class="testimonial-bio">
		<blockquote><?php echo wp_specialchars_decode($content); ?></blockquote>
	</div>
<?php }

// Testimonial Title
function testimonial_style_script($post_id) {
	$testimonial_style = carbon_get_post_meta( $post_id, 'testimonial_style_choice' ); 
	$testimonial_column = carbon_get_post_meta( $post_id, 'testimonial_choose_column' );
	$testimonial_column_tablet = carbon_get_post_meta( $post_id, 'testimonial_choose_column_tablet' );
	$testimonial_column_mobile = carbon_get_post_meta( $post_id, 'testimonial_choose_column_mobile' );
	$spacebetween = carbon_get_post_meta( $post_id, 'testimonial_space_item' );
	if($spacebetween != "" || $spacebetween === 0) {
		$spacebetween = $spacebetween;
	} else {
		$spacebetween = 30;
	}

	$testimonial_use_arrow = carbon_get_post_meta( $post_id, 'testimonial_use_arrow' );
	$testimonial_use_pagination = carbon_get_post_meta( $post_id, 'testimonial_use_pagination' );
	$testimonial_use_autoplay = carbon_get_post_meta( $post_id, 'testimonial_use_autoplay' );
	$testimonial_autoplay_speed = carbon_get_post_meta( $post_id, 'testimonial_autoplay_speed' );
	if($testimonial_autoplay_speed != "" || $testimonial_autoplay_speed === 0) {
		$testimonial_autoplay_speed = $testimonial_autoplay_speed;
	} else {
		$testimonial_autoplay_speed = 2500;
	}
	$testimonial_use_loop = carbon_get_post_meta( $post_id, 'testimonial_use_loop' );

	if($testimonial_style == 'testimonial-style-12-carousel' || $testimonial_style == 'testimonial-style-13-carousel' || $testimonial_style == 'testimonial-style-14-carousel' || $testimonial_style == 'testimonial-style-15-carousel') { ?>
	<script>
		(function( $ ) {
		'use strict';

			$(document).ready(function() {
			    var swiper = new Swiper('.testimonial-post-<?php echo esc_attr($post_id); ?> .swiper-container', {
			    	slidesPerView: <?php echo intval($testimonial_column); ?>,
			    	spaceBetween: <?php echo intval($spacebetween); ?>,
			    	<?php if($testimonial_use_loop == true) { ?>
			    	loop: true,
			    	speed:2000,
			    	<?php } ?>
				    breakpoints: {
				      	480: {
				        	slidesPerView: <?php echo intval($testimonial_column_mobile); ?>,
				        	spaceBetween: <?php echo intval($spacebetween); ?>,
				      	},
				      	640: {
				        	slidesPerView: <?php echo intval($testimonial_column_tablet); ?>,
				        	spaceBetween: <?php echo intval($spacebetween); ?>,
				      	},
				      	1025: {
				        	slidesPerView: <?php echo intval($testimonial_column); ?>,
				        	spaceBetween: <?php echo intval($spacebetween); ?>,
				      	}
				    },
			    	<?php if($testimonial_use_autoplay == true) { ?>
			    	autoplay: {
				        delay: <?php echo intval($testimonial_autoplay_speed); ?>,
				        disableOnInteraction: false,
			      	},
			      	<?php } ?>
			      	navigation: {
			        	nextEl: '.testimonial-post-<?php echo esc_attr($post_id); ?> .swiper-button-next',
			        	prevEl: '.testimonial-post-<?php echo esc_attr($post_id); ?> .swiper-button-prev',
			      	},
			      	<?php if($testimonial_use_pagination == true) { ?>
			      	pagination: {
			      		clickable: true,
			        	el: '.testimonial-post-<?php echo esc_attr($post_id); ?> .swiper-pagination',
			      	},
			      	<?php } ?>
				    <?php if($testimonial_use_arrow == true) { ?>
			      	navigation: {
				        nextEl: '.testimonial-post-<?php echo esc_attr($post_id); ?> .swiper-button-next',
				        prevEl: '.testimonial-post-<?php echo esc_attr($post_id); ?> .swiper-button-prev',
			      	},
			      	<?php } ?>
			    });
			});

		})( jQuery );
	</script>
	<?php }
	elseif($testimonial_style == 'masonry') { ?>
	<script>
		(function ($) {
		    'use strict';

		    $(document).ready(function () {
		        $('.testimonial-post-<?php echo esc_attr($post_id); ?> .grid-masonry').masonry({
		            // options
		            itemSelector: '.testimonial-post-<?php echo esc_attr($post_id); ?> .grid-item-masonry',
		            columnWidth: '.testimonial-post-<?php echo esc_attr($post_id); ?> .grid-item-masonry',
		        });
		    });

		})( jQuery );
	</script>
	<?php }
}