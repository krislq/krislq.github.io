<?php
$themename = "Zine";
$shortname = "zine";
$options = array (
    array( "name" => $themename." 选项",
           "type" => "title"),
    array( "type" => "open"),
    array( "name" => "半透明模式",
           "desc" => "启用半透明模式（仅支持现代浏览器）",
           "id" => $shortname."_opacity",
           "type" => "checkbox",
           "std" => "false"),
	array( "name" => "配色方案",
           "desc" => "使用浅色文本颜色（使用深色背景图时请勾选此项）",
           "id" => $shortname."_light",
           "type" => "checkbox",
           "std" => "false"),
	array( "name" => "侧边栏",
           "desc" => "分类目录两列显示",
           "id" => $shortname."_cat2col",
           "type" => "checkbox",
           "std" => "false"),
	array( "name" => "",
           "desc" => "链接表两列显示",
           "id" => $shortname."_link2col",
           "type" => "checkbox",
           "std" => "false"),
    array( "name" => "微博平台",
           "desc" => "",
           "id" => $shortname."_mblog",
           "type" => "select",
           "options" => array("Twitter", "新浪微博", "腾讯微博"),
           "std" => "Twitter"),
    array( "name" => "微博网址（URL）",
           "desc" => "",
           "id" => $shortname."_mblog_url",
           "type" => "text",
           "std" => "http://www.twitter.com/"),
	array( "name" => "RSS地址（URL）",
           "desc" => "如果您想订阅地址和 WordPress 的默认地址不同的话，请在这里输入您期望的地址。",
           "id" => $shortname."_rss",
           "type" => "text",
           "std" => get_bloginfo('rss2_url')),
    array( "name" => "IE7浏览器升级提示",
           "desc" => "启用IE7浏览器升级提示（IE6浏览器默认显示）",
           "id" => $shortname."_ie7upgrade",
           "type" => "checkbox",
           "std" => "false"),
    array( "name" => "索引页广告",
           "desc" => "位于索引页第一篇日志的下方（最大宽度730）。",
           "id" => $shortname."_ad_index",
           "type" => "textarea",
           "std" => ""),
    array( "name" => "文章页广告",
           "desc" => "位于文章页面的文章主体下方（最大宽度730）。",
           "id" => $shortname."_ad_post",
           "type" => "textarea",
           "std" => ""),
    array( "name" => "页脚文本",
           "desc" => "位于底部页脚区域（比如添加备案号或统计代码）。",
           "id" => $shortname."_footer",
           "type" => "textarea",
           "std" => ""),
    array( "type" => "close"));

function mytheme_add_admin()
{
	global $themename, $shortname, $options;
	if ($_GET['page'] == basename(__FILE__)) {
		if ('save' == $_REQUEST['action']) {
			foreach($options as $value) {
				update_option($value['id'], $_REQUEST[$value['id']]);
			}

			foreach($options as $value) {
				if (isset($_REQUEST[$value['id']])) {
					update_option($value['id'], $_REQUEST[$value['id']]);
				}
				else {
					delete_option($value['id']);
				}
			}
			header("Location: themes.php?page=theme-options.php&saved=true");
			die;
		}
	}
	add_theme_page("主题选项", "主题选项", 'edit_themes', basename(__FILE__) , 'mytheme_admin');
}

function mytheme_admin()
{
	global $themename, $shortname, $options;
	if ($_REQUEST['saved']) echo '<div id="message" class="updated"><p><strong>设置已保存。</strong></p></div>';
?>

<div class="wrap">
<form method="post">
 
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
<table class="form-table">
 
<?php break;
 
case "close":
?>
 
</table>
 
<?php break;
 
case "title":
?>
<?php screen_icon(); echo "<h2>" . $themename . __( ' 主题选项' ) . "</h2>"; ?>
 
<?php break;
 
case 'text':
?>
 
<tr>
	<th><?php echo $value['name']; ?></th>
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
 
<tr>
	<th><?php echo $value['name']; ?></th>
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
<tr>
	<th><?php echo $value['name']; ?></th>
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
<tr>
	<th><?php echo $value['name']; ?></th>
	<td>
		<?php if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
		<label>
			<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
			<span><?php echo $value['desc']; ?></span>
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
</div>
<?php
}
add_action('admin_menu', 'mytheme_add_admin');

add_action('admin_init','add_my_contextual_help');
function add_my_contextual_help(){
   add_contextual_help( 'appearance_page_theme-options', __("<p>欢迎使用 Zine 主题！希望它能给您带来不错的浏览体验 : )</p><p>您可以在本页面对 Zine 主题进行基础的设置，或者您也可以直接对主题进行编辑，但是请保留作者的版权信息，不得用于商业目的。</p><p>如果您在使用本主题时遇到任何疑问或者问题，欢迎到 <a href=\"http://c7sky.com/wordpress-theme-zine.html\" target=\"_blank\">主题发布页</a> 留言。</p><p>本作品采用 <a href=\"http://creativecommons.org/licenses/by-nc-sa/2.5/cn/\" target=\"_blank\"> 知识共享署名-非商业性使用-相同方式共享 2.5 中国大陆许可协议</a> 进行许可。</p><p>其他主题：<a href=\"http://c7sky.com/wordpress-theme-piol.html\" target=\"_blank\">Piol</a></p><p><strong>更多信息：</strong></p><p><a href=\"http://c7sky.com/\" target=\"_blank\">小影's Blog</a> | <a href=\"http://feed.c7sky.com/\" target=\"_blank\">订阅博客</a> | <a href=\"http://t.qq.com/cople7\" target=\"_blank\">腾讯微博</a></p>") ); 
}
?>