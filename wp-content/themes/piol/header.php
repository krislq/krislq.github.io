<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo home_url( '/' ); ?>favicon.ico" type="image/x-icon" />
<link rel="alternate" href="<?php echo $piol_rss; ?>" title="<?php bloginfo( 'name' ); ?> RSS feed" type="application/rss+xml" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php 
	wp_enqueue_script('jquery');
	wp_head(); 
?>

<?php if ($piol_navIco == "true") { ?>
<style>#menu li{background:none}#menu li a{padding-left:0}</style>
<?php } else { ?>
<script>
jQuery(document).ready(function ($) {
$("#menu li:eq(0)").addClass("<?php echo $piol_navItem_1; ?>")
$("#menu li:eq(1)").addClass("<?php echo $piol_navItem_2; ?>")
$("#menu li:eq(2)").addClass("<?php echo $piol_navItem_3; ?>")
$("#menu li:eq(3)").addClass("<?php echo $piol_navItem_4; ?>")
$("#menu li:eq(4)").addClass("<?php echo $piol_navItem_5; ?>")
})
</script>
<?php } ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="header">
		<div id="masthead">
<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> id="logo">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>" rel="home"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>"></a>
			</<?php echo $heading_tag; ?>>
			<div id="rss">
				<a href="<?php echo $piol_rss; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/rss.png" alt="订阅本站RSS"></a>
			</div>
			<div id="menu">
				<?php wp_nav_menu(); ?>
				<!--
<?php if ($piol_mblog_supplier == "新浪微博") { ?>
				<a href="<?php echo $piol_mblog_link; ?>" title="我的新浪微博" target="_blank" id="mblog">新浪微博</a>
<?php } else if ($piol_mblog_supplier == "腾讯微博") { ?>
				<a href="<?php echo $piol_mblog_link; ?>" title="我的腾讯微博" target="_blank" id="mblog" class="qq">腾讯微博</a>
<?php } else { ?>
				<a href="<?php echo $piol_mblog_link; ?>" title="Twitter" target="_blank" id="mblog" class="twitter">Twitter</a>
<?php } ?>
-->
				<a href="http://t.qq.com/kris1987" title="我的腾讯微博" target="_blank" id="mblog" class="qq">腾讯微博</a>
				<a href="http://weibo.com/kris008" title="我的新浪微博" target="_blank" id="mblog">新浪微博</a>
				<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					<div>
						<input type="text" value="" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="搜索" />
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="main">