<?php get_header(); ?>
		<div id="container">
			<h1 class="page-title">关于“<?php echo $s ?>”的搜索结果</h1>
	<?php if ( have_posts() ) : ?>
			<?php get_template_part( 'loop', 'search' ); ?>
	<?php else : ?>
			<div id="post-0" class="post no-results not-found">
				<div class="col-top"></div>
				<div class="col-mid">
					<div class="entry-content">
						<p>你的要求太高啦，神马都没找到。</p>
					</div>
				</div>
				<div class="col-btm"></div>
			</div>
			<script type="text/javascript">
			document.getElementById('s') && document.getElementById('s').focus();
			</script>
<?php endif; ?>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>