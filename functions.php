<?php
/**
 * Theme Framework functions and definitions
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

/* Dismiss vc update. */
if(function_exists('vc_set_as_theme')) vc_set_as_theme( true );

/* Add base functions */
if(!class_exists("ThemeFrameworkBase")){
    require( get_template_directory() . '/inc/base.class.php' );
}

/* Add ReduxFramework. */
if(!class_exists('ReduxFramework')){
    require( get_template_directory() . '/inc/ReduxCore/framework.php' );
}

/* Add theme options. */
require( get_template_directory() . '/inc/options/functions.php' );

/**
 * vc_elements
 */
add_action('vc_before_init', 'theme_framework_vc_elements');

function theme_framework_vc_elements(){
    
    if(!class_exists('Vc_Manager'))
        return ;
    
    if(class_exists('CmsShortCode')){
        require( get_template_directory() . '/inc/elements/googlemap/cms_googlemap.php' );
    }
}

/**
 * vc params.
 */
add_action('init', 'theme_framework_vc_params');

function theme_framework_vc_params() {
    
    if(!class_exists('Vc_Manager'))
        return ;
    
    //require( get_template_directory() . '/vc_params/vc_rows.php' );
}

/* Add SCSS */
if(!class_exists('scssc')){
    require( get_template_directory() . '/inc/libs/scss.inc.php' );
}

/* Add Meta Core Options */
if(is_admin()){
    
    if(!class_exists('CsCoreControl')){
        /* add mete core */
        require( get_template_directory() . '/inc/metacore/core.options.php' );
        /* add meta options */
        require( get_template_directory() . '/inc/options/meta.options.php' );
    }
    
    /* tmp plugins. */
    require( get_template_directory() . '/inc/options/require.plugins.php' );
}

/* Add Template functions */
require( get_template_directory() . '/inc/template.functions.php' );

/* Static css. */
require( get_template_directory() . '/inc/dynamic/static.css.php' );

/* Dynamic css*/
require( get_template_directory() . '/inc/dynamic/dynamic.css.php' );

/* Add mega menu */
if(!class_exists('HeroMenuWalker') && wp_get_nav_menus()){
    require( get_template_directory() . '/inc/megamenu/mega-menu.php' );
}

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * add base class.
 */
add_action('init', 'theme_framework_base_class');
	
function theme_framework_base_class(){
    
    $GLOBALS['theme_framework_base'];

    $GLOBALS['theme_framework_base'] = new ThemeFrameworkBase;
}
	
/**
 * CMS Theme setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * CMS Theme supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0.0
 */
function theme_framework_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'cms-theme-framework' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cms-theme-framework' , get_template_directory() . '/languages' );

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
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'cms-theme-framework' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}

add_action( 'after_setup_theme', 'theme_framework_setup' );

/**
 * Enqueue scripts and styles for front-end.
 * @author Fox
 * @since CMS SuperHeroes 1.0
 */
