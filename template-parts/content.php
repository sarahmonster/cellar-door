<?php
/**
 * Template part for displaying posts on archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cellar_Door
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-wrapper">

		<header class="entry-header">
			<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'cellardoor-card' );
			else :
				echo '<div class="cellardoor-feature-placeholder"></div>';
			endif;
			?>

			<div class="entry-meta">
				<?php cellardoor_categories(); ?>
			</div><!-- .entry-meta -->

			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header>

		<div class="entry-summary">
			<?php //cellardoor_excerpt();
			the_excerpt(); ?>
		</div>

	</div><!-- .entry-wrapper -->
</article><!-- #post-## -->
