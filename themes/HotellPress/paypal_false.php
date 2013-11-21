<?php get_header( 'custom' );?> 

<div id="content" class="page-full">

	<div id="main-content">
	
		<div class="page-content page-content-deco default-styles">
		
			<h1><?php _e( 'Payment False', 'hotel' ); ?></h1>
			
			<div class="col-left">

				<?php _e( 'Your transaction has been false, please try again.' ); ?>
			
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