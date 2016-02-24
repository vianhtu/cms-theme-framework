<?php
/**
 * get header layout.
 */
function theme_framework_header(){
    global $opt_theme_options;

    if(!isset($opt_theme_options)){
        get_template_part('inc/header/header');
        return;
    }
    /* load custom header template. */
    get_template_part('inc/header/header', $opt_theme_options['header_layout']);
}

/**
 * get theme logo.
 */
function theme_framework_header_logo(){
    global $opt_theme_options;

    if(!isset($opt_theme_options))
        return;

    echo '<a href="'.esc_url(home_url('/')).'"><img alt="'.esc_html__('Logo', 'cms-theme-framework').'" src="'.esc_url($opt_theme_options['main_logo']['url']).'"></a>';
}

/**
 * get header class.
 */
function theme_framework_header_class($class = ''){
    global $opt_theme_options;

    if(!isset($opt_theme_options)){
        echo $class;
        return;
    }

    if($opt_theme_options['menu_sticky'])
        $class .= ' sticky-desktop';

    if($opt_theme_options['menu_sticky_tablets'])
        $class .= ' sticky-tablets';

    if($opt_theme_options['menu_sticky_mobile'])
        $class .= ' sticky-mobile';

    echo $class;
}

/**
 * main navigation.
 */
function theme_framework_header_navigation(){

    $attr = array(
        'menu' => 0,
        'menu_class' => 'nav-menu menu-main-menu',
        'theme_location' => 'primary'
    );

    /* enable mega menu. */
    if(class_exists('HeroMenuWalker')){ $attr['walker'] = new HeroMenuWalker(); }

    /* main nav. */
    wp_nav_menu( $attr );
}

/**
 * get page title layout
 */
function theme_framework_page_title(){
	
    global $opt_theme_options;

    $layout = '5';

    if(isset($opt_theme_options['page_title_layout'])) {
        $layout = $opt_theme_options['page_title_layout'];
    }

    ?>
    <div id="page-title" class="page-title">
        <div class="container">
        <div class="row">
        <?php switch ($layout){
            case '1':
                ?>
                <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php theme_framework_get_page_title(); ?></h1></div>
                <div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php theme_framework_get_bread_crumb(); ?></div>
                <?php
                break;
            case '2':
                ?>
                <div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php theme_framework_get_bread_crumb(); ?></div>
                <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php theme_framework_get_page_title(); ?></h1></div>
                <?php
                break;
            case '3':
                ?>
                <div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php theme_framework_get_page_title(); ?></h1></div>
                <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php theme_framework_get_bread_crumb(); ?></div>
                <?php
                break;
            case '4':
                ?>
                <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php theme_framework_get_bread_crumb(); ?></div>
                <div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php theme_framework_get_page_title(); ?></h1></div>
                <?php
                break;
            case '5':
                ?>
                <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php theme_framework_get_page_title(); ?></h1></div>
                <?php
                break;
            case '6':
                ?>
                <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php theme_framework_get_bread_crumb(); ?></div>
                <?php
                break;
        } ?>
        </div>
        </div>
    </div><!-- #page-title -->
    <?php
}

/**
 * page title
 */
function theme_framework_get_page_title(){
    if (!is_archive()){
        /* page. */
        if(is_page()) :

            $custom_title = theme_framework_get_post_meta('page_title_text');

            /* custom title. */
            if($custom_title):
                echo esc_attr($custom_title);
            else :
                the_title();
            endif;
        elseif (is_front_page()):
            esc_html_e('Blog', 'cms-theme-framework');
        /* search */
        elseif (is_search()):
            printf( esc_html__( 'Search Results for: %s', 'cms-theme-framework' ), '<span>' . get_search_query() . '</span>' );
        /* 404 */
        elseif (is_404()):
            esc_html_e( '404', 'cms-theme-framework');
        /* other */
        else :
            the_title();
        endif;
    } else {
        /* category. */
        if ( is_category() ) :
            single_cat_title();
        elseif ( is_tag() ) :
            /* tag. */
            single_tag_title();
        /* author. */
        elseif ( is_author() ) :
            printf( esc_html__( 'Author: %s', 'cms-theme-framework' ), '<span class="vcard">' . get_the_author() . '</span>' );
        /* date */
        elseif ( is_day() ) :
            printf( esc_html__( 'Day: %s', 'cms-theme-framework' ), '<span>' . get_the_date() . '</span>' );
        elseif ( is_month() ) :
            printf( esc_html__( 'Month: %s', 'cms-theme-framework' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'cms-theme-framework' ) ) . '</span>' );
        elseif ( is_year() ) :
            printf( esc_html__( 'Year: %s', 'cms-theme-framework' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'cms-theme-framework' ) ) . '</span>' );
        /* post format */
        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            esc_html_e( 'Asides', 'cms-theme-framework' );
        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            esc_html_e( 'Galleries', 'cms-theme-framework');
        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            esc_html_e( 'Images', 'cms-theme-framework');
        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            esc_html_e( 'Videos', 'cms-theme-framework' );
        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            esc_html_e( 'Quotes', 'cms-theme-framework' );
        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            esc_html_e( 'Links', 'cms-theme-framework' );
        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            esc_html_e( 'Statuses', 'cms-theme-framework' );
        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            esc_html_e( 'Audios', 'cms-theme-framework' );
        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            esc_html_e( 'Chats', 'cms-theme-framework' );
        /* woocommerce */
        elseif (function_exists('is_woocommerce') && is_woocommerce()):
            woocommerce_page_title();
        else :
            /* other */
            the_title();
        endif;
    }
}

