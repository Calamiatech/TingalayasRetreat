<?php

if ( ! function_exists ( 'custom_comment' ) ) :
	
	function	custom_comment ( $comment, $args, $depth ) {
		
		$GLOBALS['comment'] = $comment;
		
		switch ( $comment -> comment_type ) :
			
			case '' :
		
		?>
		
		<li <?php comment_class (); ?> id="li-comment-<?php comment_ID (); ?>">
			
			<div id="comment-<?php comment_ID (); ?>">
			
			<div class="comment-author vcard">
				
				<?php echo get_avatar ( $comment, 40 ); ?>
				
				<?php printf ( __ ( '%s <span class="says">says:</span>' ), sprintf ( '<strong><cite class="fn">%s</cite></strong>', get_comment_author_link () ) ); ?>
			
			</div>
			<!-- .comment-author .vcard -->
			
			<?php if ( $comment -> comment_approved == '0' ) : ?>
			
				<em><?php _e ( 'Your comment is awaiting moderation.' ); ?></em>
				
				<br />
			
			<?php endif; ?>
	
			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url ( get_comment_link ( $comment -> comment_ID ) ); ?>">
				
				<?php printf ( __ ( '%1$s at %2$s' ), get_comment_date (),  get_comment_time () ); ?></a><?php edit_comment_link ( __ ( '(Edit)' ), ' ' ); ?>
				
			</div>
			<!-- .comment-meta .commentmetadata -->
	
			<div class="comment-body"><?php comment_text (); ?></div>
	
			<div class="reply">
				
				<?php comment_reply_link ( array_merge ( $args, array ( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			
			</div>
			<!-- .reply -->
		
		</div>
		<!-- #comment-##  -->
	
		<?php
				break;
			case 'pingback'  :
			case 'trackback' :
		?>
		
		<li class="post pingback">
			
			<p><?php _e ( 'Pingback:' ); ?> <?php comment_author_link (); ?><?php edit_comment_link ( __ ( '(Edit)' ), ' ' ); ?></p>
		
		<?php
				break;
		endswitch;
		
	}
	
endif;

?>