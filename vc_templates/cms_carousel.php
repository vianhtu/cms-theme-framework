<div class="cms-carousel <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    $posts = $atts['posts'];
    while($posts->have_posts()){
        $posts->the_post();
        ?>
        <div class="cms-carousel-item">
            
            <div class="cms-carousel-categories">
                <?php the_content();?>
            </div>
        </div>
        <?php
    }
    ?>
</div>