<?php
    $testimonials = carbon_get_post_meta( get_the_ID(), 'testimonial_items' );
    $testimonial_use_arrow = carbon_get_post_meta( get_the_ID(), 'testimonial_use_arrow' );
    $testimonial_column = carbon_get_post_meta( get_the_ID(), 'testimonial_style_choice_grid_col' );

    wp_enqueue_style( 'ta-testimonial-awesome-swiper', plugin_dir_url( __DIR__ ) . 'css/swiper.css', array(), '', 'all' );
?>
<div class="testimonial-post-<?php echo esc_attr(get_the_ID()); ?>">
    <div class="testimonial-content swiper-container testi-style-limabelas<?php if($testimonial_use_arrow == true) { ?> has-pagination<?php } ?>">
        <div class="testimonial-list swiper-wrapper">
            <?php foreach ( $testimonials as $testimonial ) { ?>
            <div class="testi-item swiper-slide">
                <?php testimonial_bio_view($testimonial['testimonial_item_bio']); ?>
                <div class="author">
                    <?php testimonial_avatar_view($testimonial['testimonial_item_img']); ?>
                    <?php testimonial_title_view($testimonial['testimonial_item_name']); ?>
                    <?php testimonial_job_view($testimonial['testimonial_job']); ?>
                </div>
            </div>
            <?php }?>
        </div>

        <div class="swiper-pagination"></div>
        <?php if($testimonial_use_arrow == true) { ?>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <?php } ?>
    </div>
</div>

<?php wp_enqueue_script( 'ta-testimonial-awesome-swiper', plugin_dir_url( __DIR__ ) . 'js/swiper.min.js', array( 'jquery' ), '', false ); ?>

<?php testimonial_style_script(get_the_ID()); ?>

