jQuery(document).ready(function($) {
	"use strict";
	
	/* select preset. */
	$(".redux-main").on("click", "#smof_data-presets_color ul li", function() {
		/* get presets. */
		var presets = $(this).find('input').val();
		/* get data */
		$.post(ajaxurl, {
			'action' : 'cms_get_preset_options',
			'preset' : presets,
		}, function(response) {
			/* set data. */
			if(response){
				cms_presets(response);
			}
		});
	});

	function cms_presets(presets) {
		$.each(presets, function(key, val) {
			$("#" + key + "-color").val(val);
			$("#" + key + "-color").trigger("change");
		});
	}

	// Function to convert hex format to a rgb color
	function rgb2hex(rgb) {
		rgb = rgb
				.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
		return (rgb && rgb.length === 4) ? "#"
				+ ("0" + parseInt(rgb[1], 10).toString(16))
						.slice(-2)
				+ ("0" + parseInt(rgb[2], 10).toString(16))
						.slice(-2)
				+ ("0" + parseInt(rgb[3], 10).toString(16))
						.slice(-2) : '';
	}

});