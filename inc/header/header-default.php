<?php
/**
 * @name : Default Header
 * @package : CMSSuperHeroes
 * @author : Fox
 */
?>

<div id="cshero-header" class="<?php et3_theme_framework_header_class('cshero-main-header'); ?>">
    <div class="container">
        <div class="row">
            <div id="cshero-header-logo" class="site-branding col-xs-12 col-sm-3 col-md-3 col-lg-3">

                <?php et3_theme_framework_header_logo(); ?>

            </div><!-- #site-logo -->
            <div id="cshero-header-navigation" class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <nav id="site-navigation" class="main-navigation" role="navigation">

                    <?php et3_theme_framework_header_navigation(); ?>

                </nav><!-- #site-navigation -->
            </div>
            <div id="cshero-menu-mobile" class="collapse navbar-collapse">
                <i class="pe-7s-menu"></i>
            </div><!-- #menu-mobile -->
        </div>
    </div>
</div><!-- #site-navigation -->