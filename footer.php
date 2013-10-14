<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package carid_clone
 */
?>

	</div><!-- #main -->

	<footer id="footer" class="site-footer" role="contentinfo">
		<div id="footer-inner">
			<div id="footer-fourths">
				<?php dynamic_sidebar( 'footer' );?>
			</div><!-- footer-fourths -->
			<div class="site-info">
				<?php do_action( 'carid_clone_credits' ); ?>
				<?php printf( __( 'Copyright &copy; %d %s. All rights reserved', 'carid_clone' ), strftime('%Y', time()), get_bloginfo('name') ); ?>
				<span class="sep"> | </span>
				<a href="http://www.edesigner.com.sa" id="edesigner"><?php printf( __('Design by %s', 'carid_clone' ), 'EDesigner');?></a>
			</div><!-- .site-info -->
		</div><!-- #footer-inner -->
	</footer><!-- #footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>