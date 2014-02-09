<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package tijara
 */

// Make WooCommerce cart accessible
global $woocommerce;


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div id="masthead-top">
			<div id="masthead-top-inner">
				<?php if(kds_woocommerce_installed()): ?>
				<a id="cart" rel="nofollow" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" >
					<div id="cart-icon"><?php echo $woocommerce->cart->cart_contents_count > 0 ? __('Cart contains items', 'tijara') . ' <span class="tiny">' . __('(click to pay)', 'tijara') . '</span>' : __('Cart is empty', 'tijara')?></div>
					<div id="cart-contents">
						<span class="black"><?php _e('Shopping cart total', 'tijara')?>:</span> <span class="white strong"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
						<br />
						<span class="black tiny"><?php  _e('Number of items:', 'tijara')?> <span class="white strong"><?php echo $woocommerce->cart->cart_contents_count;?></span></span>
					</div><!-- #cart-contents -->
				</a><!-- #cart -->
				<?php endif;?>
				<?php 
				$secondary_menu = wp_nav_menu(
					array(
						'theme_location' => 'secondary_menu',
						'echo' => FALSE,
						'container' => FALSE,
						'menu_class' => '',
						'fallback_cb' => '__return_false',
					)
				);
				if (!empty($secondary_menu))
					echo '<div id="secondary-menu">'.$secondary_menu.'</div>';
				?>

			</div><!-- #masthead-top-inner -->
		</div><!-- #masthead-top -->
		<div id="masthead-inner">
			<div id="logo" class="one-third">
				<?php $header_image = get_header_image(); ?>
				<?php if($header_image) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'))?>" rel="home"><img src="<?php echo $header_image?>" alt="<?php bloginfo( 'description')?>" /></a>
				<?php else : ?>
					<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<h4><?php bloginfo( 'description' ); ?></h4>
				<?php endif; ?>
			</div><!-- #logo -->
			<div class="one-third">
				<?php dynamic_sidebar( 'header-center' );?>
			</div>
			<div class="one-third last">
				<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/" class="alignright">
					<input type="text" size="18" value="<?php echo esc_html($s); ?>" placeholder="<?php _e('Search...', 'tijara');?>" name="s" id="s" />
				 	<i class="icon-search" id="searchsubmit"></i>
				</form>
			</div>
		</div><!-- #masthead-inner -->
	</header><!-- #masthead -->
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<?php wp_nav_menu( array(
			'theme_location' => 'primary',
			'container' => FALSE,
			'fallback_cb' => FALSE
		)); ?>
	</nav><!-- #site-navigation -->

	<?php 
	// Load images if applicable, i.e, for pages, products and product categories
	if ( is_page() OR kds_is_product() OR kds_is_product_category()	) {
		// Taxonomy archive pages are different, we will query term data
		if (kds_is_product_category()) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); 
			$term_custom = piklist('get_term_custom', $term->term_id);
			$slider_images = $term_custom['slider_images'];
		}
		// For other pages (page, product, post), we use the post meta
		else {
			$slider_images = get_post_meta($post->ID, 'slider_images', false);
		}

		// OK, let's get actual URL instead of attachment ID
		if($slider_images){
			foreach ($slider_images as $key => $value) 
				$slider_images[$key] = wp_get_attachment_url($value);
		}

		if($slider_images){
			?><div id="slider" class="nivoSlider"><?php
			foreach ($slider_images as $src)
				echo '<img src="' . $src . '" alt="" />';
			?></div><!-- #slider --><?php
		}
	} 
	?>

	<div id="main" class="site-main <?php echo is_active_sidebar('sidebar-1') ? 'with-sidebar' : '' ?>">



