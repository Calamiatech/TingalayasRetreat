<?php $options = get_option ( 'plugin_options' ); ?>

<div id="social">

	
	<h3>Connect with us!</h3>

	<p>
	
		<!-- a href="<?php echo ( $options['account_twitter'] != '' ? $options['account_twitter'] : '#' ); ?>" title="Follow us on Twitter" rel="nofollow"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/tw.jpg" alt="Twitter" /></a -->
		
		<a href="<?php echo ( $options['account_facebook'] != '' ? $options['account_facebook'] : '#' ); ?>" title="Follow us on Facebook" rel="nofollow"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/fb.jpg" alt="Facebook" /></a>
		
		<a href="<?php echo ( $options['account_vimeo'] != '' ? $options['account_vimeo'] : '#' ); ?>" title="Follow us on Vimeo" rel="nofollow"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/vi.jpg" alt="Vimeo" /></a>
		
		<a href="<?php echo ( $options['account_youtube'] != '' ? $options['account_youtube'] : '#' ); ?>" title="Follow us on YouTube" rel="nofollow"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/yt.jpg" alt="YouTube" /></a>
		
		<a href="<?php echo ( $options['account_flickr'] != '' ? $options['account_flickr'] : '#' ); ?>" title="Follow us on Flickr" rel="nofollow"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/fl.jpg" alt="Flickr" /></a>
		
	</p>


</div><!-- #social -->