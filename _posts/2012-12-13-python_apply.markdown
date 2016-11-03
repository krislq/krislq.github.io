---
title:	"python apply 用法"
date:	2012-12-13 15:59:37.0
categories:	[开发,Python]
tags:	[python,函数,参数]
---

最近做autotest内容，需要用到python ,以后对python进行了一些简单的学习。发现python也是一门很好玩的语言，特别是他里面的一些使用技巧。

今天主要是了解了一下apply函数的用法。

以下内容转自：http://www.cnpythoner.com/post/90.html

&nbsp;

apply(func [, args [, kwargs ]]) 函数用于当函数参数已经存在于一个元组或字典中时，间接地调用函数。args是一个包含将要提供给函数的按位置传递的参数的元组。如果省略了args，任何参数都不会被传递，kwargs是一个包含关键字参数的字典。

&nbsp; &nbsp; &nbsp; apply()的返回值就是func()的返回值，apply()的元祖参数是有序的，元素的顺序必须和func()形式参数的顺序一致。
<!--more-->
下面给几个例子来详细的说下:

&nbsp; &nbsp; &nbsp; 1、假设是执行没有带参数的方法
<pre lang='python'>
def say():
print 'say in'
apply(say)
</pre>
&nbsp; &nbsp; &nbsp; 输出的结果是'say in'


&nbsp; &nbsp; &nbsp; 2、函数只带元组的参数。
<pre lang='python'>
def say(a, b):
print a, b
apply(say,("hello", "老王python"))
</pre>

&nbsp; &nbsp; &nbsp; 3、函数带关键字参数。
<pre lang='python'>
def say(a=1,b=2):
print a,b

def haha(**kw):
# say(kw)
apply(say,(),kw)

print haha(a='a',b='b')
</pre>
&nbsp; &nbsp; &nbsp; 输出的结果是:a,b

&nbsp; &nbsp; &nbsp; 对于有些朋友来说第3个函数带关键字的操作稍微比较难理解一点，其他的应该还比较简单，如果你觉的第3个比较难的话，可以自己多写点代码练习下
