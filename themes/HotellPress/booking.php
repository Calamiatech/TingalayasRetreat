<?php
global $wpdb;
require_once dirname( __FILE__ ) . '/functions/form_process.php';
$is_tax = '';
if(get_post_meta($_POST['roomtype'],META_ROOMTYPE_USE_TAX,true) == 'yes')
{
	$is_tax = get_post_meta($_POST['roomtype'],META_ROOMTYPE_USE_TAX,true);
	$tax_info = get_option('tgt_tax');
	$tax_fee = 0;
	if($tax_info['type'] == 'percent')
	{
	   $tax_fee = $price * ($tax_info['amount']/100);
	   $price = $price + $tax_fee;
	   $show_tax = $tax_info['amount'].'%';
	}elseif($tax_info['type'] == 'exact_amount')
	{
	   $tax_fee = $currencysymbol.$tax_info['amount'];
	   $price = $price + $tax_info['amount'];
	   $show_tax = $tax_fee;
	}	
}
?>
<?php get_header( 'custom' );?>

<div id="content" class="page-full">

	<div id="main-content">
	
		<div class="page-content page-content-deco default-styles">
	
			<h1><?php _e( 'Booking payment', 'hotel' ); ?></h1>
			
			<div class="col-left">

				<div id="booking-details" class="table-box">
					
					<div id="book-online-details">

						<?php
						$paid	= ( ( $deposit / 100 ) * $price );
						$paid 	= round( $paid, 2 );
						?>

						<?php if ( count( $get_room ) < $num_rooms ) : ?>
						
							<div class="empty">
							
								<p><?php _e (  'Booking has a problem, please try again', 'hotel' ); ?></p>
							
							</div><!-- .empty -->
						
						<?php else : ?>

							<?php
						
							require_once dirname( __FILE__ ) . '/booking_sub.php';
						
							$payment_method = get_option( 'tgt_payment_method', true );
							
							//echo '<pre>';
							//print_r( $payment_method );
							//echo '</pre>';
							
							$guest_in_room 	= $num_adults;
							$fields 		= array();
							if ( get_option( 'tgt_room_fields', true ) != '' ) :
								$fields = get_option( 'tgt_room_fields', true );
							endif;
						
							?>

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
									<tr>
										<th class="col-title"><strong><?php _e( 'Price acommodation(s)', 'hotel' ); ?></strong></th>
										<td class="col-value">
											<?php
											if ( ! empty( $_POST['number_room'] ) ) :
												$room_price = 0;
												$arr_tmp 	= array();										
												foreach ( $_POST['number_room'] as $k => $v ) :
													$v 			= explode( '_', $v );
													$arr_tmp[] 	= $currencysymbol . $v[1];
													$room_price+= $v[1];
												endforeach;
												$arr_tmp 	= implode( ' + ', $arr_tmp );
											endif;
											#echo $currencysymbol . ( $_room_price ) . '/night';
											echo $currencysymbol . ( $__total ) . ' for ' . $day_rate . ' night(s)';
											//echo $currencysymbol . $room_price . ( ! empty( $arr_tmp ) ? ' ( '.$arr_tmp.' )' : '' );
											if ( get_option( 'tgt_allow_alternal_currency', true ) == '1' ) :
												//echo tgt_calculate_alternal_price( $room_price );
											endif;
											?>
										</td>
									</tr>
									<?php if ( isset( $_POST['go_booking_page'] ) && ! empty( $_POST['go_booking_page'] ) ) : // Services information which user selected ?>
										<?php if ( isset( $_POST['services'] ) && ! empty( $_POST['services'] ) ) : $default_services = get_post_meta( $_POST['roomtype'], META_ROOMTYPE_SERVICES, true ); ?>
											<?php foreach ( $_POST['services'] as $k => $v ) : ?>
												<?php if ( $default_services[$v]['name'] != '' ) : ?>
													<tr>
														<th class="col-title"><strong><?php echo $default_services[$v]['name']; ?></strong></th>
														<td class="col-value">
														<?php
														echo	$currencysymbol . $default_services[$v]['price'] . '&nbsp;';
														if ( get_option( 'tgt_allow_alternal_currency', true ) == '1' ) :
															//echo tgt_calculate_alternal_price( $default_services[$v]['price'] );
														endif;
														?>
														</td>
													</tr>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>
									<?php endif; ?>
									<?php if ( $promotion_total_price[0] != 0 && ! empty( $promotion_total_price ) ) : ?>
									<tr>
										<th class="col-title"><strong><?php _e( 'Promotion', 'hotel' ); ?></strong></th>
										<td class="col-value"><?php echo $currencysymbol . round( $promotion_total_price[0], 2 ); ?></td>
									</tr>
									<?php endif; ?>
									<?php if ( get_post_meta( $_POST['roomtype'], META_ROOMTYPE_USE_TAX, true ) == 'yes' ) : ?>
									<tr>
										<th class="col-title"><strong><?php _e( 'TAX', 'hotel' ); ?></strong></th>
										<td class="col-value"><?php echo $show_tax; ?></td>
									</tr>
									<?php endif; ?>
									<tr>
										<th class="col-title"><strong><?php _e( 'Deposit', 'hotel' ); ?></strong></th>
										<td class="col-value"><?php echo $deposit . '%'; ?></td>
									</tr>
									<tr class="total">
										<th class="col-title"><strong><?php _e( 'Total Charges','hotel' ); ?></strong></th>
										<td class="col-value">
										<strong>
											<?php 
											echo $currencysymbol . $paid . ' ';
											if ( get_option( 'tgt_allow_alternal_currency', true ) == '1' ) :
												echo tgt_calculate_alternal_price( $paid );
											endif;
											?>
										</strong>
										</td>
									</tr>
								</tbody>
							</table>
						
						<?php endif; ?>
						
					</div><!-- #book-online-details -->
					
				</div><!-- .table-box -->

				<h2><?php _e( 'Traveller Details', 'hotel' ); ?></h2>
				
				<div id="fill_info">

					<div id="booking-traveller-details" class="table-box">
						
						<div id="book-traveller-details" class="book-form">
	
							<form action="" method="post" name="form_fill_info" id="form_fill_info" onsubmit="return false;">
	
								<fieldset>
							
									<p>
									
										<label><?php _e( 'Title', 'hotel' );?></label>
										
										<span class="field-select">
							
										<select name="s_title" id="s_title">
											<option value="Mr."><?php _e( 'Mr.', 'hotel' ); ?></option>
											<option value="Mrs."><?php _e( 'Mrs.', 'hotel' ); ?></option>
											<option value="Ms."><?php _e( 'Ms.', 'hotel' ); ?></option>
										</select>
							
										</span>
							
									</p>
							
									<p>
									
									   <label><?php _e( 'First Name', 'hotel' ); ?> *</label>
									   
									   <span class="field-select">
							
									   <input type="text" name="first_name" id="first_name" />
									   
									   </span>
									   
									   <span id="first_err" class="form-error"></span>
							
									</p>
							
									<p>
									
									   <label><?php _e( 'Last Name', 'hotel' ); ?> *</label>
									   
									   <span class="field-select">
							
									   <input type="text" name="last_name" id="last_name" />
									   
									   </span>
									   
									   <span id="last_err" class="form-error"></span>
							
									</p>
							
									<p>
									
									   <label><?php _e( 'Phone', 'hotel' ); ?> *</label>
									   
									   <span class="field-select">
							
									   <input type="text" name="phone" id="phone" />
									   
									   </span>
									   
									   <span id="phone_err" class="form-error"></span>
							
									</p>
							
									<p>
									
									   <label><?php _e( 'Email', 'hotel' ); ?> *</label>
									   
									   <span class="field-select">
							
									   <input type="text" name="email" id="email" />
									   
									   </span>
									   
									   <span id="email_err" class="form-error"></span>
							
									</p>
							
									<p>
									
									   <label><?php _e( 'Street', 'hotel' ); ?> *</label>
									   
									   <span class="field-select">
							
									   <input type="text" name="street" id="street" />
									   
									   </span>
									   
									   <span id="street_err" class="form-error"></span>
							
									</p>
							
									<p>
									
									   <label><?php _e( 'City/State', 'hotel' ); ?> *</label>
									   
									   <span class="field-select">
							
									   <input type="text" name="state" id="state" />
									   
									   </span>
									   
									   <span id="state_err" class="form-error"></span>
							
									</p>
							
									<p>
									
										<label><?php _e( 'Country', 'hotel' );?></label>
										
										<span class="field-select">
							
										<select name="country" id="country">
											<?php 
											$country 		= tgt_get_countries( TEMPLATE_URL . '/data/countries.xml' );	
											$def_country 	= get_option( 'tgt_hotel_country' );
											?>
											<?php foreach ( $country as $k => $v ) : ?>
											<option value="<?php echo $k; ?>"<?php if ( $def_country == $k ) echo ' selected="selected"' ?>><?php echo $k; ?></option>
											<?php endforeach; ?>
										</select>
							
										</span>
							
									</p>
							
									<?php
									$display = 'none;';
									if ( ( $payment_method['paypal'] == '1' || $payment_method['2checkout'] == '1' ) && $payment_method['direct'] == '1' ) :
										$display = '';
									elseif ( $payment_method['paypal'] == '1' && $payment_method['2checkout'] == '1' ) :
										$display = '';
									endif;
									?>
									<?php if ( $payment_method['paypal'] == '1' || $payment_method['2checkout'] == '1' || $payment_method['direct'] == '1' ) : ?>
										<p class="payment-method" style="display: <?php echo $display; ?>">
										<?php if ( $payment_method['paypal'] == '1' || $payment_method['2checkout'] == '1' ) : ?>
											<label class="payment-method-row">
												<?php if ( $payment_method['paypal'] == '1' || $payment_method['2checkout'] == '1' ) : ?>
												<input type="radio" name="purchase_agree" checked="checked" id="purchase_agree" value="1"/> <?php _e( 'I agree to purchase online.', 'hotel' ); ?>
												<?php endif; ?>
											</label>
											<?php if ( $payment_method['paypal'] == '1' && $payment_method['2checkout'] == '1' ) : ?>
												<span class="field-select">
												<select name="payment_service" id="payment_service">
													<option value="paypal"><?php _e( 'Paypal', 'hotel' ); ?></option>
													<option value="2checkout"><?php _e( '2Checkout', 'hotel' ); ?></option>
												</select>
												</span>
											<?php elseif ( $payment_method['paypal'] == '1' && $payment_method['2checkout'] == '0' ) : ?>
												<input type="hidden" name="payment_service" id="payment_service" value="paypal" />
											<?php elseif ( $payment_method['paypal'] == '0' && $payment_method['2checkout'] == '1' ) : ?>
												<input type="hidden" name="payment_service" id="payment_service" value="2checkout" />
											<?php endif; ?>
										<?php endif; ?>
										<?php if ( $payment_method['direct'] == '1' ) : ?>
											<?php
											$input_type 	= 'radio';
											$input_label 	= __( 'I agree to purchase by cash.', 'hotel' );
											if ( $payment_method['paypal'] != '1' && $payment_method['2checkout'] != '1' ) :
												$input_type 	= 'hidden';
												$input_label 	= '';
											endif;
											?>
											<label class="payment-method-row"><input type="radio" name="purchase_agree" id="purchase_agree" value="0"/> <?php echo $input_label; ?></label>
										<?php endif; ?>
										</p>
									<?php elseif ( $payment_method['paypal'] == '0' && $payment_method['2checkout'] == '0' && $payment_method['direct'] == '1' ) : ?>
										<input type="hidden" name="purchase_agree" id="purchase_agree" value="0" />
									<?php endif; ?>
									
									<p class="terms-agree">
									
										<label>
										
											<input type="checkbox" name="check_agree" id="check_agree">
									
											<?php _e( 'Yes, I checked the all information and agree to booking online.', 'hotel' ); ?>
											
											<a href="<?php echo tgt_get_link_term(); ?>" target="_blank"><?php _e( 'Terms &amp; Conditions', 'hotel' );?></a>
									
										</label>
									
									</p>
									
									<p class="button">
									
										<button type="submit" name="submit_continue" id="butt_save" value="<?php _e( 'Continue', 'hotel' );?>" onclick="fill_data('fill_info');" class="hidden-txt"><?php _e( 'Continue', 'hotel' );?></button>
									
									</p>
									
								</fieldset>
							
							</form>
	
						</div><!-- #book-traveller-details -->
	
					</div><!-- .table-box -->
				
				</div><!-- #fill_info -->
					
				<?php if ( count( $get_room ) >= $num_rooms ) : ?>
				
					<div id="list_info" style="display: none;">

						<div id="booking-traveller-info" class="table-box">
							
							<div id="book-traveller-info">
						
								<table>
									<tbody>
										<tr>
											<th class="col-title"><strong><?php _e( 'Customer', 'hotel' ); ?></strong></th>
											<td class="col-value"><span id="show_full_name"></span></td>
										</tr>
										<tr>
											<th class="col-title"><strong><?php _e( 'Email', 'hotel' ); ?></strong></th>
											<td class="col-value"><span id="show_email"></span></td>
										</tr>
										<tr>
											<th class="col-title"><strong><?php _e( 'Phone', 'hotel' ); ?></strong></th>
											<td class="col-value"><span id="show_phone"></span></td>
										</tr>
										<tr>
											<th class="col-title"><strong><?php _e( 'Country', 'hotel' ); ?></strong></th>
											<td class="col-value"><span id="show_country"></span></td>
										</tr>
										<tr>
											<th class="col-title"><strong><?php _e( 'State', 'hotel' ); ?></strong></th>
											<td class="col-value"><span id="show_state"></span></td>
										</tr>                            
										<tr>
											<th class="col-title"><strong><?php _e( 'Street', 'hotel' ); ?></strong></th>
											<td class="col-value"><span id="show_street"></span></td>
										</tr>
										<tr id="show_payment_parent" class="total">
											<th class="col-title"><strong><?php _e( 'Payment Method', 'hotel' ); ?></strong></th>
											<td class="col-value"><strong><span id="show_payment"></span></strong></td>
										</tr>
									</tbody>
								</table>
						
								<?php if ( get_option( 'tgt_permit_payment' ) == 0 || $paid == 0 ) : ?>
								
									<form action="<?php echo tgt_free_payment_link(); ?>" method="post" name="submit_payment_free" id="submit_payment_free" class="book-form">
									
										<fieldset>
	
											<input type="hidden" name="pay_free" value="yes" />
	
											<input type="hidden" name="u_id_free" id="u_id_free" />
	
											<input type="hidden" name="room_type_free" id="room_type_free" value="<?php echo $room_type->ID; ?>" />
	
											<input type="hidden" name="num_rooms_free" id="num_rooms_free" value="<?php echo $num_rooms; ?>" />
	
											<input type="hidden" name="date_in_free" id="date_in_free" value="<?php echo $date_in; ?>" />
	
											<input type="hidden" name="date_out_free" id="date_out_free" value="<?php echo $date_out; ?>" />
	
											<input type="hidden" name="promotion" id="promotion" value="<?php echo $promotion_price[1]; ?>" />
	
											<?php if ( isset( $_POST['go_booking_page'] ) && ! empty( $_POST['go_booking_page'] ) ) : // Services information which user selected ?>
												<?php if ( isset( $_POST['services'] ) && ! empty( $_POST['services'] ) ) : $default_services = get_post_meta( $_POST['roomtype'], META_ROOMTYPE_SERVICES, true ); ?>
													<?php foreach ( $_POST['services'] as $k => $v ) : ?>
														<?php if ( $default_services[$v]['name'] != '' ) : ?>
														<input type="hidden" name="service_name[<?php echo $default_services[$v]['name']; ?>]" value="<?php echo $currencysymbol . $default_services[$v]['price']; ?>" />									
														<?php endif; ?>
													<?php endforeach; ?>
												<?php endif; ?>
											<?php endif; ?>
											
											<p class="button">
											
												<button type="submit" name="submit_confirm" id="butt_save" value="<?php _e( 'Confirm', 'hotel' ); ?>" class="hidden-txt"><?php _e( 'Confirm', 'hotel' ); ?></button>
											
											</p>
											
										</fieldset>
									
									</form>
								
								<?php elseif ( get_option( 'tgt_permit_payment' ) == 1 && $paid > 0 ) : ?>
								
									<div id="paypal_info">
									
										<form action="<?php echo tgt_get_payment_submit(); ?>" method="post" name="submit_payment" id="submit_payment" class="book-form">
										
											<fieldset>
											
												<input type="hidden" name="payment_page" id="payment_page" />
												
												<input type="hidden" name="payment_type" id="payment_type" />
												
												<input type="hidden" name="item_number" id="paypal_item_number" />    
												
												<input type="hidden" name="invoice" id="paypal_invoice" />
												
												<input type="hidden" name="promotion" id="promotion" value="<?php echo $promotion_price[1]; ?>" />
												
												<input type="hidden" name="u_id" id="u_id" />
										
												<?php if ( isset( $_POST['go_booking_page'] ) && ! empty( $_POST['go_booking_page'] ) ) : // Services information which user selected ?>
													<?php if ( isset( $_POST['services'] ) && ! empty( $_POST['services'] ) ) : $default_services = get_post_meta( $_POST['roomtype'], META_ROOMTYPE_SERVICES, true ); ?>
														<?php foreach ( $_POST['services'] as $k => $v ) : ?>
															<?php if ( $default_services[$v]['name'] != '' ) : ?>
																<input type="hidden" name="service_name[<?php echo $default_services[$v]['name']; ?>]" value="<?php echo $currencysymbol . $default_services[$v]['price'] ?>" />
															<?php endif; ?>
														<?php endforeach; ?>
													<?php endif; ?>
												<?php endif; ?>
												
												<p class="button">
												
													<button type="submit" name="submit_continue" id="butt_save" value="<?php _e( 'Confirm & Pay', 'hotel' ); ?>" class="hidden-txt"><?php _e( 'Confirm & Pay', 'hotel' ); ?></button>
													
												</p>
												
											</fieldset>
		
										</form>
										
									</div><!-- #paypal_info -->
								
								<?php endif; ?>

							</div><!-- #book-traveller-info -->
		
						</div><!-- .table-box -->
						
					</div><!-- #list_info -->
				
				<?php endif; ?>
								
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

<?php get_footer( 'custom' );?>