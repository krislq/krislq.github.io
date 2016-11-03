---
title:	"获取Manifest中<meta-data>标签的值"
date:	2013-06-25 23:13:08.0
categories:	[Android,学习课堂]
tags:	[Android,Activity,application,service,meta-data,manifest,receiver]
---

在平时我们开发应用的过程中，我们可能需要设置一些动态变量值随着我们版本的变化一起变化 。在这种情况下，一般我们首先想到的办法可能就是我们申明一个静态的变量，然后在我们的应用中直接使用就行了，以后如果需要修改的时候，我们再找到这个类里面的定义的地方，再重新赋值即可。。。

当然，我们也可以通过在Menifest里面的meta-data标签来定义一个值，然后在我们的应用中直接去读取即可，这样，下次如果需要修改值，我们就不必再找到我们的代码了，而是在修改我们的版本号的时候，一起就可以修改了。更加方便与便捷。

这样的应用场景在给多市场打包的时候，你一定见过。比如友盟，有米的sdk里面就有一步为:在 application标签下定义一个meta-data来为不同的市场赋值和传入不同的appId。

那么我们的自己应用里面应该如何去定义meta-data的值呢？并且怎么在代码中取出我们要想的值 呢？

那么点击更多，跟着我一起来看看如何操作吧！！！
<!--more-->
形如：
<pre lang="xml">
   <application ...>
       <meta-data android:value="12345" android:name="APPID"/>
       <activity ...>
              <meta-data android:name="data_Name" android:value="hello my activity"></meta-data>
       </activity>
   </application>
</pre>

从上面可以看出，我们的meta-data不仅仅是可以放到application标签下面，也可以放到activity下面，其实也可以放到service ,receiver下面。。。

我们分别来看看如何获取的吧？

<strong>1.获取 application标签中的meta-data：</strong>
形如：
<pre lang="xml">
   <application...>
       <meta-data android:value="my_data" android:name="data_Name"/>
   </application>
</pre>
代码：
<pre lang="java">
    ApplicationInfo appInfo = context.getPackageManager()
                                  .getApplicationInfo(context.getPackageName(),
                          PackageManager.GET_META_DATA);
    String dataName=appInfo.metaData.getString("data_Name");
</pre>

<strong>2.获取 activity标签中的meta-data：</strong>
形如：
<pre lang="xml">
   <activity ...>
       <meta-data android:value="my_activity" android:name="data_Name"/>
   </activity>
</pre>
代码：
<pre lang="java">
    ActivityInfo activityInfo = context.getPackageManager()
                                  . getActivityInfo(activity.getComponentName(),
                          PackageManager.GET_META_DATA);
    String dataName=activityInfo.metaData.getString("data_Name");
</pre>
<strong>注意：</strong>activity.getComponentName()为获取activity实例的ComponentName 也可以用下面的代替:
<pre lang="java">
//通过指定一个activity类来生成一个新的ComponentName
ComponentName componentName =new ComponentName(context, SplashActivity.class);
</pre>


<strong>3.获取 service标签中的meta-data：</strong>
形如：
<pre lang="xml">
   < service ...>
       <meta-data android:value="my_service" android:name="data_Name"/>
   </service >
</pre>
代码：
<pre lang="java">
    ComponentName componentName=new ComponentName(context, MyService.class);
    ServiceInfo serviceInfo = context.getPackageManager()
                                  . getServiceInfo(componentName,
                          PackageManager.GET_META_DATA);
    String dataName=serviceInfo.metaData.getString("data_Name");
</pre>
<strong>注意:</strong>在Service里面就没有getComponentName()方法来快速获取到当前的ComponentName了，所以只能通过指定service类的方式来生成一个新的ComponentName

<strong>4.获取 receiver标签中的meta-data：</strong>
形如：
<pre lang="xml">
   < receiver ...>
       <meta-data android:value="my_receiver" android:name="data_Name"/>
   </receiver >
</pre>
代码：
<pre lang="java">
    ComponentName componentName=new ComponentName(context, MyService.class);
    ActivityInfo activityInfo = context.getPackageManager()
                                  . getReceiverInfo(componentName,
                          PackageManager.GET_META_DATA);
    String dataName=activityInfo.metaData.getString("data_Name");
</pre>
<strong>注意：</strong>在receiver可没有 ReceiverInfo了，而是用的activityInfo来处理的。

<strong>最后的注意：</strong>我们在获取值的时候都是使用的是：xxxInfo.metaData.getString("data_Name");把所有的值都当成是String来获取的，如果在meta-data中是int型的，如果还是使用getString()方法获取出来的值是为空的，但是metaData提供了这么多种get方法来获取 。
如果metadata 的数据类型是没办法确定的，那么可以直接使用 Object object = metaData.get(key)来获取 ，然后再转化成自己要想的数据类型。
