<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package carid_clone
 */
?>
	<div id="sidebar" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'sidebar-1' );?>
	</div><!-- #secondary -->
