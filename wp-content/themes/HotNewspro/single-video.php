<?php include('header_video_s.php'); ?>
<?php include('includes/addclass.php'); ?>
<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	 <!-- menu -->
		<div id="map">
			<div class="browse">现在的位置: <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> ＞<?php echo get_the_term_list($post->ID,  'videos', '', ', ', ''); ?>＞正文<!-- <?php the_title();?> --></div>
			<div id="feed"><a href="<?php echo get_option('swt_rsssub'); ?>" title="RSS">RSS</a></div>
		</div>
		<!-- end: menu -->
		<div class="entry_box_s">
			<div class="imgcat"></div>
			<div class="more_img"><?php echo get_the_term_list($post->ID,  'videos', '', ', ', ''); ?></div>
			<div class="img_title_box">
				<div class="entry_title"><?php the_title(); ?></div>
			</div>
				<div class="img_info">
					<ul class="date">发布日期：<?php the_time('Y年m月d日') ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span></ul>
					<ul class="category">所属分类：<?php echo get_the_term_list($post->ID,  'videos', '', ', ', ''); ?></ul>
					<ul class="comment"><?php comments_popup_link('沙发目前空缺', '只有板凳了', '共有 % 人发表了评论'); ?></ul>
					<ul class="comment"> <?php if(function_exists('the_views')) { print '该视频被浏览了 '; the_views(); print ' 次';  } ?></ul>
				</div>				
			<!-- end: entry_title_box -->
			<div class="entry">
				<div class="entry_c">
					<!-- thumbnail -->
					<div class="pic">
						<div class="top_t">
							<?php if ( get_post_meta($post->ID, 'small', true) ) : ?>
							<?php $image = get_post_meta($post->ID, 'small', true); ?>
							<?php $img = get_post_meta($post->ID, 'big', true); ?>
							<a class="example6" href="<?php echo $img; ?>" rel="example6" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
							<?php else: endif;?>
							<?php $img = get_post_meta($post->ID, 'big', true); ?>
							<div class="zoom"><a class="example6" href="<?php echo $img; ?>" rel="example6" title="<?php the_title_attribute(); ?>"></a></div>
						</div>
					</div>
					<!-- end: thumbnail -->
				</div>
			</div>
			<div class="back_b">
				<a href="javascript:void(0);" onclick="history.back();">返回</a>
			</div>
			<div class="clear"></div>
			<!-- end: entry -->
			<i class="lt"></i>
			<i class="rt"></i>
		</div>
		<div class="entry_sb">
			<i class="lb"></i>
			<i class="rb"></i>
		</div>

	<div class="context_b">
		<?php previous_post_link('【上篇】%link') ?><br/><?php next_post_link('【下篇】%link') ?>
		<i class="lt"></i>
		<i class="rt"></i>
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div>
<!-- end: content -->
<?php get_sidebar('img'); ?>
<?php get_footer(); ?>