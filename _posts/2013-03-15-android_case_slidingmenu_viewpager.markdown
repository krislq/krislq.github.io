---
title:	"【Android实例】通过SlidingMenu+Viewpager实现当前最流行的侧滑(二)"
date:	2013-03-15 14:40:14.0
categories:	[开发,Android,随手实例]
tags:	[Android,Fragment,viewpager]
---

<a href="http://www.krislq.com/wp-content/uploads/2013/03/slidingmenu_viewpage.png"><img class="size-full wp-image-663 aligncenter" alt="slidingmenu_viewpage" src="http://www.krislq.com/wp-content/uploads/2013/03/slidingmenu_viewpage.png" width="700" height="250" /></a>

&nbsp;
<p style="padding-left: 30px;">上一节，我们通过SlidingMenu+Fragment来实现了当前最流行的侧滑，具体连接如下：<a title="【Android实例】通过SlidingMenu+Fragment实现当前最流行的侧滑" href="http://www.krislq.com/2013/03/android_case_slidingmenu_fragment/">http://www.krislq.com/2013/03/android_case_slidingmenu_fragment/</a>
本文主要是在前一个例子中进行了一些改进，不仅仅只使用fragment , 而我们很多实际的应用场景中我们需要一个更复杂的场景，比如说需要在一个菜单选项中集成多个tab来集中显示信息。这个时候 Viewpager就派上用场了。</p>
<p style="padding-left: 30px;"><!--more-->
添加slidingMenu的步骤我就不再重复了，可以看看上篇文章 ，编码为UTF-8 .</p>
<p style="padding-left: 30px;">上一个实例中，我们点击么二个菜单，只是显示一个简单的fragment ,这次我们将把它改造成Viewpager+Fragment模式。在运行实例的时候，可以通过点击“Menu:ViewPager”菜单来看具体的效果。</p>
<p style="padding-left: 30px;">首先我们需要添加一个PagerAdapter来自动适配Tab里面的Fragment ,就像ListView中的BaseAdapter差不多，只是需要实现的方法有一些区别。</p>
DemoFragmentAdapter.java
<pre lang="java">
public class DemoFragmentAdapter extends PagerAdapter {
    private final FragmentManager mFragmentManager;
    private FragmentTransaction mTransaction = null;
    private List<ContentFragment> mFragmentList = new ArrayList<ContentFragment>(4);
    
    public DemoFragmentAdapter(FragmentManager fm) {
        mFragmentManager = fm;
        mFragmentList.add(new ContentFragment("ViewPager#Frist"));
        mFragmentList.add(new ContentFragment("ViewPager#Second"));
        mFragmentList.add(new ContentFragment("ViewPager#Third"));
    }
    @Override
    public int getCount() {
        return mFragmentList.size();
    }

    @Override
    public boolean isViewFromObject(View view, Object object) {
        return ((Fragment) object).getView() == view;
    }

    @Override
    public Object instantiateItem(ViewGroup container, int position) {
        if (mTransaction == null) {
            mTransaction = mFragmentManager.beginTransaction();
        }
        String name = getTag(position);
        Fragment fragment = mFragmentManager.findFragmentByTag(name);
        if (fragment != null) {
            mTransaction.attach(fragment);
        } else {
            fragment = getItem(position);
            mTransaction.add(container.getId(), fragment,
                    getTag(position));
        }
        return fragment;
    }

    @Override
    public void destroyItem(ViewGroup container, int position, Object object) {
        if (mTransaction == null) {
            mTransaction = mFragmentManager.beginTransaction();
        }
        mTransaction.detach((Fragment) object);
    }
    @Override
    public void finishUpdate(ViewGroup container) {
        if (mTransaction != null) {
            mTransaction.commitAllowingStateLoss();
            mTransaction = null;
            mFragmentManager.executePendingTransactions();
        }
    }
    public Fragment getItem(int position){
       return  mFragmentList.get(position);
    }
    public long getItemId(int position) {
        return position;
    }
    protected  String getTag(int position){
        return mFragmentList.get(position).getText();
    }
}
</pre>
&nbsp;
<p style="padding-left: 30px;">代码解释：</p>
<p style="padding-left: 60px;">instantiateItem 此方法返回一个对象，告诉PagerAdapter选择哪一个对象
destroyItem 此方法是移当前Object
finishUpdate 是在UI更新完成后的动作
isViewFromObject 判断是否由对象生成 view ,一般写法都比较固定</p>
<p style="padding-left: 30px;">适配器写完了，接下来就是如何使用它了。我们知道在显示的时候是通过第二个菜单点击的。
我们重点来看一下第二个菜单点击后的动作即可：</p>

