<?php  define( 'SECURE', 'Secure init' ); // Security var ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<html <?php language_attributes(); ?>>


	<head profile="http://gmpg.org/xfn/11">


		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo get_bloginfo( 'charset' ); ?>" />


		<?php wp_head(); ?>
		
		
		<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/jquery.js"></script>

		<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/jquery.featureCarousel.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo( 'template_url' ); ?>/styles/pop.css" media="screen" />


		<!--[if lt IE 9]>
		
		<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/html5.js"></script>
		
		<![endif]-->

		<!--[if lt IE 8]>
		
		<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo( 'template_url' ); ?>/styles/ie7.css" media="screen" />
		
		<![endif]-->
		
		
		<?php echo strip_tags( get( 'global_settings_google_analytic', 1, 1, 0, 2 ), '<script>' ); ?>

	</head>


	<body <?php body_class(); ?>>
	
		
		<div id="pop-wrapper">