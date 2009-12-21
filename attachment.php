<?php get_header(); ?>
	
<div id="main" class="clearfix">
	<?php get_sidebar('blog-left'); ?>
		
	<div id="content" class="span-14">
		<div class="hfeed">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php if ( ! empty($post->post_parent) ): ?>
				<div class="navigation">
					<div class="nav-previous"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><span>&laquo;</span> <?php echo get_the_title($post->post_parent); ?></a></div>
					<div class="clearfix"></div>
				</div>
				<?php endif; ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-head">
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php k2_permalink_title(); ?>"><?php the_title(); ?></a>
						</h1>

						<div class="attachment-icon">
							<?php echo wp_get_attachment_link($post->ID, 'thumbnail', false, true); ?>
						</div>
					</div> <!-- .entry-head -->

					<div class="entry-content">
						<p class="downloadlink">
							<?php printf(  __('Download %s', 'k2_domain'), wp_get_attachment_link($post->ID, 'thumbnail') ); ?>
							<span class="file-size"><?php echo size_format( filesize( get_attached_file($post->ID) ) ); ?></span>
						<p>

						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-ID -->

				<div class="comments">
					<?php comments_template(); ?>
				</div><!-- .comments -->

				<?php if ( ! empty($post->post_parent) ): ?>
				<div class="navigation">
					<div class="nav-previous"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><span>&laquo;</span> <?php echo get_the_title($post->post_parent); ?></a></div>
					<div class="clear"></div>
				</div>
				<?php endif; ?>

			<?php endwhile; else: define('SA_NOT_FOUND', true); ?>
				<?php include(TEMPLATEPATH . '/blocks/four04.php'); ?>
			<?php endif; ?>
		</div><!-- end hfeed -->
	</div> <!-- content -->

	<?php get_sidebar('blog-right'); ?>
</div><!-- end main -->

<?php get_footer(); ?>