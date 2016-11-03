---
title:	"常用的线程池"
date:	2012-11-20 23:28:16.0
categories:	[开发,Java,学习课堂]
tags:	[线程池,线程,ThreadFactory,Executors,创建,销毁,服务器,newSingleThreadExecutor,newCachedThreadPool,newSingleThreadScheduledExecutor,newScheduledThreadPool,newFixedThreadPool]
---

在开始之前我们需要回答一个问题，为什么我们需要线程池？

&nbsp;&nbsp;&nbsp;&nbsp;因为如果我们需要频繁的创建，使用并销毁我们的线程，那么我们的应用可能需要对创建与销毁开销许多的 CPU ,这样无疑对我们服务器不是一种负载。
&nbsp;&nbsp;&nbsp;&nbsp;于是乎，懒惰的程序猿就想能不能尽量少的创建与销毁线程，尽可能的重复利用线程？
&nbsp;&nbsp;&nbsp;&nbsp;于是乎，线程池就诞生了

&nbsp;&nbsp;&nbsp;&nbsp;总结：线程池就是为了避免我们程序中大量的去创建与销毁线程，而实现的一种统一管理与分配线程资源的线程集合。

在JDK中一般我们有以下四种的线程池：
<img class="alignnone size-full wp-image-144" title="threadPools" src="http://krislq.com/wp-content/uploads/2012/11/threadPools.png" alt="" width="627" height="239" />

<!--more-->
每种线程池除了可以直接通过Executors来实例化外，也可以通过传入ThreadFactory来完成。默认的ThreadFactory是Executors的一个内容类，代码为：
<pre lang="java">
    static class DefaultThreadFactory implements ThreadFactory {
        private static final AtomicInteger poolNumber = new AtomicInteger(1);
        private final ThreadGroup group;
        private final AtomicInteger threadNumber = new AtomicInteger(1);
        private final String namePrefix;

        DefaultThreadFactory() {
            SecurityManager s = System.getSecurityManager();
            group = (s != null) ? s.getThreadGroup() :
                                  Thread.currentThread().getThreadGroup();
            namePrefix = "pool-" +
                          poolNumber.getAndIncrement() +
                         "-thread-";
        }

        public Thread newThread(Runnable r) {
            Thread t = new Thread(group, r,
                                  namePrefix + threadNumber.getAndIncrement(),
                                  0);
            if (t.isDaemon())
                t.setDaemon(false);
            if (t.getPriority() != Thread.NORM_PRIORITY)
                t.setPriority(Thread.NORM_PRIORITY);
            return t;
        }
    }
</pre>
