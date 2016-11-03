---
title:	"【Android课堂】用powershell+Ant实现Andoird为不合市场编译、签名自动化"
date:	2012-12-30 23:12:30.0
categories:	[工具,开发,Android,学习课堂]
tags:	[打包,市场,Android,powershell,ant,签名,google play,编译]
---

<img class="size-full wp-image-554 aligncenter" alt="powershell_ant" src="http://www.krislq.com/wp-content/uploads/2012/12/powershell_ant.png" width="700" height="200" />

通过本文我们可能通过使用powershell+ant来实现为不同市场编译、签名，从而实现自动化，节约我们的时间。

1. 如果给自己的android工程加上ant配置文件。

2.如果通过 powershell打包

<!--more-->

<strong>为什么我们要这样？</strong>
<p style="padding-left: 30px;">许多人问，<strong>eclipse不是自带的打包工具吗？还费力写这个脚本来干嘛？而且ant都还没搞懂，那么powershell又是干嘛的？</strong></p>
<p style="padding-left: 30px;"><strong>如果你真想这样问，那我觉得你肯定不是合格的天朝的子民。</strong></p>
<p style="padding-left: 30px;">如果我们自己开发过自己的应用，或者在公司做过打包的工作，那么你一定很惊讶天朝如满天星星般的安卓市场！！甚至一现在，也还是有十多家在顽强的挣扎着。</p>
<p style="padding-left: 30px;">有人又总问了，再多的市场，我们一个包不是也是行吗？</p>
<p style="padding-left: 60px;">行是行的，但是<strong>你知道谁下载了你的应用吗？哪个市场多吗？应该在哪个市场去多做宣传呢？</strong></p>
<p style="padding-left: 60px;">如果你想知道，那么你最好还是给每个市场都打个不同的包，然后查看统计结果 ，下次针对特定的市场做一些特定的推广吧。</p>
&nbsp;

我们再来试想一下，如果我们还是用eclipse的打包工具，一个一个打包，打包完了后再修改一下渠道值 ，再打包。你觉得你有必需把你宝贵的生命浪费在这无聊的打包上面吗？？？？？！！！

<strong>如果你不想，follow me .</strong>

===================
<p style="padding-left: 30px;">在开始前的一些说明：接下来的代码是基于eoe在线课堂上面的代码而来，在兴趣的可以去听听，由eoe的wanx给我们带来的：<a href="http://edu.eoe.cn/course/view/cid/24.html">Powershell(脚本)+Ant(编译)实现一键打包</a></p>
<p style="padding-left: 30px;">如果我没有猜错的话，wanx也是借鉴网上这篇文章 ：<a href="http://www.cnblogs.com/zhubo/archive/2011/11/23/using_powershell_to_automate_building_for_different_channels.html">用powershell脚本实现Andoird为不同市场编译、签名自动化，效率极大提高</a></p>
<p style="padding-left: 30px;">如果你现在百度里面搜索 powershell打包，大半都是牛博的这篇文件。这也是中国互联网的一个通病，一个人原创点东西出来，然后大家就随处帖，而且还不把原文地址附件上。</p>
<p style="padding-left: 30px;">当然，我在这里指责也是给自己打耳光，因为我也是将在下面窃取他的劳动成果。</p>
===================

开始吧！！

&nbsp;
<h2>实现思路</h2>
<ol>
	<li>用PowerShell实现一个方法：使用ant自动编译项目，在每次编译之前，修改 AndroidManifest.xml 中meta-data UMENG_CHANNEL 的值为指定市场的标识。</li>
	<li>用字符串数组存储所有市场的标识，遍历该数组，遍历至每个元素时，都将该元素传入上面的方法，可实现针对不同的市场进行编译，编译完成后，再对编译好的应用签名即可。</li>
</ol>
<h2>系统环境</h2>
<ul>
	<li>Windows 7 Untimate</li>
	<li><a href="http://www.oracle.com/technetwork/java/javase/downloads/jdk-7u1-download-513651.html" target="_blank">JDK 7 Update1</a>，假设路径为： E:\Program Files\Java\jdk1.7.0_01</li>
	<li><a href="http://labs.renren.com/apache-mirror//ant/binaries/apache-ant-1.8.2-bin.zip" target="_blank">apache-ant-1.8.2</a>，假设路径为：E:\Program Files\apache-ant-1.8.2</li>
	<li><a href="http://dl.google.com/android/android-sdk_r15-windows.zip" target="_blank">Android SDK</a>，假设路径为：E:\Program Files\Android\android-sdk</li>
