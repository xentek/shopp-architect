<div id="error-404" class="hentry four04">

	<div class="entry-head">
		<h3>Looking for something at <?php bloginfo('name')?>?</h3>
	</div>

	<div class="entry-content">
		<p>The page you requested can not be found.</p>
		<ul>
			<li>If you typed the URL yourself, double check the spelling and try again.</li>
			<li>If you clicked on a link on this site to get here, please <a href="mailto:<?php bloginfo('admin_email'); ?>">tell us about it</a></li>
			<li>If you clicked on a link from another site to get here, there may be a problem with the link.</li>
			<li>You may also try using your browser's back button and choosing another link from the previous page.</li>
		</ul>
		<hr />
		<h4>Search all of <?php bloginfo('name'); ?>:</h4>
		<?php get_search_form(); ?>
		<hr />
		<?php if (SA_SHOPP_ACTIVE): ?>
			<?php shopp('catalog','featured-products','show=3&controls=false'); ?>
		<?php endif; ?>
	</div>
</div><!-- end error-404 -->