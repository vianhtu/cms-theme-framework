<?php
/**
 * Page title template
 * @since 1.0.0
 * @author Fox
 */
function theme_framework_page_title(){
    global $smof_data, $theme_framework_meta, $theme_framework_base;
    
    /* page options */
    if(is_page() && isset($theme_framework_meta->_cms_page_title) && $theme_framework_meta->_cms_page_title){
        if(isset($theme_framework_meta->_cms_page_title_type)){
            $smof_data['page_title_layout'] = $theme_framework_meta->_cms_page_title_type;
        }
    }
    
    if($smof_data['page_title_layout']){
        ?>
        <div id="page-title" class="page-title">
            <div class="container">
            <div class="row">
            <?php switch ($smof_data['page_title_layout']){
                case '1':
                    ?>
                    <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php $theme_framework_base->getPageTitle(); ?></h1><?php theme_framework_page_sub_title(); ?></div>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php $theme_framework_base->getBreadCrumb(); ?></div>
                    <?php
                    break;
                case '2':
                    ?>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php $theme_framework_base->getBreadCrumb(); ?></div>
                    <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php $theme_framework_base->getPageTitle(); ?></h1><?php theme_framework_page_sub_title(); ?></div>
                    <?php          
                    break;
                case '3':
                    ?>
                    <div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php $theme_framework_base->getPageTitle(); ?></h1><?php theme_framework_page_sub_title(); ?></div>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php $theme_framework_base->getBreadCrumb(); ?></div>
                    <?php
                    break;
                case '4':
                    ?>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php $theme_framework_base->getBreadCrumb(); ?></div>
                    <div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php $theme_framework_base->getPageTitle(); ?></h1><?php theme_framework_page_sub_title(); ?></div>
                    <?php
                    break;
                case '5':
                    ?>
                    <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php $theme_framework_base->getPageTitle(); ?></h1><?php theme_framework_page_sub_title(); ?></div>
                    <?php
                    break;
                case '6':
                    ?>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php $theme_framework_base->getBreadCrumb(); ?></div>
                    <?php
                    break;
            } ?>
            </div>
            </div>
        </div><!-- #page-title -->
        <?php
    }
}

/**
 * Get sub page title.
 *
 * @author Fox
 */
function theme_framework_page_sub_title(){
    global $theme_framework_meta, $post;

    if(!empty($theme_framework_meta->_cms_page_title_sub_text)){
        echo '<div class="page-sub-title">'.esc_attr($theme_framework_meta->_cms_page_title_sub_text).'</div>';
    } elseif (!empty($post->ID) && get_post_meta($post->ID, 'post_subtitle', true)){
        echo '<div class="page-sub-title">'.esc_attr(get_post_meta($post->ID, 'post_subtitle', true)).'</div>';
    }
}

/**
 * Get Header Layout.
 * 
 * @author Fox
 */
function theme_framework_header(){
    global $smof_data, $theme_framework_meta;
    /* header for page */
    if(isset($theme_framework_meta->_cms_header) && $theme_framework_meta->_cms_header){
        if(isset($theme_framework_meta->_cms_header_layout)){
            $smof_data['header_layout'] = $theme_framework_meta->_cms_header_layout;
        }
    }
    /* load template. */
    get_template_part('inc/header/header', $smof_data['header_layout']);
}

/**
 * Get menu location ID.
 * 
 * @param string $option
 * @return NULL
 */
function theme_framework_menu_location($option = '_cms_primary'){
    global $theme_framework_meta;
    /* get menu id from page setting */
    return (isset($theme_framework_meta->$option) && $theme_framework_meta->$option) ? $theme_framework_meta->$option : null ;
}

function theme_framework_get_page_loading() {
    global $smof_data;
    
    if($smof_data['enable_page_loadding']){
        echo '<div id="cms-loadding">';
        switch ($smof_data['page_loadding_style']){
            case '2':
                echo '<div class="ball"></div>';
                break;
            default:
                echo '<div class="loader"></div>';
                break;
        }
        echo '</div>';
    }
}

/**
 * Add page class
 * 
 * @author Fox
 * @since 1.0.0
 */
function theme_framework_page_class(){
    global $smof_data;
    
    $page_class = '';
    /* check boxed layout */
    if($smof_data['body_layout']){
        $page_class = 'cs-boxed';
    } else {
        $page_class = 'cs-wide';
    }
    
    echo apply_filters('theme_framework_page_class', $page_class);
}

/**
 * Add main class
 * 
 * @author Fox
 * @since 1.0.0
 */
function theme_framework_main_class(){
    global $theme_framework_meta;
    
    $main_class = '';
    /* chect content full width */
    if(is_page() && isset($theme_framework_meta->_cms_full_width) && $theme_framework_meta->_cms_full_width){
        /* full width */
        $main_class = "no-container";
    } else {
        /* boxed */
        $main_class = "container";
    }
    
    echo apply_filters('theme_framework_main_class', $main_class);
}

/**
 * Archive detail
 * 
 * @author Fox
 * @since 1.0.0
 */
