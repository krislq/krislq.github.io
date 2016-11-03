---
title:	" Android Stuido 使用之初体验"
date:	2013-05-16 11:12:40.0
categories:	[工具,开发,Android]
tags:	[Kris,eclipse,Android Studio,ADT]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/05/androidstuio_700.jpg"><img src="http://www.krislq.com/wp-content/uploads/2013/05/androidstuio_700.jpg" alt="androidstuio_700" width="700" height="393" class="alignnone size-full wp-image-734" /></a>

Google IO在昨天（2013-05-15）举行了，如果说传闻从发布android 5.0到android 4.3 到最后啥新系统版本也没有，连个硬件也没发布。着实让人许多人失望了。
不过早在开幕前几个小时官方就说了，我们主要是对开发者提升了一些服务。不过在大会中发布的Android Studio还是让人很惊艳的。

在这个时候 ，我也觉得Google应该停一停他们新版本的脚步了，现在还有多少人还在用4.0以下的版本进行编译啊。。而且 Android新版本的普及速度和ios真的是天壤之别啊。。早就有人拿android和ios开发作对比了，一个是高帅富，一个是穷屌丝。

如果在这么下去，连开发者都跟不上Google速度，那么  Android 还会走得长远吗？如果Google 再不给Android屌丝们逆袭的机会，全都会傍高帅富去啰 。。

我觉得Android Studio推出的更是时候啊。[点击全文进入详细页面查看更多]
<!--more-->
再扯回来吧。。

Android Studio 详细的页面地址：<a href="https://developer.android.com/sdk/installing/studio.html" title="Android Studio" target="_blank">https://developer.android.com/sdk/installing/studio.html</a>

<a href="http://www.krislq.com/wp-content/uploads/2013/05/website.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/website.png" alt="website" width="1048" height="783" class="alignnone size-full wp-image-735" /></a>

如果你不能访问官网，那么，我们在百度盘给你们准备好下载地址：(windows & Mac)
<a href="http://www.eoeandroid.com/thread-275380-1-1.html" target="_blank">[Android利器]Android Studio下载地址来啰 。。</a>

注意： Android Studio 现在是不分32位还是64位的。如果你下载后电脑没办法安装，多试几次，再走 本来就是预览版本的，会有许多的BUG .如果实在是启动不起来，只能为你默哀，然后坐等新的更新版本吧。嘿嘿。。

下载安装好后，就跟着我一起来玩起来吧！！！

1.下载 ，看上面的下载连接 ，这个还说的话，就证明你太菜了
2.安装需要java环境的，也跳过了，安装程序会自动查找你的JDK路径什么的，一路下一步就行了
3.运行时的欢迎界面 ，和eclipse有点像。哈哈

<a href="http://www.krislq.com/wp-content/uploads/2013/05/androidstuido.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/androidstuido.png" alt="androidstuido" width="400" height="300" class="alignnone size-full wp-image-739" /></a>

4.启动完成后，就是一个引导页面，可以新建项目，可以导入项目。<strong>只是觉得左边那个recentProject有点像xcode的意思了</strong>。可以快速打开自己以前的项目。 但是有点不爽的就是，不能同时在Android studio里面查看多个项目了，和Xcode 一样，一个Android studio实例里面，只能有一个项目。 
<a href="http://www.krislq.com/wp-content/uploads/2013/05/welcomeAndroidStudio.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/welcomeAndroidStudio.png" alt="welcomeAndroidStudio" width="669" height="501" class="alignnone size-full wp-image-749" /></a>

5.我们还是从 Helloword开始吧。。。 我们选择New project,然后出现的界面就是这样的。。
<a href="http://www.krislq.com/wp-content/uploads/2013/05/newProject1.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/newProject1.png" alt="newProject1" width="800" height="640" class="alignnone size-full wp-image-741" /></a>

里面和eclipse创建项目差不多，输入项目名，选择编译环境，然后<strong>亮点就是可以选择theme了</strong>。。还是挺不错的。并且把is library也提出来了，蛮方便的

