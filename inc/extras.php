<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cellar_Door
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cellardoor_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'cellardoor_body_classes' );

/**
 * Decrease the length of post excerpts to 32 words.
 */
function cellardoor_custom_excerpt_length( $length ) {
	return 32;
}
add_filter( 'excerpt_length', 'cellardoor_custom_excerpt_length', 999 );

/**
 * Use a simple ellipsis to indicate more content in the excerpt.
 */
function cellardoor_custom_excerpt_more() {
	return '&hellip; ';
}
add_filter( 'excerpt_more', 'cellardoor_custom_excerpt_more' );

/**
 * Filter the categories archive widget to add a span around post count
 */
function cellardoor_cat_count_span( $links ) {
	$links = str_replace( '</a> (', '</a><span class="post-count">(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return $links;
}
add_filter( 'wp_list_categories', 'cellardoor_cat_count_span' );

/**
 * Filter the archives widget to add a span around post count
 */
function cellardoor_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="post-count">(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return $links;
}
add_filter( 'get_archives_link', 'cellardoor_archive_count_span' );

/**
 * Remove sharing links and likes from bottom of posts. We'll add them manually ourselves.
 */
function cellardoor_remove_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );

	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'cellardoor_remove_share' );
