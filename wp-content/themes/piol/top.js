jQuery(document).ready(function($){var flkefu=$("#shangxia").offset().top;$(window).scroll(function(){var offsetTop=flkefu+$(window).scrollTop()+"px";$("#shangxia").animate({top:offsetTop},{duration:500,queue:false})});$body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');$('#shang').click(function(){$body.animate({scrollTop:'0px'},400)});$('#comt').click(function(){$body.animate({scrollTop:$('#ds-reset').offset().top},800)});$('#xia').click(function(){$body.animate({scrollTop:$('#tail').offset().top},600)})});