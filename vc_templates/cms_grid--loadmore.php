<?php 
    /* get categories */
    $taxo = 'category';
    $_category = array();
    if(!isset($atts['cat']) || $atts['cat']==''){
        $terms = get_terms($taxo);
        foreach ($terms as $cat){
            $_category[] = $cat->term_id;
        }
    } else {
        $_category  = explode(',', $atts['cat']);
    }
    $atts['categories'] = $_category;
    /*ajax media*/
    wp_enqueue_style( 'wp-mediaelement' );
    wp_enqueue_script( 'wp-mediaelement' );
    /* js, css for load more */
    wp_register_script( 'cms-loadmore-js', CMS_JS.'cms_loadmore.js', array('jquery') ,'1.0',true);
    // What page are we on? And what is the pages limit?
    global $wp_query;
    $max = $wp_query->max_num_pages;
    $limit = $atts['limit'];
    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

    // Add some parameters for the JS.
    $current_id =  str_replace('-','_',$atts['html_id']);
    wp_localize_script(
        'cms-loadmore-js',
        'cms_more_obj'.$current_id,
        array(
            'startPage' => $paged,
            'maxPages' => $max,
            'total' => $wp_query->found_posts,
            'perpage' => $limit,
            'nextLink' => next_posts($max, false),
            'masonry' => $atts['layout']
        )
    );
    wp_enqueue_script( 'cms-loadmore-js' );
?>
<div class="cms-grid-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['filter']=="true" and $atts['layout']=='masonry'):?>
        <div class="cms-grid-filter">
            <ul class="cms-filter-category list-unstyled list-inline">
                <li><a class="active" href="#" data-group="all">All</a></li>
                <?php foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, $taxo );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo __($term->name, CMS_NAME);?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <div class="row cms-grid <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $size = ($atts['layout']=='basic')?'thumbnail':'medium';
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(cmsGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            ?>
            <div class="cms-grid-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <?php 
                    if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                        $class = ' has-thumbnail';
                        $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
                    else:
                        $class = ' no-image';
                        $thumbnail = '<img src="'.CMS_IMAGES.'no-image.jpg" alt="'.get_the_title().'" />';
                    endif;
                    echo '<div class="cms-grid-media '.esc_attr($class).'">'.$thumbnail.'</div>';
                ?>
                <div class="cms-grid-title">
                    <?php the_title();?>
                </div>
                <div class="cms-grid-time">
                    <?php the_time('l, F jS, Y');?>
                </div>
                <div class="cms-grid-categories">
                    <?php echo get_the_term_list( get_the_ID(), $taxo, 'Category: ', ', ', '' ); ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="cms_pagination"></div>
    <?php
    wp_reset_postdata();
    wp_reset_query();
    ?>
</div>