<pre lang="java">
else if("b".equals(key)) {
	if(index == 1) {
		((MainActivity)getActivity()).getSlidingMenu().toggle();
		return true;
	}
	index = 1;
	mFrameLayout.setVisibility(View.GONE);
	mViewPager.setVisibility(View.VISIBLE);
	
	DemoFragmentAdapter demoFragmentAdapter = new DemoFragmentAdapter(mActivity.getFragmentManager());
	mViewPager.setOffscreenPageLimit(5);
	mViewPager.setAdapter(demoFragmentAdapter);
	mViewPager.setOnPageChangeListener(onPageChangeListener);
	
	ActionBar actionBar = mActivity.getActionBar();
	actionBar.setNavigationMode(ActionBar.NAVIGATION_MODE_TABS);
	actionBar.removeAllTabs();
	actionBar.addTab(actionBar.newTab()
			.setText("First Tab")
			.setTabListener(tabListener));

	actionBar.addTab(actionBar.newTab()
			.setText("Second Tab")
			.setTabListener(tabListener));
	actionBar.addTab(actionBar.newTab()
			.setText("Third Tab")
			.setTabListener(tabListener));
</pre>
<p style="padding-left: 30px;">代码解释：</p>
<p style="padding-left: 60px;">1. 先还是判断，如果当前Content里面显示的就是该菜单的内容，则直接显示内容。
2.接下来是把Viewpager显示出来。在这里需要注意的是，我们的Viewpager是单独定义的，与其它 Menu显示区域是不同的，并且也是不能同时显示的。具体的布局变化请看frame_content.xml,在这里就不再列出来了。
3.紧接着就是初始化DemoFragmentAdapter，并且设置给Viewpager
4.当然我们需要将我们的ActionBar设置成TAB模式，并且 添加上TAB的标题。</p>
<p style="padding-left: 30px;">在上面过程中有两个listener需要注意一下：</p>
<p style="padding-left: 30px;">1. SimpleOnPageChangeListener.该监听是当我们的viewpager页面切换的时候会触发 ，在里面我们会去改变 tab的聚焦情况 。因为实现上viewpager与actionbar是独立的，需要我们手动同步 。代码如下：</p>

<pre lang="java">

	    ViewPager.SimpleOnPageChangeListener onPageChangeListener = new ViewPager.SimpleOnPageChangeListener() {
        @Override
        public void onPageSelected(int position) {
            getActivity().getActionBar().setSelectedNavigationItem(position);
            switch (position) {
                case 0:
                    getSlidingMenu().setTouchModeAbove(SlidingMenu.TOUCHMODE_FULLSCREEN);
                    break;
                default:
                    getSlidingMenu().setTouchModeAbove(SlidingMenu.TOUCHMODE_MARGIN);
                    break;
            }
        }

    };
</pre>
<p style="padding-left: 30px;">代码解释：</p>
<p style="padding-left: 60px;">setSelectedNavigationItem 方法用于设置ActionBar的聚焦tab .
在接下来我们判断了SLidingMenu的手势力模式，如果ViewPager已经滑到了最左边，则我们把手势设置成全屏的，这样更往左滑动的时候，就会打开Menu .</p>
<p style="padding-left: 30px;">2.tabListener 主要是用来监听当我们自己点击tab改变页面的时候，那么我们Viewpager的内容也得随着改变。代码如下：</p>

<pre lang="java">
    ActionBar.TabListener tabListener = new ActionBar.TabListener() {
        @Override
        public void onTabSelected(ActionBar.Tab tab, FragmentTransaction ft) {
            if (mViewPager.getCurrentItem() != tab.getPosition())
                mViewPager.setCurrentItem(tab.getPosition());
        }

        @Override
        public void onTabUnselected(ActionBar.Tab tab, FragmentTransaction ft) {

        }

        @Override
        public void onTabReselected(ActionBar.Tab tab, FragmentTransaction ft) {

        }
    };

</pre>
<p style="padding-left: 30px;">代码解释：</p>
<p style="padding-left: 60px;">Viewpager可以直接设置当前的Item .</p>
<p style="padding-left: 30px;">到这里我们的讲解就算到了一段落了。
希望大用能经常使用这种模式。另外在3.0以下的系统中，support里面也提供了FragmentPagerAdapter ,使用方法比这个简单，大家就自己学着试用吧！</p>
<p style="padding-left: 30px;">代码来啰 。。。</p>

====================
<a href="http://www.krislq.com/wp-content/uploads/2013/03/SlidingMenu+Viewpager.zip">SlidingMenu+Viewpager</a>
====================
