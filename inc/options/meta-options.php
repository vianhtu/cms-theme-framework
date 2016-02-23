<?php
/**
 * Meta box config file
 */
if (! class_exists('MetaFramework')) {
    return;
}

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => apply_filters('opt_meta', 'opt_meta'),
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Allow you to start the panel in an expanded way initially.
    'open_expanded' => false,
    // Disable the save warning when a user changes a field
    'disable_save_warn' => true,
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => false,

    'output' => false,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => false
);

// -> Set Option To Panel.
MetaFramework::setArgs($args);

/** page options */
MetaFramework::setMetabox(array(
    'id' => '_page_main_options',
    'label' => esc_html__('Page Setting', 'cms-theme-framework'),
    'post_type' => 'page',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => false,
    'sections' => array(
        array(
            'title' => __('Color', 'cms-theme-framework'),
            'id' => 'color-Color',
            'icon' => 'el el-laptop',
            'fields' => array(
                array(
                    'id' => 'opt-title-text',
                    'type' => 'media',
                    'title' => __('Site Title Color', 'cms-theme-framework'),
                    'subtitle' => __('Pick a title color for the theme (default: #000).', 'cms-theme-framework'),
                )
            )
        ),
        array(
            'title' => __('Sorter', 'cms-theme-framework'),
            'id' => 'additional-sorter',
            'fields' => array(
            )
        ),
        array(
            'title' => __('Sorter', 'cms-theme-framework'),
            'id' => 'additional-sorter-2',
            'fields' => array(
            )
        )
    )
));

/** post options */
MetaFramework::setMetabox(array(
    'id' => '_page_post_format_options',
    'label' => esc_html__('Post Format', 'cms-theme-framework'),
    'post_type' => 'post',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'color-Color',
            'icon' => 'el el-laptop',
            'fields' => array(
                array(
                    'id'       => 'opt-video-type',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Select Video Type', 'cms-theme-framework' ),
                    'subtitle' => esc_html__( 'Local video, Youtube, Vimeo', 'cms-theme-framework' ),
                    'options'  => array(
                        'local' => esc_html__('Upload', 'cms-theme-framework' ),
                        'youtube' => esc_html__('Youtube', 'cms-theme-framework' ),
                        'vimeo' => esc_html__('Vimeo', 'cms-theme-framework' ),
                    )
                ),
                array(
                    'id'       => 'otp-video-local',
                    'type'     => 'media',
                    'url'      => true,
                    'mode'       => false,
                    'title'    => esc_html__( 'Local Video', 'cms-theme-framework' ),
                    'subtitle' => esc_html__( 'Upload video media using the WordPress native uploader', 'cms-theme-framework' ),
                    'required' => array( 'opt-video-type', '=', 'local' )
                ),
                array(
                    'id'       => 'opt-video-youtube',
                    'type'     => 'text',
                    'title'    => esc_html__('Youtube', 'cms-theme-framework'),
                    'subtitle' => esc_html__('Load video from Youtube.', 'cms-theme-framework'),
                    'placeholder' => esc_html__('https://youtu.be/iNJdPyoqt8U', 'cms-theme-framework'),
                    'required' => array( 'opt-video-type', '=', 'youtube' )
                ),
                array(
                    'id'       => 'opt-video-vimeo',
                    'type'     => 'text',
                    'title'    => esc_html__('Vimeo', 'cms-theme-framework'),
                    'subtitle' => esc_html__('Load video from Vimeo.', 'cms-theme-framework'),
                    'placeholder' => esc_html__('https://vimeo.com/155673893', 'cms-theme-framework'),
                    'required' => array( 'opt-video-type', '=', 'vimeo' )
                ),
                array(
                    'id'       => 'otp-video-thumb',
                    'type'     => 'media',
                    'url'      => true,
                    'mode'       => false,
                    'title'    => esc_html__( 'Video Thumb', 'cms-theme-framework' ),
                    'subtitle' => esc_html__( 'Upload thumb media using the WordPress native uploader', 'cms-theme-framework' ),
                    'required' => array( 'opt-video-type', '=', 'local' )
                ),
                array(
                    'id'       => 'otp-audio',
                    'type'     => 'media',
                    'url'      => true,
                    'mode'       => false,
                    'title'    => esc_html__( 'Audio Media', 'cms-theme-framework' ),
                    'subtitle' => esc_html__( 'Upload audio media using the WordPress native uploader', 'cms-theme-framework' ),
                ),
                array(
                    'id'       => 'opt-gallery',
                    'type'     => 'gallery',
                    'title'    => esc_html__( 'Add/Edit Gallery', 'cms-theme-framework' ),
                    'subtitle' => esc_html__( 'Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'cms-theme-framework' ),
                ),
                array(
                    'id'       => 'opt-quote-title',
                    'type'     => 'text',
                    'title'    => esc_html__('Quote Title', 'cms-theme-framework'),
                    'subtitle' => esc_html__('Quote title or quote name...', 'cms-theme-framework'),
                ),
                array(
                    'id'       => 'opt-quote-content',
                    'type'     => 'textarea',
                    'title'    => esc_html__('Quote Content', 'cms-theme-framework'),
                ),
            )
        ),
    )
));

MetaFramework::init();