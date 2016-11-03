<?php
$themename = "HotNews Pro";
$shortname = "swt";
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

$number_entries = array("Select a Number:","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20" );
$options = array ( 
array( "name" => $themename." Options",
       "type" => "title"),
//选择颜色风格
    array( "name" => "选择颜色风格",
           "type" => "section"),
    array( "type" => "open"),

	array(	"name" => "选择颜色风格",
			"desc" => "共有7种导航风格供选择",
			"id" => $shortname."_alt_stylesheet",
			"std" => "Select a CSS skin:",
			"type" => "select",
			"options" => $alt_stylesheets),

//首页布局设置开始
    array( "type" => "close"),
    array( "name" => "首页布局设置",
           "type" => "section"),
    array( "type" => "open"),

	array(  "name" => "选择首页布局",
			"desc" => "默认BLOG布局",
            "id" => $shortname."_home",
            "type" => "select",
            "std" => "CMS",
            "options" => array("BLOG", "CMS")),

//CMS布局首页设置

    array( "type" => "close"),
    array( "name" => "首页CMS布局设置",
           "type" => "section"),
    array( "type" => "open"),

	array(	"name" => "CMS首页左侧分类ID设置",
			"desc" => "输入分类ID，显示更多分类，请用英文逗号＂,＂隔开",
            "id" => $shortname."_catl",
            "type" => "text",
            "std" => "1,2,3,4"),

	array(	"name" => "CMS首页右侧分类ID设置",
			"desc" => "输入分类ID,显示更多分类，请用英文逗号＂,＂隔开",
            "id" => $shortname."_catr",
            "type" => "text",
            "std" => "1,2,3,4"),

	array(  "name" => "图片滚动",
			"desc" => "默认不显示。开启后，通过添加自定义栏目，名称：recommend，值：可任意，调用显示指定文章。",
            "id" => $shortname."_rolling",
            "type" => "checkbox",
			"std" => "false"),

	array(	"name" => "显示的数量",
			"desc" => "默认显示8篇",
			"id" => $shortname."_rolling_n",
			"std" => "8",
	            "type" => "text",
			"options" => $number_entries),

	array(  "name" => "最新日志",
			"desc" => "默认显示",
            "id" => $shortname."_new_p",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(	"name" => "显示的数量",
			"desc" => "默认显示1篇",
			"id" => $shortname."_new_post",
			"std" => "6",
			"type" => "select",
			"options" => $number_entries),

	array(	"name" => "输入最新文章中排除的分类ID",
            "desc" => "比如：-1,-2,-3多个ID用英文逗号隔开",
            "id" => $shortname."_new_exclude",
            "type" => "text",
            "std" => ""),

	array(	"name" => "输入首页顶部热门标签数量",
            "desc" => "默认随机排序显示30个",
            "id" => $shortname."_top_tag",
            "type" => "text",
            "std" => "30"),

//顶部热点文章设置开始

    array( "type" => "close"),
    array( "name" => "顶部热点文章设置",
           "type" => "section"),
    array( "type" => "open"),

	array(  "name" => "是否显示热点文章",
			"desc" => "默认显示。关闭后，会自动调用WP顶部图像功能，到主题-→顶部，自定义顶部设置页面，上传图像或者移除顶部图像",
            "id" => $shortname."_hot",
            "type" => "select",
            "std" => "Display",
            "options" => array("Display", "Hide")),

	array(  "name" => "选择调用方法",
			"desc" => "默认显示4篇最新文章，选择Key模式后，通过添加自定义栏目,名称：hot，值：可任意，调用指定的文章",
            "id" => $shortname."_hot_img",
            "type" => "select",
            "std" => "New",
            "options" => array("New", "Key")),

//侧边推荐栏目设置开始

    array( "type" => "close"),
    array( "name" => "侧边推荐栏目设置",
           "type" => "section"),
    array( "type" => "open"),
        
 	array(	"name" => "输入推荐栏目分类ID",
            "desc" => "输入分类ID，显示更多的分类请用英文逗号＂,＂把ID号隔开",
            "id" => $shortname."_cat_h",
            "type" => "text",
            "std" => "1,2,3,4"),

//侧边推荐文章设置

    array( "type" => "close"),
    array( "name" => "侧边推荐文章设置",
           "type" => "section"),
    array( "type" => "open"),

	array(	"name" => "输入显示的分类ID",
            "desc" => "多个ID用英文逗号＂,＂隔开",
            "id" => $shortname."_s_cat",
            "type" => "text",
            "std" => "1,2,3"),

	array(	"name" => "输入显示的篇数",
            "desc" => "默认20篇",
            "id" => $shortname."_s_cat_n",
            "type" => "text",
            "std" => "20"),

//侧边固定分类排除设置

    array( "type" => "close"),
    array( "name" => "固定分类排除设置",
           "type" => "section"),
    array( "type" => "open"),

	array(	"name" => "输入从侧边固定分类排除的分类ID",
            "desc" => "比如：-1,-2,-3多个ID用英文逗号＂,＂隔开",
            "id" => $shortname."_cat_exclude",
            "type" => "text",
            "std" => ""),

//各功能模块控制

    array( "type" => "close"),
    array( "name" => "综合功能设置",
           "type" => "section"),
    array( "type" => "open"),

	array(  "name" => "是否显示LOGO",
			"desc" => "默认显示",
            "id" => $shortname."_logo",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "是否开启特色图片功能",
			"desc" => "默认闭关。开启后，本地上传图片，会自动生成三张裁剪后的缩略图，选择作为特色图像，主题自动调用裁剪后的缩略图",
            "id" => $shortname."_cut_img",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(  "name" => "是否显示顶部访客计数器",
			"desc" => "默认不显示（某些空间有功能限制，会提示错误，酌情开启！）",
            "id" => $shortname."_count",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(  "name" => "是否显示侧边TAB菜单",
			"desc" => "默认显示",
            "id" => $shortname."_tab",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "是否显示淡入特效",
			"desc" => "默认显示",
            "id" => $shortname."_fade",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "是否开启暗箱放大特效",
			"desc" => "默认开启",
            "id" => $shortname."_pirobox",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "是否显示彩色标签云",
			"desc" => "默认显示",
            "id" => $shortname."_cumulus",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "是否显示分类图标",
			"desc" => "默认不显示",
            "id" => $shortname."_ico",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(  "name" => "是否显示正文底部相关文章",
			"desc" => "默认显示",
            "id" => $shortname."_related",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "是否显示侧边最新图片",
			"desc" => "默认闭关",
            "id" => $shortname."_mimg",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(  "name" => "是否显示侧边同分类最新文章",
			"desc" => "默认闭关，不支持一篇文章属于多个分类",
            "id" => $shortname."_mcat",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(  "name" => "是否显示侧边读者墙",
			"desc" => "默认显示",
            "id" => $shortname."_wallreaders",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "是否显示侧边网站统计",
			"desc" => "默认显示",
            "id" => $shortname."_statistics",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "是否显示表情",
			"desc" => "默认显示",
            "id" => $shortname."_smiley",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(  "name" => "底部公告栏设置",
			"desc" => "默认显示",
            "id" => $shortname."_bulletin",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array("name" => "全部友情链接",
            "desc" => "输入友情链接页面地址",
            "id" => $shortname."_link_s",
            "type" => "text",
            "std" => "http://zmingcx.com/links"),

//SEO设置

    array( "type" => "close"),
	array( "name" => "网站SEO设置及流量统计",
       "type" => "section"),
	array( "type" => "open"),

	array(	"name" => "描述（Description）",
			"desc" => "",
			"id" => $shortname."_description",
			"type" => "textarea",
            "std" => "输入你的网站描述，一般不超过200个字符"),

	array(	"name" => "关键词（KeyWords）",
            "desc" => "",
            "id" => $shortname."_keywords",
            "type" => "textarea",
            "std" => "输入你的网站关键字，一般不超过100个字符"),

	array("name" => "统计代码",
            "desc" => "",
            "id" => $shortname."_track_code",
            "type" => "textarea",
            "std" => ""),

//订阅

    array( "type" => "close"),
	array( "name" => "订阅",
			"type" => "section"),
	array( "type" => "open"),

       array("name" => "输入你的Feed地址",
            "desc" => "",
            "id" => $shortname."_rsssub",
            "type" => "text",
            "std" => "http://feed.feedsky.com/zmingcx"),

       array("name" => "输入你的订阅HTML代码",
            "desc" => "",
            "id" => $shortname."_rss",
            "type" => "textarea",
            "std" => ""),

//"google自定义搜索

    array( "type" => "close"),
	array( "name" => "搜索设置",
			"type" => "section"),
	array( "type" => "open"),

	array(  "name" => "选择搜索方式",
			"desc" => "默认WP程序自带",
            "id" => $shortname."_search",
            "type" => "select",
            "std" => "google",
            "options" => array("wp", "google")),

	array(	"name" => "输入你的Google搜索结果页面链接",
            "desc" => "",
            "id" => $shortname."_search_link",
            "type" => "text",
            "std" => "http://zmingcx.com/search"),

	array(	"name" => "输入你的Google自定义搜索ID",
            "desc" => "",
            "id" => $shortname."_search_ID",
            "type" => "text",
            "std" => "005077649218303215363:ngrflw3nv8m"),

    array( "type" => "close"),
	array( "name" => "广告设置",
			"type" => "section"),
	array( "type" => "open"),

	array(  "name" => "是否显示首页广告",
			"desc" => "默认显示",
            "id" => $shortname."_adh",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(	"name" => "输入首页广告代码",
            "desc" => "",
            "id" => $shortname."_adh_c",
            "type" => "textarea",
            "std" => '<a href="http://faq.wopus.org/" target="_blank"><img src="http://photo.staticsdo.com/a1/184/278/104/63440-772704496-8_765.jpg" alt="Wopus问答" /></a>'),

	array(	"name" => "输入侧边广告代码(小工具)",
            "desc" => "",
            "id" => $shortname."_adsc",
            "type" => "textarea",
            "std" => '<a href="http://faq.wopus.org/" target="_blank"><img src="http://photo.staticsdo.com/a1/328/248/487/63439-772704496-8_765.jpg" alt="Wopus问答" /></a>'),
 
	array(  "name" => "是否显示评论框上方广告",
			"desc" => "默认显示",
            "id" => $shortname."_adc",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(	"name" => "输入评论框上方广告代码",
            "desc" => "",
            "id" => $shortname."_ad_c",
            "type" => "textarea",
            "std" => '<a href="http://faq.wopus.org/" target="_blank"><img src="http://photo.staticsdo.com/a1/184/278/104/63440-772704496-8_765.jpg" alt="Wopus问答" /></a>'),

	array(  "name" => "是否显示正文底部广告",
			"desc" => "默认显示",
            "id" => $shortname."_adt",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(	"name" => "输入正文底部广告代码",
            "desc" => "",
            "id" => $shortname."_adtc",
            "type" => "textarea",
            "std" => '<a href="http://faq.wopus.org/" target="_blank"><img src="http://photo.staticsdo.com/a1/184/278/104/63440-772704496-8_765.jpg" alt="Wopus问答" /></a>'),

	array(	"type" => "close") 
);

function mytheme_add_admin() {

global $themename, $shortname, $options;

if ( $_GET['page'] == basename(__FILE__) ) {

	if ( 'save' == $_REQUEST['action'] ) {

		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

	header("Location: admin.php?page=theme_options.php&saved=true");
die;

}
else if( 'reset' == $_REQUEST['action'] ) {

	foreach ($options as $value) {
		delete_option( $value['id'] ); }

	header("Location: admin.php?page=theme_options.php&reset=true");
die;

}
}
 
add_theme_page($themename." Options", "主题设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/includes/options/rm_script.js", false, "1.0");
}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>';
 
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> 主题设置</h2>
<p>当前使用主题: HotNewspro 2.7 Plus版 | 设计者:<a href="http://zmingcx.com" target="_blank"> 知更鸟</a> | <a href="http://zmingcx.com/hotnews-pro-theme-27.html" target="_blank">查看主题更新</a></p> 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />
 
<?php break;
 
case "title":
?>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="保存设置" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 <?php
function show_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { 
		$output = '<ul>'.$category->name."( <em>".$category->term_id.'</em> )</ul>';
		echo $output;
	}
}
?>
 <span class="show_id"><strong><font style="font-size:20px;"color=#ff0000><strong> &hearts; </strong></font> <font color=#000>捐助我，支付宝：<br/><font color=#21759b><strong>zmingcx@gmail.com</strong></font><br/>您会得到更好的技术支持！</font></strong><h4>站点所有分类ID</h4><?php show_id();?></span>
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="恢复默认设置" /> <font color=#ff0000>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
<input type="hidden" name="action" value="reset" />
</p>
</form>
 </div>
<?php
}
?>
<?php
function mytheme_wp_head() { 
	$stylesheet = get_option('swt_alt_stylesheet');
	if($stylesheet != ''){?>
		<link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $stylesheet; ?>" rel="stylesheet" type="text/css" />
<?php }
} 
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>