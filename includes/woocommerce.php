<?php

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

// Check WooCommerce is installed
function kds_woocommerce_installed() {
	return class_exists('Woocommerce');
}

// Check it's a product page
function kds_is_product() {
	return kds_woocommerce_installed() && is_product();
}

// Check it's a product category
function kds_is_product_category() {
	return kds_woocommerce_installed() && is_product_category();
}

// Remove prettyPhoto lightbox from reviews, not compatible with Raty
add_action( 'wp_enqueue_scripts', 'fc_remove_woo_lightbox', 99 );
function fc_remove_woo_lightbox() {
	global $woocommerce;
	$lightbox_en = get_option('woocommerce_enable_lightbox') == 'yes' ? true : false;
	if ( $lightbox_en && ( kds_is_product() || ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) ) {
		wp_dequeue_script( 'prettyPhoto-init' );
		wp_enqueue_script( 'tijara-prettyPhoto-init', get_template_directory_uri() . '/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.init.js', array( 'jquery' ), $woocommerce->version, true );
	}
}

// Remove Showing results functionality site-wide 
add_filter( 'woocommerce_subcategory_count_html', 'woocommerce_result_count' );
function woocommerce_result_count() {
	return;
}

// Ensure cart contents update when products are added to the cart via AJAX
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();	
	kds_woocommerce_cart_botton();
	$fragments['a#cart'] = ob_get_clean();
	return $fragments;
}

// The shopping cart box code generator
function kds_woocommerce_cart_botton() {

	if (!kds_woocommerce_installed()) {
		return;
	}

	global $woocommerce; 
	$cart_contents_count = $woocommerce->cart->cart_contents_count;
	
	?>
	<a class="<?php echo $cart_contents_count ? 'has-items ' :'' ?>one-full" id="cart" rel="nofollow" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" >
		<div class="one-full" id="cart-icon"><?php echo $cart_contents_count ? __('Your cart has items', 'tijara') : __('Your cart is empty', 'tijara')?> <i class="alignright double fa fa-shopping-cart"></i></div>
		<div class="one-full" id="cart-contents">
			<span class="black"><?php _e('Shopping cart total', 'tijara')?>:</span> <span class="white strong"><?php echo $woocommerce->cart->get_cart_total(); ?></span> <span class="black small">/ <?php  _e('Number of items:', 'tijara')?> <span class="white strong"><?php echo $cart_contents_count; ?></span></span>
		</div><!-- #cart-contents -->
	</a><!-- #cart -->
	<?php
}