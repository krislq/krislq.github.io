---
title:	"【Android课堂】判断当前显示是否为桌面"
date:	2012-11-27 16:21:28.0
categories:	[开发,Android,学习课堂,随手实例]
tags:	[Android,Intent,Android课堂,Action,Category,桌面,任务,ActivityManager]
---

最近一直都在研究启动啊，<strong>Intent，Action, Category</strong>之类的话题。
最近在自己的项目中需要用到判断一个应用是否启动的功能。为了扩展一下知识点，就把题目定成了如果判断当前显示是否为桌面。

其实这个过程有<strong>三个知识点</strong>。
&nbsp;&nbsp;&nbsp;&nbsp;1.<strong>如何找出正在运行的任务？</strong> Android系统是支持多任务的，找到所有运行的任务是关键。
&nbsp;&nbsp;&nbsp;&nbsp;2.<strong>如何找出当前正在运行的任务？</strong>虽然android是多任务的系统，但是同时在前端运行的应用只会有一个。如何找出来呢？
&nbsp;&nbsp;&nbsp;&nbsp;3.<strong>如何找出桌面？</strong>因为我们都知道android的桌面是可以定制的。我们怎么知道用户启用的是哪个桌面呢？
<!--more-->

带着这些问题我们开始今天的讲解吧。

&nbsp;&nbsp;&nbsp;&nbsp;1. 找出正在运行的任务。正在运行的任务可能是前台的也可能是后台的。我们不管三七二十一，先找出来再说。
&nbsp;&nbsp;&nbsp;&nbsp;代码如下：
<pre lang="java">
    ActivityManager manager = (ActivityManager) mContext.getSystemService(Context.ACTIVITY_SERVICE);
    List<RunningTaskInfo> runningTaskInfos = manager.getRunningTasks(Integer.MAX_VALUE);
</pre>

&nbsp;&nbsp;&nbsp;&nbsp;2.找出前台运行的任务。我们找出了所有正在运行的任务，那么前台运行的任务就位于所以任务的最前面。
<pre lang="java">
	RunningTaskInfo info = runningTaskInfos.get(0);
</pre>

&nbsp;&nbsp;&nbsp;&nbsp;3. 找出桌面。桌面应用(Launcher)的启动页面包含了以下条件：、
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.action为android.intent.action.MAIN，
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.category包含android.intent.category.Home
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;虽然说android可以定制桌面，但是我们显示桌面的时候，总是显示众多桌面中的一个。所以我判断的逻辑为：
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;找出所有的桌面，如果有一个桌面应用在前台运行，则表示桌面显示中。

	<pre lang="java">
	private List<String> getHomes() {  
		List<String> packages = new ArrayList<String>();  
		PackageManager packageManager = ListenService.this.getPackageManager();  
		Intent intent = new Intent(Intent.ACTION_MAIN);  
		intent.addCategory(Intent.CATEGORY_HOME);  
		List<ResolveInfo> resolveInfo = packageManager.queryIntentActivities(intent,  
				PackageManager.MATCH_DEFAULT_ONLY);  
		for(ResolveInfo info : resolveInfo){  
			packages.add(info.activityInfo.packageName);  
			System.out.println(info.activityInfo.packageName);  
		}  
		return packages;  
	}
	</pre>

&nbsp;&nbsp;&nbsp;&nbsp;最后我们来看看完整的代码：

<pre lang="java">
	public boolean isHome(){ 
		homes = getHomes();
		ActivityManager mActivityManager = (ActivityManager)getSystemService(Context.ACTIVITY_SERVICE);  
		List<RunningTaskInfo> rti = mActivityManager.getRunningTasks(1);  
		return homes.contains(rti.get(0).topActivity.getPackageName());  
	} 
	private List<String> getHomes() {  
		List<String> packages = new ArrayList<String>();  
		PackageManager packageManager = ListenService.this.getPackageManager();  
		Intent intent = new Intent(Intent.ACTION_MAIN);  
		intent.addCategory(Intent.CATEGORY_HOME);  
		List<ResolveInfo> resolveInfo = packageManager.queryIntentActivities(intent,  
				PackageManager.MATCH_DEFAULT_ONLY);  
		for(ResolveInfo info : resolveInfo){  
			packages.add(info.activityInfo.packageName);  
			System.out.println(info.activityInfo.packageName);  
		}  
		return packages;  
	}
</pre>
