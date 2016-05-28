<?php
/**
 * Template part for displaying posts on single post pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cellar_Door
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( 'video' !== get_post_format() ) :
		if ( has_post_thumbnail() ) :
			if ( '' === get_the_post_thumbnail() ) :
				echo '<div class="cellardoor-feature-placeholder"></div>';
			endif;
			the_post_thumbnail( 'cellardoor-feature' );
		else :
			echo '<div class="cellardoor-feature-placeholder"></div>';
		endif;
	else : ?>
		<div id="cellardoor-video-container">
			<blockquote class="alignright">
				Like this video? <a href="https://www.youtube.com/user/feministfrequency">Subscribe to our Youtube channel</a> for more!
			</blockquote>
		</div>
	<?php endif; ?>

	<header class="entry-header">

		<div class="entry-meta">
			<?php cellardoor_entry_header(); ?>
		</div><!-- .entry-meta -->

		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			cellardoor_excerpt();
		?>
	</header><!-- .entry-header -->

	<div class="content-container">

		<div id="cellardoor-sharing-container">
			<?php if ( function_exists( 'sharing_display' ) ) :
				sharing_display( '', true );
			endif; ?>
		</div>

		<div class="entry-content">

			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cellar-door' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cellar-door' ),
					'after'  => '</div>',
				) );
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php cellardoor_entry_footer(); ?>
			<?php cellardoor_author_panels(); ?>
		</footer><!-- .entry-footer -->

	</div>

	<?php get_sidebar(); ?>

</article><!-- #post-## -->
