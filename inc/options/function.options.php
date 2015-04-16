<?php
global $cms_base;
/* get local fonts. */
$local_fonts = is_admin() ? $cms_base->getListLocalFonts() : array() ;

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
/* Start Dummy Data*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$msg = $disabled = '';
if (!class_exists('WPBakeryVisualComposerAbstract') or !class_exists('CmssuperheroesCore')){
    $disabled = ' disabled ';
    $msg='You should be install visual composer and Cmssuperheroes plugins to import';
}
$this->sections[] = array(
    'icon' => 'el-icon-briefcase',
    'title' => __('Demo Content', THEMENAME),
    'subsection' => true,
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
 * Header Options
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Header', THEMENAME),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'title' => __('Layouts', THEMENAME),
            'subtitle' => __('select a layout for header', THEMENAME),
            'default' => '',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
                '1' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
                '2' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
            )
        ),
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
        ),
        array(
            'subtitle' => __('Enable menu sticky.', THEMENAME),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => __('Menu Sticky', THEMENAME),
            'default' => false,
        )
    )
);

/* Logo */
$this->sections[] = array(
    'title' => __('Logo', THEMENAME),
    'icon' => 'el-icon-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => __('Logo', THEMENAME),
            'subtitle' => __('Select an image file for your logo.', THEMENAME),
            'id' => 'main_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/cmssuperheroes.png'
            )
        ),
        array(
            'subtitle' => __('in pixels.', THEMENAME),
            'id' => 'main_logo_height',
            'type' => 'text',
            'title' => 'Height',
            'default' => '80px'
        ),
    )
);

/* Menu */
$this->sections[] = array(
    'title' => __('Menu', THEMENAME),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('enable mega menu.', THEMENAME),
            'id' => 'menu_mega',
            'type' => 'switch',
            'title' => __('Mega Menu', THEMENAME),
            'default' => false,
        ),
        array(
            'subtitle' => __('enable sticky mode for menu.', THEMENAME),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => __('Sticky Menu', THEMENAME),
            'default' => false,
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Tablets.', THEMENAME),
            'id' => 'menu_sticky_tablets',
            'type' => 'switch',
            'title' => __('Sticky Tablets', THEMENAME),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Mobile.', THEMENAME),
            'id' => 'menu_sticky_mobile',
            'type' => 'switch',
            'title' => __('Sticky Mobile', THEMENAME),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
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
                'color' => '',
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
            'output'  => array('.page-title #breadcrumb-text','.page-title #breadcrumb-text ul li a'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', THEMENAME),
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
    'title' => __('Body', THEMENAME),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'subtitle' => __('Set layout boxed default(Wide).', THEMENAME),
            'id' => 'body_layout',
            'type' => 'switch',
            'title' => __('Boxed Layout', THEMENAME),
            'default' => false,
        ),
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

/**
 * Content
 * 
 * Archive, Pages, Single, 404, Search, Category, Tags .... 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Content', THEMENAME),
    'icon' => 'el-icon-compass',
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
 * Footer
 *
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Footer', THEMENAME),
    'icon' => 'el-icon-credit-card',
);

/* Footer top */
$this->sections[] = array(
    'title' => __('Top', THEMENAME),
    'icon' => 'el-icon-fork',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'footer_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'footer background with image, color, etc.', THEMENAME ),
            'output'   => array('footer #footer-top'),
            'default'   => array()
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

/* footer bottom */
$this->sections[] = array(
    'title' => __('Bottom', THEMENAME),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'footer_botton_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'background with image, color, etc.', THEMENAME ),
            'output'   => array('footer #footer-bottom'),
            'default'   => array()
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'footer_bottom_margin',
            'type' => 'text',
            'title' => 'Margin',
            'default' => ''
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'footer_bottom_padding',
            'type' => 'text',
            'title' => 'Padding',
            'default' => ''
        ),
        array(
            'subtitle' => __('enable button back to top.', THEMENAME),
            'id' => 'footer_botton_back_to_top',
            'type' => 'switch',
            'title' => __('Back To Top', THEMENAME),
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
    'title' => __('Styling', THEMENAME),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => __('select presets color.', THEMENAME),
            'id' => 'presets_color',
            'type' => 'image_select',
            'title' => __('Presets Color', THEMENAME),
            'default' => '',
            'options' => array(
                '0' => get_template_directory_uri().'/inc/options/images/presets/pr-c-1.png',
                '1' => get_template_directory_uri().'/inc/options/images/presets/pr-c-2.png',
                '2' => get_template_directory_uri().'/inc/options/images/presets/pr-c-3.png',
                '3' => get_template_directory_uri().'/inc/options/images/presets/pr-c-4.png',
                '4' => get_template_directory_uri().'/inc/options/images/presets/pr-c-5.png',
            )
        ),
        array(
            'subtitle' => __('set color main color.', THEMENAME),
            'id' => 'primary_color',
            'type' => 'color_rgba',
            'title' => __('Primary Color', THEMENAME),
            'default' => ''
        ),
        array(
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => __('Secondary Color', THEMENAME),
            'default' => ''
        ),
        array(
            'subtitle' => __('set color for tags <a></a>.', THEMENAME),
            'id' => 'link_color',
            'type' => 'color',
            'title' => __('Link Color', THEMENAME),
            'output'  => array('a'),
            'default' => ''
        )
    )
);

/**
 * Typography
 * 
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Typography', THEMENAME),
    'icon' => 'el-icon-text-width',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => __('Body Font', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', THEMENAME),
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => __('H1', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h1'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => __('H2', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h2'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => __('H3', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h3'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => __('H4', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h4'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => __('H5', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h5'),
            'units' => 'px',
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => __('H6', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h6'),
            'units' => 'px',
        )
    )
);

/* local fonts. */
$this->sections[] = array(
    'title' => __('Local Fonts', THEMENAME),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'local-fonts-1',
            'type'     => 'select',
            'title'    => __( 'Fonts', THEMENAME ),
            'options'  => $local_fonts,
            'default'  => '',
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
    'icon' => 'el-icon-bulb',
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
 * Animations
 *
 * Animations options for theme. libs css, js.
 * @author Fox
 */
$this->sections[] = array(
    'title' => __('Animations', THEMENAME),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'subtitle' => __('Enable animation mouse scroll...', THEMENAME),
            'id' => 'smoothscroll',
            'type' => 'switch',
            'title' => __('Smooth Scroll', THEMENAME),
            'default' => false
        ),
        array(
            'subtitle' => __('Enable animation parallax for images...', THEMENAME),
            'id' => 'paralax',
            'type' => 'switch',
            'title' => __('Images Paralax', THEMENAME),
            'default' => true
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