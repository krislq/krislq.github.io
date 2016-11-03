<?php get_header(); ?>
	<div id="content" role="main">
<?php if ( have_posts() ) : ?>
		<h1 class="page-title">关于“<?php the_search_query(); ?>”的搜索结果</h1>
			<?php get_template_part( 'loop', 'search' ); ?>
<?php else : ?>
		<div id="post-0" class="post no-results not-found">
			<h2 class="entry-title">很抱歉，没有找到匹配结果。</h2>
			<div class="entry-content">
				<ol>
					<li>尝试搜索其他关键字</li>
					<li>浏览 <a href="<?php echo home_url(); ?>/archives">存档页</a> 查找要访问的页面</li>
					<li><a href="<?php echo home_url( '/' ); ?>">回到首页</a></li>
					<li><a href="javascript:history.go(-1);">返回上页</a></li>
				</ol>
			</div>
		</div>
		<script>document.getElementById("s").value = <?php the_search_query(); ?>;document.getElementById("s").focus();</script>
<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>