jQuery(document)
		.ready(
				function($) {
					"use strict";

					$(".redux-main").on("click",
							"#smof_data-presets_color ul li", function() {
								var presets = $(this).find('input').val();
								cms_presets(presets);
							});

					var presets_1 = {
						"color" : {
							"secondary_color" : "",
							"link_color" : "",
							"header_background" : "",
							"page_title_background" : "",
							"body_background" : "",
							"container_background" : "",
							"footer_background" : "",
							"footer_botton_background" : "",
						},
						"rgba" : {
							"primary_color" : "",
						}
					}

					function cms_presets(presets) {
						// hex
						$.each(presets_1.color, function(key, val) {
							$("#" + key + "-color").val(val);
						});
						// rgba
						$.each(presets_1.rgba, function(key, val) {
							$("#" + key + "-rgba").val(val);
							$("#" + key + "-color").val(rgb2hex(val));
						});

						$("#redux_save").trigger("click");
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