<?php get_header (); ?>


<h1 class="heading">Search results for: <strong><?php echo get_search_query (); ?></strong></h1>


<?php if ( ! have_posts () ) : ?>

	<?php require ( 'modules/empty.php' ); ?>

<?php else : ?>

	<ul class="newslist">
		
	<?php get_template_part ( 'loop' ); ?>
	
	</ul>
	
<?php endif; ?>


<?php require ( 'modules/pagination.php' ); ?>

			
<?php get_footer (); ?>