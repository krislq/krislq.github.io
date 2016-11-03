---
title:	"【解决方案】IOError: [Errno 32] Broken pipe"
date:	2013-02-21 17:47:37.0
categories:	[开发,Python,解决方案]
tags:	[Broken pipe]
---

最近在用到python写一些测试脚本，并放到手机中去跑跑。在eclipse上面，或者是显示在adb shell里面通过 python调用倒是没有问题。
可就是通过一个apk去调用的时候，跑啊跑的就跑出异常了。
<strong>异常如下：</strong>
<pre lang="xlm">
IOError: [Errno 32] Broken pipe
</pre>
找了好久，一点一点追踪。
<!--more-->
才到了问题所在：
<p style="padding-left: 60px;"><strong>原来是python里面的print引起的。</strong>
通过apk去调用这个python脚本的时候，找不到输出控制台了(Console).这样print的时候就没有可以输出的东西，最后跑会儿后，就“爆管”了。呵呵</p>
<p style="padding-left: 30px;"><strong>解决办法：</strong></p>

<ul>
	<li>1.不用print了，通过输入到文件替代、</li>
	<li>2.添加一个debug标识。不需要输出的时候，设置为False</li>
</ul>
