<?php
function mailtocommenter_options_page(){
	$options= get_option( 'mailtocommenter_options');
	$description = '';
	$mail_content = '';
	$url = get_option('siteurl').'/wp-admin/options-general.php?page=mailtocommenter.php';
	if (isset($_POST['update_setting'])) {
		$options['at_all'] = $_POST['at_all'];
		$options['at_all_permission'] = $_POST['at_all_permission'];
		$options['button_content'] =  $_POST['button_content'];
		$options['button_display'] = $_POST['button_display'];
		$options['button_customize_html'] = stripslashes($_POST['button_customize_html']);
		$options['button_title'] = $_POST['button_title'];
		$options['display_description'] = $_POST['display_description'];
		$options['description'] = stripslashes($_POST['description']);
		$options['notify_admin'] =  $_POST['notify_admin'];
		if(!$_POST['mail_notify']) $options['notify_admin']=false;
		$options['permission'] = $_POST['permission'];
		$options['mail_content'] = stripslashes($_POST['mail_content']);
		$options['mail_notify'] =$_POST['mail_notify'];
		$options['mail_subject'] = $_POST['mail_subject'];
		$options['save_options'] =  $_POST['save_options'];
		$options['type'] = $_POST['type'];
		update_option('mailtocommenter_options', $options);
		echo '<div id="message" class="updated fade"><p>';
		echo __("Configuration updated.",'mailtocommenter');
		echo '</p></div>';
	}else if (isset($_POST['set_default'])) {
		$options = mailtocommenter_init_options();
		update_option('mailtocommenter_options', $options);
		echo '<div id="message" class="updated fade"><p>';
		echo __("Default configuration loaded",'mailtocommenter');
		echo '</p></div>';		    
	}else if (isset($_POST['send_mail'])){
		$to = strtolower($_POST['to']);
		$subject = $_POST['subject'];
		$message =$_POST['message'];
		mailtocommenter_send_email($to,$subject,$message);
		echo '<div id="message" class="updated fade"><p>';
		echo __("Mail sent.",'mailtocommenter');
		echo '</p></div>';	
	}else if (isset($_POST['preview'])){
		$options['mail_subject'] = $_POST['mail_subject'];
		$options['mail_content'] = stripslashes($_POST['mail_content']);
		update_option('mailtocommenter_options', $options);
		echo '<div id="message" class="updated fade">';
		echo '<b>'.__("Mail Subject:",'mailtocommenter').'</b><br/>';
		echo $options['mail_subject']."<hr/>";
		echo '<b>'.__("Mail Content:",'mailtocommenter').'</b><br/>';
		echo $options['mail_content'];
		echo '</div>';	
	}else if(isset($_POST['language'])) {
		$options['language'] = $_POST['language'];
		update_option('mailtocommenter_options', $options);
		echo '<div id="message" class="updated fade"><p>';
		echo __("Language setting updated. Waiting for page to be reloaded...",'HotFriendstext');
		echo '</p></div>';
		echo '<script language="javascript">setTimeout("window.open(\''.$url.'\',\'_self\');",1000);</script>';
	}
?>
<div class="wrap">
	<h2>Mail to Commenter Options</h2>
	<p style="text-align:right"><a target="_blank" href="http://wordpress.org/extend/plugins/profile/redhorsecxl"><?php _e("Try other plugins developed by author in official Wordpress plugin repository!",'mailtocommenter');?></a></p>
	<form name="selectlanguage" method="post">
		<p><b><?php _e('Select Language: ','mailtocommenter');?></b>
		<input style="margin-left:10px" type="radio" name="language" value="0" <?php echo ($options['language'] == "0")?'checked="checked"':'';?> onchange="document.selectlanguage.submit();">English
		<input style="margin-left:10px" type="radio" name="language" value="1" <?php echo ($options['language'] == "1")?'checked="checked"':'';?> onchange="document.selectlanguage.submit();">简体中文
		</p>
	</form>
	<form method="post">
		<div class="submit"  style="text-align:right;margin-right:10%;border:none;padding-top:0px;padding-bottom:10px;border-bottom:1px solid #DADADA;">
			<input type="submit" name="set_default" value="<?php _e('Load default','mailtocommenter');?>" />
			<input type="submit" name="update_setting" value="<?php _e('Update setting','mailtocommenter');?>" />
		</div>
		<div style="border-bottom:1px solid #DADADA">
			<p><label><input name="mail_notify" type="checkbox" class="checkbox" <?php echo ($options['mail_notify'])?'checked="checked"':''; ?> /> <b><?php _e("Activate mail notification.",'mailtocommenter');?></label></b>
				<br/><small><?php _e("Checked will allow Wordpress to automatically send mail if comment content contains following specified code.",'mailtocommenter');?></small>
			</p>
			<p><?php _e("Code type:",'mailtocommenter');?>
				<label style="margin-left:10px"><input type="radio" <?php echo ($options['type'] == "@+user+blank")?'checked="checked"':''; ?> class="tog" value="@+user+blank" name="type"/> <?php _e('\'@+user+blank\'','mailtocommenter');?></label>
				<label style="margin-left:10px"><input type="radio" <?php echo ($options['type'] == "@+user+:")?'checked="checked"':''; ?> class="tog" value="@+user+:" name="type"/> <?php _e('\'@+user+:\'','mailtocommenter');?></label>
			</p>
			<p><?php _e("Permission to use mail notification:",'mailtocommenter');?>
				<label style="margin-left:10px"><input type="radio" <?php echo ($options['permission'] == "admin")?'checked="checked"':''; ?> class="tog" value="admin" name="permission"/> <?php _e('Admin','mailtocommenter');?></label>
				<label style="margin-left:10px"><input type="radio" <?php echo ($options['permission'] == "anyone")?'checked="checked"':''; ?> class="tog" value="anyone" name="permission"/> <?php _e('Anyone','mailtocommenter');?></label>
			</p>
			<p><label><input name="notify_admin" type="checkbox" class="checkbox" <?php echo ($options['notify_admin'])?'checked="checked"':''; ?> /> <?php _e("Notify Admin.",'mailtocommenter');?></label>
			<br/><small><?php _e("Checked will copy send last mail content with the sending result indicated to admin. Be sure that activate mail notification option must be checked.",'mailtocommenter');?></small>
			</p>
			<p><label><input name="at_all" type="checkbox" class="checkbox" <?php echo ($options['at_all'])?'checked="checked"':''; ?> /> <?php _e("Activate '@all ' or '@all:'.",'mailtocommenter');?></label>
			<br/><small><?php _e("Checked will allow user to use @all or @all: to send comment to all previous commenter. This option may make mail inundant to commenter.",'mailtocommenter');?></small>
			<br/><?php _e("Permission for using @all or @all:",'mailtocommenter');?>
				<label style="margin-left:10px"><input type="radio" <?php echo ($options['at_all_permission'] == "anyone")?'checked="checked"':''; ?> class="tog" value="anyone" name="at_all_permission"/> <?php _e('Anyone','mailtocommenter');?></label>
				<label style="margin-left:10px"><input type="radio" <?php echo ($options['at_all_permission'] == "admin")?'checked="checked"':''; ?> class="tog" value="admin" name="at_all_permission"/> <?php _e('Admin','mailtocommenter');?></label>
			</p>
			<p><label><input name="display_description" type="checkbox" class="checkbox" <?php echo ($options['display_description'])?'checked="checked"':''; ?> /> <?php _e("Display following description under comment form. Html code supported.",'mailtocommenter');?></label><br/>
				<small>&nbsp;-<?php _e("1. Content in the form beneath is the output of function mailtocommenter_description(). Checked will diplay the following description under comment form.",'mailtocommenter');?>
				<br/>&nbsp;-<?php _e("2. You also can specify the position of description. To do this, please keep option unchecked and place <span style=\"background-color:#EDEDFF\">&lt;?php if(function_exists('mailtocommenter_description')) mailtocommenter_description();?&gt;</span> into theme file.",'mailtocommenter');?>
				</small><br/>
				<textarea name="description" style="width: 800px; height: 150px;"><?php echo $options['description'];?></textarea>
			</p>
		</div>
		<div style="border-bottom:1px solid #DADADA">
			<p><span style="font-weight:bold;font-size:1.2em"><?php _e("Customize Button style:",'mailtocommenter');?></span><br/>
			<small><?php _e("This section configures the style of button generated by function mailtocommenter_button().",'mailtocommenter');?><?php _e("Place <span style=\"background-color:#EDEDFF\">&lt;?php if(function_exists('mailtocommenter_button')) mailtocommenter_button();?&gt;</span> into theme file to display button.",'mailtocommenter');?></small></p>
			<p><span style="font-weight:bold"><?php _e("<b>Button Style</b>:",'mailtocommenter');?></span><br/>
			<small><?php _e("Specify the output of function mailtocommenter_button(). Html code supported. Default is to use notify.png image file in plugin folder, you can specify other image file or use plain text, like [reply]:",'mailtocommenter');?>
			</small>
			</p>
			<ul>
				<li><?php _e("Display Image:",'mailtocommenter');?>
					<p style="margin-left:1.5em">
						<?php $imgfile = get_option(siteurl).'/wp-content/plugins/mailtocommenter/notify.png';?>
						<input type="radio" <?php echo ($options['button_display'] == 1)?'checked="checked"':''; ?> class="tog" value="1" name="button_display"/>&nbsp;
						<?php echo "<a href=\"#\"><img src=\"$imgfile\" alt=\"Notify\"/></a>"?>&nbsp;&nbsp;<?php _e("Default display. @ image in plugin folder with link.",'mailtocommenter');?>
					</p>
					<p style="margin-left:1.5em">
						<?php $imgfile = get_option(siteurl).'/wp-content/plugins/mailtocommenter/reply.png';?>
						<input type="radio" <?php echo ($options['button_display'] == 2)?'checked="checked"':''; ?> class="tog" value="2" name="button_display"/>&nbsp;
						<?php echo "<a href=\"#\"><img src=\"$imgfile\" alt=\"Notify\"/></a>"?>&nbsp;&nbsp;<?php _e("Compatible to @reply. Reply image in plugin folder with link.",'mailtocommenter');?>
					</p>
				</li>
				<li><?php _e("Display Text:",'mailtocommenter');?>
					<p style="margin-left:1.5em">
						<input type="radio" <?php echo ($options['button_display'] == 3)?'checked="checked"':''; ?> class="tog" value="3" name="button_display"/>&nbsp;
						<a href="#"><?php _e('[Reply]','mailtocommenter');?></a>
					</p>
				</li>
				<li><?php _e("Customize Style:",'mailtocommenter');?><br/>
					<p style="margin-left:1.5em">
					<input type="radio" <?php echo ($options['button_display'] == 0)?'checked="checked"':''; ?> class="tog" value="0" name="button_display"/>&nbsp;
					<?php _e("Specify the html code for button style. See the examples below.",'mailtocommenter');?>
					</p>
				</li>
				<textarea style="margin-left:1.5em;width: 800px;height:30px" name="button_customize_html"><?php echo $options['button_customize_html'];?></textarea>
			</ul>
			<p style="margin-left:1.5em"><?php _e("<b>Example</b>:",'mailtocommenter');?></p>
			<ul style="margin-left:1.5em">
				<li><a href="#"><img src="http://www.google.com/accounts/gmail20x20.gif" alt="Notify"/></a>,&nbsp;&nbsp;<?php _e("HTML code:",'mailtocommenter');?><span style="background-color:#EDEDFF">&lt;img src=&quot;http://www.google.com/accounts/gmail20x20.gif&quot; alt=&quot;Notify&quot;/&gt;</span>
				</li>
				<li><a href="#">!!<?php _e("Reply",'mailtocommenter');?>!!</a>,&nbsp;&nbsp;<?php _e("HTML code:",'mailtocommenter');?><span style="background-color:#EDEDFF">!!<?php _e("Reply",'mailtocommenter');?>!!</span></li>
			</ul>
			<p><?php _e("<b>Button title display</b>, content which displayed when user hovers mouse over button:",'mailtocommenter');?><br/>
				<input style="width: 800px;" name="button_title" type="textarea" value="<?php echo $options['button_title'];?>" />
			</p>
			<p><?php _e("<b>Content generated by click button</b>",'mailtocommenter');?>
				<ul>
					<li><label style="margin-left:10px"><input type="radio" <?php echo ($options['button_content'] == "Hyperlink")?'checked="checked"':''; ?> class="tog" value="Hyperlink" name="button_content"/> <?php _e('Hyperlink. Link targets to the comment you want to reply. e.g, <a href="#">@User </a>.','mailtocommenter');?></label></li>
					<li><label style="margin-left:10px"><input type="radio" <?php echo ($options['button_content'] == "atreply")?'checked="checked"':''; ?> class="tog" value="atreply" name="button_content"/> <?php _e('@Reply style. i.e, @<a href="#">User </a>.','mailtocommenter');?></label></li>
					<li><label style="margin-left:10px"><input type="radio" <?php echo ($options['button_content'] == "plain text")?'checked="checked"':''; ?> class="tog" value="plain text" name="button_content"/> <?php _e('Plain text. e.g, @user .','mailtocommenter');?></label></li>
					<li><label style="margin-left:10px"><input type="radio" <?php echo ($options['button_content'] == "display nothing")?'checked="checked"':''; ?> class="tog" value="display nothing" name="button_content"/> <?php _e('Display nothing. i.e, @user will be encapsulated by html comment code &lt;!-- and --&gt;.','mailtocommenter');?></label></li>
				</ul>
			</p>
		</div>
		<div>
			<div style="float:left; width:610px"><p style="font-weight:bold;font-size:1.2em"><?php _e("Mail Template",'mailtocommenter');?><br/>
				<small><?php _e("User is encouraged to adpot predefined variable to customize owner mail template. See right side for explanation of predined variables. Html code supported.",'mailtocommenter');?></small>
			</p>
				<p><?php _e("Mail Subject:",'mailtocommenter');?><br/>
					<textarea style="width: 600px;height:30px" name="mail_subject"><?php echo $options['mail_subject'];?></textarea>
				</p>
				<p><?php _e("Mail Content:",'mailtocommenter');?><br/>
					<textarea style="width: 600px;height:300px;" name="mail_content" type="textarea"><?php echo $options['mail_content'];?></textarea>
					<br/><input type="submit" name="preview" value="<?php echo _e('Preview','mailtocommenter');?>"/><span style="margin-left:20px"><?php _e("<b>Advice:</b> Simply click Preview button to see the mail content style while editing.",'mailtocommenter');?></span>
				</p>
			</div>
			<div style="float:left;width:300px;margin-left:20px">
				<p><span style="font-weight:bold;font-size:1.2em"><?php _e("Meaning of predefined variables",'mailtocommenter');?></span><br/><br/>
					<b>%admin_email%:</b>&nbsp;&nbsp;<?php _e("Admin email",'mailtocommenter');?><br/>
					<b>%blog_name%:</b>&nbsp;&nbsp;<?php _e("Blog name",'mailtocommenter');?><br/>
					<b>%blog_link%:</b>&nbsp;&nbsp;<?php _e("Blog link",'mailtocommenter');?><br/>
					<b>%comment_author%:</b>&nbsp;&nbsp;<?php _e("Comment author, the one insert @user ",'mailtocommenter');?><br/>
					<b>%comment_link%:</b>&nbsp;&nbsp;<?php _e("Comment link",'mailtocommenter');?><br/>
					<b>%comment_time%:</b>&nbsp;&nbsp;<?php _e("Comment time",'mailtocommenter');?><br/>
					<b>%your_comment%:</b>&nbsp;&nbsp;<?php _e("Your comment, last comment of @user in post",'mailtocommenter');?><br/>
					<b>%post_link%:</b>&nbsp;&nbsp;<?php _e("Post link",'mailtocommenter');?><br/>
					<b>%post_title%:</b>&nbsp;&nbsp;<?php _e("Post title",'mailtocommenter');?><br/>
					<b>%reply_comment%:</b>&nbsp;&nbsp;<?php _e("Reply comment, comment of the one who insert @user",'mailtocommenter');?><br/>
					<b>%rss_name%:</b>&nbsp;&nbsp;<?php _e("RSS link display, default is RSS",'mailtocommenter');?><br/>
					<b>%rss_link%:</b>&nbsp;&nbsp;<span style="text-decoration:blink"><?php _e("RSS link, please specify your rss link since most people use third party (feedburner/feedsky) to manage rss.",'mailtocommenter');?></span><br/>
					<b>%user%:</b>&nbsp;&nbsp;<?php _e("User name displayed after @",'mailtocommenter');?><br/>
				</p>
				<div style="padding:10px 5px 10px 5px;border:1px solid #999;">
					<?php _e("<b>Note:</b><br/>1. Again, be sure the value of %rss_link% is correctly placed.",'mailtocommenter');?>
					<?php _e("<br/>2. If your <b>mail service doesn't provide html format message</b>, please remove all html tag in template.",'mailtocommenter');?>
				</div>
			</div>
		</div>
		<div style="clear:both"></div>
		<div>
			<p><label><input name="save_options" type="checkbox" class="checkbox" <?php echo ($options['save_options'])?'checked="checked"':''; ?> /> <?php _e("Keep configurations of Mail To Commenter while plugin deactivation.",'mailtocommenter');?></label>
				<br/><small><?php _e("Unchecked will automatically remove all associated settings from database.",'mailtocommenter');?></small>
			</p>
		</div>
		<div class="submit"  style="text-align:right;margin-right:10%;border:none;padding-top:0px;padding-bottom:10px;border-bottom:1px solid #DADADA;">
			<input type="submit" name="set_default" value="<?php _e('Load default','mailtocommenter');?>" />
			<input type="submit" name="update_setting" value="<?php _e('Update setting','mailtocommenter');?>" />
		</div>
		<div>
			<p style="font-weight:bold;font-size:1.5em">
				<?php _e("Send Mail",'mailtocommenter');?><input style="margin-left:20px" type="submit" name="send_mail" value="<?php echo _e('Send','mailtocommenter');?>"/>
			</p>
			<p><?php _e("Address:",'mailtocommenter');?><input style="width: 600px;" name="to" type="textarea" value="" /></p>
			<p><?php _e("Subject: ",'mailtocommenter');?><input style="width: 600px;" name="subject" type="textarea" value="" /></p>
			<p><span  style="vertical-align:top"><?php _e("Content:",'mailtocommenter');?></span><textarea style="width: 600px;height:200px" name="message"></textarea></p>
			<p><?php _e("<b>Note</b>: User can use this section to test whether your wordpress works well with mail sending or not.",'mailtocommenter');?></p>
		</div>
	</form>
	<p style="text-align:right"><a target="_blank" href="http://wordpress.org/extend/plugins/profile/redhorsecxl"><?php _e("Try other plugins developed by author in official Wordpress plugin repository!",'mailtocommenter');?></a></p>
</div>
<?php
}
function mailtocommenter_send_email($to,$subject,$message){
	$blogname = get_option('blogname');
	$charset = get_option('blog_charset');
	//$headers  = "From: $blogname \n" ;
	$headers  = "From: NoReply <noreply@krislq.com> \n" ;
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/html;charset=\"$charset\"\n";
	$to = strtolower($to);
	return @wp_mail($to, $subject, $message, $headers);
}
function mailtocommenter_description(){
	$options= get_option( 'mailtocommenter_options');
	if($options['display_description']){
		print ($options['description']);
	}
}
function mailtocommenter_button(){
	global $comment;
	$options= get_option( 'mailtocommenter_options');
	$name = $comment->comment_author;
	$comment_ID = $comment->comment_ID;
	$value = mailtocommenter_generate_name($name);
	if($options['button_content'] == "Hyperlink"){
		$value = "<a href=\"#comment-$comment_ID\">$value</a>";
	}elseif($options['button_content'] == "atreply"){
		$value = substr($value,1);
		$value = "@<a href=\"#comment-$comment_ID\">$value</a>";
	}elseif($options['button_content'] == "plain text"){
		$value = "$value";
	}else{
		$value = "<!--$value-->";
	}
	$value = htmlspecialchars($value);
	$title = $options['button_title'];
	$display = mailtocommenter_button_html();
	echo "<a href=\"#commentform\" title=\"{$title}\" onclick=\"document.getElementById('comment').focus();document.getElementById('comment').value += '{$value}'\">{$display}</a>";
}
function mailtocommenter_filter($comment,$username){
	global $wpdb;
	$options= get_option( 'mailtocommenter_options');
	$contents[0] = $options['mail_subject'];
	$contents[1] = $options['mail_content'];
	$comment_id = $comment['comment_ID'];
	$post_id = $comment['comment_post_ID'];
	$post = get_post($post_id);
	$admin_email = get_option('admin_email');
	$blog_name = get_option('blogname');
	$blog_link = get_option('home');
	$comment_author = $comment['comment_author'];
	$post_link =  get_permalink($post_id);
	$comment_link = $post_link."#comment-$comment_id";
	$comment_time = $comment['comment_date'];
	$post_title =  $post->post_title;
	$reply_comment = $comment['comment_content'];
	$your_comment = $wpdb->get_var("SELECT $wpdb->comments.comment_content FROM $wpdb->comments WHERE $wpdb->comments.comment_post_ID='$post_id' AND $wpdb->comments.comment_author='$username' ORDER BY $wpdb->comments.comment_date DESC");
	$index = 0;
	foreach ($contents as $content){
		$filter = $content;
		$filter= str_replace("%admin_email%",$admin_email,$filter);
		$filter= str_replace("%blog_name%",$blog_name,$filter);
		$filter= str_replace("%blog_link%",$blog_link,$filter);
		$filter= str_replace("%comment_author%",$comment_author,$filter);
		$filter= str_replace("%comment_link%",$comment_link,$filter);
		$filter= str_replace("%comment_time%",$comment_time,$filter);
		$filter= str_replace("%your_comment%",$your_comment,$filter);
		$filter= str_replace("%post_link%",$post_link,$filter);
		$filter= str_replace("%post_title%",$post_title,$filter);
		$filter= str_replace("%reply_comment%",$reply_comment,$filter);
		$filter= str_replace("%rss_name%","RSS",$filter);
		$filter= str_replace("%rss_link%",get_bloginfo_rss('rss2_url'),$filter);
		$filter= str_replace("%user%",$username,$filter);
		$output[$index]= $filter; 
		$index++;
	}
	return $output;
}
function mailtocommenter_generate_name($name){
	$options= get_option( 'mailtocommenter_options');
	if($options['type'] == '@+user+blank'){
			$to = "@$name ";
	}else{
			$to = "@$name:";
	}
	return $to;
}
function mailtocommenter_init_options(){
	$options = array();
	$locale = get_locale();
	if($locale == "zh_CN"){
		$language = 1;
		load_textdomain('mailtocommenter', dirname(__FILE__) . "/mailtocommenter-zh_CN.mo");
	}else{
		$language = 0;
		load_textdomain('mailtocommenter', dirname(__FILE__) . "/mailtocommenter-en_US.mo");
	}
	$options['at_all'] = false;
	$options['at_all_permission'] = "admin";
	$options['button_content'] = "Hyperlink";
	$options['button_display'] = 1;
	$options['button_customize_html'] = '';
	$options['button_title'] = __("Notify this pumpkin.",'mailtocommenter');
	$options['display_description'] = true;
	$options['description'] = __('<b>Note:</b> Commenter is allowed to use <b>\'@User+blank\'</b> to automatically notify your reply to other commenter. e.g, if ABC is one of commenter of this post, then write \'@ABC \'(exclude \') will automatically send your comment to ABC. Using \'@all \' to notify all previous commenters. Be sure that the value of User should exactly match with commenter\'s name (case sensitive).','mailtocommenter');
	$options['language'] = $language;
	$options['mail_subject'] = __('Your comment on [%blog_name%] just been replied by %comment_author%','mailtocommenter');
	$options['mail_notify'] =false;
	$options['mail_content'] = __("Mail content in different languages",'mailtocommenter');
	$options['notify_admin'] = false;
	$options['permission'] = 'admin';
	$options['save_options'] = false;
	$options['type'] = '@+user+blank';
	return $options;		
}
function mailtocommenter_button_html(){
	$options= get_option( 'mailtocommenter_options');
	$id = $options['button_display'];
	$imgfile = get_option(siteurl).'/wp-content/plugins/mailtocommenter';
	switch($id){
		case 0:
			$html = $options['button_customize_html'];
			break;
		case 1:
			$html = "<img src=\"$imgfile/notify.png\" alt=\"Notify\"/>";
			break;
		case 2:
			$html = "<img src=\"$imgfile/reply.png\" alt=\"Notify\"/>";
			break;
		case 3:
			$html = __("[Reply]",'mailtocommenter');;
			break;
		default:
			$html = "<img src=\"$imgfile/notify.png\" alt=\"Notify\"/>";
	}
	if ((preg_match('/(src)/', $html)) and (preg_match('/(img)/', $html))) {
		return $html;
	} else {
		return htmlspecialchars($html);
	}
}
?>