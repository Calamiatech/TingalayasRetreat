<?php

$check_in 	= '';
$check_out 	= '';
if ( ! empty( $_POST['arrival_date'] ) ) :
	$check_in 	= strtotime( $_POST['arrival_date'] );
	$check_out 	= strtotime( $_POST['departure_date'] );
else :
	$check_in 	= strtotime( $_POST['from'] );
	$check_out 	= strtotime( $_POST['to'] );
endif;

$num_adults = intval( $_POST['num_adults'] ); //adults number per room
$num_kids 	= intval( $_POST['num_kids'] ); //chidrens number per room
$room_id 	= intval( $_POST['room_id'] ); //id of room

global $wp_query, $sitepress;
//
//icl_sitepress_activate();
//icl_get_languages();
//$current = icl_get_languages();
//if ( method_exists ( $sitepress, 'get_current_language') )
//{
//	echo '<pre>';
//	print_r( $sitepress );
//	echo '</pre>';
//}

?>

<div id="book-online">

	
	<h3>Book Online</h3>

    <?php echo do_shortcode('[gravityform id="1" name="Book Short Form" title="false" description="false"]'); ?>

</div><!-- #book-online -->