</ul>
<h2>用ant自动编译项目</h2>
<ul>
	<li>假设Android项目路径为：D:\workspace\MyApp</li>
	<li>检查是否存在文件D:\workspace\MyApp\build.xml，这是使用ant编译项目时需要用到的配置文件
<ul>
	<li>若<strong>不存在</strong>，在command窗口中执行：
<ul>
	<li>D:    #切换到d盘，你的项目在哪个盘就切换过去。如果这个都不理解的，自行百度</li>
</ul>
<ul>
	<li>CD D:\workspace\MyApp    #切换到我们的项目目录</li>
	<li>"E:\Program Files\Android\android-sdk\tools\android" update project --path .  #为我们的项目添加上build.xml配置文件。注意path后有个点，表示当前目录</li>
</ul>
</li>
	<li>若存在或通过上面的步骤生成了build.xml，修改文件中&lt;project name="MyApp" default="help"&gt; MyApp为自己项目的名称（项目名称如何改，参见文末的更新）。如果你是通过android update命令来生成的，你多半是需要修改你的project name的，我测试的时候，它里是我的第一个activity的名字，而我们需要修改成我们project的名字。</li>
</ul>
</li>
	<li>新建批处理文件D:\workspace\MyApp\build.bat，该文件使用ant对android项目自动编译，文件内容如下：（请根据自己项目、系统的实际情况修改路径）</li>
<pre lang="xml">
SET JAVA_HOME=C:\Program Files\Java\jdk1.7.0_05
D:
cd D:\Developer\eoe\HistoryOfToday
"D:\apache-ant-1.8.4\bin\ant" release
</pre>
</ul>
&nbsp;
<p style="padding-left: 30px;">如果系统环境没问题，build.bat执行后，在目录 D:\workspace\MyApp\bin 中应该可以看到编译好的MyApp-release-unsigned.apk。</p>
<p style="padding-left: 30px;">注意：如果项目中有引用的第三方jar包类库，要把这些类库放到项目根目录的 "libs" 目录下，否则，ant在编译的时候会出错。</p>

<h2>流程详解</h2>
<h3>1、定义参数</h3>
<pre lang="xml">
param($ProjectName, $ProjectRootDirectory, $KeystorePath, $StorePass, $KeyPass, $Alias)

$channels = @("360", "aimi8", "anzhi", "appchina", "eoemarket", "gfan", "hiapk", "nduoa", "starandroid")
$defaultChannel = "androidmarket"
$jdkPath = "E:\Program Files\Java\jdk1.7.0_01"
$androidSDKPath = "E:\Program Files\Android\android-sdk"
$signedPath = "$ProjectRootDirectory\bin\signed"
$zipalignedPath = "$ProjectRootDirectory\bin\zipaligned"
</pre>
<ul>
	<li>$ProjectName：项目名称，如：MyApp</li>
	<li>$ProjectRootDirectory：项目路径，如：D:\workspace\MyApp</li>
	<li>$KeystorePath：keystore路径，如：D:\workspace\MyApp\keystore</li>
	<li>$StorePass：store password，如：123456</li>
	<li>$KeyPass: key password，如：123456</li>
	<li>$Alias: keystore alias，如：MyApp</li>
	<li>$channels：定义了除AndroidManifest.xml中定义的默认市场标识外，剩下的所有市场标识</li>
	<li>$defaultChannel：即上面提到的默认市场标识，为什么要有默认市场标识的原因是，我们的AndroidManifest.xml文件不会常改，我们也不希望每次自动编译、签名完毕后，看到这个文件处于被修改的状态，所以我设计在最后才给默认的市场编译，这样的话，前面修改了n次的AndroidManifest.xml在最后回到未修改的状态</li>
	<li>$signedPath：即签好名的apk文件存储路径</li>
	<li>$zipalignedPath：即zipalign优化后文件存储路径，最后要发布的也是这个目录下的apk文件</li>