/**
 * Breadcrumb
 *
 * @since 1.0.0
 */
function theme_framework_get_bread_crumb($separator = '') {
    global $opt_theme_options, $post;

    echo '<ul class="breadcrumbs">';
    /* not front_page */
    if ( !is_front_page() ) {
        echo '<li><a href="';
        echo esc_url(home_url('/'));
        echo '">';
        echo isset($opt_theme_options['breacrumb_home_prefix']) ? esc_html($opt_theme_options['breacrumb_home_prefix']) : esc_html__('Home', 'cms-theme-framework');
        echo "</a></li>";
    }

    $params['link_none'] = '';

    /* category */
    if (is_category()) {
        $category = get_the_category();
        $ID = $category[0]->cat_ID;
        echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ? '' : '<li>'.wp_kses_post($cat_parents).'</li>';
    }
    /* tax */
    if (is_tax()) {
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $link = get_term_link( $term );

        if ( is_wp_error( $link ) ) {
            echo sprintf('<li>%s</li>', $term->name );
        } else {
            echo sprintf('<li><a href="%s" title="%s">%s</a></li>', $link, $term->name, $term->name );
        }
    }
    /* home */

    /* page not front_page */
    if(is_page() && !is_front_page()) {
        $parents = array();
        $parent_id = $post->post_parent;
        while ( $parent_id ) :
            $page = get_page( $parent_id );
            if ( $params["link_none"] )
                $parents[]  = get_the_title( $page->ID );
            else
                $parents[]  = '<li><a href="' . esc_url(get_permalink( $page->ID )) . '" title="' . esc_attr(get_the_title( $page->ID )) . '">' . esc_html(get_the_title( $page->ID )) . '</a></li>' . $separator;
            $parent_id  = $page->post_parent;
        endwhile;
        $parents = array_reverse( $parents );
        echo join( '', $parents );
        echo '<li>'.esc_html(get_the_title()).'</li>';
    }
    /* single */
    if(is_single()) {
        $categories_1 = get_the_category($post->ID);
        if($categories_1):
            foreach($categories_1 as $cat_1):
                $cat_1_ids[] = $cat_1->term_id;
            endforeach;
            $cat_1_line = implode(',', $cat_1_ids);
        endif;
        if( isset( $cat_1_line ) && $cat_1_line ) {
            $categories = get_categories(array(
                'include' => $cat_1_line,
                'orderby' => 'id'
            ));
            if ( $categories ) :
                foreach ( $categories as $cat ) :
                    $cats[] = '<li><a href="' . esc_url(get_category_link( $cat->term_id )) . '" title="' . esc_attr($cat->name) . '">' . esc_html($cat->name) . '</a></li>';
                endforeach;
                echo join( '', $cats );
            endif;
        }
        echo '<li>'.get_the_title().'</li>';
    }
    /* tag */
    if( is_tag() ){ echo '<li>'."Tag: ".single_tag_title('',FALSE).'</li>'; }
    /* search */
    if( is_search() ){ echo '<li>'.esc_html__("Search", 'cms-theme-framework').'</li>'; }
    /* date */
    if( is_year() ){ echo '<li>'.get_the_time('Y').'</li>'; }
    /* 404 */
    if( is_404() ) {
        echo '<li>'.esc_html__("404 - Page not Found", 'cms-theme-framework').'</li>';
    }
    /* archive */
    if( is_archive() && is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
        echo '<li>'. esc_html($title) .'</li>';
    }
    echo "</ul>";
}

