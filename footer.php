<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Feminist_Frequency
 */

?>
	</div><!-- #content -->
</div><!-- #page -->

<footer id="colophon" class="site-footer" role="contentinfo">

	<?php get_sidebar( 'footer' ); ?>

	<div class="site-info">
		&copy;2012&ndash;<?php echo date('Y'); ?> Feminist Frequency. <?php echo vip_powered_wpcom(); ?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
