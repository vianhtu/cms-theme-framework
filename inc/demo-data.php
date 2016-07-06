<?php
/**
 * demo data.
 *
 * config.
 */
add_filter('ef3-theme-options-opt-name', 'et3_theme_framework_set_demo_opt_name');

function et3_theme_framework_set_demo_opt_name(){
    return 'opt_theme_options';
}

add_filter('ef3-replace-content', 'et3_theme_framework_replace_content', 10 , 2);

function et3_theme_framework_replace_content($replaces, $attachment){
    return array(
        //'/image="(.+?)"/' => 'image="'.$attachment.'"',
        '/tax_query:/' => 'remove_query:',
        '/categories:/' => 'remove_query:',
        //'/src="(.+?)"/' => 'src="'.ef3_import_export()->acess_url.'ef3-placeholder-image.jpg"'
    );
}

add_filter('ef3-replace-theme-options', 'et3_theme_framework_replace_theme_options');

function et3_theme_framework_replace_theme_options(){
    return array(
        'dev_mode' => 0,
    );
}
add_filter('ef3-enable-create-demo', 'et3_theme_framework_enable_create_demo');

function et3_theme_framework_enable_create_demo(){
    return true;
}