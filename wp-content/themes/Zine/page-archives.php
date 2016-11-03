<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
	<div id="content" role="main">
		<div class="entry-content page">
			<div class="clear">
				<h2 class="entry-title">按 <b>标签</b> 归档</h2>
				<?php wp_tag_cloud('smallest=7&largest=24'); ?>
			</div>
			<div class="clear">
				<h2 class="entry-title">按 <b>分类</b> 归档</h2>
				<ul>
					<?php wp_list_categories('show_count=1&title_li='); ?>
				</ul>
			</div>
			<div class="clear">
				<h2 class="entry-title">按 <b>页面</b> 归档</h2>
				<ul>
					<?php wp_list_pages('title_li='); ?>
				</ul>
			</div>
			<div class="clear">
				<h2 class="entry-title">按 <b>文章</b> 归档</h2>
				<ul>
			<?php if(function_exists('clean_archives_reloaded')) { clean_archives_reloaded(); } else { ?>
				<?php wp_get_archives('type=alpha'); ?>
			<?php } ?>
				</ul>
			</div>
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>