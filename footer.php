<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cellar_Door
 */

?>
	</div><!-- #content -->
</div><!-- #page -->

<footer id="colophon" class="site-footer" role="contentinfo">

	<?php get_sidebar( 'footer' ); ?>

	<div class="site-info">
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cellar-door' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'cellar-door' ), 'WordPress' ); ?></a>
		<span class="sep"> | </span>
		<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'cellar-door' ), 'Cellar Door', '<a href="http://triggersandsparks.com/" rel="designer">sarah semark</a>' ); ?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
