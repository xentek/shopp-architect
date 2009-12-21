<!-- PAGE TEMPLATE  -->

<?php get_header(); ?>

<div id="body_wrap">
	<div class="container">
		
		<div class="span-24 last">
			<div id="body_shdw_top"></div>
		</div>
		
		<div class="span-5">
		<?php get_sidebar('store-left'); ?>
	  </div>
		<div class="span-14">
			<div id="product" class="hfeed">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-head">
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
						</div>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<div class="entry-foot">
							<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','k2_domain') . '</span>', 'after' => '</div>' ) ); ?>
						</div>
					</div>

					<?php do_action('fbc_display_login_button') ?> 


					<?php do_action('sa_banner_bottom', $post->ID); 
						// you can change the content you hook on with add_action, based on the post ID that is passed in ?>

				<?php endwhile; else: define('SA_NOT_FOUND', true); ?>
					<?php include(TEMPLATEPATH . '/blocks/four04.php'); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="span-5 last">
		<?php get_sidebar('store-right'); ?>
		</div>
	</div>
</div> <!--END BODY WRAP-->
<div id="body_shdw"></div>
<!--END BODY-->

<?php get_footer(); ?>