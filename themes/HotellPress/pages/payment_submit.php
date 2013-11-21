<?php get_header( 'custom' );?> 

<div id="content" class="page-full">

	<div id="main-content">
	
		<div class="page-content default-styles">
		
			<h1>Payment Process</h1>

			<?php if ( isset( $_POST['payment_type'] ) && ! empty( $_POST['payment_type'] ) ) : ?>
				<?php
				$uid		= $_POST['u_id'];
				$paid		= get_user_meta( $uid, 'tgt_total_price', true );
				$promotion	= $_POST['promotion'];
				update_user_meta( $uid, META_USER_PROMOTION, $promotion );
				?>
				<?php if ( $_POST['payment_type'] == 'paypal' ) : ?>
			
					<p><?php _e( 'The system is redirecting to Paypal automatically. Please waitting.', 'hotel' ); ?></p>
			
					<form action="<?php echo $_POST['payment_page']; ?>" method="post" name="paymentform" id="paymentform">
					
						<fieldset>
					
							<input type="hidden" name="return" id="paypal_return" value="<?php echo get_user_meta( $uid, 'tgt_paypal_return', true ); ?>" />
							<input type="hidden" name="cancel_return" id="paypal_cancel_return"  value="<?php echo get_user_meta( $uid, 'tgt_paypal_cancel_return', true ); ?>" />  
							<input type="hidden" name="cmd" value="_ext-enter" />
							<input type="hidden" name="cmd" value="_ext-enter" />
							<input type="hidden" name="redirect_cmd" value="_xclick" />
							<input type="hidden" name="business" value="<?php echo get_option( 'tgt_paypal_email' ); ?>" />
							<input type="hidden" name="rm" value="2" />            
							<input type="hidden" name="currency_code" value="<?php echo get_option( 'tgt_currency' ); ?>" />           
							<input type="hidden" name="quantity" value="1" />            
							<input type="hidden" name="item_name" value="<?php bloginfo( 'name' ); ?> Booking Submission" />
							<input type="hidden" name="amount" id="amount" value="<?php echo $paid;?>" />
							<input type="hidden" name="cbt" value="<?php _e( 'Click here to confirm your transaction &rarr;', 'hotel' );?>" />
							
						</fieldset>
						
					</form>
			
				<?php elseif ( $_POST['payment_type'] == '2checkout' ) : ?>
			
					<p><?php _e( 'The system is redirecting to 2Checkout automatically. Please waitting.', 'hotel' ); ?></p>
			
					<?php
					$product_id 			= get_option( 'tgt_2checkout_product_id', true );
					$product_price 			= get_option( 'tgt_2checkout_product_price', true );
					$product_name 			= get_option( 'tgt_2checkout_product_name', true );
					$product_description 	= get_option( 'tgt_2checkout_product_description', true );
					$extfields 				= get_user_meta( $uid, 'tgt_user_information', true );
					$products 				= array(
						array( 
							'id' 			=> $product_id, 
							'quantity' 		=> '1', 
							'price' 		=> $product_price, 
							'name' 			=> $product_name,  
							'description' 	=> $product_description 
						)
					);
					$op 					= array(
						'seller'			=> get_option( 'tgt_seller_id', true ),	
						'secret_key'		=> get_option( 'tgt_2checkout_secret_key', true ),	  
						'successful_url' 	=> HOME_URL . '/?action=payment_success&payment_method=2checkout',	
						'test_mod'			=> 0,	// 1 or 0
						'test_email'		=> '',//trieubv@yw.vn
						'submit'			=> '',
						'total'				=> $paid,
						'order_id'			=> $uid,
						'form'				=> 'paymentform'
					);
					
					$pay 					= DC2Checkout::getInstance();
					$pay->setData( $products, $op, $extfields);
					$pay->generalHTML();
					?>
					
				<?php endif; ?>
				
			<?php endif; ?>
			
			<script type="text/javascript">
				jQuery( document ).ready( function() {
					document.paymentform.submit();
				} );
			</script>

			<br class="clear-fix" />
			
		</div><!-- .page-content -->
		
		<br class="clear-fix" />
	
		<span class="deco-shadow">&nbsp;</span>
	
	</div><!-- #main-content -->

	<?php require( TEMPLATEPATH . '/modules/social-networks.php' ); ?>

</div><!-- #content -->

<?php get_footer( 'custom' ); ?>