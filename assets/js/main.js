jQuery(document).ready(function($) {
	"use strict";
	
	/* window */
	var window_width, window_height;
	
	/* admin bar */
	var adminbar = $('#wpadminbar');
	var adminbar_height = 0;
	
	/* header menu */
	var header = $('.header');
	var header_top = 0;
	
	/**
	 * window load event.
	 * 
	 * Bind an event handler to the "load" JavaScript event.
	 * @author Fox
	 */
	$(window).load(function() {
		
		/** current scroll */
		var top = $(window).scrollTop();
		
		/** current window width */
		window_width = $(window).width();
		
		/** current window height */
		window_height = $(window).height();
		
		/* get admin bar height */
		adminbar_height = adminbar.length > 0 ? adminbar.height() : 0 ;
		
		/* get top header menu */
		header_top = header.length > 0 ? header.offset().top - adminbar_height : 0 ;
		
		/* check sticky menu. */
		cms_stiky_menu(top);
		
		/* check mobile menu */
		cms_mobile_menu(window_width);
		
		/* check back to top */
		cms_back_to_top(top);
	});

	/**
	 * resize event.
	 * 
	 * Bind an event handler to the "resize" JavaScript event, or trigger that event on an element.
	 * @author Fox
	 */
	$(window).resize(function(event, ui) {
		/** current window width */
		window_width = $(event.target).width();
		
		/** current window height */
		window_height = $(window).height();
		
		/* check mobile menu */
		cms_mobile_menu();
	});
	
	/**
	 * scroll event.
	 * 
	 * Bind an event handler to the "scroll" JavaScript event, or trigger that event on an element.
	 * @author Fox
	 */
	$(window).scroll(function() {
		/** current scroll */
		var top = $(window).scrollTop();
		
		/* check sticky menu. */
		cms_stiky_menu(top);
		
		/* check back to top */
		cms_back_to_top(top);
	});

	/**
	 * Stiky menu
	 * 
	 * Show or hide sticky menu.
	 * @author Fox
	 * @since 1.0.0
	 */
	function cms_stiky_menu(top) {
		if (header_top <= top) {
			header.addClass('header-fixed');
		} else {
			header.removeClass('header-fixed');
		}
	}

	/**
	 * Sub menu align
	 * 
	 * Set position sub menu left or right.
	 * @author Fox
	 * @since 1.0.0
	 */
	$('#header-navigation li').hover(function(){
		var sub_menu = $(this).find('ul:first');
		if(sub_menu.length > 0){
			var sub_x = sub_menu.offset().left;
			var sub_w = sub_menu.outerWidth(true);
			if(sub_x > 0 && (sub_x + sub_w) > window_width){
				sub_menu.addClass('ping-right');
			} else {
				sub_menu.removeClass('ping-right');
			}
			
		}
	});
	
	/**
	 * Mobile menu
	 * 
	 * Show or hide mobile menu.
	 * @author Fox
	 * @since 1.0.0
	 */
	
	$('#menu-mobile').click(function(){
		var navigation = $(this).parent().find('#header-navigation');
		if(!navigation.hasClass('collapse')){
			navigation.addClass('collapse');
		} else {
			navigation.removeClass('collapse');
		}
	});
	/* check mobile screen. */
	function cms_mobile_menu() {
		var menu = $('#header-navigation');
		
		/* active mobile menu. */
		switch (true) {
		case (window_width <= 992 && window_width >= 768):
			menu.removeClass('phones-nav').addClass('tablets-nav');
			/* */
			cms_mobile_menu_group(menu);
			break;
		case (window_width <= 768):
			menu.removeClass('tablets-nav').addClass('phones-nav');
			break;
		default:
			menu.removeClass('mobile-nav tablets-nav');
			menu.find('li').removeClass('mobile-group');
			break;
		}	
	}
	/* group sub menu. */
	function cms_mobile_menu_group(nav) {
		nav.each(function(){
			$(this).find('li').each(function(){
				if($(this).find('ul:first').length > 0){
					$(this).addClass('mobile-group');
				}
			});
		});
	}
	
	/**
	 * Back To Top
	 * 
	 * @author Fox
	 * @since 1.0.0
	 */
	$('#back_to_top').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 1500);
    });
	
	/* show or hide buttom  */
	function cms_back_to_top(top){
		/* back to top */
        if (top < window_height) {
        	$('#back_to_top').addClass('off').removeClass('on');
        } else {
        	$('#back_to_top').removeClass('off').addClass('on');
        }
	}
});