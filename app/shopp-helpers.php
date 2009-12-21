<?php

function _category($id)
{
	$Shopp = new Shopp();
	$Shopp->Category = new Category($id);
	return $Shopp->Category;
}

function _categories()
{
	$Shopp = new Shopp();
	$Shopp->Catalog = new Catalog();
	$Shopp->Catalog->load_categories();
	return $Shopp->Catalog->categories;
}

function display_categories($type = 'list', $parent = 0)
{
	$return = '';
	$cats = _categories();
	if ($cats != ''):
		foreach ($cats as $cat):
			if ($cat->parent == $parent):
		
				switch ($type)
				{
					case 'option':
						$return .= "<option value=\"$cat->id\">$cat->name</option>";
						break;
					case 'optionurl':
						$return .= "<option value=\"/shop/category/$cat->uri\">$cat->name</option>";
						break;
					case 'list':
						$return .= "<a href=\"/shop/category/$cat->uri\" title=\"$cat->name\">$cat->name</a>, ";
						break;
					case 'links':
						$return[$cat->id] = "<a href=\"/shop/category/$cat->uri\" title=\"$cat->name\">$cat->name</a>";
						break;
					default:
						$return[$cat->id] = $cat->name;
						break;
				}
			endif;
		endforeach;
	else:
		$return = null;
	endif;
	return $return;
}
?>