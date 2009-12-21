<?php
// Password Protection
if ( post_password_required() ): ?>

<p class="nopassword"><?php echo 'This post is password protected. Enter the password to view comments.'; ?></p>

<?php return; endif; ?>

	<h4><?php printf( '%1$s %2$s to &#8220;%3$s&#8221;', '<span id="comments">' . count($comments) . '</span>', count($comments) ? 'Responses': 'Response', the_title('', '', false) ); ?></h4>

	<div class="metalinks">
		<span class="commentsrsslink"><?php post_comments_feed_link( 'Feed for this Entry' ); ?></span>
		<?php if ( pings_open() ): ?><span class="trackbacklink"><a href="<?php trackback_url(); ?>" title="<?php echo 'Copy this URI to trackback this entry.'; ?>"><?php echo 'Trackback Address'; ?></a></span><?php endif; ?>
	</div>

	<hr />

<?php if ( have_comments() ): $GLOBALS['comment_index'] = 0; ?>
	<ul id="commentlist">
	<?php
		if ( function_exists('wp_list_comments') ):
			wp_list_comments('callback=sa_comment_start_el');
		else:
			foreach ($comments as $comment):
				sa_comment_item($comment);
			endforeach;
		endif;
	?>
	</ul>

	<?php if ( function_exists('wp_list_comments') ): ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link() ?></div>
		<div class="nav-next"><?php next_comments_link() ?></div>

		<div class="clear"></div>
	</div>
	<?php endif; ?>
<?php elseif ( comments_open() ): ?>
	<ul id="commentlist">
		<li id="leavecomment">
			<?php echo 'No Comments'; ?>
		</li>
	</ul>
<?php endif; // If there are comments ?>

<?php if ( !empty($GLOBALS['trackbacks']) ): $GLOBALS['comment_index'] = 0; ?>
	<ul id="pinglist">
	<?php
		foreach ($GLOBALS['trackbacks'] as $comment):
			sa_ping_item($comment);
		endforeach;
	?>
	</ul>
<?php endif; // If there are trackbacks / pingbacks ?>
	
<?php /* Comments closed */ if ( !comments_open() and is_single() ): ?>
	<div id="comments-closed-msg"><?php echo 'Comments are currently closed.'; ?></div>
<?php endif; ?>

<?php /* Reply Form */ if ( comments_open() ): ?>
<div id="respond">
	<h4 class="reply"><?php
			if ( isset( $_GET['jal_edit_comments'] ) ):
				echo 'Edit Your Comment';
			elseif ( function_exists('comment_form_title') ):
				comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' );
			else:
				'Leave a Reply';
			endif;
	?></h4>
	
	<?php if ( function_exists('cancel_comment_reply_link') ): ?>
	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link( 'Cancel Reply' ); ?>
	</div>
	<?php endif; ?>

	<?php if ( get_option('comment_registration') and !$user_ID ): ?>
		<p>
			<?php printf('You must <a href="%s">login</a> to post a comment.', get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink()); ?>
		</p>
	<?php else: ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php
			if ( isset($_GET['jal_edit_comments']) ):
				$jal_comment = jal_edit_comment_init();

				if ( ! $jal_comment ):
					return;
				endif;
		?>
		<?php elseif ( $user_ID ): ?>
	
			<p class="comment-login">
				<?php printf( 'Logged in as %s.', '<a href="' . get_option('siteurl') . '/wp-admin/profile.php">' . $user_identity . '</a>' ); ?> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php echo 'Log out of this account'; ?>"><?php echo 'Logout &raquo;'; ?></a>
			</p>

		<?php elseif ( '' != $comment_author ): ?>

			<p class="comment-welcomeback"><?php printf('Welcome back <strong>%s</strong>', $comment_author); ?>
			
		<?php endif; ?>
		
		<?php if ( ! $user_ID ): ?>
			<div id="comment-author-info">
				<p>
					<input type="text" name="author" id="author" value="<?php echo attribute_escape($comment_author); ?>" size="22" tabindex="1" />
					<label for="author">
						<strong><?php echo 'Name'; ?></strong> <?php if ( $req ): echo '(required)'; endif; ?>
					</label>
				</p>
				
				<p>
					<input type="text" name="email" id="email" value="<?php echo attribute_escape($comment_author_email); ?>" size="22" tabindex="2" />
					<label for="email">
						<strong><?php echo 'Mail'; ?></strong> (<?php echo 'will not be published'; ?>) <?php if ( $req ): echo '(required)'; endif; ?>
					</label>
				</p>
				
				<p>
					<input type="text" name="url" id="url" value="<?php echo attribute_escape($comment_author_url); ?>" size="22" tabindex="3" />
					<label for="url">
						<strong><?php echo 'Website'; ?></strong>
					</label>
				</p>			
			</div><!-- comment-personaldetails -->
		<?php endif; // If not logged in ?>

			<!--<p><?php printf('<strong>XHTML:</strong> You can use these tags: %s', allowed_tags()) ?></p>-->
	
			<p>
				<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"><?php
					if ( function_exists('jal_edit_comment_link') ):
						jal_comment_content($jal_comment);
					endif;

					if ( function_exists('quoter_comment_server') ):
						quoter_comment_server();
					endif;
				?></textarea>
			</p>
	
			<?php if ( function_exists('show_subscription_checkbox') ) show_subscription_checkbox(); ?>
			<?php if ( function_exists('quoter_page') ) quoter_page(); ?>

			<p>
				<input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo 'Submit'; ?>" />

				<?php if ( function_exists('comment_id_fields') ): comment_id_fields(); else: ?>
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				<?php endif; ?>

				<?php do_action('comment_form', $post->ID); ?>
			</p>
		</form>

	<?php endif; // If registration required and not logged in ?>

	<div class="clear"></div>
</div> <!-- .commentformbox -->

<?php endif; // Reply Form ?>