---
title:	"【Android课堂】AsyncQueryHandler了解"
date:	2013-02-17 17:13:31.0
categories:	[开发,Android,学习课堂]
tags:	[Kris,Android,AsyncQueryHandler]
---

<h3>摘要：</h3>
本文主要是从下面的几个方面去介绍AsyncQueryHandler。

1. AsyncQueryHandler介绍

2. 为什么需要 AsyncQueryHandler

3. 如何使用AsyncQueryHandler

<!--more-->
<h3>1. AsyncQueryHandler介绍：</h3>
AsyncQueryHandler顾名思义就是异步查询帮助类，它是Handler的子类。我们在处理与ContentProvider相关内容的时候，可以使用此类来完成一些异步的操作。

AsyncQueryHandler类上为我们提供了以下接口：
startInsert
startDelete
startUpdate
startQuery

这四个操作，并提供相对应的onXXXComplete方法，以供操作完数据库后进行其它的操作，这四个 onXXXComplete方法都是空实现，所以我们可以覆写此类方法来完成我们的后续操作。
<h3>2. 为什么需要 AsyncQueryHandler</h3>
当然你也可以使用ContentProvider去操作数据库。这在数据量很小的时候是没有问题的，但是如果数据量大了，可能导致ＵＩ线程发生ANR事件。
当然你也可以写个Handler去做这些操作，只是你每次使用ContentProvider时都要再写个Handler，必然降低了效率。
因此API提供了一个操作数据库的通用方法。
<h3>3. 如何使用AsyncQueryHandler</h3>
首先我们需要继承AsyncQueryHandler，并且提供onXXXComplete的实现方法（如果我们不关心操作数据库的结果，我们也可以不用实现），用于实现数据库操作完成的操作。

然后，在我们需要使用的地方直接使用startXXX方法即可。传入的通用参数有：

int token ,一个标识符。与onXXXComplete中返回的是一致的。当我们需要同时查询多次时，可以通过 token来标识每个查询。
Object cookie,你想传给onXXXComplete方法使用的一个对象。不想传，可以为null

Uri uri，不解释了

&nbsp;
下面再帖一段简单的用法：

<pre lang="java">
    protected void onResume() {  
        super.onResume();  
        Uri uri = Uri.parse("content://com.android.contacts/data/phones");  
        String[] projection = { "_id", "display_name", "data1", "sort_key" };  
        asyncQuery.startQuery(0, null, uri, projection, null, null,  
                "sort_key COLLATE LOCALIZED asc");
    }  
  
    //查询联系人
    private class MyAsyncQueryHandler extends AsyncQueryHandler {  
  
        public MyAsyncQueryHandler(ContentResolver cr) {  
            super(cr);  
        }  
  
        @Override  
        protected void onQueryComplete(int token, Object cookie, Cursor cursor) {  
            //TODO something 
        }
    } 
</pre>
