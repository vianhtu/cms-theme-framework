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

/* get side-bar position. */
$_get_sidebar = et3_theme_framework_archive_sidebar();

get_header(); ?>

<section id="primary" class="container">
	<div class="row <?php echo esc_attr($_get_sidebar); ?>">
		<div class="<?php et3_theme_framework_archive_class(); ?>">
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

		<?php
		if($_get_sidebar != 'is-sidebar-full'):
			get_sidebar();
		endif; ?>

	</div>
</section><!-- #primary -->

<?php get_footer(); ?>