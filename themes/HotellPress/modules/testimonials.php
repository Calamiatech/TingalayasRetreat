<div id="testimony" class="box">

	
	<h3>Testimonials</h3>

	<?php $testimonials = getGroupOrder( 'testimony_content', 2 ); // Get testimonials ?>

	<?php foreach ( $testimonials as $testimony ) : ?>
	
	<div class="testimony">
	
		<p><?php echo get( 'testimony_content', $testimony, 1, 0, 2 ); ?></p>
   
		<p class="author">-<?php echo get( 'testimony_author', $testimony, 1, 0, 2 ); ?></p>
	
	</div><!-- .testimony-->
	
	<?php endforeach; ?>

	<p class="read-reviews"><span>Read more guest reviews from</span> <a href="<?php echo get_permalink( 12 ); ?>" rel="nofollow" target="_blank"><img src="<?php echo get_bloginfo( 'template_url' ); ?>/media/flip-key.gif" alt="Flip Key" /></a></p> 


</div><!-- #testimony -->