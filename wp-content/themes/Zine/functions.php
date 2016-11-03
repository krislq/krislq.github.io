<?php

require_once(TEMPLATEPATH . '/theme-options.php');

add_action( 'after_setup_theme', 'zine_setup' );

if ( ! function_exists( 'zine_setup' ) ):
function zine_setup() {
	add_custom_background();
	add_theme_support( 'automatic-feed-links' );
	register_sidebar(array(
		'name' => 'SideBar',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>'
	));
	register_nav_menu( 'Primary Navigation', 'zine' );
}
endif;

class description_walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    
        $class_names = $value = '';
    
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
    
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';
    
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
    
        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        
        $prepend = '<span>';
        $append = '</span>';
        $description  = ! empty( $item->attr_title ) ? '<span class="desc">' . esc_attr( $item->attr_title ) . '</span>' : '';

        if($depth != 0) {
            $description = $append = $prepend = "";
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        }
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $prepend . apply_filters( 'the_title', $item->title, $item->ID ) . $append;
        $item_output .= $description . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
    
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

if ( ! function_exists( 'zine_comment' ) ) :
function zine_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="comment-wrapper" id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 64 ); ?>
				<cite class="fn"><?php comment_author_link(); ?></cite>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<span class="comment-meta commentmetadata comment-awaiting-moderation">初次评论需要等待审核</span>
				<?php else : ?>
					<span class="comment-meta commentmetadata"><?php comment_date('Y-n-j') ?> <?php comment_time('H:i') ?></span>
				<?php endif; ?>
				<span class="says">说：</span>
				<?php edit_comment_link('编辑', '[ ', ' ]'); ?>
			</div>
			<div class="comment-body"><?php comment_text(); ?></div>
		<?php if ( comments_open() ) : ?>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php if(function_exists('mailtocommenter_button')) mailtocommenter_button();?>
			</div>
		<?php endif; ?>
		</div>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link('编辑', ' [ ', ' ]'); ?></p>
	<?php
			break;
	endswitch;
}
endif;