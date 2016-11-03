<?php get_header(); ?>
		<div id="container">
<?php
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>
				<h1 class="page-title">
<?php if ( is_day() ) : ?>
				按天归档：<em><?php the_time('Y年Fd日'); ?></em>
<?php elseif ( is_month() ) : ?>
				按月归档：<em><?php the_time('Y年F'); ?></em>
<?php elseif ( is_year() ) : ?>
				按年归档：<em><?php the_time('Y年'); ?></em>
<?php elseif ( is_category() ) : ?>
				按分类归档：<em><?php single_cat_title(); ?></em>
<?php elseif ( is_tag() ) : ?>
				按标签归档：<em><?php single_tag_title(); ?></em>
<?php else : ?>
				文章归档
<?php endif; ?>
				</h1>
				<br/>
<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archives.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'archive' );
?>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>