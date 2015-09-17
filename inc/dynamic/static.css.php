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
        if (isset($smof_data['dev_mode']) && $smof_data['dev_mode']) {
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
        global $smof_data, $wp_filesystem;
        
        if (! empty($smof_data)) {
            
            /* write options to scss file */
            $wp_filesystem->put_contents(get_template_directory() . '/assets/scss/options.scss', $this->css_render(), LOCK_EX); // Save it
            
            /* minimize CSS styles */
            if (!$smof_data['dev_mode']) {
                $this->scss->setFormatter('scss_formatter_compressed');
            }
            
            /* compile scss to css */
            $css = $this->scss_render();
            
            $file = "static.css";
            
            if(!empty($smof_data['presets_color']) && $smof_data['presets_color']){
                $file = "presets-".$smof_data['presets_color'].".css";
            }
            
            /* write static.css file */
            $wp_filesystem->put_contents(get_template_directory() . '/assets/css/' . $file, $css, LOCK_EX); // Save it
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
        return $this->scss->compile('@import "master.scss"');
    }
    
    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $smof_data, $cms_base;
        
        ob_start();
        /* custom css. */
        echo esc_attr($smof_data['custom_css']);
        /* google fonts. */
        if(isset($smof_data['google-font-1'])){
            $cms_base->setGoogleFont($smof_data['google-font-1'], $smof_data['google-font-selector-1']);
        }
        if(isset($smof_data['google-font-2'])){
            $cms_base->setGoogleFont($smof_data['google-font-2'], $smof_data['google-font-selector-2']);
        }
        /* local fonts. */
        if(isset($smof_data['local-fonts-1'])){
            $cms_base->setFontFace($smof_data['local-fonts-1'], $smof_data['local-fonts-selector-1']);
        }
        if(isset($smof_data['local-fonts-2'])){
            $cms_base->setFontFace($smof_data['local-fonts-2'], $smof_data['local-fonts-selector-2']);
        }
        /* forward options to scss. */
        
        if(!empty($smof_data['primary_color'])){
            echo '$primary_color:'.esc_attr($smof_data['primary_color']).';';
        }
        
        return ob_get_clean();
    }
}

new CMSSuperHeroes_StaticCss();