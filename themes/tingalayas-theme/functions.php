<?php

//add_theme_support( 'post-thumbnails' );


//add_filter( 'excerpt_length', 'custom_excerpt_length' );

function	custom_excerpt_length( $length ) {
	
	return 25; 
	
}


add_action( 'after_setup_theme', 'customtheme_setup' );

if ( ! function_exists( 'customtheme_setup' ) ):
	
	function	customtheme_setup() {
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> __( 'Main Navigation' ),
			'footer' 	=> __( 'Footer Navigation' )
		) );
	
	}

endif;


//add_filter( 'wp_nav_menu', 'add_first_and_last' );

function	add_first_and_last( $output ) {

	$output = preg_replace( '/class="menu-item/', 'class="first-menu-item menu-item', $output, 1 );

	$output = substr_replace( $output, 'class="last-menu-item menu-item', strripos( $output, 'class="menu-item' ), strlen( 'class="menu-item' ) );

	return $output;

}


add_action( 'widgets_init', 'customtheme_widgets_init' );

if ( ! function_exists( 'customtheme_widgets_init' ) ):
	
	function	customtheme_widgets_init() {
		
		register_sidebar( array(
			'name' 			=> __( 'Default Sidebar Area' ),
			'id' 			=> 'defaultsidebararea',
			'before_widget' => '<div id="%1$s" class="box %2$s">',
			'after_widget' 	=> '</div><!-- widgets -->',
			'before_title' 	=> '<h3 class="widgettitle">',
			'after_title' 	=> '</h3>',
		) );
	
	}

endif;


require( 'functions/meta-tags.php' );


#require( 'functions/custom-comments.php' );


require( 'functions/social-networks.php' );

?>