<?php if ( have_posts() ) : ?>

	<?php $first = TRUE; while ( have_posts() ) : the_post(); ?>
	
	<div class="post<?php echo ( $first ? ' post-first' : '' ); $first = FALSE; ?>">
	
		<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<p class="by">By <?php the_author(); ?></p>
		
		<div class="summary">
	
			<?php if ( has_post_thumbnail() ) : ?>
			
				<p class="thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></p>
	
			<?php endif; ?>
		
			<?php the_excerpt(); ?>
		
			<br class="clear-fix" />
		
		</div><!-- .summary -->
		
		<div class="functions">
	
			<p class="share"><a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open( this, '', '<?php the_permalink(); ?>', '<?php the_title(); ?>')" onmouseout="addthis_close();" onclick="return addthis_sendto();">Share</a></p>
			
			<p class="comments"><?php comments_popup_link( '0 comments', '1 comment ', '% comments' ); ?></p>
	
			<p class="read-more"><a href="<?php the_permalink(); ?>">Read the article</a></p>
			
			<br class="clear-fix" />
	
		</div><!-- .functions -->
	
	</div><!-- .post -->
			
	<?php endwhile; // End the loop. Whew. ?>
	
<?php else : ?>

	<?php require( 'modules/empty.php' ); ?>
	
<?php endif; ?>