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
	 * @author Fox
	 */
	$(window).load(function() {
		
		/* current scroll */
		var top = $(window).scrollTop();
		
		/* get admin bar height */
		adminbar_height = adminbar.length > 0 ? adminbar.height() : 0 ;
		
		/* get top header menu */
		header_top = header.length > 0 ? header.offset().top - adminbar_height : 0 ;
		
		/* load sticky menu. */
		cms_stiky_menu(top);
	});

	/**
	 * scroll event.
	 * 
	 * @author Fox
	 */
	$(window).scroll(function() {
		/* current scroll */
		var top = $(window).scrollTop();
		
		/* load sticky menu. */
		cms_stiky_menu(top);
	});

	/* end scroll event */

	/**
	 * Stiky menu
	 * 
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

	/* end stiky menu */
});