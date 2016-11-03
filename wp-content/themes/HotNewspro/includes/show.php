<div class="ad_h">
<div class="v_show">
	<div class="v_content">
		<div  class="v_content_list">
			<?php $recent = new WP_Query('meta_key=recommend&caller_get_posts=10&showposts='.get_option('swt_rolling_n')); while($recent->have_posts()) : $recent->the_post();?>
			<ul>
				<li>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php if ( get_post_meta($post->ID, 'img', true) ) : ?>
						<?php $image = get_post_meta($post->ID, 'img', true); ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
						<?php else: ?>
						<img class="home-thumb" src="<?php echo catch_first_image() ?>" width="140px" height="100px" alt="<?php the_title(); ?>"/></a>
						<?php endif; ?>
					<h4><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>"><?php echo cut_str($post->post_title,100); ?></a></h4>
				</li>
   		     </ul>
		     <?php endwhile; ?>
		</div>
	</div>
	<div class="v_caption">
		<div class="highlight_tip">
			<span class="currents">1</span><span>2</span><span>3</span><span>4</span>
		</div>
		<div class="change_btn">
			<span class="prev" >上一页</span>
			<span class="next">下一页</span>
		</div>
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