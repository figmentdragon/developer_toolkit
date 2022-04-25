(function ($) {
  "use strict";

    $(document).ready(function() {
    $('.search-field').on({
      focus: function() {
        $('.search-form').addClass('fixed');
      },
      blur: function() {
        $('.search-form').removeClass('fixed');
      }
    });
  });

  $(window).scroll(function () {
    if ($(window).scrollTop() > 100) {
      $(".main-header").addClass("sticky");
    } else {
      $(".main-header").removeClass("sticky");
    }
  });

  $(document).ready(function () {
    var $header = $('.header');

    // 3. Menu Mobile
    var $btnMenu = $('.menu-mobile'),
    $hideMenu = $('.hide-menu'),
    $ShowClose = $('.close-block');

    $btnMenu.on('click', function () {
      $header.toggleClass('active');
      if ($header.hasClass('active')) {
        $hideMenu.addClass('active');
        $ShowClose.addClass('active');
      }
      else {
        $hideMenu.removeClass('active');
        $ShowClose.removeClass('active');
        $btnMenu.focus();
      }
    });
    $hideMenu.on('click', function () {
      $header.removeClass('active');
      $hideMenu.removeClass('active');
      $ShowClose.removeClass('active');
      $btnMenu.focus();
    });

    $ShowClose.on('click', function () {
      $header.removeClass('active');
      $hideMenu.removeClass('active');
      $ShowClose.removeClass('active');
      $btnMenu.focus();
    });

    var mainMenuListDropdown = $('.main-menu ul li:has(ul)');

    mainMenuListDropdown.each(function () {
        $(this).append('<span class="dropdown-plus"></span>');
        $(this).addClass('dropdown_menu');
    });

     $('.dropdown-plus').on("click", function () {
         $(this).prev('ul').slideToggle(300);
         $(this).toggleClass('dropdown-open');
     });

         //$('.menu-item-has-children a').append('<span></span>');

    $('.btn-close').on('click', function (event) {
        event.preventDefault();
        $header.removeClass('active');
        $hideMenu.removeClass('active');
        $btnMenu.focus();
      });

    // 5. Preload

    var $preload = $('#preload');

    if ($preload.length) {
      $(window).on('load', function () {
        $preload.fadeOut(400);
      });
    }

  });
 
  var width = $(window).width();
    if(width < 992) {
        $('.header').on('keydown', function(e) {
            if($('.header ').hasClass('active')) {
                var focusableEls = $('.header a[href]:not([disabled]), .header button');
                var firstFocusableEl = focusableEls[0];
                var lastFocusableEl = focusableEls[focusableEls.length - 1];
                var KEYCODE_TAB = 9;
                if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
                    if ( e.shiftKey ) /* shift + tab */ {
                        if (document.activeElement === firstFocusableEl) {
                            lastFocusableEl.focus();
                            e.preventDefault();
                        }
                    }
                    else /* tab */ {
                        if (document.activeElement === lastFocusableEl) {
                            firstFocusableEl.focus();
                            e.preventDefault();
                        }
                    }
                }
            }
        });
    }


})(jQuery);
