---
title:	"[解决方案]java.lang.NoClassDefFoundError: com.google.xxxx"
date:	2013-01-12 00:19:05.0
categories:	[开发,Android,解决方案]
tags:	[NoClassDefFoundError,黑莓,eclipse,jar,libs,报错]
---

最近听说黑莓有转应用的活动，100美刀一个应用，免不了小小心动一把，于是乎把前一些应用找了出来跑跑看看。准备去换点“酒钱”。

活动地址：<a href="http://blog.sina.com.cn/s/blog_6a64552f0101e4qx.html">黑莓的应用移植Portathon活动帮助大家顺利拿到100美金的注意事项</a>

&nbsp;

不运行不知道，一运行吓了一跳，尼玛！居然一运行就报错了。

错误类型：
<p style="padding-left: 30px;"><span style="color: #0000ff;">java.lang.NoClassDefFoundError: com.google.xxxx</span></p>
我左找右边，这个包我导入了啊，也确定已经关联起来了啊。可为嘛就是找不到问题所在呢？

<!--more-->

<strong>删除了重新导入 ，还是不行！</strong>

<strong>重启eclipse，还是不行！</strong>

<strong>重启了电脑 ，还是不行！</strong>

尼玛？与人品有关？当时就想骂娘了，不是以前都运行的挺好的吗？咋久了就与我生疏了？不应该啊。

&nbsp;

我左思右想，最后居然是因为我放jar包的文件名没对。<span style="color: #ff0000;">以前是lib ,现在得修改成libs.</span>

可能是由于以前eclipse中adt版本不是太高，编译时不是太严格，随着android的发展，adt编译时也越来越严格了。就像前两天我在用make命令编译apk文件时，报出的:<a title="链向 【解决方案】Error: This attribute must be localized. 的固定链接" href="http://www.krislq.com/2013/01/solution_error_the_attribute_must_be_localized/" rel="bookmark">Error: This attribute must be localized.</a>
