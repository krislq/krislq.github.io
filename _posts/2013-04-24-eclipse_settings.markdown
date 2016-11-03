---
title:	"eclipse常用的设置[持续更新]"
date:	2013-04-24 10:08:24.0
categories:	[开发,Android,学习课堂,解决方案]
tags:	[eclipse,Associations,code templates,formatter,默认编码]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/04/eclipse.jpg"><img class="size-full wp-image-718 aligncenter" alt="eclipse" src="http://www.krislq.com/wp-content/uploads/2013/04/eclipse.jpg" width="500" height="251" /></a>
<p style="padding-left: 30px;">相信很多人都在用eclipse做一些开发 ，从java到c/c++，到php...可以说在开发界eclipse就是一个万能箱，但是如何更好的利用这个利器，才是我们这些懒程序员们应该做的。
当然如果你是vi控，notepad控，你可以绕道了。^~^
本文主要是收集一些常用到的eclipse设置选项，可能是你需要的，也可能是你还没注意到的，但将来你一定会得上的。
<!--more--></p>
<strong>Eclipse设定文件的打开方式的设置方法</strong>
<p style="padding-left: 30px;">可能eclipse处带的文件打开方式并不是你想要的，比如说一个html文件是以内置的browser打开的，但是有时候我们为了想看html 的代码，那么怎么样才能让我们直接双击就可以打开呢？</p>
<p style="padding-left: 30px;">Window -&gt; Preferences -&gt; General -&gt; Editors -&gt; File Associations</p>
<strong>设置workspace的默认编码格式</strong>
<p style="padding-left: 30px;">现在很多公司或者是团队都要求我们使用统一的编码格式，如果我们每新建一个项目都重新设置一下编码，那可不是我们懒 人程序员的作风。如果我们把整个工作目录都设置成统一的编码就很棒了！</p>
<p style="padding-left: 30px;">Windows-&gt;Preference-&gt;General-&gt;WorkSpace-&gt;text file encoding-&gt;修改成你所需要的编辑格式</p>
<strong>设置项目编码格式</strong>
<p style="padding-left: 30px;">选中eclipse中的项目-&gt;properties-&gt;resource-&gt;test file encoding -&gt;选择你所需要的编码</p>
<strong>设置某种类型文件的默认编码格式</strong>
<p style="padding-left: 30px;">有时候特定的文件需要一些特定的编码才能正常的打开，或者我们单独打开某个文件的时候。</p>
<p style="padding-left: 30px;">Windows-&gt;Preference-&gt;General-&gt;Content Types-&gt;找到文件的类型-&gt; 在下面的Default Encoding中输入你的编码格式</p>
<strong>java compiler统一为jdk 1.6</strong>
<p style="padding-left: 30px;">选中eclipse中的项目-&gt;properties-&gt;Java compiler -&gt; 勾选enable project specific settings -&gt; compiler compliance level中选1.6</p>
<strong>文档中不能出现TAB,全部用4个空格代替</strong>
<p style="padding-left: 30px;">1.Windows-&gt;Preferences-&gt;General-&gt;Editors-&gt;test Editors-&gt;displayed tab width 输入4 然后并在下面一行中勾选Insert spaces for tab</p>
<p style="padding-left: 60px;">(<strong>这还不够</strong>,这只是在eclipse自己生成tab的时候会指导tab变成space , 但是人为的按下tab来进行缩进的时候,还是会有tab字符的.)至于如果让tab,space可见,请看下面的备注2</p>
<p style="padding-left: 30px;">2.Windows-&gt;Preferences-&gt;java-&gt;code style-&gt;formatter-&gt;在active profile里面导入你的formatter文件，下面是我们Motelap团队使用的模板：</p>
<p style="padding-left: 60px;"><a href="http://www.krislq.com/wp-content/uploads/2013/04/eclipse_morelap.zip">eclipse_morelap</a>[<a href="http://www.krislq.com/wp-content/uploads/2013/04/eclipse_morelap.zip">点击下载</a>]  感谢<strong>@mark</strong>为我们提供</p>
<p style="padding-left: 60px;">也可以选择不用导入,则也是进入到formatter中,任意选一个active profile,-&gt;点击 edit-&gt;Indentation-&gt;tab policy 中选择 spaces only.并且确保下面indentation size=4 &amp; tab size=4</p>
<strong>导入统一的code templates样式</strong>
<p style="padding-left: 30px;">设置步骤:Windows-&gt;Preferences-&gt;java-&gt;code style-&gt;code templates-&gt;选择import导入你的code templates文件，下面是我们Morelap团队使用的模板：</p>
<p style="padding-left: 60px;"><a href="http://www.krislq.com/wp-content/uploads/2013/04/codetemplates.zip">codetemplates</a>[<a href="http://www.krislq.com/wp-content/uploads/2013/04/codetemplates.zip">点击下载</a>]   感谢<strong>@mark</strong>为我们提供</p>
<p style="padding-left: 60px;">然后:选择comments-&gt;files,然后选择edit , 将@author修改成自己的名字与邮箱地址
最后:选择comments-&gt;types,然后选择edit , 将@author修改成自己的名字与邮箱地址</p>
