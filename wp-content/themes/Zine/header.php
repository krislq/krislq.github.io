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
<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( 'Page %s' , max( $paged, $page ) );
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo home_url( '/' ); ?>favicon.ico" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	wp_enqueue_script('jquery');
	wp_head();
?>
<?php if ( is_singular() ){ ?><script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script><?php } ?>
<style>
<?php if ($zine_opacity == "true") { ?>
.post, .page .page,.commentlist li.depth-1,h4.widget-title,#author,#email,#url,#comment{background-color:rgba(255,255,255,.9)}
#toolbar{opacity:.9}
#comments h3, #related_posts h3 ,#comments h3 span, #related_posts h3 span{background:none}
#header,#nav,#footer{border-color:rgba(255,255,255,.8)}
#nav,#footer{-webkit-box-shadow:0 0 12px rgba(0,0,0,.2);-moz-box-shadow:0 0 12px rgba(0,0,0,.2);box-shadow:0 0 12px rgba(0,0,0,.2)}
<?php } ?>
<?php if ($zine_light == "true") { ?>
#sidebar .widget li,#sidebar .widget li a{color:#DDD}
#sidebar .widget li a:hover, #sidebar .widget li:hover a{color:#FFF;text-shadow:1px 1px 0 #000}
#sidebar .widget li:hover{background:rgba(0,0,0,.4)}
#comments-title a,#comments h3, #related_posts h3{color:#FFF;text-shadow:0 0 4px rgba(0,0,0,.7)}
#site-description,.must-log-in,.logged-in-as{color:white;text-shadow:1px 1px 1px rgba(0,0,0,.7)}
<?php } ?>
<?php if ($zine_cat2col == "true") echo "#sidebar .widget_categories li{width:95px;float:left}"; ?>
<?php if ($zine_link2col == "true") echo "#sidebar .widget_links li{width:95px;float:left}"; ?>
</style>
</head>

<body <?php body_class(); ?>>
<div id="header" role="banner">
	<div id="masthead">
		<div id="branding">
<?php $heading_tag = ( is_home() || is_front_page() || is_archive() || is_search() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> id="logo">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>" rel="home"><img alt="<?php bloginfo('name'); ?>" src="<?php bloginfo('template_url'); ?>/images/logo.png" /><?php bloginfo('name'); ?></a>
			</<?php echo $heading_tag; ?>>
			<div id="site-description"><?php bloginfo( 'description' ); ?></div>
		</div>
		<div id="toolbar">
			<ul>
				<li class="search">
					<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
						<input type="text" value="搜索" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="搜索" />
					</form>
				</li>
				<li class="rss"><a href="<?php echo $zine_rss; ?>" target="_blank">订阅</a></li>
				<?php $mblog = $zine_mblog == "新浪微博" ? "mblog_sina" : ($zine_mblog == "腾讯微博" ? "mblog_qq" : ""); ?>
				<li class="mblog <?php echo $mblog; ?>"><a href="<?php echo $zine_mblog_url; ?>" target="_blank">微博</a></li>
			</ul>
		</div>
	</div>
	<div id="nav" role="navigation">
		<?php wp_nav_menu( array('container_id' => 'menu-container', 'walker' => new description_walker())); ?>
	</div>
</div>

<div id="main">