<?php
/**
 * The template for displaying Search Results pages
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/* get side-bar position. */
$_get_sidebar = et3_theme_framework_archive_sidebar();

get_header(); ?>

<section id="primary" class="container">
    <div class="row <?php echo esc_attr($_get_sidebar); ?>">
        <div class="<?php et3_theme_framework_archive_class(); ?>">
            <main id="main" class="site-main" role="main">

            <?php if ( have_posts() ) :

                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    get_template_part( 'single-templates/content/content' );

                endwhile;

                /* get paging_nav. */
                et3_theme_framework_paging_nav();

            else :

                get_template_part( 'single-templates/search', 'not-found' );

            endif; ?>

            </main><!-- #content -->
        </div><!-- #primary -->

        <?php
        if($_get_sidebar != 'is-sidebar-full'):
            get_sidebar();
        endif; ?>

    </div>
</section>

<?php get_footer(); ?>