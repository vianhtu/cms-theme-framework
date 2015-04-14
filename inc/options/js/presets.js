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
				cms_set_presets(response);
			}
		});
	});

	function cms_set_presets(presets) {
		$.each(presets, function(key, val) {
			if(!$.isPlainObject(val)){
				$("#" + key + "-color").val(val);
				$("#" + key + "-color").trigger("change");
			} else {
				if(val.color != undefined && val.color != ''){
					$('input#' + key + '-color').val(val.color);
					$('input#' + key + '-rgba').val(val.rgba);
					$('input#' + key + '-alpha').val(val.alpha);
					$('#smof_data-' + key + ' .sp-preview-inner').css("background-color", val.rgba);
				} else if (val['background-color'] != undefined && val['background-color'] != '') {
					$("#" + key + "-color").val(val['background-color']);
					$("#" + key + "-color").trigger("change");
				}
			}
		});
	}
});