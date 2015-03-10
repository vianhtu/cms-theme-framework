<?php

/**
 * Auto create .css file from Theme Options
 * @author Fox
 * @version 1.0.0
 */
class CMSSuperHeroes_StaticCss
{

    function __construct()
    {
        global $smof_data;
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
            }
            /* write static.css file */
            file_put_contents(get_template_directory() . '/css/' . 'static.css', $css, LOCK_EX); // Save it
        }
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
        <?php echo esc_attr($smof_data['custom_css']); ?>
        body{}
        header{}
        footer{}
        <?php
        return ob_get_clean();
    }
}

new CMSSuperHeroes_StaticCss();