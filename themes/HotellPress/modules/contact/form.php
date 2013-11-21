<?php defined( 'SECURE' ) or die( 'Apologies, but the page you requested could not be found.' ); ?>

<div class="post-comment">

	<form action="#" method="post" id="contactform" class="default-form">

		<fieldset>
		
			<p class="half">
			
				<label>Name:</label>
				
				<span class="field-text"><input type="text" name="name" /></span>
			
			</p>
		
			<p class="half">
			
				<label>Last Name:</label>
				
				<span class="field-text"><input type="text" name="lname" /></span>
			
			</p>
		
			<p class="half">
			
				<label>Email:</label>
				
				<span class="field-text"><input type="text" name="email" /></span>
			
			</p>
		
			<p class="half">
			
				<label>Phone number:</label>
				
				<span class="field-text"><input type="text" name="phone" /></span>
			
			</p>
		
			<p>
			
				<label>Message:</label>
				
				<span class="field-textarea"><textarea name="message" rows="5" cols="50"></textarea></span>
			
			</p>
			
			<p class="button">
			
				<button type="submit" class="formbutton hidden-txt">Post comment</button>
	
				<span class="formloader"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/modules/contact/loader.gif" alt="sending..." class="no-deco" /></span>
				
			</p>
	
			<div class="formresult">&nbsp;</div>
			<!-- .formresult -->
	
		</fieldset>
	
	</form>

</div><!-- .post-comment -->

<script type="text/javascript">

	//<![CDATA[

	jQuery( '#contactform' ).submit( function () {

		jQuery( '.formbutton' ).hide();

		jQuery( '.formloader' ).show();

		jQuery( '.formresult' ).slideUp( 'fast' );

		jQuery.get('<?php echo get_bloginfo( 'template_url' ); ?>/loader.php?module=contact', jQuery( '#contactform' ).serialize(), function ( data ) {

			if ( data == '1' ) {

				jQuery( '#contactform' ).each( function () { this.reset(); } );

				jQuery( '.formresult' ).html( '<span class="formsuccess"><strong>Thanks!</strong> Your request has been sent successfully.</span>' );

				jQuery( '.formloader' ).hide();
				
				jQuery( '.formbutton' ).show();

				jQuery( '.formresult' ).fadeIn();

			} else {

				jQuery( '.formresult' ).html( data );

				jQuery( '.formloader' ).hide();
				
				jQuery( '.formbutton' ).show();

				jQuery( '.formresult' ).fadeIn();

			}

		} );

		return false;

	} );

	//]]>

</script>