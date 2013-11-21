<?php 

/* Template Name: Other Attrations template */ 

?>

<?php get_header( 'custom' ); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content default-styles">
		
			
			<h1><?php the_title(); ?></h1>
			
			
			<div class="col-left col-left-w535">
			
			
			

					<?php the_content(); ?>
									
				
					<br class="clear-fix" />
					
				


				<div class="box-palatino">
			

					

					<?php $attractions = getGroupOrder( 'attrations_name', get_the_ID() ); // Get attractions ?>
					

					<?php if ( get( 'attrations_name' ) != '' ) :
echo "<p>For more information on any of the locations below, click on the corresponding image.</p>";

 ?>
					
					<div class="attractions-list">
					
						<ul>
					
						<?php foreach ( $attractions as $attraction ) : ?>
						
							<li>
							
								<a href="<?php echo get( 'attrations_link', $attraction ); ?>" rel="nofollow" target="_blank">
								
								<strong><?php echo get( 'attrations_name', $attraction ); ?></strong>
								
								<?php echo get( 'attrations_summary', $attraction ); ?> 

								<img src="<?php echo get_image( 'attrations_image', $attraction, 1, 0, get_the_ID(), '&w=58&h=58&fltr[]=crop' ); ?>" alt="" />
								
								</a>
								
							</li>
						
						<?php endforeach; ?>
						
						</ul>
						
						<br class="clear-fix" />
					
					</div><!-- .attractions-list -->
						
					<?php endif; ?>

					
					<?php echo get( 'more_info' ); ?>
				
				
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