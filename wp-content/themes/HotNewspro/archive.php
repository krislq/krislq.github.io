<?php get_header(); ?>
<div id="content">
	<!-- menu -->
	<div id="map">
		<div class="browse">现在位置 ＞<a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> ＞
			<?php if (have_posts()) : ?> 
			<?php $post = $posts[0]; ?>
			<?php if (is_category()) { ?><?php single_cat_title(); ?>
			<?php } elseif( is_tag() ) { ?><?php single_tag_title(); ?>
			<?php } elseif (is_day()) { ?><?php the_time('Y年m月'); ?>发表的文章
			<?php } elseif (is_month()) { ?>所有<?php the_time('Y年m月'); ?>文章
			<?php } elseif (is_year()) { ?>Archive for <?php the_time('Y'); ?>
			<?php } elseif (is_author()) { ?><?php wp_title( '');?>发表的所有文章
			<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1>Blog Archives</h1>
			<?php } ?>
		</div>
		<div id="feed"><a href="<?php echo get_option('swt_rsssub'); ?>" title="RSS">RSS</a></div>
	</div>
	<!-- end: menu -->
    <div class="navigation"><?php pagination($query_string); ?></div>
    <div class="clear"></div>
 	<!-- end: navigation -->
 	<!-- archive_box -->
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="entry_box">
		<span class="comment_a"><?php comments_popup_link('0℃ ', '1℃ ', '%℃ '); ?></span>
  		<div class="archive_box">
  			 <!-- end: archive_title_box -->
			<div class="archive_title_box">
				<!-- 分类图标 -->
				<div class="ico"><?php include('includes/cat_ico.php'); ?></div>
				<!-- end: 分类图标 -->
				<div class="archive_title">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				</div> 
				<div class="archive_info">
					<span class="date"><?php the_time('Y年m月d日') ?></span>
					<span class="category"> &#8260; <?php the_category(', ') ?></span>
					<?php include('includes/source.php'); ?>
					<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
			</div>
 			<!-- end: archive_title_box -->
			<!-- thumbnail -->
			<div class="thumbnail_box">
				<?php include('includes/thumbnail.php'); ?>
				<span class="postdate"><?php the_time('Y年m月d日') ?></span>
			</div>
			<div class="archive">
				<?php if (has_excerpt())
				{ ?> 
					<?php the_excerpt() ?>
				<?php
				}
				else{
					echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 480,"...");
				} 
				?>
			</div>
			<div class="clear"></div>
			<span class="posttag"><?php the_tags('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ', ', ', ''); ?></span><span class="archive_more"><a href="<?php the_permalink() ?>" title="详细阅读 <?php the_title(); ?>" rel="bookmark" class="title">阅读全文</a></span>
			<div class="clear"></div>
		</div>
 		<!-- end: archive_box -->
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_box_b">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
 	<!-- end: box_archive --> 
 	<!-- ad -->
	<?php if ($wp_query->current_post == 0) : ?>
	<?php if (get_option('swt_adh') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/ad_h.php'); } ?>
	<?php endif; ?>	
	<!-- end: ad -->
	<?php endwhile; else: ?>
	<?php endif; ?>

 	<!-- navigation -->
    <div class="navigation_b"><?php pagination($query_string); ?></div>
 	<!-- end: navigation -->
	<div class="clear"></div>
</div>
<!-- end: content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>