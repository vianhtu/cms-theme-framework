<?php
/** @var $this WPBakeryShortCode_VC_Tab */
$output = $title = $tab_id = $cms_tab_bg_color = $cms_tab_border_color = '';
extract(shortcode_atts($this->predefined_atts, $atts));
extract(shortcode_atts( array(
	'cms_tab_bg_color' => '',
	'cms_tab_border_color' => ''
), $atts ) );

wp_enqueue_script('jquery_ui_tabs_rotate');

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="'.$css_class.'" style="background-color: '.$cms_tab_bg_color.';border-color: '.$cms_tab_border_color.';">';
$output .= ($content=='' || $content==' ') ? __("Empty tab. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_tab');
echo $output;
echo "<style type='text/css'>";
	echo "#tab-$tab_id .btn.btn-default.btn-white { 
		  background-color: $cms_tab_bg_color;}
		  #tab-$tab_id img {border-color: $cms_tab_border_color;}
    ";
echo "</style>";