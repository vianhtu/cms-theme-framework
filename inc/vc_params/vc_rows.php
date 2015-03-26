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
        'heading' => __("Content Boxed", THEMENAME),
        'param_name' => 'full_width',
        'value' => array('Yes'=> true),
        'description' => __("Yes = content boxed, default content full width.", THEMENAME)
    ));
}