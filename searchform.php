<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
    Search: <label class="searchbutton2">
      <?php shopp('catalog','search','type=radio&option=shopp'); ?><span class="labelgap">Store</span>
    </label>
    <label class="searchbutton1">
    <?php shopp('catalog','search','type=radio&option=blog'); ?><span class="labelgap">Blog</span></label><br />
      
    <input type="text" value="" name="s" id="s" class="searchfield" />
    <input type="submit" class="searchsubmit" name="searchsubmit" value="Find"><br />
    </form>
<script type="text/javascript" charset="utf-8">
  jQuery(document).ready(function(){
    searchclicker();
  });
  function searchclicker()
  {
    jQuery("input[name='st']")[0].checked = true;
  }
</script>