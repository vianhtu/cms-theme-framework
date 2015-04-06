jQuery(document).ready(function($) {
	"use strict";

	$(".redux-main").on("click", "#smof_data-presets_color ul li", function() {
		var presets = $(this).find('input').val();
		cms_presets(presets);
	});

	var presets_1 = {
		"primary_color" : "#ff2d2d",
		"secondary_color" : "#ff2d2d",
		"link_color" : "#ff2d2d",
		"header_background" : "#ff2d2d",
		"page_title_background" : "#ff2d2d",
		"body_background" : "#ff2d2d",
		"container_background" : "#ff2d2d",
		"footer_background" : "#ff2d2d",
		"footer_botton_background" : "#ff2d2d",
	}

	function cms_presets(presets) {
		$.each(presets_1, function(key , val){
			$("#"+key+"-color").val(val);
		});
		
		//$("#redux_save").trigger("click");
	}

});