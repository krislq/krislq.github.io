<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<?php if ( is_home() && $piol_ann == "true" ) {?>
	<div id="ann">
		<div class="col-top"></div>
		<div class="col-mid">
			<img src="<?php bloginfo('template_url'); ?>/images/megaphone.gif" alt="公告">
			<?php if ( $piol_ann_mode == "单行滚动" ) {?>
			<ul><?php echo $piol_ann_content; ?></ul>
			<script>
			function AnnScroll(){jQuery("#ann").find("ul:first").animate({marginTop:"-20px"},500,function(){jQuery(this).css({marginTop:"0"}).find("li:first").appendTo(this)})};
			jQuery(document).ready(function(){setInterval('AnnScroll()',3000)})
			</script>
			<?php } else { ?>
			<p><?php echo $piol_ann_content; ?></p>
			<?php } ?>
		</div>
		<div class="col-btm"></div>
	</div>
<?php } ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<div class="col-top"></div>
		<div class="col-mid">
			<h2 class="entry-title">Error 404 - 无法找到页面</h2>
			<div class="entry-content">
				<ul>
					<li>1.请检查您输入的网址是否正确。</li>
					<li>2.如果您不能确认您输入的网址，请浏览<a href="<?php bloginfo('url'); ?>/archives">存档</a>页面，来查看您所要访问的网址。</li>
					<li>3.直接在页面右上搜索框输入要访问的内容进行搜索。</li>
					<li><a href="<?php bloginfo('url'); ?>">&laquo; 返回主页</a></li>
				</ul>
			</div>
		</div>
		<div class="col-btm"></div>
	</div>
<?php endif; ?>

<?php $count = 1; ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="col-top"></div>
		<div class="col-mid">
			<div class="entry-header">
				<div class="entry-date">
					<span class="entry-month"><?php the_time('M'); ?></span>
					<span class="entry-day"><?php the_time('d'); ?></span>
				</div>
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="链向 <?php the_title(); ?> 的固定链接" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="entry-meta">
					<span class="comments-link"><?php comments_popup_link('发表评论', '1条评论', '%条评论'); ?></span>
					分类：<?php the_category(' '); ?> | 
					标签：<?php the_tags('', ' ', ''); ?>
					<?php edit_post_link('编辑', ' | ', ' '); ?>
					<?php if(function_exists('the_views')) { ?>
					| <?php the_views(); ?>
					<?php } ?>
				</div>
			</div>

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
	<?php else : ?>
			<div class="entry-content">
				<?php the_content('阅读全文...'); ?>
				<?php wp_link_pages(); ?>
			</div>
	<?php endif; ?>

		</div>
		<div class="col-btm"></div>
	</div>
<?php if ($count == 1) : ?>
<?php if ($piol_ad_index) { ?><div class="adIndex"><?php echo stripslashes($piol_ad_index); ?></div><?php } ?>
<?php endif; $count++; ?>

	<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
		<div id="nav-below" class="navigation">
			<div class="col-top"></div>
			<div class="col-mid">
	<?php if(function_exists('wp_pagenavi')){ wp_pagenavi(); } else { ?>
				<div class="nav-previous"><?php previous_posts_link('上一页'); ?></div>
				<div class="nav-next"><?php next_posts_link('下一页'); ?></div>
	<?php } ?>
			</div>
			<div class="col-btm"></div>
		</div>
<?php endif; ?>