---
title:	"关于python下面中文的问题"
date:	2012-12-11 22:38:08.0
categories:	[开发,Python]
tags:	[python,ASCII,GBK,unicode,中文]
---

<img class="alignnone size-full wp-image-444" title="python" src="http://www.krislq.com/wp-content/uploads/2012/12/python.jpg" alt="" width="300" height="187" />
<h2><strong>1. &nbsp; &nbsp;我需要在py文件中使用一个中文，打印一个中文，甚至于我们的注释为中文。</strong></h2>
比如说，有一行语句如下：
<pre lang="python">print '中文'</pre>
如果我们执行py文件，会抛出下面的异常：
<pre lang="python">
SyntaxError: Non-ASCII character '\xd6' in file python_coding.py on line 3, but no encoding declared; see http://www.python.org/peps/pep-0263.html for details</pre>
这是因为我们py文件默认的编码为ASCII编码，中文在显示时会做一个ASCII到系统默认编码的转换。所以会抛出上面的异常。
<!--more-->
&nbsp;

<strong>解决办法：</strong>

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 设置#coding=gbk或者是#coding=utf-8，这样就可以直接在文件中写：print "中文"了或者注释写成中文了

<span style="color: #ff0000;"><strong>注意：</strong></span>如果我们需要把中文转化成unicode码的话。有两种形式

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; a. &nbsp;u"中文"

&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; b. &nbsp;unicode('中文','gbk')

如果我们使用的是#coding=utf-8，则你可以使用b,没有错误 ，能正常输出 ;如果你使用的是a，则会异常：
<pre lang="python">
SyntaxError: (unicode error) 'utf8' codec can't decode byte 0xd6 in position 0:invalid continuation byte</pre>
但是如果使用unicode('中文','utf-8')又是错误的。也会抛出上成的异常。

&nbsp; &nbsp; &nbsp; &nbsp;我<strong>的理解如下：</strong>如果我们#coding=gbk,那么我们py文件里面的所有的编码都是为gbk ,通过u"中文"的时候，相当于是unicode('中文','gbk')。

&nbsp; &nbsp; &nbsp; &nbsp;当我们使用#coding=utf-8的时候，u"中文"的时候，相当于是unicode('中文','utf-8')。它就无法解码了。
<h3>2.解决Python2.7的UnicodeEncodeError: ‘ascii’ codec can’t encode异常错误</h3>
在做python通信的时候，又遇到一个问题，就是当我在传输一些中文的时候，我们先转化成了是unicode编码，然后再传给socket去发送，但是问题来了，尽然抛出了异常：
<pre lang="python">
UnicodeEncodeError: 'ascii' codec can't encode characters in position 29-30: ordinal not in range(128)
</pre>
&nbsp; &nbsp; &nbsp; &nbsp;说的啥呢？ascii码不能编码某些字符。我们传过来的不就是unicode码嘛，有冲突了。

&nbsp; &nbsp; &nbsp; &nbsp;我们前面有说到，python默认编码是ascii码，对吧？如果不相信？可以通过下面的代码来测试：
<pre lang="python">
import sys
print sys.getdefaultencoding()
# 'ascii'</pre>
即使我们加上#coding=gbk.运行的结果还是一样的。为什么呢？

&nbsp; &nbsp; &nbsp; &nbsp;<strong>我的理解为：</strong> coding=gbk只是指定当前py文件编码为gbk , 但是python系统内部使用的编码还是ascii啊，那么怎么办呢？

&nbsp; &nbsp; &nbsp; &nbsp;我们可以通过 setdefaultencoding来解决问题。但是如果我们单独的设置一下，又会有下面的异常：
<pre lang="python">
Traceback (most recent call last):
File "python_coding.py", line 6, in <module>
	sys.setdefaultencoding("utf-8")
AttributeError: 'module' object has no attribute 'setdefaultencoding'</pre>
很奇怪 ？后来网上查了一下代码，说是需要把sys重新加载一下。
<pre lang="python">
import sys
...
reload(sys)
sys.setdefaultencoding('utf-8')</pre>
但是细心的人，会发现，我们在前面文件中转化成unicode码的时候，不是用的是gbk吗？那么这里为什么又要用utf-8呢？因为在这里用utf-8就与网络传输有关了。我试过了gbk ,在服务器端即使我再用gbk去转化一下，也是乱码。
