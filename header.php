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
				<?php 
					$secondary_menu = wp_nav_menu(
						array(
							'container' => FALSE,
							'depth' => 1,
							'echo' => FALSE,
							'fallback_cb' => '__return_false',
							'menu_class' => '',
							'theme_location' => 'secondary_menu',
						)
					);
					// if (!empty($secondary_menu)) {
						echo '<div id="secondary-menu" class="span8">'.$secondary_menu.'</div>';
					// }
					if(kds_woocommerce_installed()) {
						kds_woocommerce_cart_botton(6);
					} 
				?>
			</div><!-- #masthead-top-inner -->
		</div><!-- #masthead-top -->
		<div id="masthead-inner">
			<div id="logo" class="span3">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'))?>" rel="home"><img src="<?php echo tijara_get_logo_URL(); ?>" alt="<?php bloginfo( 'description')?>" /></a>
			</div><!-- #logo -->
			<div class="span9 alignright last">
				<?php dynamic_sidebar( 'header-center' );?>
			</div>
		</div><!-- #masthead-inner -->
	</header><!-- #masthead -->
	<?php $primary_menu = wp_nav_menu( array(
			'container' => FALSE,
			'container_class' => 'desktop-only',
			'echo' => FALSE,
			'fallback_cb' => FALSE,
			'theme_location' => 'primary',
			'walker' => new Tijara_Walker_Menu(),
		)); 
		if($primary_menu){ ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php if ( tijara_option('disable_responsive') ) { ?>
					<div id="mobile-navigation">
						<label for="tinynav1" class="white"><i class="fa fa-align-justify double"></i></label>
					</div>
				<?php } ?>

				<?php echo $primary_menu; ?>

				<?php if ( tijara_option('disable_responsive') ) { ?>
					<div id="mobile-search">
						<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="search" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'tijara' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'tijara' ); ?>" />
						</form>
						<label for="s" class="gray"><i class="fa fa-search double"></i></label>
					</div>
				<?php } ?>

				<?php if ( tijara_option('disable_responsive') ) { ?>
				<div id="mobile-cart">
					<a href="#"><i class="fa fa-shopping-cart double"></i></a>	
				</div>
				<?php } ?>

			</nav><!-- #site-navigation -->
		<?php }
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



