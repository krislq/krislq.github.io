<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/home.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/css.css" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
<?php if (function_exists('wp_enqueue_script') && function_exists('is_singular')) : ?>
<?php wp_head(); ?>
<?php if ( is_singular() ){ ?>
<?php } ?>
<?php endif; ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js" ></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/superfish.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/muscript.js"></script>
<script type="text/javascript">
$(function () {
$('.thumbnail img,.thumbnail_t img,.box_comment img,#slideshow img,.cat_ico,.r_comments img').hover(
function() {$(this).fadeTo("fast", 0.5);},
function() {$(this).fadeTo("fast", 1);
});
});
</script>
<!-- PNG -->
<!--[if lt IE 7]>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pngfix.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.boxCaption,.top_box,.logo,.reply,#featured_tag,#slider_nav a');
</script>
<![endif]-->
<?php if (get_option('swt_fade') == 'Hide') { ?>
<?php { echo ''; } ?>
<?php } else { include(TEMPLATEPATH . '/includes/fade.php'); } ?>
<!-- 图片延迟加载 -->
<?php include('includes/lazyload.php'); ?>
<!-- IE6菜单 -->
<script type="text/javascript"><!--//--><![CDATA[//><!--
sfHover = function() {
	if (!document.getElementsByTagName) return false;
	var sfEls = document.getElementById("menu").getElementsByTagName("li");

	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
	}	
	var sfEls = document.getElementById("topnav").getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//--><!]]></script>
<script type="text/javascript">
$(function(){
    var page = 1;
    var i = 4;
    $("span.next").click(function(){
	     var $parent = $(this).parents("div.v_show");
		 var $v_show = $parent.find("div.v_content_list");
		 var $v_content = $parent.find("div.v_content");
		 var v_width = $v_content.width() ;
		 var len = $v_show.find("li").length;
		 var page_count = Math.ceil(len / i) ;
		 if( !$v_show.is(":animated") ){
			  if( page == page_count ){
				$v_show.animate({ left : '0px'}, "slow");
				page = 1;
				}else{
				$v_show.animate({ left : '-='+v_width }, "slow");
				page++;
			 }
		 }
		 $parent.find("span").eq((page-1)).addClass("current").siblings().removeClass("current");
   });
    $("span.prev").click(function(){
	     var $parent = $(this).parents("div.v_show");
		 var $v_show = $parent.find("div.v_content_list");
		 var $v_content = $parent.find("div.v_content");
		 var v_width = $v_content.width();
		 var len = $v_show.find("li").length;
		 var page_count = Math.ceil(len / i) ;
		 if( !$v_show.is(":animated") ){
		 	 if( page == 1 ){
				$v_show.animate({ left : '-='+v_width*(page_count-1) }, "slow");
				page = page_count;
			}else{
				$v_show.animate({ left : '+='+v_width }, "slow");
				page--;
			}
		}
		$parent.find("span").eq((page-1)).addClass("current").siblings().removeClass("current");
    });
});
</script>
</head>
<body>
<div id="wrapper">
	<div id="top">
		<div id='topnav'>
			<div class="left_top ">
				<div class="home"><a href="<?php echo bloginfo('url'); ?>" title="首  页" class="home"></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?> 
			</div>
			<!-- end: left_top -->
			<div id="searchbar">
				<?php if (get_option('swt_search') == 'google') { ?>
				<?php include('includes/g_search.php'); ?>
				<?php } else { include(TEMPLATEPATH . '/includes/w_search.php'); } ?>
			</div>
			<!-- end: searchbar -->
		</div>
		<!-- end: topnav -->
	</div>
	<!-- end: top -->
	<div id="header">
		<div class="header_c">
			<?php if (get_option('swt_logo') == 'Hide') { ?>
			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?>&trade;</a><br/><span  class="blog-title"><?php bloginfo('description'); ?></span ></h1>
			<?php { echo ''; } ?>
			<?php } else { include(TEMPLATEPATH . '/includes/logo.php'); } ?>
			<div class="login_t"><?php include('includes/login.php'); ?></div>
			<?php include('includes/time.php'); ?>
		</div>
		<div class="clear"></div>
		<!-- end: header_c -->
	</div>
	<!-- end: header -->
	<div id="map_h">
		<div class="tag_t"><?php wp_tag_cloud('smallest=12&largest=12&orderby=count&unit=px&order=&order=RAND&exclude&include=&number='.get_option('swt_top_tag'));?></div>
	</div>
	<div class="clear"></div>
	<!-- scroll -->
	<div id="scroll">
		<a class="scroll_t" title="返回顶部"></a>
		<?php if(is_single() || is_page()) { ?><a class="scroll_c" title="查看留言"></a><?php } ?>
		<a class="scroll_b" title="转到底部"></a>
	</div>