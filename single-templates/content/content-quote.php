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

	<?php et3_theme_framework_post_quote(); ?>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

		<div class="entry-meta">

			<?php et3_theme_framework_archive_detail(); ?>

		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		the_excerpt();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cms-theme-framework' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More:', 'cms-theme-framework') ?></a>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
