<?php
/**
 * The Template for displaying all single posts
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="row">
            <div id="primary" class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div id="content" role="main">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'single-templates/single/content', get_post_format() ); ?>

                        <?php theme_framework_post_nav(); ?>

                        <?php comments_template( '', true ); ?>

                    <?php endwhile; // end of the loop. ?>

                </div><!-- #content -->
            </div><!-- #primary -->
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </main>
</div>
<?php get_footer(); ?>