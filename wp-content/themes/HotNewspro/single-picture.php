<?php include('header_img_s.php'); ?>
<?php include('includes/addclass.php'); ?>
<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	 <!-- menu -->
		<div id="map">
			<div class="browse">现在的位置: <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> ＞<?php echo get_the_term_list($post->ID,  'gallery', '', ', ', ''); ?>＞正文<!-- <?php the_title();?> --></div>
			<div id="feed"><a href="<?php echo get_option('swt_rsssub'); ?>" title="RSS">RSS</a></div>
		</div>
		<!-- end: menu -->
		<div class="entry_box_s">
			<div class="imgcat"></div>
			<div class="more_img"><?php echo get_the_term_list($post->ID,  'gallery', '', ', ', ''); ?></div>
			<div class="img_title_box">
				<div class="entry_title"><?php the_title(); ?></div>
			</div>
				<div class="img_info">
					<ul class="date">发布日期：<?php the_time('Y年m月d日') ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span></ul>
					<ul class="category">所属分类：<?php echo get_the_term_list($post->ID,  'gallery', '', ', ', ''); ?></ul>
					<ul class="date">本图集共<span id="myimg"></span></ul>
					<ul class="comment"><?php comments_popup_link('沙发目前空缺', '只有板凳了', '共有 % 人发表了评论'); ?></ul>
					<ul class="comment"> <?php if(function_exists('the_views')) { print '图集被浏览了 '; the_views(); print ' 次';  } ?></ul>
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
							<a class="cboxElement" href="<?php echo $img; ?>" rel="example4" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
							<?php else: ?>
						</div>
						<!-- 截图 -->
						<div class="thumbnail_hot">
							<?php 
							 if ( has_post_thumbnail()) {
							   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
							   echo '<a class="cboxElement" href="' . $large_image_url[0] . '" rel="example4" title="' . the_title_attribute('echo=0') . '" >';
							   the_post_thumbnail('hot');
							   echo '</a>';
							 }
							 ?>
							<?php endif; ?>
						</div>
					</div>
					<!-- end: thumbnail -->
					<?php the_content('Read more...'); ?>
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