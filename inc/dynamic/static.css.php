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
        return $this->scss->compile('@import "buttons.scss"; @import "content.scss"; @import "elements.scss"; @import "footer.scss"; @import "forms.scss"; @import "header.scss"; @import "main.scss"; @import "media.scss"; @import "mixins.scss"; @import "navigation.scss"; @import "sidebar.scss"; @import "typography.scss"; @import "widgets.scss"');
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
        ?>
        <?php
        /* boxed layout active. */
        if($smof_data['body_layout']){
            echo "body .cs-boxed{width:".$smof_data['body_width']."}";
        }
        ?>
        <?php
        return ob_get_clean();
    }
}

new CMSSuperHeroes_StaticCss();