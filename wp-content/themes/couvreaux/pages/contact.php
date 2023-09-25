<?php

/**
 * Couvreaux
 *
 * Couvreaux Theme.
 *
 * Template Name: Contact
 *
 */

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'contact_page' );

 /** Code for custom loop */
function contact_page() {
    if ( have_posts() ) : while ( have_posts() ) : the_post();   
        $home_intro = get_field('home_intro');
        $crafting_section = get_field('crafting_section');	
           
        ?>
        <section class="contact-section" style="background:url(<?php echo get_site_url(); ?>/wp-content/uploads/2019/04/Michael2.jpg);
        background-size:cover;
        background-position: center;">
            <div class="wrap" data-aos="flip-left" data-aos-easing="ease-in-sine" data-aos-duration="500" data-aos-offset="0" data-aos-once="true">
                <?php  
                echo the_content(); ?>
            </div>
        </section>
       
        <?php
    endwhile;
    endif;
    wp_reset_query();


}

add_filter( 'genesis_markup_site-inner', '__return_null' );
 genesis();