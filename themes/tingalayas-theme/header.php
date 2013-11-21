<?php  define( 'SECURE', 'Secure init' ); // Security var ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<html <?php language_attributes(); ?>>


	<head profile="http://gmpg.org/xfn/11">


		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo get_bloginfo( 'charset' ); ?>" />


		<?php wp_head(); ?>
		
		
		<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/jquery.js"></script>


		<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo( 'template_url' ); ?>/styles/layout.css" media="screen" />

		<link rel="stylesheet" type="text/css" href="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.fancybox-1.3.4.css" media="screen" />


		<!--[if lt IE 9]>
		
		<script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/html5.js"></script>
		
		<![endif]-->

		<!--[if lt IE 8]>
		
		<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo( 'template_url' ); ?>/styles/ie7.css" media="screen" />
		
		<![endif]-->
		
		
		<?php echo strip_tags( get( 'global_settings_google_analytic', 1, 1, 0, 2 ), '<script>' ); ?>


	</head>


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