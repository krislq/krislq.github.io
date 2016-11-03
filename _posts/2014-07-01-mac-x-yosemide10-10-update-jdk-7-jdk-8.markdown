---
title:	"mac x Yosemide（10.10） 下安装 jdk 1.7 (jdk 1.8)"
date:	2014-07-01 01:14:14.0
categories:	[Java,Android,解决方案]
tags:	[null]
---

<a href="http://www.krislq.com/wp-content/uploads/2014/07/10.10_jdk_1.8.png"><img src="http://www.krislq.com/wp-content/uploads/2014/07/10.10_jdk_1.8.png" alt="10.10_jdk_1.8" width="840" height="302" class="alignnone size-full wp-image-917" /></a>

在mac x yosemide 系统中不能正常更新jdk到1。7（1.8）的问题，会弹出上面的错误 提示。很多人就在这里会选择放弃他的jdk升级之旅，或者是还原他的mac系统 。其实没那么复杂。来看看我是怎么解决的吧！！
<!--more-->


<strong>大背景:</strong>
 最近两个月是it界的各种发布会，从锤子手机到苹果开发者大会，再到google io .惊喜不断，对于我们这些it男来说也是折腾不断啊。。
 
自从apple开发者大会后，就果断把自己的的pro升级到了最新的Yosemide，4s 升级到了ios8 .pro还好，虽然mac下各种原生应用各种crash ,但是最基本的第三方交流，工作软件还能正常运行也就一直坚持当着Yosemide的小白鼠。但是4s就不行了，卡到连正常的手机需求都满足不了，转而投向了nexus 5的怀抱。这也使得我一次也没体现到过传说中的电脑  ,手机，平板多平台无缝衔接的好处。

nexus 5也不好过。随着google io发布的android l preview版本，nexus 5也火速升级到了最新版本。效果真是屌炸天了。但是跑了不到一天，发现原生应用跑得好好的，但是第三方关于切身利益的微信，支付宝，微博没办法正常运行。这让人受不了，果断又还原成了android 4.4.4。只能再坐等android下各种第三方应用升级。。


<strong>高潮：</strong>
android L的发布，也就伴随着android sdk的更新。本着新sdk，新气象的原则 ，果断把android sdk , eclipse也同步到最新版本。
<strong>不试不知道，一试吓一跳。</strong>

先是adt不翻墙不能更新的问题，也以着实让我们这些已经习惯了在体制内的生活小it青年为难了一把。好不容易整到个vpn ,更新了adt ,以为春天来了。
一打开eclipse，尽然说最新eclipse luna已经不再支持jdk 1.6(虽然 升级到了max 10.10,Yosemide.但是jdk还是老的)，需要得jdk 7以上了。
忍着巨大的蛋疼，把jdk 8下好后，又是当关一大棒，最新的jdk 8尽然只支持10.7.3以上的系统 版本，而我的10.10不支持！！！！这是何种高等逻辑算法啊！！！真想一口盐汽水喷死他！！

<strong>注意：</strong>
在这种情况下，按常理，要么放弃更新jdk 1.7(jdk 1.8) ,还原eclipse ,那么也随着也必需还原android sdk. 因为最新的android sdk需要最新的adt 23的支持。而老的以前基于jdk 6 eclipse是不支持更新到adt 23的。(这个有待考证，凡正我在以前的eclipse中去检查 adt更新，没有更新成功)

还有种办法就是还原mac系统版本。这样就可以把jdk更新到jdk 1.7(1.8),也就可以继续使用最新的eclipse了。

在百度中各种摸爬滚打，没有找到问题解决办法后，又本着外事不决问google的理念，秒登VPN,求解于千里之外。

hey ！果然有大神已经把这些问题解决鸟。

ok ,回过头来，我们再总结下最终遇到的问题。其实很简单，就是在最新的mac x Yosemide 中不能正常更新到jdk 1.7(1.8)的问题。

<strong>下面为解决办法：</strong>

1.下载 好jdk 1.7(1.8) 地址：http://www.oracle.com/technetwork/java/javase/downloads/index.html

2.打开下载 好的jdk 安装包的DMG .这时候你会在finder在左侧能看到已经被挂上了。

3.运行：
pkgutil --expand /Volumes/JDK\ 8\ Update\ 05/JDK\ 8\ Update\ 05.pkg  /tmp/jdk8.unpkg

解释： 通过pkgutil 命令把刚刚下载好的dmg解压开来，存放到/tmp/jdk8.unpkg这个目录中去。

4. 走入到/tmp/jdk8.unpkg目录中去。你可以通过finder也可以通过终端命令进入。

5. 找到目录下的 Distribution 文件，用vim 或者是编辑器打开。
6. 找到里面的 pm_install_check 这个函数。
<pre lan="java">
function pm_install_check() {
  if(!(checkForMacOSX('10.7.3') == true)) {
    my.result.title = 'OS X Lion required';
    my.result.message = 'This Installer is supported only on OS X 10.7.3 or Later.';
    my.result.type = 'Fatal';
    return false;
  }
  return true;
}
</pre>


你会发现，他在这里去判断 你的系统是不是10.7.3以后的，因为现在Yosemide还不是正式版本，所以在这里会检查不过。

修改成：
<pre lan="java">
function pm_install_check() {
  return true;
}
</pre>
保存。
7.然后我们重新打包。命令如下：
pkgutil --flatten /tmp/jdk8.unpkg/ /tmp/jdk8.pkg

8. 打开 /tmp/jdk8.pkg文件。
open /tmp/jdk8.pkg或者是从finder中找到并点击打开，你就会发现可以正常安装了。


然后就心情享受吧！！！

<strong>总结 ：在mac中，其它pkg ,app这些后缀都是一种打包方式。我们在遇到一些简单的问题时，可以通过解压里面的内容来达到一些简单的个性的目的。</strong>

refer:http://gabrielrinaldi.me/how-to-install-jdk-7-on-yosemite-10-10/
