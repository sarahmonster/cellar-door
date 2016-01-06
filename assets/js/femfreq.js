/**
*
* General jQuery functions.
*
* Contains stuff to make stuff happen.
*/

( function( $ ) {

	// Add a data-atttribute to all .entry-content links
	$( '.entry-content' ).find( 'a' ).each( function() {
		if ( ! $( this ) ).has( 'img' ) ) {
			$( this ).attr( 'data-hover', $( this ).text() );
		}
	} );

	// Add a class to all links that contain images
	$( '.entry-content' ).find( 'a' ).has( 'img' ).addClass( 'image-link' );

} )( jQuery );
