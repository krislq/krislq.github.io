<?php
$themename = "Piol";
$shortname = "piol";
$options = array (
    array( "name" => $themename." 设置",
           "type" => "title"),
    array( "type" => "open"),
    array( "name" => "",
           "desc" => "不显示菜单栏图标",
           "id" => $shortname."_navIco",
           "type" => "checkbox",
           "std" => "false"),
    array( "name" => "",
           "desc" => "第一个菜单项的图标",
           "id" => $shortname."_navItem_1",
           "type" => "select",
           "options" => array("navIco_1", "navIco_2", "navIco_3", "navIco_4", "navIco_5"),
           "std" => "navIco_1"),
    array( "name" => "",
           "desc" => "第二个菜单项的图标",
           "id" => $shortname."_navItem_2",
           "type" => "select",
           "options" => array("navIco_1", "navIco_2", "navIco_3", "navIco_4", "navIco_5"),
           "std" => "navIco_2"),
    array( "name" => "",
           "desc" => "第三个菜单项的图标",
           "id" => $shortname."_navItem_3",
           "type" => "select",
           "options" => array("navIco_1", "navIco_2", "navIco_3", "navIco_4", "navIco_5"),
           "std" => "navIco_3"),
    array( "name" => "",
           "desc" => "第四个菜单项的图标",
           "id" => $shortname."_navItem_4",
           "type" => "select",
           "options" => array("navIco_1", "navIco_2", "navIco_3", "navIco_4", "navIco_5"),
           "std" => "navIco_4"),
    array( "name" => "",
           "desc" => "第五个菜单项的图标",
           "id" => $shortname."_navItem_5",
           "type" => "select",
           "options" => array("navIco_1", "navIco_2", "navIco_3", "navIco_4", "navIco_5"),
           "std" => "navIco_5"),
    array( "name" => "微博提供商",
           "desc" => "",
           "id" => $shortname."_mblog_supplier",
           "type" => "select",
           "options" => array("新浪微博", "腾讯微博", "Twitter"),
           "std" => "新浪微博"),
    array( "name" => "微博网址（URL）",
           "desc" => "例如：<a href=\"http://t.qq.com/cople7\" target=\"_blank\">http://t.qq.com/cople7</a>",
           "id" => $shortname."_mblog_link",
           "type" => "text",
           "std" => "http://t.sina.com.cn/"),
	array( "name" => "自定义RSS地址（URL）",
           "desc" => "例如：<a href=\"http://feed.c7sky.com/\" target=\"_blank\">http://feed.c7sky.com/</a>",
           "id" => $shortname."_rss",
           "type" => "text",
           "std" => get_bloginfo('rss2_url')),
    array( "name" => "公告栏",
           "desc" => "启用公告栏",
           "id" => $shortname."_ann",
           "type" => "checkbox",
           "std" => "false"),
    array( "name" => "公告栏模式",
           "desc" => "",
           "id" => $shortname."_ann_mode",
           "type" => "select",
           "options" => array("纯文本", "单行滚动"),
           "std" => "纯文本"),
    array( "name" => "公告栏内容",
           "desc" => "单行滚动模式基础代码（1组li为1行）：<code>&lt;li&gt;内容&lt;/li&gt;</code>",
           "id" => $shortname."_ann_content",
           "type" => "textarea",
           "std" => ""),
    array( "name" => "评论者头像",
           "desc" => "显示兔耳朵（不支持IE6&IE7）",
           "id" => $shortname."_rabbit_hat",
           "type" => "checkbox",
           "std" => "false"),
    array( "name" => "索引页广告",
           "desc" => "位于索引页第一篇日志的下方（最大宽度640）",
           "id" => $shortname."_ad_index",
           "type" => "textarea",
           "std" => ""),
    array( "name" => "文章页广告",
           "desc" => "位于文章页面的文章主体下方（最大宽度640）",
           "id" => $shortname."_ad_post",
           "type" => "textarea",
           "std" => ""),
    array( "name" => "统计代码",
           "desc" => "位于底部页脚区域，为了美观，隐藏显示。",
           "id" => $shortname."_tongji",
           "type" => "textarea",
           "std" => ""),
    array( "type" => "close"));
function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
if ( 'save' == $_REQUEST['action'] ) {
 
foreach ($options as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

header("Location: themes.php?page=piol-options.php&saved=true");
die;
 
} else if( 'reset' == $_REQUEST['action'] ) {
 
foreach ($options as $value) {
delete_option( $value['id'] ); }
 
header("Location: themes.php?page=piol-options.php&reset=true");
die;
 
}
}
 
