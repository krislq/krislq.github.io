---
title:	"吹一吹功能实现"
date:	2013-02-22 16:24:11.0
categories:	[开发,Android,随手实例]
tags:	[吹一吹,雪花,AudioRecord]
---

我们先看看效果图：

<a href="http://www.krislq.com/wp-content/uploads/2013/02/main-interface.png"><img class="alignnone size-full wp-image-642" alt="main interface" src="http://www.krislq.com/wp-content/uploads/2013/02/main-interface.png" width="300" height="533" /></a>     <a href="http://www.krislq.com/wp-content/uploads/2013/02/snow.png"><img class="alignnone size-full wp-image-643" alt="snow" src="http://www.krislq.com/wp-content/uploads/2013/02/snow.png" width="300" height="533" /></a>

功能：
<p style="padding-left: 30px;">点击begin
对着屏幕下方吹一口气
屏幕中会出现雪花飘
所有雪花离开屏幕后，恢复正常</p>

<!--more-->
实现：
<p style="padding-left: 30px;">用户点击按钮后，如果没有开始record线程，我们会开始线程去监听AudioRecord中声音状态，否则会停止当前的监听。
代码：
    <pre lang="java">
    	public void onClick(View v) {
		if (recordThread == null || recordThread.getRecordStatus()) {
			btnBlow.setText("Stop");
			tvDisplay.setText("试试对着电话底部吹一吹吧");
			recordThread = new RecordThread(handler, 1); // 点击按钮，启动线程
			recordThread.start();
			snowView.setStatus(false);
		} else {
			btnBlow.setText("Begin");
			recordThread.stopRecord();
		}
	}
    </pre>
</p>
<p style="padding-left: 30px;">在监听过程，打开AudioRecord，如果在规定时间(100)内，平均音量大于设定值(默认40,可自行设置)。则触发事件：
        <pre lang="java">
    public void run() {
		System.out.println("RUN");
		stop = false;
		try {
			audioRecord.startRecording();
			// 用于读取的 buffer
			byte[] buffer = new byte[bufferSize];




			int total = 0;
			int number = 0;
			while (!stop) {
				number++;
				sleep(8);
				long currenttime = System.currentTimeMillis();
				int r = audioRecord.read(buffer, 0, bufferSize) + 1;// 读取到的数据
				int v = 0;
				for (int i = 0; i < buffer.length; i++) {
					v += Math.abs(buffer[i]);//取绝对值，因为可能为负
				}
				int value = Integer.valueOf(v / r);//算得当前所有值的平均值
				System.out.println("value:" + value);
				total = total + value;
				long endtime = System.currentTimeMillis();
				long time = endtime - currenttime;
				//如果时间大于100毫秒并且次数多于5次
				if (time >= 100 || number > 5) {
					int tmp = total / number;
					total = 0;
					number = 0;
					//声音的大小达到一定的值
					if (tmp > BLOW_BOUNDARY) {
						// 发送消息通知到界面 触发动画
						// 利用传入的handler 给界面发送通知
						handler.sendEmptyMessage(what);
						number = 1;
						time = 1;
					}
				}




			}
			audioRecord.stop();
			audioRecord.release();
			bufferSize = 100;




		} catch (Exception e) {
			e.printStackTrace();
		}
	}
    </pre>
</p>
<p style="padding-left: 30px;">触发吹一下的动作后，会通过 hander回调给界面 ，用于显示文字并且雪花开始飘啊飘
    <pre lang="java">    
    case 1:
        // 接收到message后更新UI，并通过isblow停止线程
        tvDisplay.setText("吹了一下:"+System.currentTimeMillis());
        btnBlow.setText("Begin");
        recordThread.stopRecord();
        update();
        break;
        </pre>
</p>
关于雪花的效果，我前面写过一个帖子：<a href="http://www.krislq.com/2013/02/android_case_snow_flow/" title="【Android实例】雪花飞舞">【Android实例】雪花飞舞</a>
<p style="padding-left: 30px;">本实例中的雪花飞与前面文章里面的又不尽相同 ，一个是从下往上，一个是从上往下，大家可以结合起来看看。</p>
&nbsp;

源码下载地址：

===================

<a href="http://www.krislq.com/wp-content/uploads/2013/02/TakeBlow.zip">TakeBlow</a>
