---
title:	"【Android实例】通过SlidingMenu+Fragment实现当前最流行的侧滑"
date:	2013-03-12 16:09:06.0
categories:	[开发,随手实例]
tags:	[SlidingMenu,Fragment,layout,特效]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/03/slidingmenu_fragment.png"><img class="alignnone size-full wp-image-654" alt="slidingmenu_fragment" src="http://www.krislq.com/wp-content/uploads/2013/03/slidingmenu_fragment.png" width="700" height="250" /></a>
<strong>内容简介：</strong>
<p style="padding-left: 30px;">通过SlidingMenu库与Fragment来实现当前最为流行的侧滑模式。其实涉及到的知识点有：</p>
<p style="padding-left: 60px;">1.SlidingMenu
2.Fragment</p>
<p style="padding-left: 90px;">通过layout构建一个Fragment
通过preference 来构建Fragment</p>
 <!--more-->
<strong>准备工作：</strong>
<p style="padding-left: 30px;">1. SlidingMenu 下载地址： https://github.com/jfeinstein10/SlidingMenu
2.下载好后，导入到我们eclipse(也可以新建一个项目，将SlidingMenu项目拷进去)
3. 需要将SlidingMenu设置成is libray.因为我们需要在我们的demo中导入SlidingMenu。</p>
当然，以上步骤，如果你下载了我的源码，你可以不用做啦。呵呵

<strong>接下来</strong>就是建立我们自己的demo项目啦。
(新建项目过程省略200字，如果你下载了我的源码，你只需要需要入项目即可)
<p style="padding-left: 30px;">首先我们需要准备两个界面的布局，一个是SlidingMenu的布局，也就是我们侧边栏的。另外一个为我们右边正文的显示布局。
在这里需要说明一下的是， 这两个布局为Activity布局(我们可以理解成为框架的布局文件)，而我们真正的Sliding和右边正文显示的内容是由Fragment提供的，那时 Fragment也有自己的布局文件，在 Fragment显示在Activity中时，会将自己的Fragment布局嵌入到Activity布局中。
对于Fragment 的内容，大家自行学习一下就行了，特别是他的生命周期千万别与Activity混淆。</p>
frame_menu.xml
<pre lang="xml">
<?xml version="1.0" encoding="utf-8"?>
<FrameLayout xmlns:android="http://schemas.android.com/apk/res/android"
    android:id="@+id/menu"
    android:layout_width="match_parent"
    android:layout_height="match_parent" />
</pre>

frame_content.xml
<pre lang="xml">
<?xml version="1.0" encoding="utf-8"?>
<FrameLayout xmlns:android="http://schemas.android.com/apk/res/android"
    android:id="@+id/content"
    android:layout_width="match_parent"
    android:layout_height="match_parent" />
</pre>

<p style="padding-left: 30px;">Activity布局文件准备好了后，我们需要新建一个 Activity来继承SlidingActivity，则这个activity将会提供一个 sliding 菜单 ，和正文的显示 。</p>
MainActivity.java
<pre lang="java">
public class MainActivity extends SlidingActivity {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setTitle("SlidingMenu Demo");
        setContentView(R.layout.frame_content);
        
     // set the Behind View
        setBehindContentView(R.layout.frame_menu);
        FragmentTransaction fragmentTransaction = getFragmentManager().beginTransaction();
        MenuFragment menuFragment = new MenuFragment();
        fragmentTransaction.replace(R.id.menu, menuFragment);
        fragmentTransaction.replace(R.id.content, new ContentFragment("Welcome"));
        fragmentTransaction.commit();

        // customize the SlidingMenu
        SlidingMenu sm = getSlidingMenu();
        sm.setShadowWidth(50);
        sm.setShadowDrawable(R.drawable.shadow);
        sm.setBehindOffset(60);
        sm.setFadeDegree(0.35f);
        //设置slding menu的几种手势模式
        //TOUCHMODE_FULLSCREEN 全屏模式，在content页面中，滑动，可以打开sliding menu
        //TOUCHMODE_MARGIN 边缘模式，在content页面中，如果想打开slding ,你需要在屏幕边缘滑动才可以打开slding menu
        //TOUCHMODE_NONE 自然是不能通过手势打开啦
        sm.setTouchModeAbove(SlidingMenu.TOUCHMODE_MARGIN);

        //使用左上方icon可点，这样在onOptionsItemSelected里面才可以监听到R.id.home
        getActionBar().setDisplayHomeAsUpEnabled(true);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.activity_main, menu);
        return true;
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
        case android.R.id.home:
            //toggle就是程序自动判断是打开还是关闭
            toggle();
//          getSlidingMenu().showMenu();// show menu
//          getSlidingMenu().showContent();//show content
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
}
</pre>

