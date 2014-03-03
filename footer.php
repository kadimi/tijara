<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package tijara
 */
?>

	</div><!-- #main -->

	<footer id="footer" class="site-footer" role="contentinfo">
		<div id="footer-inner">
			<?php dynamic_sidebar( 'footer' );?>
			<div class="site-info">
				<?php do_action( 'tijara_credits' ); ?>
				<?php printf( __( 'Copyright &copy; %d %s. All rights reserved', 'tijara' ), strftime('%Y', time()), get_bloginfo('name') ); ?>
				<span class="sep"> | </span>
				<a href="http://www.example.com" id="footer_logo"><?php printf( __('Design by %s', 'tijara' ), 'Example Company');?></a>
			</div><!-- .site-info -->
		</div><!-- #footer-inner -->
	</footer><!-- #footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>