function theme_framework_archive_detail(){
    ?>
    <ul>
        <li class="detail-author"><?php _e('By', 'cms-theme-framework'); ?> <?php the_author_posts_link(); ?></li>
        <?php if(has_category()): ?>
        <li class="detail-terms"><?php the_terms( get_the_ID(), 'category', '<i class="fa fa-sitemap"></i>', ' / ' ); ?></li>
        <?php endif; ?>
        <li class="detail-comment"><i class="fa fa-comments-o"></i><a href="<?php the_permalink(); ?>"><?php echo comments_number('0','1','%'); ?> <?php _e('Comments', 'cms-theme-framework'); ?></a></li>
        <?php if(has_tag()): ?>
        <li class="detail-tags"><?php the_tags('<i class="fa fa-tags"></i>', ', ' ); ?></li>
        <?php endif; ?>
    </ul>
    <?php
}

/**
 * Archive readmore
 * 
 * @author Fox
 * @since 1.0.0
 */
function theme_framework_archive_readmore(){
    echo '<a class="btn btn-default" href="'.get_the_permalink().'" title="'.get_the_title().'" >'.esc_html__('Continue Reading', 'cms-theme-framework').'</a>';
}

/**
 * Media Audio.
 * 
 * @param string $before
 * @param string $after
 */
function theme_framework_archive_audio() {
	global $theme_framework_base;
    /* get shortcode audio. */
    $shortcode = $theme_framework_base->getShortcodeFromContent('audio', get_the_content());
    
    if($shortcode != ''){
        echo do_shortcode($shortcode);
        
        return true;
        
    } else {
        if(has_post_thumbnail()){
            the_post_thumbnail();
        }
        
        return false;
    }
    
}

/**
 * Media Video.
 *
 * @param string $before
 * @param string $after
 */
function theme_framework_archive_video() {
    
    global $wp_embed, $theme_framework_base;
    /* Get Local Video */
    $local_video = $theme_framework_base->getShortcodeFromContent('video', get_the_content());
    
    /* Get Youtobe or Vimeo */
    $remote_video = $theme_framework_base->getShortcodeFromContent('embed', get_the_content());
    
    if($local_video){
        /* view local. */
        echo do_shortcode($local_video);
        
        return true;
        
    } elseif ($remote_video) {
        /* view youtobe or vimeo. */
        echo do_shortcode($wp_embed->run_shortcode($remote_video));
        
        return true;
        
    } elseif (has_post_thumbnail()) {
        /* view thumbnail. */
        the_post_thumbnail();
    } else {
        return false;
    }
    
}

/**
 * Gallerry Images
 * 
 * @author Fox
 * @since 1.0.0
 */
function theme_framework_archive_gallery(){
	global $theme_framework_base;
    /* get shortcode gallery. */
    $shortcode = $theme_framework_base->getShortcodeFromContent('gallery', get_the_content());
    
    if($shortcode != ''){
        preg_match('/\[gallery.*ids=.(.*).\]/', $shortcode, $ids);
        
        if(!empty($ids)){
        
            $array_id = explode(",", $ids[1]);
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
            
            return true;
        
        } else {
            return false;
        }
    } else {
        if(has_post_thumbnail()){
            the_post_thumbnail();
        }
    }
}

/**
 * Quote Text.
 * 
 * @author Fox
 * @since 1.0.0
 */
function theme_framework_archive_quote() {
    /* get text. */
    preg_match('/\<blockquote\>(.*)\<\/blockquote\>/', get_the_content(), $blockquote);
    
    if(!empty($blockquote[0])){
        echo ''.$blockquote[0].'';
        return true;
    } else {
        if(has_post_thumbnail()){
            the_post_thumbnail();
        }
        return false;
    }
}

/**
 * Get icon from post format.
 * 
 * @return multitype:string Ambigous <string, mixed>
 * @author Fox
 * @since 1.0.0
 */
function theme_framework_archive_post_icon() {
    $post_icon = array('icon'=>'fa fa-file-text-o','text'=>esc_html__('STANDARD', 'cms-theme-framework'));
    switch (get_post_format()) {
        case 'gallery':
            $post_icon['icon'] = 'fa fa-camera-retro';
            $post_icon['text'] = esc_html__('GALLERY', 'cms-theme-framework');
            break;
        case 'link':
            $post_icon['icon'] = 'fa fa-external-link';
            $post_icon['text'] = esc_html__('LINK', 'cms-theme-framework');
            break;
        case 'quote':
            $post_icon['icon'] = 'fa fa-quote-left';
            $post_icon['text'] = esc_html__('QUOTE', 'cms-theme-framework');
            break;
        case 'video':
            $post_icon['icon'] = 'fa  fa-youtube-play';
            $post_icon['text'] = esc_html__('VIDEO', 'cms-theme-framework');
            break;
        case 'audio':
            $post_icon['icon'] = 'fa fa-volume-up';
            $post_icon['text'] = esc_html__('AUDIO', 'cms-theme-framework');
            break;
        default:
            $post_icon['icon'] = 'fa fa-image';
            $post_icon['text'] = esc_html__('STANDARD', 'cms-theme-framework');
            break;
    }
    echo '<i class="'.$post_icon['icon'].'"></i>';
}