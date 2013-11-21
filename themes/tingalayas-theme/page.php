<?php get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content default-styles">
		
			
			<?php the_content(); ?>
			
			
			<br class="clear-fix" />
			
		
		</div><!-- .page-content -->

		
		<br class="clear-fix" />
	
	
		<span class="deco-shadow">&nbsp;</span>
	

	</div><!-- #main-content -->


	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>


</div><!-- #content -->


<?php endif; ?>

<?php get_footer(); ?>