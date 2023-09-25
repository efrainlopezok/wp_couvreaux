<?php

/**
 * Couvreaux
 *
 * Couvreaux Theme.
 *
 * Template Name: Retail Location
 *
 */

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'contact_page' );

 /** Code for custom loop */
function contact_page() {
    if ( have_posts() ) : while ( have_posts() ) : the_post();   
        $intro_section = get_field('intro_section');
        $full_width_image = get_field('full_width_image');
        $right_image = get_field('right_image');
        $left_image = get_field('left_image');
        ?>
        <section class="retail-section">
            <div class="wrap">
                <div class="row intro-retail" data-aos="fade-zoom-in" data-aos-duration="800" data-aos-easing="ease-in-sine" data-aos-delay="800" data-aos-offset="0" data-aos-once="true">
                    <div class="col-md-7">
                        <h2><?php echo $intro_section['title_retail']; ?></h2>
                        <?php echo $intro_section['content_retail']; ?>
                    </div>
                    <div class="col-md-5 col-img">
                        <img src="<?php echo $intro_section['image_retail']; ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="full-w-image">
                <style>
                .retail-section .full-w-image{
                    background-image: url(<?php echo $full_width_image; ?>);
                    <?php if( get_field('parallax_effect') == 'yes' ): ?>
                        background-attachment: fixed;
                    <?php endif; 
                    ?>
                }
                </style>
                <!-- <img src="<?php echo $full_width_image; ?>" alt=""> -->
            </div>
            <div class="wrap bottom-images"  data-aos="fade-zoom-in" data-aos-duration="800" data-aos-easing="ease-in-sine" data-aos-delay="800" data-aos-offset="0" data-aos-once="true">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?php echo $left_image; ?>" alt="">
                    </div>
                    <div class="col-md-6 col-img">
                        <img src="<?php echo $right_image; ?>" alt="">
                    </div>
                </div>
            </div>
        </section>
       
        <?php
    endwhile;
    endif;
    wp_reset_query();
}

add_filter( 'genesis_markup_site-inner', '__return_null' );
add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
add_filter( 'genesis_markup_content', '__return_null' );
 genesis();