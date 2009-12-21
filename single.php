<?php get_header(); ?>
	
<div id="main" class="clearfix container">
	<?php get_sidebar('blog-left'); ?>
		
	<div id="content" class="span-14">
		<div class="hfeed">
			<?php include(TEMPLATEPATH . '/app/theloop.php'); ?>
			<hr />
			<div class="comments">
				<?php comments_template(); ?>
			</div><!-- .comments -->

		</div>
	</div>
		<?php get_sidebar('blog-right'); ?>
</div><!-- end main -->

<?php get_footer(); ?>