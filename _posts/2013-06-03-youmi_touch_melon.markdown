---
title:	"有米开发之顺藤摸瓜"
date:	2013-06-03 22:11:52.0
categories:	[随记,开发]
tags:	[有米,开发,广告,移动广告,嵌入]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/06/顺藤摸瓜.png"><img class="size-full wp-image-794 aligncenter" alt="顺藤摸瓜" src="http://www.krislq.com/wp-content/uploads/2013/06/顺藤摸瓜.png" width="640" height="300" /></a>
前一篇中我已经说了一下个人对广告这块的看法.其实不管做哪块的广告平台,对于添加广告到自己应用里面来说还是大同小异的.
今天第二篇中我们就一起来跟着走一遍,看看如果在自己的应用中添加广告吧

其实关于有米如果嵌入到我们的开发应该中去,在有米的官方已经有了非常详细的说明.大家可以去看看(<a href="http://wiki.youmi.net/Youmi_Banner_spot_AppOffers" target="_blank">http://wiki.youmi.net/Youmi_Banner_spot_AppOffers</a>)
虽然里面的内容很是详细 ,但是我觉得还是有些地方不是太清楚 ,新手去看的容易搞不清楚到底该怎么办?或者说加在自己项目的哪里更是合适 .
通过下面的介绍(<b>应该算是对有米帮助文档的一个适当的补充</b>)
<!--more-->
<b>1.新建你自己的项目,</b>开发你自己的应用,在这里以我的一个开源的项目[历史上的今天]来举例.
开源地址:
<p style="padding-left: 30px;">[gitcafe]<a href="https://gitcafe.com/kris/HistoryOfToday" target="_blank">https://gitcafe.com/kris/HistoryOfToday</a>
[github]<a href="https://github.com/kris1987/HistoryOfToday" target="_blank">https://github.com/kris1987/HistoryOfToday</a></p>
<b>你可以从HistoryOfToday中学习到的东西：</b>
<p style="padding-left: 30px;">1.可以了解到百度中关于历史上今天的<b>调用API</b>
2.本项目的组织结构，一个非常简单的，大部分应用都使用的构架
3.你可以学习到如何使用viewflow .
4.你可以无偿使用我里面的工具包，当然只是与本项目有关的工具包啦。我可不会把我所有的工具包都贡献出来，那我下次又拿什么吸引你们呢？
5.你甚至可以学习到如果给自己的应用加友盟的统计包。其实这东西看看友盟的文档，两分钟就要中以搞定的事情 。
6.你可以看到我博客的广告。如果有空，可以去帮我踩踩，这也算是打赏我花了几个晚上的心血吧。</p>
<p style="padding-left: 30px;"><b><span style="color: #ff0000;">需要注意的是：</span></b>本应用是开源的，而且是小得让你可能看不上眼的，说不定你一个小时就可以做十个出来。但是还是友情提示一下，<b><span style="color: #0000ff;">请不要用于商业</span></b>，因为这是我的汗水。</p>
<b>2.</b>应用开发完成后,那先要去有米上面注册一个有米帐号,并且<b>添加应用</b>
[添加应用图片]
<a href="http://www.krislq.com/wp-content/uploads/2013/06/添加应用2.png"><img class="size-full wp-image-799 aligncenter" alt="添加应用2" src="http://www.krislq.com/wp-content/uploads/2013/06/添加应用2.png" width="1031" height="1080" /></a>

添加好了应用后,有米会有一个审核的时候,切到应用列表中时,显示如下:
[应用列表 图片]
<div align="center"><a href="http://www.krislq.com/wp-content/uploads/2013/06/待审核.png"><img class="alignnone size-full wp-image-800" alt="待审核" src="http://www.krislq.com/wp-content/uploads/2013/06/待审核.png" width="880" height="163" /></a></div>
<div align="center"></div>
<div align="center"><a href="http://www.krislq.com/wp-content/uploads/2013/06/应用详细信息.png"><img class="alignnone size-full wp-image-804" alt="应用详细信息" src="http://www.krislq.com/wp-content/uploads/2013/06/应用详细信息.png" width="900" height="908" /></a></div>
然后就坐等有米的审核吧,不过,在有米审核的过程中,我们可以来添加有米的广告平台到我们自己的应用中了..

<b>3.下载有米的SDK.</b>下载地址： <a href="http://www.youmi.net/sdk/" target="_blank">http://www.youmi.net/sdk/</a>
[有米sdk解压目录图片]
<div align="center"><a href="http://www.krislq.com/wp-content/uploads/2013/06/有米sdk解压目录.png"><img class="alignnone size-full wp-image-801" alt="有米sdk解压目录" src="http://www.krislq.com/wp-content/uploads/2013/06/有米sdk解压目录.png" width="623" height="163" /></a></div>
其中
<p style="padding-left: 30px;"><b>demo</b>里面为有米提供的demo示例。
<b>doc </b>为html的帮助文档
<b>lib</b>是有米广告的库
<b>update.log</b>为更新的日志文件
<b>有米广告平台介绍与使用说明.pdf</b> 为服务条款与有米介绍</p>
<b>4.将libs 下面的YoumiSdk_vxxx_yyyy-mm-dd.jar 样的jar添加到自己的添加中去，并导入到我们的项目。</b>这个应该不难吧？
这一步我们就跳过了.如果你的项目无法生成 R文件或者是无法找到找三方的类,可以看看 <a href="http://www.eoeandroid.com/home.php?mod=space&amp;uid=475171" target="_blank">@futurexiong</a>  的博客 :
<a href="http://my.eoe.cn/futurexiong/archive/3831.html" target="_blank">解决Eclipse升级ADT22以后以及Android Studio由于依赖库问题无法直接运</a>
<a href="http://my.eoe.cn/futurexiong/archive/3831.html" target="_blank">http://my.eoe.cn/futurexiong/archive/3831.html</a>

<b>5.往AndroidManifest.xml中添加权限与有米广告平台需要使用到的界面 </b>
先是加入权限
<pre lang="xml">
//访问网络
<uses-permission android:name="android.permission.INTERNET"/> 
//读取手机状态 
<uses-permission android:name="android.permission.READ_PHONE_STATE"/>
<uses-permission android:name="android.permission.ACCESS_NETWORK_STATE" /> 
<uses-permission android:name="android.permission.ACCESS_WIFI_STATE"/>
//可写外部存储器
<uses-permission android:name="android.permission.WRITE_EXTERNAL_STORAGE"/>
 
<!--以下两个为可选权限-->
<uses-permission android:name="com.android.launcher.permission.INSTALL_SHORTCUT"/>
<uses-permission android:name="android.permission.ACCESS_COARSE_LOCATION"/>
</pre>

往application标签中注册有米需要的页面：
<pre lang="xml">
		<activity
	        android:name="net.youmi.android.AdBrowser"
	        android:configChanges="keyboard|keyboardHidden|orientation"            
	        android:theme="@android:style/Theme.Light.NoTitleBar" >
	    </activity>
	    <service
	        android:name="net.youmi.android.AdService"
	        android:exported="false" >
	    </service>
	    <receiver 
	        android:name="net.youmi.android.AdReceiver" >
	        <intent-filter>
	            <action android:name="android.intent.action.PACKAGE_ADDED" />
	            <data android:scheme="package" />
	        </intent-filter>
	    </receiver> 
		<receiver
	        android:name="net.youmi.android.offers.OffersReceiver"
	        android:exported="false" >
	    </receiver>
		<!-- 有米广告的渠道标识 ,有些市场需要添加后才能被审核通过 -->
		<meta-data android:name="YOUMI_CHANNEL" android:value="gfan" >
        </meta-data>
</pre>
<p style="padding-left: 30px;">渠道号请详见：<a href="http://wiki.youmi.net/PromotionChannelIDs" target="_blank">http://wiki.youmi.net/PromotionChannelIDs</a></p>
<p style="padding-left: 30px;"><b><span style="color: #ff0000;">注意，</span></b>如果我们的应用需要打包，需要在proguard-project.txt中添加下列的信息：</p>

<pre lang="java">
    -dontwarn net.youmi.android.**
    -keep class net.youmi.android.** {  
    *;  
    }
</pre>
<b>6.到自己的acvitiy里面去初始化我们的有米广告啦。</b>有米的官方文档上面说的是
“<span style="color: #0000ff;">请务必在主Activity的onCreate中调用AdManager.getInstance(context).init 接口初始化App的发布ID 、应用密钥和测试模式等参数。</span>”
但是我的应用会有一个欢迎界面 ，所以我一般是加在我的欢迎界面的activity中。
我的理解应该是在我们的任何广告显示前初始化。

在HistoryOfToday项目中SplashActivity的onCreate方法中可以看到下列的初始化代码：
<pre lang="java">
		//有米初始化
        AdManager.getInstance(this).init("7f738b41c9cac277 ","b8d621c7e1349c9f", false);
</pre>
<p style="padding-left: 30px;"><b>代码解释： </b>第一个参数为你在有米上创建应用后的app id
第二个参数为你在有米上面创建应用后有应用密码
第三参数为是否为debug模式</p>
<p style="padding-left: 30px;"><b><span style="color: #ff0000;">注意：</span></b>！请将测试模式设置为false后上传至网站等待审核。
！未上传应用安装包、未通过审核的应用、模拟器运行，都只能获得测试广告，审核通过后，模拟器上依旧是测试广告，真机才会获取到正常的广告。</p>
<b>6.</b>准备工作做好后我们就开始激动人心的步骤了。首先我们来看看如何<b>添加一个广告条</b>。
<p style="padding-left: 30px;">a. 首先需要去自己的layout里面添加上自己希望在哪里添加我们的广告条啦。关于添加广告条的东东我们会在后面的两章节中学习到。
比如，现在我需要在我们HistoryActivity底部添加上我们的广告，则找到它的布局文件：</p>
<p style="padding-left: 30px;">history_of_today.xml</p>

<pre lang="xml">
    <LinearLayout
        android:id="@+id/adLayout"
        android:layout_width="fill_parent"
        android:layout_height="wrap_content"
        android:layout_alignParentBottom="true"
        android:gravity="center_horizontal"
        android:orientation="horizontal" >
    </LinearLayout>
</pre>
<p style="padding-left: 30px;"><b>代码解释：</b>该LinearLayout你可以用任何的groupView ,主要是用来添加我们的AdView.
在这里我们将我们的广告条固定在界面的询问，通过  layout_alignParentBottom 属性来完成</p>
<p style="padding-left: 30px;">b.再回去我们的HistoryActivity代码中。在onCreate方法的末尾，可以看到我们初始化了一个adView并且添加到了上面创建的adLayout中。</p>

<pre lang="java">
        // 将广告条adView添加到需要展示的layout控件中
        LinearLayout adLayout = (LinearLayout) findViewById(R.id.adLayout);
        AdView adView = new AdView(this, AdSize.SIZE_320x50);
        adLayout.addView(adView);
</pre>
运行项目，就等着广告出来吧。如果没有出来，检查一下，网络是否正常，adLayout是否可见,应用id 及密钥是否正确。当然，加载广告也是需要时间的，千万不要急</p>
<p style="padding-left: 30px;">效果如下：
【广告条展示.png】</p>

<div align="center">        <a href="http://www.krislq.com/wp-content/uploads/2013/06/广告条展示.png"><img class="alignnone size-full wp-image-802" alt="广告条展示" src="http://www.krislq.com/wp-content/uploads/2013/06/广告条展示.png" width="480" height="800" /></a></div>
<p style="padding-left: 30px;">在我们初始化AdVIew的时候，会指定一个大小的。官方的文档如下：
</p>

<pre lang="java">
	！AdSize提供了四种广告条尺寸提供给开发者使用： 
	AdSize.SIZE_320x50 手机
	AdSize.SIZE_300x250 手机，平板
	AdSize.SIZE_468x60 平板
	AdSize.SIZE_728x90 平板
</pre>
<p style="padding-left: 30px;">在我们的代码里面，其实可以获取到手机的型号，来动态的设置广告的大小。大家也可以在自己的项目中换个大小，然后运行来看看效果。自己动手丰衣足食，我就跳过了</p>
<p style="padding-left: 30px;">c.如果你的是游戏，没有layout怎么办？
我们可以直接通过：
<pre lang="java">
this.addContentView(adView, layoutParams);
</pre>
<p style="padding-left: 30px;">来完成，layoutParams就不用说了吧？他就是一个LayoutParams.当然这里需要注意的是，看看你的根布局是用的哪种，比如说，如果是FrameLayout，则LayoutParams就是FrameLayout下面的。</p>
<p style="padding-left: 30px;">d.广告的监听。有时候我们觉得有米的统计是不是靠谱的？那么我们可以自己统计一下嘛。</p>
<pre lang="java">
	adView.setAdListener(new AdViewLinstener() { 
        @Override
        public void onSwitchedAd(AdView adView) {
        // 切换广告并展示
        }  
        @Override
        public void onReceivedAd(AdView adView) {
        // 请求广告成功
        }
        @Override
        public void onFailedToReceivedAd(AdView adView) {
        // 请求广告失败  
        }
    });
</pre>

但是官方也说了，这个也不一定准确，仅可作为一些参考 。哈哈

7.在新的有米广告中，添加了插屏的广告，个人觉得这种形式还不错哟。我们可以放在我们程序在loading数据的时候，或者是放到欢迎界面中。这样让大家在等待的过程中可以丰富我们的显示内容 。
我们先来看看效果图吧？
【插屏广告】
<div align="center"><a href="http://www.krislq.com/wp-content/uploads/2013/06/插屏广告.png"><img class="alignnone size-full wp-image-803" alt="插屏广告" src="http://www.krislq.com/wp-content/uploads/2013/06/插屏广告.png" width="480" height="800" /></a></div>
添加插屏广告就很简单了。只需要两步
<pre lang="java">
SpotManager.getInstance(this).loadSpotAds();
SpotManager.getInstance(this).showSpotAds(this);
</pre>

在 HistoryOfToday项目中，你可以在SplashActivity的onCreate方法中找到这两行代码 。
<p style="padding-left: 30px;"><b>代码解释：</b>
loadSpotAds一定得showSpotAds之前。没加载怎么显示啊？对吧？
这两行代码不一定非得在一起。你可以在欢迎里面去loadSpotAds,然后再其它的项目中去showSpotAds都是可以的。在HistoryOfToday项目中为了的展现的方式 ，我特意放到了一起。这样存在的问题，可以是插屏广告还没加载出来，SplashActivity都已经结束了。具体的实现大家还是根据自己的项目来设置吧</p>
8.接下来我们试试积分墙。我们在程序里面我们可以通过积分墙来让用户赚取一定的积分（当然这些积分会转化成你口袋里面的money的）。这些积分你可以让用户不完成程序里面的一些功能或者是内购。这样就比自己的应用再实现一套交易机制简单多了。
有米的积分墙可以支持用户的标识 ，主要是用于我们的应用支持多个帐户切换的时候。在我们的HistoryOfToday项目中是不需要的，所以如果大家想了解更多，就去有米的文档里面看吧。
<p style="padding-left: 30px;">a。积分墙中需要我们通过有米的接口来告诉有米我们程序的启动与结束 。具体的接口代码如下：
<pre lang="java">
		// 请务必调用以下代码，告诉SDK应用启动，可以让SDK进行一些初始化操作。该接口务必在SDK的初始化接口之后调用。
        OffersManager.getInstance(this).onAppLaunch();

		// 请务必在应用退出的时候调用以下代码，告诉SDK应用已经关闭，可以让SDK进行一些资源的释放和清理。
		OffersManager.getInstance(this).onAppExit(); 
</pre>
<b> 代码解释：</b> 大家可以在HistoryOfToday项目的HistoryActivity中onCreate和onDestroy中找到。
在这里我们的应用启动的时候，第一个页面是splashActivity ,那我为什么没加到SplashActivity里面呢？那是因为我们的SplashActivity只是一个欢迎界面 ，他只是代码我们程序的启动，但是并不代码我们的程序的结束。而且在splashactivity中我们把初始化信息完成后，就会finish掉他，并且真正的进入我们的主界面 。</p>
<p style="padding-left: 30px;">b. 调用有米积分墙的方法非常简单：
<pre lang="java">
	//调用showOffersWall显示全屏的积分墙界面
    OffersManager.getInstance(this).showOffersWall();
</pre>
代码解释：
大家可以在HistoryOfToday项目HistoryActivity中的onOptionsItemSelected()方法中找到。HistoryOfToday中我们是让用户点击menu菜单后，再选择积分墙后才能显示的。</p>
<p style="padding-left: 30px;">c.关于积分墙的更多配置，积分Banner及积分托管因为篇幅有限，大家可以具体的看有米的文方广告，如果有什么不清楚的，可以随时与我们交流。</p>
9.有米为了方便广大的开发者，也提供了更新的模块 。如果没有自己的服务器的朋友可以尝试一下。
这一块HistoryOfToday是用的友盟的更新模块，所以就没添加有米的。
不过都是大同小异的。

<pre lang="java">
	//通过调用AdManager的syncCheckAppUpdate或asyncCheckAppUpdate接口即可检查更新。
    //返回值AppUpdateInfo包含了更新提示以及下载地址，如果结果为null则表示当前已经是最新版本，无需下一步操作
    //
    //1.同步调用方法:   
    AppUpdateInfo updateInfo=AdManager.getInstance(this).syncCheckAppUpdate();  //注意，此方法务必在非UI线程调用，否则有可能不成功。
    //
    //2.异步调用方法
    AdManager.getInstance(this).asyncCheckAppUpdate(callback); //注意，此方法可以在任意线程中调用。
    //
    //当updateInfo不为null时，请自行处理提示及下载安装流程。
</pre>

在有米中，提供两种方式的检查更新。上面也已经说到了，分别是同步的（那么我们需要自己去新建一个线程或者是AsyncTask去调用 ）
还有一种是异步，可以在任意地方 都可以调用的，但是这种方式就需要提供有米一个回调接口了。从而在检查写成后通知我们的应用。。、、
<p style="padding-left: 30px;"><b><span style="color: #ff0000;">需要注意的是</span></b>，有米的更新只是检查更新，如果检查出来有更新后，具体应该如何去操作还是需要用户自定义了。这样就给了用户更广的可操作度。不必受限于有米的更新模块了</p>
10.在米还提供了一个非常实在的功能 ，就是在线参数的配置。到于你想用在线参数配置来干嘛？那就是你自己的事了，自己去想象吧。这无疑为我们没有自己服务器的人提供了非常大的便 利啊
这一块在HistoryOfToday项目也还没添加，暂时还没想到添加来控制些啥。呵呵。。不过官方说明文档里面有非常详细的说明。
代码来啰 ：
<pre lang="java">
String mykey="mycustomkey";//key  
    String defaultValue=null;//默认的value，当获取不到在线参数时，会返回该值  
    //1.同步调用方法，务必在非UI线程中调用，否则可能会失败。
    String value=AdManager.getInstance(context).syncGetOnlineConfig(key,
        defaultValue);  
    //--------------------------------------------------
    //2.异步调用方法(可在任意线程中调用):
    AdManager.getInstance(this).asyncGetOnlineConfig(mykey, new OnlineConfigCallBack() {
        @Override
        public void onGetOnlineConfigSuccessful(String key, String value) {
        // TODO Auto-generated method stub
            //获取在线参数成功
        }       
        @Override
        public void onGetOnlineConfigFailed(String key) {
            // TODO Auto-generated method stub
            //获取在线参数失败，可能原因有：键值未设置或为空、网络异常、服务器异常
        }
    });
</pre>
<p style="padding-left: 30px;"><b>代码解释：</b>在检查更新一下，有米也是提供了同步和异步的两个方法来获取 。你想用哪个就自己去选 啰</p>
11.最后的最后就是打包啦。但是面对如此多的应用市场，又想每个市场都能单独上传一个有标识的apk .那手动打包起来就得累死了。
在这里呢，我给大家推荐一个一劳永逸的办法 ，那就是猛戳
<a href="http://www.krislq.com/2012/12/android_class_powershel_ant_package/" target="_blank">用powershell+Ant实现Andoird为不合市场编译、签名自动化</a>
<a href="http://www.krislq.com/2012/12/android_class_powershel_ant_package/" target="_blank">http://www.krislq.com/2012/12/android_class_powershel_ant_package/</a>

好了，第二节就到此为止了，第三节我会给大家带来什么干货呢？我们明天见！！！！
