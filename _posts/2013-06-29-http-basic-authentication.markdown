---
title:	"HTTP Basic Authentication"
date:	2013-06-29 20:39:55.0
categories:	[开发,学习课堂,解决方案]
tags:	[HTTP Basic Authentication,Authentication,401,HttpClient]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/06/HTTP-Basic-Authentication.png"><img src="http://www.krislq.com/wp-content/uploads/2013/06/HTTP-Basic-Authentication.png" alt="HTTP Basic Authentication" width="700" height="227" class="alignnone size-full wp-image-843 center" /></a>

本文主要讲解了，HTTP BASIC认证,抢先认证介绍和 HttpClient 4.1.1 实例.
关于 Http的其它几种经常的认证可以在本文最后的相对参考连接中找到。
<!--more-->
<h3>1.HTTP BASIC认证</h3>
在HTTP中，基本认证是一种用来允许Web浏览器或其他客户端程序在请求时提供以用户名和口令形式的凭证。在发送之前，用户名追加一个冒号然后串接上口令。得出的结果字符串再用Base64算法编码。例如，用户名是Aladdin，口令是open sesame，拼接后的结果是Aladdin:open sesame，然后再用Base64编码，得到QWxhZGRpbjpvcGVuIHNlc2FtZQ==。Base64编码的字符串发送出去，并由接收者解码，得到一个由冒号分隔的用户名和口令的字符串。

在你访问一个需要HTTP Basic Authentication的URL的时候，如果你没有提供用户名和密码，服务器就会返回401，如果你直接在浏览器中打开，浏览器会提示你输入用户名 和密码。你可以尝试点击这个url看看效果：http://api.minicloud.com.cn/statuses/friends_timeline.xml。用户输入用户名称和密码，浏览器发送带认证的请求包。 HTTP服务器在每次收到请求包后，根据协议取得客户端附加的用户信息（BASE64加密的用户名和密码），解开请求包，对用户名及密码进行验证，如果用户名及密码正确，则根据客户端请求，返回客户端所需要的数据;否则，返回错误代码或重新要求客户端提供用户名及密码。

<h4>1.1认证流程</h4>
1， 客户端发出请求例如http://api.minicloud.com.cn/statuses/friends_timeline.xml。
<pre lang="html">
GET /statuses/friends_timeline.xml HTTP/1.1
Host: api.minicloud.com.cn
User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Accept-Language: zh-cn,zh;q=0.5
Accept-Encoding: gzip, deflate
Accept-Charset: GB2312,utf-8;q=0.7,*;q=0.7
Keep-Alive: 115
Connection: keep-alive
</pre>
2.服务器收到请求，发现用户未登录，响应如下。
<pre lang="html">
HTTP/1.1 401 Unauthorized
Server: nginxDate: Wed, 08 Jun 2011 06:25:47 GMT
Content-Type: application/xml; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
WWW-Authenticate: Basic
Vary: Accept-Charset, Accept-Encoding, Accept-Language, Accept
Accept-Ranges: bytes
</pre>
3,<strong>当符合http1.0或1.1规范的客户端（如IE，FIREFOX）收到401返回值时，将自动弹出一个登录窗口，要求用户输入用户名和密码。</strong>

4,用户输入用户名和密码后，<strong>将用户名及密码以BASE64加密方式加密，并将密文放入前一条请求信息中</strong>，则客户端发送的第一条请求信息则变成如下内容：
<pre lang="html">
GET /statuses/friends_timeline.xml HTTP/1.1

Host: api.minicloud.com.cn

.......

Connection: Keep-Alive

Authorization: Basic d2pqOjEyMzQ1Ng==
</pre>
<strong>注</strong>：Basic之后表示加密后的用户名及密码。
d2pqOjEyMzQ1Ng==生成步骤：
<pre lang="java">
String username = "username";
String password = "password";
String tmp = username + ":"+password;
String base64 = Base64.encodeToString(tmp.getBytes(), Base64.DEFAULT);
HttpPost httpPost = new HttpPost(url);
//在这里以HttpPost为例，你也可以为HttpGet等等
httpPost.addHeader("Authorization", "Base "+base64);
</pre>