add_theme_page($themename." 主题设置", "".$themename." 主题设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
 
}

function mytheme_admin() {
 
global $themename, $shortname, $options;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存。</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已重置。</strong></p></div>';
 
?>
<div class="wrap">
<?php screen_icon(); echo "<h2>" . $themename . __( ' 主题设置' ) . "</h2>"; ?>
 
<form method="post">
 
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
<table class="form-table">
 
<?php break;
 
case "close":
?>
 
</table><br />
 
<?php break;
 
case "title":
?>
<table class="form-table">
<tr valign="top">
	<th scope="row">菜单栏图标</th>
	<td>
		<span style="height:16px;width:80px;display:inline-block;padding-left:20px;background:url(<?php bloginfo('template_url'); ?>/images/nav_ico.gif) no-repeat 0 -9px">&rarr; navIco_1</span>
		<span style="height:16px;width:80px;display:inline-block;padding-left:20px;background:url(<?php bloginfo('template_url'); ?>/images/nav_ico.gif) no-repeat 0 -43px">&rarr; navIco_2</span>
		<span style="height:16px;width:80px;display:inline-block;padding-left:20px;background:url(<?php bloginfo('template_url'); ?>/images/nav_ico.gif) no-repeat 0 -77px">&rarr; navIco_3</span>
		<span style="height:16px;width:80px;display:inline-block;padding-left:20px;background:url(<?php bloginfo('template_url'); ?>/images/nav_ico.gif) no-repeat 0 -111px">&rarr; navIco_4</span>
		<span style="height:16px;width:80px;display:inline-block;padding-left:20px;background:url(<?php bloginfo('template_url'); ?>/images/nav_ico.gif) no-repeat 0 -145px">&rarr; navIco_5</span>
	</td>
</tr>
 
<?php break;
 
case 'text':
?>
 
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?></th>
	<td>
		<label>
		<input name="<?php echo $value['id']; ?>" class="regular-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
		<span class="description"><?php echo $value['desc']; ?></span>
		</label>
	</td>
</tr>
 
<?php
break;
 
case 'textarea':
?>
 
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?></th>
	<td>
		<textarea name="<?php echo $value['id']; ?>" rows="10" cols="50" class="large-text code" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea>
		<br/>
		<span class="description"><?php echo $value['desc']; ?></span>
	</td>
</tr>
 
<?php
break;
 
case 'select':
?>
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?></th>
	<td>
		<label>
			<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select>
			<span class="description"><?php echo $value['desc']; ?></span>
		</label>
	</td>
</tr>
 
<?php
break;
 
case "checkbox":
?>
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?></th>
	<td>
		<?php if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
		<label>
			<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
			<span class="description"><?php echo $value['desc']; ?></span>
		</label>
	</td>
</tr>
 
<?php break;
 
}
}
?>
 
<p class="submit">
	<input name="save" type="submit" class="button-primary" value="保存更改" />
	<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
	<p class="submit">
		<input name="reset" type="submit" value="重置更改" />
		<input type="hidden" name="action" value="reset" />
	</p>
</form>
</div>
<?php
}
add_action('admin_menu', 'mytheme_add_admin');

/*
add_action( 'admin_head', 'print_admin_hook_to_source' );
function print_admin_hook_to_source() {
	global $hook_suffix;
	print_r( $hook_suffix );
}
*/

add_action('admin_init','add_my_contextual_help');
function add_my_contextual_help(){
   add_contextual_help( 'appearance_page_piol-options', __("<p>欢迎使用 Piol 主题！希望它能给您带来不错的浏览体验 : )</p><p>您可以在本页面对 Piol 主题进行基础的设置，或者您也可以直接对主题进行编辑，但是必须保留作者的版权信息，不得用于商业目的。</p><p>如果您在使用本主题时遇到任何疑问或者问题，欢迎到 <a href=\"http://c7sky.com/wordpress-theme-piol.html\" target=\"_blank\">http://c7sky.com/wordpress-theme-piol.html</a> 留言。</p><p>本作品采用 <a href=\"http://creativecommons.org/licenses/by-nc-sa/2.5/cn/\" target=\"_blank\"> 知识共享署名-非商业性使用-相同方式共享 2.5 中国大陆许可协议</a> 进行许可。</p><p><strong>更多信息：</strong></p><p><a href=\"http://c7sky.com/\" target=\"_blank\">小影's Blog</a></p>") ); 
}
?>