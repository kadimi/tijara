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
<link rel="shortcut icon" href="<?php echo tijara_get_favicon_URL(); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php 
	
	do_action('before');
	tijara_load_template('header.php');
	tijara_load_template('navigation.php');
	tijara_load_template('slider.php');

	?>

	<div id="main" class="site-main <?php echo is_active_sidebar('sidebar') ? 'with-sidebar' : '' ?>">
