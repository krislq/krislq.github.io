---
title:	"Android课堂-Intent匹配，你知多少？"
date:	2012-11-26 15:26:07.0
categories:	[开发,Android,学习课堂]
tags:	[Android,Intent,Intent Filter,Android课堂,Intent匹配,显式意图,隐式意图,筛选策略,Action,Category,Data,Uri,mimeType,Scheme,host,port,Activity]
---


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开发过 Android应用的人都知道 Intent的重要性及普遍性。我就不在这里重复了。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>但是大家知道系统是怎么通过Intent来找到你的真正意图的吗？</strong>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下面我们来讲一下Intent的分类：

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Intent分为两类，<strong>显式意图</strong>和<strong>隐式意图</strong>。

<!--more-->

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>显式意图</strong>明确指定了启动的Activity类。在我们自己的程序内部都是通过这种方式来启动。不被其它应用所熟知

&nbsp;&nbsp;&nbsp;&nbsp;启动如下：
<pre lang="java">
Intent intent = new Intent(mContext, NewActivity.class);</pre>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>隐式意图</strong>当然就是没有指定明确的类，而是通过Intent Filter来筛选合适的Activity去启动。 如果筛选后存在多个Activity可以执行Intent指定的动作，那么就会弹出一个Dialog来让用户自行决定。

&nbsp;&nbsp;&nbsp;&nbsp;一般用来启动别的应用程序或者是被其它的应用熟知的界面或者是模块。

&nbsp;&nbsp;&nbsp;&nbsp;启动如下：
<pre lang="java">
Intent intent = new Intent();
intent.setAction("Action");</pre>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;那当我们使用隐式启动的时候，系统又是如果进行筛选的呢？我们下面来看看Intent的筛选策略：

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在开始讲之前，我们先明确两个概念：

&nbsp;&nbsp;&nbsp;&nbsp;<strong>Intent:</strong> 是启动一个Activity , service, broadcast时发出的一个意图。Intent主要用于代码中，包含一个Action ,多个Category , 一些数据。

&nbsp;&nbsp;&nbsp;&nbsp;<strong>Intent Filter：</strong>是定义一个Activity , service, broadcast时的过滤器。多用于AndroidManifest.xml方中定义组件。在代码中主要用于动态注册我们的广播（BroadcastReceiver）。

1. 匹配Intent filter里面的Action动作。就是查找Activity在Intent Filter中有没有定义相应的Action。如果没有，则匹配失败。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通常我们在代码中设置一个Intent时，我们只能设置一个Action 动作,但是我们的Activity在定义Intent Filter时，可以定义多个Action动作.
<pre lang="java">
<intent-filter>  
	<action android:name="com.krislq.action.READ" />
	<action android:name="com.krislq.action.WRITE" />
	<action android:name="com.krislq.action.DELTE" />
</intent-filter>  </pre>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;只要我们Intent请求的Action是上面定义的三种Action的任意一种，都算匹配成功。

&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: red;">注意：</span>如果Activity没有在Intent Filter中定义任何的Action ,则任何的Action请求都不能匹配到该Activity 。则如果需要启动该Activity，只能通过显式的启动。

2. 匹配Intent Filter里面的category.匹配Category的过程会比Action更加的严格。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我们知道在Intent中我们可以包含多个category，只要当Intent Filter中包含了Intent中请求的所有的Category时才算匹配成功。

<intent-filter>元素可以包含<category>子元素，比如： </category></intent-filter>
<pre lang="java">
<intent-filter>
	<category android:name=”android.Intent.Category.DEFAULT” />
	<category android:name=”android.Intent.Category.BROWSABLE” />
</intent-filter> </pre>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注意：Intent Filter中多余的<category>申明并不会导致匹配的失败。</category>

3.匹配data数据。在Intent中表现的形式会是URI形式给出，而Intent Filter中呈现方式就比较具体了，比如有：scheme,host,path或mimetype。这些值都会与Intent中的URI和type内容。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如果有任何不匹配都会导致匹配不成功。
<ul>
	<li>mimetype是正在匹配的数据的数据类型。当匹配数据类型时，你可以使用通配符来匹配子类型（例如，images/*）。如果Intent Filter指定一个数据类型，它必须与Intent匹配；没有指定数据的话全部匹配。 &nbsp;&nbsp;&nbsp;&nbsp;</li>
	<li>scheme是URI部分的协议——例如，http:，mailto:，tel:。 &nbsp;&nbsp;&nbsp;&nbsp;</li>
	<li>host是介于URI中scheme和path之间的部分（例如，www.krislq.com）。匹配主机名时，Intent Filter的scheme也必须通过匹配。 &nbsp;&nbsp;&nbsp;&nbsp;</li>
	<li>port是host指向的主机的端口。也会参与匹配。 &nbsp;&nbsp;&nbsp;&nbsp;</li>
	<li>数据path是紧接在host或port后面（例如，/ig）。path只在scheme、host和port都匹配的情况下才匹配。</li>
</ul>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上面三步为匹配的过程 ，但是大部分时候我们在发送一个Intent时，或能只需要匹配其中的两步(Action是必需的，否则会抛出异常)。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如果匹配出来有多个Activity可供选择，则会弹出一个Dialog来让用户选择。