function theme_framework_scripts_styles() {
    
	global $smof_data, $wp_styles;
	
	/** theme options. */
	$script_options = array(
	    'menu_sticky'=> $smof_data['menu_sticky'],
	    'menu_sticky_tablets'=> $smof_data['menu_sticky_tablets'],
	    'menu_sticky_mobile'=> $smof_data['menu_sticky_mobile'],
	    'paralax' => 1,
	    'back_to_top'=> $smof_data['footer_botton_back_to_top']
	);

	/*------------------------------------- JavaScript ---------------------------------------*/
	
	
	/** --------------------------libs--------------------------------- */
	
	
	/* Adds JavaScript Bootstrap. */
	wp_enqueue_script('cmssuperheroes-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.2');
		
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
	wp_enqueue_style( 'cmssuperheroes-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'cmssuperheroes-style' ), '20121010' );
	$wp_styles->add_data( 'cmssuperheroes-ie', 'conditional', 'lt IE 9' );
	
	/* Load static css*/
	wp_enqueue_style('cmssuperheroes-static', get_template_directory_uri() . '/assets/css/static.css', array( 'cmssuperheroes-style' ), '1.0.0');
}

add_action( 'wp_enqueue_scripts', 'theme_framework_scripts_styles' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */
function theme_framework_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'cms-theme-framework' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'cms-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Header Top Left', 'cms-theme-framework' ),
		'id' => 'sidebar-2',
		'description' => esc_html__( 'Appears when using the optional Header with a page set as Header top left', 'cms-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Header Top Right', 'cms-theme-framework' ),
		'id' => 'sidebar-3',
		'description' => esc_html__( 'Appears when using the optional Header with a page set as Header top right', 'cms-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Menu Right', 'cms-theme-framework' ),
    	'id' => 'sidebar-4',
    	'description' => esc_html__( 'Appears when using the optional Menu with a page set as Menu right', 'cms-theme-framework' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 1', 'cms-theme-framework' ),
    	'id' => 'sidebar-5',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 1', 'cms-theme-framework' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 2', 'cms-theme-framework' ),
    	'id' => 'sidebar-6',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 2', 'cms-theme-framework' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 3', 'cms-theme-framework' ),
    	'id' => 'sidebar-7',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 3', 'cms-theme-framework' ),
    	'before_widget' => '<aside class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 4', 'cms-theme-framework' ),
    	'id' => 'sidebar-8',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 4', 'cms-theme-framework' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Boton Left', 'cms-theme-framework' ),
    	'id' => 'sidebar-9',
    	'description' => esc_html__( 'Appears when using the optional Footer Boton with a page set as Footer Boton left', 'cms-theme-framework' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
    	'name' => esc_html__( 'Footer Boton Right', 'cms-theme-framework' ),
    	'id' => 'sidebar-10',
    	'description' => esc_html__( 'Appears when using the optional Footer Boton with a page set as Footer Boton right', 'cms-theme-framework' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'theme_framework_widgets_init' );

/**
 * Get meta data.
 * 
 * @param string $key
 * @param string $default
 */
function theme_framework_get_post_meta($key, $default = '', $post_id = NULL){
	
	global $post;
	
	/* key null. */
	if(!$key) return $default;
	
	$key = '_cms_' . $key;
	
	/* post ID null. */
	if(!$post_id && empty($post->ID)) return $default;
	
	/* set post ID */
	if(!$post_id) $post_id = $post->ID;
	
	/* get meta. */
	$meta = get_post_meta($post_id, $key, true);
	
	/* meta null. */
	if(empty($meta)) return $default;
	
	return $meta;
}

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0.0
 */
function theme_framework_page_menu_args( $args ) {
    if ( ! isset( $args['show_home'] ) )
        $args['show_home'] = true;
    return $args;
}

add_filter( 'wp_page_menu_args', 'theme_framework_page_menu_args' );

/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since 1.0.0
 */
function theme_framework_comment_nav() {
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'cms-theme-framework' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'cms-theme-framework' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'cms-theme-framework' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 */
function theme_framework_paging_nav() {
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
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation clearfix" role="navigation">
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
function theme_framework_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links clearfix">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
			  <a class="btn btn-default post-prev left" href="<?php echo get_permalink( $prev_post->ID ); ?>"><i class="fa fa-angle-left"></i><?php echo esc_attr($prev_post->post_title); ?></a>
			<?php endif; ?>
			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) { ?>
			  <a class="btn btn-default post-next right" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_title( $next_post->ID ); ?><i class="fa fa-angle-right"></i></a>
			<?php } ?>

			</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/* Add Custom Comment */
function theme_framework_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
    ?>
    <<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
    <?php endif; ?>
    <div class="comment-author-image vcard">
    	<?php echo get_avatar( $comment, 109 ); ?>
    	<div class="comment-meta commentmetadata">
    		<span class="comment-author"><?php echo get_comment_author_link(); ?></span>
    		<span class="comment-date">
    		<?php
    			echo get_the_date(get_option('date_format', 'Y/m/d'));
    		?>
    		</span>
    	</div>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
    	<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'cms-theme-framework'); ?></em>
    <?php endif; ?>
    <div class="comment-main">
    	<div class="comment-content">
    		<?php comment_text(); ?>
    		<div class="reply">
    		<span></span><?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    		</div>
    	</div>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}

/**
 * limit words
 * 
 * @since 1.0.0
 */
if (!function_exists('theme_framework_limit_words')) {
    function theme_framework_limit_words($string, $word_limit) {
        $words = explode(' ', $string, ($word_limit + 1));
        if (count($words) > $word_limit) {
            array_pop($words);
        }
        return implode(' ', $words)."";
    }
}

/**
 * Set home page.
 * 
 * get home title and update options.
 * 
 * @return Home page title.
 * @author FOX
 */
function theme_framework_set_home_page(){
    
    $home_page = 'Home';
    
    $page = get_page_by_title($home_page);
    
    if(!isset($page->ID))
        return ;
    	
    update_option('show_on_front', 'page');
    update_option('page_on_front', $page->ID);
}

add_action('cms_import_finish', 'theme_framework_set_home_page');

/**
 * Set menu locations.
 * 
 * get locations and menu name and update options.
 * 
 * @return string[]
 * @author FOX
 */
function theme_framework_set_menu_location(){
    
    $setting = array(
        'Footer menu' => 'second',
        'Main menu' => 'primary'
    );
    
    $navs = wp_get_nav_menus();
    
    $new_setting = array();
    
    foreach ($navs as $nav){
        
        if(!isset($setting[$nav->name]))
            continue;
        
        $id = $nav->term_id;
        $location = $setting[$nav->name];
        
        $new_setting[$location] = $id;
    }
    
    set_theme_mod('nav_menu_locations', $new_setting);
}

add_action('cms_import_finish', 'theme_framework_set_menu_location');


function theme_framework_custom_css($param) {
    
    global $smof_data;
    
    if(empty($smof_data['custom_css']))
        return ;
    /* custom css. */
    echo '<style type="text/css">' . esc_html($smof_data['custom_css']) . '</style>';
}

add_action('wp_head', 'theme_framework_custom_css');