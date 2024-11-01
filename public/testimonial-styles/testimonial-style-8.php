<?php
	$testimonials = carbon_get_post_meta( get_the_ID(), 'testimonial_items' );
	wp_enqueue_style( 'ta-testimonial-awesome-swiper', plugin_dir_url( __DIR__ ) . 'css/swiper.css', array(), '', 'all' );
?>
<div class="testimonial-container testimonial-post-<?php echo esc_attr(get_the_ID()); ?>">
	<div class="testimonial-content testi-style-delapan">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php 
				$gambars = array();
				foreach ( $testimonials as $testimonial ) {
					$testimonial_items_socials = $testimonial['testimonial_items_socials']; ?>
					<!--TESTIMONIAL 1 -->
					<div class="swiper-slide">
						<?php testimonial_avatar_view($testimonial['testimonial_item_img']); ?>
						<?php testimonial_title_view($testimonial['testimonial_item_name']); ?>
						<?php testimonial_bio_blockquote_view($testimonial['testimonial_item_bio']);
						$gambars[$testimonial['testimonial_item_img']] = $testimonial['testimonial_item_img'];
						?>
					</div>
				<?php } ?>
			</div>
			<div class="swiper-navigation clearfix">
				<div class="swiper-button-prev">
					<i class="fa fa-long-arrow-alt-left"></i>
				</div>
				<div class="swiper-button-next">
					<i class="fa fa-long-arrow-alt-right"></i>
				</div>
			</div>
		</div>

		<div class="feedback-slider-thumb">
			<div class="thumb-prev">
				<span>
					<img src="" alt="<?php esc_html_e('Next Slide', 'testimonial-awesome'); ?>" class="animated zoomIn" style="opacity: 0;">
				</span>
		  	</div>
			<div class="thumb-next">
				<span>
					<img src="" alt="Customer Feedback" class="animated zoomIn" style="opacity: 0;">
				</span>
			</div>
		</div>

	</div>
</div>

<?php wp_enqueue_script( 'ta-testimonial-awesome-swiper', plugin_dir_url( __DIR__ ) . 'js/swiper.min.js', array( 'jquery' ), '', false ); ?>

<script>
(function($) {
	'use strict';

	var mySwiper;
	$(document).ready(function() {
		mySwiper = new Swiper('.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-container', {
			spaceBetween: 0,
			breakpoints: {
				480: {
					slidesPerView: 1,
					spaceBetween: 0,
				},
				640: {
					slidesPerView: 1,
					spaceBetween: 0,
				},
				1024: {
					slidesPerView: 1,
					spaceBetween: 0,
				}
			},
			pagination: {
				el: '.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-pagination',
				clickable: true,
			   
			},
			 navigation: {
			  nextEl: '.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-button-next, style-delapan .thumb-next',
			  prevEl: '.testimonial-post-<?php echo esc_attr(get_the_ID()); ?> .swiper-button-prev, .style-delapan .thumb-prev',
			},

			on: {
				init: function () {
					testi_image_change();
				},
			},

		});


		$('.thumb-next').on('click', function() {
			mySwiper.slideNext(300, false);
			testi_image_change();
			return false;
		});
		$('.thumb-prev').on('click', function() {
			mySwiper.slidePrev(300, false);
			testi_image_change();
			return false;
		});

		function testi_image_change() {
			var srcNextSlide = $('.swiper-slide-next').find('img').attr('src'),
				srcPrevSlide = $('.swiper-slide-prev').find('img').attr('src');
			if(srcNextSlide) {
				$('.thumb-next').find('img').attr('src', srcNextSlide);
				$('.thumb-next img').css('opacity', 1);
			}
			if(srcPrevSlide) {
				$('.thumb-prev').find('img').attr('src', srcPrevSlide);
				$('.thumb-prev img').css('opacity', 1);
			}

		}

		mySwiper.on('slideChangeTransitionStart', function() {
			var srcNextSlide = $('.swiper-slide-next').find('img').attr('src'),
				srcPrevSlide = $('.swiper-slide-prev').find('img').attr('src');
			
			if(srcNextSlide) {
				$('.thumb-next').find('img').attr('src', srcNextSlide);
				$('.thumb-next img').css('opacity', 1);
			}
			if(srcPrevSlide) {
				$('.thumb-prev').find('img').attr('src', srcPrevSlide);
				$('.thumb-prev img').css('opacity', 1);
			}
		});

		mySwiper.on('transitionStart', function() {
			var srcNextSlide = $('.swiper-slide-next').find('img').attr('src'),
				srcPrevSlide = $('.swiper-slide-prev').find('img').attr('src');
			
			if(srcNextSlide != '') {
				$('.thumb-next img').css('opacity', 0);
			}
			if(srcPrevSlide != '') {
				$('.thumb-prev img').css('opacity', 0);
			}
		});
		
	});

})(jQuery);
   
  </script>