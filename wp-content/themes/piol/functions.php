<?php

require_once(TEMPLATEPATH . '/piol-options.php');

add_custom_background();

register_nav_menus(array(
'primary' => __( 'Primary Navigation', 'piol' ),
));

if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar_Top',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
 
	register_sidebar(array(
		'name' => 'Sidebar_Left',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Sidebar_Right',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
}

function piol_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-meta">
			<?php echo get_avatar( $comment, 48 ); ?>
			<span class="commentmetadata">
				<?php comment_date('Y/n/j') ?> <?php comment_time('H:i') ?>
			</span>
		</div>
		<div class="comment-content">
			<div class="comment-top comment-author">
				<?php printf(__('%s <span class="says">说:</span>'), get_comment_author_link()) ?>
			</div>
			<div class="comment-mid">
				<div class="comment-body">
					<?php comment_text() ?>
					<?php if ($comment->comment_approved == '0') : ?>
					<span class="moderated"><?php _e('您的评论正在等待审核...') ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="comment-btm">
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
				<div class="reply_at">
					<?php if(function_exists('mailtocommenter_button')) mailtocommenter_button();?>
				</div>
			</div>
		</div>
     </div>
<?php
        }