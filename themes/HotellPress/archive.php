<?php get_header(); ?>

<div id="main-content-wrapper" class="blog">


	<div class="main-content default-style">
	
	
		<h1>Monthly archives: <strong><?php echo get_the_date ( 'F Y' ); ?></strong></h1>
	
		<?php get_template_part( 'loop' ); ?>
	
		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e5faecc2c1ac9e7"></script>
		
		
		<?php require( 'modules/pagination.pages.php' ); ?>
		
	
		<br class="clear-fix" />
		
	
	</div><!-- .main-content -->
	

	<div class="main-content right-content default-style">
	
		<?php get_sidebar(); ?>
			
	</div><!-- .main-content .default-style -->
	
	
	<br class="clear-fix" />
	

</div><!-- #main-content-wrapper -->

<?php get_footer(); ?>