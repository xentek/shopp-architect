<?php
/**
 *	Navigation and Menu Functions
 */
function shopp_categories_navigation($options = array('exclude' => null)) {
	extract($options);
	$cats = (SA_SHOPP_ACTIVE) ? display_categories('links') : null;
	$exclude = array(71,77,83,92,93,96,91);
?>
<?php if (!is_null($cats)): ?>
	<?php foreach ($cats as $key => $cat): ?>
		<?php if (!in_array($key,$exclude)): ?>
			<?php $subcats = display_categories('links',$key); ?>
				<li class="shopp-cat-<?php echo $key; ?>">
					<?php echo $cat; ?>
					<?php if ($subcats != '' && count($subcats) <= 8): ?>
						<ul id="mainnav-sub-<?php sanitize_title_with_dashes($sub); ?>">
							<?php foreach($subcats as $subkey => $subcat): ?>
								<li cat="shopp-cat-<?php echo $subkey; ?> shopp-parent-<?php echo $key; ?>"><?php echo $subcat; ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
		<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php }

function shopp_categories_menu($options = array('exclude' => NULL)) {
	extract($options);
	$cats = (SA_SHOPP_ACTIVE) ? display_categories('links') : null;
?>
<?php if (!is_null($cats)): ?>
	<?php foreach ($cats as $key => $cat): ?>
		<?php if (!in_array($key,$exclude)): ?>
			<?php $subcats = display_categories('links',$key); ?>
				<h5 class="shopp-cat-<?php echo $key; ?>"><?php echo $cat; ?></h5>
					<?php if (!is_null($subcats)): ?>
						<ul>
							<?php foreach($subcats as $subkey => $subcat): ?>
								<li cat="shopp-cat-<?php echo $subkey; ?> shopp-parent-<?php echo $key; ?>"><?php echo $subcat; ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
		<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php } ?>