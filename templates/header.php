<?php 
	/**
	 * Prevent direct access to this file
	 */
	function_exists('tijara_option') OR die(); 
?>

<header id="masthead" class="site-header" role="banner">

	<?php if ( tijara_option('topbar_menu') !== '0') { 
		tijara_load_template('header/top.php');
	} ?>
	
	<div id="masthead-inner">
		
		<?php if( !tijara_option('logo_position') || tijara_option('logo_position') === 'header' ) {?>
			<div id="logo" class="span<?php echo tijara_option('logo_width') ? tijara_option('logo_width') : 3; ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'))?>" rel="home"><img src="<?php echo tijara_get_logo_URL(); ?>" alt="<?php bloginfo( 'description')?>" /></a>
			</div><!-- #logo -->
		<?php } ?>

		<?php 
			// Calculate the header widgets sidebar depending on logo position
			if( !tijara_option('logo_position') || tijara_option('logo_position') === 'header' ) {
				$header_sidebar_spans = 
					tijara_option('logo_width') 
						? 12 - tijara_option('logo_width')
						: 9
				;
				$header_sidebar_spans = 'span' . $header_sidebar_spans . ' last';
			} else {
				$header_sidebar_spans = 'span12';
			}
		?>
		<div class="<?php echo $header_sidebar_spans; ?>">
			<?php dynamic_sidebar( 'header-center' );?>
		</div>


	</div><!-- #masthead-inner -->
</header><!-- #masthead -->
