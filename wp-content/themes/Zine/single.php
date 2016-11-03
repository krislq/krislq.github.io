<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<?php get_header(); ?>
	<div id="content" role="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><a href="<?php the_permalink() ?>" title="链向 <?php the_title(); ?> 的固定链接" rel="bookmark"><?php the_title(); ?></a></h1>
			<div class="entry-meta">
				<span class="entry-date"><span class="entry-month"><?php the_time('Y-n'); ?></span><span class="sl">-</span><span class="entry-day"><?php the_time('j'); ?></span></span>
				分类：<?php the_category(', '); ?> | 
				<?php the_tags('标签：', ', ', ' | '); ?>
				<span class="comments-link"><?php comments_popup_link('暂无评论', '1条评论', '%条评论'); ?></span>
				<?php edit_post_link('编辑', ' | ', ' | '); ?>
				<?php if( current_user_can('level_10') ) {if(function_exists('the_views')) { the_views(); }} ?>
			</div>
			<div class="entry-content">
				<?php the_content('阅读全文...'); ?>
				<?php wp_link_pages(); ?>
			</div>
		</div>
		<div id="single-nav" class="navigation">
			<?php previous_post_link( '%link  / ', '上一篇' ); ?>
			<?php next_post_link( '%link', '下一篇' ); ?>
		</div>
        <!--
		<div id="ckepop">
			<span class="jiathis_txt">分享到：</span>
			<a class="jiathis_button_qzone">QQ空间</a>
			<a class="jiathis_button_tsina">新浪微博</a>
			<a class="jiathis_button_tqq">腾讯微博</a>
			<a class="jiathis_button_renren">人人网</a>
			<a class="jiathis_button_tsohu">搜狐微博</a>
			<a class="jiathis_button_kaixin001">开心网</a>
			<a class="jiathis_button_hi">百度空间</a>
			<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
		</div>
        -->
<?php if ($zine_ad_post) { ?>
		<div class="a-d-s">
			<?php echo stripslashes($zine_ad_post); ?>
		</div>
<?php } ?>
		<?php if(function_exists('st_related_posts')) { ?>
		<div id="related_posts">
			<?php st_related_posts(); ?>
		</div>
		<?php } ?>
		<?php comments_template( '', true ); ?>
<?php endwhile; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>