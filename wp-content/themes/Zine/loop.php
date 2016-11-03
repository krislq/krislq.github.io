<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<?php if ( ! have_posts() ) : ?>
		<div id="post-0" class="post error404 not-found">
			<h1 class="entry-title">未找到页面</h1>
			<div class="entry-content">
				<p>很抱歉，你请求的页面不存在。<br /><a href="<?php echo home_url( '/' ); ?>">回到首页</a> - <a href="javascript:history.go(-1);">返回上页</a></p>
			</div>
		</div>
<?php endif; ?>

<?php $count = 1; ?>
<?php while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="链向 <?php the_title(); ?> 的固定链接" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="entry-meta"> 
				<span class="entry-date"><span class="entry-month"><?php the_time('Y-n'); ?></span><span class="sl">-</span><span class="entry-day"><?php the_time('j'); ?></span></span>
				分类：<?php the_category(', '); ?> | 
				<?php the_tags('标签：', ', ', ' | '); ?>
				<span class="comments-link"><?php comments_popup_link('暂无评论', '1条评论', '%条评论'); ?></span>
				<?php edit_post_link('编辑', ' | ', ' | '); ?>
				<?php if( current_user_can('level_10') ) {if(function_exists('the_views')) { the_views(); }} ?>
			</div>
	<?php if ( is_archive() || is_search() ) : ?>
			<div class="entry-summary entry-content">
				<?php the_excerpt(); ?>
			</div>
	<?php else : ?>
			<div class="entry-content">
				<?php the_content('阅读全文...'); ?>
			</div>
	<?php endif; ?>
		</div>
<?php if ($count == 1 && $zine_ad_post) : ?>
		<div class="a-d">
			<?php echo stripslashes($zine_ad_index); ?>
		</div>
<?php endif; $count++; ?>
		<?php comments_template( '', true ); ?>
<?php endwhile; ?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<?php if(function_exists('wp_pagenavi')){ wp_pagenavi(); } else { ?>
		<div id="nav-below" class="navigation">
			<div class="nav-previous"><?php previous_posts_link('&laquo; 上一页'); ?></div>
			<div class="nav-next"><?php next_posts_link('下一页 &raquo;'); ?></div>
		</div>
	<?php } ?>
<?php endif; ?>