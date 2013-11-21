<?php 

/* Template Name: For Guestbook */ 

?>

<?php get_header( 'custom' ); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content page-content-deco default-styles">
		
			
			<h1><?php the_title(); ?></h1>
			
			
			<div class="col-left col-left-w535">
			
			
				<div class="box-for-deco">
			

					<?php the_content(); ?>
									
				
					<br class="clear-fix" />
					
					
				</div><!-- .box-for-deco -->


				<div class="box-palatino">
			

					
					<br class="clear-fix" />
					
					
				</div><!-- .box-palatino -->


			</div><!-- .col-left -->
	
			
			<div class="sidebar">
		
		
				<?php require( TEMPLATEPATH . '/modules/book-online.php' ); ?>
		
		
				<?php require( TEMPLATEPATH . '/modules/testimonials.php' ); ?>


			</div><!-- .sidebar -->
			
			
			<br class="clear-fix" />
			
		
		</div><!-- .page-content -->

		
		<br class="clear-fix" />
	
	
		<span class="deco-shadow">&nbsp;</span>
	

	</div><!-- #main-content -->


	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>


</div><!-- #content -->


<?php endif; ?>

<?php get_footer( 'custom' ); ?>