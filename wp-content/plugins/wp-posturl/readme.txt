=== Plugin Name ===
Contributors: Easwy Yang
Donate link:
Tags: Posts, post, plugin, url, ads, copyright, credits, license
Requires at least: 2.7
Tested up to: 3.3.1
Stable tag: 2.1.0

This plugin allows you to insert a user specific text (such as copyright,
credit, advertisement, etc.) at the beginning/ending of your posts.

== Description ==

This plugin allows you to insert a user specific text at the beginning and/or
ending of all your posts.  The text can be a copyright declaration,
advertisement codes, etc. HTML codes are allowed.
You can select which pages (home/single/feed/category/tag/archive page) to
display the specific text. You also can decide which posts display the text.

It accepts following macros in user specific text:

* %site_url% - the URI of your site
* %site_name% - the name of your site
* %post_url% - the URI of the post where the text is displayed
* %post_title% - the title of the post where the text is displayed

If the header text is not empty, it will be inserted to the head of your posts;
otherwise no head text will be inserted.

If the footer text is not empty, it will be inserted to the foot of your posts;
otherwise no footer text will be inserted.

You can choose which pages to display the header text and/or footer text.
It includes:

* Blog Home - the header/footer text will be displayed on blog home
* Page      - the header/footer text will be displayed on pages
* Category  - the header/footer text will be displayed on category
* Tag       - the header/footer text will be displayed on tags
* Archive   - the header/footer text will be displayed on archives
* Single    - the header/footer text will be displayed on single
* Feed      - the header/footer text will be displayed in feed

When you add new post or edit post, you can decide whether or not to add the
header text and/or footer text to this post. You do this by selecting "Add Post
URL?" option in the editor page.  This option is saved as a Custom Field, named
"posturl_add_url".

For posts without this Custom Field (i.e., the existed posts before you use
WP-PostURL plugin), you can define the default behavior. If you select "Add
Header and/or Footer Text For Old Posts", then all posts without this Custom
Field will be added the header text and/or footer text; otherwise those posts
will not be added the header text and/or footer text. If some of those posts
are against with the default behavior, you need to re-edit this post to set
"Add Post URL?" option for those posts.

If you don't want to help promote WP-PostURL plugin, you can uncheck this
checkbox. The credit of WP-PostURL will not be displayed.

Links: [WP-PostURL Plugin Page](http://easwy.com/blog/wordpress/wp-posturl/ "WP-PostURL Plugin") | [Easwy's Blog (zh_CN)](http://easwy.com/blog/)

== Installation ==

1. Upload whole `wp-posturl` directory to the `/wp-content/plugins/` directory;
1. Activate the plugin through the 'Plugins' menu in WordPress;
1. Goto "Setting --> Add Post URL" page to define your user specific text and other options. The default setting is suitable for most of usage;
1. When you new a post or edit a post, you can change "Add Post URL?" option in the editor to decide whehter or not adding the header/footer text for this post.

Your original configuration will be totally kept during upgrading. But please
backup before upgrading to avoid configuration lost.

You can completely uninstall WP-PostURL plugin.
It will remove all the option settings created by this plugin, and deactive
this plugin at the same time. 

== Frequently Asked Questions ==

= Why my setting changes when I re-install/re-activate the plugin =

In release 2.1.0, the "Add Header and/or Footer Text For Old Posts" option
will always be enabled when you re-install/re-activate the plugin. The reason
is to fix the issue in release 2.0.x series. In release 2.0.x, this option is
not defined because of WordPress behavior changes for plugin updating.

= Why WP-PostURL Does Not Add Text To My Posts =

* In a word, please check if you select "Add Header and/or Footer Text For
Old Posts" option. If not, select it then have a look.
* Please check "Add Post URL?" option for posts you want the text to be added.
* If it still not work, make sure regenerate the cache if you use a WordPress
Cache Plugin (such as WP Super Cache), then have a look.

Here are some detail information for "Add Header and/or Footer Text For Old
Posts" option:

In release 2.0 and above, I add a new feature: allow user decide which posts
display the header and/or footer text. This will add a Custom Field, named
"posturl_add_url", for each new created post.
But for the posts you published before use WP-PostURL 2.0+, they do not have
Custom Field "posturl_add_url". For those posts, you need configure  "Add
Header and/or Footer Text For Old Posts" option. If you check this option,
all existed posts will be added the header and/or footer text; otherwise those
posts will not be added the header text and/or footer text. If some of those
posts are against with this default behavior, you need to re-edit this post to
set "Add Post URL?" option for those special posts.

== Screenshots ==

Please find screenshots at [WP-PostURL Plugin Page](http://easwy.com/blog/wordpress/wp-posturl/).

== Changelog ==

= 2.1.0 =

The following change list is against version 1.1:

* Fix: Set "Add Header and/or Footer For Old Posts" to true by default, to fix no header/footer in release 2.0.x. If you uncheck this option but re-install or re-activate this plugin, you need configure it again. The problem in 2.0.x is because of a WordPress behavior changes. Link: [Plugin activation hooks no longer fire for updates](http://wpdevel.wordpress.com/2010/10/27/plugin-activation-hooks-no-longer-fire-for-updates/)
* New: Add single post control function, allow user control which posts display the user specific text.
* New: Add default post control behavior for old posts.
* New: Keep compatible with QingFeng's origin change of post control function.

= 2.0.2 =

* (This version is obsolete)

= 2.0.1 =

* (This version is obsolete)

= 2.0 =

* (This version is obsolete)

= 1.1 =
* New: Allow user select which pages display the user specific texts.
* New: Allow user define the header text or footer text, or both.
* Fix: Fix configuration data lost when deactivated then activated again

= 1.0 =
* New: The basic function

= Thanks =

* I want to thanks [Lester "GaMerZ" Chan](http://lesterchan.net), the author of [WP-PageNavi](http://lesterchan.net/portfolio/programming/php/). Most
codes of this plugin are derived from his WP-PageNavi plugin.
* I also want to thanks [QingFeng](http://http://witmax.cn), he implement an essier version of post url control in [his post (zh_CN)](http://witmax.cn/wordpress-add-post-url.html).

== Upgrade Notice ==

* Your original configuration will be totally kept during upgrading. But please backup before upgrading to avoid configuration lost.

== TODO List ==

If you have any requirement about this plugin, please leave a comment on [WP-PostURL Plugin Page](http://easwy.com/blog/wordpress/wp-posturl/).

