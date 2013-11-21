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

global $wp_query, $sitepress, $post;

// get lang
if ( get_option( 'tgt_using_wpml' ) && method_exists( $sitepress , 'get_current_language' ) ) :
	$curr_lang = $sitepress->get_current_language();
endif;

?>
<?php get_header( 'custom' );?>

<div id="content">

	<div id="main-content">
	
		<div class="page-content page-content-deco default-styles">
		
			<h1><?php _e( 'Booking', 'hotel' );?></h1>
			
			<div class="col-left">
			
				<div id="booking-details" class="table-box">
					
					<div id="book-online-details">

						<table>
							<tbody>
								<tr>
									<th class="col-title"><strong><?php _e( 'Arrival/Check-in', 'hotel' ); ?></strong></th>
									<td class="col-value"><?php echo ( ! empty( $check_in ) ? date( 'd M y', $check_in ) : _e( 'Empty', 'hotel' ) ); ?></td>
								</tr>
								<tr>
									<th class="col-title"><strong><?php _e( 'Departure/Check-out', 'hotel' ); ?></strong></th>
									<td class="col-value"><?php echo ( ! empty( $check_out ) ? date( 'd M y', $check_out ) : _e( 'Empty', 'hotel' ) ); ?></td>
								</tr>
								<tr>
									<th class="col-title"><strong><?php _e( 'Occupancy', 'hotel' ); ?></strong></th>
									<td class="col-value"><?php echo $num_adults . ' Adult(s)' . ( $num_kids > 0 ? ' and ' . $num_kids . ' Kid(s)' : '' );  ?></td>
								</tr>
								<tr>
									<th class="col-title"><strong><?php _e( 'Day(s)', 'hotel' ); ?></strong></th>
									<td class="col-value"><?php echo floor( ( $check_out - $check_in ) / 86400 ); ?></td>
								</tr>
							</tbody>
						</table>
						
						<p class="change-button"><a href="#" class="hidden-txt">Change</a></p>

						<script type="text/javascript">
						
							//<![CDATA[
							
							jQuery( document ).ready( function () {
														   
								jQuery( '.change-button a' ).click( function() { 
									jQuery( '#book-online-details' ).slideUp( function() {
										jQuery( '#book-online-form' ).slideDown();
									} );
									return false; 
								} );
							
							} );
							
							//]]>
						
						</script>

					</div><!-- #book-online-details -->

					<div id="book-online-form">
					
						<?php if ( get_option( 'tgt_permit_reservations' ) == '1' ) : ?>
					
						<form action="<?php echo tgt_get_page_link( 'search' ); ?>" method="post" id="searchform_index">
						
							<fieldset>
							
								<input type="hidden" name="s" value="Check Rooms" />
							
								<p class="calendar date-pick">
					
								   <label><?php _e( 'Arrival/Check-in', 'hotel' ); ?></label>
					
								   <span class="field-select">
					
								   <input type="text" name="arrival_date" id="start-date" class="check datepicker" value="<?php echo ( ! empty( $check_in ) ? date( 'm/d/Y', $check_in ) : _e( 'Check in date', 'hotel' ) ); ?>" readonly="readonly" />
					
								   </span>

								</p>
					
								<p class="calendar date-pick">
								
								   <label><?php _e( 'Departure/Check-out', 'hotel' ); ?></label>
								   
								   <span class="field-select">
					
								   <input type="text" name="departure_date" id="end-date" class="check datepicker" value="<?php echo ( ! empty( $check_out ) ? date( 'm/d/Y', $check_out ) : _e( 'Check out date', 'hotel' ) ); ?>" readonly="readonly" />
								   
								   </span>

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

								</p>

								<p class="button"><button type="submit" class="hidden-txt" name="search" value="1">Update</button></p>
							
							</fieldset>
						
						</form>
						
						<?php else : ?>
						
							  <p class="offline">Book online not currently available.</p>
						
						<?php endif; ?>
					
					</div><!-- #book-online-form -->

				</div><!-- .table-box -->

				<h2>Accommodations available</h2>

				<div id="booking-acommodations" class="table-box">

					<?php if ( ! have_posts() ) : ?>
                    
                        <p class="empty"><?php echo __( 'Sorry, Not accommodations available with your conditions. Please change date!', 'hotel' ); ?></p>
                    
                    <?php endif; ?>
                    
                    <?php
                    
                    if ( get_option( 'tgt_permit_payment' ) == '1' ) :
                    
                        $payment_method	= get_option( 'tgt_payment_method', true );
                    
                        if ( $payment_method['paypal'] == '1' || $payment_method['2checkout'] == '1' || $payment_method['direct'] == '1' ) :
                    
                            $permit_payment = array( 'link' => tgt_get_booking_option(), 'text' => __( 'Book Now', 'hotel' ) );
                    
                        else :
                        
                            $permit_payment = array( 'link' => tgt_get_contact_link(), 'text' => __( 'Contact Us', 'hotel' ) );
                    
                        endif;
                        
                    else :
                    
                        $permit_payment = array( 'link' => tgt_get_contact_link(), 'text' => __( 'Contact Us', 'hotel' ) );
                    
                    endif;
                    
                    ?>
                    
                    <?php while ( have_posts() ) : ?>
                    
                        <?php
                    
                        the_post();
                    
                        $id 		= intval( $post->ID );
                        $tran_room 	= $post;
                    
                        // get lang
                        if ( get_option( 'tgt_using_wpml' ) && method_exists( $sitepress , 'get_current_language' ) ) :
                            //$curr_lang = $sitepress->get_current_language();
                            $tran_id 	= icl_object_id( $post->ID, 'roomtype', true, $curr_lang );
                            $tran_room 	= get_post( $tran_id );
                        endif;
                        
                        $excerpt 	= apply_filters( 'the_excerpt', $tran_room->post_content );
                        $excerpt 	= str_replace( ']]>', ']]&gt;', $excerpt );
                        $excerpt 	= wp_html_excerpt( $excerpt, 252 ) . '...';
						
						$page_id	= intval( strip_tags( $tran_room->post_content ) );
                    
                        $img_id 	= get_post_thumbnail_id( get_the_ID() ); 
                        $img		= wp_get_attachment_image_src( $img_id );
                        //$img 		= get_metadata( 'post', get_the_ID(), 'tgt_roomtype_thumbnail', true );
                        $img 		= $img[0];
                        if ( empty( $img ) ) :
                            $img = TEMPLATE_URL . '/images/room-box-bg.jpg';
                        endif;	            
                        
                        ?>

                        <form action="<?php echo $permit_payment['link']; ?>" method="post">
                        
                            <fieldset>
                
                                <?php if ( get_option( 'tgt_permit_payment' ) ) : ?>
                                
                                    <?php foreach ( $_POST as $key => $val ) : ?>
                    
                                    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>" />
                    
                                    <?php endforeach; ?>
                    
                                    <input type="hidden" name="roomtype" value="<?php echo $id; ?>" />
                    
                                <?php endif; ?>

                                <table class="bungalow-item">
                                	<tbody>
                                        <tr>
											<th class="col-title"><strong><?php echo $tran_room->post_title; ?></strong></th>
											<td class="col-details"><a href="<?php echo get_permalink( strip_tags( $tran_room->post_content ) ); ?>?&amp;content=full" target="_blank" class="iframe details-button"><?php _e( 'Detail', 'hotel' ); ?></a></td>
											<td class="col-booking"><button type="submit" class="button" name="booking" value="<?php echo $permit_payment['text']; ?>"><?php echo $permit_payment['text']; ?></button></td>
                                        </tr>
									</tbody>
                                </table>

                            </fieldset>
                
                        </form>
                    	<!--
                        <h3><a href="<?php #echo get_permalink( $id ); ?>"></a></h3>
                        <p><?php #echo $excerpt; ?></p>
                        <img src="<?php #echo $img;?>" alt="" />
                        -->
                    
                    <?php endwhile; ?>          
		
					<script type="text/javascript" src="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
					
					<script type="text/javascript" src="<?php echo bloginfo( 'template_url' ); ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

					<script type="text/javascript">
					
						//<![CDATA[
						
						jQuery( document ).ready( function () {
													   
							jQuery( '.details-button' ).fancybox( {
								width	: 560,
								height	: 600
							} );
						
						} );
						
						//]]>
					
					</script>
				
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