<?php
/**
 *	Template Name: Shopp Architect Home Page
 */
?>
<?php get_header(); ?>

<div id="main" class="clearfix">
	<?php get_sidebar('store-left'); ?>
	<div id="content" class="span-14">
		<div class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div id="home-post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
				<hr />
				<?php get_sidebar('home-top'); ?>
				<hr />
				<?php if (SA_SHOPP_ACTIVE): ?>
					<?php shopp('catalog','featured-products','show=3&controls=false'); ?>
					<?php shopp('catalog','onsale-products','show=3&controls=false'); ?>
				<?php endif; ?>
				<hr />
				<?php get_sidebar('home-bottom-left'); ?>
				<?php get_sidebar('home-bottom-right'); ?>
				<hr />
				<?php do_action('sa_banner_bottom', $post->ID); 
					// post ID is passed in so you can change the content you echo out from the matching add_action ?>
			<?php endwhile; else: define('SA_NOT_FOUND', true); ?>
				<?php include(TEMPLATEPATH . '/blocks/four04.php'); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php get_sidebar('store-right'); ?>
</div><!-- end main -->
<?php get_footer(); ?>