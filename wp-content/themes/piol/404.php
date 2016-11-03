<?php get_header(); ?>
	<div id="container">
		<div id="post-0" class="post error404 not-found">
			<div class="col-top"></div>
			<div class="col-mid">
				<h1 class="entry-title">Error 404 - 无法找到页面</h1>
				<div class="entry-content">
					<img src="<?php bloginfo('template_url'); ?>/images/404.gif" alt="404" class="aligncenter" />
					<ul>
						<li>请检查您输入的网址是否正确。</li>
						<li>直接在页面右上搜索框输入要访问的内容进行搜索。</li>
						<li><a href="<?php bloginfo('url'); ?>">&laquo; 返回主页</a></li>
					</ul>
				</div>
			</div>
			<div class="col-btm"></div>
		</div>
	</div>
	<script type="text/javascript">
	document.getElementById('s') && document.getElementById('s').focus();
	</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>