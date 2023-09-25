<?php

/**
 * Yazz
 *
 * Yazz Theme.
 *
 * Template Name: Home
 *
 * @package Claudia
 * @author  Claudia
 * @license GPL-2.0+
 * @link    http://www.Claudia.com/
 */

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'home' );

 /** Code for custom loop */
function home() {
    echo '<div class="site-inner">';
    if ( have_posts() ) : while ( have_posts() ) : the_post();   
        $home_intro = get_field('home_intro');
        $crafting_section = get_field('crafting_section');	
        $home_intro['intro_title'] ? $home_intro['intro_title'] : '' ;
        $home_intro['tag_title'] ? $home_intro['tag_title'] : '' ;
        $home_intro['image_intro'] ? $home_intro['image_intro'] : '' ;
        if ($home_intro['image_intro']=='') {
        }
        $crafting_section['title'] ? $crafting_section['title'] : '' ;
        $crafting_section['image_craft'] ? $crafting_section['image_craft'] : '' ;
        $crafting_section['content_craft'] ? $crafting_section['content_craft'] : '' ;
        $crafting_section['link_craft'] ? $crafting_section['link_craft'] : '' ;
        $crafting_section['link_craft']['title'] ?$crafting_section['link_craft']['title'] : '' ;
       
        ?>
        <section class="intro-section" data-aos="fade-zoom-in" data-aos-duration="800" data-aos-easing="ease-in-sine" data-aos-delay="800" data-aos-offset="0" data-aos-once="true">
            <div class="wrap">

                <div class="row align-items-center">
                    <div class="col-md-6">
                         <h1 id="typer"><?php echo $home_intro['intro_title']; ?><span><?php echo $home_intro['tag_title']; ?></span></h1>
                        <p><?php echo $home_intro['intro_content']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo $home_intro['image_intro']; ?>">
                    </div>
                </div>
            </div>
        </section>
        <?php 
             $feature_products = get_field('feature_products');
        ?>
        <section class="products-related">
            <div class="wrap">
                <div class="row justify-content-between">
                <?php  
                    if( empty($feature_products)){ 
                        $args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => 10,
                        );
    
                        $loop = new WP_Query( $args );
    
                        while ( $loop->have_posts() ) : $loop->the_post();
                            global $product;
                                ?>
                            <div class="col-sm-6" data-aos="fade-up" data-aos-duration="500" data-aos-easing="ease-in-sine" data-aos-delay="800" data-aos-offset="0" data-aos-once="true">
                                <div class="products-select">
                                        <h3 class="product-custom-tt">
                                            <a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
                                        </h3>
                                        <p class="maximun"><?php echo get_the_excerpt( $p->ID ); ?></p>
                                        <div class="img-home-p">
                                            <a href="<?php echo get_permalink( $p->ID ); ?>"><img src="<?php echo get_the_post_thumbnail_url(  $p->ID ) ?>" alt=""></a>
                                        </div>
                                        <a href="<?php echo get_permalink( $p->ID ); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/arrow.png" alt=""></i></a>
                                </div>
                            </div>
                        <?php
                        endwhile;
    
                        wp_reset_query();
                    }  
                ?>
                <?php if( $feature_products ): ?>
                <?php foreach( $feature_products as $p ):?>
                    <div class="col-sm-6" data-aos="fade-up" data-aos-duration="500" data-aos-easing="ease-in-sine" data-aos-delay="800" data-aos-offset="0" data-aos-once="true">
                        <div class="products-select">
                                <h3 class="product-custom-tt">
                                    <a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
                                </h3>
                                <p class="maximun"><?php echo get_the_excerpt( $p->ID ); ?></p>
                                <div class="img-home-p">
                                    <a href="<?php echo get_permalink( $p->ID ); ?>"><img src="<?php echo get_the_post_thumbnail_url(  $p->ID ) ?>" alt=""></a>
                                </div>
                                <a href="<?php echo get_permalink( $p->ID ); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/arrow.png" alt=""></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="section-crafting">
            <div class="wrap" data-aos="fade-down" data-aos-duration="500" data-aos-easing="ease-in-sine" data-aos-delay="800" data-aos-offset="0" data-aos-once="true">
                <h2><?php echo $crafting_section['title']; ?></h2>
                <div class="row align-items-center">
                    <div class="col-md-6 content-img">
                        <img src="<?php echo $crafting_section['image_craft']; ?>">
                    </div>
                    <div class="col-md-6"> 
                        <div class="content-text">
                            <?php echo $crafting_section['content_craft']; ?>
                        </div>
                        <a href="<?php echo $crafting_section['link_craft']['url']; ?>" class="arrow-link"> <?php echo $crafting_section['link_craft']['title']; ?></a>
                    </div>
                </div>
            </div>
        </section>
        <?php
    endwhile;
    endif;
    wp_reset_query();

    echo '</div>';

}
add_filter( 'genesis_markup_site-inner', '__return_null' );
 genesis();