6.再下一步还是有eclipse上面的创建项目中选择图标一样一样的。。
<a href="http://www.krislq.com/wp-content/uploads/2013/05/newProjectIcon.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/newProjectIcon.png" alt="newProjectIcon" width="800" height="640" class="alignnone size-full wp-image-743" /></a>

7.又是选择一个activity模板 ，eclipse和面也有。哎。这里我就一直跳过了。大家直接看图吧
<a href="http://www.krislq.com/wp-content/uploads/2013/05/newProjectActivity.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/newProjectActivity.png" alt="newProjectActivity" width="800" height="640" class="alignnone size-full wp-image-742" /></a>
<a href="http://www.krislq.com/wp-content/uploads/2013/05/enterActivityName.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/enterActivityName.png" alt="enterActivityName" width="800" height="640" class="alignnone size-full wp-image-740" /></a>

8. 点击 finish按钮后，等好久（我都以为卡死了），然后再出来了一个创建新项目的进度条。
第一次有点慢。。。会下载一些gradle的东东。这边这一步耗时大概在30分钟左右，所以大家如果网速不好的，多等等。

<a href="http://www.krislq.com/wp-content/uploads/2013/05/newProjectProgress.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/newProjectProgress.png" alt="newProjectProgress" width="482" height="92" class="alignnone size-full wp-image-744" /></a>

9. 第8步配置好gradle后就进行具体的Studio页面了。。我把 HelloWorld项目展开，然后里面大体的一些模块，就点击看大图吧，也就是eclipse上面有的一些功能 ，只是修改了一下名字而以。并且把一些常用的，便捷的提取出来了。并且精简了一些不常用到的。我是非常满意的：
<a href="http://www.krislq.com/wp-content/uploads/2013/05/studioWorkspace2.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/studioWorkspace2.png" alt="studioWorkspace2" width="1900" height="1040" class="alignnone size-full wp-image-748" /></a>

10.安装后，我一般我就会先去找找设置在哪里，设置个行号啊什么。。看了一下大体的菜单选项，和eclipse还是蛮像的。但是一些菜单位置是变化了的。
    设置的位置 ： File->Settings
         设置里面的布局又是和eclipse非常相似，不过精简是许多。

    a. 显示行号： File->settings->Editor - >Appearance
<a href="http://www.krislq.com/wp-content/uploads/2013/05/settingsLineNumber.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/settingsLineNumber.png" alt="settingsLineNumber" width="1240" height="862" class="alignnone size-full wp-image-746" /></a>
    如果需要显示空格 ，则可以把line Number下面的show WhiteSpace勾上
      b.修改大小：File->Settings->Editor->Color & Font ->Font . 
             需要先将系统 内置的另存一份，要不是不能修改字体大小的。点击 Save as 保存成自定义的名字。然后size就可以修改了，你可以修改成自定义大小。如果需要修改字体样式 ，需要先从 Available fonts中双击加到右边的select Fonts里面，然后最右边的上下按钮，调整位置 。再点击规划方的OK 或者是apply进行 保存
<a href="http://www.krislq.com/wp-content/uploads/2013/05/settingsFont.png"><img src="http://www.krislq.com/wp-content/uploads/2013/05/settingsFont.png" alt="settingsFont" width="1240" height="862" class="alignnone size-full wp-image-745" /></a>

基本使用就到这里了，工作区还是和eclipse有一些的变化 ，大家应该都还是蛮快就能适应过来的。
而这次Android Studio的最大 亮点其实是 在分辨率与预览效果这一块，到时候再专门开一个帖子来讲解吧。
今天就先写珐这里。

其它相关的文章 ：
<a href=" http://wiki.eoe.cn/page/Android_Studio_In_Mac">在mac下下载安装并体验Android Studio</a>

<a href="http://www.eoeandroid.com/thread-275408-1-1.html"> 最新android studio注意事项打不开等问题6种解决方法及</a>

更新速度好快，Android Studio视频已出，不围观不行啊：
<a href="http://v.youku.com/v_show/id_XNTU3NDY3OTAw.html">Android Studio介绍</a> (就是广告多了点，既然不能反抗，那就享受吧。哎。纯英文，练听力的哦。)
