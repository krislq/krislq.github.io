<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword">这是一篇受密码保护的文章，您需要输入密码查看评论。</p>
			</div><!-- #comments -->
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
			<h3 id="comments-title">
			<?php comments_number('暂无评论','本篇文章已有1条评论','本篇文章已有%条评论'); ?>
			</h3>
<?php if ($piol_rabbit_hat == "true") { ?>
<style>li.comment .comment-meta{position:relative}li.comment .comment-meta:after{content:'';background:url(<?php bloginfo('template_url'); ?>/images/hat.png);height:17px;width:50px;display:block;left:3px;position:absolute;top: -16px}</style>
<?php } ?>
			<ol id="commentlist">
				<?php wp_list_comments( array( 'callback' => 'piol_comment' ) ); ?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<?php paginate_comments_links(); ?>
			</div>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments">评论已关闭。</p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>
<script>
document.getElementById('comment').onkeydown = function ctrlEnter(e){
	if (!e) var e = window.event;
	if(e.ctrlKey && e.keyCode == 13){
		document.getElementById("submit").click();
	}
}
</script>

</div><!-- #comments -->