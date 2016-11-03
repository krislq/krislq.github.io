	<div id="sidebar" role="complementary">
		<ul>
<?php if ( !dynamic_sidebar('SideBar') ) : ?>
			<li id="archives" class="widget">
				<h4 class="widget-title">归档</h4>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>
			<li id="meta" class="widget">
				<h4 class="widget-title">功能</h4>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>
<?php endif; ?>
		</ul>
	</div>