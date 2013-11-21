<?php 

define( 'SECURE', 'Secure init' ); // Variable de seguridad 


require( '../../../wp-config.php' );

$wp->init();
$wp->parse_request();
$wp->query_posts();
$wp->register_globals();

require( 'class/phpmailer5.class.php' );


$contactfields 		= array (
	'name'		=> 'Name',
	'lname'		=> 'Last Name',
	'email'		=> 'Email',
	'phone'		=> 'Phone number',
	'message'	=> 'Message'
);

$contactrequired 	= array( 'name', 'lname', 'email', 'phone', 'message' );


$module				= ( isset( $_REQUEST['module'] ) ? $_REQUEST['module'] : '' );


switch ( $module ) :

	case 'form'		: $loader = 'modules/contact/form.php';

	break;

	case 'contact'	: $loader = 'modules/contact/validate.fun.php';

	break;

	default			: die( 'Apologies, but the page you requested could not be found.' );

	break;

endswitch;


if ( $loader != false ) :

	require( $loader );

endif;


function	toutf8( $value ) {

	return htmlentities( $value, ENT_QUOTES, 'UTF-8' );

}


function	validatemail( $email ) {

	return	filter_var( $email, FILTER_VALIDATE_EMAIL );

}

?>