<p style="padding-left: 30px;">解释：
代码中有详细的解释，就不再多说了。下面有几个需要注意的地方：</p>
<p style="padding-left: 60px;">1.<span style="color: #008000;">setContentView</span>() 设置我们正文的显示布局，这和我们正常的Activity是一样的。
2.<span style="color: #008000;">setBehindContentView</span>() 设置SlidingMeni的布局。
3.<span style="color: #008000;">FragmentTransaction</span>类主要用于管理Fragment,有添加，替换，删除等操作。尤其是beginTransaction()与commit()方法与SQL中的事务有点类似。相信大家理解不难。如果需要更多详细信息，自行搜索。
4.<span style="color: #008000;">SlidingMenu</span> 可以设置Sliding的一些属性，像shadowwidth , shadowDrable等等根据英语解释大家都应该知道用处。可以自行设置看看效果。
5.<span style="color: #008000;">SlidingMenu</span>.<span style="color: #008000;">setTouchModeAbove</span>().其中一共包含三中手势模式：</p>
<p style="padding-left: 90px;"><span style="color: #008000;">TOUCHMODE_FULLSCREEN</span> 全屏模式，在正文布局中通过手势也可以打开SlidingMenu
<span style="color: #008000;">TOUCHMODE_MARGIN</span> 边缘模式，在正文布局的边缘处通过手势可以找开SlidingMenu
<span style="color: #008000;">TOUCHMODE_NONE</span> 自然是不能通过手势打开SlidingMenu了</p>
<p style="padding-left: 60px;">6.<span style="color: #008000;">toggle</span>() 是SldingMenu自动判断当前是打开还是关闭。
7.需要注意的是继承了SlidingActivity后，需要把oncreate修改成public
8.setBehindOffset()为设置SlidingMenu打开后，右边留下的宽度。大家可以把这个值写在dimens里面去:</p>
<p style="padding-left: 60px;">这样就可以带上dp单位，可以适应多分辨率了。不然有些手机上面右边留出的多，有的少。</p>
<p style="padding-left: 30px;"><span style="color: #ff0000;"><strong>注意：</strong></span>SlidingMenu非常的强大 ，可以为左右同时设置SlidingMenu，也可以设置打开Menu时的动画 。具体可以参与SlidingMenu 的源码。我们要信息，在源码面前没有秘密 。</p>
<p style="padding-left: 30px;">在MainActivity中，我们看到了我们的正文是由ContentFragment来填充内容的。SlidingMenu是由MenuFragment来填充内容的。
在这里需要说明一下的是，在ContentFragment中我们是通过一般的layout文件来构成的Fragment .
MenuFragment是由prefrence Fragment来完成我们的菜单内容的。</p>
关于这两个Fragment的布局文件也直接跳过了，帖出来也是占用我们宝贵的网络资源。我们先来看看MenuFragment代码 ：

MenuFragment.java
<pre lan="java">
public class MenuFragment extends PreferenceFragment implements OnPreferenceClickListener{
    int index = -1;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        // TODO Auto-generated method stub
        super.onCreate(savedInstanceState);
        //set the preference xml to the content view
        addPreferencesFromResource(R.xml.menu);
        //add listener
        findPreference("a").setOnPreferenceClickListener(this);
        findPreference("b").setOnPreferenceClickListener(this);
        findPreference("n").setOnPreferenceClickListener(this);
    }

    @Override
    public boolean onPreferenceClick(Preference preference) {
        String key = preference.getKey();
        if("a".equals(key)) {
            //if the content view is that we need to show . show directly
            if(index == 0) {
                ((MainActivity)getActivity()).getSlidingMenu().toggle();
                return true;
            }
            //otherwise , replace the content view via a new Content fragment
            index = 0;
            FragmentManager fragmentManager = ((MainActivity)getActivity()).getFragmentManager();
            fragmentManager.beginTransaction()
            .replace(R.id.content, new ContentFragment("This is A Menu"))
            .commit();
        }else if("b".equals(key)) {
            if(index == 1) {
                ((MainActivity)getActivity()).getSlidingMenu().toggle();
                return true;
            }
            index = 1;
            FragmentManager fragmentManager = ((MainActivity)getActivity()).getFragmentManager();
            fragmentManager.beginTransaction()
            .replace(R.id.content, new ContentFragment("This is B Menu"))
            .commit();
        }else if("n".equals(key)) {

            if(index == 2) {
                ((MainActivity)getActivity()).getSlidingMenu().toggle();
                return true;
            }
            index = 2;
            FragmentManager fragmentManager = ((MainActivity)getActivity()).getFragmentManager();
            fragmentManager.beginTransaction()
            .replace(R.id.content, new ContentFragment("This is N Menu"))
            .commit();
        }
        //anyway , show the sliding menu
        ((MainActivity)getActivity()).getSlidingMenu().toggle();
        return false;
    }
}
</pre>
&nbsp;
<p style="padding-left: 30px;">代码解释：</p>
<p style="padding-left: 60px;">1.Fragment的生命周期参考下图：
<a href="http://www.krislq.com/wp-content/uploads/2013/03/fregemt生命周期png.png"><img src="http://www.krislq.com/wp-content/uploads/2013/03/fregemt生命周期png.png" alt="fregemt生命周期png" width="317" height="847" class="alignnone size-full wp-image-657" /></a>
2.onCreate中完成了Preference布局的添加与设置各个选项的监听
3.在onPreferenceClick()方法中，我们先判断当前正文显示的是不是该选项的内容，如果是，则不用再去跳转了。如果不是，再从FragmentManager里面看能否找出已经存在的可用的fragment。如果没有，再创建新的fragment</p>
ContentFragment就比较简单了,我们主要是在onCreateView()方法中创建我们的view ,并返回就可以了
ContentFragment.java
<pre lang="java">
public class ContentFragment extends Fragment {
    String text = null;

    public ContentFragment() {
    }

    public ContentFragment(String text) {
        Log.e("Krislq", text);
        this.text = text;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setRetainInstance(true);
        Log.e("Krislq", "onCreate:"+text);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        Log.e("Krislq", "onCreateView:"+ text);
        //inflater the layout 
        View view = inflater.inflate(R.layout.fragment_text, null);
        TextView textView =(TextView)view.findViewById(R.id.textView);
        if(!TextUtils.isEmpty(text)) {
            textView.setText(text);
        }
        return view;
    }
}
</pre>

好的，如果大家还有什么疑问，留言吧。
源码来了。

===============
<a href="http://www.krislq.com/wp-content/uploads/2013/03/SlidingMenu+Fragment.zip">SlidingMenu+Fragment</a>
===============

<strong>下期实例预告：</strong> SlidingMenu+ViewPager+fragment
