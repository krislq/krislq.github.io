<div class="box_top">
	<i class="rt"></i>
	<i class="lt"></i>
</div>
<div class="mimg">
	<?php $loop = new WP_Query( array( 'post_type' => 'picture', 'orderby' => rand, 'posts_per_page' => 4 ) );	while ( $loop->have_posts() ) : $loop->the_post();?>
	<div class="mimg_c">
		<div class="thumb_s">
			<?php if ( get_post_meta($post->ID, 'small', true) ) : ?>
			<?php $image = get_post_meta($post->ID, 'small', true); ?>
			<?php $img = get_post_meta($post->ID, 'big', true); ?>
			<a href="<?php the_permalink(); ?>"  rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
			<?php else: ?>
		</div>
			<!-- НиЭМ -->
		<div class="thumbnail_s">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php if (has_post_thumbnail()) { the_post_thumbnail('hot'); }?></a>
			<?php endif; ?>	
		</div>
	</div>
<?php endwhile;?>
<div class="clear"></div>
</div>
<div class="box-bottom">
	<i class="lb"></i>
	<i class="rb"></i>
</div>