<div id="gg">
	<div class="close"><a href="javascript:void(0)" onclick="$('#gg').slideUp('slow');" title="关闭">×</a>
	<div id="feedb"><a href="<?php echo get_option('swt_rsssub'); ?>" title="欢迎订阅本站" class="image"><img src="<?php bloginfo('template_directory'); ?>/images/feed.gif" /></a></div>
	<div class="weibo">
		<a href="http://t.qq.com/kris1987" title="Kris的腾讯微博" target="_blank"  class="sina_t" rel="nofollow">腾讯微博</a>
		<a href="http://weibo.com/kris008" title="Kris的新浪微博" target="_blank"  class="qq_t" rel="nofollow">新浪微博</a>
	<!--
		<a class="sina_t" href="javascript:(function(){window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent(document.title)+'&url='+encodeURIComponent(location.href)+'&source=bookmark','_blank','width=450,height=400');})()"title="分享到新浪微博" rel="nofollow">新浪微博</a></div>
		<a class="qq_t" href="javascript:void(0);" onclick="window.open('http://v.t.qq.com/share/share.php?title='+encodeURIComponent(document.title.substring(0,76))+'&url='+encodeURIComponent(location.href)+'&rcontent=','_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes'); " title="分享到腾讯微博" rel="nofollow" >腾讯微博</a>
		-->
	</div>
	<div class="bulletin">
		<ul>
			<?php 
				$loop = new WP_Query( array( 'post_type' => 'bulletin', 'posts_per_page' => 4 ) );
				while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<li><a href="<?php the_permalink(); ?>" title="细看 <?php the_title(); ?>"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 80,"..."); ?></a></li>
			<?php endwhile; ?>
		</ul>
	</div>
</div>