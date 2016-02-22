<?php
/**
 * The template for displaying Search Results pages
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

get_header(); ?>

<section id="primary" class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <main id="main" class="site-main" role="main">

            <?php if ( have_posts() ) :

                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    get_template_part( 'single-templates/content/content' );

                endwhile;

                /* get paging_nav. */
                theme_framework_paging_nav();

            else :

                get_template_part( 'single-templates/search', 'not-found' );

            endif; ?>

            </main><!-- #content -->
        </div><!-- #primary -->
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

            <?php get_sidebar(); ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>