<?php /* Template Name: Bungalows template */ ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="content">


	<div id="main-content">
	
	
		<div class="page-content default-styles">
		
			
			<?php the_content(); ?>
			
			
			<br class="clear-fix" />
			
		
		</div><!-- .page-content -->

		
		<br class="clear-fix" />
	

		<?php $bungalows = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->posts . ' WHERE post_parent = ' . get_the_ID() . ' AND post_type = "page" ORDER BY menu_order', 'OBJECT' ); ?>
		
		<?php if ( $bungalows ) : ?>
		
			<div id="bungalows-wrapper">

				<ul id="bungalows-nav">
				
					<?php foreach ( $bungalows as $bungalow ) : ?>
					
					<li><a href="<?php echo get_permalink( $bungalow->ID ); ?>"><?php echo $bungalow->post_title; ?></a></li>
					
					<?php endforeach; ?>
					
				</ul>
				
				<div class="bungalow-content">
				
					<div id="bungalow-ajax">&nbsp;</div>
					<!-- #bungalow-ajax -->
					
					<span id="loading">loading...</span>
						
				</div><!-- .bungalow-content -->
			
			</div><!-- #bungalows-wrapper -->
			
		<?php endif; ?>


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

	
		<span class="deco-shadow">&nbsp;</span>
	

	</div><!-- #main-content -->


	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>


</div><!-- #content -->


<?php endif; ?>

<?php get_footer(); ?>