// 滑动特效
$(function() {
	$("#featured .item").hover(function(){
		$(this).find(".boxCaption").stop().animate({
			top:0
		}, 150);
		}, function(){
		$(this).find(".boxCaption").stop().animate({
			top:160
		}, 600);
	});
});
// 滚屏
jQuery(document).ready(function($){
$('.scroll_t').click(function(){$('html,body').animate({scrollTop: '0px'}, 800);}); 
$('.scroll_c').click(function(){$('html,body').animate({scrollTop:$('.ct').offset().top}, 800);});
$('.scroll_b').click(function(){$('html,body').animate({scrollTop:$('.footer_bottom,.footer_bottom_a').offset().top}, 800);});
});
// context
$(document).ready(function(){
$('.entry_box_s ').hover(
	function() {
		$(this).find('.context_t').stop(true,true).fadeIn();
	},
	function() {
		$(this).find('.context_t').stop(true,true).fadeOut();
	}
);
});

// 头像
$(document).ready(function(){
$('#respond').hover(
	function() {
		$(this).find('.set_avatar').stop(true,true).fadeIn();
	},
	function() {
		$(this).find('.set_avatar').stop(true,true).fadeOut();
	}
);
});

 // 链接复制
function copy_code(text) {
  if (window.clipboardData) {
    window.clipboardData.setData("Text", text)
	alert("已经成功将原文链接复制到剪贴板！");
  } else {
	var x=prompt('你的浏览器可能不能正常复制\n请您手动进行：',text);
  }
}

// 评论贴图
function embedImage() {
  var URL = prompt('请输入图片 URL 地址:', 'http://');
  if (URL) {
    document.getElementById('comment').value = document.getElementById('comment').value + '[img]' + URL + '[/img]';
  }
}
// 控制贴图大小
$(document).ready(function() {
    var maxwidth=500;
    $(".commentlist img").each(function(){
        if (this.width>maxwidth)
         this.width = maxwidth;
    });
});
 // 关闭
function turnoff(obj){
document.getElementById(obj).style.display="none";
}
 // 文字滚动
    (function($){
    $.fn.extend({
    Scroll:function(opt,callback){
    if(!opt) var opt={};
    var _this=this.eq(0).find("ul:first");
    var        lineH=_this.find("li:first").height(),
    line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10),
    speed=opt.speed?parseInt(opt.speed,10):7000, //卷动速度，数值越大，速度越慢（毫秒）
    timer=opt.timer?parseInt(opt.timer,10):7000; //滚动的时间间隔（毫秒）
    if(line==0) line=1;
    var upHeight=0-line*lineH;
    scrollUp=function(){
    _this.animate({
    marginTop:upHeight
    },speed,function(){
    for(i=1;i<=line;i++){
    _this.find("li:first").appendTo(_this);
    }
    _this.css({marginTop:0});
    });
    }
    _this.hover(function(){
    clearInterval(timerID);
    },function(){
    timerID=setInterval("scrollUp()",timer);
    }).mouseout();
    }
    })
    })(jQuery);
    $(document).ready(function(){
    $(".bulletin").Scroll({line:1,speed:1000,timer:5000});//修改此数字调整滚动时间
    });
//加载中提示
$(document).ready(function(){
$('h3 a,.cat_post a,#scat a').click(function(){
$(this).text('正在给力加载中...');
window.location = $(this).attr('href');
});
});

//引用
$(function(){
    $("h4.backs").bind("click",function(){
	    var $content = $(this).next("div.track");
	    if($content.is(":visible")){
			$content.hide("200");
		}else{
			$content.show("200");
		}
	})
})

//提示
var titleToNote = {
 elements : ['a', 'img'],
 setup : function(){
 if(!document.getElementById || !document.createElement) return;
   var div = document.createElement("div");
   div.setAttribute("id", "title2note");
   document.getElementsByTagName("body")[0].appendChild(div);
   document.getElementById("title2note").style.display = "none";
   for(j=0;j<titleToNote.elements.length;j++){
     for(i=0;i<document.getElementsByTagName(titleToNote.elements[j]).length;i++){
       var el = document.getElementsByTagName(titleToNote.elements[j])[i];
       if(el.getAttribute("title") && el.getAttribute("title") != ""){
         el.onmouseover = titleToNote.showNote;
         el.onmouseout = titleToNote.hideNote;
       }
     }
   }
 },
 showNote : function()
 {
   document.getElementById("title2note").innerHTML = this.getAttribute("title");
   this.setAttribute("title", "");
   document.getElementById("title2note").style.display = "block";
 },
 hideNote : function()
 {
   this.setAttribute("title", document.getElementById("title2note").innerHTML);
   document.getElementById("title2note").innerHTML = "";
   document.getElementById("title2note").style.display = "none";
 }
} 
var oldonload=window.onload;if(typeof window.onload!='function'){
window.onload=titleToNote.setup;
}else{window.onload=function(){oldonload();
titleToNote.setup();}}

//Comments
$(document).ready(function(){
// 当鼠标聚焦
if($('#comment').val()==""){
$('#comment').val('留言是种美德，写点什么...').css({color:"#666"});}
$('#comment').focus(
function() {
if($(this).val() == '留言是种美德，写点什么...') {
$(this).val('').css({color:"#222"});
}
}
// 当鼠标失去焦点
).blur(
function(){
if($(this).val() == '') {
$(this).val('留言是种美德，写点什么...').css({color:"#666"});
}
}
);
});