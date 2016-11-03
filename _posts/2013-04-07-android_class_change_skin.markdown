---
title:	"【Android实例】android换肤(三)-通过style实现"
date:	2013-04-07 22:45:57.0
categories:	[开发,Android,随手实例]
tags:	[theme,style,skin,换肤]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/04/changetheme.png"><img src="http://www.krislq.com/wp-content/uploads/2013/04/changetheme.png" alt="changetheme" width="700" height="250" class="alignnone size-full wp-image-683" /></a>
&nbsp;

在long long ago ,写过两篇文章来实现换肤,在论坛里面不敢说人人皆知,但是人气还是到位了的.如果你还不知道,那赶快再去看看吧:
<p style="padding-left: 30px;">
<a href="http://www.eoeandroid.com/thread-102060-1-1.html">[Android实例] 【Kris专题】android　换肤 </a>
<a href=" http://www.eoeandroid.com/thread-102536-1-1.html">[Android实例] 【kris专题】android　换肤（续）</a></p>

另外一些在本文中会使用到的些知识:
<p style="padding-left: 30px;">
<a href="http://www.eoeandroid.com/thread-99671-1-1.html">【Kris专题】android Style 小结</a>
<a href=" http://www.eoeandroid.com/thread-105450-1-1.html">[Android实例] 【Kris专题】android:shape的使用</a></p>
<!--more-->

然后今天我将给大家带来更神奇也更方便的一种方法来完成换肤.至于大家在项目中使用哪种方法就看大家的实际的项目需求了.

这种换肤的主要思路是通过 Style来完成,如果大家对 Style的应用还不是很清楚,或者说是甚至没听说过,那你就危险了,至少足以证明你在Android界里面有多菜了.如果应用不是很熟悉,或者说他的原理不是很清楚的,自己可以多查阅一些资料,在这里就不作更仔细的介绍了.

我们还是通过Demo 来一步步守成整个换肤的过程吧..

1.当然是建一个Android projects. 项目名什么的就随便你自己取了.我推荐大家在写自己的一些 demo的时候,指导编译 sdk可以设置到最高,别老是在2.x 徘徊了,有意思吗?
2.项目建好之后,就准备好各种我们图片资源文件吧(你可以ps一些背景图,也可以通过style中的shape来制作一些资源.或者说在color.xml中定义好一些颜色值,当然最方便的还是下载我的demo啦,里面啥都有了,呵呵 )
3.在res/values目录下建议一个attrs.xml.里面用来定义一些style 的属性.如下:

<pre lang="xml">
	<?xml version="1.0" encoding="utf-8"?>
	<resources>

		<attr name="button" format="reference"/>
		<attr name="background" format="reference"/>
		<attr name="textColor" format="reference"/>
	</resources>
</pre>
代码解释:
<p style="padding-left: 30px;">在上面的代码中,我们定义了三个属性(button,backgroud,textColor),这三个属性呢会在Style中用到,并且指出它的格式是引用形的.
比如说 button,它的值到时候我们会在style里面去设置,并且指向具体的某个资源文件.</p>

4.然后到我们的res/values/style.xml了.(非常关键哦)
<pre lang="xml">
	<resources xmlns:android="http://schemas.android.com/apk/res/android">
		<style name="AppTheme_Default" parent="@android:style/Theme.Holo.Light.DarkActionBar">
			<item name="button">@drawable/btn_grey</item>
			<item name="background">@drawable/backgroud2</item>
			<item name="textColor">@color/red</item>
		</style>
		
		<style name="AppTheme_Another" parent="AppTheme_Default">
			<item name="button">@drawable/btn_blue</item>
			<item name="background">@drawable/backgroud1</item>
			<item name="android:actionBarStyle">@style/ActionBarStyle</item>
		</style>
		
		<style name="ActionBarStyle" parent="@android:style/Widget.Holo.Light.ActionBar.Solid.Inverse">
			<item name="android:background">#33b5e5</item>
		</style>
	</resources>