/**
 * Display an optional post detail.
 */
function theme_framework_post_detail(){
    ?>
    <ul>
        <li class="detail-author"><?php esc_html_e('By', 'cms-theme-framework'); ?> <?php the_author_posts_link(); ?></li>
        <?php if(has_category()): ?>
        <li class="detail-terms"><?php the_terms( get_the_ID(), 'category', '<i class="fa fa-sitemap"></i>', ' / ' ); ?></li>
        <?php endif; ?>
        <li class="detail-comment"><i class="fa fa-comments-o"></i><a href="<?php the_permalink(); ?>"><?php echo esc_html(comments_number('0','1','%')); ?> <?php esc_html_e('Comments', 'cms-theme-framework'); ?></a></li>
        <?php if(has_tag()): ?>
        <li class="detail-tags"><?php the_tags('<i class="fa fa-tags"></i>', ', ' ); ?></li>
        <?php endif; ?>
    </ul>
    <?php
}

/**
 * Display an optional post video.
 */
function theme_framework_post_video() {

    global $opt_meta, $wp_embed;

    /* no video. */
    if(empty($opt_meta['opt-video-type'])) {
        theme_framework_post_thumbnail();
        return;
    }

    if($opt_meta['opt-video-type'] == 'local' && !empty($opt_meta['otp-video-local']['id'])){

        $video = wp_get_attachment_metadata($opt_meta['otp-video-local']['id']);

        echo do_shortcode('[video width="'.esc_attr($opt_meta['otp-video-local']['width']).'" height="'.esc_attr($opt_meta['otp-video-local']['height']).'" '.$video['fileformat'].'="'.esc_url($opt_meta['otp-video-local']['url']).'" poster="'.esc_url($opt_meta['otp-video-thumb']['url']).'"][/video]');

    } elseif($opt_meta['opt-video-type'] == 'youtube' && !empty($opt_meta['opt-video-youtube'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta['opt-video-youtube']).'[/embed]'));

    } elseif($opt_meta['opt-video-type'] == 'vimeo' && !empty($opt_meta['opt-video-vimeo'])) {

        echo do_shortcode($wp_embed->run_shortcode('[embed]'.esc_url($opt_meta['opt-video-vimeo']).'[/embed]'));

    }
}

/**
 * Display an optional post audio.
 */
function theme_framework_post_audio() {
    global $opt_meta;

    /* no audio. */
    if(empty($opt_meta['otp-audio']['id'])) {
        theme_framework_post_thumbnail();
        return;
    }

    $audio = wp_get_attachment_metadata($opt_meta['otp-audio']['id']);

    echo do_shortcode('[audio '.$audio['fileformat'].'="'.esc_url($opt_meta['otp-audio']['url']).'"][/audio]');
}

/**
 * Display an optional post gallery.
 */
function theme_framework_post_gallery(){
    global $opt_meta;

    /* no audio. */
    if(empty($opt_meta['opt-gallery'])) {
        theme_framework_post_thumbnail();
        return;
    }

    $array_id = explode(",", $opt_meta['opt-gallery']);

    ?>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $i = 0; ?>
            <?php foreach ($array_id as $image_id): ?>
                <?php
                $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                if($attachment_image[0] != ''):?>
                    <div class="item <?php if( $i == 0 ){ echo 'active'; } ?>">
                        <img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
                    </div>
                <?php $i++; endif; ?>
            <?php endforeach; ?>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="fa fa-angle-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="fa fa-angle-right"></span>
        </a>
    </div>
    <?php
}

/**
 * Display an optional post quote.
 */
function theme_framework_post_quote() {
    global $opt_meta;

    if(empty($opt_meta['opt-quote-content'])){
        theme_framework_post_thumbnail();
        return;
    }

    $opt_meta['opt-quote-title'] = !empty($opt_meta['opt-quote-title']) ? '<span>'.esc_html($opt_meta['opt-quote-title']).'</span>' : '' ;

    echo '<blockquote>'.esc_html($opt_meta['opt-quote-content']).wp_kses_post($opt_meta['opt-quote-title']).'</blockquote>';
}

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
function theme_framework_post_thumbnail() {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    echo '<div class="post-thumbnail">';
            the_post_thumbnail();
    echo '</div>';
}