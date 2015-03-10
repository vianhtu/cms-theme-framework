<?php
/**
 * Home Options
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Main Options', THEMENAME),
    'icon' => 'el-icon-dashboard',
    'fields' => array(
        array(
            'id' => 'intro_product',
            'type' => 'intro_product',
        )
    )
);

/**
 * Header Options
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Header', THEMENAME),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id'       => 'header_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'header background with image, color, etc.', THEMENAME ),
            'output'   => array('#masthead')
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'header_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'header_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        )
    )
);

/**
 * Page Title
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Page Title & BC', THEMENAME),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id' => 'page_title_layout',
            'title' => __('Layouts', THEMENAME),
            'subtitle' => __('select a layout for page title', THEMENAME),
            'default' => '1',
            'type' => 'image_select',
            'options' => array(
                '' => '',
                '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.jpg',
                '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.jpg',
                '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.jpg',
                '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.jpg',
                '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.jpg',
                '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.jpg',
            )
        ),
        array(
            'id'       => 'page_title_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'page title background with image, color, etc.', THEMENAME ),
            'output'   => array('.page-title'),
            'default'   => array(
                'background-color'=>'',
                'background-image'=>'',
                'background-repeat'=>'',
                'background-size'=>'',
                'background-attachment'=>'',
                'background-position'=>''
            )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'page_title_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'page_title_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        )
    )
);
/* Page Title */
$this->sections[] = array(
    'icon' => 'el-icon-podcast',
    'title' => __('Page Title', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'page_title_typography',
            'type' => 'typography',
            'title' => __('Typography', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text h1'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', THEMENAME),
            'default' => array(
                'color' => '#ffffff',
            )
        ),
    )
);
/* Breadcrumb */
$this->sections[] = array(
    'icon' => 'el-icon-random',
    'title' => __('Breadcrumb', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('The text before the breadcrumb home.', THEMENAME),
            'id' => 'breacrumb_home_prefix',
            'type' => 'text',
            'title' => __('Breadcrumb Home Prefix', THEMENAME),
            'default' => 'You are here:  Home'
        ),
        array(
            'id' => 'breacrumb_typography',
            'type' => 'typography',
            'title' => __('Typography', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #breadcrumb-text'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', THEMENAME),
            'default' => array(
                'color' => '#ffffff',
            )
        ),
    )
);

/**
 * Body
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Body', THEMENAME),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'id'       => 'body_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'body background with image, color, etc.', THEMENAME ),
            'output'   => array('body'),
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'body_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'body_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        )
    )
);

/* Container */
$this->sections[] = array(
    'title' => __('Container', THEMENAME),
    'icon' => 'el-icon-pencil',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'container_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'Container background with image, color, etc.', THEMENAME ),
            'output'   => array('#main'),
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'container_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'container_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        )
    )
);

/**
 * Content
 * 
 * Archive, Pages, Single, 404, Search, Category, Tags .... 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Content', THEMENAME),
    'icon' => 'el-icon-compass',
    'fields' => array(
        
    )
);

/* Archive */
$this->sections[] = array(
    'title' => __('Archive', THEMENAME),
    'icon' => 'el-icon-folder',
    'subsection' => true,
    'fields' => array(
    )
);

/* Pages */
$this->sections[] = array(
    'title' => __('Pages', THEMENAME),
    'icon' => 'el-icon-file',
    'subsection' => true,
    'fields' => array(
    )
);

/* Single */
$this->sections[] = array(
    'title' => __('Single', THEMENAME),
    'icon' => 'el-icon-pencil-alt',
    'subsection' => true,
    'fields' => array(
    )
);

/**
 * Footer
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Footer', THEMENAME),
    'icon' => 'el-icon-fork',
    'fields' => array(
        array(
            'id'       => 'footer_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'footer background with image, color, etc.', THEMENAME ),
            'output'   => array('footer'),
            'default'   => array()
        ),
        array(
            'subtitle' => 'Remove class .container.',
            'id' => 'footer_full_width',
            'type' => 'switch',
            'title' => 'Full Width',
            'default' => true
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'footer_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'footer_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        )
    )
);

/* Footer layout */
$this->sections[] = array(
    'icon' => 'el-icon-th-large',
    'title' => __('Layout', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Remove class .container.',
            'id' => 'footer_layout_full_width',
            'type' => 'switch',
            'title' => 'Full Width',
            'default' => false
        ),
    )
);
/**
 * Custom CSS
 * 
 * extra css for customer.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Custom CSS', THEMENAME),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => __('CSS Code', THEMENAME),
            'subtitle' => __('create your css code here.', THEMENAME),
            'mode' => 'css',
            'theme' => 'monokai',
        )
    )
);
/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Optimal Core', THEMENAME),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => __('no minimize , generate css over time...', THEMENAME),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => __('Dev Mode (not recommended)', THEMENAME),
            'default' => false
        )
    )
);