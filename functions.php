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

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;
	
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
function et3_theme_framework_setup() {

	// load language.
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
	add_theme_support( 'post-formats', array( 'video', 'audio' , 'gallery', 'quote') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'cms-theme-framework' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array('default-color' => 'e6e6e6',) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}

add_action( 'after_setup_theme', 'et3_theme_framework_setup' );

/**
 * Enqueue scripts and styles for front-end.
 * @author Fox
 * @since CMS SuperHeroes 1.0
 */
function et3_theme_framework_front_end_scripts() {
    
	global $wp_styles, $opt_meta_options;

	/* one page. */
	if(is_page() && isset($opt_meta_options['page_one_page']) && $opt_meta_options['page_one_page']) {
		wp_register_script('jquery.singlePageNav', get_template_directory_uri() . '/assets/js/jquery.singlePageNav.js', array('jquery'), '1.2.0');
		wp_localize_script('jquery.singlePageNav', 'one_page_options', array('filter' => '.is-one-page', 'speed' => $opt_meta_options['page_one_page_speed']));
		wp_enqueue_script('jquery.singlePageNav');
	}

	/* Adds JavaScript Bootstrap. */
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.2');
		
	/* Add main.js */
	wp_enqueue_script('et3_theme_framework-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
	
	/* Add menu.js */
	wp_enqueue_script('et3_theme_framework-menu', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), '1.0.0', true);
    
	/* Comment */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/** ----------------------------------------------------------------------------------- */
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
	
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
		
	/* Loads our main stylesheet. */
	wp_enqueue_style( 'et3_theme_framework-style', get_stylesheet_uri());

	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'et3_theme_framework-ie', get_template_directory_uri() . '/assets/css/ie.css');
	
	/* ie */
	$wp_styles->add_data( 'et3_theme_framework-ie', 'conditional', 'lt IE 9' );
	
	/* Load static css*/
	wp_enqueue_style('et3_theme_framework-static', get_template_directory_uri() . '/assets/css/static.css');
}

add_action( 'wp_enqueue_scripts', 'et3_theme_framework_front_end_scripts' );

/**
 * load admin scripts.
 * 
 * @author FOX
 */
function et3_theme_framework_admin_scripts(){

	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');

	$screen = get_current_screen();

	/* load js for edit post. */
	if($screen->post_type == 'post'){
		/* post format select. */
		wp_enqueue_script('post-format', get_template_directory_uri() . '/assets/js/post-format.js', array(), '1.0.0', true);
	}
}

add_action( 'admin_enqueue_scripts', 'et3_theme_framework_admin_scripts' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */
function et3_theme_framework_widgets_init() {

	global $opt_theme_options;

	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'cms-theme-framework' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'cms-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	/* footer-top */
	if(!empty($opt_theme_options['footer-top-column'])) {

		for($i = 1 ; $i <= $opt_theme_options['footer-top-column'] ; $i++){
			register_sidebar(array(
				'name' => sprintf(esc_html__('Footer Top %s', 'cms-theme-framework'), $i),
				'id' => 'sidebar-footer-top-' . $i,
				'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'cms-theme-framework'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="wg-title">',
				'after_title' => '</h3>',
			));
		}
	}

	/* footer-top */
	if(!empty($opt_theme_options['footer-bottom-column'])) {

		for($i = 1 ; $i <= $opt_theme_options['footer-bottom-column'] ; $i++){
			register_sidebar(array(
				'name' => sprintf(esc_html__('Footer Bottom %s', 'cms-theme-framework'), $i),
				'id' => 'sidebar-footer-bottom-' . $i,
				'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'cms-theme-framework'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="wg-title">',
				'after_title' => '</h3>',
			));
		}
	}
}

add_action( 'widgets_init', 'et3_theme_framework_widgets_init' );

/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since 1.0.0
 */
function et3_theme_framework_comment_nav() {
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
function et3_theme_framework_paging_nav() {
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

	// Set up paginated links.
	$links = paginate_links( array(
			'base'     => $pagenum_link,
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
				<?php echo wp_kses_post($links); ?>
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
function et3_theme_framework_post_nav() {
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
function et3_theme_framework_comment($comment, $args, $depth) {
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

/* core functions. */
require_once( get_template_directory() . '/inc/functions.php' );

/**
 * theme actions.
 */

/* add footer back to top. */
add_action('wp_footer', 'et3_theme_framework_footer_back_to_top');


add_filter('cms-shorcode-list', 'et3_theme_framework_shortcodes');
/**
 * support shortcodes
 * @return array
 */
function et3_theme_framework_shortcodes(){
	return array(
		'cms_carousel',
		'cms_grid',
		'cms_fancybox_single',
		'cms_counter_single',
		'cms_progressbar',
	);
}