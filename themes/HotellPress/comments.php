<?php 

if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) : 

	die( 'You can not access this page directly!' );

endif;

?>

<div class="comments-wrapper">

	<h3><?php comments_number( 'No comments', 'One comment', '% comments' ); ?></h3>
	
	<?php if ( $comments ) : ?> 
	
		<ol>
		
			<?php foreach ( $comments as $comment ) : ?>
		
			<li id="comment-<?php comment_ID(); ?>">
	
				<?php if ( $comment->comment_approved == '0' ) : ?>
		
				<p class="awaiting-approval"><strong>Your comment is awaiting approval.</strong></p>  
	
				<?php endif; ?>
				
				<?php comment_text(); ?>
				
				<cite><em><?php comment_type(); ?> by <strong><?php comment_author_link(); ?></strong> on <strong><?php comment_date(); ?></strong> at <strong><?php comment_time(); ?></strong></em> <?php edit_comment_link( $link_text, $before_link, $after_link ); ?></cite>
				
			</li>  
	
			<?php endforeach; ?>
			
		</ol>
		
	<?php else : ?>
	
		<p>No comments yet.</p>
		
	<?php endif; ?>  
		
	<?php if ( comments_open() ) : ?>
	
		<h3>Leave a reply</h3>
	
		<?php if ( get_option( 'comment_registration' ) && ! $user_ID ) : ?>
	
			<p>You must be <a href="<?php echo get_option( 'siteurl' ) . '/wp-login.php?redirect_to=' . urlencode( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	
		<?php else : ?>
	
			<form action="<?php echo get_option( 'siteurl' ) . '/wp-comments-post.php'; ?>" method="post" id="commentform" class="default-form">
			
				<fieldset>
			
					<?php if ( $user_ID ) : ?>
			
						<p>Logged in as <a href="<?php echo get_option( 'siteurl' ) . '/wp-admin/profile.php'; ?>"><?php echo $user_identity;?></a>. <a href="<?php echo get_option( 'siteurl' ) . '/wp-login.php?action=logout'; ?>" title="Log out of this account">Log out &raquo;</a></p>		
	
					<?php else : ?>
					
						<p>
			
							<label>Name <?php echo ( $req ? '<strong>*</strong>' : '' ); ?></label>
				
							<span class="field-input"><input type="text" name="author" value="<?php echo $comment_author; ?>" /></span>
							
						</p>
			
						<p>
						
							<label>Email (will not be published) <?php echo ( $req ? '<strong>*</strong>' : '' ); ?></label>
			
							<span class="field-input"><input type="text" name="email" value="<?php echo $comment_author_email; ?>" /></span>
			
						</p>
			
						<p>
						
							<label>Website</label>
			
							<span class="field-input"><input type="text" name="url" value="<?php echo $comment_author_url; ?>" /></span>
			
						</p>
			
					<?php endif; ?>
			
					<p>
					
						<label>Comment</label>
			
						<span class="field-textarea"><textarea name="comment" cols="100" rows="10"></textarea></span>
						
					</p>
					
					<p class="button">
					
						<span><strong>*</strong> Required fields.</span>
					
						<button type="submit">Send</button>
						
					</p>
					
					<?php comment_id_fields(); ?>
					
					<?php do_action( 'comment_form', $post->ID ); ?>
					
				</fieldset>
				
			</form>
		
		<?php endif; ?>
	
	<?php else : ?>
	
		<p>The comments are closed.</p>
	
	<?php endif; ?>
	
</div><!-- .comments-wrapper -->