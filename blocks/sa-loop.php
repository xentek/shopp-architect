<?php
/**
 *	The Loop
 */
$post_index = 1;
while ( have_posts() ): the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-head">
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h3>
		</div><!-- .entry-head -->

		<div class="entry-content">
			<?php the_content('Read More&hellip;'); ?>
		</div><!-- .entry-content -->
		<div class="entry-foot">
			<?php if ( 'post' == $post->post_type ): ?>
			<div class="entry-meta">
				<?php sa_entry_meta(); ?>
			</div> <!-- .entry-meta -->
			<?php endif; ?>

			<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','k2_domain') . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-foot -->
		
	</div><!-- #post-ID -->
<?php endwhile; ?>