<?php

defined( 'SECURE' ) or die( 'Apologies, but the page you requested could not be found.' );


$email_to			= ( 
	get( 'global_settings_email_for_contact_form', 1, 1, 0, 2 ) != '' 
	? get( 'global_settings_email_for_contact_form', 1, 1, 0, 2 ) 
	: get_bloginfo( 'admin_email' ) 
);


$mail = new PHPMailer();

$mail->Encoding		= 'base64';

$mail->AddReplyTo( $requestfields['email'], $requestfields['name'] );

$mail->From			= $requestfields['email'];

$mail->FromName 	= $requestfields['name'];

$mail->Subject		= 'Contact from ' . get_bloginfo( 'name', 'display' ) . ' web';

$mail->AddAddress( $email_to );


// Send notification to administrator
$body  = '<h2>Contact from ' . get_bloginfo( 'name', 'display' ) . ' web</h2>';

$body .= '<p><strong>Name:</strong> ' . toutf8( $requestfields['name'] ) . '</p>';

$body .= '<p><strong>Last Name:</strong> ' . toutf8( $requestfields['lname'] ) . '</p>';

$body .= '<p><strong>Email:</strong> ' . toutf8( $requestfields['email'] ) . '</p>';

$body .= '<p><strong>Phone Number:</strong> ' . toutf8( $requestfields['phone'] ) . '</p>';

$body .= '<p><strong>Message:</strong><br /> ' . nl2br( toutf8( $requestfields['message'] ) ) . '</p>';


$mail->Body 		= $body;


if ( $mail->Send() ) :

	echo	1;

else :

	echo	$mail->ErrorInfo;

endif;

?>