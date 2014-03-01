<?php 
	/**
	 * Prevent direct access to this file
	 */
	function_exists('tijara_option') OR die(); 
?>

<?php
	
	$topbar_plus = tijara_option('topbar_plus');

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
?>

<div id="masthead-top">
	<div id="masthead-top-inner">
		<?php

			// Prepare menu width
			if ( strstr($topbar_plus, 'cart') && strstr($topbar_plus, 'social') ) {
				$topbar_menu_width = 6;
			} else if ( strstr($topbar_plus, 'cart') || strstr($topbar_plus, 'social') ) {
				$topbar_menu_width = 9;
			} else {
				$topbar_menu_width = 12;
			}

			// Show menu
			if ( !empty($secondary_menu) ) {
				echo '<div id="secondary-menu" class="span' . $topbar_menu_width . '">' . $secondary_menu . '</div>';
			}

			// Show cart and social
			if ( $topbar_plus === '' ) {
				$topbar_plus_elements = array();
			} else if( strstr($topbar_plus, '|') ) {
				$topbar_plus_elements = explode('|', $topbar_plus);
			} else {
				$topbar_plus_elements = array($topbar_plus);
			}

			foreach ($topbar_plus_elements as $element) {

				// Trak last and middle elements	
				if ( strlen($element) + strpos($topbar_plus, $element) === strlen($topbar_plus) ) {
					$last = true;
				} else {
					$last = false;
				}
				$middle = !$last && !empty($secondary_menu);

				// Show menu
				echo '<div id="' . $element . '-wrapper" class="desktop-only span' . ( empty($secondary_menu) ? '4' : '3') . ($last ? ' textalignright last' : '') . ($middle ? ' textaligncenter' : '') . '">';
				
				switch ($element) {
					case 'cart':
						kds_woocommerce_cart_botton();
						break;
					case 'social':
						header_social_links();
						break;
				}
				echo '</div>';
				
			}

		?>
	</div><!-- #masthead-top-inner -->
</div><!-- #masthead-top -->
