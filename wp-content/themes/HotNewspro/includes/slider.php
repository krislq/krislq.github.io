<div id="slideshow">
<div class="slideshow">
	<div id="featured_tag"></div>
	<div id="slider_nav"></div>
	<div id="slider" class="clearfix">
		<?php
			$args = array(
				'posts_per_page' => 5,
				'post__in'  => get_option('sticky_posts'),
				'caller_get_posts' => 10
			);
			query_posts($args);
			?>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
		<div class="featured_post" >
			<div class="slider_image">			
				<?php if ( get_post_meta($post->ID, 'show', true) ) : ?>
				<?php $image = get_post_meta($post->ID, 'show', true); ?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>"width="400" height="248" alt="<?php the_title(); ?>"/></a>
				<?php else: ?>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php if (has_post_thumbnail()) { the_post_thumbnail('show'); }
				else { ?>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img class="home-thumb" src="<?php echo catch_first_image() ?>" width="400px" height="248px" alt="<?php the_title(); ?>"/></a>
				<?php } ?>
				<?php endif; ?>
			</div>
			<div class="slider_post">
				<div class="ico"><?php include('cat_ico.php'); ?></div>
				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,30); ?></a></h3> 
				<div class="archive_info">
					<span class="date"><?php the_time('Y年m月d日') ?></span>
					<span class="category"> &#8260; <?php the_category(', ') ?></span>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
				<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 320,"..."); ?></p>
				<div class="clear"></div>
			</div>
		</div>
<?php endwhile; ?>
<?php endif; ?>	
	</div>
 </div>
	<i class="lt"></i>
	<i class="rt"></i>
	<i class="lb"></i>
	<i class="rb"></i>
 </div>