<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div><?php cms_post_detail(); ?></div>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
        <?php the_post_thumbnail(); ?>
		<?php the_content(); ?>
	</div>
	<!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', THEMENAME ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- .entry-meta -->
</article>
<!-- #post -->
