<?php
/**
 * Template part for displaying posts on single post pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Feminist_Frequency
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( 'video' !== get_post_format() ) :
		if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'femfreq-feature' );
		else :
			echo '<div class="femfreq-feature-placeholder"></div>';
		endif;
	else :
		echo '<div id="femfreq-video-container"></div>';
	endif;
	?>

	<header class="entry-header">

		<div class="entry-meta">
			<?php femfreq_entry_header(); ?>
		</div><!-- .entry-meta -->

		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			femfreq_excerpt();
		?>
	</header><!-- .entry-header -->

	<?php if ( 'video' !== get_post_format() ) :
		get_sidebar();
	endif; ?>

	<div class="content-container">

		<div id="femfreq-sharing-container"> </div>

		<div class="entry-content">

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
			<?php //femfreq_entry_footer(); ?>
			<?php femfreq_author_panels(); ?>
		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-## -->
