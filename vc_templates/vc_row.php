<?php
global $smof_data;
/** @var $this WPBakeryShortCode_VC_Row */
extract( shortcode_atts( array(
	'el_class' => '',
	'full_width' => false,
	'bg_style' => '',
	'bd_p_speed' => 0.1,
	'bg_video_mp4' => '',
	'bg_video_webm' => '',
	'row_data' => '',
	'css' => '',
), $atts ) );

$row_style = ''; $video_style = '';

/** bg style image */
switch ($bg_style){
    case 'img_parallax':
        $el_class .= " cms_parallax";
        $row_data .= " data-speed = $bd_p_speed";
        $row_style .= "background-position: 50% 0;background-repeat:no-repeat;background-attachment:fixed;background-size:cover;";
        break;
    case 'img_fixed':
        $row_style .= "background-attachment:fixed;background-size:cover;";
        break;
    case 'hvideo':
        $el_class .= "row-bg-video";
        $video_style = '<div class="cms-bg-video">'.do_shortcode('[video autoplay="on" loop="on" preload="none" height="0" width="0" mp4="'.$bg_video_mp4.'" webm="'.$bg_video_webm.'"]').'</div>';
        break;
}

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'row ' . ( $this->settings( 'base' ) === 'cms_row_inner' ? 'cms_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = ' style ="'.$row_style.'"';  //$this->buildStyle();

?>
<div class="<?php echo esc_attr( $css_class ); ?>"<?php echo esc_attr($row_data); ?><?php echo $style; ?>>

    <?php echo $video_style; ?>
    
    <div class="cms-bg-overlay"></div>

    <?php if(!$full_width): ?><div class="container"><?php endif ; ?>
    
    <?php echo wpb_js_remove_wpautop( $content ); ?>
    
    <?php if(!$full_width): ?></div><?php endif ; ?>
    
</div>
