<?php 

/* Template Name: Bungalows template Copy */ 

?>

<?php get_header( 'custom' ); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content default-styles">
		
			
			<h1><?php the_title(); ?></h1>
			
			
			<!-- div class="col-left" -->
			
	
				<?php the_content(); ?>


				<br class="clear-fix" />

	
				<?php $bungalows = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->posts . ' WHERE post_parent = ' . get_the_ID() . ' AND post_type = "page" ORDER BY menu_order', 'OBJECT' ); ?>
				
				<?php if ( $bungalows ) : ?>
				
				<ul id="bungalows-nav" style="padding-top: 50px;">
				
					<?php foreach ( $bungalows as $bungalow ) : ?>
					
					<li><a href="<?php echo get_permalink( $bungalow->ID ); ?>"><?php echo $bungalow->post_title; ?></a></li>
					
					<?php endforeach; ?>
					
				</ul>

				<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/jquery.featureCarousel.min.js"></script>
		
				<script type="text/javascript" src="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
				
				<script type="text/javascript" src="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		
				<script type="text/javascript">
				
					//<![CDATA[
					
					jQuery( document ).ready( function () {
												   
						jQuery( '#bungalows-nav a' ).click( function () {
							var bungalow	= jQuery( this ).parent( 'li' );
							//jQuery( 'html' ).animate( { scrollTop : 0 }, 'slow' );
							jQuery( '#loading' ).show();
							jQuery( '#bungalow-ajax' ).fadeOut();
							jQuery.get( bungalow.find( 'a' ).attr( 'href' ), '&content=1', function ( data ) {
								jQuery( '#bungalows-nav .active' ).removeClass( 'active' );
								bungalow.addClass( 'active' );
								jQuery( '#bungalow-ajax' ).html( data );
								jQuery( '#bungalow-ajax' ).fadeIn();
								jQuery( '#loading' ).hide();
							} );
							return false;
						} );
						
						var bungalow	= jQuery( '#bungalows-nav li:first' );
						jQuery( '#loading' ).show();
						jQuery( '#bungalow-ajax' ).fadeOut();
						jQuery.get( bungalow.find( 'a' ).attr( 'href' ), '&content=1', function ( data ) {
							bungalow.addClass( 'active' );
							jQuery( '#bungalow-ajax' ).html( data );
							jQuery( '#bungalow-ajax' ).fadeIn();
							jQuery( '#loading' ).hide();
						} );
					
					} );
					
					//]]>
				
				</script>
					
				<?php endif; ?>
				
				
			<!-- </div> .col-left -->
	
			
			<!-- div class="sidebar" -->
		
		
				<?php // require( TEMPLATEPATH . '/modules/book-online.php' ); ?>
		
		
				<!-- div id="call-us" class="box box-center">
				
					<p><em>Or call us!</em><br /> <strong>202-439-7929</strong><br /> Lisa and David Rosenstein</p>
					
				</div><!-- #call-us .box 


			</div>  .sidebar -->
			
			
			<br class="clear-fix" />
			
		
		</div><!-- .page-content -->

		
		<br class="clear-fix" />
	

		<?php if ( $bungalows ) : ?>
		
		<div id="bungalows-wrapper">

			<div class="bungalow-content">
			
				<div id="bungalow-ajax">&nbsp;</div>
				<!-- #bungalow-ajax -->
				
				<span id="loading">loading...</span>
					
			</div><!-- .bungalow-content -->
		
		</div><!-- #bungalows-wrapper -->
			
		<?php endif; ?>

	
		<span class="deco-shadow">&nbsp;</span>
	

	</div><!-- #main-content -->


	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>


</div><!-- #content -->


<?php endif; ?>

<?php get_footer( 'custom' ); ?>