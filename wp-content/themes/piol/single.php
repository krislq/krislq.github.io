<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<?php get_header(); ?>
		<div id="container">
			<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="col-top"></div>
					<div class="col-mid">
						<div class="entry-header">
							<div class="entry-date">
								<span class="entry-month"><?php the_time('M'); ?></span>
								<span class="entry-day"><?php the_time('d'); ?></span>
							</div>
							<h1 class="entry-title"><a href="<?php the_permalink() ?>" title="链向 <?php the_title(); ?> 的固定链接" rel="bookmark"><?php the_title(); ?></a></h1>
							<div class="entry-meta">
								<span class="comments-link"><?php comments_popup_link('发表评论', '1条评论', '%条评论'); ?></span>
								分类：<?php the_category(' '); ?> | 
								标签：<?php the_tags('', ' ', ''); ?>
								<?php edit_post_link('编辑', ' | ', ' '); ?>
								<?php if(function_exists('the_views')) { ?>
								| <?php the_views(); ?>
								<?php } ?>
							</div>
						</div>
						<div class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
							<?php if(function_exists('st_related_posts')) { ?>
								<div id="related_posts">
									<?php st_related_posts(); ?>
								</div>
							<?php } ?>
						</div> 
					</div>
					<div class="col-btm"></div>
				</div>
			<div id="nav-below" class="navigation">
				<div class="col-top"></div>
				<div class="col-mid">
					<div class="nav-previous"><?php previous_post_link('%link'); ?></div>
					<div class="nav-next"><?php next_post_link('%link'); ?></div>
				</div>
				<div class="col-btm"></div>
			</div>
<?php if ($piol_ad_post) { ?><div class="adPost"><?php echo stripslashes($piol_ad_post); ?></div><?php } ?>
			<?php comments_template( '', true ); ?>
<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>