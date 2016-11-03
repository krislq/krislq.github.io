=== Mail To Commenter ===
Contributors: redhorsecxl
Donate link: http://www.thinkagain.cn
Tags: reply, comment, twitter,mail, notification
Requires at least: 2.3
Tested up to: 2.7
Stable tag: 1.3.4

This plugin helps user to notify reply to previous commenter in same post via simply insert '@+user+blank' or '@+user+:' (like twitter) in comment.

== Description ==

This plugin helps user to notify reply to previous commenter in same post via simply insert '@+user+blank' or '@+user+:' (like twitter) to specify user name in comment.

1. The main funciton of plugin is to detect comment content and automatically send mail notification if associated option is activated. 
1. Using `<?php mailtocommenter_button();?>` to generate button to earier insert code or generate link to comment. This function is almost the same with [reply to](http://wordpress.org/extend/plugins/reply-to/ "reply to") plugin except the style of button can be fully customized by admin.

Basically, all settings can be easily configured via option page under dashboard. Admin has ability to:

1. Activate mail notification.
1. Activate usage of '@all' which allows user to group send reply to all previous commenter in same post.
1. Set the output and style of button which is used to help user to easily insert code ('@user ' or '@user:') in their comment.
1. Cutomize the mail templete (subject and message.). User is encouraged to use pre-defined variables to customize owner template. `template.txt` file provides some default text content of mail template just for your reference.

Various options with corresponding explanation are listed in 'Mail to commenter options' page, you can customize the using of plugin by setting different combination of options. For example,
you may not want to use mail notification, but you also can use `<?php mailtocommenter_button();?>` function to create a hyperlink to comment.

Click [here](http://wordpress.org/extend/plugins/mailtocommenter/other_notes/ "release log") to see change log.
Note:

1. Plugin will automatically load language pack according to wordpress language defined in wp-config.php. Default is english. Available language pack: English,Chinese, Belorussian (Contributor: [Fat Cow](http://www.fatcow.com/ "Fat Cow")).
2. Chinese user please check <a href="http://www.thinkagain.cn/archives/985.html">here</a> for chinese instruction.

Sincerely thanks for advices from [qiange](http://i-lady.cn/ "qiange"),[ddkk3000](http://lxz.name/ "ddkk3000"), [Patrick](http://www.aftertown.cn/ "Patrick"), [Sofish](http://www.happinesz.cn/ "Sofish"), [Leeiio](http://blog.guaniu.com/ "Leeiio"),[Jinwen](http://smartr.cn/ "Jinwen"),[Fat Cow](http://www.fatcow.com/ "Fat Cow")

== Installation ==

Installation:

1. Upload `mailtocommenter` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin with name `Mail To Commenter` through the 'Plugins' menu in WordPress.
1. Navigate to 'Mail to commenter options' page to configue necessary options to make it run in your rule.

* Place `<?php mailtocommenter_button();?>` in theme templates to generate button to easier input code.
* Place `<?php mailtocommenter_description();?>` in theme templates to display instruction for viewer.


Uninstallation:

Navigate to 'Plugin' menu, and deactivate 'Mail To Commenter'. If keep configuration option is unchecked, all associated data will be automatically deleted.

Note:

1. Plugin will automatically load language pack according to wordpress language defined in wp-config.php. Default language is english. Available language pack: English,Chinese and [BELORUSSIAN ](http://www.fatcow.com/ "Fat Cow").
2. Chinese user please check <a href="http://www.thinkagain.cn/archives/985.html">here</a> for chinese instruction.

== Frequently Asked Questions ==

= Why commenter doesn't recieve notification mail? =

Be sure mail notification is activated. Default is deactivated.


== Screenshots ==

1. This part mainly provides the control of mail and code function.
2. Admin can customize button style and output in part2.
3. This part defines mail template and contains explanation of predined variables used in template.
4. Extra part to let admin to send email. Just input mail address, subject and message, then click send button.

== Release Log ==
*			2009-06-19: Add Belorussian language file. Thanks [Fat Cow](http://www.fatcow.com/ "Fat Cow").
* [1.3.4]	2008-12-20: Pass focus to comment form after button been  clicked.
* [1.3.3] 	2008-11-12: Fixed mail sending problem in case that the output of button uses @reply form .
* [1.3.2]	2008-11-05: Fixed comment content display bug in notification mail. Thanks [Sofish](http://www.happinesz.cn/ "Sofish").
* [1.3.1]	2008-10-28: Fix description display bug.
* [1.3]		2008-10-27: Several bugs fixed, new options added, e.g, language pack optional in dashboard; compatible with @reply plugin.
* [1.2]		2008-08-27: Fix bug to avoid losing previous setting in upgrade.
* [1.1]		2008-08-26: Fixed bug of unapproved comment also triggers mail sending.	Add display nothing option to button output. 
* [1.0]		2008-08-25:	1.0 released.
