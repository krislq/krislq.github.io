---
title:	"Android实现无埋点收集所有屏幕事件"
date:	2016-11-08 18:08:08.0
categories:	[Android,开发]
tags:	[ActivityLifecycleCallbacks,Anroid,GrowingIO]
---
![collect all the data](http://www.krislq.com/wp-content/uploads/2016/11/how_to_listening_all_click_collect_all_data.jpg "collect all the data")

先给大家看一篇神策创始人[桑文锋](https://www.zhihu.com/people/sang-wen-feng) 的文章:[在数据采集上的痛苦、幻想与失望](https://zhuanlan.zhihu.com/p/21628977)。然后再看看知乎上面一篇关于[GrowingIO 如何做到不必埋点即可采集到齐全的用户行为点击流数据?](https://www.zhihu.com/question/38000812)，文章中只是讨论了埋点的一些问题，但是对于其中的技术实现也没有提及。在网上搜索下了，也没有搜索到相关的技术文章。


那到底这种无埋点技术是怎么实现的呢？

<!--more-->

对于一些行业背景及相关知识还不太清楚的先自行了解。比如：无埋点收集数据，growingIO,神策，Heap Analytics。

接下来讨论的技术实现方案主要是基于0.9.85以前的Android实现（以下简称老版）。之后的版本他们是利用了Gradle plugin 来实现的，优化了核心的监听技术，功能也更加强大，以后的文章会进一步进行研究。

 首先我们来分析下老版功能实现的一些关键点：

* 要能截取到页面所有的touch事件,并且对原的View的touch事件不受影响。
* 要能获取到页面所有的View及位置才能知道用户点击的是哪个View
* 每个Activity,Frgment,PopWindows的生命周期及页面布局变化。

注：这里我们只关注实现核心技术细节，本身GrowingIO的其它配套功能：收集格式，上传，截图等功能不在此文讨论之列。

本方案对以上关键点的思考与解决方法：

* 拿到每个activity的生命周期是通过注册ActivityLifecycleCallbacks来获取到每个activity生命周期的回调。自己的项目也可以写在自己的baseActivity里面，但是这样很难独立成模块，始终会与自己的项目有一定的耦合度。
* 拿到一每个activity之后，就可以拿到activity的decorView ,从而遍历出页面的布局树和位置。
* 截取页面每个touch事件，最开始想法是往devorView中添加一个覆盖全屏幕的蒙层，这样可以对原页面的影响最小，但是发现蒙层中只能获取到每一系列touch的DOWN事件（详见：[Android 触摸事件机制](http://wangkuiwu.github.io/2015/01/01/TouchEvent-Introduce/)）。这样对一些用户的复杂操作辨识度会较低。 比如：点击按钮但是未松开手时再移出按钮，对屏幕的滚动，多点等等。并且这种方式对于动态布局中的元素变更也很难及时追踪。所以最后对比了下GrowingIO的集成前后布局对比，发现GrowingIO是在decorView下嵌入了一个自定义的ViewGroup，这样可以拿到所有touch事件的分发。这样就可以完成对一些复杂touch的判断。从而解决了截取所有touch事件的目标，但是这样引起的其它一些小问题： 比如用户设置的聚焦的控件状态保留？ 初始化动画的状态保留？ 


下面为两个布局的对比，可以看到CoverFrameLayout介于DecorView和LinearLayout之中。
原始布局：
![OriginLayout](http://www.krislq.com/wp-content/uploads/2016/11/how_to_listening_all_click_origin_layout.png "OriginLayout")


添加了监听Touch事件的布局：
![AfterLayout](http://www.krislq.com/wp-content/uploads/2016/11/how_to_listening_all_click_after_layout.png "AfterLayout")
 
具体的代码细节，大家可以去我的github([krislq](https://github.com/krislq))下载查看，里面的注释也比较详细（包括了项目化的一些注意事项及思路）。

项目地址：[WithoutEmbedding](https://github.com/krislq/WithoutEmbedding)

