<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package carid_clone
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
				<a id="cart" rel="nofollow" class="small" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" >
					<div id="cart-icon"></div>
					<div id="cart-contents">
						<span class="black"><?php _e('Shopping Cart', 'carid_clone')?>:</span> <span class="white strong"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
						<br />
						<span class="black tiny"><?php _e('Now in your cart', 'carid_clone')?>: <?php echo $woocommerce->cart->cart_contents_count;?> <?php _e('items', 'carid_clone')?></span>
					</div><!-- #cart-contents -->
				</a><!-- #cart -->
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
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'description' ); ?>" />
				</a>
			</div><!-- #logo -->
			<div class="one-third">
				<?php dynamic_sidebar( 'header-center' );?>
			</div>
			<div class="one-third last">
				<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/" class="alignright">
					<input type="text" size="18" value="<?php echo wp_specialchars($s, 1); ?>" placeholder="<?php _e('Search...', 'carid_clone');?>" name="s" id="s" />
				 	<i class="icon-search" id="searchsubmit"></i>
				</form>
			</div>
		</div><!-- #masthead-inner -->
	</header><!-- #masthead -->
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<?php wp_nav_menu( array(
			'theme_location' => 'primary',
			'container' => FALSE, 
		)); ?>
	</nav><!-- #site-navigation -->

	<?php 

	$_GET_tmp = isset($_GET) ? $_GET : array();
	if(is_product_category())
		$_GET_tmp['product_cat'] = TRUE;

	if (0 
		|| is_page() 
		|| is_product()
		|| (is_product_category() && count($_GET_tmp) == 1)
	){
		if(is_product_category())
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

		$slider_images = array();
		for($i = 1; $i <= 5; $i++){
			$get_field = is_product_category() 
				? get_field('slider_image_'.$i, $term->taxonomy . '_' . $term->term_id)
				: get_field('slider_image_'.$i);
			if($get_field)
				$slider_images[] = $get_field;
		}

		if($slider_images){
			?><div id="slider" class="nivoSlider"><?php
		}
		$i = 0;
		while($i < count($slider_images)){
			echo '<img src="' . $slider_images[$i] . '" alt="" />';
			$i++;
		}
		if($slider_images){
			?></div><!-- #slider --><?php
		}
	} 
	?>

	<div id="main" class="site-main <?php echo is_active_sidebar('sidebar-1') ? 'with-sidebar' : '' ?>">



