<?php

	define('SA_SHOPP_ACTIVE',function_exists('shopp'));
		
	include(TEMPLATEPATH . '/app/sidebars.php');
	include(TEMPLATEPATH . '/app/sa-widgets.php');
	include(TEMPLATEPATH . '/app/bodyclasses.php');
	include(TEMPLATEPATH . '/app/formatting.php');
	include(TEMPLATEPATH . '/app/comments.php');
	include(TEMPLATEPATH . '/app/navigation.php');
	
	if (!defined('SA_ENTRY_META')):
		define('SA_ENTRY_META',"Published on %date% at %time% in %categories% by %author%. %comments% \n %tags%");
	endif;
	
	if (SA_SHOPP_ACTIVE):
		include(TEMPLATEPATH . '/app/shopp-helpers.php');
		add_action('sa_mainnav_links','shopp_categories_navigation',10, 1);
	endif;

?>