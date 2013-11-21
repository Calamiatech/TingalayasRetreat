<?php get_header(); ?>

<div id="main-content-wrapper" class="blog">


	<div class="main-content default-style">
	
	
		<?php if ( have_posts() ) : the_post(); ?>
		
		<div class="post post-first post-single">
		
			<h1><?php the_title(); ?></h1>
			
			<p class="by">By <?php the_author(); ?></p>
			
			<div class="summary">
			
				<?php the_content(); ?>
			
				<br class="clear-fix" />
			
			</div><!-- .summary -->
			
			<div class="functions">
		
				<p class="share"><a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open ( this, '', '<?php the_permalink (); ?>', '<?php the_title (); ?>')" onmouseout="addthis_close ();" onclick="return addthis_sendto ();">Share</a></p>
	
				<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e5faecc2c1ac9e7"></script>
		
				<br class="clear-fix" />
		
			</div><!-- .functions -->
			
			<div id="comments">
			
				<?php comments_template( '', true ); ?>
			
			</div><!-- #comments -->
		
		</div><!-- .post -->
		
		<?php endif; ?>
		
	
	</div><!-- .main-content -->
	

	<div class="main-content right-content default-style">
	
		<?php get_sidebar(); ?>
			
	</div><!-- .main-content .default-style -->
	
	
	<br class="clear-fix" />
	

</div><!-- #main-content-wrapper -->

<?php get_footer(); ?>