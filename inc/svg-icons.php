<?php
/**
 * SVG icon functionality.
 *
 * Borrowed from SVGenericons: https://github.com/sarahmonster/svgenericons
 * This makes it easier for us to get up and running with SVG icons, without
 * doing a lot of extra work or adjusting our templates.
 *
 * Currently using the <symbol> method of insertion, YMMV.
 */

/*
 * Inject our SVG sprite at the bottom of the page.
 *
 * There is a possibility that this will cause issues with
 * older versions of Chrome. In which case, it may be
 * necessary to inject just after the </head> tag.
 * See: https://code.google.com/p/chromium/issues/detail?id=349175
 *
 * This function currently isn't being used, since we're using an external sprite
 * instead of embedding the sprite into the document directly.
 */
function femfreq_inject_sprite() {
	include_once( get_template_directory() .'/assets/svg/icons.svg' );
}
//add_filter( 'wp_footer' , 'femfreq_inject_sprite' );

/*
 * Inject some header code to make IE play nice.
 *
 * This seems to do the trick, but may require more testing.
 * Also may not be something theme authors necessarily want
 * or need added to their headers, so we'll see.
 * See: https://github.com/jonathantneal/svg4everybody
 */
function femfreq_ie_shim() {
 echo '<meta http-equiv="x-ua-compatible" content="ie=edge">';
}
add_filter( 'wp_head' , 'femfreq_ie_shim' );

/**
 * This allows us to get the SVG code and return as a variable
 * Usage: femfreq_get_icon( 'name-of-icon' );
 */
function femfreq_get_icon( $name ) {
	$return = '<svg class="femfreq-icon icon-' . $name . '">';
		$return .= '<use xlink:href="' . esc_url( get_template_directory_uri() ) . '/assets/svg/icons.svg#' . $name . '" />';
		$return .= '</svg>';
 return $return;
}

/*
 * This allows for easy injection of SVG references inline.
 * Usage: femfreq_icon( 'name-of-icon' );
 */
function femfreq_icon( $name ) {
	echo femfreq_get_icon( $name );
}