<?php

/**
 * Auto create .css file from Theme Options
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_StaticCss
{

    public $scss;
    
    function __construct()
    {
        global $smof_data;
        
        /* scss */
        $this->scss = new scssc();
        
        /* set paths scss */
        $this->scss->setImportPaths(get_template_directory() . '/assets/scss/');
             
        /* generate css over time */
        if ($smof_data['dev_mode']) {
            $this->generate_file();
        } else {
            /* save option generate css */
            add_action("redux/options/smof_data/saved", array(
                $this,
                'generate_file'
            ));
        }
    }

    /**
     * generate css file.
     *
     * @since 1.0.0
     */
    public function generate_file()
    {
        global $smof_data;
        if (! empty($smof_data)) {
            /* get css string */
            $css = $this->css_render();
            
            /* minimize CSS styles */
            if (!$smof_data['dev_mode']) {
                $css = CMSSuperHeroes_Base::compressCss($css);
                
                /* set compressed css */
                $this->scss->setFormatter('scss_formatter_compressed');
            }
            
            /* compile scss to css */
            $css .= $this->scss_render();
            
            /* write static.css file */
            file_put_contents(get_template_directory() . '/assets/css/' . 'static.css', $css, LOCK_EX); // Save it
        }
    }
    
    /**
     * scss compile
     * 
     * @since 1.0.0
     * @return string
     */
    public function scss_render(){
        /* compile scss to css */
        return $this->scss->compile('@import "mixins.scss"; @import "buttons.scss"; @import "content.scss"; @import "elements.scss"; @import "footer.scss"; @import "forms.scss"; @import "header.scss"; @import "main.scss"; @import "media.scss"; @import "navigation.scss"; @import "sidebar.scss"; @import "typography.scss"; @import "widgets.scss"; @import "responsive.scss"');
    }
    
    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $smof_data;
        ob_start();
        ?>
        @CHARSET "ISO-8859-1";
        <?php
        /* custom css. */ 
        echo esc_attr($smof_data['custom_css']); 
        
        /* body margin & padding. */
        if($smof_data['body_padding'] || $smof_data['body_margin']){
            echo "body #page{margin:".esc_attr($smof_data['body_margin']).";padding:".esc_attr($smof_data['body_padding']).";}";
        }
        /* header margin & padding */
        if($smof_data['header_padding'] || $smof_data['header_margin']){
            echo "body #masthead{margin:".esc_attr($smof_data['header_margin']).";padding:".esc_attr($smof_data['header_padding']).";}";
        }
        
        /* page title margin & padding */
        if($smof_data['page_title_padding'] || $smof_data['page_title_margin']){
            echo "body .page-title{margin:".esc_attr($smof_data['page_title_margin']).";padding:".esc_attr($smof_data['page_title_padding']).";}";
        }
        
        /* main margin & padding */
        if($smof_data['container_padding'] || $smof_data['container_margin']){
            echo "body #main{margin:".esc_attr($smof_data['container_padding']).";padding:".esc_attr($smof_data['container_margin']).";}";
        }
        
        /* footer top margin & padding. */
        if($smof_data['footer_margin'] || $smof_data['footer_padding']){
            echo "footer #footer-top{margin:".esc_attr($smof_data['footer_margin']).";padding:".esc_attr($smof_data['footer_padding']).";}";
        }
        
        /* footer botton margin & padding. */
        if($smof_data['footer_botton_margin'] || $smof_data['footer_botton_padding']){
            echo "footer #footer-bottom{margin:".esc_attr($smof_data['footer_botton_margin']).";padding:".esc_attr($smof_data['footer_botton_padding']).";}";
        }
        return ob_get_clean();
    }
}

new CMSSuperHeroes_StaticCss();