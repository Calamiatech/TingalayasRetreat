<?php

defined( 'SECURE' ) or die( 'Apologies, but the page you requestfieldsed could not be found.' );

$outputtext	= '';

foreach ( $contactfields as $field => $msj ) :

	$requestfields[$field] = ( isset( $_REQUEST[$field] ) ? trim( $_REQUEST[$field] ) : '' );

	if ( in_array( $field, $contactrequired ) ) :

		$outputtext.= ( empty( $requestfields[$field] ) ? ( ! empty( $outputtext ) ? ', ' : '' ) . $msj : '' );

	endif;

	if ( $field == 'email' && ! empty( $requestfields[$field] ) && ! validatemail( $requestfields[$field] ) ) :

		$outputtext.= ( ! empty( $outputtext ) ? ', ' : '' ) . $msj;

	endif;

	if ( $field == 'comment' && ! empty( $requestfields[$field] ) && stristr( $requestfields[$field], 'href=' ) !== FALSE ) :

		$outputtext.= ( ! empty( $outputtext ) ? ', ' : '' ) . $msj;

	endif;

endforeach;

if ( ! empty( $outputtext ) ) :

	echo	'<span class="formerror">The following data are necessary to complete the query: ' . $outputtext . '</span>';

else :

	require( 'send.fun.php' );

endif;

?>