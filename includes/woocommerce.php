<?php

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

// Check WooCommerce is installed
function kds_woocommerce_installed() {
	return class_exists('Woocommerce');
}

// Check it's a product page
function kds_is_product() {
	return kds_woocommerce_installed() AND is_product();
}

// Check it's a product category
function kds_is_product_category() {
	return kds_woocommerce_installed() AND is_product_category();
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

function get_wc_attributes() {
	global $woocommerce; 
	$wc_attributes = array();
	$wc_attribute_taxonomies = $woocommerce->get_attribute_taxonomies(); 
	foreach ($wc_attribute_taxonomies as $tax)
		$wc_attributes[$tax->attribute_id] = $tax->attribute_label;
	return $wc_attributes;
}

/**
 * Multiple ratings
 */
$GLOBALS['ratings_labels'] = array(
	'Appearance',
	'Price/Value',
	'Quality',
);
remove_action( 'comment_post', 'woocommerce_add_comment_rating', 1);
add_action( 'comment_post', 'woocommerce_add_comment_rating_plus', 1 );
function woocommerce_add_comment_rating_plus( $comment_id ) {
	// Inits
	global $ratings_labels;
	$total_score = 0;
	$score = 0;
	// Only continue if all rating stars are used
	for ($i = 1; $i <= count($ratings_labels); $i++) { 
		if (!isset($_POST["rating_$i"]) || !preg_match('#^[1-5]$#', $_POST["rating_$i"]))
			die($_POST["rating_$i"]);
		else
			$total_score += $_POST["rating_$i"];
	}
	// Compute score
	$score = $total_score / count($ratings_labels);
	// Save main rating		
	add_comment_meta( $comment_id, 'rating', $score, true );
	woocommerce_clear_comment_rating_transients( $comment_id );
	// Save other ratings
	for ($i = 1; $i <= count($ratings_labels); $i++){
		add_comment_meta( $comment_id, "rating_$i", $_POST["rating_$i"], true );
		woocommerce_clear_comment_rating_transients_n($comment_id, $_POST["rating_$i"]);
	}
}


/**
 * get_average_rating_n function.
 */
function get_average_rating_n($product, $n) {
	if ( false === ( $average_rating = get_transient( 'wc_average_rating_'.$n.'_' . $product->id ) ) ) {

		global $wpdb;

		$average_rating = '';
		$count		  = get_rating_count_n($product, $n);

		if ( $count > 0 ) {

			$ratings = $wpdb->get_var( $wpdb->prepare("
				SELECT SUM(meta_value) FROM $wpdb->commentmeta
				LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
				WHERE meta_key = 'rating_$n'
				AND comment_post_ID = %d
				AND comment_approved = '1'
				AND meta_value > 0
			", $product->id ) );

			$average_rating = number_format( $ratings / $count, 2 );

		}

		set_transient( 'wc_average_rating_'.$n.'_' . $product->id, $average_rating, 3600 );
	}

	return $average_rating;
}

/**
 * get_rating_n_count function.
 */
function get_rating_count_n($product, $n) {
	if ( false === ( $count = get_transient( 'wc_rating_count_'.$n.'_' . $product->id ) ) ) {

		global $wpdb;

		$count = $wpdb->get_var( $wpdb->prepare("
			SELECT COUNT(meta_value) FROM $wpdb->commentmeta
			LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
			WHERE meta_key = 'rating_$n'
			AND comment_post_ID = %d
			AND comment_approved = '1'
			AND meta_value > 0
		", $product->id ) );

		set_transient( 'wc_rating_count_'.$n.'_' . $product->id, $count, 3600);
	}

	return $count;
}

/**
 * woocommerce_clear_comment_rating_transients_n function.
 */
function woocommerce_clear_comment_rating_transients_n($comment_id, $n) {
	$comment = get_comment($comment_id);

	if ( ! empty( $comment->comment_post_ID ) ) {
		delete_transient( 'wc_average_rating_'.$n.'_' . absint( $comment->comment_post_ID ) );
		delete_transient( 'wc_rating_count_'.$n.'_' . absint( $comment->comment_post_ID ) );
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

function kds_woocommerce_cart_botton() {
	global $woocommerce; 
	$spans = (int) $spans; 
	?>
				<a class="<?php echo $woocommerce->cart->cart_contents_count ? 'has-items ' :'' ?>span4 last" id="cart" rel="nofollow" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" >
					<div class="one-full" id="cart-icon"><?php echo $woocommerce->cart->cart_contents_count > 0 ? __('Cart has items', 'tijara') . ' <span class="tiny">(' . __('checkout', 'tijara') . ')</span>' : __('Cart is empty', 'tijara')?></div>
					<div class="one-full" id="cart-contents">
						<span class="black"><?php _e('Shopping cart total', 'tijara')?>:</span> <span class="white strong"><?php echo $woocommerce->cart->get_cart_total(); ?></span> <span class="black tiny">/ <?php  _e('Number of items:', 'tijara')?> <span class="white strong"><?php echo $woocommerce->cart->cart_contents_count;?></span></span>
					</div><!-- #cart-contents -->
				</a><!-- #cart -->
	<?php
}