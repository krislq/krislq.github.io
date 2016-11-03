---
title:	"【Android课堂】 实现应用的多入口图标"
date:	2012-11-26 23:05:13.0
categories:	[开发,Android,学习课堂,随手实例]
tags:	[Intent,Android课堂,Action,Category,Activity,多入口,MAIN,Launcher,DEFAULT,singleInstance]
---

	&nbsp;&nbsp;&nbsp;&nbsp;最近仔细复习了一下Intent中的相关知识，发现这一块的内容用起来说简单也简单，但是一深究下去，也有许多好玩的东西。
	&nbsp;&nbsp;&nbsp;&nbsp;本篇中我们就主要来谈一下如果实现应用程序的多入口。
	&nbsp;&nbsp;&nbsp;&nbsp;<strong>什么意思呢？</strong>
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;就是一个应用，安装后，在“所有应用”里面出现了多个入口 。
	&nbsp;&nbsp;&nbsp;&nbsp;<strong>主要用于什么情况呢？</strong>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;主要用于我们程序多个功能时，为了便于用户启动想要的功能， 则可以做成一个应用，多个入口 ，直接在“所有应用”中选择相应的图标就可以直接引入到程序的相应的功能界面去。

<!--more-->
	&nbsp;&nbsp;&nbsp;&nbsp;在正式开始讲之前呢，我们需要再复习一下Action 与Category的知识：

	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Action</strong>主要是指名Intent的一个动作，在隐式请求Intent中，如果没有Action ,则不能匹配到任何的Activity来执行此Intent.
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Category</strong>主要是指定一个Intent 的类别。与Action配合才能更具体是表示一个  Intent的意图。

	&nbsp;&nbsp;&nbsp;&nbsp;系统也为我们提供了许多的Action与Category。在这里我们主要是介绍一下我们在本内容中会使用到的Action 与Category，至于其它的，大家可以网上搜索一下，一大堆。
        <pre lang="java">
	android.intent.action.MAIN
		它主要是决定我们程序的入口。因为我们的应用可能不止一个activity ,
但是在启动的时候应该启动哪个activity呢？就是则它决定的。
	android.intent.category.LAUNCHER
		它主是决定是否需要将图片显示到Launcher的"所有应用"中去。
	android.intent.category.DEFAULT
		默认的一个category .
	</pre>

	&nbsp;&nbsp;&nbsp;&nbsp;我们平时在程序中，对入口的定义，一般是用的android.intent.action.MAIN和android.intent.category.LAUNCHER。这个大家都都应该清楚 。
	&nbsp;&nbsp;&nbsp;&nbsp;<strong>但是android.intent.category.DEFAULT又用在何处呢？</strong><strong>什么时候该用android.intent.category.DEFAULT呢？</strong>

	&nbsp;&nbsp;&nbsp;&nbsp;我前面的一个帖子  <a href="http://www.krislq.com/2012/11/android_class_intent_match/" title="Android课堂-Intent匹配，你知多少？" target="_blank">Android课堂-Intent匹配，你知多少？</a>  中讲到，我们的Intent启动分为两种，一种是显式的，一种是隐式的。
	&nbsp;&nbsp;&nbsp;&nbsp;intent到底发给哪个activity，需要进行三个匹配，一个是action，一个是category，一个是data。
	&nbsp;&nbsp;&nbsp;&nbsp;<strong>理论上来说，如果intent不指定category，那么无论intent filter的内容是什么都应该是匹配的。但是，如果是我们在代码中使用的是隐式的Intent，android默认给加上一个CATEGORY_DEFAULT，这样的话如果intent filter中没有android.intent.category.DEFAULT这个category的话，匹配测试就会失败。所以，如果你的 activity支持接收隐式intent启动的话就一定要在intent filter中加入android.intent.category.DEFAULT。</strong>
	&nbsp;&nbsp;&nbsp;&nbsp;当然，有个例外，就是要程序有入口activity中他们已经定义了android.intent.action.MAIN和android.intent.category.DEFAULT，我们可以省略掉android.intent.category.DEFAULT，当然，你加上也不会有错。
	

	
	
        &nbsp;&nbsp;&nbsp;&nbsp;讲了action和category，我们再来看看我们的主要任务：如果实现一个应用多个入口 ？
	&nbsp;&nbsp;&nbsp;&nbsp;经过上面的讲解，可能你也已经猜到了，使用android.intent.action.MAIN和android.intent.category.DEFAULT。
	
	&nbsp;&nbsp;&nbsp;&nbsp;我们下面来看一看代码：
<pre lang="java">
	        <activity android:name=".MainActivity"
            android:label="Test_Main">
            <intent-filter>
                <action android:name="android.intent.action.MAIN" />
                <action android:name="com.krislq.broadcast.First" />
                <category android:name="android.intent.category.LAUNCHER" />
            </intent-filter>
        </activity>
        <activity android:name=".SecondActivity"
            android:label="Test_Second">
            <intent-filter>
                <action android:name="android.intent.action.MAIN" />
                <action android:name="com.krislq.broadcast.Second" />
                <category android:name="android.intent.category.LAUNCHER" />
            </intent-filter>
        </activity>
		</pre>
		&nbsp;&nbsp;&nbsp;&nbsp;我们再运行一下看看效果？
		<a href="http://www.krislq.com/wp-content/uploads/2012/11/many_enter_icon.png"><img src="http://www.krislq.com/wp-content/uploads/2012/11/many_enter_icon-300x209.png" alt="" title="many_enter_icon" width="300" height="209" class="alignnone size-medium wp-image-230" /></a>
		&nbsp;&nbsp;&nbsp;&nbsp;但是细心的人多测试几次就会发现，当我们在Test_Main界面中，点击Home键切换到后台，点击Test_Second的图标时，就会进入Test_Main.
		&nbsp;&nbsp;&nbsp;&nbsp;为什么会这样呢？
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;因为虽然是两个入口，但是他们都是属于同一个应用的，你按Home键切换到后台，程序还在运行，这时再点击Test_Second，系统会显示上次程序的停留界面，而并不会去启动一个新的应用。
		
		&nbsp;&nbsp;&nbsp;&nbsp;如何让他们两个入口相互不影响呢？
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我们可以修改Activity的LaunchMode为singleInstance。
		<pre lang="java">
		<activity android:name=".MainActivity"
            android:label="Test_Main"
			android:launchMode="singleInstance">
            <intent-filter>
                <action android:name="android.intent.action.MAIN" />
                <action android:name="com.krislq.broadcast.First" />
                <category android:name="android.intent.category.LAUNCHER" />
            </intent-filter>
        </activity>
        <activity android:name=".SecondActivity"
            android:label="Test_Second"
			android:launchMode="singleInstance">
            <intent-filter>
                <action android:name="android.intent.action.MAIN" />
                <action android:name="com.krislq.broadcast.Second" />
                <category android:name="android.intent.category.LAUNCHER" />
            </intent-filter>
        </activity>
		</pre>
		&nbsp;&nbsp;&nbsp;&nbsp;但是我们修改成singleInstance后，我们的两个activity就不能初始化实例出来了哦。
		&nbsp;&nbsp;&nbsp;&nbsp;所以大家在使用的时候，一定要衡量每种办法的权重。
