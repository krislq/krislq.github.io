---
title:	"判断手机里面是否装有某个应用"
date:	2013-06-26 22:39:23.0
categories:	[Android,学习课堂,解决方案]
tags:	[sina,weibo,微博，新浪，activitymanager,PackageManager,ACTION_DELETE]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/06/Lucid-Dreaming-App-Install副本.png"><img src="http://www.krislq.com/wp-content/uploads/2013/06/Lucid-Dreaming-App-Install副本.png" alt="Lucid-Dreaming-App-Install副本" width="600" height="400" class="alignnone size-full wp-image-837 aligncenter" /></a>

在有的时候，我们需要判断手机是否装有特定的应用，如果有，我们就会打开应用去做某些事情，如果没有装，则需要找另外的解决办法或者是提示用户之类的。

那么在android中我们需要怎么样判断某个应用是否已经安装到手机中了呢？？？？？
<!--more-->

在判断之前，我们需要了解到，android中判断是否为同一个应用时，是用的程序的包名来判断的。如果两个应用的包名一样的，那么系统会认为是同一个应用，并且会提示你说系统 中已经有了同一个应用了。

我们在这里判断是否已经安装了某个应用，就是去读取系统 中所有安装的应用，并且去判断他们的包名是否为我们想要的包名。

<strong>那么第一个需要我们解决的问题为：我们如何找到一个第三方应用的包名呢？比如说，我怎么知道新浪微博的包名呢？</strong>
我们可以通过ActivityManager日志里面的输入来判断 ，比如说，当我启动微博客户端的时候，我们可以看到下面的日志：
<pre xml>
06-26 22:37:00.885: I/ActivityManager(210): START {act=android.intent.action.MAIN cat=[android.intent.category.LAUNCHER] flg=0x10200000 cmp=com.sina.weibo/.SplashActivity bnds=[40,185][200,385]} from pid 437
06-26 22:37:01.229: I/ActivityManager(210): Displayed com.sina.weibo/.SplashActivity: +305ms
06-26 22:37:02.447: I/ActivityManager(210): START {cmp=com.sina.weibo/.MainTabActivity} from pid 11036
06-26 22:37:02.557: I/ActivityManager(210): START {cmp=com.sina.weibo/.SwitchUser} from pid 11036
06-26 22:37:02.885: I/ActivityManager(210): Displayed com.sina.weibo/.SwitchUser: +327ms (total +384ms)

</pre>
我们从上面就可以看出，新浪微博的android客户端的包名为： <strong>com.sina.weibo</strong> 。同理我们可以获取到任何的第三方的应用程序的包名。

经过上面的步骤，我们获取到了，新浪微博的包名了，那么接下来我们<strong>需要获取 到系统 中所有安装的应用的包名，并且与我们已知的想判断的包名去匹配，如果想等，就证明已经安装了本应用了</strong>：

<pre lan="java">
    public static boolean haveInstallApp(Context context，String packageName) {
        if(TextUtils.isEmpty(packageName)) {
            return false;
        }
        // get packagemanager
        PackageManager packageManager =context.getPackageManager();
        // 获取所有已安装程序的包信息
        List<PackageInfo> pinfo = packageManager.getInstalledPackages(0);
        if (pinfo != null) {
            for (int i = 0; i < pinfo.size(); i++) {
                String installPackageName = pinfo.get(i).packageName;
                if(packageName.equals(installPackageName)) {
                    return true;
                }
            }
        }
        return false;
    }
</pre>

当然，<strong>上面这种办法是较原始的方法，我们可以直接获取对应的包名，看能不能获取到信息，如果能，则就已经证明手机已经安装了。
</strong>
<pre lan="java">
public static void uninstallSoftware(Context context, String packageName) {  
    PackageManager packageManager = context.getPackageManager();  
    try {  
        PackageInfo pInfo = packageManager.getPackageInfo(packageName,  
                PackageManager.COMPONENT_ENABLED_STATE_DEFAULT); 
        //判断是否获取到了对应的包名信息 
        if(pInfo!=null){  
            return true;
        }  
    } catch (NameNotFoundException e) {  
        e.printStackTrace();  
    }  
    return false;
} 
</pre>

<strong>
有的时候，我们不仅仅只是想知道是否安装了某个应用，我们想卸载某个应用怎么办呢？</strong>

当然还是需要知道他的包名，然后再通过发送一个action为 Intent.ACTION_DELETE 的Intent去告诉系统进行卸载 。
<pre lang="java">
public static void uninstallSoftware(Context context, String packageName) {  
    PackageManager packageManager = context.getPackageManager();  
    try {  
        PackageInfo pInfo = packageManager.getPackageInfo(packageName,  
                PackageManager.COMPONENT_ENABLED_STATE_DEFAULT); 
        //在这里也是判断当前应用是否安装 
        if(pInfo!=null){  
            //删除软件  
            Uri uri = Uri.parse("package:"+ name);  
            Intent intent = new Intent(Intent.ACTION_DELETE, uri);  
            context.startActivity(intent);  
        }  
    } catch (NameNotFoundException e) {  
        e.printStackTrace();  
    }  
} 
</pre>

好了。。。。。。。
