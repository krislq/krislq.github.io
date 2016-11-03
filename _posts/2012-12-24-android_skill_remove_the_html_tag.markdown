---
title:	"【Android小技巧】如果快速去掉Html中的标签"
date:	2012-12-24 21:47:34.0
categories:	[开发,Android,学习课堂,解决方案]
tags:	[Android,android小技巧,TextView,Spanned,Html]
---

在平时的开发过程中，有时候我们从网络获取到的数据可能包含有一些html 标签 ,我们用TextView来显示的时候，我们可以通过Html来将html直接转化成 Spanned来显示。

如：
<pre lang="java">textView.setText(Html.fromHtml(content.getTitle()));</pre>
&nbsp;

效果如下:
<img class="alignnone size-full wp-image-502" alt="history_of_today_12_24" src="http://www.krislq.com/wp-content/uploads/2012/12/history_of_today_12_24.png" width="660" height="319" />

但是也有时候，我们不想显示出html里面的标签 ，比如说&lt;a&gt;等等 。（也就是显示出来的时候，去掉里面的连接，没有上图中的绿色字体）。<strong>又该如何办呢？</strong>
<!--more-->
一般的思路，我们可以是找到html中的标签，比如&lt;p&gt;&lt;a&gt;&lt;label&gt;等等 ，然后去掉里面的标签就行了。但是往往许多人觉得这样非常的麻烦。

在这里我给大家介绍一种更加便捷的方法：

&nbsp;

代码如下：
<pre lang="java">textView.setText(Html.fromHtml(content.getTitle()).toString());</pre>
&nbsp;

效果如下：

<img class="alignnone size-full wp-image-503" alt="history_of_today_12_24_2" src="http://www.krislq.com/wp-content/uploads/2012/12/history_of_today_12_24_2.png" width="601" height="279" />

&nbsp;

哈哈，是不是挺简单的呢？
