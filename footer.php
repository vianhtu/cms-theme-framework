<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
global $smof_data;
?>
	</div><!-- #main .wrapper -->
	<div class="<?php if(!$smof_data['footer_full_width']){ echo 'container'; }?>">
	    <div class="row">
        	<footer>
        	   <div class="<?php if($smof_data['footer_layout_full_width']){ echo 'container'; }?>">
        	   </div>
        	</footer><!-- #colophon -->
    	</div>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>