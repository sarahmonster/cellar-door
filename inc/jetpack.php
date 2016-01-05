<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Feminist_Frequency
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function femfreq_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'femfreq_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'   => false,
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Site Logo
	add_image_size( 'femfreq-logo', 400, 400 );
	add_theme_support( 'site-logo', array( 'size' => 'femfreq-logo' ) );
}
add_action( 'after_setup_theme', 'femfreq_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function femfreq_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'template-parts/content', 'search' );
		else :
		    get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
