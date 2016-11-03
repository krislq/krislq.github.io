---
title:	"关于简单类型不能够精确的对浮点数进行运算的问题"
date:	2012-11-21 11:11:33.0
categories:	[工具,开发,Java]
tags:	[java,浮点,Float,Double,金额,BigDecimal,商业,Arith]
---

&nbsp;&nbsp;&nbsp;&nbsp;今天早上看到一帖子：
	&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.eoeandroid.com/forum.php?mod=viewthread&tid=230406&fromuid=10996"><永远不要相信计算机></a>
	
&nbsp;&nbsp;&nbsp;&nbsp;里面说几个很明显的简单的浮点的运算，计算机都会算错。
&nbsp;&nbsp;&nbsp;&nbsp;我引过来给大家看看：
&nbsp;&nbsp;&nbsp;&nbsp;运行代码：
<pre lang="java">
	System.out.println(0.05 + 0.01);
        System.out.println(1.0 - 0.42);
        System.out.println(4.015 * 100);
        System.out.println(123.3 / 100);
		
</pre>
<!--more-->
&nbsp;&nbsp;&nbsp;&nbsp;大家可以自己新建一个工程来试试，结果如下：

<pre lang="java">
0.060000000000000005
0.5800000000000001
401.49999999999994
1.2329999999999999
</pre>

&nbsp;&nbsp;&nbsp;&nbsp;这就很神奇了，0.05+0.01很明显是0.06嘛，但是为什么会变成0.060000000000000005?
&nbsp;&nbsp;&nbsp;&nbsp;<strong>是不是计算器太弱智？真是计算机就不靠谱了？</strong>

&nbsp;&nbsp;&nbsp;&nbsp;<strong>当然不是的。</strong>主要是因为java中的简单类型并不适用于对浮点的精确计算。<strong>不光是JAVA ,其它语言也存在同样的问题。</strong>
虽然现在CPU都支持浮点的运算了，但是CPU在处理的时候，也是先把浮点数（float , double）转成整数再转成二进制，然后进行操作，如果有取余，会有不同的取余方式。
再加上运算完成后，再多二进制转成上层的浮点，又会有一些取舍。就造成了呈现出来时的简单明显的错误 。

&nbsp;&nbsp;&nbsp;&nbsp;所以说，一般float和double用来做科学计算或者是工程计算，在一般对精度要求较高的地方（如商业），我们会用到BCD码或者是java.math.BigDecimal。

&nbsp;&nbsp;&nbsp;&nbsp;BSD码（Binary-Coded Decimal），称BCD码或二-十进制代码，亦称二进码十进数。是一种二进制的数字编码形式，用二进制编码的十进制代码。
大家对这个有兴趣的可以深入研究一下，今天我们主要讲的是BigDecimal类。因为我们在做项目的时候，尤其是对商业项目时，我们不可能还去搞个什么BSD码，可以直接利用BigDecimal类来完成我们的需求。

&nbsp;&nbsp;&nbsp;&nbsp;<strong>BigDecimal</strong> 是Java提供的不可变的、任意精度的有符号十进制数。如果想看更多关于BigDecimal的介绍，大家可以自行去查看JDK的文档。

&nbsp;&nbsp;&nbsp;&nbsp;BigDecimal提供了一系列的构造函数，主用于将double , string等转化成BigDecimal对象。
<pre lang="java">
BigDecimal(double val) 
	将 double 转换为 BigDecimal，后者是 double 的二进制浮点值准确的十进制表示形式。
BigDecimal(String val) 
    将 BigDecimal 的字符串表示形式转换为 BigDecimal。
	
</pre>
&nbsp;&nbsp;&nbsp;&nbsp;习惯上我们在使用浮点数的时候都是直接定义的double , float数据类型，在定义上是没有问题，但是如果我们直接调用BigDecimal(double val) 方法来转化，那我们可得先注意一下JDK文档中关于这个构造的详细说明了：

&nbsp;&nbsp;&nbsp;&nbsp;直接上中文了，英文好的，可以自己去看原版：

注：

&nbsp;&nbsp;&nbsp;&nbsp;此构造方法的结果有一定的不可预知性。有人可能认为在 Java 中写入 new BigDecimal(0.1) 所创建的 BigDecimal 正好等于 0.1（非标度值 1，其标度为 1），但是它实际上等于 0.1000000000000000055511151231257827021181583404541015625。这是因为 0.1 无法准确地表示为 double（或者说对于该情况，不能表示为任何有限长度的二进制小数）。这样，传入 到构造方法的值不会正好等于 0.1（虽然表面上等于该值）。

&nbsp;&nbsp;&nbsp;&nbsp;BigDecimal(double val) 这个方法是不可预知的，所以我们推荐使用BigDecimal(String val) 。
&nbsp;&nbsp;&nbsp;&nbsp;String的构造函数就是可预知的，new BigDecimal(“.1”)如同期望的那样精确的等于.1。

