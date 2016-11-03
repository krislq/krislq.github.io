<div class="sg">
<h3>Google站内搜索</h3>
	<div class="box_c">
		<div class="search">
		<form action="<?php echo get_option('swt_search_link'); ?>" id="cse-search-box">
			<input type="hidden" name="cx" value="<?php echo get_option('swt_search_ID'); ?>" />
			<input type="hidden" name="cof" value="FORID:10" />
			<input type="text" onclick="this.value='';" name="q" id="q" size="26" class="swap_value" />
			<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" id="go" alt="Search" title="搜索" />
		</form>
		</div>
	</div>
<div class="box-bottom">
	<i class="lb"></i>
	<i class="rb"></i>
</div>
</div>