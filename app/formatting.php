<?php
/**
 *	Formatting Functions, mostly adapted from K2 (http://getk2.com/)
 *	Much of it in microformat (hAtom, hCard, etc)
 */
function sa_navigation($id = 'pager-top')
{
?>

	<div id="<?php echo $id; ?>" class="navigation">

	<?php if ( is_single() ): ?>
		<div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">&laquo;</span> %title') ?></div>
		<div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">&raquo;</span>') ?></div>
	<?php else: ?>
		<?php $_SERVER['REQUEST_URI']  = preg_replace("/(.*?).php(.*?)&(.*?)&(.*?)&_=/","$2$3",$_SERVER['REQUEST_URI']); ?>
		<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&laquo;</span> Previous' ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Next <span class="meta-nav">&raquo;</span>' ); ?></div>
	<?php endif; ?>

		<div class="clearfix"></div>
	</div>

<?php
}
// another lift from k2
function sa_gallery_link($output) {
	global $sa_image_link;

	switch ($sa_image_link) {
		case 'prev':
			$output = str_replace('</a>', '<span>&laquo; Previous</span></a>', $output);
			break;

		case 'next':
			$output = str_replace('</a>', '<span>Next &raquo;</span></a>', $output);
			break;
	}

	return $output;
}
add_filter('wp_get_attachment_link', 'sa_gallery_link');

/**
 *	Nice Category List
 *	By Mark Jaquith, http://txfx.net 
 *	and lifted from K2 (http://getk2.com)
*/
function sa_nice_category($normal_separator = ', ', $penultimate_separator = ' and ')
{ 
	$categories = get_the_category(); 

	if (empty($categories)):
		return 'Uncategorized';
	endif;

	$thelist = ''; 
	$i = 1; 
	$n = count($categories); 

	foreach ($categories as $category): 
		if (1 < $i and $i != $n):
			$thelist .= $normal_separator;
		endif;

		if (1 < $i and $i == $n):
			$thelist .= $penultimate_separator;
		endif;

		$thelist .= '<a href="' . get_category_link($category->cat_ID) . '" title="' . sprintf("View all posts in %s", $category->cat_name) . '">'.$category->cat_name.'</a>';
		++$i; 
	endforeach;
	
	return apply_filters('the_category', $thelist, $normal_separator);
}

/**
 *	Override this in wp-config with a string specifying the format in a constant called SA_ENTRY_META
 *	
 */
function sa_entry_meta()
{
	$entrymeta = nl2br( preg_replace( '/%(.+?)%/', '[entry_$1]', SA_ENTRY_META ) );
	echo do_shortcode($entrymeta);
}

/**
 *	These functions can also be used as shortcodes in the post -- see below for the shortcode names
 */
function sa_entry_date()
{
	global $post;
	
	$output = '<abbr class="published entry-date" title="' . get_the_time('Y-m-d\TH:i:sO') . '">';
	if ( function_exists('time_since') ):
		$output .= sprintf('%s ago', time_since( abs( strtotime( $post->post_date_gmt . ' GMT' ) ), time() ) );
	else:
		$output .= get_the_time( get_option('date_format') );
	endif;
	$output .= '</abbr>';
	
	return $output;
}

function sa_entry_categories() {
	return '<span class="entry-categories">' . sa_nice_category(', ', ' and ') . '</span>';
}

function sa_entry_author() {
	return '<span class="vcard author entry-author"><a href="' . get_author_posts_url( get_the_author_ID() ) .
			'" class="url fn" title="' . sprintf( 'View all posts by %s', esc_attr( get_the_author() ) ) .
			'">' . get_the_author() . '</a></span>';
}

function sa_entry_tags()
{
	if ( $tags = get_the_tag_list('<span>Tags:</span> ', ', ', '.' ) ):
		return '<span class="entry-tags">' . $tags . '</span>';
	endif;
	
	return $tags;
}

function sa_entry_comments()
{
	ob_start();
	comments_popup_link('0 <span>Comments</span>', '1 <span>Comment</span>', '% <span>Comments</span>', 'commentslink', '<span>Closed</span>' );
	return '<span class="entry-comments">' . ob_get_clean() . '</span>';
}


function sa_entry_time()
{
	return '<span class="entry-time">' . get_the_time( get_option('time_format') ) . '</span>';
}

/**
 *	The ones on the left are the shortcode tag
 *	@see http://codex.wordpress.org/Function_Reference/add_shortcode
 */
add_shortcode('entry_author', 'sa_entry_author');
add_shortcode('entry_categories', 'sa_entry_categories');
add_shortcode('entry_comments', 'sa_entry_comments');
add_shortcode('entry_date', 'sa_entry_date');
add_shortcode('entry_tags', 'sa_entry_tags');
add_shortcode('entry_time', 'sa_entry_time');
?>