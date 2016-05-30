<?php
/**
 * The Template for displaying all single posts
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/* get side-bar position. */
$_get_sidebar = et3_theme_framework_post_sidebar();

get_header(); ?>

<div id="primary" class="container">
    <div class="row <?php echo esc_attr($_get_sidebar); ?>">
        <div class="<?php et3_theme_framework_post_class(); ?>">
            <main id="main" class="site-main" role="main">

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the single content template.
                    get_template_part( 'single-templates/single/content', get_post_format() );

                    // Get single post nav.
                    et3_theme_framework_post_nav();

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                    // End the loop.
                endwhile;
                ?>

            </main>
        </div><!-- #main -->

        <?php
        if($_get_sidebar != 'is-sidebar-full'):
            get_sidebar();
        endif; ?>

    </div>
</div><!-- #primary -->

<?php get_footer(); ?>