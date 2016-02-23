<?php
/**
 * @name : Default
 * @package : CMSSuperHeroes
 * @author : Fox
 */
?>
<?php global $smof_data; ?>
<div id="cshero-header" class="cshero-main-header <?php if (!$smof_data['menu_sticky']) {echo 'no-sticky';} ?> <?php if ($smof_data['menu_sticky_tablets']) {echo 'sticky-tablets';} ?> <?php if ($smof_data['menu_sticky_mobile']) {echo 'sticky-mobile';} ?> <?php if (is_page() && !empty($theme_framework_meta->_cms_enable_header_fixed)) {echo 'header-fixed-page';} ?>">
    <div class="container">
        <div class="row">
            <div id="cshero-header-logo" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <a href="<?php echo esc_url(home_url('/')); ?>"><img alt="" src="<?php echo esc_url($smof_data['main_logo']['url']); ?>"></a>
            </div>
            <div id="cshero-header-navigation" class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <?php
                    
                    $attr = array(
                        'menu' => 0,
                        'menu_class' => 'nav-menu menu-main-menu',
                    );
                    
                    $menu_locations = get_nav_menu_locations();
                    
                    if(!empty($menu_locations['primary'])){
                        $attr['theme_location'] = 'primary';
                    }
                    
                    /* enable mega menu. */
                    if(class_exists('HeroMenuWalker')){ $attr['walker'] = new HeroMenuWalker(); }
                    
                    /* main nav. */
                    wp_nav_menu( $attr ); ?>
                </nav>
            </div>
            <div id="cshero-menu-mobile" class="collapse navbar-collapse"><i class="pe-7s-menu"></i></div>
        </div>
    </div>
</div>
<!-- #site-navigation -->