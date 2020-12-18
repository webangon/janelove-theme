<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
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
 
<div class="comments xld-comment-wrap">

	<?php if ( have_comments() ) : ?>
	  <div class="comment-wrap">
		<div class="title">
			<h3 class="comments-heading"><?php comments_number(esc_attr__('No comments', 'janelove'), esc_attr__('1 comment', 'janelove'), esc_attr__('% comments', 'janelove')); ?>
				
			</h3>
		</div> 

		<ol class="comment-list">
			<?php wp_list_comments( 'callback=janelove_comment_callback&reply_text=Reply' ); ?>
		</ol><!-- .comment-list -->

		<?php janelove_comment_nav(); ?>
      </div>
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_attr_e( 'Comments are closed.', 'janelove' ); ?></p>
	<?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
		'author' => '<div class="comment-form-author"><label for="author"><span class="screen-reader-text">' . esc_attr__( 'Name *'  , 'janelove' ) . '</span></label><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( 'Enter Name here...'  , 'janelove' ) . '"/></div>',
		'email'  => '<div class="comment-form-email"><label for="email"><span class="screen-reader-text">' . esc_attr__( 'Email *'  , 'janelove' ) . '</span></label><input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( 'Enter email here...'  , 'janelove' ) . '"/></div>',
		'url'  => '<div class="comment-form-url"><label for="url"><span class="screen-reader-text">' . esc_attr__( 'Website *'  , 'janelove' ) . '</span></label><input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Enter Your Website...'  , 'janelove' ) . '"/></div>',
				
	);
	$required_text = esc_attr__(' Required fields are marked ', 'janelove').' <span class="required">*</span>';
	?>
	<?php comment_form( array( 
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' , 'janelove' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a> <a href="%3$s" title="Log out of this account">Log out?</a>'  , 'janelove' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'comment_notes_before' => '',
		'title_reply' => esc_attr__( 'Leave a Comment'  , 'janelove' ),
		'title_reply_to' => esc_attr__( 'Leave a reply to %s'  , 'janelove' ),
		'cancel_reply_link' => esc_attr__( 'Cancel reply'  , 'janelove' ) . '',
		'label_submit' => esc_attr__( 'Post Comment'  , 'janelove' ),
		'comment_field' => '<div class="comment-form-comment"><label for="comment"><span class="screen-reader-text">' . esc_attr__( 'Comment *'  , 'janelove' ) . '</span></label><textarea id="comment" class="form-control-textarea" name="comment" rows="8" aria-required="true" placeholder="' . esc_attr__( 'Enter Comment here...'  , 'janelove' ) . '"></textarea></div>',
	)); 
	?>	

</div><!-- #comments -->

