---
title:	"监听屏幕开、关及用户解锁屏幕"
date:	2014-04-29 19:59:21.0
categories:	[Android,随手实例,解决方案]
tags:	[null]
---

<a href="http://www.krislq.com/wp-content/uploads/2014/04/一排开关.png"><img src="http://www.krislq.com/wp-content/uploads/2014/04/一排开关.png" alt="一排开关" width="700" height="250" class="alignnone size-full wp-image-892" /></a>

最近在项目中尝试去监听屏幕的开与关。唰唰唰在脑子里面就有了一个实现的思路：
<li>1.屏幕开与关是否有广播?广播事件是什么？
<li>2.写个广播类去监收广播
<li>3.判断是开还是关，然后对应处理
<!--more-->


二话不说，打开google ,就搜索起来了。

第一个任务顺利完成。屏幕的开、关、解锁都有对应的广播事件。如下：
<pre lang="java">
Intent.ACTION_SCREEN_ON
//android.intent.action.SCREEN_ON
//屏幕亮起事件，从api-1有的

Intent.ACTION_SCREEN_OFF
//android.intent.action.SCREEN_OFF
//屏幕关闭事件，从api-1有的

Intent.ACTION_USER_PRESENT
//android.intent.action.USER_PRESENT
//用户解锁屏幕事件，从api-3有的（现在3以下应该没有谁还在做兼容了吧？）
</pre>

第二个任务时想到用户不知道何时去开关屏幕，所以第一个想到的是直接去manifest中去注册我们的广播类。
<pre lang="xml">
        <receiver android:name=".ScreenReceiver" >
            <intent-filter>
                <action android:name="android.intent.action.SCREEN_OFF" />
                <action android:name="android.intent.action.SCREEN_ON" />
                <action android:name="android.intent.action.USER_PRESENT" />
            </intent-filter>
        </receiver>
</pre>
然后一运行，开关屏幕，咦？怎么没有SCREEN_OFF，SCREEN_ON出来？只有在解锁屏幕时有USER_PRESENT事件出来！！！我反复检查了三次，一个字一个字对了下action,发现也没有错误 。于是赶紧上个google 问问是个啥情况 ？

不问不知道，一问吓一跳，原来SCREEN_OFF,SCREEN_ON不支持在manifest中去定义。必需使用动态注册方式。

这下杯具了，为了能使得监听任何时候都起作用，只能再定义一个服务(service)一直在后台运行着，然后再注册个广播去监听开关屏幕事件了。

无耐，只能再定义一个服务了：
<pre lang="java">
public class CheckService extends Service{
    public static final String ACTION_CHECK = "com.krislq.screenon.service.CHECK";

    private ScreenReceiver mScreenReceiver;
    @Override
    public IBinder onBind(Intent intent) {
        return null;
    }

    @Override
    public void onCreate() {
        log("onCreate");
        super.onCreate();
        mScreenReceiver = new ScreenReceiver();
        IntentFilter filter = new IntentFilter();
        filter.addAction(Intent.ACTION_SCREEN_OFF);
        filter.addAction(Intent.ACTION_SCREEN_ON);
        filter.addAction(Intent.ACTION_USER_PRESENT);
        registerReceiver(mScreenReceiver, filter);
    }

    public void log(String msg) {
        if(TextUtils.isEmpty(msg)) {
            return;
        }
        Log.e("CheckService", msg);
    }
    @Override
    public void onDestroy() {
        log("onDestroy");
        unregisterReceiver(mScreenReceiver);
        super.onDestroy();
    }
}
</pre>
OK .好了，运行下，可以正常运行了。


源码来了。小demo .

<a href="http://www.krislq.com/wp-content/uploads/2014/04/ScreenOn.zip">点击下载 ScreenOn Demo</a>
