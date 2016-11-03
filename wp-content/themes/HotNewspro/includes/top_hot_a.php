<?php if (get_option('swt_hot_img') == 'Key') { ?>
<div id="featured" class="clearfix">
	<?php $recent = new WP_Query('meta_key=hot&orderby=rand&showposts=4&caller_get_posts=4'); while($recent->have_posts()) : $recent->the_post();?>
	<div class="item">
		<div class="top_t">
			<?php if ( get_post_meta($post->ID, 'image', true) ) : ?>
			<?php $image = get_post_meta($post->ID, 'image', true); ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
			<?php else: ?>
		</div>
		<!-- 截图 -->
		<div class="thumbnail_hot">
			<?php if (has_post_thumbnail()) { the_post_thumbnail('hot'); }
				else { ?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img class="home-thumb" src="<?php echo catch_first_image() ?>" width="236px" height="155px" alt="<?php the_title(); ?>"/></a>
			<?php } ?>
		<?php endif; ?>
		</div>
		<div class="top_box"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">详细内容</a></div>
		<div class="boxCaption">
			<h2><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>"><?php echo cut_str($post->post_title,30); ?></a></h2>
		</div>
	</div>
	<?php endwhile; ?>
	<div class="clear"></div>
</div>
<?php { echo ''; } ?>
<?php } else { include(TEMPLATEPATH . '/includes/top_hot.php'); } ?>