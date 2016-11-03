<?php
	$scrollcount = get_option('swt_new_post');
 ?>
<?php query_posts('&showposts='.$scrollcount.'&caller_get_posts=10.&cat='.get_option('swt_new_exclude')); while ( have_posts() ) : the_post();$do_not_duplicate[] = $post->ID; ?>
<div class="entry_box">
	<span class="comment_a"><?php comments_popup_link('0℃ ', '1℃ ', '%℃ '); ?></span>
	<div class="box_entry">
		<div class="box_entry_title">
			<span class="cat_name"><?php the_category(', ') ?></span>
			<div class="ico"><?php include('cat_ico.php'); ?></div>
				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<div class="info">
					<span class="date"><?php the_time('Y年m月d日') ?></span>
					<span class="category"> &#8260; <?php the_category(', ') ?></span>
					<?php include('source.php'); ?>
					<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
			</div>
			<div class="news"></div>
			<div class="clear"></div>
			<!-- thumbnail -->
			<div class="thumbnail_box">
				<?php include('thumbnail.php'); ?>
				<span class="postdate"><?php the_time('Y年m月d日') ?></span>
			</div>
			<div class="post_entry">
				<?php if (has_excerpt())
				{ ?> 
					<?php the_excerpt() ?>
				<?php
				}
				else{
					echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 460,"...");
				}
				?>
				<div class="clear"></div>
				<span class="posttag"><?php the_tags('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ', ', ', ''); ?></span><span class="archive_more"><a href="<?php the_permalink() ?>" title="详细阅读 <?php the_title(); ?>" rel="bookmark" class="title">阅读全文</a></span>
				<div class="clear"></div>
		</div>
	</div>
	<i class="lt"></i>
	<i class="rt"></i>
</div>
<div class="entry_box_b">
	<i class="lb"></i>
	<i class="rb"></i>
</div>
 	<!-- ad -->
	<?php if ($wp_query->current_post == 0) : ?>
	<?php if (get_option('swt_adh') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/ad_h.php'); } ?>
	<?php endif; ?>	
	<!-- end: ad -->
<?php endwhile; ?>