<?php get_header( 'custom' );?> 

<div id="content" class="page-full">

	<div id="main-content">
	
		<div class="page-content page-content-deco default-styles">
		
			<div class="col-left">

				<?php
				$currency = get_option('tgt_currency');
				$pay = DC2Checkout::getInstance();
				$validateIPN = $pay->validateIPN(); 
				if ( $currency == "USD" || $currency == "AUD" || $currency == "CAD" || $currency == "NZD" || $currency == "HKD" || $currency == "SGD" ) { $currencysymbol = "$"; }
				else if ( $currency == "GBP" ) { $currencysymbol = "&pound;"; }
				else if ( $currency == "JPY" ) { $currencysymbol = "&yen;"; }
				else if ( $currency == "EUR" ) { $currencysymbol = "&euro;"; }
				else { $currencysymbol = $currency; }
				global $wpdb;
				$tb_b = $wpdb->prefix.'bookings';
				$r = $wpdb->prefix.'rooms';
				if(isset($_POST['payment_method']) && $_POST['payment_method'] == 'cash')
				{
					$room_type = $_POST['room_type'];
					$num_rooms = $_POST['num_rooms'];
					$date_in = $_POST['date_in'];
					$date_out = $_POST['date_out'];					
				}else
				{
					$room_type = $_GET['room_type'];
					$num_rooms = $_GET['num_rooms'];
					$date_in   = $_GET['date_in'];
					$date_out   = $_GET['date_out'];					
				}
				$err = '';
				$q_r= "SELECT r.ID  
						FROM $r r 
						WHERE r.room_type_ID=$room_type 
							AND r.status='publish'						
					
							AND r.ID NOT IN 
							( 
								SELECT DISTINCT b.room_ID FROM $tb_b b 
								WHERE b.check_in < $date_out AND b.check_out > $date_in
								AND b.status='publish' 
							)
						ORDER BY r.room_name
						LIMIT 0, $num_rooms";
				
				$room = $wpdb->get_results( $q_r );
				if(count($room) < $num_rooms)
				{
					$err = __('Booking process was false, please contact with hotel and try again','hotel');
				}
				$currency = get_option('tgt_currency');
				$u_id = $_POST['u_id_free'];
				if(isset($_GET['u_id']) && !empty($_GET['u_id']) && empty($_POST['u_id']))
					$u_id = $_GET['u_id'];
				elseif(isset($_POST['u_id']) && !empty($_POST['u_id']) && empty($_GET['u_id']))
					$u_id = $_POST['u_id'];		
                if ( ( (isset($_POST['payment_status']) && $_POST['payment_status'] == "Completed" ) || ( isset($_POST['payment_status']) && $_POST['payment_status'] == "Pending" ) || (isset($_POST['pay_free']) && $_POST['pay_free'] == 'yes') || (isset($_POST['payment_method']) && $_POST['payment_method'] == 'cash') && $err == '' ) || ($validateIPN == true) ) {  
					$q_r = '';
					$code = md5('booking_'.$u_id);				
					
					if(isset($_POST['pay_free']) && $_POST['pay_free'] == 'yes')
					{						
						$room_type = $_POST['room_type_free'];
						$num_rooms = $_POST['num_rooms_free'];
						$date_in = $_POST['date_in_free'];
						$date_out = $_POST['date_out_free'];
						$promotion = $_POST['promotion'];
						$u_data = get_userdata($u_id);
						$u_code = get_user_meta($u_id,'tgt_customer_code',true);			
						update_user_meta($u_id, 'tgt_transaction_no', $u_id, true);
						update_user_meta($u_id,META_USER_PROMOTION,$promotion);
						if(!empty($u_data))
							update_user_meta($u_id, 'tgt_payer_email', $u_data->user_email, true);					
						
					}else
					{										
						$u_data = get_userdata($u_id);
						if(isset($_POST['payment_method']) && $_POST['payment_method'] == 'cash')
						{
							$room_type = $_POST['room_type'];
							$num_rooms = $_POST['num_rooms'];
							$date_in = $_POST['date_in'];
							$date_out = $_POST['date_out'];
							$u_data = get_userdata($u_id);
							$u_code = get_user_meta($u_id,'tgt_customer_code',true);
							update_user_meta($u_id, 'tgt_paycash', 'yes', true);
							update_user_meta($u_id, 'tgt_transaction_no', $u_id, true);
							if(!empty($u_data))
								update_user_meta($u_id, 'tgt_payer_email', $u_data->user_email, true);
							$promotion = $_POST['promotion'];
							update_user_meta($u_id,META_USER_PROMOTION,$promotion);
						}elseif(isset($_GET['payment_method']) && $_GET['payment_method'] == '2checkout')
						{
							$room_type = $_POST['room_type'];
							$num_rooms = $_POST['num_rooms'];
							$date_in = $_POST['date_in'];
							$date_out = $_POST['date_out'];
						}else
						{
							$room_type = $_GET['room_type'];
							$num_rooms = $_GET['num_rooms'];
							$date_in   = $_GET['date_in'];
							$date_out   = $_GET['date_out'];
							$verify_sign = $_POST['verify_sign'];
							$mail = $_POST['payer_email'];
							$mail = str_replace("%40", "@", $mail);      
							update_user_meta($u_id, 'tgt_transaction_no', $verify_sign, true);
							update_user_meta($u_id, 'tgt_payer_email', $mail, true);
						}
					}
					
					$tb_b = $wpdb->prefix.'bookings';
					$r = $wpdb->prefix.'rooms';
					$status = 'publish';
					if(isset($_POST['payment_method']) && $_POST['payment_method'] == 'cash')
					{
						$status = 'pending'; 
					}
					
					$q_r= "SELECT r.ID  
							FROM $r r 
							WHERE r.room_type_ID=$room_type 
								AND r.status='publish'						
						
								AND r.ID NOT IN 
								( 
									SELECT DISTINCT b.room_ID FROM $tb_b b 
									WHERE b.check_in < $date_out AND b.check_out > $date_in
									AND b.status='publish' 
								)
							ORDER BY r.room_name
							LIMIT 0, $num_rooms";
					
					$room = $wpdb->get_results( $q_r );					
					if(count($room) == $num_rooms && get_user_meta($u_id,'tgt_customer_code',true) == '')
					{
						for ($i=0; $i < count($room); $i++)
						{	
							$wpdb->insert( "$wpdb->prefix"."bookings", array('room_ID'=> $room[$i]->ID, 'user_ID'=>$u_id, 'check_in'=>$date_in, 'check_out'=>$date_out, 'status'=>$status));						
						}
						if(isset($_GET['total_price']) && $status == 'publish')
							$total_price = $_GET['total_price'];
						if(isset($_POST['total_price']) && ($status == 'pending' || $_GET['payment_method'] == '2checkout') )					
							$total_price = $_POST['total_price'];							
										
						if($total_price > 0 && $_POST['payment_method'] != 'cash' )
						{
							$user_data_tmp = get_userdata($u_id);
							$arg = array('booking_id'	=>	$u_id,
										 'customer_id'	=>	$u_id,
										 'date'	=>	date('Y-m-d',strtotime($user_data_tmp->user_registered)),
										 'amount'	=>	$total_price,
										 'currency'	=>	$currencysymbol);
							doInsert($arg);
						}
						update_user_meta($u_id, 'tgt_total_price',$total_price, true);						
					}
					else if(count($room) < $num_rooms)
						$err = __('Booking process was false, please contact with hotel and try again','hotel');						
					if($err == '')
					{
						/*
						* Add the services which users selected into user_meta
						*/
						if(isset($_POST['service_name']) && !empty($_POST['service_name']))
						{
							$arr_service = array();
							foreach($_POST['service_name'] as $k => $v)
							{
								$arr_service[$k] = $v;
							}
							update_user_meta($u_id, 'tgt_service', $arr_service, true);
						}
						update_user_meta($u_id,'tgt_customer_code',$code);
                ?>				
						<h1><?php _e( 'Booking Successful','hotel' ); ?></h1>
                        
						<p class="success"><?php _e( 'Your booking has been successfully!', 'hotel' ); ?>
        
                        <p><strong><?php _e( 'Transaction No', 'hotel' ); ?>: <?php echo $u_id; ?></strong></p>
  
                        <p>
                        
						<?php
						if ( $status == 'publish' ) :
							echo get_option( 'tgt_booking_success' );
                            update_promotion_used( $u_id, 'publish' );
						elseif ( $status == 'pending' ) :
							echo get_option( 'tgt_cash_booking_success' );
						endif;
						?>
						</p>				
        
                        <?php	
                        if (get_user_meta($u_id,'tgt_customer_code',true) == '' && (get_option('tgt_successmail_payment') == "1" ||get_option('tgt_successmail_payment') == "") && $status == 'publish') {
                            $subject = get_option('tgt_mailsubject');
            
                            $websitename = get_bloginfo('name');
                            
                            $u_code = get_user_meta($u_id,'tgt_customer_code',true);
                            $first_name = get_user_meta($u_id,'first_name',true);
                            $last_name = get_user_meta($u_id,'last_name',true);
                            
                            $link_see= HOME_URL.'?action=check&code='.$u_code;
            
                            $message = get_option('tgt_mailcontent');
                            $fullname = $first_name.' '.$last_name;
                            $message = str_replace("[buyer_name]", "".$fullname, $message);
            
                            $message = str_replace("[website_name]", $websitename, $message);
            
                            $message = str_replace("[booking_link]", $link_see, $message);
            				
                            $to = $u_data->user_email;
            
                            $to_name = $fullname ;
            
                            $sub = $subject;
            
                            $mes = $message;
            
                            $from = get_option( 'tgt_mailfrom' );
                            $head = "From $websitename";	            
            
                            /*$headers = 'From: '.$websitename.' <'.$from.'>' . "\r\n" .
            
                                'Reply-To: '.$to_name.' <'.$to.'>' . "\r\n" .
            
                                'X-Mailer: PHP/' . phpversion();*/
                            
                             wp_mail( $to, $sub, $mes, $head);

                             //send mail for admin when pay successful
            				$to_admin = get_option( 'tgt_hotel_email' );
            				$sub_admin = __('Customer booking successfully','hotel');
            				
            				$mes_admin = __("There was a customer booking success!", 'hotel').'<br/>'.__('Email', 'hotel').':'.$to.'<br/>'.__('Details', 'hotel').':'
            						.$link_see.'<br/>'.__('Edit information', 'hotel').':'.WP_URL.' /wp-admin/admin.php?page=my-submenu-handle-add-booking&editbooking=true&uid='.$u_id ;
            				wp_mail($to_admin, $sub_admin, $mes_admin, $head);
                            }	
					}else if($err != '')
					{
				?>
                
						<h1><?php _e( 'Booking Error', 'hotel' ); ?></h1>
						
                		<p class="error"><?php _e( 'Error', 'hotel' ); ?>!</p>
        
                        <p><strong><?php _e( 'Transaction No', 'hotel' ); ?>: <?php echo $u_id; ?></strong></p>
 
                        <p><?php echo $err; ?></p>	 
                
				<?php
					}
                } 
				else { 
				?>	        
                
					<h1><?php _e( 'Booking Error', 'hotel' ); ?></h1>

                    <p class="error"><?php _e( 'There is an error occurred', 'hotel' ); ?>!</p>
        
                    <p><strong><?php _e( 'Transaction No', 'hotel'); ?>: <?php echo $u_id; ?></strong></p>

                    <p><?php _e( 'Something went wrong, please try again', 'hotel' ); ?>.</p>	
                
				<?php 
                    } 
                ?>
			
				<br class="clear-fix" />
				
			</div><!-- .col-left -->
	
			<div class="sidebar">
		
		
				<?php require( TEMPLATEPATH . '/modules/book-online.php' ); ?>
		
		
				<div id="call-us" class="box box-center">
				
					<p><em>Or call us!</em><br /> <strong>202-439-7929</strong><br /> Lisa and David Rosenstein</p>
					
				</div><!-- #call-us .box -->


				<div class="box box-center">
				
				
					<p>Visa and MasterCard accepted.</p>
				
					<p><img src="<?php echo bloginfo( 'template_url' ); ?>/media/cards.gif" alt="" /></p>
				
				
				</div><!-- .box -->


			</div><!-- .sidebar -->
			
			<br class="clear-fix" />
		
		</div><!-- .page-content -->
			
		<br class="clear-fix" />
	
		<span class="deco-shadow">&nbsp;</span>

	</div><!-- #main-content -->

	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>

</div><!-- #content -->

<?php get_footer( 'custom' ); ?>