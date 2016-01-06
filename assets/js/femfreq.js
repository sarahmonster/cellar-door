/**
*
* General jQuery functions.
*
* Contains stuff to make stuff happen.
*/

( function( $ ) {

	// Run our functions once the window has loaded fully
	$( window ).on( 'load', function() {

		// Add a data-atttribute to all .entry-content links
		$( '.entry-content' ).find( 'a' ).each( function() {
			if ( 0 < $( this ).has( 'img' ).length ) {
				$( this ).attr( 'rel', 'attachment' );
			} else {
				$( this ).attr( 'data-hover', $( this ).text() );
			}
		} );

		// Add a class to all links that contain images
		//$( '.entry-content' ).find( 'a' ).has( 'img' ).addClass( 'image-link' );

		// Remove height and width attributes from images
		$( '.entry-content' ).find( 'img' ).each( function() {
			if ( ! $( this ).hasClass( 'aligncenter' ) ) {
				$( this ).removeAttr( 'width' )
				$( this ).removeAttr( 'height' );
				$( this ).removeAttr( 'sizes' );
			}
		} );

	} );


} )( jQuery );
