<?php
/**
 * carid_clone functions and definitions
 *
 * @package carid_clone
 */

/** 
 * Requirements
 */
add_action( 'admin_notices', 'carid_requirements' );
function carid_requirements() {
	// WooCommerce
	if(!is_object($GLOBALS['woocommerce']))
		echo '<div class="error"><p>' . _e( 'The current theme requires the <strong>WooCommerce</strong> plugin', 'carid_clone' ) . '</p></div>';
	// Logo
	if(!get_header_image())
		echo '<div class="error"><p>' . _e( 'Please configure a header image (logo)', 'carid_clone' ) . '</p></div>';
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'carid_clone_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function carid_clone_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on carid_clone, use a find and replace
	 * to change 'carid_clone' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'carid_clone', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'carid_clone' ),
	) );

	/**
	 * Then, I (Nabil Kadimi) added the secondary menu
	 */
	register_nav_menus( array(
		'secondary_menu' => __( 'Secondary Menu', 'carid_clone' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'carid_clone_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // carid_clone_setup
add_action( 'after_setup_theme', 'carid_clone_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function carid_clone_widgets_init() {
	register_sidebar( array(
		'name'			=> __( 'Sidebar', 'carid_clone' ),
		'id'			=> 'sidebar-1',
		'before_widget' => "\n" . '<aside id="%1$s" class="widget %2$s">',
		'before_title'  => "\n\t" . '<h5 class="widget-title">',
		'after_title'   => '</h5><div class="widget-contents">',
		'after_widget'  => "\n" . '</div></aside>',
	) );
	register_sidebar( array(
		'name'			=> __( 'Header Center', 'carid_clone' ),
		'id'			=> 'header-center',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'			=> __( 'Footer', 'carid_clone' ),
		'id'			=> 'footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s one-fourth">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'carid_clone_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function carid_clone_scripts() {
	if (is_page() OR get_post_type('') == 'product' OR is_product_category()){
		wp_enqueue_script( 'carid_clone-nivo-slider', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/jquery.nivo.slider.pack.min.js', array('jquery'));
		wp_enqueue_style('carid_clone-nivo-slider-style', '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/nivo-slider.min.css');
	}

	wp_enqueue_style( 'carid_clone-style', get_stylesheet_uri() );

	wp_enqueue_style( 'carid_clone-language-style', get_template_directory_uri() . '/css/' . get_locale() . '.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'carid_clone-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	wp_enqueue_script( 'carid_clone-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ));
	wp_localize_script( 'carid_clone-custom', 'caridClone', array('templateUrl' => get_bloginfo("template_url")) );

}
add_action( 'wp_enqueue_scripts', 'carid_clone_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// require get_template_directory() . '/inc/jetpack.php';

/**
 * Show Nivo-slider on homepage
 */
add_action('wp_head', 'nivoSlider');
function nivoSlider() {
	if (is_page() OR get_post_type('') == 'product' OR is_product_category()){
		?><script type="text/javascript">
		/* <![CDATA[ */
			jQuery(document).ready(function($){
				// strip BR elements created by Wordpress
				$('#slider .nivoSlider br').each(function(){ 
					$(this).remove();
				});
				// Initiate nivoslider
				$('.nivoSlider').nivoSlider({
					directionNav: false,
					pauseTime:7500,
					animSpeed: 1000, 
					pauseOnHover: false,
					randomStart: true 
				});
				// Remove slider controls when there is only one
				$('a.nivo-control').length == 1 && $('a.nivo-control').css('visibility', 'hidden');
				// Add the class 'has-slider' to the body classes
				$('body')
					.filter(function () {return $('.nivoSlider').length})
					.addClass('has-slider')
				;
			});
		/* ]]> */
		</script><?php
	}
}

// Remove Showing results functionality site-wide 
add_filter( 'woocommerce_subcategory_count_html', 'woocommerce_result_count' );
function woocommerce_result_count() {return;}

// Add social icons to posts & products
add_filter( 'the_content', 'social_icons');
add_filter( 'woocommerce_short_description', 'social_icons');


function social_icons( $content ) {
	# cars.edesigner@mailinator.com / cds897ckjds
	global $post;

	if(in_array($post->post_type, array('post', 'product')))
		$content = '<div class="addthis_toolbox addthis_default_style alignright"><a class="addthis_button_preferred_1"></a><a class="addthis_button_preferred_2"></a><a class="addthis_button_preferred_3"></a><a class="addthis_button_preferred_4"></a><a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a></div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52428f774a8770d0"></script>' . $content;

	return $content;
}

// Ensure cart contents update when products are added to the cart via AJAX
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();	
	?>
				<a id="cart" rel="nofollow" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" >
					<div id="cart-icon"><?php echo $woocommerce->cart->cart_contents_count > 0 ? __('Cart contains items', 'carid_clone') . ' <span class="tiny">' . __('(click to pay)', 'carid_clone') . '</span>' : __('Cart is empty', 'carid_clone')?></div>
					<div id="cart-contents">
						<span class="black"><?php _e('Shopping cart total', 'carid_clone')?>:</span> <span class="white strong"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
						<br />
						<span class="black tiny"><?php  _e('Number of items:', 'carid_clone')?> <span class="white strong"><?php echo $woocommerce->cart->cart_contents_count;?></span></span>
					</div><!-- #cart-contents -->
				</a><!-- #cart -->
	<?php
	$fragments['a#cart'] = ob_get_clean();
	return $fragments;
}

// remove parentheses from category list and add span class to post count
add_filter('wp_list_categories','categories_postcount_filter');
function categories_postcount_filter ($variable) {
	$variable = str_replace('(', '', $variable);
	$variable = str_replace(')', '', $variable);
	return $variable;
}

// A better exerpt
add_filter('get_the_excerpt', 'trim_excerpt');
function trim_excerpt($text){
	return preg_replace('#^(.*) \[&hellip;\]$#', '$1<a href=' . get_permalink() . '>&hellip;' . __('read more', 'carid_clone') . '</a>', $text);
}

// Remove prettyPhoto lightbox from reviews, not compatible with Raty
add_action( 'wp_enqueue_scripts', 'fc_remove_woo_lightbox', 99 );
function fc_remove_woo_lightbox() {
	global $woocommerce;
	if ( $lightbox_en && ( is_product() || ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) ) {
		wp_dequeue_script( 'prettyPhoto-init' );
		wp_enqueue_script( 'carid_clone-prettyPhoto-init', get_template_directory_uri() . '/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.init.js', array( 'jquery' ), $woocommerce->version, true );
	}
}

	
/**
 * Multiple ratings
 */
global $woocommerce;
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
