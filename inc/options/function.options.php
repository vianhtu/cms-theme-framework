<?php
global $theme_framework_base;
/**
 * Home Options
 * 
 * @author Fox
 */
/* Start Dummy Data*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$msg = $disabled = '';
if (!class_exists('WPBakeryVisualComposerAbstract') or !class_exists('CmssuperheroesCore') or !function_exists('cptui_create_custom_post_types')){
    $disabled = ' disabled ';
    $msg='You should be install visual composer, Cmssuperheroes and Custom Post Type UI plugins to import data.';
}
$this->sections[] = array(
    'icon' => 'el-icon-briefcase',
    'title' => __('Demo Content', 'cms-theme-framework'),
    'fields' => array(
        array(
            'subtitle' => '<input type=\'button\' name=\'sample\' id=\'dummy-data\' '.$disabled.' value=\'Import Now\' /><div class=\'cms-dummy-process\'><div  class=\'cms-dummy-process-bar\'></div></div><div id=\'cms-msg\'><span class="cms-status"></span>'.$msg.'</div>',
            'id' => 'theme',
            'icon' => true,
            'default' => 'cmstheme',
            'options' => array(
                'cmstheme' => get_template_directory_uri().'/assets/images/dummy/cmstheme.png'
            ),
            'type' => 'image_select',
            'title' => 'Select Theme'
        )
    )
);
/* End Dummy Data*/

/**
 * 
 */
$this->sections[] = array(
    'title' => __('Favicon Icon', 'cms-theme-framework'),
    'icon' => 'el-icon-star',
    'fields' => array(
        array(
            'title' => __('Icon', 'cms-theme-framework'),
            'subtitle' => __('Select a favicon icon (.png, .jpg).', 'cms-theme-framework'),
            'id' => 'favicon_icon',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/favicon.png'
            )
        ),
    )
);

/**
 * Header Options
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Header', 'cms-theme-framework'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'title' => __('Layouts', 'cms-theme-framework'),
            'subtitle' => __('select a layout for header', 'cms-theme-framework'),
            'default' => '',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/header/h-default.png'
            )
        ),
        array(
            'subtitle' => __('in pixels.', 'cms-theme-framework'),
            'id' => 'header_height',
            'type' => 'text',
            'title' => 'Header Height',
            'default' => '186px'
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'header_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'header_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        ),
        array(
            'subtitle' => __('enable sticky mode for menu.', 'cms-theme-framework'),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => __('Sticky Header', 'cms-theme-framework'),
            'default' => false,
        ),
         array(
            'subtitle' => __('in pixels.', 'cms-theme-framework'),
            'id' => 'menu_sticky_height',
            'type' => 'text',
            'title' => 'Sticky Header Height',
            'default' => '80px',
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Tablets.', 'cms-theme-framework'),
            'id' => 'menu_sticky_tablets',
            'type' => 'switch',
            'title' => __('Sticky Tablets', 'cms-theme-framework'),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Mobile.', 'cms-theme-framework'),
            'id' => 'menu_sticky_mobile',
            'type' => 'switch',
            'title' => __('Sticky Mobile', 'cms-theme-framework'),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/* Header Top */

$this->sections[] = array(
    'title' => __('Header Top', 'cms-theme-framework'),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable header top.', 'cms-theme-framework'),
            'id' => 'enable_header_top',
            'type' => 'switch',
            'title' => __('Enable Header Top', 'cms-theme-framework'),
            'default' => false,
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'header_top_margin',
            'type' => 'text',
            'title' => 'Header Top Margin',
            'default' => '',
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'header_top_padding',
            'type' => 'text',
            'title' => 'Header Top Padding',
            'default' => '',
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        )
    )
);

/* Logo */
$this->sections[] = array(
    'title' => __('Logo', 'cms-theme-framework'),
    'icon' => 'el-icon-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => __('Select Logo', 'cms-theme-framework'),
            'subtitle' => __('Select an image file for your logo.', 'cms-theme-framework'),
            'id' => 'main_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            )
        ),
        array(
            'subtitle' => __('in pixels.', 'cms-theme-framework'),
            'id' => 'main_logo_height',
            'type' => 'text',
            'title' => 'Logo Height',
            'default' => '129px'
        ),
        array(
            'subtitle' => __('in pixels.', 'cms-theme-framework'),
            'id' => 'sticky_logo_height',
            'type' => 'text',
            'title' => 'Sticky Logo Height',
            'default' => '60px'
        )
    )
);

