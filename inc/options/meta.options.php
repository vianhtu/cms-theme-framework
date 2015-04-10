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
        $this->add_meta_box('template_page_options', __('Setting', THEMENAME), 'page');
    }
    
    public function add_meta_box($id, $label, $post_type, $context = 'advanced', $priority = 'default')
    {
        add_meta_box('_cms_' . $id, $label, array($this, $id), $post_type, $context, $priority);
    }
    /* --------------------- PAGE ---------------------- */
    function template_page_options() {
        ?>
	    <div class="tab-container clearfix">
	        <ul class='etabs'>
	           <li class="tab"><a href="#tabs-general"><?php _e('General', THEMENAME); ?></a></li>
	           <li class="tab"><a href="#tabs-header"><?php _e('Header', THEMENAME); ?></a></li>
	           <li class="tab"><a href="#tabs-page-title"><?php _e('Page Title', THEMENAME); ?></a></li>
	        </ul>
            <div id="tabs-general">
            <?php
            cms_options(array(
                'id' => 'full_width',
                'label' => __('Full Width',THEMENAME),
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
                'label' => __('Header',THEMENAME),
                'type' => 'switch',
                'options' => array('on'=>'1','off'=>''),
                'follow' => array('1'=>array('#page_header_enable'))
            ));
            ?>  <div id="page_header_enable"><?php
                cms_options(array(
                    'id' => 'header_layout',
                    'label' => __('Layout',THEMENAME),
                    'type' => 'imegesselect',
                    'options' => array(
                        '' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
                        '1' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
                        '2' => get_template_directory_uri().'/inc/options/images/header/h-default.png',
                    )
                ));
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
                'label' => __('Page Title',THEMENAME),
                'type' => 'switch',
                'options' => array('on'=>'1','off'=>''),
                'follow' => array('1'=>array('#page_title_enable'))
            ));
            ?>  <div id="page_title_enable"><?php
                cms_options(array(
                    'id' => 'page_title_text',
                    'label' => __('Title',THEMENAME),
                    'type' => 'text',
                ));
                cms_options(array(
                    'id' => 'page_title_sub_text',
                    'label' => __('Sub Title',THEMENAME),
                    'type' => 'text',
                ));
                cms_options(array(
                    'id' => 'page_title_type',
                    'label' => __('Layout',THEMENAME),
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
        <?php
    }
}

new CMSMetaOptions();