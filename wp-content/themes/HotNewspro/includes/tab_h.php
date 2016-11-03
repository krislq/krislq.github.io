<div id="tabs">
	<div class="box_top">
		<i class="rt"></i>
	</div>
	<ul class="htotabs">
		<li class="widget1"><a href="#tab-widget1">本月排行</a></li>
		<li class="widget2"><a href="#tab-widget2">年度排行</a></li>
		<li class="widget3"><a href="#tab-widget3">分类目录</a></li>
		<div class="clear"></div>
	</ul>
	<div class="tab-inside">
		<ul id="tab-widget1">
			<div class="tab_latest">
				<ul>
					<?php simple_get_most_viewed(); ?>
				</ul>
				<div class="clear"></div>
			</div>
		</ul>
		<ul id="tab-widget2">
			<div class="tab_latest">
				<ul>
					<?php simple_get_most_vieweds(); ?>
				</ul>
			</div>
  		</ul>
		<ul id="tab-widget3"> 
			<div class="categories_c">
				<ul><?php wp_list_cats('sort_column=name&hierarchical=0&exclude='.get_option('swt_cat_exclude')); ?></ul>
				<div class="clear"></div>
			</div>
		</ul>
	</div>
</div>
<div class="box-bottom">
	<i class="lb"></i>
	<i class="rb"></i>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery( '.htotabs').each(function(){
		jQuery(this).children( 'li').children( 'a:first').addClass( 'selected' ); // Add .selected class to first tab on load
	});
	jQuery( '.tab-inside > *').hide();
	jQuery( '.tab-inside > *:first-child').show();
	jQuery( '.htotabs li a').click(function(evt){ // Init Click funtion on Tabs
		var clicked_tab_ref = jQuery(this).attr( 'href' ); // Strore Href value
		jQuery(this).parent().parent().children( 'li').children( 'a').removeClass( 'selected' ); //Remove selected from all tabs
		jQuery(this).addClass( 'selected' );
		jQuery(this).parent().parent().parent().children( '.tab-inside').children( '*').hide();
		jQuery( '.tab-inside ' + clicked_tab_ref).fadeIn(500);
		 evt.preventDefault();
	})
})
</script>