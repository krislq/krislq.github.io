<?php
/*
Plugin Name: Mail To Commenter
Plugin URI: http://www.thinkagain.cn/archives/989.html
Description: This plugin helps user to notify reply to previous commenter in same post via simply insert '@+user+blank' or '@+user+:' to specify user name in comment.
Author: ThinkAgain
Version: 1.3.4
Author URI:http://www.thinkagain.cn/
*/
/*
[1.3.4] 2008-12-20 Pass focus to comment form after button been  clicked. 
[1.3.3] 2008-11-12, Fixed mail sending problem in case that the output of button uses @reply form .
[1.3.2] 2008-11-05, Fixed comment content display bug in notification mail.
[1.3.1] 2008-10-28, Fixed description display bug. 
[1.3] 	2008-10-25, Several bugs fixed, add options compatible to @reply.
[1.2]	2008-08-27, Fix bug to avoid losing previous setting in upgrade.
[1.1]	2008-08-26,	Add display nothing option to button output.  Fixed bug of unapproved comment also triggers mail sending.
[1.0]	2008-08-25 released.
*/
include_once( 'mailtocommenter_functions.php' );
$options = get_option( 'mailtocommenter_options');
if(!$options){
	init_mailtocommenter();
	$options = mailtocommenter_init_options();
}
if($options['language'] == 1) {
	load_textdomain('mailtocommenter', dirname(__FILE__) . "/mailtocommenter-zh_CN.mo");
}else{
	load_textdomain('mailtocommenter', dirname(__FILE__) . "/mailtocommenter-en_US.mo");
}
add_action('comment_post', create_function('$cid', 'return mailtocommenter($cid);'));
register_activation_hook(__FILE__, 'init_mailtocommenter');
register_deactivation_hook(__FILE__,'mailtocommenter_deactivation');
add_action('admin_menu', 'mailtocommenter_add_option');
add_action('comment_form','mailtocommenter_description');
function mailtocommenter($cid){
	$options= get_option( 'mailtocommenter_options');
	if(!$options['mail_notify']) return;
	if (($options['permission'] == 'admin') and (!current_user_can('switch_themes')))return;
	global $wpdb;
	$cid = (int)$cid;
	$commentdata = get_commentdata($cid,1,false);
	$owner_email = $commentdata['comment_author_email'];
	$post_id = (int)$commentdata['comment_post_ID'];
	$comments = get_approved_comments($post_id);
	$commentcontent = $commentdata['comment_content'];
	$output = mailtocommenter_get_names($commentcontent,$comments);
	if (!$output) return;
	$mails = mailtocommente_get_email($comments);
	$n = array();
	$admin_email = get_option('admin_email');
	$result = 0;
	foreach ($output as $name){
		if ((array_key_exists($name,$mails))and ($mails["$name"]!=$admin_email) and ($mails["$name"]!=$owner_email)){
			$to = $mails["$name"];
			$filter = mailtocommenter_filter($commentdata,$name);
			$subject =$filter[0];
			$message = $filter[1];
			$message = apply_filters('comment_text', $message);
			if(mailtocommenter_send_email($to,$subject,$message)){
				$result++;
			}
			$n["$name"] = $name;
		}
	}
	if (($options['notify_admin']) and ($result>0)){
		$subject = "CC. $subject";
		$n = implode(',',$n);
		$n = "<br/>This comment has been sent to {$n}.<br/>";
		$m = $n.'Backup copy sent to admin<br/>'.$message;
		$to = strtolower(get_option('admin_email'));
		mailtocommenter_send_email($to,$subject,$m);
	}
}
function mailtocommente_get_email($comments){
	$temp =array();
	foreach ($comments as $comment){
		$name = $comment->comment_author;
		if(!array_key_exists($name,$temp)){
			$email = $comment->comment_author_email;
			$temp["$name"] = $email;
		}
	}
	return $temp;
}
function mailtocommenter_get_names($content,$comments){
	$options= get_option( 'mailtocommenter_options');
	if ($options['button_content'] == 'atreply'){
		$content = preg_replace('/<a\shref="#comment-[0-9]+">/s','',$content);
		$content = preg_replace('/<a\shref="#comment-([0-9])+"\srel="nofollow">/s','',$content);
		$content = preg_replace('/<a\srel="nofollow"\shref="#comment-([0-9])+">/s','',$content);
	}
	if($options['at_all']){
		if(($options['at_all_permission']=="anyone") or (($options['at_all_permission'] == "admin") and current_user_can('switch_themes'))){
			//if (preg_match("/@all[\s:]{1}/i",$content)) {
			if (preg_match("/@all/i",$content)) {
				$output =array();
				foreach ($comments as $comment){
				$name = $comment->comment_author;
				if(!array_key_exists($name,$output)){
					$output["$name"] = $name;
					}
				}
				return $output;
			}
		}
	}
	if ($options['type'] == "@+user+blank"){
	$names  = explode(' ',$content);
	}else{
		$names  = explode(':',$content);
	}
	$output = array();
	foreach($names as $name){
		$name = $name;
		$number = substr_count($name,'@');
		if ($number >0 ){
			$length = strlen($name);
			$pos = strrpos($name,'@')+1;
			$n = substr($name,$pos,$length);
			$output["$n"] = $n;
		}
	}
	return $output;
}
function init_mailtocommenter(){
	$exist_options = get_option( 'mailtocommenter_options');
	$init_options = mailtocommenter_init_options();
	if($exist_options){
		$diff = array_diff_assoc($init_options,$exist_options);
		$hf_options = array_merge($diff,$exist_options);
		update_option('mailtocommenter_options', $exist_options);
	}else{
		add_option( 'mailtocommenter_options', $init_options);
	}
}
function mailtocommenter_deactivation(){
	$options= get_option( 'mailtocommenter_options');
	if ($options['save_options']) return;
	global $wpdb;
	$remove_options_sql = "DELETE FROM $wpdb->options WHERE $wpdb->options.option_name='mailtocommenter_options'";
	$wpdb->query($remove_options_sql);
}
function mailtocommenter_add_option() {
	if (function_exists('mailtocommenter_options_page')) {
		add_options_page('Mail to Commenter Options', 'Mail to Commenter Options',8, basename(__FILE__), 'mailtocommenter_options_page');
	}
}
?>