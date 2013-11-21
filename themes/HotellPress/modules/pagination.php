<?php if (  $wp_query->max_num_pages > 1 ) : ?>

<div class="pagenav">

	<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts' ) ); ?></div>

	<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>' ) ); ?></div>

	<br class="clear-fix" />

</div><!-- pagenav -->

<?php endif; ?>