</pre>
代码解释:
<p style="padding-left: 30px;">在这里我们定义了三个style (AppTheme_Default,AppTheme_Another,ActionBarStyle),其中AppTheme_Default,AppTheme_Another表示我们的两套主题.ActionBarStyle为我们actionBar的样式.
AppTheme_Default为默认的主题,它是继承至@android:style/Theme.Holo.Light.DarkActionBar.当然你也可以继承Android中任意的已经有的主题 或者是style , 你也可以选择不继承任何已经有的样式 .
AppTheme_Another为我们第二套主题 ,它是继承至AppTheme_Default的.在这里我们可以覆写部分AppTheme_Default里面的值,也可以覆写全部AppTheme_Default里面的值,这个看你具体的主题,也可以扩展其它一些新的值.
比如说在AppTheme_Another中,没有覆写textColor的值 ,也就是在这两种主题中,我的文字的颜色值都是使用AppTheme_Default主题 中的值,都为红色.但是又新增了一个android:actionBarStyle的样式来改变actionBar 的样式.</p>

5.接下来呢,我们再实现一个基础类,BaseActivity来代替所有的activity完成主题的切换(当然要求程序里面所有的activity 都得继承至 BaseActivity).

<pre lang="java">
	public class BaseActivity extends Activity {
		public int mTheme = R.style.AppTheme_Default;

		@Override
		protected void onCreate(Bundle savedInstanceState) {
			if (savedInstanceState == null) {
				mTheme = PreferenceHelper.getTheme(this);
			} else {
				mTheme = savedInstanceState.getInt("theme");
			}
			setTheme(mTheme);
			super.onCreate(savedInstanceState);
		}

		@Override
		protected void onResume() {
			super.onResume();
			if (mTheme != PreferenceHelper.getTheme(this)) {
				reload();
			}
		}

		protected void reload() {
			Intent intent = getIntent();
			overridePendingTransition(0, 0);
			intent.addFlags(Intent.FLAG_ACTIVITY_NO_ANIMATION);
			finish();
			overridePendingTransition(0, 0);
			startActivity(intent);
		}
	}
</pre>
代码解释:
<p style="padding-left: 30px;">onCreate中,我们从preference中去获取到主题,并且设置给 activity.
在onresume中再去检查主题 是否已经改变? 如果已经改变了,就重新加载activity ,否则没有动作.
reload就是finish当前 activity ,再启动当前activity啦.</p>

6.万事俱备了,现在的问题是我们在atrrs中定义的button , background怎么使用呢?
<p style="padding-left: 30px;">
a).java代码:
<pre lang="java">
			int[] attrs = new int[]{R.attr.button};
			TypedArray typedArray = context.obtainStyledAttributes(attrs);
</pre>
具体的使用大家自行去测试了

b).直接在layout文件里面使用.比如我们 demo中的两个布局文件 .在这里我们例出一个来讲解.
second.xml</p>
<pre lang="xml">
		<RelativeLayout xmlns:android="http://schemas.android.com/apk/res/android"
			android:layout_width="match_parent"
			android:layout_height="match_parent"
			android:background="?attr/background" >

			<TextView android:id="@+id/textview"
				android:layout_width="wrap_content"
				android:layout_height="wrap_content"
				android:textColor="?attr/textColor"
				android:layout_alignParentTop="true"
				android:layout_centerHorizontal="true"
				android:text="@string/msg_second" />

			<Button
				android:id="@+id/button"
				android:layout_width="wrap_content"
				android:layout_height="wrap_content"
				android:layout_centerInParent="true"
				android:background="?attr/button"
				android:text="@string/btn_text" />
		</RelativeLayout>
</pre>
代码解释:
<p style="padding-left: 30px;">android:background="?attr/background"在这里使用了我们在attrs.xml中的background属性.
android:textColor="?attr/textColor" 使用了我们在attrs.xml中定义的textColor
android:background="?attr/button" 在这里使用了我们在attrs.xml中定义的button属性</p>

我们再来走一个这个调用的流程.
<p style="padding-left: 30px;">在生成布局文件中RelativeLayout的时候,系统找到attrs.xml中定义的backround,然后再去当前设置的theme(我们假设是AppTheme_Default)中找到background指向的资源@drawable/backgroud2然后加载到内存赋值给RelativeLayout的android:background.如果当前主题 是AppTheme_Another,就会导入@drawable/backgroud1给RelativeLayout的android:background</p>

好的.基本就讲到这里了.大家可以多看看 demo .多自己摸过下.

下面是源码来了.

=================

<a href="http://www.krislq.com/wp-content/uploads/2013/04/ChangeTheme_new.zip">ChangeTheme_new</a>
=================
