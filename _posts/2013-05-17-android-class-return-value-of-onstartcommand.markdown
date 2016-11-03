---
title:	"[Android课堂]Service 中onStartCommand方法的返回值问题"
date:	2013-05-17 14:32:02.0
categories:	[开发,Android,学习课堂]
tags:	[Android,service,onstartcommand]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/05/android4.0.jpg"><img class="alignnone size-full wp-image-755" alt="android4.0" src="http://www.krislq.com/wp-content/uploads/2013/05/android4.0.jpg" width="700" height="300" /></a>

大家一定经常用到android中的Service类。但是总有人会觉得奇怪，为什么有些应用的服务，在被当今流行的“流氓”（号称卫士等等字样）的程序kill后，还会<strong>顽强的原地满血复活呢？而自己写的服务总是一去不回？</strong>
<strong>我会告诉你就是Service 中的onStartCommand方法在作怪吗？
或者又有多少人关注过这个方法还有一个int的返回值呢？</strong>
<!--more-->
在service中，提供了四种返回值给我们，接下来我们就一个一个来看看他们的作用：

<strong>START_STICKY</strong>
原文：
<p style="padding-left: 30px;">
if this service's process is killed while it is started (after returning from onStartCommand), then leave it in the started state but don't retain this delivered intent. Later the system will try to re-create the service. Because it is in the started state, it will guarantee to call onStartCommand after creating the new service instance; if there are not any pending start commands to be delivered to the service, it will be called with a null intent object, so you must take care to check for this.
This mode makes sense for things that will be explicitly started and stopped to run for arbitrary periods of time, such as a service performing background music playback.</p>

义译：
<p style="padding-left: 30px;">
如果service进程被kill掉，保留service的状态为开始状态，但不保留递送的intent对象。随后系统会尝试重新创建service，由于服务状态为开始状态，所以创建服务后一定会调用onStartCommand(Intent,int,int)方法。如果在此期间没有任何启动命令被传递到service，那么参数Intent将为null。</p>

<strong>START_NOT_STICKY</strong>
原文：
<p style="padding-left: 30px;">
	if this service's process is killed while it is started (after returning from onStartCommand), and there are no new start intents to deliver to it, then take the service out of the started state and don't recreate until a future explicit call to Context.startService(Intent). The service will not receive a onStartCommand(Intent, int, int) call with a null Intent because it will not be re-started if there are no pending Intents to deliver. </p>
<p style="padding-left: 30px;">
	This mode makes sense for things that want to do some work as a result of being started, but can be stopped when under memory pressure and will explicit start themselves again later to do more work. An example of such a service would be one that polls for data from a server: it could schedule an alarm to poll every N minutes by having the alarm start its service. When its onStartCommand is called from the alarm, it schedules a new alarm for N minutes later, and spawns a thread to do its networking. If its process is killed while doing that check, the service will not be restarted until the alarm goes off.
</p>
义译：
<p style="padding-left: 30px;">
“非粘性的”。如果在执行完onStartCommand后，服务被异常kill掉，系统不会自动重启该服务。</p>

<strong>START_REDELIVER_INTENT</strong>
原文：
<p style="padding-left: 30px;">
if this service's process is killed while it is started (after returning from onStartCommand), then it will be scheduled for a restart and the last delivered Intent re-delivered to it again via onStartCommand. This Intent will remain scheduled for redelivery until the service calls stopSelf(int) with the start ID provided to onStartCommand. The service will not receive a onStartCommand(Intent, int, int) call with a null Intent because it will will only be re-started if it is not finished processing all Intents sent to it (and any such pending events will be delivered at the point of restart).
</p>
义译：
<p style="padding-left: 30px;">
使用这个返回值时，如果在执行完onStartCommand后，服务被异常kill掉，系统会自动重启该服务，并将Intent的值传入。</p>

<strong>START_STICKY_COMPATIBILITY</strong>
原文：
<p style="padding-left: 30px;">
compatibility version of START_STICKY that does not guarantee that onStartCommand will be called again after being killed.
</p>
义译：
<p style="padding-left: 30px;">
START_STICKY的兼容版本，但<strong>不保证服务被kill后一定能重启</strong>。</p>

所以，大家在自己的服务中应该给他一个什么样的值心中已经了然了吧？

<strong>那如果我给值，默认又是什么呢？</strong>
我们还是直接来看service 的源码里面是怎么与的吧？在源码面前没有秘密。嘿嘿。。

<pre lang="java">
    public int onStartCommand(Intent intent, int flags, int startId) {
        onStart(intent, startId);
        return mStartCompatibility ? START_STICKY_COMPATIBILITY : START_STICKY;
    }
</pre>
代码解释：
<p style="padding-left: 30px;">
哦哦，原来，如果mStartCompatibility 为 true就是START_STICKY_COMPATIBILITY [兼容模式]，否则为START_STICKY
</p>

<strong>mStartCompatibility 以是个啥东东？</strong>
再看看代码。
<pre lang="java">
    private boolean mStartCompatibility = false;
    ....//省略若干无关方法与代码
    mStartCompatibility = getApplicationInfo().targetSdkVersion
                < Build.VERSION_CODES.ECLAIR;
</pre>
代码解释：
<p style="padding-left: 30px;">
哦哦，原来是，如果系统版本低于ECLAIR(Android 2.0以下)就兼容模式了。。。</p>
