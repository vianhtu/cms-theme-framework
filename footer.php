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
global $smof_data;
?>
        </div><!-- #main -->
			<footer>
                <div id="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-5'); ?></div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-6'); ?></div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-7'); ?></div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-8'); ?></div>
                        </div>
                    </div>
                </div>
                <div id="footer-bottom">
                     <div class="container">
                         <div class="row">
                             <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-9'); ?></div>
                             <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-10'); ?></div>
                         </div>
                     </div>
                </div>
		</footer><!-- #site-footer -->
	</div><!-- #page -->
    <div id="back_to_top" class="back_to_top">
	   <span class="go_up"><i style="" class="fa fa-arrow-up"></i></span>
	</div><!-- #back-to-top -->
	<?php wp_footer(); ?>
</body>
</html>