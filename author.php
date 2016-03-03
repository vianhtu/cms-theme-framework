<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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

				<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();

						get_template_part( 'single-templates/content/content', get_post_format() );

					endwhile; // end of the loop.

					/* blog nav. */
					et3_theme_framework_paging_nav();

				else :
					/* content none. */
					get_template_part( 'single-templates/content', 'none' );

				endif; ?>

			</main><!-- #content -->
		</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

			<?php get_sidebar(); ?>

		</div><!-- #sidebar -->
	</div>
</section><!-- #primary -->

<?php get_footer(); ?>