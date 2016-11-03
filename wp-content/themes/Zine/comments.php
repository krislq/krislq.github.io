		<div id="comments">
<?php if ( post_password_required() ) : ?>
			<p class="nopassword">这是一篇受密码保护的文章，您需要输入密码查看评论。</p>
		</div>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><span><?php comments_number('沙发空缺中，还不快抢~','咦，这里还有个板凳哦！','% 条评论'); ?> <a href="#respond" title="发表评论">&raquo;</a></span></h3>
			<ol id="commentlist" class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'zine_comment' ) ); ?>
			</ol>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation comments-nav"><div>
				<?php paginate_comments_links(); ?>
			</div></div>
	<?php endif; ?>
<?php endif; // end have_comments() ?>

<?php if ( comments_open() ) : ?>
			<div id="respond">
				<h3><span><?php comment_form_title( '发表评论', '回复 %s 的评论' ); ?></span></h3>
				<?php cancel_comment_reply_link() ?>
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
				<p class="must-log-in">要发表评论，您必须先<a href="<?php echo wp_login_url(get_permalink()); ?>">登录</a>。</p>
	<?php else : ?>
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
					<?php comment_id_fields(); ?>
		<?php if ( is_user_logged_in() ) : ?>
					<p class="logged-in-as">以 <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> 的身份登录。<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="登出此账户">登出？</a></p>
		<?php else : ?>
					<p class="comment-form-author">
						<label for="author">昵称</label><span class="required">*</span><input id="author" name="author" type="text" value="<?php echo $comment_author; ?>" size="30" required>
					</p>
					<p class="comment-form-email">
						<label for="email">邮箱</label><span class="required">*</span><input id="email" name="email" type="email" value="<?php echo $comment_author_email; ?>" size="30" required>
					</p>
					<p class="comment-form-url">
						<label for="url">网站</label><input id="url" name="url" type="text" value="<?php echo $comment_author_url; ?>" size="30">
					</p>
		<?php endif; ?>
					<p class="comment-form-comment">
						<label for="comment">评论</label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="说点什么吧~" required></textarea>
					</p>
				<?php if ( function_exists(cs_print_smilies) ) : ?>
					<div class="comment-smilies">
						<?php cs_print_smilies(); ?>
					</div>
				<?php endif; ?>
					<p class="form-submit">
						<input name="submit" type="submit" id="submit" value="发表评论">
						<?php do_action('comment_form', $post->ID); ?>
					</p>
					<div class="clear"></div>
					<script>document.getElementById("comment").onkeydown=function ctrlEnter(e){if(!e)var e=window.event;if(e.ctrlKey&&e.keyCode==13){document.getElementById("submit").click();}}</script>
				</form>
	<?php endif; ?>
			</div>
<?php else : ?>
			<h3><span>评论已关闭</span></h3>
<?php endif; ?>
		</div>