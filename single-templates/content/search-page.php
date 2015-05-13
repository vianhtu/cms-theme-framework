<?php
/**
 * The default template for displaying search content page.
 *
 * Used for both single and index/archive/search.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
	    <div><?php the_post_thumbnail(); ?></div>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div><?php cms_archive_detail(); ?></div>
	</div>
	<!-- .entry-header -->

	<div class="entry-content">

	</div>
	<!-- .entry-content -->

	<footer class="entry-meta">
	    <?php cms_archive_readmore(); ?>
	    <!-- .readmore link -->
		<?php edit_post_link( __( 'Edit', THEMENAME ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- .entry-meta -->
</article>
<!-- #post -->