5,服务器收到上述请求信息后，将Authorization字段后的用户信息取出、解密，将解密后的用户名及密码与用户数据库进行比较验证，如用户名及密码正确，服务器则根据请求，将所请求资源发送给客户端：
<pre lang="html">
HTTP/1.0 200 OK
Content-Type: text/html
Content-Length: xxxx

<html>
网页内容
</html>
</pre>
如用户名及密码不正确，请返回第2步，重新向客户端发送用户验证请求。

6,在以后的整个通信会话中，客户端均会在请求包中附加入加密后的用户信息。

<h3>2.抢先认证</h3>
抢先认证就是直接从上面第4步开始，<strong>在请求头里面加入用户名称和密码信息。</strong>直接向服务器请求信息。少了前面三步的操作。

看其它同事还采用的其它的方式：
请看：http://www.eoeandroid.com/thread-15897-1-1.html
里面提到的解决办法：


<blockquote>
写一个类继承Authenticator，重写getPasswordAuthentication()
private static class MyAuth extends Authenticator
    {
        
        @Override
        protected PasswordAuthentication getPasswordAuthentication()
        {
            // TODO Auto-generated method stub
            System.out.println("myAuth");
            return new PasswordAuthentication(用户名, 密码.toCharArray());
        }
    }

然后再调用HttpURLConnection前加上 Authenticator.setDefault(new MyAuth()); 就好了，会自动进行验证。
</blockquote>

<strong>注意</strong>：本方法本经测试，我在 android中使用的是下面的方法。

<h3>3.HttpClient的实现</h3>
HttpClient does not support preemptive authentication out of the box, 因为如果抢先认证误用或者使用不当会引起严重的质量问题，例如明文发送用户的凭证给未经授权的第三方。因此，用户应该在他们特定应用环境里面权衡使用抢先认证的潜在优势和安全风险的矛盾。 

尽管如此，我们仍然可以通过预先组装认证数据缓存来配置HttpClient 的抢先认证方式。
<pre lang="java">
 HttpHost targetHost = new HttpHost("api.t.sohu.com", 80, "http");

DefaultHttpClient httpclient = new DefaultHttpClient();

httpclient.getCredentialsProvider().setCredentials(
new AuthScope(targetHost.getHostName(), targetHost.getPort()),
new UsernamePasswordCredentials("username", "password"));

// Create AuthCache instance
AuthCache authCache = new BasicAuthCache();
// Generate BASIC scheme object and add it to the local auth cache
BasicScheme basicAuth = new BasicScheme();
authCache.put(targetHost, basicAuth);

// Add AuthCache to the execution context
BasicHttpContext localcontext = new BasicHttpContext();
localcontext.setAttribute(ClientContext.AUTH_CACHE, authCache);


String url ="http://api.t.sohu.com/statuses/update.xml";
 HttpPost httpPost = new  HttpPost(url);


httpPost.setHeader("Content-Type", "application/x-www-form-urlencoded");


for (int i = 0; i < 3; i++) {
HttpResponse response = httpclient.execute(targetHost, httpPost, localcontext);
HttpEntity entity = response.getEntity();
EntityUtils.consume(entity);
}
</pre>

请注意，在本文中，大部分转自：http://blog.csdn.net/xiaojianpitt/article/details/6531818
但是有部分为本人使用小得，在请转载时，请先阅读本文最后的“使用许可”

其它一些参考资料： <a href="http://blog.csdn.net/hotnet522/article/details/5824716">HTTP认证方式</a>
<a href="http://hc.apache.org/httpclient-3.x/authentication.html#Basic">HttpClient - HttpClient Authentication Guide</a>

<a href="http://www.cnblogs.com/QLeelulu/archive/2009/11/22/1607898.html">访问需要HTTP Basic Authentication认证的资源的各种语言的实现</a>