&nbsp;&nbsp;&nbsp;&nbsp;接下来我们对 0.05+0.01重新修改一下：

<pre lang="java">
BigDecimal bd1 = new BigDecimal(Double.toString(0.05));
BigDecimal bd2 = new BigDecimal(Double.toString(0.01));
System.out.println(bd1.add( bd2));
		
</pre>
&nbsp;&nbsp;&nbsp;&nbsp;我们再来看看运行的结果：
<pre lang="java">
0.06
</pre>

&nbsp;&nbsp;&nbsp;&nbsp;这下就是我们想要的结果了，完成了高精度的一个运算了。

<strong>注意：</strong>
	&nbsp;&nbsp;&nbsp;&nbsp;现在我们已经知道怎么样来解决这个问题了，原则上是推荐使用BigDecimal(String val) 构造方法。
	&nbsp;&nbsp;&nbsp;&nbsp;我建议，在商业的应用中，涉及到money的浮点运算全都定义成String ,在数据库中保存也是String ,在需要使用到这个money来作运算的时候，我们再把String转化成BigDecimal来完成高精度的运算。
	
&nbsp;&nbsp;&nbsp;&nbsp;试想一下，如果我们要做一个加法运算，需要先将两个浮点数转为String，然后够造成BigDecimal，在其中一个上调用add方法，传入另一个作为参数，然后把运算的结果（BigDecimal）再转换为浮点数。你能够忍受这么烦琐的过程吗？

&nbsp;&nbsp;&nbsp;&nbsp;SO, 网上找了一个比较好的一个工具类，封闭了简单的操作。可以参考一下：
<pre lang="java">
/**
 * 
 * 由于Java的简单类型不能够精确的对浮点数进行运算，这个工具类提供精
 * 确的浮点数运算，包括加减乘除和四舍五入。
 * 
 *
 */
public class Arith{
    //默认除法运算精度
    private static final int DEF_SCALE = 10;
    //这个类不能实例化
    private Arith(){
    }
 
    /**
     * 提供精确的加法运算。
     * @param v1 被加数
     * @param v2 加数
     * @return 两个参数的和
     */
    public static double add(double v1,double v2){
        BigDecimal b1 = new BigDecimal(Double.toString(v1));
        BigDecimal b2 = new BigDecimal(Double.toString(v2));
        return b1.add(b2).doubleValue();
    }
    /**
     * 提供精确的减法运算。
     * @param v1 被减数
     * @param v2 减数
     * @return 两个参数的差
     */
    public static double sub(double v1,double v2){
        BigDecimal b1 = new BigDecimal(Double.toString(v1));
        BigDecimal b2 = new BigDecimal(Double.toString(v2));
        return b1.subtract(b2).doubleValue();
    } 
    /**
     * 提供精确的乘法运算。
     * @param v1 被乘数
     * @param v2 乘数
     * @return 两个参数的积
     */
    public static double mul(double v1,double v2){
        BigDecimal b1 = new BigDecimal(Double.toString(v1));
        BigDecimal b2 = new BigDecimal(Double.toString(v2));
        return b1.multiply(b2).doubleValue();
    }
 
    /**
     * 提供（相对）精确的除法运算，当发生除不尽的情况时，精确到
     * 小数点以后10位，以后的数字四舍五入。
     * @param v1 被除数
     * @param v2 除数
     * @return 两个参数的商
     */
    public static double div(double v1,double v2){
        return div(v1,v2,DEF_SCALE);
    }
 
    /**
     * 提供（相对）精确的除法运算。当发生除不尽的情况时，由scale参数指
     * 定精度，以后的数字四舍五入。
     * @param v1 被除数
     * @param v2 除数
     * @param scale 表示表示需要精确到小数点以后几位。
     * @return 两个参数的商
     */
    public static double div(double v1,double v2,int scale){
        if(scale<0){
            throw new IllegalArgumentException(
                "The scale must be a positive integer or zero");
        }
        BigDecimal b1 = new BigDecimal(Double.toString(v1));
        BigDecimal b2 = new BigDecimal(Double.toString(v2));
        return b1.divide(b2,scale,BigDecimal.ROUND_HALF_UP).doubleValue();
    }
 
    /**
     * 提供精确的小数位四舍五入处理。
     * @param v 需要四舍五入的数字
     * @param scale 小数点后保留几位
     * @return 四舍五入后的结果
     */
    public static double round(double v,int scale){
        if(scale<0){
            throw new IllegalArgumentException(
                "The scale must be a positive integer or zero");
        }
        BigDecimal b = new BigDecimal(Double.toString(v));
        BigDecimal one = new BigDecimal("1");
        return b.divide(one,scale,BigDecimal.ROUND_HALF_UP).doubleValue();
    }
}
</pre>
