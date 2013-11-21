<?php /* Template Name: Virtual Tour template */ ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content default-styles">
		

			<h1><?php the_title(); ?></h1>
			
			<div class="col-right">

				<?php the_content(); ?>
							
				<br class="clear-fix" />
				
			</div><!-- .col-right -->
			
			<div class="video-tour">
			
				<iframe width="340" height="191" src="<?php echo get( 'youtube_video_url' ); ?>" frameborder="0" allowfullscreen></iframe>
			
			</div><!-- .video-tour -->
			
			<br class="clear-fix" />
			
			
			<div id="image-gallery">
			
			
				<h2>Image Gallery</h2>


				<div id="slider">

					<?php 
					$slider = getGroupOrder( 'gallery_image_image', get_the_ID() ); // Get gallery images 
					$count 	= 0;
					$open	= FALSE;
					?>

					<div class="slides_container"<?php echo ( count( $slider ) > 10 ? ' style="display: none;"' : '' ); ?>>

						<?php foreach ( $slider as $slide ) : $count ++; ?>
						
							<?php
							$href	= get_image( 'gallery_image_image', $slide, 1, 0, get_the_ID(), '&h=600&fltr[]=crop' );
							$src	= get_image( 'gallery_image_thumbnail', $slide, 1, 0, get_the_ID(), '&h=57&fltr[]=crop' );
							if ( $src == '' ) :
								$src	= get_image( 'gallery_image_image', $slide, 1, 0, get_the_ID(), '&h=57&fltr[]=crop' );
							endif;
							$title	= strip_tags( get( 'gallery_image_caption', $slide, 1, 0, get_the_ID() ) );
							?>
							
							<?php if ( $open === FALSE ) : $open = TRUE; ?>
							<div class="slide">
							<?php endif; ?>
					
							<a href="<?php echo $href; ?>" title="<?php echo $title; ?>" class="pic" rel="gallery"><img src="<?php echo $src; ?>" alt="" /></a>
			
							<?php if ( $open === TRUE && $count == 10 ) : $open = FALSE; $count = 0; ?>
							</div><!-- .slide -->
							<?php endif; ?>
						
						<?php endforeach; ?>
			
						<?php if ( $open === TRUE ) : $open = FALSE; ?>
						</div><!-- .slide -->
						<?php endif; ?>
					
					</div><!-- .slides_container -->
					
					<?php if ( count( $slider ) > 10 ) : ?>
					
					<a href="#" class="prev"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/arrows-gallery-left.png"  alt="Previvous" /></a>
					
					<a href="#" class="next"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/arrows-gallery-right.png"  alt="Next" /></a>
					
					<?php endif; ?>
				
				</div><!-- #slider -->
				
				<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/slides.min.jquery.js"></script>

				<script type="text/javascript" src="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
				
				<script type="text/javascript" src="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
				
				<script type="text/javascript">
				
					//<![CDATA[
					
					jQuery( document ).ready( function () {
												   
						jQuery( '#slider' ).slides( {
							preload				: true,
							preloadImage		: '<?php echo get_bloginfo( 'template_url' ); ?>/media/loading.gif',
							generatePagination	: false,
							effect				: 'slide',
							crossfade			: true,
							fadeSpeed			: 1000
						} );
						
						jQuery( '#slider .pic' ).fancybox( { titlePosition : 'over' } );
					
					} );
					
					//]]>
				
				</script>

			
			</div><!-- .iamge-gallery -->


			<br class="clear-fix" />
			
		
		</div><!-- .page-content -->

		
		<br class="clear-fix" />
	
	
		<span class="deco-shadow">&nbsp;</span>
	

	</div><!-- #main-content -->


	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>


</div><!-- #content -->


<?php endif; ?>

<?php get_footer(); ?>