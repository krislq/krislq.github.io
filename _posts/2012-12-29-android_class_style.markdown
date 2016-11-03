---
title:	"【Android课堂】android Style 小结"
date:	2012-12-29 21:54:20.0
categories:	[开发,Android,学习课堂]
tags:	[Kris,Android,style,课堂,Window,样式,自定义]
---

<img class="size-full wp-image-513 aligncenter" alt="android_style" src="http://www.krislq.com/wp-content/uploads/2012/12/android_style.png" width="630" height="114" />
<p style="padding-left: 30px;" align="left">最近项目 快完了，又到了美化界面有时候。把 android中style的应用总结了一下，以便大家闲来无事做一个参考，如果你的专家，达人，也请捧个人场 ，如有高见，请一并帖上，感激不尽。。。</p>
<p style="padding-left: 30px;" align="left">到底为什么 要用 style，这个问题就留给baidu??google来回答吧。</p>
<p style="padding-left: 30px;" align="left">我也参考了一些网上的资料，有些是复制 的，更多是自己的一些总结 ，各位看官就自行判断 了。</p>
<p style="padding-left: 30px;"><strong>Android上的Style分为了两个方面：</strong></p>
<p style="padding-left: 60px;">1. Theme是针对窗体级别的，改变窗体样式；</p>
<p style="padding-left: 60px;">2. Style是针对窗体元素级别的，改变指定控件或者Layout的样式。</p>
<!--more-->
<p style="padding-left: 30px;" align="left">Android系统的themes.xml和style.xml(位于<span style="color: #ff0000;"><strong><span style="font-size: large;">\base\core\res\res\values\</span></strong></span>)包含了很多系统定义好的style，建议在里面挑个合适的，然后再继承修改。</p>
<p style="padding-left: 30px;" align="left">以下属性是在Themes中比较常见的，源自Android系统本身的themes.xml：</p>
&nbsp;
<pre lang="xml">
<!-- Window attributes -->
<item name="windowBackground">@android:drawable/screen_background_dark</item>
<item name="windowFrame">@null</item>
<item name="windowNoTitle">false</item>
<item name="windowFullscreen">false</item>
<item name="windowIsFloating">false</item>
<item name="windowContentOverlay">@android:drawable/title_bar_shadow</item>
<item name="windowTitleStyle">@android:style/WindowTitle</item>
<item name="windowTitleSize">25dip</item>
<item name="windowTitleBackgroundStyle">@android:style/WindowTitleBackground</item>
<item name="android:windowAnimationStyle">@android:style/Animation.Activity</item>
</pre>
		
<p style="padding-left: 30px;">各种样式具体使用可看：<a href="http://henzil.easymorse.com/?p=364?">《android Theme使用总结 》</a>。里面有一些主题的效果图。我就不在这里黄婆卖瓜了。</p>

<div style="padding-left: 30px;" align="left">至于??android的style就比较的广泛了，如果有过web css开发经典的人来说，应该看一下就会懂的，当然也有它不同之处了。</div>
<div style="padding-left: 30px;" align="left">android的style文件我们是放在<span style="color: #0000ff;">res/values</span>目录下面的，当然它是一个 xml文件 ，根节点是：<span style="color: #0000ff;">resources</span>. 下面是一个示例：</div>
<div style="padding-left: 30px;" align="left"></div>
<pre lang="xml">
<?xml version="1.0" encoding="utf-8"?>
<resources>
  <style name="TextStyle">
	 <item name="android:textSize">14sp</item>
	 <item name="android:textColor">#fff</item>
	 </style>
</resources>
</pre>

<div style="padding-left: 30px;" align="left">在 style里面只需要定义需要改变的属性，不作设定的程序会自动引用系统默认的属性。</div>
<div style="padding-left: 30px;" align="left"><span style="color: #ff00ff;">在布局文件中我们怎么引用呢？</span></div>
<div align="left"></div>
<pre lang="xml">
<EditText id="@+id/editText1"
	style="@style/TextStyle"
	android:layout_width="wrap_content"
	android:layout_height="wrap_content"
	android:text="Hello, World!" />
	</pre>
