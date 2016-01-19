/**
*
* General jQuery functions.
*
* Contains stuff to make stuff happen.
*/

( function( $ ) {

	// Move video to top of page.
	function moveVideo() {
		var video = $( '.entry-content' ).find( '.jetpack-video-wrapper' );
		if ( 0 < video.length ) {
			video.prependTo( '#femfreq-video-container' );
		}
	}

	// Resize images so they fit our new content width better.
	// This may be done via some database work in the future & removed.
	function resizeImages() {
		// Remove height and width attributes from images
		$( '.entry-content' ).find( 'img' ).each( function() {
			if ( ! $( this ).hasClass( 'aligncenter' ) ) {
				$( this ).removeAttr( 'width' )
				$( this ).removeAttr( 'height' );
				$( this ).removeAttr( 'sizes' );
			}
		} );
	}

	// Add a data-attribute to links so we can do CSS effects and ensure that
	// links containing images don't inherit these properties.
	function fancyLinks() {
		// Add a data-atttribute to all .entry-content links
		$( '.entry-content' ).find( 'a' ).each( function() {
			if ( 0 < $( this ).has( 'img' ).length ) {
				$( this ).attr( 'rel', 'attachment' );
			} else {
				$( this ).attr( 'data-hover', $( this ).text() );
			}
		} );
	}


	// Run our functions as soon as possible
	$( document ).on( 'ready', function() {
		moveVideo();
	} );

	// Run our functions once the window has loaded fully
	$( window ).on( 'load', function() {
		resizeImages();
		fancyLinks();
	} );

} )( jQuery );
