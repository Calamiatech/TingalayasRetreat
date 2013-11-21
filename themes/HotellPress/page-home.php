<?php 

/* Template Name: Home template */ 

?>

<?php get_header( 'custom' ); ?>

<?php if ( have_posts() ) : the_post(); ?>


<div id="banner">


	<div id="main-pic">
	
		<p class="pic-wrapper">

			<?php
			$href	= get_image( 'slider_image', 1, 1, 0, get_the_ID(), '&h=355&fltr[]=crop' );
			$title	= strip_tags( get( 'slider_caption', 1, 1, 0, get_the_ID() ) );
			?>
		
			<span class="imgbg"><img src="<?php echo $href; ?>" alt="" class="somef" /></span>
			
			<span class="deco-shadow">&nbsp;</span>
			
			<span class="deco-top-shadow">&nbsp;</span>
			
			<span class="deco-right-shadow">&nbsp;</span>
			
			<span class="deco-left-shadow">&nbsp;</span>
			
			<span class="deco-bottom-shadow">&nbsp;</span>
			
		</p>

		<p class="pic-caption"><?php echo $title; ?></p>

	
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
		
				<a href="<?php echo $href; ?>" title="<?php echo $title; ?>" id="slide-img-<?php echo $slide; ?>" class="pic<?php echo ( $first ? ' pic-active' : '' ); $first = FALSE; ?>"><span class="image"><img src="<?php echo $src; ?>" alt="" /></span><span class="deco">&nbsp;</span></a>

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


	<div id="main-slider" style="display: none;">

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
				
				<a href="<?php echo $href; ?>" title="<?php echo $title; ?>" id="img-<?php echo $slide; ?>"><?php echo $count; ?></a>
			
			<?php endforeach; ?>
		
		</div><!-- .slides_container -->
	
	</div><!-- #main-slider -->
	
	<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/slides.min.jquery.js"></script>
	<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript">
	
		//<![CDATA[
		
		jQuery( document ).ready( function () {
									   
			jQuery( '#slider' ).slides( {
				preload				: true,
				preloadImage		: '<?php echo get_bloginfo( 'template_url' ); ?>/media/loading.gif',
				generatePagination	: false,
                fadeEasing			: 'easeOutQuad',
				effect				: 'slide',
				crossfade			: true,
				fadeSpeed			: 350,
				animate				: true 
			} );

			var mainSlider = jQuery( '#main-slider' ).slides( {
				preload				: false,
				generatePagination	: false,
 				effect				: 'fade',
				crossfade			: true,
				fadeSpeed			: 3000,
				play				: 3000,
				pause				: 5000,
				animationComplete	: function( current, element ) {
					
					var pic 	= new Image(),
						total	= element.find('a').length;
											
					current	= ( current <= total ? current : 0 );
					current	= jQuery( '#main-slider' ).find( 'a:eq('+ ( current - 1 ) + ')' );
					
					var src		= current.attr( 'href' ),
						title	= current.attr( 'title' ),
						id		= current.attr( 'id' );

					pic.onload 	= function() {
						jQuery( '#slider .pic-active' ).removeClass( 'pic-active' );
						jQuery( '#slider #slide-' + id ).addClass( 'pic-active' );
						jQuery( '#main-pic .imgbg' ).css( 'background', 'url("' + jQuery( '#main-pic img' ).attr( 'src' ) + '") 50% 0 no-repeat' );
						jQuery( '#main-pic img' ).hide(); 
						jQuery( '#main-pic img' ).attr( 'src', src );
						jQuery( '#main-pic img' ).fadeIn( 'slow', function() {
							jQuery( '#main-pic .pic-caption' ).html( title );
						} );
					};
					pic.src 	= src;
					
					return false;
					
		        }
			} );
			
			jQuery( '#slider .pic' ).click( function() {

				clearInterval( mainSlider.data( 'interval' ) );
				
				var pic 	= new Image(),
					src		= jQuery( this ).attr( 'href' ),
					title	= jQuery( this ).attr( 'title' );
					current	= jQuery( this );
					
				pic.onload 	= function() {

					jQuery( '#slider .pic-active' ).removeClass( 'pic-active' );
					current.addClass( 'pic-active' );
					jQuery( '#main-pic .imgbg' ).css( 'background', 'url("' + jQuery( '#main-pic img' ).attr( 'src' ) + '") 50% 0 no-repeat' );
					jQuery( '#main-pic img' ).hide(); 
					jQuery( '#main-pic img' ).attr( 'src', src );
					jQuery( '#main-pic img' ).fadeIn( 'slow', function() {
						jQuery( '#main-pic .pic-caption' ).html( title );
					} );
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
		
			<p class="pic"><a href="<?php echo get_permalink( 244 ); ?>"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/ph3.jpg" alt="" /></a></p>
		
		
		</div><!-- #photo-gallery -->
	
	
		<div id="video-tour" class="home-box">
		
			
			<h3>Video Tour</h3>
		
			<p class="pic"><a href="<?php echo get_permalink( 10 ); ?>"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/vt.jpg" alt="" /></a></p>
		
		
		</div><!-- #video-tour -->
	
	
		<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>
		
		
		<div id="default-content">
		
			
			<?php the_content(); ?>
		
		
		</div><!-- #default-content -->
<div style="width:400px; text-align:center;margin: 20px auto 0;">
<div style="
    display: inline-block;
    width: 192px;
    float: left;
">Find <a id="flipkey_best_of_property" href="http://www.flipkey.com/negril-vacation-rentals/g147313/">Negril Vacation Rentals</a> on FlipKey</div><script type="text/javascript" src="http://data.flipkey.com/widgets/jsapi/43315/4an_xx/529g_xx/"></script>
&nbsp;
<div style="
    display: inline-block;
    width: 170px;
">Find <a id="flipkey_excellence_badge" href="http://www.flipkey.com/negril-vacation-rentals/g147313/">Negril Vacation Rentals</a> on FlipKey</div><script type="text/javascript" src="http://data.flipkey.com/widgets/jsapi/43318/4an_xx/529g_xx/"></script></div>
	</div><!-- #main-content -->


	<div class="sidebar">


		<?php require( TEMPLATEPATH . '/modules/book-online.php' ); ?>


		<?php require( TEMPLATEPATH . '/modules/testimonials-home.php' ); ?>


	</div><!-- .sidebar -->
	
	
	<br class="clear-fix" />


</div><!-- #content -->


<?php endif; ?>

<?php get_footer( 'custom' ); ?>