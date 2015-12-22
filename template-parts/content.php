<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Feminist_Frequency
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) :
		the_post_thumbnail( 'femfreq-feature' );
	endif; ?>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		femfreq_excerpt();
		?>
	</header><!-- .entry-header -->

	<?php if ( 'video' !== get_post_format() ) :
		get_sidebar();
	endif;
	?>

	<div class="entry-content">

		<?php femfreq_authors(); ?>

		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'femfreq' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'femfreq' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php femfreq_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
		<?php femfreq_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
