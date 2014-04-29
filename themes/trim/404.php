<?php get_template_part('templates/page', 'header'); ?>

<div class="alert alert-warning">
  <?php _e('Sorry, but the page you were trying to view does not exist.', 'trim'); ?>
</div>

<p><?php _e('It looks like this was the result of either:', 'trim'); ?></p>
<ul>
  <li><?php _e('a mistyped address', 'trim'); ?></li>
  <li><?php _e('an out-of-date link', 'trim'); ?></li>
</ul>

<?php get_search_form(); ?>
