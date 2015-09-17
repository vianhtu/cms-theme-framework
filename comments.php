<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package cshero
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
        <div class="st-comments-wrap clearfix">
            <h4 class="comments-title">
                <span><?php comments_number(__('Comments','cms-theme-framework'),__('1 Comments','cms-theme-framework'),__('% Comments','cms-theme-framework')); ?></span>
            </h4>
            <ol class="comment-list">
				<?php wp_list_comments( 'type=comment&callback=cms_comment' ); ?>
			</ol>
			<?php theme_framework_comment_nav(); ?>
        </div>
	<?php endif; // have_comments() ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name__mail' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'title_reply'       => __( '<span>Leave Your Reply</span>','cms-theme-framework'),
			'title_reply_to'    => __( 'Leave A Reply To %s','cms-theme-framework'),
			'cancel_reply_link' => __( 'Cancel Reply','cms-theme-framework'),
			'label_submit'      => __( 'SUBMIT','cms-theme-framework'),
			'comment_notes_before' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(

					'author' =>
					'<p class="comment-form-author">'.
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' placeholder="'.__('Name','cms-theme-framework').'"/></p>',

					'email' =>
					'<p class="comment-form-email">'.
					'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' placeholder="'.__('Email','cms-theme-framework').'"/></p>',
			)
			),
			'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.__('Comment','cms-theme-framework').'" aria-required="true">' .
			'</textarea></p>',
	);
	comment_form($args);
	?>

</div><!-- #comments -->
