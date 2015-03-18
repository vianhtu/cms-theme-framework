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

function cms_post_detail(){
    global $smof_data, $cms_meta;
    ?>
    <ul>
        <li class="detail-date"><i class="fa fa-calendar-o"></i> <a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d'));?>"><?php the_date(get_option('date_format', 'Y/m/d'));?></a></li>
        <li class="detail-author"><i class="fa fa-user"></i> <?php _e('BY', THEMENAME); ?> <?php the_author_posts_link(); ?></li>
        <li class="detail-terms"><?php the_terms( get_the_ID(), 'category', '<i class="fa fa-folder"></i>'.__(' POSTED IN ', THEMENAME), ' / ' ); ?></li>
        <li class="detail-tags"><?php the_tags('<i class="fa fa-tags"></i>'.__(' TAGS ', THEMENAME), ' / ' ); ?></li>
        <li class="detail-comment"><i class="fa fa-comment"></i> <?php _e('WITH', THEMENAME); ?> <a href="<?php the_permalink(); ?>"><?php echo comments_number('0','1','%'); ?> <?php _e('Comments', THEMENAME); ?></a></li>
    </ul>
    <?php
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