<?php

/**
 * Auto create css from Meta Options.
 * 
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_DynamicCss
{

    function __construct()
    {
        add_action('wp_head', array($this, 'generate_css'));
    }

    /**
     * generate css inline.
     *
     * @since 1.0.0
     */
    public function generate_css()
    {
        global $smof_data, $cms_base;
        $css = $this->css_render();
        if (! $smof_data['dev_mode']) {
            $css = $cms_base->compressCss($css);
        }
        echo '<style type="text/css" data-type="cms_shortcodes-custom-css">'.$css.'</style>';
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $smof_data, $cms_base;
        ob_start();
        ?>
        #header-logo a img{
            height:<?php echo esc_attr($smof_data['main_logo_height']); ?>;
        }
        <?php
        return ob_get_clean();
    }
}

new CMSSuperHeroes_DynamicCss();