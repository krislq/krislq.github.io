---
title:	"Android课堂-在桌面添加可拖动/可点击的悬浮窗口(续)"
date:	2012-11-30 16:48:51.0
categories:	[开发,Android,学习课堂]
tags:	[桌面,360,悬浮窗,效果图,触摸,刷新,拖动,点击,状态栏]
---

&nbsp;&nbsp;&nbsp;&nbsp;看了360手机助手的桌面功能，觉得深受启发，自己也特别有兴趣就深入的感觉了一下。
&nbsp;&nbsp;&nbsp;&nbsp;前面已经写了两篇文章 ，没看过的强烈建议先去看看。

&nbsp;&nbsp;&nbsp;&nbsp;<a title="Android课堂-判断当前显示是否为桌面" href="http://www.krislq.com/2012/11/android_class_judge_whether_it_is_launcher/">Android课堂-判断当前显示是否为桌面</a>

&nbsp;&nbsp;&nbsp;&nbsp;<a title="Android课堂-在桌面添加可拖动/可点击的悬浮窗口" href="http://www.krislq.com/2012/11/android_class_floating_window/">Android课堂-在桌面添加可拖动/可点击的悬浮窗口</a>

&nbsp;&nbsp;&nbsp;&nbsp;这两天兴趣不减，又把自己的这个实例再丰富了一下，与360的桌面快捷键更为的相似了哦。

&nbsp;&nbsp;&nbsp;&nbsp;<a title="Android课堂-在桌面添加可拖动/可点击的悬浮窗口" href="http://www.krislq.com/2012/11/android_class_floating_window/">Android课堂-在桌面添加可拖动/可点击的悬浮窗口</a>里面只是显示一个图片在最顶层中，添加了click事件与拖动事件，本次这个增强版本增强了哪些功能呢？
<!--more-->
&nbsp;&nbsp;&nbsp;&nbsp;我们先来看看图片

&nbsp;&nbsp;&nbsp;&nbsp;<img class="size-medium wp-image-347 aligncenter" title="float_window_strong" src="http://www.krislq.com/wp-content/uploads/2012/11/float_window_strong-215x300.jpg" alt="" width="215" height="300" />
<ul>
	<li>1.我们看到形势上面与360的小人更像了，也是爬在了屏幕的最左边或者是最右边。</li>
	<li>2.当用户触摸到机器人的时候，机器人会变大，让用户有个触感上面的变化。</li>
	<li>3.当用户拖动的X范围大于一定的时候，机器人会从屏幕的边框中跳出来，我们将会看到一个完整的机器人，这时进入拖动模式，机器人会跟着我们拖动的轨迹来移动。</li>
	<li>4.当用户放手后，机器人会自动地回到屏幕的左边或者是右边。</li>
	<li>5.如果用户没有让机器人进入到拖动模式，则默认为是点击操作。&nbsp;&nbsp;&nbsp;&nbsp;以上表现形式与360的小人是一样的。

&nbsp;&nbsp;&nbsp;&nbsp;本来我想找个屏幕录像软件录像的，这样大家可以更为清楚地知道增强版做了哪些改进？也更能体会到增强后的可玩性。
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;可是让大家失望了，找了两个都不能用(虽然我有root权限，但是一运行就crash了，还有一个连接不到服务)。

&nbsp;&nbsp;&nbsp;&nbsp;另外此实例还可以继续加强的方向：</li>
	<li>1.往360快捷方式发展，把自己的应用入口移到桌面上来。</li>
	<li>2.可以增加更多的交互性动作，继续增加应用的可玩性。</li>
	<li>3.做成widget形势。</li>
	<li>&nbsp;&nbsp;&nbsp;&nbsp;好了，不废话了，下面是apk 文件，如果对本实例持围观态度的，先下来apk来就行看看效果。
&nbsp;&nbsp;&nbsp;&nbsp;网站让传apk不太安全，所以打包成了rar ,大家下载后直接解压即可

================
&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.krislq.com/wp-content/uploads/2012/11/FloatingWindows.apk_.rar">FloatingWindows.apk</a>
================
&nbsp;&nbsp;&nbsp;&nbsp;接下来是源码啦：
================
&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.krislq.com/wp-content/uploads/2012/11/FloatingWindows_2.rar">FloatingWindows_2</a></li>
===============
</ul>
