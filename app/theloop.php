<?php
	// Custom Loop Engine by K2 (http://getk2.com/)
	
	// This is the loop, which fetches entries from your database.
	// It is a very delicate piece of machinery. Be gentle!
	
	// array for loading loop templates
	$templates = array();
	$page_head = '';
	
	if ( is_home() ):
		$templates[] = 'blocks/sa-loop-home.php';

	elseif ( is_archive() ):
		if ( is_date() ):
			the_post();

			if ( is_day() ):
				$templates[] = 'blocks/sa-loop-archive-day.php';
				$page_head = sprintf( 'All Posts for %s', get_the_time( 'F jS, Y' ) );

			elseif ( is_month() ):
				$templates[] = 'blocks/sa-loop-archive-month.php';
				$page_head = sprintf( 'All Posts  for %s', get_the_time( 'F, Y' ) );

			elseif ( is_year() ):
				$templates[] = 'blocks/sa-loop-archive-year.php';
				$page_head = sprintf( 'All Posts  for %s', get_the_time( 'Y' ) );
			endif;

			$templates[] = 'blocks/sa-loop-archive-date.php';

			rewind_posts();
		elseif ( is_category() ):
			$templates[] = 'blocks/sa-loop-category-' . absint( get_query_var('cat') ) . '.php';
			$templates[] = 'blocks/sa-loop-category.php';
			$page_head = sprintf( 'All Posts in \'%s\' Category', single_cat_title('', false) );
			
		elseif ( is_tag() ):
			$templates[] = 'blocks/sa-loop-tag-' . get_query_var('tag') . '.php';
			$templates[] = 'blocks/sa-loop-tag.php';
			$page_head = sprintf( 'Tag Archive for \'%s\'', single_tag_title('', false) );
			
		elseif ( is_author() ):
			$templates[] = 'blocks/sa-loop-author.php';
			$page_head = sprintf( 'All Posts by %s', get_author_name( get_query_var('author') ) );
		endif;
		
		$templates[] = 'blocks/sa-loop-archive.php';
	elseif ( is_search() ):
		$templates[] = 'blocks/sa-loop-search.php';
		$page_head = sprintf( 'Search Results for \'%s\'', attribute_escape( get_search_query() ) );
	endif;

	$templates[] = 'blocks/sa-loop.php';
?>

	<?php /* Top Navigation */ sa_navigation('pager-top'); ?>

	<?php if ( ! empty($page_head) ): ?>
		<div class="page-head">
			<h1><?php echo $page_head; ?></h1>

			<?php if ( is_paged() ): ?>
				<h2 class="archivepages"><?php printf( 'Page %1$s of %2$s', intval( get_query_var('paged')), $wp_query->max_num_pages); ?></h2>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( have_posts() ): ?>

		<?php locate_template( $templates, true ); ?>
	
	<?php else: define('SA_NOT_FOUND', true); ?>
		<?php include(TEMPLATEPATH . 'blocks/four04.php'); ?>
	<?php endif; ?>
	<?php sa_navigation('pager-bottom'); ?> 