/**
 * Page Title
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Page Title & BC', 'cms-theme-framework'),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id' => 'page_title_layout',
            'title' => __('Layouts', 'cms-theme-framework'),
            'subtitle' => __('select a layout for page title', 'cms-theme-framework'),
            'default' => '5',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
                '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
                '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
                '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
                '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
                '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
                '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
            )
        ),
        array(
            'id'       => 'page_title_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'cms-theme-framework' ),
            'subtitle' => __( 'page title background with image, color, etc.', 'cms-theme-framework' ),
            'output'   => array('.page-title')
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'page_title_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => '0 0 70px'
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'page_title_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => '50px 0'
        )
    )
);
/* Page Title */
$this->sections[] = array(
    'icon' => 'el-icon-podcast',
    'title' => __('Page Title', 'cms-theme-framework'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'page_title_typography',
            'type' => 'typography',
            'title' => __('Typography', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text h1'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', 'cms-theme-framework')
        ),
    )
);
/* Breadcrumb */
$this->sections[] = array(
    'icon' => 'el-icon-random',
    'title' => __('Breadcrumb', 'cms-theme-framework'),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('The text before the breadcrumb home.', 'cms-theme-framework'),
            'id' => 'breacrumb_home_prefix',
            'type' => 'text',
            'title' => __('Breadcrumb Home Prefix', 'cms-theme-framework'),
            'default' => 'Home'
        ),
        array(
            'id' => 'breacrumb_typography',
            'type' => 'typography',
            'title' => __('Typography', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #breadcrumb-text','.page-title #breadcrumb-text ul li a'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', 'cms-theme-framework'),
            'default' => array(
                'color' => '',
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
    'title' => __('Body', 'cms-theme-framework'),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'subtitle' => __('Set layout boxed default(Wide).', 'cms-theme-framework'),
            'id' => 'body_layout',
            'type' => 'switch',
            'title' => __('Boxed Layout', 'cms-theme-framework'),
            'default' => false,
        ),
        array(
            'id'       => 'body_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'cms-theme-framework' ),
            'subtitle' => __( 'body background with image, color, etc.', 'cms-theme-framework' ),
            'output'   => array('body'),
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'body_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'body_padding',
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
    'title' => __('Content', 'cms-theme-framework'),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'container_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'cms-theme-framework' ),
            'subtitle' => __( 'Container background with image, color, etc.', 'cms-theme-framework' ),
            'output'   => array('#main'),
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'container_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => '0 0 80px'
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'container_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        )
    )
);

/**
 * Page Loadding
 * 
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Page Loadding', 'cms-theme-framework'),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable page loadding.', 'cms-theme-framework'),
            'id' => 'enable_page_loadding',
            'type' => 'switch',
            'title' => __('Enable Page Loadding', 'cms-theme-framework'),
            'default' => false,
        ),
        array(
            'subtitle' => 'Select Style Page Loadding.',
            'id' => 'page_loadding_style',
            'type' => 'select',
            'options' => array(
                '1' => 'Style 1',
                '2' => 'Style 2'
            ),
            'title' => 'Page Loadding Style',
            'default' => 'style-1',
            'required' => array( 0 => 'enable_page_loadding', 1 => '=', 2 => 1 )
        )     
    )
);

/**
 * Footer
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Footer', 'cms-theme-framework'),
    'icon' => 'el-icon-credit-card',
);

/* Footer top */
$this->sections[] = array(
    'title' => __('Footer Top', 'cms-theme-framework'),
    'icon' => 'el-icon-fork',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable footer top.', 'cms-theme-framework'),
            'id' => 'enable_footer_top',
            'type' => 'switch',
            'title' => __('Enable Footer Top', 'cms-theme-framework'),
            'default' => true,
        ),
        array(
            'id'       => 'footer_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'cms-theme-framework' ),
            'subtitle' => __( 'footer background with image, color, etc.', 'cms-theme-framework' ),
            'output'   => array('footer #cshero-footer-top'),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'footer_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => '',
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'footer_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => '65px 0',
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        )
    )
);

