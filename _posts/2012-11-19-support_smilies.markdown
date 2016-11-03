---
title:	"支持表情"
date:	2012-11-19 17:57:06.0
categories:	[随记,工具]
tags:	[Custom Smilies,表情,图片,comment,输入框]
---

下载插件：Custom Smilies

启动插件

下载表情包，系统默认的表情太丑了，附件的表情为人人的表情包

<a href="http://krislq.com/wp-content/uploads/2012/11/smilies.rar">smilies</a>

下载了表情后，替换 wordpress\wp-includes\images\smilies 里面的表情图片

<!--more-->
&nbsp;
完成以上的步骤就可以在写文章的时候加入表情了，但是如果想在评论的时候使用表情，就跟着我一起来吧。

第一种办法：

去插件的设置页：wp-admin/options-general.php?page=custom-smilies-se/custom-smilies.php　选择 “使用名为 comment_form 的 action，如果你的主题支持它的话。这样，你就不用手动添加 cs_print_smilies() 到 comments.php 了。”选项

&nbsp;

第二种办法：

通过第一种办法可能会觉得用户体现不够好，表情在输入框的下面，那么如果添加到输入框的上面呢？

1. 在 comments.php 的 textarea 之前的适当位置加入以下代码：

<pre lang="php"><?php if (function_exists(cs_print_smilies)) {cs_print_smilies();}?></pre>

如果没有找到textarea ？

不要着急，我们去/wp-includes/comment-template.php 找到comment_form_field_comment，添加如下：

<pre lang="php"><?php endif; ?&gt;
&lt;?php if (function_exists(cs_print_smilies)) {cs_print_smilies();}?&gt;
&lt;?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?></pre>

这个时候就可以去插件页面把其它选择去掉，不用再选啦
