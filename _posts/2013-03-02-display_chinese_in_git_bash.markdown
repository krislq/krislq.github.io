---
title:	"[转]windows下git bash显示中文"
date:	2013-03-02 11:34:36.0
categories:	[解决方案]
tags:	[git bash; git;windows]
---

可能许多人都需要在windows下使用git .那么git bash你一定不陌生。

最近在用的过程中也遇到一些问题，在网上找到此文章，觉得不错，于是转了过来。以备用 。

&nbsp;

1、C:\Program Files\Git\etc\git-completion.bash：
<p style="padding-left: 30px;"><span style="color: #0000ff;">alias ls='ls --show-control-chars --color=auto'</span></p>
<p style="padding-left: 30px;">说明：使得在 Git Bash 中输入 ls 命令，可以正常显示中文文件名。</p>
2、C:\Program Files\Git\etc\inputrc：
<p style="padding-left: 30px;"><span style="color: #0000ff;">set output-meta on</span>
<span style="color: #0000ff;"> set convert-meta off</span></p>
<p style="padding-left: 30px;">说明：使得在 Git Bash 中可以正常输入中文，比如中文的 commit log。</p>
<p style="padding-left: 30px;"><!--more--></p>
3、C:\Program Files\Git\etc\profile：
<p style="padding-left: 30px;"><span style="color: #0000ff;">export LESSCHARSET=utf-8</span></p>
<p style="padding-left: 30px;">说明：$ git log 命令不像其它 vcs 一样，n 条 log 从头滚到底，它会恰当地停在第一页，按 space 键再往后翻页。这是通过将 log 送给 less 处理实现的。以上即是设置 less 的字符编码，使得 $ git log 可以正常显示中文。其实，它的值不一定要设置为 utf-8，比如 latin1 也可以……。还有个办法是 $ git –no-pager log，在选项里禁止分页，则无需设置上面的选项。</p>
4、C:\Program Files\Git\etc\gitconfig：
<p style="padding-left: 30px;"><span style="color: #0000ff;">[gui]</span>
<span style="color: #0000ff;"> encoding = utf-8</span></p>
<p style="padding-left: 30px;">说明：我们的代码库是统一用的 utf-8，这样设置可以在 git gui 中正常显示代码中的中文。</p>
<p style="padding-left: 30px;"><span style="color: #0000ff;">[i18n]</span>
<span style="color: #0000ff;"> commitencoding = GB2312</span></p>
<p style="padding-left: 30px;">说明：如果没有这一条，虽然我们在本地用 $git log 看自己的中文修订没问题，但，一、我们的 log 推到服务器后会变成乱码；二、别人在 Linux 下推的中文 log 我们 pull 过来之后看起来也是乱码。这是因为，我们的 commit log 会被先存放在项目的 .git/COMMIT_EDITMSG 文件中；在中文 Windows 里，新建文件用的是 GB2312 的编码；但是 Git 不知道，当成默认的 utf-8 的送出去了，所以就乱码了。有了这条之后，Git 会先将其转换成 utf-8，再发出去，于是就没问题了。</p>
可以设置git默认为其它编辑器：
<p style="padding-left: 30px;"><em id="__mceDel">
</em><span style="color: #0000ff;">$ git config --global core.editor "notepad"</span></p>
<p style="padding-left: 30px;">其中 notepad 可以替换为更好用的 wordpad、notepad++ 等（不过它们在命令行里无法直接访问，得先设置 PATH 变量）。</p>
<p style="padding-left: 30px;">原文：http://blog.csdn.net/self001/article/details/7337182</p>
