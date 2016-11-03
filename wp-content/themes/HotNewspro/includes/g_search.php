<form action="<?php echo get_option('swt_search_link'); ?>" id="cse-search-box">
	<div>
	<input type="hidden" name="cx" value="<?php echo get_option('swt_search_ID'); ?>" />
	<input type="hidden" name="cof" value="FORID:10" />
	<input type="text" onclick="this.value='';" name="q" id="q" class="swap_value" />
	<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" id="go" alt="Search" title="搜索" />
	</div>
</form>