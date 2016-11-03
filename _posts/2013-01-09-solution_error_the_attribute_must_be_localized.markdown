---
title:	"【解决方案】Error: This attribute must be localized."
date:	2013-01-09 14:01:02.0
categories:	[开发,Android,解决方案]
tags:	[Android,TextView,attribute,localized]
---

有时候我们在eclipse里面开发个小应用时候，为了方便就把String直接写在layout里面了。如下：
<pre lang="xml"></pre>
明明运行的好好的。但是我们一旦使用make命令去生成apk文件地时候，却抛出了异常：
<p style="padding-left: 30px;"><strong>Error: This attribute must be localized.</strong></p>

<h3>出错原因：</h3>
<p style="padding-left: 30px;">android强制我们使用多语言造成的。</p>
<p style="padding-left: 30px;"><!--more--></p>

<h3>解决办法：</h3>
<p style="padding-left: 30px;">把String定义到res/values/string.xml里面去就好了。解决吧？</p>
<p style="padding-left: 30px;">/res/values/string.xml</p>

<pre lang="xml">
    Design by Kris</pre>
在将自己的textView修改如下：
<pre lang="xml"></pre>
