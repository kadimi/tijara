<?php 
	/**
	 * Prevent direct access to this file
	 */
	function_exists('tijara_option') OR die(); 
?>

<?php 

$primary_menu = wp_nav_menu( array(
	'container' => FALSE,
	'container_class' => 'desktop-only',
	'echo' => FALSE,
	'fallback_cb' => FALSE,
	'theme_location' => 'primary',
	'walker' => new Tijara_Walker_Menu(),
)); 

if($primary_menu){ 
	// Inject logo depending on theme settings
	if( !tijara_option('logo_position') || tijara_option('logo_position') === 'menu' ) {
		$inject = '<li' . ( !tijara_option('logo_position') ? ' class="none" ' : '' ) . '><a href="' . site_url() . '"><img src="' . tijara_get_favicon_URL() . '" height="32" width="32" /></a></li>'
		;
		$primary_menu = str_replace('class="menu"><', 'class="menu">' . $inject . '<', $primary_menu);
	} ?>

	<nav id="site-navigation" class="main-navigation" role="navigation">

		<?php if ( !tijara_option('disable_responsive') ) { ?>
			<div id="mobile-navigation">
				<label for="tinynav1" class="white"><i class="fa fa-bars double"></i></label>
			</div>
		<?php } ?>

		<?php echo $primary_menu; ?>

		<?php if ( !tijara_option('disable_responsive') ) { ?>
			<div id="mobile-search">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'tijara' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'tijara' ); ?>" />
				</form>
				<label for="s" class="gray"><i class="fa fa-search double"></i></label>
			</div>
		<?php } ?>

		<?php if ( !tijara_option('disable_responsive') ) { ?>
		<div id="mobile-cart">
			<a href="<?php echo $GLOBALS['woocommerce']->cart->get_cart_url(); ?>"><i class="fa fa-shopping-cart double"></i></a>	
		</div>
		<?php } ?>

	</nav><!-- #site-navigation -->
<?php }
