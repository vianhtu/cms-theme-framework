<?php
/**
 * @name : Default
 * @package : CMSSuperHeroes
 * @author : Fox
 */
?>
<?php global $smof_data; ?>
<div class="main-logo">
    <img alt="" src="<?php echo esc_url($smof_data['main_logo']['url']); ?>">
</div>
<nav id="site-navigation" class="main-navigation" role="navigation">
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
</nav>
<!-- #site-navigation -->