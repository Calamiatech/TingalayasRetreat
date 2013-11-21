<?php 

/* Template Name: Contact template */ 

?>

<?php get_header( 'custom' ); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content default-styles">
		
			
			<?php 
		
			$content 	= get_the_content();
		
			$content 	= apply_filters( 'the_content', $content );
			
			$output		= file_get_contents( get_bloginfo( 'template_url' ) . '/loader.php?module=form' );
		
			$content 	= str_replace( '<p>[+Contact-form+]</p>', $output, $content );
			
			echo	$content;
		
			?>
			
			
			<br class="clear-fix" />
			
		
		</div><!-- .page-content -->

		
		<br class="clear-fix" />
	
	
		<span class="deco-shadow">&nbsp;</span>
	

	</div><!-- #main-content -->


	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>


</div><!-- #content -->


<?php endif; ?>

<?php get_footer( 'custom' ); ?>