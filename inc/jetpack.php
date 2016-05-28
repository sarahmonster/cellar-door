<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Cellar_Door
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function cellardoor_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'cellardoor_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'   => false,
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Testimonials.
	add_theme_support( 'jetpack-testimonial' );

	// Add theme support for Site Logo
	add_image_size( 'cellardoor-logo', 400, 400 );
	add_theme_support( 'site-logo', array( 'size' => 'cellardoor-logo' ) );
}
add_action( 'after_setup_theme', 'cellardoor_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function cellardoor_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'template-parts/content', 'search' );
		else :
		    get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
