---
title:	"Mac Shell配色方案"
date:	2013-06-22 23:36:51.0
categories:	[解决方案]
tags:	[git,mac,vim,配色]
---

mac shell中默认是没有配色方案的，如果你不想一直对着黑白的，或者是单调的命令行，那么就来看看我这收集的一些命令的配色方案吧。。。

本文收集了，git和vim的配色解决办法 ，欢迎拍砖！
<!--more-->

1. vim的配色

#cd ~
#vim .vimrc

<pre lang="java">
#打开语法高亮
syntax on
#打开文件类型检测功能
filetype on
#为不同类型的文件定义不同的缩进格式
filetype indent on
#设想这样一个情况： 当前光标前面有若干字母， 按下 i 键进入了 Insert模式， 然后输入了 3 个字母， 再按 5 下删除(Backspace)。 默认情况下，VIM 仅能删除新输入的 3 个字母， 然后喇叭“嘟嘟”响两声。 如果“set backspace=start”， 则可以在删除了新输入的 3 个字母之后， 继续向前删除原有的两个字符。再设想一个情况： 有若干行文字， 把光标移到中间某一行的行首， 按 i 键进入 Insert 模式， 然后按一下 Backspace。 默认情况下， 喇叭会“嘟”一声，然后没有任何动静。 如果“set backspace=eol”， 则可以删除前一行行末的回车，也就是说将两行拼接起来。当设置了自动缩进后， 如果前一行缩进了一定距离， 按下回车后， 下一行也会保持相同的缩进。默认情况下， 不能在 Insert 模式下直接按 Backspace 删除行首的缩进。如果“set backspace=indent”， 则可以开启这一项功能。上述三项功能， 可以选择其中一种或几种， 用逗号分隔各个选项。
set backspace=indent,eol,start
#设定 tab 的位置
set tabstop=4
#输入 tab 时自动将其转化为空格
set expandtab
#设定颜色方案,murphy指的是 /usr/share/vim/vim73/colors 下面的本色方案
colorscheme murphy
</pre>
refer to :<a href="http://www.cnblogs.com/panliang188/archive/2010/04/20/1715836.html">Vim Tab使用技巧</a>   &&  <a href="http://hi.baidu.com/storymedia/item/90ef0209417772036d90487a">vim配置文件.vimrc</a>

2. git config文件
refer to :<a href="http://blog.csdn.net/yf210yf/article/details/9004777">git配色问题</a>
<pre lang="java">
+默认情况下，ubuntu下的终端中，git没有颜色,可以使用如下命令给git配色
+ $ git config --global color.status auto 
+ $ git config --global color.diff auto 
+ $ git config --global color.branch auto 
+ $ git config --global color.interactive auto
</pre>

More :<a href="http://blog.csdn.net/shuhuai007/article/details/7276195">git config配置文件</a>
