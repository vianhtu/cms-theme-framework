<?php
/** @var $this WPBakeryShortCode_VC_Row */
extract( shortcode_atts( array(
	'el_class' => '',
	'full_width' => false,
	'bg_style' => '',
	'bd_p_speed' => 0.1,
	'row_data' => '',
	'css' => '',
), $atts ) );

$row_style = '';

/** bg style image */
if($bg_style == 'image'){
    $el_class .= " cms_parallax";
    $row_data .= " data-speed = $bd_p_speed";
    $row_style .= "background-position: 50% 0;background-repeat:no-repeat;background-attachment:fixed;background-size:cover;";
}



$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'row ' . ( $this->settings( 'base' ) === 'cms_row_inner' ? 'cms_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = ' style ="'.$row_style.'"';  //$this->buildStyle();

?>
<div class="<?php echo esc_attr( $css_class ); ?>"<?php echo $row_data; ?><?php echo $style; ?>>

    <?php if($full_width): ?><div class="container"><?php endif ; ?>
    
    <?php echo wpb_js_remove_wpautop( $content ); ?>
    
    <?php if($full_width): ?></div><?php endif ; ?>
    
</div>
