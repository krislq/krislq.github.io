---
title:	"【Android实例】雪花飞舞"
date:	2013-02-19 13:49:45.0
categories:	[开发,Android,随手实例]
tags:	[Android,随手实例,Snow,雪花飞舞]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/02/snow_ad.png"><img class="size-full wp-image-601 aligncenter" alt="snow_ad" src="http://www.krislq.com/wp-content/uploads/2013/02/snow_ad.png" width="700" height="200" /></a>
<p style="padding-left: 30px;">最近觉得腾讯微博的吹一吹感觉挺酷的，所以想抽个时间学习了一下。在实现了吹一吹效果的时候，觉得还不够酷，想再模拟一下蒲公英飞舞的效果。于是就从雪花飞舞这个效果下手了，把雪花飞舞倒置过来就是蒲公英向上飞了。呵呵。。。</p>
<p style="padding-left: 30px;"><!--more-->
本实例借鉴有这个哥们的效果：http://blog.csdn.net/qiushibaiyi/article/details/8499963
但是觉得还不够帅气 ，于是自己在他的基础上再进行了一些修改。</p>
<p style="padding-left: 30px;">整个实例也是相对比较的简单，适合新手学习与借鉴。代码中也有详细的注释，看看应该都能懂的。</p>
<p style="padding-left: 30px;"><strong>整体来说雪花的下落还是有点生硬的。如果有好的建议或者是意见，欢迎扔砖！</strong>
关于吹一吹的实例，敬请关注，稍后发出来。</p>
<p style="padding-left: 30px;">下面是一些关键代码的解释与说明：</p>

<pre lang="java">
	public void onDraw(Canvas canvas) {
		super.onDraw(canvas);
		for (int i = 0; i < MAX_SNOW_COUNT; i += 1) {
			if (snows[i].coordinate.x >= view_width || snows[i].coordinate.y >= view_height) {
				snows[i].coordinate.y = 0;
				snows[i].coordinate.x = random.nextInt(view_width);
			}
			// 雪花下落的速度
			snows[i].coordinate.y += snows[i].speed;
			//雪花飘动的效果

			// 随机产生一个数字，让雪花有水平移动的效果
			int tmp = MAX_SPEED/2 - random.nextInt(MAX_SPEED);
			//为了动画的自然性，如果水平的速度大于雪花的下落速度，那么水平的速度我们取下落的速度。
			snows[i].coordinate.x += snows[i].speed < tmp ? snows[i].speed : tmp;
			canvas.drawBitmap(bitmap_snows, ((float) snows[i].coordinate.x),
					((float) snows[i].coordinate.y), mPaint);
		}
	}
</pre>


源码来了：

<a href="http://www.krislq.com/wp-content/uploads/2013/02/SnowDemo.zip">SnowDemo</a>

