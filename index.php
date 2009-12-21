<?php get_header(); ?>

<div id="body_wrap">
	<div class="container">
		
		<div class="span-24">
			<div id="body_shdw_top"></div>
		</div>
		
		<?php get_sidebar('store-left'); ?>
		
		<?php get_sidebar('blog-left'); ?>
		
		<div id="content" class="span-14 last" role="main">
			<div id="middle">
				
				<div class="hfeed">
					<?php include(TEMPLATEPATH . '/app/theloop.php'); ?>
				</div>
				
			</div> <!-- END MIDDLE -->
		</div> <!-- END CONTENT MAIN -->
				
	</div> <!-- END CONTAINER -->
</div> <!-- END BODY WRAP -->
<div id="body_shdw"></div>
<!-- END BODY -->

<?php get_footer(); ?>