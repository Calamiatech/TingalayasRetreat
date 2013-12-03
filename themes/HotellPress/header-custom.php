<?php  define( 'SECURE', 'Secure init' ); // Security var ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<html <?php language_attributes(); ?>>


	<head profile="http://gmpg.org/xfn/11">


		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo get_bloginfo( 'charset' ); ?>" />


		<?php wp_head(); ?>
		
<?php if(is_home() || is_front_page()){
      // 
    } else {
        
?>
<script type="text/javascript">
	jQuery(document).ready(function($){	
	     var select = $('a[href$=".bmp"],a[href$=".gif"],a[href$=".jpg"],a[href$=".jpeg"], a[href$=".png"],a[href$=".BMP"],a[href$=".GIF"],a[href$=".JPG"],a[href$=".JPEG"],a[href$=".PNG"]');

		select.lightPin();
	});

</script>
<?php      }
 ?>


		
		<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/jquery.js"></script>
		
		<script type="text/javascript" src="<?php echo TEMPLATE_URL?>/js/jquery.ui.datepicker.js"></script>

		<?php if ( trim( get_option( 'tgt_custom_script' ) ) != '' ) : ?>
		<script type="text/javascript" src="<?php echo get_option( 'tgt_custom_script' );?>"></script>
		<?php endif; ?>

		<script type="text/javascript">
			var img_link1 = "<?php echo TEMPLATE_URL . '/';?>";
		</script>

	<link rel="shortcut icon" href="<?php echo TEMPLATE_URL?>/favicon.ico" type="image/x-icon" />
        <link href="<?php echo TEMPLATE_URL;?>/css/jquery.lightbox.css" type="text/css" rel="stylesheet" media="all" />
        <!--
        <link href="<?php echo TEMPLATE_URL;?>/css/humanity/jquery-ui.css" type="text/css" rel="stylesheet" media="all" />
		-->
		<link href="<?php echo TEMPLATE_URL;?>/css/custom-theme/jquery-ui-1.10.3.custom.css" type="text/css" rel="stylesheet" media="all" />
        
		<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo( 'template_url' ); ?>/styles/layout.css" media="screen" />

		<link rel="stylesheet" type="text/css" href="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.fancybox-1.3.4.css" media="screen" />


		<!--[if lt IE 9]>
		
		<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/html5.js"></script>
		
		<![endif]-->

		<!--[if lt IE 8]>
		
		<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo( 'template_url' ); ?>/styles/ie7.css" media="screen" />
		
		<![endif]-->
		
		
		<?php echo strip_tags( get( 'global_settings_google_analytic', 1, 1, 0, 2 ), '<script>' ); ?>

		<script src="<?php echo TEMPLATE_URL;?>/js/jquery.lightbox.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo TEMPLATE_URL?>/js/js.js"></script>
		<script type="text/javascript" src="<?php echo TEMPLATE_URL?>/js/modal-js.js"></script>
		<?php
		add_action( 'wp_footer', 'run_script' );
		function run_script() {
		?>
		  <script src="<?php echo TEMPLATE_URL;?>/js/validation.js" type="text/javascript"></script>
		  <script type="text/javascript" src="<?php echo TEMPLATE_URL?>/js/fade_image_gallery.js"></script>
		  <?php //tgt_include_index_js() ?>
        <?php
		}
		?>

	</head>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35506005-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	<body <?php body_class(); ?>>


		<div id="bg-top">


			<div id="container">
			
			
				<div id="header">
	
	
					<?php echo ( is_front_page() ? '<h1 class="company-logo">' : '<p class="company-logo">' ); ?>
	
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="hidden-txt"><?php echo get_bloginfo( 'name' ); ?><?php echo ( $description != '' ? ' - ' . $description : '' ); ?></a>
	
					<?php echo ( is_front_page() ? '</h1>' : '</p>' ); ?>
	
	
				</div><!-- #header -->
				
				
				<hr />
						
			
				<div id="navigation">
	
	
					<?php 
					
					wp_nav_menu( 
						array( 
							'container_class' 	=> 'navigation', 
							'theme_location' 	=> 'primary',
							'link_before'		=> '',
							'link_after' 		=> ''
						) 
					); 
					
					?>
	
					
				</div><!-- #navigation -->