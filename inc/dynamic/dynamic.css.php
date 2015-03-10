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
        global $smof_data;
        $css = $this->css_render();
        if (! $smof_data['dev_mode']) {
            $css = CMSSuperHeroes_Base::compressCss($css);
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
        global $smof_data;
        ob_start();
        /*-------------------------- shortcodes-custom-css -------------------------*/
        CMSSuperHeroes_Base::addShortcodesCustomCss();
        /*-------------------------------- header ------------------------------------ */
        ?>
        #masthead {
           <?php echo !empty($smof_data['header_padding']) ? 'padding :'.esc_attr($smof_data['header_padding']).';' : '' ; ?>
           <?php echo !empty($smof_data['header_margin']) ? 'margin :'.esc_attr($smof_data['header_margin']).';' : '' ; ?> 
        }
        <?php
        
        /*-------------------------------- page title ------------------------------------ */
        ?>
        .page-title {
           <?php echo !empty($smof_data['page_title_padding']) ? 'padding :'.esc_attr($smof_data['page_title_padding']).';' : '' ; ?>
           <?php echo !empty($smof_data['page_title_margin']) ? 'margin :'.esc_attr($smof_data['page_title_margin']).';' : '' ; ?> 
        }
        <?php
        
        /*-------------------------------- body ------------------------------------ */
        ?>
        body {
           <?php echo !empty($smof_data['body_padding']) ? 'padding :'.esc_attr($smof_data['body_padding']).';' : '' ; ?>
           <?php echo !empty($smof_data['body_margin']) ? 'margin :'.esc_attr($smof_data['body_margin']).';' : '' ; ?> 
        }
        <?php
        
        /*-------------------------------- footer ------------------------------------ */
        ?>
        footer {
           <?php echo !empty($smof_data['footer_padding']) ? 'padding :'.esc_attr($smof_data['footer_padding']).';' : '' ; ?>
           <?php echo !empty($smof_data['footer_margin']) ? 'margin :'.esc_attr($smof_data['footer_margin']).';' : '' ; ?> 
        }
        <?php
        return ob_get_clean();
    }
}

new CMSSuperHeroes_DynamicCss();