</ul>
<h3>2、修改 AndroidManifest.xml</h3>
<pre lang="xml">
    $manifestPath = "$ProjectRootDirectory\AndroidManifest.xml"
    $FILE = [System.IO.File]::ReadAllText($manifestPath)
    $FILE = [REGEX]::replace($FILE, '<meta-data\r?\n?\s+android:name="UMENG_CHANNEL"\r?\n?\s+(.*?)>', '<meta-data
            android:name="UMENG_CHANNEL"
            android:value="' + $ChannelName + '" />', [Text.regularexpressions.regexoptions]::SingleLine)
    [System.IO.File]::WriteAllText($manifestPath, $FILE) 
</pre>

$ChannelName 代表每次遍历传入的市场标识，如：anzhi

注意：在这里需要确保我们的渠道那一行是这样的：&lt;meta-data android:name="UMENG_CHANNEL" android:value="others" /&gt;

否则在配置的时候会匹配不上，那么就修改不成，就有问题了。如果非要与我这个不同，你也可以自己写这个正则匹配。

别问我正则匹配的东西，自行百度，否则我再写篇文章也给你讲不清楚 。
<h3>3、调用 build.bat 编译 项目</h3>
<pre lang="xml">
& "$ProjectRootDirectory\build"
</pre>
<h3>4、为编译好的应用签名</h3>
<pre lang="xml">
& "$jdkPath\bin\jarsigner" -keystore $KeystorePath -storepass $StorePass -keypass $KeyPass -signedjar "$signedPath\$ProjectName-$ChannelName.apk" -verbose "$ProjectRootDirectory\bin\$ProjectName-release-unsigned.apk" $Alias -digestalg SHA1 -sigalg MD5withRSA
</pre>
<ul>
	<li>注意最后2个参数：-digestalg SHA1 -sigalg MD5withRSA，如果你当前的环境是 JDK 7，一定要加上这两个参数，否则签名完毕的应用在安装时会有错误：Failure [INSTALL_PARSE_FAILED_NO_CERTIFICATES] <sup>[1]</sup></li>
	<li>签好名的应用在 $signedPath 定义的路径中</li>
</ul>
<h3>5、zipalign优化签好名的apk</h3>
<pre lang="xml">
    if (Test-Path -path "$zipalignedPath\$ProjectName-$ChannelName.apk") {
    	Remove-Item "$zipalignedPath\$ProjectName-$ChannelName.apk"
    }
    
    & "$androidSDKPath\tools\zipalign" -v 4 "$signedPath\$ProjectName-$ChannelName.apk" "$zipalignedPath\$ProjectName-$ChannelName.apk"
</pre>
<h3>6、批处理调用powershell脚本，实现自动化编译、签名</h3>
<p style="padding-left: 30px;">假设powershell脚本存储于：D:\workspace\build4DifferentChannels.ps1，新建批处理脚本：D:\workspace\build4DifferentChannels_MyApp.bat：</p>
<pre lang="xml">
powershell D:\workspace\build4DifferentChannels.ps1 MyApp "D:\workspace\MyApp" "D:\workspace\MyApp\keystore" 123456 123456 myapp
</pre>
用批处理调用powershell脚本build4DifferentChannels.ps1，并传入了之前定义的各个参数。以后需要发布应用时，就执行该批处理，自动为各个市场编译、签名应用即可，十分方便。
<p style="padding-left: 30px;">如果执行改脚本遇到错误：</p>
<pre lang="xml">
 File D:\workspace\build4DifferentChannels.ps1 cannot be loaded because the execution of scripts is disabled on this system.</p>
</pre>
<p style="padding-left: 30px;">就用管理员权限打开command窗口，执行下面的命令：</p>
<pre lang="xml">
powershell
Set-ExecutionPolicy RemoteSigned 
</pre>
<br/>
<h2>完整脚本下载</h2>
=============================
点击下载：
<a href="http://www.krislq.com/wp-content/uploads/2012/12/build4DifferentChannels_20111209.zip">build4DifferentChannels_20111209</a>
=============================
