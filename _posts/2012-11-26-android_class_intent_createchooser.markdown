---
title:	"【Android课堂】 Intent.createChooser妙用"
date:	2012-11-26 15:51:13.0
categories:	[开发,Android,学习课堂]
tags:	[Android,Intent,Android课堂,createChooser,ACTION_GET_CONTENT,ACTION_CHOOSER,EXTRA_TITLE]
---

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在上篇中我们讲解到了Intent的匹配过程，地址：<a title="Android课堂-Intent匹配，你知多少？" href="http://www.krislq.com/2012/11/android_class_intent_match/">Android课堂-Intent匹配，你知多少？</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其中有三个步骤，包括<strong>Action </strong>, <strong>category</strong>与<strong>data </strong>的匹配。也讲到了如果匹配出了多个结果，系统会显示一个dialog让用户来选择。如下图：

<img class="size-medium wp-image-212 aligncenter" title="intent_createChooser" src="http://www.krislq.com/wp-content/uploads/2012/11/intent_createChooser-168x300.png" alt="" width="168" height="300" />

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;那么今天我们主要是讲解一下，<strong>如何自定义这个Chooser的标题？</strong>
<!--more-->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;代码其实很简单，如下：
<pre lang="java">
Intent intent = new Intent(Intent.ACTION_GET_CONTENT);
intent.setType("audio/*");
startActivity(Intent.createChooser(intent, "Select music"));</pre>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;可能很多同学就会疑问到底在createChooser()方法里面，<strong>android做了什么？</strong>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我们再来看看这个方法的源码：
<pre lang="java">
public static Intent createChooser(Intent target, CharSequence title) {
    Intent intent = new Intent(ACTION_CHOOSER);
    intent.putExtra(EXTRA_INTENT, target);
    if (title != null) {
        intent.putExtra(EXTRA_TITLE, title);
    }
    return intent;
}</pre>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这下大家应该清楚了，原来在调用createChooser()方法时候，系统又创建了一个新的Action为<strong>ACTION_CHOOSER</strong>的Intent ,并把我们的原始Intent当成了参数传进去 。选择器的title是通过 <strong>EXTRA_TITLE</strong>传入进去的。
