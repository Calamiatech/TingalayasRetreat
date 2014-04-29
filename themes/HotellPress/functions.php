<?php
ob_start();
/*
 * ABSPATH : reference path directory D:\AppServ\www\wordpress_3/
 * __FILE__ : reference path current file. Example: D:\AppServ\www\wordpress\wp-content\themes\hotel_pro\login.php
 * WPINC : reference string 'wp-includes'
 * TEMPLATEPATH: reference directory D:\AppServ\www\wordpress_3/wp-content/themes/hotel_pro
 * WP_CONTENT_DIR: reference D:\AppServ\www\wordpress_3/wp-content
 * 
 * WP_CONTENT_URL: reference http://localhost/wordpress_3/wp-content
 */
define ('FOLDER_STR', get_template()); // ~ name template directory
define('HOME_URL', get_bloginfo('url')); //reference http://localhost/wordpress_3
define('STYLESHEET_URL', get_bloginfo('stylesheet_url'));//reference /wordpress/wp-content/themes/hotel_pro/style.css
define('TEMPLATE_URL', get_bloginfo('template_url')); //reference /wordpress/wp-content/themes/hotel_pro
define ('WP_URL', get_bloginfo('wpurl')); //reference http://localhost/wordpress_3
define('FIELD_TYPE_TEXT', 'textbox');
define('FIELD_TYPE_LONGTEXT', 'textarea');
define('FIELD_TYPE_DROPBOX', 'combobox');
define('FIELD_TYPE_CHECKBOX', 'checkbox');
define( 'META_ROOMTYPE_CAPABILITY',  'tgt_meta_roomtype_capability');	
define( 'META_ROOMTYPE_PRICE',  'tgt_roomtype_price');
define( 'META_ROOMTYPE_FIELD',  'tgt_meta_roomtype_field_');
define('META_EVENT_START', 'tgt_meta_event_start');
define('META_EVENT_END', 'tgt_meta_event_end');
define('META_EVENT_LOCATION', 'tgt_meta_event_location');
define( 'META_ROOMTYPE_USE_TAX',  'tgt_roomtype_use_tax');
define( 'META_ROOMTYPE_CAP_PRICE',  'tgt_roomtype_cap_price');
define( 'META_ROOMTYPE_SERVICES',  'tgt_roomtype_services');
define( 'META_USER_PROMOTION',  'tgt_user_promotion');
define( 'BOOKING_PROMOTION',  'tgt_booking_promotion');
define( 'PROMOTION_DATE',  'tgt_promotion_date');
define( 'PROMOTION_USED',  'tgt_promotion_used');

/*
 * load text domain (languages)
 */
//$lang = get_option('tgt_default_language', 'default');
//load_textdomain('hotel', TEMPLATEPATH . "/lang/$lang.mo");

require_once dirname( __FILE__ ) . '/functions/function_register.php';
//for redirect, return link and setting permalink wordpress
require_once TEMPLATEPATH . '/functions/links.php';
//content data admin site
require_once TEMPLATEPATH. '/admin/functions-sub.php';
//for redirect, return link and setting permalink wordpress
//require_once TEMPLATEPATH . '/functions/links.php';
//Setup system (active, reactive template, set default menubar)
//require_once TEMPLATEPATH . '/functions/setup.php';
//contain query for data
require_once TEMPLATEPATH . '/functions/query.php';
require_once TEMPLATEPATH . "/functions/fields.php";
//require_once TEMPLATEPATH . "/functions/languages.php";
require_once dirname( __FILE__ ) . '/functions/mywidget.php';
require_once TEMPLATEPATH . "/functions/options.php";
require_once TEMPLATEPATH . '/data/2Checkout/DCPayment.abstract.php';
require_once TEMPLATEPATH . '/data/2Checkout/DC2Checkout.class.php';
require_once TEMPLATEPATH . "/functions/register_string.php";
/*
 *
 **/
//$fields = Fields::getInstance();
////$fields->insert(array('field_name' => 'test',
////							 'field_type' => 'checkbox',
////							 'field_options' => array( 'yes', 'no' ),
////							 'can_search' => 1,
////							 'activated' => 1 ));
//$arr = $fields->getFields();
//echo '<pre>';
//print_r( $arr ) ;
//echo '</pre>';
//die();

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

add_action( 'widgets_init', 'customtheme_widgets_init' );

if ( !function_exists( 'customtheme_widgets_init' ) ):
	
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

require( 'functions/social-networks.php' );

$inject_required_scripts = array();

/**
 * Call this function before calling get_header() to request custom js code to be injected on head.
 *
 * @param code the javascript code to be injected.
 */
function require_script($code) {
  global $inject_required_scripts;
  $inject_required_scripts[] = $code; // store code snippet for later injection
}

function inject_required_scripts() {
  global $inject_required_scripts;
  foreach($inject_required_scripts as $script)
    // inject all code snippets, if any
    echo '<script type="text/javascript" src="'.$script.'"></script>';
}
add_action('wp_head', 'inject_required_scripts');

