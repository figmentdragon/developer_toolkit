 /* global MYTHEMEOptions */
 /*
 * Custom scripts
 * Description: Custom scripts for MYTHEME Pro
 */

( function( $ ) {
	$( window ).on( 'load.MYTHEME resize.MYTHEME', function () {
		// Owl Carousel.
		if ( typeof $.fn.owlCarousel === "function" ) {
			// Featured Slider
			var sliderOptions = {
				rtl:MYTHEMEOptions.rtl ? true : false,
				autoHeight:true,
				margin: 0,
				items: 1,
				nav: true,
				dots: true,
				autoplay: true,
				autoplayTimeout: 4000,
				loop: true,
				responsive:{
					0:{
						items:1
					},
				},
				navText: [MYTHEMEOptions.iconNavPrev,MYTHEMEOptions.iconNavNext]
			};

			$(".main-slider").owlCarousel(sliderOptions);

			// Testimonial Section
			var testimonialOptions = {
				rtl:MYTHEMEOptions.rtl ? true : false,
				autoHeight: true,
				margin: 0,
				items: 1,
				nav: true,
				dots: true,
				autoplay: true,
				autoplayTimeout: 4000,
				loop: true,
				center: true,
				responsive:{
					0:{
						items:1
					},
					568:{
						items:2
					},
				},
				navText: [MYTHEMEOptions.iconTestimonialNavPrev,MYTHEMEOptions.iconTestimonialNavNext],
				dotsContainer: '#slider-dots',
				navContainer: '#slider-nav'
			};

			$( '.testimonial-slider' ).owlCarousel(testimonialOptions);
		}
		
		if ( typeof $.fn.masonry === "function" && typeof $.fn.imagesLoaded === "function" ) {
			/*
		     * Masonry
		     */
		    //Masonry blocks
		    $blocks = $('.grid');
		    $blocks.imagesLoaded(function(){
		        $blocks.masonry({
		            itemSelector: '.grid-item',
		            columnWidth: '.grid-item',
		            // slow transitions
		            transitionDuration: '1s'
		        });

		        // Fade blocks in after images are ready (prevents jumping and re-rendering)
		        $('.grid-item').fadeIn();

		        $blocks.find( '.grid-item' ).animate( {
		            'opacity' : 1
		        } );
		    });

		    $( function() {
		        setTimeout( function() { $blocks.masonry(); }, 2000);
		    });

		    $(window).on( 'resize', function () {
		        $blocks.masonry();
		    });
		}

	});

	// Add header video class after the video is loaded.
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$( 'body' ).addClass( 'has-header-video' );
	});

	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	$( function() {
		$( document ).ready( function() {
			if ( true === supportsInlineSVG() ) {
				document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
			}
		});
	});

