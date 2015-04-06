<?php
/**
 * Twenty Twelve functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/**
 * Add global values.
 */
global $smof_data, $cms_meta;

$theme = wp_get_theme();

define('THEMENAME', $theme->get('Name'));

/* Add base functions */
require( get_template_directory() . '/inc/base.class.php' );

/* Add ReduxFramework. */
if(!class_exists('ReduxFramework')){
    require( get_template_directory() . '/inc/ReduxCore/framework.php' );
}

/* Add theme options. */
require( get_template_directory() . '/inc/options/functions.php' );

/* Add custom vc params. */
if(class_exists('Vc_Manager')){
    add_action('init', 'cms_vc_params');
    function cms_vc_params() {
        require( get_template_directory() . '/inc/vc_params/vc_rows.php' );
    }
}

/* Add SCSS */
if(!class_exists('scssc')){
    require( get_template_directory() . '/inc/libs/scss.inc.php' );
}

/* Add Meta Core Options */
if(is_admin() && !class_exists('CsCoreControl')){
    /* add mete core */
    require( get_template_directory() . '/inc/metacore/core.options.php' );
    /* add meta options */
    require( get_template_directory() . '/inc/options/meta.options.php' );
}

/* Add Template functions */
require( get_template_directory() . '/inc/template.functions.php' );

/* Static css. */
require( get_template_directory() . '/inc/dynamic/static.css.php' );

/* Dynamic css*/
require( get_template_directory() . '/inc/dynamic/dynamic.css.php' );

/* Add mega menu */
if(isset($smof_data['menu_mega']) && $smof_data['menu_mega'] && !class_exists('HeroMenuWalker')){
    require( get_template_directory() . '/inc/megamenu/mega-menu.php' );
}

/* Add widgets */
require( get_template_directory() . '/inc/widgets/cart_search.php' );

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Twenty Twelve setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function cms_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds title tag
	add_theme_support( "title-tag" );
	
	// Add woocommerce
	add_theme_support('woocommerce');
	
	// Adds custom header
	add_theme_support( 'custom-header' );
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'video', 'audio' , 'gallery', 'link', 'quote',) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	add_image_size('related-img', 50, 50, true);
	add_image_size('related-img-1', 100, 100, true);
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'cms_setup' );

/**
 * Get meta data.
 * @author Fox
 * @return mixed|NULL
 */
function cms_meta_data(){
    global $post, $cms_meta;
    if(isset($post->ID)){
        $cms_meta = json_decode(get_post_meta($post->ID, '_cms_meta_data', true));
    } else {
        $cms_meta = null;
    }
}
add_action('wp', 'cms_meta_data');

/**
 * Enqueue scripts and styles for front-end.
 * @author Fox
 * @since CMS SuperHeroes 1.0
 */
