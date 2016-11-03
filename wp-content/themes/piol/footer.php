<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
	</div>
	<div id="footer">
		<span>
		<a id="gotop" href="#top" title="返回顶部">返回顶部</a>
		&copy; 2012 <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> | Powered by <a href="http://wordpress.org/" title="个人博客发布平台" target="_blank" rel="nofollow">WordPress |</a> 
		</span>
		<script src="http://s95.cnzz.com/stat.php?id=4755794&web_id=4755794&show=pic" language="JavaScript"></script>
	</div>
</div>
<?php if ($piol_tongji) { ?><div class="tongji"><?php echo stripslashes($piol_tongji); ?></div><?php } ?>
<script src="<?php bloginfo('template_url'); ?>/js/ready.js"></script>
<!--[if IE 6]><script src="<?php bloginfo('template_url'); ?>/js/DD_belatedPNG.js"></script><script>DD_belatedPNG.fix('#header,#masthead,#logo img,#rss img,.col-top,.col-mid,.col-btm,.aside-top,.aside-mid,.aside-btm,#footer')</script><![endif]-->
<?php wp_footer(); ?>
</body>
</html>