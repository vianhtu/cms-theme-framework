jQuery(document).ready(function($) {
	"use strict";
	
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
		
		/* current scroll */
		var top = $(window).scrollTop();
		
		/* current window width */
		var window_width = $(window).width();
		
		/* get admin bar height */
		adminbar_height = adminbar.length > 0 ? adminbar.height() : 0 ;
		
		/* get top header menu */
		header_top = header.length > 0 ? header.offset().top - adminbar_height : 0 ;
		
		/* check sticky menu. */
		cms_stiky_menu(top);
		
		/* check mobile menu */
		cms_mobile_menu(window_width);
	});

	/**
	 * resize event.
	 * 
	 * Bind an event handler to the "resize" JavaScript event, or trigger that event on an element.
	 * @author Fox
	 */
	$(window).resize(function(event, ui) {
		/* current window width */
		var window_width = $(event.target).width();
		
		/* check mobile menu */
		cms_mobile_menu(window_width);
	});
	
	/**
	 * scroll event.
	 * 
	 * Bind an event handler to the "scroll" JavaScript event, or trigger that event on an element.
	 * @author Fox
	 */
	$(window).scroll(function() {
		/* current scroll */
		var top = $(window).scrollTop();
		
		/* check sticky menu. */
		cms_stiky_menu(top);
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
	function cms_mobile_menu(width) {
		var menu = $('#header-navigation');
		
		/* active mobile menu. */
		switch (true) {
		case (width <= 992 && width >= 768):
			menu.removeClass('phones-nav').addClass('tablets-nav');
			/* */
			cms_mobile_menu_group(menu);
			break;
		case (width <= 768):
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
});