function cms_scripts_styles() {
    
	global $smof_data, $wp_styles;
	
	/** theme options. */
	$script_options = array(
	    'menu_sticky'=> $smof_data['menu_sticky'],
	    'menu_sticky_tablets'=> $smof_data['menu_sticky_tablets'],
	    'menu_sticky_mobile'=> $smof_data['menu_sticky_mobile'],
	    'paralax' => $smof_data['paralax'],
	    'back_to_top'=> $smof_data['footer_botton_back_to_top']
	);

	/*------------------------------------- JavaScript ---------------------------------------*/
	
	
	/** --------------------------libs--------------------------------- */
	
	
	/* Adds JavaScript Bootstrap. */
	wp_enqueue_script('cmssuperheroes-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.2');
	
	/* Add parallax plugin. */
	if($smof_data['paralax']){
	   wp_enqueue_script('cmssuperheroes-parallax', get_template_directory_uri() . '/assets/js/jquery.parallax-1.1.3.js', array( 'jquery' ), '1.1.3', true);
	}
	/* Add smoothscroll plugin */
	if($smof_data['smoothscroll']){
	   wp_enqueue_script('cmssuperheroes-smoothscroll', get_template_directory_uri() . '/assets/js/smoothscroll.min.js', array( 'jquery' ), '1.0.0', true);
	}
	
	/** --------------------------custom------------------------------- */
	
	/* Add main.js */
	wp_register_script('cmssuperheroes-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true);
	wp_localize_script('cmssuperheroes-main', 'CMSOptions', $script_options);
	wp_enqueue_script('cmssuperheroes-main');
	/* Add menu.js */
    wp_enqueue_script('cmssuperheroes-menu', get_template_directory_uri() . '/assets/js/menu.js', array( 'jquery' ), '1.0.0', true);
	
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

    /*------------------------------------- Stylesheet ---------------------------------------*/
	
	/** --------------------------libs--------------------------------- */
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('cmssuperheroes-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.2');
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('cmssuperheroes-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');
	
	/** --------------------------custom------------------------------- */
	
	/* Loads our main stylesheet. */
	wp_enqueue_style( 'cmssuperheroes-style', get_stylesheet_uri(), array( 'cmssuperheroes-bootstrap' ));

	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'cmssuperheroes-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
	
	/* WooCommerce */
	if(class_exists('WooCommerce')){
	    wp_enqueue_style( 'woocommerce', get_template_directory_uri() . "/assets/css/woocommerce.css", array(), '1.0.0');
	}
	
	/* Load static css*/
	$static_css = $smof_data['presets_color'] ? "presets-".$smof_data['presets_color'].".css" : "static.css" ;
	
	wp_enqueue_style('cmssuperheroes-static', get_template_directory_uri() . "/assets/css/$static_css", array( 'cmssuperheroes-style' ), '1.0.0');
}
add_action( 'wp_enqueue_scripts', 'cms_scripts_styles' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */
function cms_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', THEMENAME ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', THEMENAME ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Header Top Left', THEMENAME ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Header with a page set as Header top left', THEMENAME ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Header Top Right', THEMENAME ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Header with a page set as Header top right', THEMENAME ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => __( 'Menu Right', THEMENAME ),
    	'id' => 'sidebar-4',
    	'description' => __( 'Appears when using the optional Menu with a page set as Menu right', THEMENAME ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => __( 'Footer Top 1', THEMENAME ),
    	'id' => 'sidebar-5',
    	'description' => __( 'Appears when using the optional Footer with a page set as Footer Top 1', THEMENAME ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => __( 'Footer Top 2', THEMENAME ),
    	'id' => 'sidebar-6',
    	'description' => __( 'Appears when using the optional Footer with a page set as Footer Top 2', THEMENAME ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => __( 'Footer Top 3', THEMENAME ),
    	'id' => 'sidebar-7',
    	'description' => __( 'Appears when using the optional Footer with a page set as Footer Top 3', THEMENAME ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => __( 'Footer Top 4', THEMENAME ),
    	'id' => 'sidebar-8',
    	'description' => __( 'Appears when using the optional Footer with a page set as Footer Top 4', THEMENAME ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => __( 'Footer Boton Left', THEMENAME ),
    	'id' => 'sidebar-9',
    	'description' => __( 'Appears when using the optional Footer Boton with a page set as Footer Boton left', THEMENAME ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => __( 'Footer Boton Right', THEMENAME ),
    	'id' => 'sidebar-10',
    	'description' => __( 'Appears when using the optional Footer Boton with a page set as Footer Boton right', THEMENAME ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="widget-title">',
    	'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'cms_widgets_init' );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0.0
 */
function cms_page_menu_args( $args ) {
    if ( ! isset( $args['show_home'] ) )
        $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'cms_page_menu_args' );

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 */
function cms_paging_nav() {
    // Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', THEMENAME ),
			'next_text' => __( 'Next &rarr;', THEMENAME ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
			<div class="pagination loop-pagination">
				<?php echo ''.$links; ?>
			</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}

/**
* Display navigation to next/previous post when applicable.
*
* @since 1.0.0
*/
function cms_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', THEMENAME ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span>', 'Previous post link', THEMENAME ) ); ?>
			<?php next_post_link( '%link', _x( '<span class="meta-nav">&rarr;</span>', 'Next post link', THEMENAME ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
