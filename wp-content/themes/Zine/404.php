<?php get_header(); ?>
	<div id="content" role="main">
		<div id="post-0" class="post error404 not-found">
			<div class="entry-content">
				<img src="<?php bloginfo('template_url'); ?>/images/404.png" alt="404" />
				<p>很抱歉，您请求的页面不存在。<br /><a href="<?php echo home_url( '/' ); ?>">回到首页</a> - <a href="javascript:history.go(-1);">返回上页</a></p>
			</div>
		</div>
	</div>
<?php get_footer(); ?>