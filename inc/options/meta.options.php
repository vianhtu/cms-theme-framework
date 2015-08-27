<?php
/**
 * Meta options
 * 
 * @author Fox
 * @since 1.0.0
 */
class CMSMetaOptions
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
    }
    /* add script */
    function admin_script_loader()
    {
        global $pagenow;
        if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
            wp_enqueue_style('metabox', get_template_directory_uri() . '/inc/options/css/metabox.css');
            
            wp_enqueue_script('easytabs', get_template_directory_uri() . '/inc/options/js/jquery.easytabs.min.js');
            wp_enqueue_script('metabox', get_template_directory_uri() . '/inc/options/js/metabox.js');
        }
    }
    /* add meta boxs */
    public function add_meta_boxes()
    {
        $this->add_meta_box('template_page_options', __('Setting', 'cms-theme-framework'), 'page');
    }
    
    public function add_meta_box($id, $label, $post_type, $context = 'advanced', $priority = 'default')
    {
        add_meta_box('_cms_' . $id, $label, array($this, $id), $post_type, $context, $priority);
    }
    /* --------------------- PAGE ---------------------- */
    function template_page_options() {
        ?>
        <div class="tab-container clearfix">
	        <ul class='etabs clearfix'>
	           <li class="tab"><a href="#tabs-general"><i class="fa fa-server"></i><?php _e('General', 'cms-theme-framework'); ?></a></li>
	           <li class="tab"><a href="#tabs-header"><i class="fa fa-diamond"></i><?php _e('Header', 'cms-theme-framework'); ?></a></li>
	           <li class="tab"><a href="#tabs-page-title"><i class="fa fa-connectdevelop"></i><?php _e('Page Title', 'cms-theme-framework'); ?></a></li>
	        </ul>
	        <div class='panel-container'>
                <div id="tabs-general">
                <?php
                cms_options(array(
                    'id' => 'full_width',
                    'label' => __('Full Width','cms-theme-framework'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                ));
                ?>
                </div>
                <div id="tabs-header">
                <?php
                /* header. */
                cms_options(array(
                    'id' => 'header',
                    'label' => __('Custom','cms-theme-framework'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_enable'))
                ));
                ?>  <div id="page_header_enable"><?php
                cms_options(array(
                    'id' => 'header_layout',
                    'label' => __('Layout','cms-theme-framework'),
                    'type' => 'imegesselect',
                    'options' => array(
                        '' => get_template_directory_uri().'/inc/options/images/header/h-default.png'
                    )
                ));
                cms_options(array(
                    'id' => 'enable_header_fixed',
                    'label' => __('Header Fixed','cms-theme-framework'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_header_fixed_enable'))
                ));
                ?> <div id="page_header_fixed_enable"><?php
                cms_options(array(
                    'id' => 'header_fixed_bg_color',
                    'label' => __('Background Color','cms-theme-framework'),
                    'type' => 'color',
                    'default' => '#fff',
                    'rgba' => true
                ));
                cms_options(array(
                    'id' => 'header_fixed_menu_color',
                    'label' => __('Menu Color - First Level','cms-theme-framework'),
                    'type' => 'color',
                    'default' => ''
                ));
                cms_options(array(
                    'id' => 'header_fixed_menu_color_hover',
                    'label' => __('Menu Color - First Level','cms-theme-framework'),
                    'type' => 'color',
                    'default' => ''
                ));
                cms_options(array(
                    'id' => 'header_fixed_menu_color_active',
                    'label' => __('Menu Active - First Level','cms-theme-framework'),
                    'type' => 'color',
                    'default' => ''
                ));
                ?> </div><?php
                $menus = array();
                $menus[''] = 'Default';
                $obj_menus = wp_get_nav_menus();
                foreach ($obj_menus as $obj_menu){
                    $menus[$obj_menu->term_id] = $obj_menu->name;
                }
                $navs = get_registered_nav_menus();
                foreach ($navs as $key => $mav){
                    cms_options(array(
                    'id' => $key,
                    'label' => $mav,
                    'type' => 'select',
                    'options' => $menus
                    ));
                }
                ?>
                </div>
                </div>
                <div id="tabs-page-title">
                <?php
                /* page title. */
                cms_options(array(
                    'id' => 'page_title',
                    'label' => __('Custom','cms-theme-framework'),
                    'type' => 'switch',
                    'options' => array('on'=>'1','off'=>''),
                    'follow' => array('1'=>array('#page_title_enable'))
                ));
                ?>  <div id="page_title_enable"><?php
                cms_options(array(
                    'id' => 'page_title_text',
                    'label' => __('Title','cms-theme-framework'),
                    'type' => 'text',
                ));
                cms_options(array(
                    'id' => 'page_title_sub_text',
                    'label' => __('Sub Title','cms-theme-framework'),
                    'type' => 'text',
                ));
                cms_options(array(
                    'id' => 'page_title_margin',
                    'label' => __('Page Title Margin','cms-theme-framework'),
                    'type' => 'text',
                ));
                cms_options(array(
                    'id' => 'page_title_type',
                    'label' => __('Layout','cms-theme-framework'),
                    'type' => 'imegesselect',
                    'options' => array(
                        '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
                        '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
                        '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
                        '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
                        '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
                        '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
                        '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
                    )
                ));
                ?>
                </div>
                </div>
            </div>
        </div>
        <?php
    }
}

new CMSMetaOptions();