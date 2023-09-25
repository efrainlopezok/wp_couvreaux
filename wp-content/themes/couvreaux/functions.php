<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'couvreaux' );
define( 'CHILD_THEME_URL', 'http://www.couvreaux.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js',true);

	wp_enqueue_style('grid-boostrap', get_stylesheet_directory_uri() . '/css/grid.min.css', array(), '20130608');
	wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css');
	wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600');
	wp_enqueue_style('slick-css', get_stylesheet_directory_uri() . '/css/slick.css', array());
	wp_enqueue_style('magnific-popup', get_stylesheet_directory_uri() . '/css/magnific-popup.css', array());
	wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/css/custom.css', array(), '20130609');
	wp_enqueue_style('aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css');

	wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js',true);
	wp_enqueue_script( 'aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js',true);

}


// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
// Renames primary and secondary navigation menus.
add_theme_support(
	'genesis-menus', array(
		'primary'   => __( 'Header Menu', 'genesis-sample' ),
		'secondary' => __( 'Footer Menu', 'genesis-sample' ),
	)
);

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

add_action( 'genesis_theme_settings_metaboxes', 'genesis_sample_remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 2.6.0
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function genesis_sample_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

add_filter( 'genesis_customizer_theme_settings_config', 'genesis_sample_remove_customizer_settings' );
/**
 * Removes output of header settings in the Customizer.
 *
 * @since 2.6.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function genesis_sample_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	return $config;

}

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}
remove_action( 'genesis_header', 'genesis_do_header' );
add_action( 'genesis_header', 'genesis_do_new_header' );
function genesis_do_new_header() {
	global $wp_registered_sidebars;
	if ( has_action( 'genesis_header_right' ) || ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) ) {

		genesis_markup( array(
			'open'    => '<div %s>',
			'context' => 'header-widget-area',
		) );

			/**
			 * Fires inside the header widget area wrapping markup, before the Header Right widget area.
			 *
			 * @since 1.5.0
			 */
			do_action( 'genesis_header_right' );
			add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
			dynamic_sidebar( 'header-right' );
			remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

		genesis_markup( array(
			'close'   => '</div>',
			'context' => 'header-widget-area',
		) );

	}
	genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'title-area',
	) );

		/**
		 * Fires inside the title area, before the site description hook.
		 *
		 * @since 2.6.0
		 */
		do_action( 'genesis_site_title' );

		/**
		 * Fires inside the title area, after the site title hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'genesis_site_description' );

	genesis_markup( array(
		'close'   => '</div>',
		'context' => 'title-area',
	) );
}
function custom_options_page() {
	acf_add_options_page( array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false // false gives this its own page
	) );

}
add_action( 'init', 'custom_options_page' );

unregister_sidebar( 'header-right' );

add_action( 'genesis_header_right', 'hook_header_right');
function hook_header_right() { ?>
	<div class="header-right-widget">
		<div class="shop-header d-flex align-items-center justify-content-end">
		<!-- <?php if ( is_user_logged_in() ) { ?>
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php wp_loginout(); ?></a>
		<?php } 
		else { ?>
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php wp_loginout(); ?></a>
		<?php } ?> -->
		<?php global $current_user; wp_get_current_user(); ?>
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="login_account">Log In /<strong> <?php if ( is_user_logged_in() ): echo $current_user->user_login; else: echo 'Account'; endif; ?></strong></a>
			<a href="<?php echo wc_get_cart_url(); ?>" class="shop_link" title="<?php _e( 'View your shopping cart' ); ?>">
				<i class="fa fa-shopping-basket"></i>
				<div class="cart_gen">
				<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> -<br>
					<strong><span class="amount"><?php echo WC()->cart->get_cart_total(); ?></span></strong>
				</div>
			</a>
		</div>
	<?php
    // global $woocommerce;
	// $items = $woocommerce->cart->get_cart();
	// echo '<div class="list-item-dropdown">';
    //     foreach($items as $item => $values) { 
			
    //         $_product =  wc_get_product( $values['data']->get_id()); 
    //         echo "<b>".$_product->get_title().'</b>  <br> Quantity: '.$values['quantity'].'<br>'; 
	// 		$price = get_post_meta($values['product_id'] , '_price', true);
			
	// 		echo "  Price: ".$price."<br>";
	// 		//product image
	// 		$getProductDetail = wc_get_product( $values['product_id'] );
	// 		echo $getProductDetail->get_image(); // accepts 2 arguments ( size, attr )
    //     } 
	// echo '</div>';
	?>
	</div>
<?php
}
add_shortcode( 'cart_link_shortcode', 'cart_link_mob_shortcode' );
function cart_link_mob_shortcode() {
    ob_start();
	?> 
	<a href="<?php echo wc_get_cart_url(); ?>"class="shop_link_mobile">
		<i class="fa fa-shopping-basket"></i>
		<div class="cart_gen_mob">
		<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> -
			<strong><span class="amount"><?php echo WC()->cart->get_cart_total(); ?></span></strong>
		</div>
	</a>
	<?php
    return ob_get_clean();
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a href="<?php echo wc_get_cart_url(); ?>" class="shop_link" title="<?php _e( 'View your shopping cart' ); ?>">
		<i class="fa fa-shopping-basket"></i>
		<div class="cart_gen">
		<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> -<br>
			<strong><span class="amount"><?php echo WC()->cart->get_cart_total(); ?></span></strong>
		</div>
	</a>
	<?php
	$fragments['a.shop_link'] = ob_get_clean();
	return $fragments;
}
 // Rename the description tab
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
    $tabs['description']['title'] = __( 'Product detail' );       
    return $tabs;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
function clean_commerce_child_custom_woo_fix() {

	add_filter( 'woocommerce_show_page_title', '__return_true', 1 );
	add_filter( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 6 );
}

add_action( 'init', 'clean_commerce_child_custom_woo_fix' );



add_action( 'woocommerce_before_add_to_cart_form', 'woocommerce_template_single_price', 5 );
add_action( 'woocommerce_before_add_to_cart_form', 'price_before', 4 );
 
function price_before() {
	?>
		<p class="custom-text">Silver and Wood Pipe</p>
	<?php
}

add_action( 'woocommerce_after_single_product_summary', 'bbloomer_custom_action', 50 );
add_action( 'woocommerce_after_single_product_summary', 'imgs_custom', 40 );
 
function bbloomer_custom_action() {
	?>
		<form class="cart qty2" action="" method="post" enctype="multipart/form-data">
			<?php
			woocommerce_quantity_input();
			global $product;
			?>		
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
		</form>
		<?php 
}
function imgs_custom(){
	?>
	<div class="custom-imgs">
		<?php if( have_rows('add_image_product') ): ?>
		<?php while( have_rows('add_image_product') ): the_row(); 
			// vars
			$image = get_sub_field('image');
			?>
			<div class="rectangle-img"><img src="<?php echo $image; ?>" alt=""></div>
		<?php endwhile; ?>
<?php endif; ?>
	</div>
	<?php
}


add_action( 'woocommerce_before_single_product_summary', 'wrap_top', 1 );
function wrap_top(){
	?>

		<div class="content-sp section-top-sp" >
				
				<?php
}
add_action( 'woocommerce_after_add_to_cart_form', 'wrap_bot', 1 );
function wrap_bot(){
	?>
	</div>
	<?php
}
add_action( 'woocommerce_after_single_product_summary', 'section_two', 1 );
function section_two(){
	?>
	<div class="full-width">
		<div class="content-sp">
				
				<?php
}
add_action( 'woocommerce_after_single_product', 'end_section_two', 50 );
function end_section_two(){
	?>
		</div>
	</div>
	
	<?php
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */
function wc_empty_cart_redirect_url() {
    return get_site_url();
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );

function custom_shop_page_redirect() {
    if( is_shop() ){
        wp_redirect( home_url() );
        exit();
    }
}
add_action( 'template_redirect', 'custom_shop_page_redirect' );
add_action( 'woocommerce_before_account_navigation', 'hide_methods', 50 );
function hide_methods(){
	$saved_methods = wc_get_customer_saved_methods_list( get_current_user_id() );
	$has_methods   = (bool) $saved_methods;
	if ( $has_methods ){
	}else{
	?>
	<style>
		.woocommerce-MyAccount-navigation-link--payment-methods{
			display:none;
		}
	</style>
	<?php
	}
}
add_action( 'woocommerce_before_checkout_billing_form', 'show_mesagge' );
function show_mesagge(){
	?>
		<div>
			<p>Shipping is the same as billing.</p>
		</div>
	<?php
}