$( document ).ready( function() {
	$( '.search-toggle' ).on( 'click', function() {
		$( this ).toggleClass( 'open' );
		$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		$( '.search-wrapper' ).toggle();
		$( 'body' ).toggleClass( 'search-wrapper-open' );	

		if( $("#primary-search-wrapper").hasClass("is-open") ) {
			setTimeout(function () {
				$(".search-inside-wrapper input.search-field")[0].focus();
			}, 500);
		}
	});

	$( '.close-submit' ).on( 'click', function() {
		$( 'body' ).removeClass( 'search-wrapper-open' );	
	});
});


	/* Menu */
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
			.append( MYTHEMEOptions.dropdownIcon )
			.append( $( '<span />', { 'class': 'screen-reader-text', text: MYTHEMEOptions.screenReaderText.expand }) );

		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );
		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).append( MYTHEMEOptions.dropdownIcon );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children, .page_item_has_children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).on( 'click', function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === MYTHEMEOptions.screenReaderText.expand ? MYTHEMEOptions.screenReaderText.collapse : MYTHEMEOptions.screenReaderText.expand );
		} );
	}

	initMainNavigation( $( '.main-navigation' ) );

	masthead         = $( '#masthead' );
	menuToggle       = masthead.find( '.menu-toggle' );
	siteHeaderMenu   = masthead.find( '#site-header-menu' );
	siteNavigation   = masthead.find( '#site-navigation' );
	socialNavigation = masthead.find( '#social-navigation' );


	// Enable menuToggle.
	( function() {

		// Adds our overlay div.
		$( '.below-site-header' ).prepend( '<div class="overlay">' );

		// Assume the initial scroll position is 0.
		var scroll = 0;

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		menuToggle.on( 'click.nusicBand', function() {
			// jscs:disable
			$( this ).add( siteNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );


		// Add an initial values for the attribute.
		menuToggle.add( siteNavigation ).attr( 'aria-expanded', 'false' );
		menuToggle.add( socialNavigation ).attr( 'aria-expanded', 'false' );

		// Wait for a click on one of our menu toggles.
		menuToggle.on( 'click.nusicBand', function() {

			// Assign this (the button that was clicked) to a variable.
			var button = this;

			// Gets the actual menu (parent of the button that was clicked).
			var menu = $( this ).parents( '.menu-wrapper' );

			// Remove selected classes from other menus.
			$( '.menu-toggle' ).not( button ).removeClass( 'selected' );
			$( '.menu-wrapper' ).not( menu ).removeClass( 'is-open' );

			// Toggle the selected classes for this menu.
			$( button ).toggleClass( 'selected' );
			$( menu ).toggleClass( 'is-open' );

			// Is the menu in an open state?
			var is_open = $( menu ).hasClass( 'is-open' );
			var search = $( '#primary-search-wrapper' ).hasClass( 'is-open' );

			// If the menu is open and there wasn't a menu already open when clicking.
			if ( is_open && ! jQuery( 'body' ).hasClass( 'menu-open' ) ) {

				// Get the scroll position if we don't have one.
				if ( 0 === scroll ) {
					scroll = $( 'body' ).scrollTop();
				}

				// Add a custom body class.
				$( 'body' ).addClass( 'menu-open' );

			// If we're closing the menu.
			} else if ( ! is_open ) {

				$( 'body' ).removeClass( 'menu-open' );
				$( 'body' ).scrollTop( scroll );
				scroll = 0;
			}

			if( search ) {
				$( 'body' ).removeClass( 'menu-open' );						
			}
		} );

		// Close menus when somewhere else in the document is clicked.
		$( document ).on( 'click touchstart', function() {
			$( 'body' ).removeClass( 'menu-open' );
			$( '.menu-toggle' ).removeClass( 'selected' );
			$( '.menu-wrapper' ).removeClass( 'is-open' );
		} );

		$( '.close-toggle' ).on( 'click touchstart', function() {
			$( 'body' ).removeClass( 'menu-open' );
			$( '.menu-toggle' ).removeClass( 'selected' );
			$( '.menu-wrapper' ).removeClass( 'is-open' );
			return false;
		} );

		//Close search when clicked outside search area
		var container = document.getElementsByClassName('search-content')[0];
		document.addEventListener('click', function( event ) {
		  if (container !== event.target && !container.contains(event.target)) {    
		    $( 'body' ).removeClass( 'search-wrapper-open' );
		  }
		});

		// Stop propagation if clicking inside of our main menu.
		$( '.site-header-menu,.menu-toggle, .dropdown-toggle, .search-field, #site-navigation, #social-search-wrapper, #social-navigation .search-submit' ).on( 'click touchstart', function( e ) {
			e.stopPropagation();
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.nusicBand', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).on( 'touchstart.nusicBand', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.nusicBand' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.nusicBand', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.nusicBand blur.nusicBand', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();

	// Add the default ARIA attributes for the menu toggle and the navigations.
	function onResizeARIA() {
		if ( window.innerWidth < 910 ) {
			if ( menuToggle.hasClass( 'toggled-on' ) ) {
				menuToggle.attr( 'aria-expanded', 'true' );
			} else {
				menuToggle.attr( 'aria-expanded', 'false' );
			}

			if ( siteHeaderMenu.hasClass( 'toggled-on' ) ) {
				siteNavigation.attr( 'aria-expanded', 'true' );
				socialNavigation.attr( 'aria-expanded', 'true' );
			} else {
				siteNavigation.attr( 'aria-expanded', 'false' );
				socialNavigation.attr( 'aria-expanded', 'false' );
			}

			menuToggle.attr( 'aria-controls', 'site-navigation social-navigation' );
		} else {
			menuToggle.removeAttr( 'aria-expanded' );
			siteNavigation.removeAttr( 'aria-expanded' );
			socialNavigation.removeAttr( 'aria-expanded' );
			menuToggle.removeAttr( 'aria-controls' );
		}
	}

	$(document).ready(function() {
		/*Search and Social Container*/
		$('.toggle-top').on('click', function(e){
			$(this).toggleClass('toggled-on');
		});

		$('#search-toggle').on('click', function(){
			$('#header-menu-social, #share-toggle').removeClass('toggled-on');
			$('#header-search-container').toggleClass('toggled-on');
		});

		$('#share-toggle').on('click', function(e){
			e.stopPropagation();
			$('#header-search-container, #search-toggle').removeClass('toggled-on');
			$('#header-menu-social').toggleClass('toggled-on');
		});
	});

	/*Click and scrolldown from silder image*/
    $('body').on('click touch','.scroll-down', function(e){
        var Sclass = $(this).parents('.section, .custom-header').next().attr('class');
        var Sclass_array = Sclass.split(" ");
        var scrollto = $('.' + Sclass_array[0] ).offset().top;

        $('html, body').animate({
            scrollTop: scrollto
        }, 1000);

    });

    // Mobile Nav, social and search toggle on focus out event
    jQuery( document ).ready( function() {
		body = jQuery( document.body );
		jQuery( window )
			.on( 'load.MYTHEME resize.MYTHEME', function() {
			if ( window.innerWidth < 1024 ) {
				jQuery('#primary-menu-wrapper').on('focusout', function () {
					var $elem = jQuery(this);

				    // let the browser set focus on the newly clicked elem before check
				    setTimeout(function () {
				        if ( ! $elem.find(':focus').length ) {
				            jQuery( '#primary-menu-wrapper .menu-toggle' ).trigger('focus');
				        }
				    }, 0);
				});
			}

			jQuery('#social-menu-wrapper .menu-inside-wrapper').on('focusout', function () {
				var $elem = jQuery(this);

			    // let the browser set focus on the newly clicked elem before check
			    setTimeout(function () {
			        if ( ! $elem.find(':focus').length ) {
			            jQuery( '#share-toggle' ).trigger('focus');
			        }
			    }, 0);
			});

			jQuery('#primary-search-wrapper .menu-inside-wrapper').on('focusout', function () {
				var $elem = jQuery(this);

			    // let the browser set focus on the newly clicked elem before check
			    setTimeout(function () {
			        if ( ! $elem.find(':focus').length ) {
			        	jQuery( '#search-toggle' ).trigger('focus');
			        }
			    }, 0);
			});

			jQuery('.search-inside-wrapper').on('focusout', function () {
				var $elem = jQuery(this);

				// let the browser set focus on the newly clicked elem before check
				setTimeout(function () {
					if (!$elem.find(':focus').length) {
						jQuery('.close-submit').trigger('focus');
					}
				}, 0);
			});
		} );
	});

	if ( $("#site-generator").children().size() > 1 ) {
		$("#site-generator").removeClass( 'one' );
		$("#site-generator").addClass( 'two' );
	}

	$(".section-title, #contact-section .entry-title").html(function(){
	  var text= $(this).text().trim().split(" ");
	  var last = text.pop();
	  return text.join(" ") + (text.length > 0 ? " <span class='title-two'>" + last + "</span>" : last);
	});
} )( jQuery );
