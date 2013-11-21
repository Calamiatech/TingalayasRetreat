<?php 

/* Template Name: Home template */ 

?>

<?php get_header( 'custom' ); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="banner">


	<div id="main-pic">
	

		<p class="pic-wrapper">
		
			<img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/s-01.jpg" alt="" />
			
			<span class="deco-shadow">&nbsp;</span>
			
			<span class="deco-top-shadow">&nbsp;</span>
			
			<span class="deco-right-shadow">&nbsp;</span>
			
			<span class="deco-left-shadow">&nbsp;</span>
			
			<span class="deco-bottom-shadow">&nbsp;</span>
			
		</p>

		<p class="pic-caption">Imagine waking up to the smell of freshly brewed Jamaican Blue Mountain coffee and a breakfast which might include organic food grown a few feet from where you are dining.</p>

	
	</div><!-- #main-pic -->
	

	<div id="slider">

		<div class="slides_container">

			<?php 
			$slider = getGroupOrder( 'slider_image', get_the_ID() ); // Get slider 
			$count 	= 0;
			$open	= FALSE;
			$first	= TRUE;
			?>
		
			<?php foreach ( $slider as $slide ) : $count ++; ?>
			
				<?php
				$href	= get_image( 'slider_image', $slide, 1, 0, get_the_ID(), '&h=355&fltr[]=crop' );
				$src	= get_image( 'slider_thumbnail', $slide, 1, 0, get_the_ID(), '&h=57&fltr[]=crop' );
				if ( $src == '' ) :
					$src	= get_image( 'slider_image', $slide, 1, 0, get_the_ID(), '&h=57&fltr[]=crop' );
				endif;
				$title	= strip_tags( get( 'slider_caption', $slide, 1, 0, get_the_ID() ) );
				?>
				
				<?php if ( $open === FALSE ) : $open = TRUE; ?>
				<div class="slide">
				<?php endif; ?>
		
				<a href="<?php echo $href; ?>" title="<?php echo $title; ?>" class="pic<?php echo ( $first ? ' pic-active' : '' ); $first = FALSE; ?>"><span class="image"><img src="<?php echo $src; ?>" alt="" /></span><span class="deco">&nbsp;</span></a>

				<?php if ( $open === TRUE && $count == 5 ) : $open = FALSE; $count = 0; ?>
				</div><!-- .slide -->
				<?php endif; ?>
			
			<?php endforeach; ?>

			<?php if ( $open === TRUE ) : $open = FALSE; ?>
			</div><!-- .slide -->
			<?php endif; ?>
		
		</div><!-- .slides_container -->
		
		<a href="#" class="prev"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/arrows-left.png"  alt="Previvous" /></a>
		
		<a href="#" class="next"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/arrows-right.png"  alt="Next" /></a>
	
	</div><!-- #slider -->


	<div id="main-slider">

		<div class="slides_container">

			<?php 
			$slider = getGroupOrder( 'slider_image', get_the_ID() ); // Get slider 
			$count 	= 0;
			?>
		
			<?php foreach ( $slider as $slide ) : $count ++; ?>
			
				<?php
				$href	= get_image( 'slider_image', $slide, 1, 0, get_the_ID(), '&h=355&fltr[]=crop' );
				$title	= strip_tags( get( 'slider_caption', $slide, 1, 0, get_the_ID() ) );
				?>
				
				<a href="<?php 			
			jQuery( '#slider .pic' ).click( function() {
				var pic 	= new Image(),
					src		= jQuery( this ).attr( 'href' ),
					title	= jQuery( this ).attr( 'title' );
					current	= jQuery( this );
				jQuery( '#banner-loading' ).show();
				pic.onload 	= function() {
					jQuery( '#slider .pic-active' ).removeClass( 'pic-active' );
					current.addClass( 'pic-active' );
					jQuery( '#main-pic img' ).attr( 'src', src );
					jQuery( '#main-pic .pic-caption' ).html( title );
					jQuery( '#banner-loading' ).hide();
				};
   				pic.src 	= src;
				return false;
			} );
			
		} );
		
		//]]>
	
	</script>

	<span id="banner-loading">loading...</span>
	
</div><!-- #banner -->


<hr />
			

<div id="content">


	<div id="main-content">
	
	
		<div id="photo-gallery" class="home-box">
		
			
			<h3>Photo Gallery</h3>
		
			<p class="pic"><a href="<?php echo get_permalink( 10 ); ?>"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/pg.jpg" alt="" /></a></p>
		
		
		</div><!-- #photo-gallery -->
	
	
		<div id="video-tour" class="home-box">
		
			
			<h3>Video Tour</h3>
		
			<p class="pic"><a href="<?php echo get_permalink( 10 ); ?>"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/vt.jpg" alt="" /></a></p>
		
		
		</div><!-- #video-tour -->
	
	
		<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>
		
		
		<div id="default-content">
		
			
			<?php the_content(); ?>
		
		
		</div><!-- #default-content -->
	

	</div><!-- #main-content -->


	<div class="sidebar">


		<?php require( TEMPLATEPATH . '/modules/book-online.php' ); ?>


		<?php require( TEMPLATEPATH . '/modules/testimonials-home.php' ); ?>


	</div><!-- .sidebar -->
	
	
	<br class="clear-fix" />


</div><!-- #content -->


<?php endif; ?>

<?php get_footer( 'custom' ); ?>
echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
			
			<?php endforeach; ?>
		
		</div><!-- .slides_container -->
	
	</div><!-- #main-slider -->
	
	<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/slides.min.jquery.js"></script>
	
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

			jQuery( '#main-slider' ).slides( {
				preload				: false,
				generatePagination	: false,
				play				: 5000
				animationComplete	: function( current ) {
					// Get the "current" slide number
					// console.log(current);
					var pic 	= new Image(),
						src		= current.attr( 'href' ),
						title	= current.attr( 'title' );
					jQuery( '#banner-loading' ).show();
					pic.onload 	= function() {
						jQuery( '#slider .pic-active' ).removeClass( 'pic-active' );
						jQuery( '#slider .pic' ).find( '[href="' + src + '"]' ).addClass( 'pic-active' );
						jQuery( '#main-pic img' ).attr( 'src', src );
						jQuery( '#main-pic .pic-caption' ).html( title );
						jQuery( '#banner-loading' ).hide();
					};
					pic.src 	= src;
		        }
			} );