/* footer botton */
$this->sections[] = array(
    'title' => __('Footer Botton', 'cms-theme-framework'),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable footer bottom.', 'cms-theme-framework'),
            'id' => 'enable_footer_bottom',
            'type' => 'switch',
            'title' => __('Enable Footer Botton', 'cms-theme-framework'),
            'default' => false,
        ),
        array(
            'id'       => 'footer_botton_background',
            'type'     => 'background',
            'title'    => __( 'Background', 'cms-theme-framework' ),
            'subtitle' => __( 'background with image, color, etc.', 'cms-theme-framework' ),
            'output'   => array('footer #cshero-footer-bottom'),
            'default'   => array(),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'footer_botton_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => '',
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', 'cms-theme-framework'),
            'id' => 'footer_botton_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => '',
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable button back to top.', 'cms-theme-framework'),
            'id' => 'footer_botton_back_to_top',
            'type' => 'switch',
            'title' => __('Back To Top', 'cms-theme-framework'),
            'default' => true,
        )
    )
);

/**
 * Styling
 * 
 * css color.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Styling', 'cms-theme-framework'),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => __('set color main color.', 'cms-theme-framework'),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => __('Primary Color', 'cms-theme-framework'),
            'default' => '#6e4692'
        ),
        array(
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => __('Secondary Color', 'cms-theme-framework'),
            'default' => '#ffdd00'
        ),
        array(
            'subtitle' => __('set color for tags <a></a>.', 'cms-theme-framework'),
            'id' => 'link_color',
            'type' => 'color',
            'title' => __('Link Color', 'cms-theme-framework'),
            'output'  => array('a'),
            'default' => '#6f4792'
        ),
        array(
            'subtitle' => __('set color for tags <a></a>.', 'cms-theme-framework'),
            'id' => 'link_color_hover',
            'type' => 'color',
            'title' => __('Link Color Hover', 'cms-theme-framework'),
            'output'  => array('a:hover'),
            'default' => '#9c9c9c'
        )
    )
);

/**
 * Typography
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Typography', 'cms-theme-framework'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => __('Body Font', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'cms-theme-framework'),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-weight' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => __('H1', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h1'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => __('H2', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h2'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => __('H3', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h3'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => __('H4', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h4'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => __('H5', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h5'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => __('H6', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h6'),
            'units' => 'px',
        )
    )
);

/* extra font. */
$this->sections[] = array(
    'title' => __('Extra Fonts', 'cms-theme-framework'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => __('Font 1', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => __('Selector 1', 'cms-theme-framework'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', 'cms-theme-framework'),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'google-font-2',
            'type' => 'typography',
            'title' => __('Font 2', 'cms-theme-framework'),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
        ),
        array(
            'id' => 'google-font-selector-2',
            'type' => 'textarea',
            'title' => __('Selector 2', 'cms-theme-framework'),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', 'cms-theme-framework'),
            'validate' => 'no_html',
            'default' => '',
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
    'title' => __('Custom CSS', 'cms-theme-framework'),
    'icon' => 'el-icon-bulb',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => __('CSS Code', 'cms-theme-framework'),
            'subtitle' => __('create your css code here.', 'cms-theme-framework'),
            'mode' => 'css',
            'theme' => 'monokai',
        )
    )
);
/**
 * Animations
 *
 * Animations options for theme. libs css, js.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Animations', 'cms-theme-framework'),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'subtitle' => __('Enable animation mouse scroll...', 'cms-theme-framework'),
            'id' => 'smoothscroll',
            'type' => 'switch',
            'title' => __('Smooth Scroll', 'cms-theme-framework'),
            'default' => false
        ),
    )
);
/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Optimal Core', 'cms-theme-framework'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => __('no minimize , generate css over time...', 'cms-theme-framework'),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => __('Dev Mode (not recommended)', 'cms-theme-framework'),
            'default' => false
        )
    )
);