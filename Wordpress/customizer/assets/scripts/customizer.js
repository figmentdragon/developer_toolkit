/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

jQuery( document ).ready( function( $ ) {

( function ( $ ) {
	// Hook into the API.
	const api = api;

	// Site title.
	api( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site description.
	api( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

  api( 'header_textcolor', function ( value ) {
    value.bind( function( to ) {
      if ( 'blank' === to ) {
        $( '.lead, .site-title a, .site-description' ).css( {
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute',
        } );
      } else {
        $( '.lead, .site-title a, .site-description' ).css( {
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute',
        } );
      } else {
        $( '.lead .site-tite a, .site-description' ).css( {
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        } );
      }
    } );
  } );

	// Background image.
	api( 'background_image', function ( value ) {
		value.bind( function ( to ) {
			$( 'body' ).toggleClass( 'custom-background-image', '' !== to );
		} );
	} );

	// Copyright text.
	api( 'copyright_text', function ( value ) {
		value.bind( function ( to ) {
			$( '.site-info' ).text( to );
		} );
	} );
} )( jQuery );
