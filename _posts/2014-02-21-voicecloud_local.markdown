---
title:	"如何通过讯飞语音将文本合成后的语音保存到本地"
date:	2014-02-21 14:53:00.0
categories:	[Android,随手实例,解决方案]
tags:	[null]
---

<a href="http://www.krislq.com/wp-content/uploads/2014/02/讯飞截图.png"><img src="http://www.krislq.com/wp-content/uploads/2014/02/讯飞截图.png" alt="讯飞截图" width="991" height="261" class="alignnone size-full wp-image-875" /></a>

讯飞大家一定都非常的熟悉。最近需要把做个小功能来把文字转换成语音，所以网上搜索了下，刚好讯飞在android端做了更新，可以保存语音到本地啦。果断下载来试了下。效果不错哟。亲。
<!--more-->

如果下载讯飞的开发包就不多说了，直接去： <a href="http://open.voicecloud.cn/" title="讯飞语音开发者平台" target="_blank">讯飞语音开发者平台</a>

下载好后，里面有开发包及文档说明。但是更新说明中是明确说明了已经支持android的语音本地保存，但是在翻遍了整个文档也没看到有相关的说明。

于是联系了他们官方的人技术人员，确认支持语音本地保存后，也在讯飞开发平台论坛中发了帖子以求支持。详情： <a href="http://club.voicecloud.cn/forum.php?mod=viewthread&tid=7009" title="关于在android下面如何能实现保存全成语音到本地" target="_blank">关于在android下面如何能实现保存全成语音到本地</a>

PS:非常感谢@jlyan 的及时热情的回复


在帖子中，描述与解决方案也写得相对的清楚了，在这里也就不再详述。下面为整个实例代码，比官方的demo简单很多，仅为了实现语音本地而快速构建，上传也传作为新手入门使用。

============================
地址:<a href="https://github.com/krislq/SpeakDemo" title="SpeakDemo" target="_blank">SpeakDemo 源码下载</a>
============================
<strong>注意事项: </strong>

<strong>PS: 此示例需讯飞语音+的支持，所以在转换前，请先确保手机中已经安装了讯飞语音+。否则会在初始化的时候报：21001 </strong>
1.一定是需要在线模式才能保存到本地。
<pre lang="java">
mTts.setParameter(SpeechConstant.ENGINE_TYPE, "cloud");//local
</pre>
engine_type是cloud(在线模式)，而不是local(本地模式)

2.在附加参数中标明需要保存到本地的路径地址。（记得标明读写sdcard的权限哦）
<pre lang="java">
mTts.setParameter(SpeechConstant.PARAMS, "tts_audio_path=/sdcard/speak_result.pcm");
</pre>
语音全成后保存的地址为：/sdcard/speak_result.pcm

3.当前讯飞保存后的语音格式中pcm无损的格式，直接是不能通过播放器播放的。需要将其转化成wav或者是其它格式。（PCM,WAV自行搜索相关知识）

我这边在网上随便找的一个小软件。
<a href="http://www.krislq.com/wp-content/uploads/2014/02/pcm2wav_png.png"><img src="http://www.krislq.com/wp-content/uploads/2014/02/pcm2wav_png.png" alt="pcm2wav_png" width="399" height="460" class="alignnone size-full wp-image-880" /></a>

<strong>默认音频宽度为：16位，通路为单通道，采样率为1600</strong>

4.在线全成与本地合成他的发音人是不一样的。在参数中还可以设置发音的语速，单调等来调出个性的声音


Enjoy it!



