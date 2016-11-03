<div class="clear"></div>
<div class="footer_top">
	<div id="menu">
		<?php 
			$catNav = '';
			if (function_exists('wp_nav_menu')) {
				$catNav = wp_nav_menu( array( 'theme_location' => 'footer-menu',  'echo' => false, 'fallback_cb' => '' ) );};
			if ($catNav == '') { ?>
				<ul id="cat-nav" class="nav">
					<?php wp_list_pages('depth=1&sort_column=menu_order&title_li='); ?>
				</ul>
		<?php } else echo($catNav); ?>
	</div>
	<h2 class="blogtitle">
	<a href="<?php bloginfo('home'); ?>/" title="<?php bloginfo('name'); ?>">返回首页</a></h2>
	<big class="lt"></big>
	<big class="rt"></big>
</div>
<!-- 页脚 -->
<?php wp_reset_query();?>
<div class="link">
	<?php
		if(function_exists('wp_hto_get_links')){
		wp_hot_get_links();
		}else{
		wp_list_bookmarks('title_li=&categorize=1&category=&orderby=rand&limit=38&show_images=');
		}
	?>
	<div class="clear"></div>
</div>
<div class="link_b">
	<big class="lb"></big>
	<big class="rb"></big>
</div>
<!-- end: link -->
<div class="footer_bottom">
	Copyright <?php echo comicpress_copyright(); ?> <?php bloginfo('name'); ?>&nbsp;&nbsp;保留所有权利.
	&nbsp;&nbsp;基于<a href="http://wordpress.org/" title="WordPress.org"> WordPress</a> 技术创建
	&nbsp;&nbsp;<?php echo get_num_queries(); ?>次查询
	&nbsp;&nbsp;<script src="http://s95.cnzz.com/stat.php?id=4755794&web_id=4755794&show=pic" language="JavaScript"></script>
	<?php echo stripslashes(get_option('swt_track_code')); ?>
</div>
 <div class="clear"></div>
</div>
<?php wp_footer(); ?>
</body></html>
<?php if (get_option('swt_bulletin') == 'Hide') { ?>
<?php { echo ''; } ?>
<?php } else { include(TEMPLATEPATH . '/includes/bulletin.php'); } ?>