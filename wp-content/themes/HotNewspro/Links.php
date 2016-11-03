<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header(); ?>
	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>	
	<div id="map_box">
		<div id="map_l">
			<div class="browse">现在位置 ＞<a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> ＞<?php the_title(); ?></div>
		</div>
		<div id="map_r">
			<div id="feed"><a href="<?php echo get_option('swt_rsssub'); ?>" title="RSS">RSS</a></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="entry_box_s_l">
		<div class="link_page">
			<h2>不分先后，随机排序</h2>
			<?php
				if(function_exists(’wp_dtree_get_links’)){
				wp_dtree_get_links();
				}else{
				my_list_bookmarks('title_li=&categorize=1&category=&orderby=rand&show_images=1');
				}
			?>
			<div class="clear"></div>
		</div>
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_sb_l">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<div class="entry_box_s_l">
		<div class="links_m">
			<h2>申请链接条件：</h2>
			<div class="page" id="post-<?php the_ID(); ?>">
				<?php the_content('More &raquo;'); ?><span class="edit">
				<div class="clear"></div>
			</div>
		</div>
			<div class="clear"></div>
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_sb_l">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<?php endwhile; else: ?>
	<?php endif; ?>
<?php get_footer(); ?>