/*
 * jQuery Easing v1.1 - http://gsgd.co.uk/sandbox/jquery.easing.php
 *
 * Uses the built in easing capabilities added in jQuery 1.1
 * to offer multiple easing options
 *
 * Copyright (c) 2007 George Smith
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */
jQuery.easing={easein:function(x,t,b,c,d){return c*(t/=d)*t+b},easeinout:function(x,t,b,c,d){if(t<d/2)return 2*c*t*t/(d*d)+b;var a=t-d/2;return-2*c*a*a/(d*d)+2*c*a/d+c/2+b},easeout:function(x,t,b,c,d){return-c*t*t/(d*d)+2*c*t/d+b},expoin:function(x,t,b,c,d){var a=1;if(c<0){a*=-1;c*=-1}return a*(Math.exp(Math.log(c)/d*t))+b},expoout:function(x,t,b,c,d){var a=1;if(c<0){a*=-1;c*=-1}return a*(-Math.exp(-Math.log(c)/d*(t-d))+c+1)+b},expoinout:function(x,t,b,c,d){var a=1;if(c<0){a*=-1;c*=-1}if(t<d/2)return a*(Math.exp(Math.log(c/2)/(d/2)*t))+b;return a*(-Math.exp(-2*Math.log(c/2)/d*(t-d))+c+1)+b},bouncein:function(x,t,b,c,d){return c-jQuery.easing['bounceout'](x,d-t,0,c,d)+b},bounceout:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b}},bounceinout:function(x,t,b,c,d){if(t<d/2)return jQuery.easing['bouncein'](x,t*2,0,c,d)*.5+b;return jQuery.easing['bounceout'](x,t*2-d,0,c,d)*.5+c*.5+b},elasin:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b},elasout:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b},elasinout:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b},backin:function(x,t,b,c,d){var s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},backout:function(x,t,b,c,d){var s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},backinout:function(x,t,b,c,d){var s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b},linear:function(x,t,b,c,d){return c*t/d+b}};

(function($){$.fn.lavaLamp=function(o){o=$.extend({fx:"linear",speed:500,click:function(){}},o||{});return this.each(function(){var b=$(this),noop=function(){},$back=$('<li class="back"><div class="left"></div></li>').appendTo(b),$li=$("li",this),curr=$("li.current-menu-item",this)[0]||$($li[0]).addClass("current-menu-item")[0];$li.not(".back").hover(function(){move(this)},noop);$(this).hover(noop,function(){move(curr)});$li.click(function(e){setCurr(this);return o.click.apply(this,[e,this])});setCurr(curr);function setCurr(a){$back.css({"left":a.offsetLeft+"px","width":a.offsetWidth+"px"});curr=a};function move(a){$back.each(function(){$(this).dequeue()}).animate({width:a.offsetWidth,left:a.offsetLeft},o.speed,o.fx)}})}})(jQuery);

jQuery(document).ready(function ($) {
    $("#menu ul:eq(0)").lavaLamp({
        fx: "easeout",
        speed: 500
    });
    var sTip = '搜索...';
    $("#s").val(sTip).addClass("tip");
    $("#s").focus(function () {
        if ($(this).val() == sTip) {
            $(this).val('').removeClass("tip");
        }
    });
    $("#s").blur(function () {
        if ($(this).val() == "") {
            $(this).val(sTip).addClass("tip");
        }
    });
    $("#searchsubmit").click(function () {
        if ($("#s").val() == sTip || $("#s").val() == "") {
            return false;
        }
    });
	$("a[href*='#']").click(function() {
		var urlTemp = window.location.href.split("#");
            url = urlTemp[0];
		var thisurlTemp = $(this).attr("href").split("#");
            thisurl = thisurlTemp[0];
		var target = $(this.hash);
        if ( ((url == thisurl) || thisurl == "" ) && target.length) {
			$("html,body").animate({ scrollTop: target.offset().top - 10 }, 400, "easeout");
			return false;
		}
	});
    $("#gotop").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, "slow", "easeout");
        return false;
    })
});