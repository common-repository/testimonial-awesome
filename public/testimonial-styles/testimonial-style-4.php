<?php
    $testimonials = carbon_get_post_meta( get_the_ID(), 'testimonial_items' );
?>
<div class="testimonial-container testimonial-post-<?php echo esc_attr(get_the_ID()); ?>">
    <div class="testimonial-content testi-style-empat">
        <div class="testimonial-list grid grid-cols-12">
            <?php foreach ( $testimonials as $testimonial ) {
            $testimonial_items_socials = $testimonial['testimonial_items_socials']; ?>
            <div class="item-holder col-span-12 sm:col-span-12">
                <div class="testimonial-img clearfix"> 
                    <?php echo wp_get_attachment_image( $testimonial['testimonial_item_img'], 'full' ); ?>
                </div>
                <div class="member-info">
                    <?php testimonial_title_view($testimonial['testimonial_item_name']); ?>

                    <?php testimonial_job_view($testimonial['testimonial_job']); ?>
                    
                    <?php testimonial_bio_blockquote_view($testimonial['testimonial_item_bio']); ?>
                    <ul class="social-list">
                        <?php 
                        foreach ( $testimonial_items_socials as $testimonial_items_social ) {
                            if(!empty($testimonial_items_social['testimonial_item_social_link'])) {
                                $icon = "";
                                if(!empty($testimonial_items_social['testimonial_item_social_icon'])) {
                                $icon = $testimonial_items_social['testimonial_item_social_icon']['class'];
                                } ?>
                        <li class="social-item">
                            <a href="<?php echo esc_url($testimonial_items_social['testimonial_item_social_link']); ?>">
                                <i class="<?php echo esc_attr($icon); ?>"></i>
                            </a>
                        </li>
                    <?php } } ?>
                  </ul>
                    <a href="#" class="more-btn">
                        <span>+</span>
                    </a>
                </div>
                <div class="clear"></div>
                <div class="member-info-plus">
                    <p>
                        <?php echo esc_html($testimonial['testimonial_desc']); ?>
                    </p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    (function($) {
    'use strict';

        $(document).ready(function() {
            $('.more-btn').on('click', function(e) {
                e.preventDefault();
                $(this).toggleClass('opened')
                $(this).parent().parent().find('.member-info-plus').slideToggle();
            });
        });

    })(jQuery);
</script>