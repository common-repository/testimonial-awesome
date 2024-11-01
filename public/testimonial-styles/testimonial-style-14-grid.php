<?php
    $testimonials = carbon_get_post_meta( get_the_ID(), 'testimonial_items' );
    $testimonial_column = carbon_get_post_meta( get_the_ID(), 'testimonial_style_choice_grid_col' );
?>
<div class="testimonial-container testimonial-post-<?php echo esc_attr(get_the_ID()); ?>">
    <div class="testimonial-content testi-style-empatbelas">
        <div class="testimonial-list grid grid-cols-12">
            <?php foreach ( $testimonials as $testimonial ) { ?>
            <div class="testi-item  col-span-<?php echo esc_attr($testimonial_column); ?> sm:col-span-12">
                <?php testimonial_bio_view($testimonial['testimonial_item_bio']); ?>
                <?php testimonial_avatar_view($testimonial['testimonial_item_img']); ?>
                <div class="author">
                    <h5 class="testimonial-name"> <?php echo esc_html($testimonial['testimonial_item_name']); ?></h5>
                    <span class="testimonial-job"> <?php echo esc_html($testimonial['testimonial_job']); ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>