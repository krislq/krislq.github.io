<div id="sidebar">
	<?php wp_reset_query();if ( is_home() ){ ?>
	<?php if (get_option('swt_tab') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/tab_h.php'); } ?>
	<?php } ?>

	<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search()) { ?>
	<?php if (get_option('swt_tab') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/tab.php'); } ?>
	<?php } ?>

	<div class="widget">
		<?php wp_reset_query();if ( is_home()){ ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('首页小工具1') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>

	<div class="widget">
		<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search()) { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('其它页面小工具1') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>

	<div class="widget">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('全部页面小工具') ) : ?>
		<?php endif; ?>
	</div>

	<?php if (get_option('swt_mimg') == 'Display') { ?>
	<?php include('includes/mimg.php'); ?>
	<?php } else { } ?>

	<?php if (get_option('swt_mcat') == 'Display') { ?>
	<?php wp_reset_query();if (is_single()) { ?>
		<?php include('includes/mcat.php'); ?>
	<?php } ?>
	<?php } else { } ?>

	<?php if (get_option('swt_wallreaders') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/top_comment.php'); } ?>

	<div class="widget">
		<?php wp_reset_query();if ( is_home() ){ ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('首页小工具2') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>

	<div class="widget">
		<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search()) { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('其它页面小工具2') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>

	<?php if (get_option('swt_statistics') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/statistics.php'); } ?>
	<div class="clear"></div>
</div>