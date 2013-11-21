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


	<?php if ( get_option( 'tgt_permit_reservations' ) == '1' ) : ?>

	<form action="<?php bloginfo('url'); ?>/booking-form" method="get" id="searchform_index">
	
		<fieldset>
		
			<!--<input type="hidden" name="s" value="Check Rooms" />-->
		
			<p class="calendar date-pick">

			   <label>Check in</label>

			   <span class="field-select">

	 		   <input type="text" name="arrival_date" id="start-date" class="check datepicker" value="<?php echo ( ! empty( $check_in ) ? date( 'm/d/Y', $check_in ) : _e( 'Check in date', 'hotel' ) ); ?>" readonly="readonly" />

	 		   </span>
				<!--
				<a href="#">View</a>
				-->
            </p>

			<p class="calendar date-pick">
			
			   <label>Check out</label>
			   
			   <span class="field-select">

	 		   <input type="text" name="departure_date" id="end-date" class="check datepicker" value="<?php echo ( ! empty( $check_out ) ? date( 'm/d/Y', $check_out ) : _e( 'Check out date', 'hotel' ) ); ?>" readonly="readonly" />
	 		   
	 		   </span>
				<!--
				<a href="#">View</a>
				-->
            </p>

			<p>
			
				<label>Adults</label>
				
				<span class="field-select">
				
				<select name="num_adults">
					<option value="0">&nbsp;</option>
					<?php $max_ppl = ( get_option( 'tgt_max_people_per_booking' ) ? get_option( 'tgt_max_people_per_booking' ) : 8 ); ?>
					<?php for ( $i = 0; $i < $max_ppl; $i ++ ) : ?>
					<option value="<?php echo ( $i+1 ); ?>"<?php echo ( $num_adults == ( $i+1 ) ? ' selected="selected"' : '' ); ?>><?php _e( ( $i+1 ), 'hotel' ); ?></option>
					<?php endfor; ?>
				</select>

				</span>
				<!--
				<a href="#">View</a>
				-->
			</p>
		
			<p>
			
				<label>Children</label>
				
				<span class="field-select">

				<select name="num_kids">
					<option value="0">&nbsp;</option>
					<?php $max_ppl = ( get_option( 'tgt_max_people_per_booking' ) ? get_option( 'tgt_max_people_per_booking' ) : 8 ); ?>
					<?php for ( $i = 0; $i < $max_ppl; $i ++ ) : ?>
					<option value="<?php echo ( $i+1 ); ?>"<?php echo ( $num_kids == ( $i+1 ) ? ' selected="selected"' : '' ); ?>><?php _e( ( $i+1 ), 'hotel' ); ?></option>
					<?php endfor; ?>
				</select>

				</span>
				<!--
				<a href="#">View</a>
				-->
			</p>
			<!--
			<p>
			
				<label>Bungalow</label>
				
				<span class="field-select">
				
				<select name="room_id">
					<option value="0">Bungalow</option>
					<?php #$bungalows = new WP_Query( 'post_type=roomtype&posts_per_page=-1&orderby=title&order=ASC' ); ?>
					<?php #if ( $bungalows->have_posts() ) : ?>
						<?php #while ( $bungalows->have_posts() ) : ?>
						<option value="<?php #echo $bungalows->ID; ?>"<?php #echo ( $bungalows->ID == $room_id ? ' selected="selected"' : '' ); ?>><?php #_e( get_the_title( $bungalows->ID ), 'hotel' ); ?></option>
						<?php #endwhile; ?>
					<?php #endif; ?>
				</select>

				</span>

				<a href="#">View</a>

			</p>
			-->
			
			<input type="hidden" name="num_rooms" value="1" />
			
			<p class="button"><button type="submit" class="hidden-txt" name="search" value="Search">Submit</button></p>
		
		</fieldset>
	
	</form>
	
	<?php else : ?>
	
	      <p class="offline">Book online not currently available.</p>
	
	<?php endif; ?>

</div><!-- #book-online -->
