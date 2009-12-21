<?php
class PaypalLogoWidget extends WP_Widget {
	function PaypalLogoWidget() {
	    parent::WP_Widget(false, $name = 'Paypal Credit Card Logos');	
	}

	function widget($args, $instance) {
	  extract($args);
		echo $before_widget;
		echo '<img src="'.get_bloginfo('template_url') . '/img/paypal-vertical.gif" title="Paypal Credit Card Logos" alt="Credit Card Logos" />';
		echo $after_widget;
	}

}
register_widget('PaypalLogoWidget');
add_action('widgets_init', create_function('', 'return register_widget("PaypalLogoWidget");'));

if (SA_SHOPP_ACTIVE):
class ShoppBrandsJumpMenuWidget extends WP_Widget {
	function ShoppBrandsJumpMenuWidget() {
	    parent::WP_Widget(false, $name = 'Shopp Architect - Brands Jump Menu');	
	}

	function widget($args, $instance) {
    extract($args);
		$parentcat = esc_attr($instance['parentcat']);
		$cats = display_categories('optionurl',$parentcat);
		echo $before_widget;
		echo $before_title;
		echo 'Shop ' . get_bloginfo('name') . ' Brands';
		echo $after_title;
		echo '<form id="sabrandjump" action="" method="post"><select id="sabrandselect" name="sabrandselect"><option value="" selected="selected">Choose a Brand</option>';
		echo $cats;
		wp_nonce_field('sa_nonce', 'sa_nonce');
		echo '</select><input type="submit" name="sabrandsubmit" value="Go" /></form>';
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		return $new_instance;
	}

	function form($instance)
	{
		$parentcat = esc_attr($instance['parentcat']);
?>
		<p><label for="<?php echo $this->get_field_id('parentcat'); ?>"><?php _e('Parent Category:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('parentcat'); ?>" name="<?php echo $this->get_field_name('parentcat'); ?>" type="text" value="<?php echo $parentcat; ?>" /></label></p>
<?php 
	}
}
register_widget('ShoppBrandsJumpMenuWidget');
add_action('widgets_init', create_function('', 'return register_widget("ShoppBrandsJumpMenuWidget");'));
add_action('init','process_shopp_brands_jumpmenu_widget');

function process_shopp_brands_jumpmenu_widget()
{
	if (isset($_POST['sabrandsubmit'])):
		if (wp_verify_nonce($_POST['sa_nonce'], 'sa_nonce')):
			$url = get_option('siteurl') . $_POST['sabrandselect'];
			wp_redirect($url);
			exit;
		endif;
	endif;
}

class ShoppBrandsListWidget extends WP_Widget {
	function ShoppBrandsListWidget() {
	    parent::WP_Widget(false, $name = 'Shopp Architect - Brands List');	
	}

	function widget($args, $instance) {
		extract($args);
		$parentcat = esc_attr($instance['parentcat']);
		$cats = display_categories('links',$parentcat);
		$numcats = count($cats);
		$rem = $numcats % 2;
		if ($rem == 0):
			//even num
			$col = $numcats / 2;
		else:
			$col  = floor($numcats / 2) + 1;
		endif;
		
		echo $before_widget;
		echo $before_title;
		echo 'Shop ' . get_bloginfo('name') . ' Brands';//.' '.$col.' '.$numcats . ' '. $rem;
		echo $after_title;
		echo '<ul id="sabrandslist1">';
		$i = 0;
		foreach($cats as $cat):
			if ($i == $col):
				echo '</ul><ul id="sabrandslist2">';
			endif;
			echo "<li>$cat</li>";
			$i++;
		endforeach;
		echo '</ul>';
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		return $new_instance;
	}

	function form($instance)
	{
		$parentcat = esc_attr($instance['parentcat']);
?>
		<p><label for="<?php echo $this->get_field_id('parentcat'); ?>"><?php _e('Parent Category:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('parentcat'); ?>" name="<?php echo $this->get_field_name('parentcat'); ?>" type="text" value="<?php echo $parentcat; ?>" /></label></p>
<?php 
	}
}
register_widget('ShoppBrandsListWidget');
add_action('widgets_init', create_function('', 'return register_widget("ShoppBrandsListWidget");'));


class ShoppCategoriesMenuWidget extends WP_Widget {
	function ShoppCategoriesMenuWidget() {
		parent::WP_Widget(false,$name = 'Shopp Architect - Categories Menu', array('description'=>'Shopp Widget'));
	}
	
	function widget($args, $instance) {
	  extract($args);

		echo $before_widget;
		echo $before_title;
		echo 'Shop Categories';
		echo $after_title;
		shopp_categories_menu(array('exclude'=>array(33)));
		echo $after_widget;
	}
}
register_widget('ShoppCategoriesMenuWidget');
add_action('widgets_init', create_function('', 'return register_widget("ShoppCategoriesMenuWidget");'));
endif;
?>