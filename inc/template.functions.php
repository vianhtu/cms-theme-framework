<?php
/**
 * Page title template
 * @since 1.0.0
 * @author Fox
 */
function cms_page_title(){
    global $smof_data, $cms_meta;
    
    /* page options */
    if(isset($cms_meta->_cms_page_title) && $cms_meta->_cms_page_title){
        if(isset($cms_meta->_cms_page_title_type)){
            $smof_data['page_title_layout'] = $cms_meta->_cms_page_title_type;
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
                    <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
                    <?php
                    break;
                case '2':
                    ?>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
                    <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <?php          
                    break;
                case '3':
                    ?>
                    <div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
                    <?php
                    break;
                case '4':
                    ?>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
                    <div id="page-title-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <?php
                    break;
                case '5':
                    ?>
                    <div id="page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1><?php CMSSuperHeroes_Base::getPageTitle(); ?></h1></div>
                    <?php
                    break;
                case '6':
                    ?>
                    <div id="breadcrumb-text" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php CMSSuperHeroes_Base::getBreadCrumb(); ?></div>
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
 * Get Header Layout.
 * 
 * @author Fox
 */
function cms_header(){
    global $smof_data, $cms_meta;
    /* header for page */
    if(isset($cms_meta->_cms_header) && $cms_meta->_cms_header){
        if(isset($cms_meta->_cms_header_layout)){
            $smof_data['header_layout'] = $cms_meta->_cms_header_layout;
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
function cms_menu_location($option = '_cms_primary'){
    global $cms_meta;
    /* get menu id from page setting */
    return (isset($cms_meta->$option) && $cms_meta->$option) ? $cms_meta->$option : null ;
}

/**
 * Add page class
 * 
 * @author Fox
 * @since 1.0.0
 */
function cms_page_class(){
    global $smof_data;
    
    $page_class = '';
    /* check boxed layout */
    if($smof_data['body_layout']){
        $page_class = 'cs-boxed';
    } else {
        $page_class = 'cs-wide';
    }
    
    echo apply_filters('cms_page_class', $page_class);
}

/**
 * Add main class
 * 
 * @author Fox
 * @since 1.0.0
 */
function cms_main_class(){
    global $cms_meta;
    
    $main_class = '';
    /* chect content full width */
    if(isset($cms_meta->_cms_full_width) && $cms_meta->_cms_full_width){
        /* full width */
        $main_class = "no-container";
    } else {
        /* boxed */
        $main_class = "container";
    }
    
    echo apply_filters('cms_main_class', $main_class);
}

/**
 * Single detail
 *
 * @author Fox
 * @since 1.0.0
 */
function cms_single_detail(){
    
}

/**
 * Archive detail
 * 
 * @author Fox
 * @since 1.0.0
 */
function cms_archive_detail(){
    ?>
    <ul>
        <li class="detail-date"><i class="fa fa-calendar-o"></i> <a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d'));?>"><?php echo get_the_date(get_option('date_format', 'Y/m/d'));?></a></li>
        <li class="detail-author"><i class="fa fa-user"></i> <?php _e('BY', THEMENAME); ?> <?php the_author_posts_link(); ?></li>
        <?php if(has_category()): ?>
        <li class="detail-terms"><?php the_terms( get_the_ID(), 'category', '<i class="fa fa-folder"></i>'.__(' POSTED IN ', THEMENAME), ' / ' ); ?></li>
        <?php endif; ?>
        <?php if(has_tag()): ?>
        <li class="detail-tags"><?php the_tags('<i class="fa fa-tags"></i>'.__(' TAGS ', THEMENAME), ' / ' ); ?></li>
        <?php endif; ?>
        <li class="detail-comment"><i class="fa fa-comment"></i> <?php _e('WITH', THEMENAME); ?> <a href="<?php the_permalink(); ?>"><?php echo comments_number('0','1','%'); ?> <?php _e('Comments', THEMENAME); ?></a></li>
    </ul>
    <?php
}

/**
 * Archive readmore
 * 
 * @author Fox
 * @since 1.0.0
 */
function cms_archive_readmore(){
    echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'" >'.__('Read More', THEMENAME).'</a>';
}

/**
 * Media Audio.
 * 
 * @param string $before
 * @param string $after
 */
function cms_archive_audio() {
    /* get shortcode audio. */
    $shortcode = CMSSuperHeroes_Base::getShortcodeFromContent('audio', get_the_content());
    
    if($shortcode != ''){
        echo do_shortcode($shortcode);
    } else {
        if(has_post_thumbnail()){
            the_post_thumbnail();
        }
    }
    
}

/**
 * Media Video.
 *
 * @param string $before
 * @param string $after
 */
function cms_archive_video() {
    
    global $wp_embed;
    /* Get Local Video */
    $local_video = CMSSuperHeroes_Base::getShortcodeFromContent('video', get_the_content());
    
    /* Get Youtobe or Vimeo */
    $remote_video = CMSSuperHeroes_Base::getShortcodeFromContent('embed', get_the_content());
    
    if($local_video){
        /* view local. */
        echo do_shortcode($shortcode);
    } elseif ($remote_video) {
        /* view youtobe or vimeo. */
        echo $wp_embed->run_shortcode($shortcode);
    } elseif (has_post_thumbnail()) {
        /* view thumbnail. */
        the_post_thumbnail();
    }
    
}

/**
 * Gallerry Images
 * 
 * @author Fox
 * @since 1.0.0
 */
function cms_archive_gallery(){
    /* get shortcode gallery. */
    $shortcode = CMSSuperHeroes_Base::getShortcodeFromContent('gallery', get_the_content());
    
    if($shortcode != ''){
        preg_match('/\[gallery.*ids=.(.*).\]/', $shortcode, $ids);
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
                		<img style="width:100%;" data-src="holder.js" src="<?php echo $attachment_image[0];?>" alt="" />
                	</div>
                <?php $i++; endif; ?>
            <?php endforeach; ?>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    		    <span class="ion-ios7-arrow-left"></span>
    		</a>
    		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    		    <span class="ion-ios7-arrow-right"></span>
    		</a>
    	</div>
        <?php
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
function cms_archive_quote() {
    /* get text. */
    preg_match('/\<blockquote\>(.*)\<\/blockquote\>/', get_the_content(), $blockquote);
    
    if(!empty($blockquote[0])){
        echo '<blockquote>'.$blockquote[0].'</blockquote>';
    } else {
        if(has_post_thumbnail()){
            the_post_thumbnail();
        }
    }
}