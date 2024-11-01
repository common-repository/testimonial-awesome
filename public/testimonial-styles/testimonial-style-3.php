<?php
$testimonials = carbon_get_post_meta( get_the_ID(), 'testimonial_items' );
$testimonial_column = carbon_get_post_meta( get_the_ID(), 'testimonial_choose_column' );
wp_enqueue_style( 'ta-testimonial-awesome-swiper', plugin_dir_url( __DIR__ ) . 'css/swiper.css', array(), '', 'all' );
?>
<div class="testimonial-container">
    <div class="grid grid-cols-12 gap-12 testimonial-post-<?php echo esc_attr(get_the_ID()); ?> testi-style-tiga">
        <!-- Tab panes -->
        <div class="testimonial-profile-tab col-span-4 sm:col-span-12 flex items-center">
		    <?php $no = 0; foreach ( $testimonials as $testimonial ) { $no++;
                $testimonial_items_socials = $testimonial['testimonial_items_socials']; ?>
            <div class="testimonial-desc fade in <?php if($no == 1) { ?>active <?php } ?>" data-id="testimonial-tiga-<?php echo esc_attr($no); ?>">
                <div class="heading-block">
					<?php testimonial_job_view($testimonial['testimonial_job']); ?>

					<?php testimonial_title_view($testimonial['testimonial_item_name']); ?>
				</div>
				<?php testimonial_bio_blockquote_view($testimonial['testimonial_item_bio']); ?>
                <div class="socials flex flex-wrap gap-4">
                    <?php 
                    foreach ( $testimonial_items_socials as $testimonial_items_social ) {
                    if(!empty($testimonial_items_social['testimonial_item_social_link'])) {
                        $icon = "";
                        if(!empty($testimonial_items_social['testimonial_item_social_icon'])) {
                            $icon = $testimonial_items_social['testimonial_item_social_icon']['class'];
                        } ?>
                    <div class="social-item">
                        <a href="<?php echo esc_url($testimonial_items_social['testimonial_item_social_link']); ?>" target="_blank">
                            <i class="<?php echo esc_attr($icon); ?>"></i>
                        </a>
                    </div>
                    <?php } } ?>
                </div>
            </div>
			<?php } ?>
        </div>
        <!-- Tab Panes End -->
        
        <!-- Nav Tabs -->
        <div class="testimonial-photo col-span-8 sm:col-span-12">
            <div class="testimonial-testimonial">
                <div class="swiper-container">
				    <div class="swiper-wrapper">
		                <?php $no = 0; foreach ( $testimonials as $testimonial ) { $no++; ?>
				      	<div class="swiper-slide">
					      	<div role="presentation" class="testimonial-photo-box">
								<a href="#testimonial-tiga-1" aria-controls="testimonial-tiga-<?php echo esc_attr($no); ?>">
									<?php echo wp_get_attachment_image( $testimonial['testimonial_item_img'], 'full', "", array( "class" => "userProfile__image" ) ); ?>
								</a>
							</div>
					    </div>
						<?php } ?>
				    </div>
				    <!-- Add Arrows -->
				    <div class="swiper-button-next"></div>
				    <div class="swiper-button-prev"></div>
				</div>
            </div>
        </div>
        <!-- Nav Tabs End -->
    </div>

</div>

<?php wp_enqueue_script( 'ta-testimonial-awesome-swiper', plugin_dir_url( __DIR__ ) . 'js/swiper.min.js', array( 'jquery' ), '', false ); ?>

<script>
(function ($) {
	'use strict';

	$(document).ready(function() {
	    var swiper = new Swiper('.testimonial-testimonial .swiper-container', {
	    	slidesPerView: <?php echo intval($testimonial_column); ?>,
	    	spaceBetween: 0,
		    breakpoints: {
		      	480: {
		        	slidesPerView: 1,
		        	spaceBetween: 0,
		      	},
		      	640: {
		        	slidesPerView: <?php echo intval($testimonial_column); ?>,
		        	spaceBetween: 0,
		      	}
		    },
	      	navigation: {
	        	nextEl: '.testimonial-testimonial .swiper-button-next',
	        	prevEl: '.testimonial-testimonial .swiper-button-prev',
	      	},
	    });

	    var coba = $('.testimonial-desc.active').attr('data-id');
	    $("a[aria-controls=" + coba + "]").find('img').css('opacity', '1');

	    $(document).on('click', '.testimonial-photo-box', function() {
	        $(this).find('img').css('opacity', 1);
	        $(this).parent().siblings('.swiper-slide').find('img').css('opacity', '0.3');
	    });

	    $('.testimonial-desc').each(function() {
	        var coba = $('.testimonial-desc.active').attr('data-id');
	         $("a[aria-controls=" + coba + "]").find('img').css('opacity', '1');
	    });

	   	$('.swiper-slide a').click(function() {  
	      	$(".testimonial-desc").removeClass('active');
	      	$(".testimonial-desc[data-id='"+$(this).attr('aria-controls')+"']").addClass("active");
	    });


    	function testimonial_awesome_style17_cs() {
			$('.swiper-slide').removeClass('cur-slide');
			$('.swiper-slide-active').addClass('cur-slide');

	      	$(".testimonial-desc").removeClass('active');
			$(".testimonial-desc[data-id='"+$('.cur-slide a').attr('aria-controls')+"']").addClass("active");


	        $('.testimonial-photo-box').find('img').css('opacity', 1);
	        $('.testimonial-photo-box').parent().siblings('.swiper-slide').find('img').css('opacity', '0.3');

			var coba = $('.testimonial-desc.active').attr('data-id');
	        $(".cur-slide a[aria-controls=" + coba + "]").find('img').css('opacity', '1');
	    }

	    var windowWidth = $(window).width();
	    if(windowWidth < 640) {
		    testimonial_awesome_style17_cs();
		    swiper.on('slideChangeTransitionEnd', function () {
		    	testimonial_awesome_style17_cs();
		    });
	    }
	});
})( jQuery );
</script>
