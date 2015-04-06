<?php
/**
 * Add row params
 * 
 * @author Fox
 * @since 1.0.0
 */
if (shortcode_exists('vc_row')) {
    vc_add_param('vc_row', array(
        'type' => 'checkbox',
        'heading' => __("Content Full Width", THEMENAME),
        'param_name' => 'full_width',
        'value' => array(
            'Yes' => true
        ),
        'description' => __("Yes = content full width, default content boxed.", THEMENAME)
    ));
    vc_add_param('vc_row', array(
        'type' => 'dropdown',
        'heading' => __("Background Style", THEMENAME),
        'param_name' => 'bg_style',
        'value' => array(
            'Default' => '',
            'Image / Parallax' => 'img_parallax',
            'Image / Fixed' => 'img_fixed',
            'Hosted Video' => 'hvideo'
        ),
        'group' => 'Design options',
        'description' => __("Select the kind of background would you like to set for this row.", THEMENAME)
    ));
    vc_add_param('vc_row', array(
        'type' => 'textfield',
        'heading' => __("Parallax Speed", THEMENAME),
        'param_name' => 'bd_p_speed',
        'group' => 'Design options',
        "dependency" => array(
            "element" => "bg_style",
            "value" => array(
                "img_parallax"
            )
        ),
        'description' => __("Set speed moving for parallax default 0.1 .", THEMENAME)
    ));
    vc_add_param('vc_row', array(
        'type' => 'textfield',
        'heading' => __("MP4 (URL)", THEMENAME),
        'param_name' => 'bg_video_mp4',
        'group' => 'Design options',
        "dependency" => array(
            "element" => "bg_style",
            "value" => array(
                "hvideo"
            )
        ),
        'description' => __(".mp4 video.", THEMENAME)
    ));
    vc_add_param('vc_row', array(
        'type' => 'textfield',
        'heading' => __("WEBM (URL)", THEMENAME),
        'param_name' => 'bg_video_webm',
        'group' => 'Design options',
        "dependency" => array(
            "element" => "bg_style",
            "value" => array(
                "hvideo"
            )
        ),
        'description' => __(".webm video.", THEMENAME)
    ));
}