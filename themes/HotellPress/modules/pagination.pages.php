<?php
if ( ! class_exists( 'WPPaginate' ) ) {

	class WPPaginate {

		/**
		* @var array $options Stores the options for this plugin
		*/
		var $options	= array(
			'title'			=> '',
			'nextpage'		=> '<strong>Next</strong> &raquo;',
			'previouspage'	=> '&laquo; <strong>Previous</strong>',
			'before' 		=> '<div class="pagination">',
			'after'			=> '</div><!-- .pagination -->',
			'empty' 		=> true,
			'range' 		=> 3,
			'anchor' 		=> 1,
			'gap' 			=> 3
		);

		var $type		= 'posts';

		/**
		* PHP 4 Compatible Constructor
		*/
		function WPPaginate() { $this->__construct(); }

		/**
		* PHP 5 Constructor
		*/
		function __construct() {}

		/**
		* Pagination based on options/args
		*/
		function paginate( $args = false ) {
			if ($this->type === 'comments' && !get_option('page_comments'))
				return;

			$r = wp_parse_args($args, $this->options);
			extract($r, EXTR_SKIP);

			if ( ! isset( $page ) && ! isset( $pages ) ) :
			
				global $wp_query;
			
				if ( $this->type === 'posts' ) :
			
					$page 			= get_query_var( 'paged' );
					$posts_per_page = intval( get_query_var( 'posts_per_page' ) );
					$pages 			= intval( ceil( $wp_query->found_posts / $posts_per_page ) );
				else :
					$page 				= get_query_var( 'cpage' );
					$comments_per_page 	= get_option( 'comments_per_page' );
					$pages 				= get_comment_pages_count();
				endif;
				
				$page = ( ! empty( $page ) ? intval( $page ) : 1 );
			
			endif;

			$prevlink = ($this->type === 'posts')
				? esc_url(get_pagenum_link($page - 1))
				: get_comments_pagenum_link($page - 1);
			$nextlink = ($this->type === 'posts')
				? esc_url(get_pagenum_link($page + 1))
				: get_comments_pagenum_link($page + 1);

			$output = stripslashes($before);
			if ($pages > 1) {
				$output .= sprintf('<ol class="wp-paginate%s">', ($this->type === 'posts') ? '' : ' wp-paginate-comments');
				if ( $title != '' ) :
				$output .= sprintf('<li><span class="title">%s</span></li>', stripslashes($title));
				endif;
				$ellipsis = "<li><span class='gap'>...</span></li>";

				$min_links = $range * 2 + 1;
				$block_min = min($page - $range, $pages - $min_links);
				$block_high = max($page + $range, $min_links);
				$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
				$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

				if ($left_gap && !$right_gap) {
					$output .= sprintf('%s%s%s',
						$this->paginate_loop(1, $anchor),
						$ellipsis,
						$this->paginate_loop($block_min, $pages, $page)
					);
				}
				else if ($left_gap && $right_gap) {
					$output .= sprintf('%s%s%s%s%s',
						$this->paginate_loop(1, $anchor),
						$ellipsis,
						$this->paginate_loop($block_min, $block_high, $page),
						$ellipsis,
						$this->paginate_loop(($pages - $anchor + 1), $pages)
					);
				}
				else if ($right_gap && !$left_gap) {
					$output .= sprintf('%s%s%s',
						$this->paginate_loop(1, $block_high, $page),
						$ellipsis,
						$this->paginate_loop(($pages - $anchor + 1), $pages)
					);
				}
				else {
					$output .= $this->paginate_loop(1, $pages, $page);
				}

				$output .= "</ol>";

				$output .= '<ul class="wp-paginate-prev-next">';
				if ( $page > 1 && ! empty( $previouspage ) ) :
					$output .= sprintf( '<li><a href="%s" class="prev">%s</a></li>', $prevlink, stripslashes( $previouspage ) );
				endif;
				if ( $page < $pages && ! empty( $nextpage ) ) :
					$output .= sprintf( '<li><a href="%s" class="next">%s</a></li>', $nextlink, stripslashes( $nextpage ) );
				endif;

			}
			$output .= stripslashes($after);

			if ( $pages > 1 ) :
				return $output;
			endif;
		}

		/**
		* Helper function for pagination which builds the page links.
		*/
		function paginate_loop($start, $max, $page = 0) {
			$output = "";
			for ($i = $start; $i <= $max; $i++) {
				$p = ($this->type === 'posts') ? esc_url(get_pagenum_link($i)) : get_comments_pagenum_link($i);
				$output .= ($page == intval($i))
					? "<li><span class='page current'>$i</span></li>"
					: "<li><a href='$p' title='$i' class='page'>$i</a></li>";
			}
			return $output;
		}
		
	}
	
}

// Instantiate the class
if ( class_exists( 'WPPaginate' ) ) :

	$wp_paginate = new WPPaginate();

endif;

/**
* Pagination function to use for posts
*/
function wp_paginate( $args = false ) {
	
	global $wp_paginate;
	
	$wp_paginate->type	= 'posts';
	
	return $wp_paginate->paginate( $args );

}

/**
* Pagination function to use for post comments
*/
function wp_paginate_comments( $args = false ) {
	
	global $wp_paginate;
	
	$wp_paginate->type 	= 'comments';
	
	return $wp_paginate->paginate( $args );

}

echo wp_paginate();

?>