<?php 

/* Template Name: Bungalow template */ 

if ( ! isset( $_REQUEST['content'] ) || $_REQUEST['content'] != 1 || ! have_posts() ) :

	wp_redirect ( get_permalink( 11 ), 301 );
	
	exit;
	
endif;

the_post();

?>

<div id="tab-<?php echo get_the_ID(); ?>" class="bungalows-details bungalows-active default-styles">

	<h2><?php the_title(); ?></h2>

	<?php $images = getGroupOrder( 'images_image', get_the_ID() ); // Get images ?>
	
	<?php if ( get_image( 'images_image', 1, 1, 0, get_the_ID() ) != '' ) : ?>

		<div class="bungalows-gallery">
	
			<div class="carousel-container">
			
				<div id="tab-<?php echo get_the_ID(); ?>-carousel">
	
					<?php foreach ( $images as $image ) : ?>
					
						<?php
						$href	= get_image( 'images_image', $image, 1, 0, get_the_ID(), '&h=600&fltr[]=crop' );
						$src	= get_image( 'images_thumbnail', $image, 1, 0, get_the_ID(), '&w=310&h=350&fltr[]=crop' );
						if ( $src == '' ) :
							$src	= get_image( 'images_image', $image, 1, 0, get_the_ID(), '&w=310&h=350&fltr[]=crop' );
						endif;
						$title	= strip_tags( get( 'images_caption', $image, 1, 0, get_the_ID() ) );
						?>
						
						<div class="carousel-feature"><a href="#image-<?php echo $image; ?>" title="<?php echo $title; ?>"><span class="image"><img src="<?php echo $src; ?>" alt="" class="carousel-image" /></span></a></div>
					
					<?php endforeach; ?>
	
				</div><!-- #tab-<?php echo get_the_ID(); ?>-carousel -->
	
			</div><!-- .carousel-container -->

		</div><!-- .bungalows-gallery -->
		
		<div class="bungalows-images-links">

		<?php foreach ( $images as $image ) : ?>
		
			<?php
			$href	= get_image( 'images_image', $image, 1, 0, get_the_ID(), '&h=600&fltr[]=crop' );
			$src	= get_image( 'images_image', $image, 1, 0, get_the_ID(), '&h=100&fltr[]=crop' );
			$title	= strip_tags( get( 'images_caption', $image, 1, 0, get_the_ID() ) );
			?>
			
			<a href="<?php echo $href; ?>" title="<?php echo $title; ?>" id="image-<?php echo $image; ?>" class="image-link"><img src="<?php echo $src; ?>" alt="" /></a>
		
		<?php endforeach; ?>
		
		</div><!-- .bungalows-images-links -->
		
		<script type="text/javascript">
		
			//<![CDATA[
			
			jQuery( document ).ready( function () {
										   
				jQuery( '#tab-<?php echo get_the_ID(); ?>-carousel' ).featureCarousel( {
					trackerSummation	: false,
					trackerIndividual	: false,
					clickedCenter		: function( $feature ) {
						jQuery( $feature.find( 'a' ).attr( 'href' ) ).click();
					}					
				} );
				
				jQuery( '.image-link' ).click( function() { return false; } );
				jQuery( '.image-link' ).fancybox( { titlePosition : 'over' } );
			
			} );
			
			//]]>
		
		</script>
	
	<?php endif; ?>

	<?php the_content(); ?>

	<br class="clear-fix" />
	
</div><!-- #tab-<?php echo get_the_ID(); ?> .bungalows-details -->