<div align="left"></div>
<div style="padding-left: 30px;" align="left">其它经过引用style后的EditText定义为：</div>
<div align="left"></div>
<pre lang="xml">
<EditText id="@+id/editText1"
	android:layout_textSize="14sp"
	android:textColor="#fff"
	android:layout_width="wrap_content"
	android:layout_height="wrap_content"
	android:text="Hello, World!" />
</pre>
<div align="left"></div>
<div style="padding-left: 30px;" align="left">这样就更好的理解了吧？到于style item中的name应该怎么写？我想你也能知道了吧？</div>
<div style="padding-left: 30px;" align="left">以上只是style的一些简单的应用 ，下在将会讲到一个非常实用的知识，也就是style的继承关系。这样才能更好的简化我们代码的工作量，也更利用整个程序逻辑的组建。</div>
<div style="padding-left: 30px;" align="left">它的继承关系可以有两种实现的方式：</div>
<div style="padding-left: 60px;" align="left">1. 是通过 parent属性来指定 ，</div>
<div style="padding-left: 60px;" align="left">2. 通过点号来指定</div>
<div style="padding-left: 30px;" align="left">接下来我们分别来举例：</div>
<div style="padding-left: 60px;" align="left">我们程序中应用到最多的可能就是TextView了，它可能会有很多种情况 ，比如 作为title,正文，提示等等，而这一些的TextView有他的共同点，也有他们的不同之处。</div>
<div style="padding-left: 60px;" align="left">首先我们定义一个通过的style:</div>
<div align="left"></div>
<pre lang="xml">
<style name="TextStyle">
	<item name="android:shadowDx">-0.5</item>
	<item name="android:shadowDy">1</item>
	<item name="android:shadowRadius">0.5</item>
	<item name="android:singleLine">true</item>
	<item name="android:ellipsize">marquee</item>
</style>
</pre>
<div align="left"></div>
<div style="padding-left: 60px;" align="left">以上主要是定义了他的阴影啊，单行啊，超过长度怎么办啊。</div>
<div style="padding-left: 60px;" align="left">接下来我们再定义一个title级别的样式，title我们也想要这些属性，那么就得继承它了。</div>
<div style="padding-left: 60px;" align="left">首先我们用 parent属性来继承</div>
<div align="left"></div>
<pre lang="xml">
<style name="TextTitle" parent="TextStyle">
	<item name="android:textSize">18sp</item>
	<item name="android:textColor">#fff</item>
	<item name="android:textStyle">bold</item>
</style>
</pre>
<div align="left"></div>
<div style="padding-left: 60px;" align="left">parent属性中跟的就是父类的名称，就样title的阴影 ，字体大小 ，辨色，粗细就一起出来了，而我们不用再去定义title的阴影了。节省了不少的时间。</div>
<div style="padding-left: 60px;" align="left">第二种继承是利用parentStyle.childStyle的方式 ，用点号来继承 ，上面的TextTitle我们也可以这样写：</div>
<div align="left"></div>
<pre lang="xml">
<style name="TextStyle.TextTitle">
	 <item name="android:textSize">18sp</item>
	 <item name="android:textColor">#fff</item>
	 <item name="android:textStyle">bold</item>
</style>
</pre>

<div align="left"></div>
<div style="padding-left: 60px;" align="left">这样也能得到预期的效果。这样做不爽的地方 就是名字就长了，我们在引用这个style的时候，就得：</div>
<pre lang="xml">
style="@style/TextStyle.TextTitle"
</pre>
<div style="padding-left: 60px;" align="left">如果继承的层级越多，这个名字就会越长。</div>
<div style="padding-left: 30px;" align="left">怎么样？看懂了吧？这只是一些简单的应用 ，当然想制作出更漂亮的 style就得自己动手 去多练习一下，经验是不断的尝试积累出来的。</div>

<p style="padding-left: 30px;">本文早最发表于eoe社区：<a href="http://www.eoeandroid.com/thread-99671-1-1.html">http://www.eoeandroid.com/thread-99671-1-1.html</a></p>
