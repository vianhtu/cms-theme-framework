<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>
    </div><!-- .site-content -->
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cms-theme-framework' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'cms-theme-framework' ), 'WordPress' ); ?></a>
        </div><!-- .site-info -->
    </footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>