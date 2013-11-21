<?php /* Template Name: Page with slider template */ ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content default-styles">
		
			
			<div id="page-slider">
			
				<div class="slides_container">
		
					<?php $slider = getFieldOrder( 'slider_image', 1, get_the_ID() ); // Get slider ?>
				
					<?php foreach ( $slider as $slide ) : ?>
					
						<div class="slide">
				
						<span class="image"><img src="<?php echo get_image( 'slider_image', 1, $slide, 0, get_the_ID(), '&h=365&fltr[]=crop' ); ?>" alt="" /></span>

						</div><!-- .slide -->
					
					<?php endforeach; ?>
		
				</div><!-- .slides_container -->
			
			</div><!-- #page-slider -->

			<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/slides.min.jquery.js"></script>
			
			<script type="text/javascript">
			
				//<![CDATA[
				
				jQuery( document ).ready( function () {
											   
					jQuery( '#page-slider' ).slides( {
						preload				: true,
						preloadImage		: '<?php echo get_bloginfo( 'template_url' ); ?>/media/loading.gif',
						generatePagination	: false,
						effect				: 'fade',
						crossfade			: true,
						fadeSpeed			: 3000,
						play				: 3000,
						pause				: 3000
					} );
				
				} );
				
				//]]>
			
			</script>
			
			
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