		<div id="aside"> 
			<div class="aside-top"></div>
			<div class="aside-mid">
				<div class="aside-body">
					<ul>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar_Top') ) : ?>
						<li id="archives" class="widget widget_archive">
							<h3 class="widget-title">文章存档</h3>
							<ul>
								<?php wp_get_archives( 'type=monthly' ); ?>
							</ul>
						</li>
					<?php endif; ?>
					</ul>
					<!--
					<ul class="aside-ul-btm">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar_Left') ) : ?>
						<li id="links" class="widget widget_links">
							<?php wp_list_bookmarks('title_li=&title_before=<h3 class="widget-title">&title_after=</h3>&category_before=&category_after='); ?>
						</li>
					<?php endif; ?>
					</ul>
					<ul class="aside-ul-btm fright">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar_Right') ) : ?>
						<li id="meta" class="widget widget_meta">
							<h3 class="widget-title">功能</h3>
							<ul>
								<?php wp_register(); ?>
								<li><?php wp_loginout(); ?></li>
								<?php wp_meta(); ?>
							</ul>
						</li>
					<?php endif; ?>
					-->
					</ul>
				</div>
			</div>
			<div class="aside-btm"></div>
		</div>