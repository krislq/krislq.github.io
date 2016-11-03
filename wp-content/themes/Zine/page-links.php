<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>
	<div id="content" role="main">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<ul id="page-links">
					<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
	</div>
<script type="text/javascript">
jQuery("#page-links a").each(function(e){
	jQuery(this).prepend("<img src=http://www.google.com/s2/favicons?domain="+this.href.replace(/^(http:\/\/[^\/]+).*$/, '$1').replace( 'http://', '' )+">");
});
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>