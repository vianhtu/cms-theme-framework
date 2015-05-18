<?php
vc_map(
	array(
		"name" => __("CMS Custom", CMS_NAME),
	    "base" => "cms_custom",
	    "class" => "vc-cms-counter",
	    "category" => __("CmsSuperheroes Shortcodes", CMS_NAME),
	    "params" => array(
	    	array(
	            "type" => "textfield",
	            "heading" => __("Title",CMS_NAME),
	            "param_name" => "title",
	            "group" => __("General Settings", CMS_NAME)
	        ),
	        array(
	            "type" => "textarea",
	            "heading" => __("Description",CMS_NAME),
	            "param_name" => "description",
	            "group" => __("General Settings", CMS_NAME)
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Content Align",CMS_NAME),
	            "param_name" => "content_align",
	            "value" => array(
	            	"Default" => "default",
	            	"Left" => "left",
	            	"Right" => "right",
	            	"Center" => "center"
	            	),
	            "group" => __("General Settings", CMS_NAME)
	        ),
	        
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra Class",CMS_NAME),
	            "param_name" => "class",
	            "group" => __("Template", CMS_NAME)
	        ),
	    	array(
	            "type" => "cms_template",
	            "param_name" => "cms_template",
	            "shortcode" => "cms_counter",
	            "group" => __("Template", CMS_NAME),
	        )
		)
	)
);
class WPBakeryShortCode_cms_custom extends CmsShortCode{
	protected function content($atts, $content = null){
		$atts_extra = shortcode_atts(array(
			'title' => '',
			'description' => '',
			'content_align' => 'default',
			'class' => '',
			    ), $atts);
		$atts = array_merge($atts_extra,$atts);

        $html_id = cmsHtmlID('cms-custom');
        $class = ($atts['class'])?$atts['class']:'';
        $atts['template'] = 'template-'.str_replace('.php','',$atts['cms_template']). ' content-align-' . $atts['content_align'] . ' '. $class;
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
	}
}

?>