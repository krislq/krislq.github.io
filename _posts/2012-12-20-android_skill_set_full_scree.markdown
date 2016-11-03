---
title:	"【Android小技巧】设置全屏的三种方式"
date:	2012-12-20 17:14:08.0
categories:	[开发,Android,学习课堂,解决方案]
tags:	[Android,Activity,android小技巧,theme,style,application]
---

在开发的过程中，我们有时候需要让我们应用程序全屏或者是让某个页面全屏，在今天的android小技巧中我们来讲讲如何设置我们的应用程序 全屏：

通常我们有三种方式：

<li>1.在onCreate方法中添加代码 。</li>

<li>2.AndroidMainfest.xml里面使用android自带的theme来设置</li>

<li>3.style.xml中我们使用自定义的theme来设置。</li>

<!--more-->

接下来我们一一给大家解释：

<strong>1.在onCreate方法中添加代码 。</strong>
<pre lang="java">requestWindowFeature(Window.FEATURE_NO_TITLE);
getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);</pre>
注意：上面的代码需要添加在setContentView之前才是有效的，否则会报错哦。
这种方法主要是用于某个页面需要全屏的时候，要不你给自己每个activity都加上这段代码会显示代码比较的冗余。(当然，你也可以通过一个基础类去完成这些事)

<strong>2.AndroidMainfest.xml里面使用android自带的theme来设置</strong>
&nbsp;&nbsp;&nbsp;&nbsp;系统给我们提供了许多的theme ,如果我们知道它的名字与作用，大可以直接用就行了
<pre lang="xml">android:theme="@android:style/Theme.NoTitleBar.Fullscreen"</pre>
&nbsp;&nbsp;&nbsp;&nbsp;注意： 如果我们需要让整个应用程序都全屏，则把上面的属性加到application标签中。如果只是对某个activity 有效，可以设置给具体的某个activity标签

<strong>3.style.xml中我们使用自定义的theme来设置。</strong>
&nbsp;&nbsp;&nbsp;&nbsp;这种办法与第二种方法基本一致，都是通过theme来完成的。但是如果你不想用系统提供的，非得自己写一个style .那么你可以像下面这样来做：
<pre lang="xml">
<style>
<item name="android:windowNoTitle">true</item>
<item name="android:windowFullscreen">true</item>
<item name="android:background">#fff</item>
</style>
</pre>
&nbsp;&nbsp;&nbsp;&nbsp;注意：android:windowNoTitle 设置为无title ，再设置FullScreen.
&nbsp;&nbsp;&nbsp;&nbsp;然后在application 或者是activity标签中自己引用这个theme即可。
