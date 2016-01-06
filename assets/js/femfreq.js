/**
*
* General jQuery functions.
*
* Contains stuff to make stuff happen.
*/

( function( $ ) {

	// Add a data-atttribute to all .entry-content links
	$( '.entry-content' ).find( 'a' ).each( function() {
		$( this ).attr( 'data-hover', $( this ).text() );
	} );

} )( jQuery );
