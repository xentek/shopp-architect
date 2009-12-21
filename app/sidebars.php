<?php
/**
 *	Register Sidebars with these names
 */
$decorators = array(
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
);

$sidebars = array(
				array(
					'name' => 'Store - Left Sidebar',
					'id' => 'store-left',
				),
				array(
					'name' => 'Store - Product Left Sidebar',
					'id' => 'store-product-left',
				),
				array(
					'name' => 'Store - Right Sidebar',
					'id' => 'store-right',
				),
				array(
					'name' => 'Home Page - Above Products',
					'id' => 'home-top'
				),
				array(
					'name' => 'Home Page - Below Products (Left)',
					'id' => 'home-bottom-left'
				),
				array(
					'name' => 'Home Page - Below Products (Right)',
					'id' => 'home-bottom-right'
				),
				array(
					'name' => 'Home Page - Scroller',
					'id' => 'home-scroller'
				),
				array(
					'name' => 'Home Page - Bottom',
					'id' => 'home-bottom'
				),
				array(
					'name' => 'Blog - Left Sidebar',
					'id' => 'blog-left',
				),
				array(
					'name' => 'Blog - Right Sidebar',
					'id' => 'blog-right',
				),
				array(
					'name' => 'Footer Area 1',
					'id' => 'footer-1',
				),
				array(
					'name' => 'Footer Area 2',
					'id' => 'footer-2',
				),
				array(
					'name' => 'Footer Area 3',
					'id' => 'footer-3',
				),
			); 
			
foreach($sidebars as $sidebar):
	register_sidebar(array_merge($sidebar, $decorators)); // decorators can be overriden by adding the same array keys to the items in the sidebars array
endforeach;
?>