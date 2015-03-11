<?php
/**
 * @name : Default
 * @package : CMSSuperHeroes
 * @author : Fox
 */
?>
<?php global $smof_data; ?>
<div class="header-top">
    <div class="row">
         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
         header-top-1
         </div>
         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
         header-top-2
         </div>
    </div>
</div>
<div class="container">
	<div class="row">
        <div class="header-logo">
            <img alt="" src="<?php echo esc_url($smof_data['main_logo']['url']); ?>">
        </div>
        <div class="header-navigation">
            <nav id="site-navigation" class="main-navigation" role="navigation">
            	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
            </nav>
        </div>
    </div>
</div>
<!-- #site-navigation -->