<?php
/**
 * @name : Default
 * @package : CMSSuperHeroes
 * @author : Fox
 */
?>
<?php global $smof_data; ?>
<div class="header-top">
    <div class="container">
        <div class="row">
             <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-2'); ?></div>
             <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-3'); ?></div>
        </div>
    </div>
</div>
<div class="header">
    <div class="container">
        <div class="row">
            <div id="header-logo" class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <a href="<?php echo home_url(); ?>"><img alt="" src="<?php echo esc_url($smof_data['main_logo']['url']); ?>"></a>
            </div>
            <div id="header-navigation" class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                </nav>
            </div>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2"><?php dynamic_sidebar('sidebar-4'); ?></div>
        </div>
    </div>
</div>
<!-- #site-navigation -->