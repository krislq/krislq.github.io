---
title:	"Android的webview加载本地html、assert内html和网络URL"
date:	2013-04-11 10:37:35.0
categories:	[解决方案]
tags:	[webview,loadurl]
---

<pre lang="java">
//打开本包内asset目录下的test.html文件
wView.loadUrl(" file:///android_asset/test.html ");  
//打开本地sd卡内的kris.html文件
wView.loadUrl("content://com.android.htmlfileprovider/sdcard/kris.html");
//打开指定URL的html文件
wView.loadUrl("http://www.krislq.com/");
</pre>
