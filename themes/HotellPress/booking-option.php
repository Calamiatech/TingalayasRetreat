<?php
global $wpdb, $sitepress, $post;
require_once dirname( __FILE__ ) . '/functions/form_process.php';
$room_info 	= get_postdata($_POST['roomtype']);
$is_tax 	= '';
$tax_fee 	= 0;
if(get_post_meta($room_info['ID'],META_ROOMTYPE_USE_TAX,true) == 'yes')
{
	 $is_tax = get_post_meta($room_info['ID'],META_ROOMTYPE_USE_TAX,true);
	 $tax_info = get_option('tgt_tax');
	 $tax_fee = 0;
	 $show_tax = '';
	 if($tax_info['type'] == 'percent')
	 {		  
		  $tax_fee = $paid * ($tax_info['amount']/100);
	 }elseif($tax_info['type'] == 'exact_amount')
	 {
		  $tax_fee = $currencysymbol.$tax_info['amount'];		  
	 }		
}


$guest_in_room = $num_adults;
$fields = array();
if(get_option('tgt_room_fields',true) != '')
{
	$fields = get_option('tgt_room_fields',true);
}
?>
<?php get_header( 'custom' );?>         

<div id="content" class="page-full">

	<div id="main-content">
	
		<div class="page-content page-content-deco default-styles">
		
			<h1><?php _e( 'Booking Options', 'hotel' ); ?></h1>
			
			<div class="col-left">

				<div id="booking-details" class="table-box">
					
					<div id="book-online-details">

						<table>
							<tbody>
								<tr>
									<th class="col-title"><strong><?php _e( 'Accommodation', 'hotel' ); ?></strong></th>
									<td class="col-value"><?php echo $room_type->post_title; ?></td>
								</tr>
								<tr>
									<th class="col-title"><strong><?php _e( 'Arrival/Check-in', 'hotel' ); ?></strong></th>
									<td class="col-value"><?php echo date( 'd M y', $arrival_date ); ?></td>
								</tr>
								<tr>
									<th class="col-title"><strong><?php _e( 'Departure/Check-out', 'hotel' ); ?></strong></th>
									<td class="col-value"><?php echo date( 'd M y', $departure_date ); ?></td>
								</tr>
								<tr>
									<th class="col-title"><strong><?php _e( 'Occupancy', 'hotel' ); ?></strong></th>
									<td class="col-value"><?php echo $num_adults . ' Adult(s)' . ( $num_kids > 0 ? ' and ' . $num_kids . ' Kid(s)' : '' );  ?></td>
								</tr>
								<tr>
									<th class="col-title"><strong><?php _e( 'Day(s)', 'hotel' ); ?></strong></th>
									<td class="col-value"><?php echo $day_rate; ?></td>
								</tr>
								<?php if ( ! empty( $fields ) ) : ?>
									<?php foreach ( $_POST as $k => $v ) : ?>
										<?php if ( is_numeric( $k ) && ! empty( $v ) ) : ?>
										<tr>
											<th class="col-title"><strong><?php echo $fields[1]['field_name']; ?></strong></th>
											<td class="col-value"><?php echo $_POST[$k]; ?></td>
										</tr>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
						
					</div><!-- #book-online-details -->
					
					<div id="book-online-options">

						<form action="<?php echo tgt_get_booking_link(); ?>" method="post">
						
							<fieldset>
							
								<?php
								$tran_id	= $room_info['ID'];
								if ( method_exists( $sitepress, 'get_current_language' ) ) :
									$tran_id = icl_object_id( $room_info['ID'] , 'roomtype', true, $sitepress->get_current_language );
								endif;
								$post 		= get_post( $tran_id );
								setup_postdata( $post );
								?>

								<?php
								#$count_room	= 0;
								#ksort( $capability );
								#for ( $i = 0; $i < count( $get_room ); $i++ ) :
								#	if ( ! empty( $capability ) ) : $price_person = 0;
								#		foreach ( $capability as $k => $v ) :
								#			if ( ! empty( $capability_tmp ) ) :
								#				//$price_person 	= $v;
								#				$total_room_price 	= 0;
								#				//$capability 		= $capability_tmp[$arrival_date];			
								#				foreach ( $capability_tmp as $k_tmp => $v_tmp ) :
								#					$room_price 		= 0;
								#					$room_price 		= $v_tmp[$k];
								#					$total_room_price  +=  $room_price;																					
								#				endforeach;
								#				$price_person		= $total_room_price;
								#			else :
								#				$price_person 		= $v['price'] * $day_rate;
								#			endif;
								#		endforeach;
								#	endif;
								#endfor; 
								?>
								
								<?php $num_persons = $num_adults + $num_kids; ?>
								<input type="hidden" name="number_room[<?php echo $num_persons; ?>]" value="<?php echo $num_persons . '_' . $capability[$num_persons]['price']; ?>" />

								<!--
								<div class="options">
								
									<h3><?php _e( 'Rooms','hotel' ); ?></h3>
									
									<table>
										<?php
										$count_room	= 0;
										ksort( $capability );
										?>
										<?php for ( $i = 0; $i < count( $get_room ); $i++ ) : ?>
										<tr class="option-title">
											<td width="30%"><?php _e( 'Room', 'hotel' ); ?>&nbsp;<?php echo $count_room = ( $i+1 ); ?>&nbsp;(<?php echo ( $room_type->post_title ); ?>): </td>
											<td width="70%">
												<select name="number_room[<?php echo $i; ?>]">
													<?php if ( ! empty( $capability ) ) : $price_person = 0; ?>
														<?php foreach ( $capability as $k => $v ) : ?>
															<?php
															if ( ! empty( $capability_tmp ) ) :
																//$price_person 	= $v;
																$total_room_price 	= 0;
																//$capability 		= $capability_tmp[$arrival_date];			
																foreach ( $capability_tmp as $k_tmp => $v_tmp ) :
																	$room_price 		= 0;
																	$room_price 		= $v_tmp[$k];
																	$total_room_price  +=  $room_price;																					
																endforeach;
																$price_person		= $total_room_price;
															else :
																$price_person 		= $v['price'] * $day_rate;
															endif;
															?>
															<option value="<?php echo $k . '_' . $price_person; ?>"<?php echo ( $check_selected == $k ? ' selected="selected"' : '' ); ?>>
															<?php echo $k . ' ' . ( $k == 1 ? 'Person' : 'Persons' ); ?> (<?php echo $currencysymbol . $price_person; ?>)
															</option>
														<?php endforeach; ?>
													<?php endif; ?>																
												</select>
											</td>
										</tr>
										<?php endfor; ?>												  
									</table>											 

									<?php for ( $i = 0; $i < count( $get_room ); $i ++ ) : ?>
									<table>
										<tr>
											<td><?php _e( 'Room', 'hotel' ); ?>&nbsp;<?php echo $count_room = ( $i+1 ); ?>&nbsp;(<?php echo $room_type->post_title; ?>):</td>
											<?php if ( ! empty( $capability ) ) : ?>
												<?php foreach ( $capability as $k => $v ) : ?>
												<td><?php echo $k . ' ' . ( $k == 1 ? 'Person' : 'Persons' ); ?></td>															
												<?php endforeach; ?>
											<?php endif; ?>			
										</tr>
										<?php for ( $j = $arrival_date; $j < $departure_date; $j += ( 3600*24 ) ) : ?>
										<tr>
											<td><?php echo date( 'd M y', $j ); ?></td>
											<?php if ( ! empty( $capability ) ) : ?>
												<?php foreach ( $capability as $k => $v ) : ?>
													<?php
													$price_person = 0;
													if ( ! empty( $capability_tmp ) ) :
														//$price_person 	= $v;
														$total_room_price 	= 0;
														//$capability 		= $capability_tmp[$arrival_date];			
														foreach ( $capability_tmp as $k_tmp => $v_tmp ) :
															if ( $k_tmp == $j ) :
																$room_price 		= 0;
																$room_price 		= $v_tmp[$k];
																$total_room_price 	= $room_price;
															endif;
														endforeach;
														$price_person 		= $total_room_price;
													else :
														$price_person 		= $v['price'];
													endif;
													?>
													<td><?php echo $currencysymbol . $price_person; ?></td>															
												<?php endforeach; ?>
											<?php endif; ?>	
										</tr>
										<?php endfor; ?>
									</table>											
									<?php endfor; ?>
								
								</div>
								-->
								<!-- .options -->
								
								<?php if ( get_option( 'tgt_room_option', true ) != '' ) : ?>
									
									<?php $room_service = get_post_meta( $room_info['ID'], META_ROOMTYPE_SERVICES, true ); ?>										
									
									<?php if ( ! empty( $room_service ) ) : ?>
									
									<div class="options">
									
										<h3><?php _e( 'Services', 'hotel' ); ?>:</h3>
									
										<?php foreach ( $room_service as $k => $v ) : ?>											 
										<p>

											<input type="checkbox" name="services[]" value="<?php echo $k; ?>" />

											<label for="service_1"><?php echo $v['name'] . ' (' . $currencysymbol . $v['price'] . ')'; ?></label>

										</p>
										<?php endforeach; ?>
									
									</div><!-- .options -->
									
									<?php endif; ?>
								
								<?php endif; ?>
								
								<div class="options">
									
									<p>
										
										<label><?php _e( 'Coupon Code', 'hotel' ); ?></label>

										<span class="field-select">
										
										<input type="text" name="promotion" />
						
										</span>
										
									</p>
								
									<p class="button"><button type="submit" name="go_booking_page" value="<?php _e( 'Continue', 'hotel' ); ?>" class="hidden-txt"><?php _e( 'Continue', 'hotel' ); ?></button></p>
									
								</div><!-- .options -->
								
								<input type="hidden" name="tax_fee" value="<?php echo $tax_fee; ?>" />										
								
								<?php if ( get_option( 'tgt_permit_payment' ) ) : ?>
									<?php foreach ( $_POST as $key => $val ) : ?>
									<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>" />
									<?php endforeach; ?>
									<input type="hidden" name="roomtype" value="<?php echo $room_info['ID'];?>" />
								<?php endif; ?>
							
							</fieldset>
						
						</form>							 
					
					</div><!-- #book-online-options -->

				</div><!-- .table-box -->
								
				<br class="clear-fix" />
				
			</div><!-- .col-left -->
	
			<?php get_sidebar( 'booking' ); ?>
			
			<br class="clear-fix" />
		
		</div><!-- .page-content -->
			
		<br class="clear-fix" />
	
		<span class="deco-shadow">&nbsp;</span>

	</div><!-- #main-content -->

	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>

</div><!-- #content -->

<?php get_footer( 'custom' ); ?>