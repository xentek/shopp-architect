<?php $sa_image_link = false; // just setting the default ?>

<?php get_header(); ?>
	
<div id="main" class="clearfix">
	<?php get_sidebar('blog-left'); ?>
		
	<div id="content" class="span-14">
		<div class="hfeed template-image">

		<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

			<?php if ( ! empty($post->post_parent) ): ?>
			<div class="navigation">
				<div class="nav-previous"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><span>&laquo;</span> <?php echo get_the_title($post->post_parent); ?></a></div>
				<div class="clear"></div>
			</div>
			<?php endif; ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-head">
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h1>
				</div> <!-- .entry-head -->

				<div class="entry-content">
					<div class="attachment-image">
						<a href="<?php echo wp_get_attachment_url($post->ID); ?>" class="image-link"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a>

						<?php if ( !empty($post->post_excerpt) ): ?>
						<div class="caption"><?php the_excerpt(); ?></div>
						<?php endif; ?>
					</div>

					<?php if ( !empty($post->post_content) ) the_content(sprintf(__('Continue reading \'%s\'', 'sa_domain'), the_title('', '', false))); ?>
				</div> <!-- .entry-content -->

				<div class="entry-foot">
					<h5><?php _e('Photo Information', 'sa_domain'); ?></h5>
					<ul class="image-meta">
						<li class="dimensions">
							<span><?php _e('Dimensions:','sa_domain'); ?></span>
							<?php
								list($width, $height) = getimagesize( get_attached_file($post->ID) );
								printf( _c('%1$s &times; %2$s pixels|1: width, 2: height','sa_domain'), $width, $height );
							?>
						</li>
						<li class="file-size">
							<span><?php _e('File Size:','sa_domain'); ?></span>
							<?php echo size_format( filesize( get_attached_file($post->ID) ) ); ?>
						</li>
						<li class="uploaded">
							<span><?php _e('Uploaded on:','sa_domain'); ?></span>
							<?php
								if ( function_exists('time_since') ):
									printf( __('%s ago','sa_domain'),
										'<abbr class="published" title="' . get_the_time('Y-m-d\TH:i:sO') . '">' . time_since(abs(strtotime($post->post_date_gmt . " GMT")), time()) . '</abbr>');
								else:
							?><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php the_time( get_option('date_format') ); ?></abbr><?php endif; ?>
						</li>

						<?php do_action('sa_image_meta', $post->ID); ?>
					</ul>

					<div id="gallery-nav" class="navigation">
						<div class="nav-previous">
							<?php $sa_image_link = 'prev'; previous_image_link(); $sa_image_link = false; ?>
						</div>
						<div class="nav-next">
							<?php $sa_image_link = 'next'; next_image_link(); $sa_image_link = false; ?>
						</div>
						<div class="clear"></div>
					</div>
				</div><!-- .entry-foot -->
			</div> <!-- #post-ID -->

			<div class="comments">
				<?php comments_template(); ?>
			</div> <!-- .comments -->

			<?php if ( ! empty($post->post_parent) ): ?>
			<div class="navigation">
				<div class="nav-previous"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><span>&laquo;</span> <?php echo get_the_title($post->post_parent); ?></a></div>
				<div class="clear"></div>
			</div>
			<?php endif; ?>

		<?php endwhile; define('SA_NOT_FOUND',true); else: ?>
			<?php include(TEMPLATEPATH . '/blocks/four04.php'); ?>

		<?php endif; ?>
			</div>
		</div>
		<?php get_sidebar('store-right'); ?>
	</div><!-- end main -->
	<?php get_footer(); ?>