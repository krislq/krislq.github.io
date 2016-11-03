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
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
				<?php edit_post_link('编辑', '[ ', ' ]'); ?>
			</div>
		</div>
<?php if ($zine_ad_post) { ?>
		<div class="a-d">
			<?php echo stripslashes($zine_ad_post); ?>
		</div>
<?php } ?>
		<?php comments_template( '', true ); ?>
<?php endwhile; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>