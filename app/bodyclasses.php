<?php
// Semantic class functions from Sandbox (http://www.plaintxt.org/themes/sandbox/)
// And K2 (http://www.getk2.com/)

// Generates semantic classes for BODY element
function sa_body_classes( $print = true )
{
	global $wp_query, $current_user, $blog_id;
	
	$c = array('wordpress', 'shopp', 'sa');

	// Applies the time- and date-based classes (below) to BODY element
	sa_date_classes(time(), $c);

	// Generic semantic classes for what type of content is displayed

	is_front_page()      ? $c[] = 'home'       : null;
	is_home()            ? $c[] = 'blog'       : null;
	is_archive()         ? $c[] = 'archive'    : null;
	is_date()            ? $c[] = 'date'       : null;
	is_search()          ? $c[] = 'search'     : null;
	is_paged()           ? $c[] = 'paged'      : null;
	is_attachment()      ? $c[] = 'attachment' : null;
	is_404()             ? $c[] = 'four04'     : null; // CSS does not allow a digit as first character

	if ( is_attachment() ):
		$postID = $wp_query->post->ID;
		the_post();

		// Adds 'single' class and class with the post ID
		$c[] = 'postid-' . $postID . ' s-slug-' . $wp_query->post->post_name;

		// Adds classes for the month, day, and hour when the post was published
		if ( isset($wp_query->post->post_date) )
			sa_date_classes(mysql2date('U', $wp_query->post->post_date), $c, 's-');

		$the_mime = get_post_mime_type();
		$boring_stuff = array('application/', 'image/', 'text/', 'audio/', 'video/', 'music/');
		$c[] = 'attachment-' . str_replace($boring_stuff, '', $the_mime);
		
		// Adds author class for the post author
		$c[] = 's-author-' . sanitize_title_with_dashes(strtolower(get_the_author()));
		rewind_posts();

	// Special classes for BODY element when a single post
	elseif ( is_single() ):
		$postID = $wp_query->post->ID;
		the_post();

		// Adds 'single' class and class with the post ID
		$c[] = 'single postid-' . $postID . ' s-slug-' . $wp_query->post->post_name;

		// Adds classes for the month, day, and hour when the post was published
		if ( isset($wp_query->post->post_date) )
			sa_date_classes(mysql2date('U', $wp_query->post->post_date), $c, 's-');

		// Categories
		foreach ( (array) get_the_category() as $cat ):
			if ( empty($cat->slug ) )
				continue;
			$c[] = 's-category-' . $cat->slug;
		endforeach;

		// Tags
		foreach ( (array) get_the_tags() as $tag ):
			if ( empty($tag->slug ) )
				continue;
			$c[] = 's-tag-' . $tag->slug;
		endforeach;

		// Adds author class for the post author
		$c[] = 's-author-' . sanitize_title_with_dashes(strtolower(get_the_author()));

	 	rewind_posts();

	// Author name classes for BODY on author archives
	elseif ( is_author() ):
		$author = $wp_query->get_queried_object();
		$c[] = 'author';
		$c[] = 'author-' . $author->user_nicename;

	// Category name classes for BODY on category archvies
	elseif ( is_category() ):
		$cat = $wp_query->get_queried_object();
		$c[] = 'category';
		$c[] = 'category-' . $cat->category_nicename;

	// Tag name classes for BODY on tag archives
	elseif ( is_tag() ):
		$tag = $wp_query->get_queried_object();
		$c[] = 'tag';
		$c[] = 'tag-' . $tag->slug;

	// Page author for BODY on 'pages'
	elseif ( is_page() ):
		$pageID = $wp_query->post->ID;
		$page_children = wp_list_pages("child_of=$pageID&echo=0");
		the_post();
		$c[] = 'page pageid-' . $pageID;
		$c[] = 'page-author-' . sanitize_title_with_dashes(strtolower(get_the_author()));
		$c[] = 'page-slug-'.$wp_query->post->post_name;

		// Checks to see if the page has children and/or is a child page; props to Adam
		if ( $page_children != '' ):
			$c[] = 'page-parent';
		endif;

		if ( $wp_query->post->post_parent ):
			$c[] = 'page-child parent-pageid-' . $wp_query->post->post_parent;
		endif;

		rewind_posts();
	endif;

	// Paged classes; for 'page X' classes of index, single, etc.
	$page = intval( $wp_query->get('paged') );
	if ( is_paged() && $page > 1 ):
		$c[] = 'paged-'.$page.'';
		if ( is_single() ):
			$c[] = 'single-paged-'.$page.'';
		elseif ( is_page() ):
			$c[] = 'page-paged-'.$page.'';
		elseif ( is_category() ):
			$c[] = 'category-paged-'.$page.'';
		elseif ( function_exists('is_tag') and is_tag() ):
			$c[] = 'tag-paged-'.$page.'';
		elseif ( is_date() ):
			$c[] = 'date-paged-'.$page.'';
		elseif ( is_author() ):
			$c[] = 'author-paged-'.$page.'';
		elseif ( is_search() ):
			$c[] = 'search-paged-'.$page.'';
		endif;
	endif;

	// For when a visitor is logged in while browsing
	if ( $current_user->ID )
		$c[] = 'loggedin';

	// Language settings
	$locale = get_locale();
	if ( empty($locale) ):
		$locale = 'en';
	else:
		$lang_array = split('_', $locale);
		$locale = $lang_array[0];
	endif;
	$c[] = 'lang-' . $locale;

    // For WPMU. Set a class for the blog ID    
    if ( isset($blog_id) )
        $c[] = 'wpmu-' . $blog_id;

	// Separates classes with a single space, collates classes for BODY
	$c = attribute_escape( join( ' ', apply_filters('body_class', $c) ) );

	// And tada!
	return $print ? print($c) : $c;
}

function sa_post_class( $post_count = 1, $post_asides = false, $print = true )
{
	_deprecated_function(__FUNCTION__, '0.0', 'post_class()');
	$c = join( ' ', get_post_class() );
	return $print ? print($c) : $c;
}

function sa_comment_class_filter($classes)
{
	global $comment;
	sa_date_classes(mysql2date('U', $comment->comment_date), $classes, 'c-');
	return $classes;
}
add_filter('comment_class', 'sa_comment_class_filter');

// Generates time- and date-based classes for BODY, post DIVs, and comment LIs; relative to GMT (UTC)
function sa_date_classes($t, &$c, $p = '')
{
	$t = $t + (get_option('gmt_offset') * 3600);
	$c[] = $p . 'y' . gmdate('Y', $t); // Year
	$c[] = $p . 'm' . gmdate('m', $t); // Month
	$c[] = $p . 'd' . gmdate('d', $t); // Day
	$c[] = $p . 'h' . gmdate('H', $t); // Hour
}
?>