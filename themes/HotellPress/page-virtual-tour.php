<?php 

/* Template Name: Virtual Tour template */ 

?>

<?php get_header( 'custom' ); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content default-styles">
		

			<h1><?php the_title(); ?></h1>
			<div class="col-left col-left-w535">
			
			<div class="video-tour" style="text-align:center;">
			
				<iframe width="515" height="290" src="<?php echo get( 'youtube_video_url' ); ?>" frameborder="0" allowfullscreen></iframe>
			
			</div><!-- .video-tour -->
			
			



				<?php the_content(); ?>
							
			
			<br class="clear-fix" />
			</div>

			<div class="sidebar" style="margin-bottom: 30px;">
		
		
				<?php require( TEMPLATEPATH . '/modules/book-online.php' ); ?>
		
		
				<?php require( TEMPLATEPATH . '/modules/testimonials.php' ); ?>


			</div><!-- .sidebar -->
			
		
		</div><!-- .page-content -->

		
		<br class="clear-fix" />
	
	
		<span class="deco-shadow">&nbsp;</span>
	

	</div><!-- #main-content -->


	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>


</div><!-- #content -->


<?php endif; ?>

<?php get_footer( 'custom' ); ?>