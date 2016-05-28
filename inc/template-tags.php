<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cellar_Door
 */


if ( ! function_exists( 'cellardoor_entry_header' ) ) :
/**
 * Prints HTML with meta information shown above post title: date posted, category, and edit link.
 */
function cellardoor_entry_header() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	// Hide category on pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'cellar-door' ) );
		if ( $categories_list && cellardoor_categorized_blog() ) {
			echo '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
		}
	}

	// Get a byline for all post author(s)
	if ( function_exists( 'coauthors_posts_links' ) ) :
		$coauthors = get_coauthors();
		foreach( $coauthors as $coauthor ) :
			if ( $byline ) :
				$byline .= ' & ';
			endif;
			$byline .= cellardoor_get_author_link( $coauthor->ID, $coauthor->display_name );
		endforeach;
	else :
		$byline = cellardoor_get_author_link( get_the_author_meta( 'ID' ), get_the_author_meta( 'display_name' ) );
	endif;

	echo '<span class="byline">by ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'cellardoor_categories' ) ) :
/**
 * Prints the categorie(s) for the post.
 */
function cellardoor_categories() {
	if ( 'post' === get_post_type() ) :
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'cellar-door' ) );
		if ( $categories_list && cellardoor_categorized_blog() ) :
			echo '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
		endif;
	endif;
}
endif;

if ( ! function_exists( 'cellardoor_excerpt' ) ) :
/**
 * Displays an optional excerpt.
 */
	function cellardoor_excerpt() {
		if ( has_excerpt() || is_search() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		<?php endif;
	}
endif;


if ( ! function_exists( 'cellardoor_author_panel' ) ) :
/**
 * Prints author bio panels for each post author.
 * Works whether we're using the Co-Authors Plus plugin or not.
 */
function cellardoor_author_panels() {
		if ( function_exists( 'coauthors_posts_links' ) ) :
			$coauthors = get_coauthors();
			foreach( $coauthors as $coauthor ) :
				cellardoor_author_bio( $coauthor->ID, $coauthor->display_name, $coauthor->user_description );
			endforeach;
		else :
			cellardoor_author_bio( get_the_author_meta( 'ID' ), get_the_author_meta( 'display_name' ), get_the_author_meta( 'description' ) );
		endif;
}
endif;

if ( ! function_exists( 'cellardoor_author_bio' ) ) :
/**
 * Prints an author bio panel with the post author(s)' Gravatar, bio, and URL.
 */
function cellardoor_author_bio( $id, $name, $bio ) { ?>
	<div class="author vcard">
		<?php echo get_avatar( $id, 300 ); ?>
		<h2 class="author-name"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( $id ) ); ?>"><?php echo $name; ?></a></h2>
		<p class="author-bio"><?php echo wp_kses_post( $bio ); ?></p>
	</div><!-- .author -->
<?php }
endif;

if ( ! function_exists( 'cellardoor_get_author_link' ) ) :
/**
 * Prints a simple byline with the author's name and a link to their author page.
 */
function cellardoor_get_author_link( $id, $name ) {
	$return = '<a class="url fn n" href="' . esc_url( get_author_posts_url( $id ) ) . '">' . $name . '</a>';
	return $return;
}
endif;

if ( ! function_exists( 'cellardoor_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function cellardoor_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'cellar-door' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'cellar-door' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'cellar-door' ), esc_html__( '1 Comment', 'cellar-door' ), esc_html__( '% Comments', 'cellar-door' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'cellar-door' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cellardoor_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'cellardoor_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cellardoor_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so cellardoor_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so cellardoor_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in cellardoor_categorized_blog.
 */
function cellardoor_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'cellardoor_categories' );
}
add_action( 'edit_category', 'cellardoor_category_transient_flusher' );
add_action( 'save_post',     'cellardoor_category_transient_flusher' );
