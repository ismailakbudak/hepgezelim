//////////////////////////////////////////////////
/*************************************************
**************************************************
**    
**    DEVELOPER : ismail AKBUDAK  WEB & MOBIL DEVELOPER
**
**    CONTACT   :  www.ismailakbudak.com 
**    LINKEDIN  : http://www.linkedin.com/pub/ismail-akbudak/56/a57/40b
**    FACEBOOK  : https://www.facebook.com/isoakbudak
**    TWITTER   : https://twitter.com/isoakbudak
**    GOOGLE+   : https://plus.google.com/u/0/100985583645011477288/posts
**    
**    EXPLAIN   : You can use this code block free 
**                BUT LEARN, DEVELOP AND SHARE  
**                THIS IS MY PRINCIPLE
**    
**    UPDATE    : 04-11-2013 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////

(function($) {
	$.msgGrowl = function(config) {
		
		var defaults, options, container, msgGrowl, content, title, text, close;

		defaults = {
			  type: ''
			, element: 'body' 
			, title: ''
			, text: ''
			, lifetime: 4000
			, sticky: false
			, position: 'bottom-right'
			, closeTrigger: true
			, onOpen: function () {}
			, onClose: function () {}
		};
		
		options = $.extend(defaults, config);
		
		container = $('.msgGrowl-container.' + options.position);
		
		if (!container.length) {
			container = $('<div>', {
				'class': 'msgGrowl-container ' + options.position
			}).appendTo (options.element);
		}
		
		msgGrowl = $('<div>', {
			'class': 'msgGrowl ' + options.type
		});
		//alert(options.type);
			
		content = $('<div>', {
			'class': 'msgGrowl-content'
		}).appendTo (msgGrowl);	
			
		text = $('<span>', {
			text: options.text
		}).appendTo (content);
		
		if (options.closeTrigger) {
			close = $('<div>', {
				'class': 'msgGrowl-close'
				, 'click': function (event) { 
					event.preventDefault();
					event.stopPropagation(); 
					$(this).parent ().fadeOut ('medium', function () { 
						$(this).remove (); 
						if (typeof options.onClose === 'function') {
							options.onClose ();
						}
						if( $('.msgGrowl-container').find('.msgGrowl').length == 0){
                         $('.msgGrowl-container').remove();
                        }  
					});
				}
			}).appendTo (msgGrowl);
		}
		
		if (options.title != '') {
			title = $('<h4>', {
				text: options.title
			}).prependTo (content);
		}
		
		if (options.lifetime > 0 && !options.sticky) {
			setTimeout (function () {
				if (typeof options.onClose === 'function') {
					options.onClose ();
				}
				msgGrowl.fadeOut ('medium', function () { 
					$(this).remove ();
                    if( $('.msgGrowl-container').find('.msgGrowl').length == 0){
                         $('.msgGrowl-container').remove();
                     } 
               });		
			}, options.lifetime);			
		}		
		
		container.addClass (options.position);
		
		if (options.position.split ('-')[0] == 'top') {
			msgGrowl.prependTo (container).hide ().fadeIn ('slow');
		} else {
			msgGrowl.appendTo (container).hide ().fadeIn ('slow');	
		}
		
		if (typeof options.onOpen === 'function') {
			options.onOpen ();
		}
	}
})(jQuery);




/*! 
 *  kullanıldı
 * jQuery MsgBox - for jQuery 1.3+
 * http://codecanyon.net/item/jquery-msgbox/92626?ref=aeroalquimia
 *
 * Copyright (c) 2013, Eduardo Daniel Sada
 * Released under CodeCanyon Regular License.
 * http://codecanyon.net/licenses/regular
 *
 * Version: 1.3.6 (Mar 02 2013)
 */

;eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(9($){v m=!$.2C.1E;8($.q===Q){$.11({q:9(a,b){8(a){q=9(){F a.2B(b||4,2M)}};F q}})};$.11($.2A,{21:9(x,t,b,c,d,s){8(s===Q)s=1;F c*((t=t/d-1)*t*((s+1)*t+s)+1)+b}});$.11($.2D[\':\'],{w:9(a){F $(a).2t()}});$.11({1v:{2s:{r:\'2o-B\',K:2H,C:2U,E:\'1K\',1c:\'#2E\',1Y:P,L:{\'1c-1L\':\'#3k\',\'1E\':0.5},1B:2F,1i:1l,1N:2Y,16:{\'2n\':10,\'20\':1l,\'Z\':\'21\',\'2m\':2},p:{\'12\':N,\'1f\':\'#\',\'1a\':\'1D\'},2l:\'X\'},6:{},7:{B:[],Y:[],p:[],U:[],V:[]},1g:N,i:0,1A:N,22:9(a){4.6=$.11(P,4.6,a);4.L.A.u(4.6.L);4.L.6.1J=!4.6.1Y;4.7.B.u({\'C\':4.6.C,\'E\':4.6.E,\'1c-1L\':4.6.1c});4.17()},L:{1s:9(b){4.6=b;4.A=$(\'<T 2j="\'+2i 2h().2f()+\'"></T>\');4.A.u($.11({},{\'W\':\'3o\',\'X\':0,\'J\':0,\'1E\':0,\'18\':\'1m\',\'z-2c\':4.6.K},4.6.1V));4.A.1h($.q(9(a){8(4.6.1J){8($.1Z(4.6.1j)){4.6.1j()}G{4.1k()}}a.1d()},4));4.1q=P;4.2a();F 4},2a:9(){4.1G=$(1r.1P);4.1G.M(4.A);8(m){4.A.u({\'W\':\'1t\'});v a=2N(4.A.u(\'K\'));8(!a){a=1;v b=4.A.u(\'W\');8(b==\'2Q\'||!b){4.A.u({\'W\':\'2S\'})}4.A.u({\'K\':a})}a=(!!(4.6.K||4.6.K===0)&&a>4.6.K)?4.6.K:a-1;8(a<0){a=1}4.O=$(\'<2V 2j="2X\'+2i 2h().2f()+\'" 3E="2Z" 30=0 33=""></T>\');4.O.u({K:a,W:\'1t\',X:0,J:0,1u:\'1m\',C:0,E:0,1E:0});4.O.36(4.A);$(\'3e, 1P\').u({\'E\':\'1l%\',\'C\':\'1l%\',\'29-J\':0,\'29-3n\':0})}},15:9(x,y){4.A.u({\'E\':0,\'C\':0});8(4.O)4.O.u({\'E\':0,\'C\':0});v a={x:$(1r).C(),y:$(1r).E()};4.A.u({\'C\':\'1l%\',\'E\':y?y:a.y});8(4.O){4.O.u({\'E\':0,\'C\':0});4.O.u({\'W\':\'1t\',\'J\':0,\'X\':0,\'C\':4.A.C(),\'E\':y?y:a.y})}F 4},14:9(){8(!4.1q)F 4;8(4.Z)4.Z.1M();4.1G.S(\'15\',$.q(4.15,4));4.15();8(4.O)4.O.u({\'18\':\'26\'});4.1q=N;4.Z=4.A.2G(4.6.1B,$.q(9(){4.A.1O(\'14\')},4));F 4},1k:9(){8(4.1q)F 4;8(4.Z)4.Z.1M();4.1G.2I(\'15\');8(4.O)4.O.u({\'18\':\'1m\'});4.1q=P;4.Z=4.A.2L(4.6.1i,$.q(9(){4.A.1O(\'1k\');4.A.u({\'E\':0,\'C\':0})},4));F 4}},1s:9(){4.6=$.11(P,4.2s,4.6);4.L.1s({1V:4.6.L,1J:!4.6.1Y,K:4.6.K-1,1B:4.6.1B,1i:4.6.1i});4.7.B=$(\'<T I="\'+4.6.r+\'"></T>\');4.7.B.u({\'18\':\'1m\',\'W\':\'1t\',\'X\':0,\'J\':0,\'C\':4.6.C,\'E\':4.6.E,\'z-2c\':4.6.K,\'25-2O\':\'2P-25\',\'-24-1R-1S\':\'0 0 1T 1U(0, 0, 0, 0.5)\',\'-2k-1R-1S\':\'0 0 1T 1U(0, 0, 0, 0.5)\',\'1R-1S\':\'0 0 1T 1U(0, 0, 0, 0.5)\',\'-24-1u-1W\':\'1X\',\'-2k-1u-1W\':\'1X\',\'1u-1W\':\'1X\',\'1c-1L\':4.6.1c});4.7.Y=$(\'<T I="\'+4.6.r+\'-Y"></T>\');4.7.B.M(4.7.Y);4.7.p=$(\'<p 1f="\'+4.6.32+\'" 1a="1D"></p>\');4.7.Y.M(4.7.p);4.7.Y.u({E:(m?1F:\'1K\'),\'34-E\':1F,\'35\':1});$(\'1P\').M(4.7.B);4.23();F 4.7.B},23:9(){$(1b).S(\'15\',$.q(9(){8(4.1g){4.L.15();4.17()}},4));$(1b).S(\'37\',$.q(9(){8(4.1g){4.17()}},4));4.7.B.S(\'38\',$.q(9(a){8(a.39==27){4.19(N)}},4));4.7.p.S(\'R\',$.q(9(a){$(\'13[n=R]:1C, D[n=R]:1C, D:1C\',4.7.p).1O(\'1h\');8(!6.p.12){a.1d()}},4));4.L.A.S(\'14\',$.q(9(){$(4).28(\'14\')},4));4.L.A.S(\'1k\',$.q(9(){$(4).28(\'19\')},4))},14:9(g,h,j){v k=[\'2b\',\'2J\',\'2K\',\'1e\',\'2d\'];4.7.B.2e(4.6.r,$.q(9(c){h=$.11(P,{n:\'2b\',p:{\'12\':N}},h||{});8(1z h.U==="Q"){8(h.n==\'2d\'||h.n==\'1e\'){v d=[{n:\'R\',w:\'2g\'},{n:\'1n\',w:\'2R\'}]}G{v d=[{n:\'R\',w:\'2g\'}]}}G{v d=h.U};8(1z h.V==="Q"&&h.n==\'1e\'){v f=[{n:\'2T\',r:\'1e\',w:\'\'}]}G{v f=h.V};4.1j=$.1Z(j)?j:9(e){};8(1z f!=="Q"){4.7.V=$(\'<T I="\'+4.6.r+\'-V"></T>\');4.7.p.M(4.7.V);$.1y(f,$.q(9(i,a){8(a.n==\'2W\'){1H=a.H?\'<H I="\'+4.6.r+\'-H">\':\'\';1w=a.H?a.H+\'</H>\':\'\';a.w=a.w===Q?\'1\':a.w;1I=a.r===Q?4.6.r+\'-H-\'+i:a.r;4.7.V.M($(1H+\'<13 n="\'+a.n+\'" 1V="18:31; C:1K;" r="\'+1I+\'" w="\'+a.w+\'" 2p="2q"/> \'+1w))}G{1H=a.H?\'<H I="\'+4.6.r+\'-H">\'+a.H:\'\';1w=a.H?\'</H>\':\'\';a.w=a.w===Q?\'\':a.w;2r=a.1o===Q||a.1o==N?\'\':\'1o="P"\';1I=a.r===Q?4.6.r+\'-H-\'+i:a.r;4.7.V.M($(1H+\'<13 n="\'+a.n+\'" r="\'+1I+\'" w="\'+a.w+\'" 2p="2q" \'+2r+\'/>\'+1w))}},4))}4.7.U=$(\'<T I="\'+4.6.r+\'-U"></T>\');4.7.p.M(4.7.U);8(h.p.12){4.7.p.1x(\'1f\',h.p.1f===Q?\'#\':h.p.1f);4.7.p.1x(\'1a\',h.p.1a===Q?\'1D\':h.p.1a);4.6.p.12=P}G{4.7.p.1x(\'1f\',\'#\');4.7.p.1x(\'1a\',\'1D\');4.6.p.12=N}8(h.n!=\'1e\'){$.1y(d,$.q(9(i,a){8(a.n==\'R\'){4.7.U.M($(\'<D n="R" I="\'+4.6.r+\'-D-R \'+(a["I"]||"")+\'">\'+a.w+\'</D>\').S(\'1h\',$.q(9(e){4.19(a.w);e.1d()},4)))}G 8(a.n==\'1n\'){4.7.U.M($(\'<D n="D" I="\'+4.6.r+\'-D-1n \'+(a["I"]||"")+\'">\'+a.w+\'</D>\').S(\'1h\',$.q(9(e){4.19(N);e.1d()},4)))}},4))}G 8(h.n==\'1e\'){$.1y(d,$.q(9(i,a){8(a.n==\'R\'){4.7.U.M($(\'<D n="R" I="\'+4.6.r+\'-D-R \'+(a["I"]||"")+\'">\'+a.w+\'</D>\').S(\'1h\',$.q(9(e){8($(\'13[1o="P"]:2u(:w)\').2v>0){$(\'13[1o="P"]:2u(:w):1C\').2w();4.16()}G 8(4.6.p.12){F P}G{4.19(4.2x($(\'13\',4.7.V)))}e.1d()},4)))}G 8(a.n==\'1n\'){4.7.U.M($(\'<D n="D" I="\'+4.6.r+\'-D-1n \'+(a["I"]||"")+\'">\'+a.w+\'</D>\').S(\'1h\',$.q(9(e){4.19(N);e.1d()},4)))}},4))};4.7.p.3a(g);$.1y(k,$.q(9(i,e){4.7.Y.3b(4.6.r+\'-\'+e)},4));4.7.Y.3c(4.6.r+\'-\'+h.n);4.17();4.1g=P;4.L.14();4.7.B.u({18:\'26\',J:(($(1r).C()-4.6.C)/2)});4.17();2y($.q(9(){v b=$(\'13, D\',4.7.B);8(b.2v){b.3d(0).2w()}},4),4.6.1N)},4));4.i++;8(4.i==1){4.7.B.2z(4.6.r)}},2x:9(b){F $.3f(b,9(a){F $(a).2t()})},17:9(){v a={x:$(1b).C(),y:$(1b).E()};v b={x:$(1b).3g(),y:$(1b).3h()};v c=4.7.B.3i();v y=0;v x=0;y=b.x+((a.x-4.6.C)/2);8(4.6.2l=="3j"){x=(b.y+a.y+1F)}G{x=(b.y-c)-1F}8(4.1g){8(4.1A){4.1A.1M}4.1A=4.7.B.1p({J:y,X:b.y+((a.y-c)/2)},{20:4.6.1N,2e:N,2A:\'21\'})}G{4.7.B.u({X:x,J:y})}},19:9(a){4.7.B.u({18:\'1m\',X:0});4.1g=N;8($.1Z(4.1j)){4.1j.2B(4,$.3l(a))}2y($.q(9(){4.i--;4.7.B.2z(4.6.r)},4),4.6.1i);8(4.i==1){4.L.1k()}4.17();4.7.p.3m()},16:9(){v x=4.6.16.2n;v d=4.6.16.20;v t=4.6.16.Z;v o=4.6.16.2m;v l=4.7.B.W().J;v e=4.7.B;3p(i=0;i<o;i++){e.1p({J:l+x},d,t);e.1p({J:l-x},d,t)};e.1p({J:l+x},d,t);e.1p({J:l},d,t)}},B:9(a,b,c){8(1z a=="3q"){$.1v.22(a)}G{F $.1v.14(a,b,c)}}});$(9(){8(3r($.3s.2o)>1.2){$.1v.1s()}G{3t"3u 1Q 3v 3w 3x 3y 3z 3A 3B. 3C 3D 1Q 1.3+";}})})(1Q);',62,227,'||||this||options|esqueleto|if|function||||||||||||||type||form|proxy|name|||css|var|value||||element|msgbox|width|button|height|return|else|label|class|left|zIndex|overlay|append|false|shim|true|undefined|submit|bind|div|buttons|inputs|position|top|wrapper|transition||extend|active|input|show|resize|shake|moveBox|display|close|method|window|background|preventDefault|prompt|action|visible|click|closeDuration|callback|hide|100|none|cancel|required|animate|hidden|document|create|absolute|border|MsgBoxObject|fLabel|attr|each|typeof|animation|showDuration|first|post|opacity|80|target|iLabel|iName|hideOnClick|auto|color|stop|moveDuration|trigger|body|jQuery|box|shadow|15px|rgba|style|radius|6px|modal|isFunction|duration|easeOutBackMin|config|addevents|moz|word|block||triggerHandler|margin|inject|alert|index|confirm|queue|getTime|Accept|Date|new|id|webkit|emergefrom|loops|distance|jquery|autocomplete|off|iRequired|defaults|val|not|length|focus|toArguments|setTimeout|dequeue|easing|apply|support|expr|FFFFFF|200|fadeIn|10000|unbind|info|error|fadeOut|arguments|parseInt|wrap|break|static|Cancel|relative|text|420|iframe|checkbox|IF_|550|no|frameborder|inline|formaction|src|min|zoom|insertAfter|scroll|keydown|keyCode|prepend|removeClass|addClass|get|html|map|scrollLeft|scrollTop|outerHeight|bottom|000000|makeArray|empty|right|fixed|for|object|parseFloat|fn|throw|The|version|that|was|loaded|is|too|old|MsgBox|requires|scrolling'.split('|'),0,{}));



//////////////////////////////////////////////////
/*************************************************
**************************************************
**    
**    DEVELOPER : ismail AKBUDAK  WEB & MOBIL DEVELOPER
**
**    CONTACT   :  www.ismailakbudak.com 
**    LINKEDIN  : http://www.linkedin.com/pub/ismail-akbudak/56/a57/40b
**    FACEBOOK  : https://www.facebook.com/isoakbudak
**    TWITTER   : https://twitter.com/isoakbudak
**    GOOGLE+   : https://plus.google.com/u/0/100985583645011477288/posts
**    
**    EXPLAIN   : You can use this code block free 
**                BUT LEARN, DEVELOP AND SHARE  
**                THIS IS MY PRINCIPLE
**    
**    UPDATE    : 04-11-2013 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////

$(function () {
	Application.init ();	
});

var Application = function () {
	
	var validationRules = getValidationRules ();
	
	return { init: init, validationRules: validationRules };
	
	function init () {
		
		enableBackToTop ();
		//enableLightbox ();
		//enableCirque ();
		enableEnhancedAccordion ();


		$('.ui-tooltip').tooltip();
	    $('.ui-popover').popover();
    

	}
/**
	function enableCirque () {
		if ($.fn.lightbox) {
			$('.ui-lightbox').lightbox ();
		}
	}

	function enableLightbox () {
		if ($.fn.cirque) {
			$('.ui-cirque').cirque ({  });
		}
	}
**/
	function enableBackToTop () {
		var backToTop = $('<a title="top" >', { id: 'back-to-top', href: '#top', title:goTop });
		//var icon = $('<i>', { class: 'icon-chevron-up' });

		backToTop.appendTo ('body');
		//icon.appendTo (backToTop);
		
	    backToTop.hide();

	    $(window).scroll(function () {
	        if ($(this).scrollTop() > 150) {
	            backToTop.fadeIn ();
	        } else {
	            backToTop.fadeOut ();
	        }
	    });

	    backToTop.click (function (e) {
	    	e.preventDefault ();

	        $('body, html').animate({
	            scrollTop: 0
	        }, 600);
	    });
	}
	
	function enableEnhancedAccordion () {
		$('.accordion-toggle').on('click', function (e) {			
	         $(e.target).parent ().parent ().parent ().addClass('open');
	    });
	
	    $('.accordion-toggle').on('click', function (e) {
	        $(this).parents ('.panel').siblings ().removeClass ('open');
	    });
	    
	}
	
	function getValidationRules () {
		var custom = {
	    	focusCleanup: false,
			
			wrapper: 'div',
			errorElement: 'span',
			
			highlight: function(element) {
				$(element).parents ('.form-group').removeClass ('success').addClass('error');
			},
			success: function(element) {
				$(element).parents ('.form-group').removeClass ('error').addClass('success');
				$(element).parents ('.form-group:not(:has(.clean))').find ('div:last').before ('<div class="clean"></div>');
			},
			errorPlacement: function(error, element) {
				error.prependTo(element.parents ('.form-group'));
			}
	    	
	    };
	    
	    return custom;
	}
	
}();


/*!
 * kullanılmadı
 * jQuery Lightbox Evolution - for jQuery 1.4+
 * http://codecanyon.net/item/jquery-lightbox-evolution/115655?ref=aeroalquimia
 *
 * Copyright (c) 2013, Eduardo Daniel Sada
 * Released under CodeCanyon Regular License.
 * http://codecanyon.net/licenses/regular
 *
 * Version: 1.8.0 (August 17 2013)
*/
/*
;(function($,A,B,C){var D=(function(u){return function(){return u.search(arguments[0])}})((navigator&&navigator.userAgent)?navigator.userAgent.toLowerCase():"");var E=false;var F=(function(){for(var a=3,b=B.createElement("b"),c=b.all||[];b.innerHTML="<!--[if gt IE "+ ++a+"]><i><![endif]-->",c[0];);return 4<a?a:B.documentMode})();var G=(function(){var b;var a;var c=B.createElement("div");c.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>";b=c.getElementsByTagName("*");a=c.getElementsByTagName("a")[0];if(!b||!a||!b.length){return{}}a.style.cssText="top:1px;float:left;opacity:.5";return{opacity:/^0.5/.test(a.style.opacity)}})();if(D("mobile")>-1){if(D("android")>-1||D("googletv")>-1||D("htc_flyer")>-1){E=true}};if(D("opera")>-1){if(D("mini")>-1&&D("mobi")>-1){E=true}};if(D("iphone")>-1){E=true};if(D("windows phone os 7")>-1){E=true};$.extend($.easing,{easeOutBackMin:function(x,t,b,c,d,s){if(s===C)s=1;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b}});if(typeof $.fn.live==="undefined"){$.fn.live=function(a,b,c){jQuery(this.context).on(a,this.selector,b,c);return this}}$.extend({LightBoxObject:{defaults:{name:'jquery-lightbox',style:{zIndex:99999,width:470,height:280},modal:false,overlay:{opacity:0.6},animation:{show:{duration:400,easing:"easeOutBackMin"},close:{duration:200,easing:"easeOutBackMin"},move:{duration:700,easing:"easeOutBackMin"},shake:{duration:100,easing:"easeOutBackMin",distance:10,loops:2}},flash:{width:640,height:360},iframe:{width:640,height:360},maxsize:{width:-1,height:-1},preload:true,emergefrom:"top",ajax:{type:"GET",cache:false,dataType:"html"}},options:{},animations:{},gallery:{},image:{},esqueleto:{lightbox:[],buttons:{close:[],prev:[],max:[],next:[]},background:[],image:[],title:[],html:[]},visible:false,maximized:false,mode:"image",videoregs:{swf:{reg:/[^\.]\.(swf)\s*$/i},youtu:{reg:/youtu\.be\//i,split:'/',index:3,iframe:1,url:"http://www.youtube.com/embed/%id%?autoplay=1&amp;fs=1&amp;rel=0&amp;enablejsapi=1"},youtube:{reg:/youtube\.com\/watch/i,split:'=',index:1,iframe:1,url:"http://www.youtube.com/embed/%id%?autoplay=1&amp;fs=1&amp;rel=0&amp;enablejsapi=1"},vimeo:{reg:/vimeo\.com/i,split:'/',index:3,iframe:1,url:"http://player.vimeo.com/video/%id%?hd=1&amp;autoplay=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1"},metacafe:{reg:/metacafe\.com\/watch/i,split:'/',index:4,url:"http://www.metacafe.com/fplayer/%id%/.swf?playerVars=autoPlay=yes"},dailymotion:{reg:/dailymotion\.com\/video/i,split:'/',index:4,iframe:true,url:"http://www.dailymotion.com/embed/video/%id%?autoPlay=1&forcedQuality=hd720"},collegehumornew:{reg:/collegehumor\.com\/video\//i,split:'video/',index:1,iframe:true,url:"http://www.collegehumor.com/e/%id%"},collegehumor:{reg:/collegehumor\.com\/video:/i,split:'video:',index:1,url:"http://www.collegehumor.com/moogaloop/moogaloop.swf?autoplay=true&amp;fullscreen=1&amp;clip_id=%id%"},ustream:{reg:/ustream\.tv/i,split:'/',index:4,url:"http://www.ustream.tv/flash/video/%id%?loc=%2F&amp;autoplay=true&amp;vid=%id%&amp;disabledComment=true&amp;beginPercent=0.5331&amp;endPercent=0.6292&amp;locale=en_US"},twitvid:{reg:/twitvid\.com/i,split:'/',index:3,url:"http://www.twitvid.com/player/%id%"},wordpress:{reg:/v\.wordpress\.com/i,split:'/',index:3,url:"http://s0.videopress.com/player.swf?guid=%id%&amp;v=1.01"},vzaar:{reg:/vzaar\.com\/videos/i,split:'/',index:4,url:"http://view.vzaar.com/%id%.flashplayer?autoplay=true&amp;border=none"},youku:{reg:/v.youku.com\/v_show\//i,split:'id_',index:1,iframe:1,url:"http://player.youku.com/embed/%id%&amp;autoplay=1"}},mapsreg:{bing:{reg:/bing\.com\/maps/i,split:'?',index:1,url:"http://www.bing.com/maps/embed/?emid=3ede2bc8-227d-8fec-d84a-00b6ff19b1cb&amp;w=%width%&amp;h=%height%&amp;%id%"},streetview:{reg:/maps\.google\.(com|co.uk|ca|es)(.*)layer=c/i,split:'?',index:1,url:"http://maps.google.com/?output=svembed&amp;%id%"},googlev2:{reg:/maps\.google\.(com|co.uk|ca|es)\/maps\/ms/i,split:'?',index:1,url:"http://maps.google.com/maps/ms?output=embed&amp;%id%"},google:{reg:/maps\.google\.(com|co.uk|ca|es)/i,split:'?',index:1,url:"http://maps.google.com/maps?%id%&amp;output=embed"}},imgsreg:/\.(?:jpg|png|jpeg|gif|bmp|tiff)/i,overlay:{create:function(a){this.options=a;this.element=$('<div id="'+new Date().getTime()+'" class="'+this.options.name+'-overlay"></div>');this.element.css($.extend({},{'position':'fixed','top':0,'left':0,'opacity':0,'display':'none','z-index':this.options.zIndex},this.options.style));this.element.bind("click",$.proxy(function(e){if(!this.options.modal&&!this.hidden){if($.isFunction(this.options.callback)){this.options.callback()}else{this.hide()}}e.preventDefault()},this));this.hidden=true;this.inject();return this},inject:function(){this.target=$(B.body);this.target.append(this.element)},resize:function(x,y){this.element.css({'height':0,'width':0});if(this.shim){this.shim.css({'height':0,'width':0})};var a={x:$(B).width(),y:$(B).height()};this.element.css({'width':'100%','height':y||a.y});if(this.shim){this.shim.css({'height':0,'width':0});this.shim.css({'position':'absolute','left':0,'top':0,'width':this.element.width(),'height':y||a.y})}return this},show:function(a){if(!this.hidden){return this};if(this.transition){this.transition.stop()};if(this.shim){this.shim.css('display','block')};this.element.css({'display':'block','opacity':0});this.resize();this.hidden=false;this.transition=this.element.fadeTo(this.options.showDuration,this.options.style.opacity,$.proxy(function(){if(this.options.style.opacity){this.element.css(this.options.style)};this.element.trigger('show');if($.isFunction(a)){a()}},this));return this},hide:function(a){if(this.hidden){return this};if(this.transition){this.transition.stop()};if(this.shim){this.shim.css('display','none')};this.hidden=true;this.transition=this.element.fadeTo(this.options.closeDuration,0,$.proxy(function(){this.element.trigger('hide');if($.isFunction(a)){a()};this.element.css({'height':0,'width':0,'display':'none'})},this));return this}},create:function(a){this.options=$.extend(true,this.defaults,a);var b=this.options.name;var c=$('<div class="'+b+' '+b+'-mode-image"><div class="'+b+'-border-top-left"></div><div class="'+b+'-border-top-middle"></div><div class="'+b+'-border-top-right"></div><a class="'+b+'-button-close" href="#close"><span>Close</span></a><div class="'+b+'-navigator"><a class="'+b+'-button-left" href="#"><span>Previous</span></a><a class="'+b+'-button-right" href="#"><span>Next</span></a></div><div class="'+b+'-buttons"><div class="'+b+'-buttons-init"></div><a class="'+b+'-button-left" href="#"><span>Previous</span></a><a class="'+b+'-button-max" href="#"><span>Maximize</span></a><div class="'+b+'-buttons-custom"></div><a class="'+b+'-button-right" href="#"><span>Next</span></a><div class="'+b+'-buttons-end"></div></div><div class="'+b+'-background"></div><div class="'+b+'-html"></div><div class="'+b+'-border-bottom-left"></div><div class="'+b+'-border-bottom-middle"></div><div class="'+b+'-border-bottom-right"></div></div>');var e=this.esqueleto;this.overlay.create({name:b,style:this.options.overlay,modal:this.options.modal,zIndex:this.options.style.zIndex-1,callback:this.proxy(this.close),showDuration:(E?this.options.animation.show.duration/2:this.options.animation.show.duration),closeDuration:(E?this.options.animation.close.duration/2:this.options.animation.close.duration)});e.lightbox=c;e.navigator=$('.'+b+'-navigator',c);e.buttons.div=$('.'+b+'-buttons',c);e.buttons.close=$('.'+b+'-button-close',c);e.buttons.prev=$('.'+b+'-button-left',c);e.buttons.max=$('.'+b+'-button-max',c);e.buttons.next=$('.'+b+'-button-right',c);e.buttons.custom=$('.'+b+'-buttons-custom',c);e.background=$('.'+b+'-background',c);e.html=$('.'+b+'-html',c);e.move=$('<div class="'+b+'-move"></div>').css({'position':'absolute','z-index':this.options.style.zIndex,'top':-999}).append(c);$('body').append(e.move);this.win=$(A);this.addevents();return c},addevents:function(){var a=this.win;a[0].onorientationchange=function(){if(this.visible){this.overlay.resize();if(this.move&&!this.maximized){this.movebox()}}};a.bind('resize',this.proxy(function(){if(this.visible&&!E){this.overlay.resize();if(this.move&&!this.maximized){this.movebox()}}}));a.bind('scroll',this.proxy(function(){if(this.visible&&this.move&&!this.maximized&&!E){this.movebox()}}));$(B).bind('keydown',this.proxy(function(e){if(this.visible){if(e.keyCode===27&&this.options.modal===false){this.close()}if(this.gallery.total>1){if(e.keyCode===37){this.esqueleto.buttons.prev.triggerHandler('click',e)}if(e.keyCode===39){this.esqueleto.buttons.next.triggerHandler('click',e)}}}}));this.esqueleto.buttons.close.bind('click touchend',{"fn":"close"},this.proxy(this.fn));this.esqueleto.buttons.max.bind('click touchend',{"fn":"maximinimize"},this.proxy(this.fn));this.overlay.element.bind('show',this.proxy(function(){$(this).triggerHandler('show')}));this.overlay.element.bind('hide',this.proxy(function(){$(this).triggerHandler('close')}))},fn:function(e){this[e.data.fn].apply(this);e.preventDefault()},proxy:function(a){return $.proxy(a,this)},ex:function(f,g,h){var j={type:"",width:"",height:"",href:""};$.each(f,this.proxy(function(c,d){$.each(d,this.proxy(function(i,e){if((c=="flash"&&g.split('?')[0].match(e.reg))||(c=="iframe"&&g.match(e.reg))){j.href=g;if(e.split){var a=c=="flash"?g.split(e.split)[e.index].split('?')[0].split('&')[0]:g.split(e.split)[e.index];j.href=e.url.replace("%id%",a).replace("%width%",h.width).replace("%height%",h.height)}j.type=e.iframe?"iframe":c;if(h.width){j.width=h.width;j.height=h.height}else{var b=this.calculate(this.options[j.type].width,this.options[j.type].height);j.width=b.width;j.height=b.height}return false}}));if(!!j.type)return false}));return j},create_gallery:function(a,b){var c=this;var d=c.esqueleto.buttons.prev;var f=c.esqueleto.buttons.next;c.gallery.total=a.length;if(a.length>1){d.unbind('.lightbox');f.unbind('.lightbox');d.bind('click.lightbox touchend.lightbox',function(e){e.preventDefault();a.unshift(a.pop());c.show(a)});f.bind('click.lightbox touchend.lightbox',function(e){e.preventDefault();a.push(a.shift());c.show(a)});if(c.esqueleto.navigator.css("display")==="none"){c.esqueleto.buttons.div.show()}d.show();f.show();if(this.options.preload){if(a[1].href.match(this.imgsreg)){(new Image()).src=a[1].href}if(a[a.length-1].href.match(this.imgsreg)){(new Image()).src=a[a.length-1].href}}}else{d.hide();f.hide()}},custombuttons:function(c,d){var f=this.esqueleto;f.buttons.custom.empty();$.each(c,this.proxy(function(i,a){var b=$('<a href="#" class="'+a['class']+'">'+a['html']+'</a>');b.bind('click',this.proxy(function(e){if($.isFunction(a.callback)){a.callback(this.esqueleto.image.src,this,d)}e.preventDefault()}));f.buttons.custom.append(b)}));f.buttons.div.show()},show:function(d,f,g){if(this.utils.isEmpty(d)){return false}var h=d[0];var i='';var j=false;var k=h.href;var l=this.esqueleto;var m={x:this.win.width(),y:this.win.height()};var n,height;if(d.length===1&&h.type==="element"){i="element"}this.loading();j=this.visible;this.open();if(j===false){this.movebox()}this.create_gallery(d,f);f=$.extend(true,{'width':0,'height':0,'modal':0,'force':'','autoresize':true,'move':true,'maximized':false,'iframe':false,'flashvars':'','cufon':true,'ratio':1,'onOpen':function(){},'onClose':function(){}},f||{},h);this.options.onOpen=f.onOpen;this.options.onClose=f.onClose;this.options.cufon=f.cufon;var o=this.unserialize(k);f=$.extend({},f,o);if(f.width&&(""+f.width).indexOf("p")>0){f.width=Math.round((m.x-20)*f.width.substring(0,f.width.indexOf("p"))/100)}if(f.height&&(""+f.height).indexOf("p")>0){f.height=Math.round((m.y-20)*f.height.substring(0,f.height.indexOf("p"))/100)}this.overlay.options.modal=f.modal;var p=l.buttons.max;p.removeClass(this.options.name+'-button-min');p.removeClass(this.options.name+'-button-max');p.addClass(this.options.name+'-hide');this.move=!!f.move;this.maximized=!!f.maximized;if($.isArray(f.buttons)){this.custombuttons(f.buttons,h.element)}if(l.buttons.custom.is(":empty")===false){l.buttons.div.show()}if(this.utils.isEmpty(f.force)===false){i=f.force}else if(f.iframe){i='iframe'}else if(k.match(this.imgsreg)){i='image'}else{var q=this.ex({"flash":this.videoregs,"iframe":this.mapsreg},k,f);if(!!q.type===true){k=q.href;i=q.type;f.width=q.width;f.height=q.height}if(!!i===false){if(k.match(/#/)){var r=k.substr(k.indexOf("#"));if($(r).length>0){i='inline';k=r}else{i='ajax'}}else{i='ajax'}}}if(i==='image'){l.image=new Image();$(l.image).load(this.proxy(function(){var a=this.esqueleto.image;$(a).unbind('load');if(this.visible===false){return false}if(f.width){n=parseInt(f.width,10);height=parseInt(f.height,10);f.autoresize=false}else{a.width=parseInt(a.width*f.ratio,10);a.height=parseInt(a.height*f.ratio,10);if(f.maximized){n=a.width;height=a.height}else{var b=this.calculate(a.width,a.height);n=b.width;height=b.height}}if(f.autoresize){if(f.maximized||(!f.maximized&&a.width!=n&&a.height!=height)){l.buttons.div.show();l.buttons.max.removeClass(this.options.name+'-hide');l.buttons.max.addClass(this.options.name+(f.maximized?'-button-min':'-button-max'))}}l.title=(this.utils.isEmpty(f.title))?false:$('<div class="'+this.options.name+'-title"></div>').html(f.title);this.loadimage();this.resize(n,height)}));this.esqueleto.image.onerror=this.proxy(function(){this.error("The requested image cannot be loaded. Please try again later.")});this.esqueleto.image.src=k}else if(i=='jwplayer'&&typeof jwplayer!=="undefined"){if(f.width){n=f.width;height=f.height}else{this.error("You have to specify the size. Add ?lightbox[width]=600&lightbox[height]=400 at the end of the url.");return false}var s='DV_'+(new Date().getTime());var t='<div id="'+s+'"></div>';this.appendhtml($(t).css({width:n,height:height}),n,height);this.esqueleto.background.bind('complete',this.proxy(function(){this.esqueleto.background.unbind('complete');jwplayer(s).setup($.extend(true,{file:k,autostart:true},f));if(this.visible===false){return false}}))}else if(i=='flash'||i=='inline'||i=='ajax'||i=='element'){if(i=='inline'){var u=$(k);var v=f.source=="original"?u:u.clone(true).show();n=f.width>0?f.width:u.outerWidth(true);height=f.height>0?f.height:u.outerHeight(true);this.appendhtml(v,n,height)}else if(i=='ajax'){if(f.width){n=f.width;height=f.height}else{this.error("You have to specify the size. Add ?lightbox[width]=600&lightbox[height]=400 at the end of the url.");return false}if(this.animations.ajax){this.animations.ajax.abort()}this.animations.ajax=$.ajax($.extend(true,{},this.options.ajax,f.ajax||{},{url:k,error:this.proxy(function(a,b,c){this.error("AJAX Error "+a.status+" "+c+". Url: "+k)}),success:this.proxy(function(a){this.appendhtml($("<div>"+a+"</div>"),n,height)})}))}else if(i=='flash'){var w=this.swf2html(k,f.width,f.height,f.flashvars);this.appendhtml($(w),f.width,f.height,'flash')}else if(i==='element'){n=f.width>0?f.width:h.element.outerWidth(true);height=f.height>0?f.height:h.element.outerHeight(true);this.appendhtml(h.element,n,height)}}else if(i=='iframe'){if(f.width){n=f.width;height=f.height}else{this.error("You have to specify the size. Add ?lightbox[width]=600&lightbox[height]=400&lighbox[iframe]=true at the end of the url.");return false}var t='<iframe id="IF_'+(new Date().getTime())+'" frameborder="0" src="'+k+'" style="margin:0; padding:0;"></iframe>';this.appendhtml($(t).css({width:n,height:height}),n,height)}this.callback=$.isFunction(g)?g:function(e){}},loadimage:function(){var a=this.esqueleto;var b=a.background;var c=this.options.name+'-loading';b.bind('complete',this.proxy(function(){b.unbind('complete');if(this.visible===false){return false}this.changemode('image');b.empty();a.html.empty();if(a.title){b.append(a.title)}b.append(a.image);if(!G.opacity){b.removeClass(c)}else{$(a.image).css("background-color","rgba(255, 255, 255, 0)");$(a.image).stop().css("opacity",0).animate({"opacity":1},(E?this.options.animation.show.duration/2:this.options.animation.show.duration),function(){b.removeClass(c)})}this.options.onOpen.apply(this)}))},swf2html:function(c,d,e,f){var g=$.extend(true,{classid:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",width:d,height:e,movie:c,src:c,style:"margin:0; padding:0;",allowFullScreen:"true",allowscriptaccess:"always",wmode:"transparent",autostart:"true",autoplay:"true",type:"application/x-shockwave-flash",flashvars:"autostart=1&autoplay=1&fullscreenbutton=1"},f);var h="<object ";var i="<embed ";var j="";$.each(g,function(a,b){if(b!==""){h+=a+"=\""+b+"\" ";i+=a+"=\""+b+"\" ";j+="<param name=\""+a+"\" value=\""+b+"\"></param>"}});var k=h+">"+j+i+"></embed></object>";return k},appendhtml:function(a,b,c,d){var e=this;var f=e.options;var g=e.esqueleto;var h=g.background;e.changemode("html");e.resize(b+30,c+20);h.bind('complete',function(){h.removeClass(f.name+'-loading');g.html.append(a);if(d=="flash"&&D("chrome")>-1){g.html.html(a)}h.unbind('complete');if(f.cufon&&typeof Cufon!=='undefined'){Cufon.refresh()}f.onOpen.apply(this)})},movebox:function(w,h){var a=$(this.win);var b={x:a.width(),y:a.height()};var c={x:a.scrollLeft(),y:a.scrollTop()};var d=this.esqueleto;var e=w!=null?w:d.lightbox.outerWidth(true);var f=h!=null?h:d.lightbox.outerHeight(true);var y=0;var x=0;x=c.x+((b.x-e)/2);if(this.visible){y=c.y+(b.y-f)/2}else if(this.options.emergefrom=="bottom"){y=(c.y+b.y+14)}else if(this.options.emergefrom=="top"){y=(c.y-f)-14}else if(this.options.emergefrom=="right"){x=b.x;y=c.y+(b.y-f)/2}else if(this.options.emergefrom=="left"){x=-e;y=c.y+(b.y-f)/2}if(this.visible){if(!this.animations.move){this.morph(d.move,{'left':parseInt(x,10)},'move')}this.morph(d.move,{'top':parseInt(y,10)},'move')}else{d.move.css({'left':parseInt(x,10),'top':parseInt(y,10)})}},morph:function(d,f,g,h,i){var j=jQuery.fn.jquery.split(".");if(j[0]==1&&j[1]<8){var k=$.speed({queue:i||false,duration:(E?this.options.animation[g].duration/2:this.options.animation[g].duration),easing:this.options.animation[g].easing,complete:($.isFunction(h)?this.proxy(h,this):null)});return d[k.queue===false?"each":"queue"](function(){if(j[1]>5){if(k.queue===false){$._mark(this)}}var c=$.extend({},k),self=this;c.curAnim=$.extend({},f);c.animatedProperties={};for(var p in f){name=p;c.animatedProperties[name]=c.specialEasing&&c.specialEasing[name]||c.easing||'swing'}$.each(f,function(a,b){var e=new $.fx(self,c,a);e.custom(e.cur(true)||0,b,"px")});return true})}else{d.animate(f,{queue:i||false,duration:(E?this.options.animation[g].duration/2:this.options.animation[g].duration),easing:this.options.animation[g].easing,complete:($.isFunction(h)?this.proxy(h,this):null)})}},resize:function(x,y){var a=this.esqueleto;if(this.visible){var b={x:$(this.win).width(),y:$(this.win).height()};var c={x:$(this.win).scrollLeft(),y:$(this.win).scrollTop()};var d=Math.max((c.x+(b.x-(x+14))/2),0);var e=Math.max((c.y+(b.y-(y+14))/2),0);this.animations.move=true;this.morph(a.move.stop(),{'left':(this.maximized&&d<0)?0:d,'top':(this.maximized&&(y+14)>b.y)?c.y:e},'move',$.proxy(function(){this.move=false},this.animations));this.morph(a.html,{'height':y-20},'move');this.morph(a.lightbox.stop(),{'width':(x+14),'height':y-20},'move',{},true);this.morph(a.navigator,{'width':x},'move');this.morph(a.navigator,{'top':(y-(a.navigator.height()))/2},'move');this.morph(a.background.stop(),{'width':x,'height':y},'move',function(){$(a.background).trigger('complete')})}else{a.html.css({'height':y-20});a.lightbox.css({'width':x+14,'height':y-20});a.background.css({'width':x,'height':y});a.navigator.css({'width':x})}},close:function(a){var b=this.esqueleto;this.visible=false;this.gallery={};this.options.onClose();var c=b.html.children(".jwplayer");if(c.length>0&&typeof jwplayer!=="undefined"){jwplayer(c[0]).remove()}if(F||!G.opacity||E){b.background.empty();b.html.find("iframe").attr("src","");if(F){setTimeout(function(){b.html.hide().empty().show()},100)}else{b.html.hide().empty().show()}b.buttons.custom.empty();b.move.css("display","none");this.movebox()}else{b.move.animate({"opacity":0,"top":"-=40"},{queue:false,complete:(this.proxy(function(){b.background.empty();b.html.empty();b.buttons.custom.empty();this.movebox();b.move.css({"display":"none","opacity":1,"overflow":"visible"})}))})}this.overlay.hide(this.proxy(function(){if($.isFunction(this.callback)){this.callback.apply(this,$.makeArray(a))}}));b.background.stop(true,false).unbind("complete")},open:function(){this.visible=true;if(!G.opacity){this.esqueleto.move.get(0).style.removeAttribute("filter")}this.esqueleto.move.stop().css({opacity:1,display:"block",overflow:"visible"}).show();this.overlay.show()},shake:function(){var z=this.options.animation.shake;var x=z.distance;var d=z.duration;var t=z.transition;var o=z.loops;var l=this.esqueleto.move.position().left;var e=this.esqueleto.move;for(var i=0;i<o;i++){e.animate({left:l+x},d,t);e.animate({left:l-x},d,t)};e.animate({left:l+x},d,t);e.animate({left:l},d,t)},changemode:function(a){if(a!=this.mode){var b=this.options.name+"-mode-";this.esqueleto.lightbox.removeClass(b+this.mode).addClass(b+a);this.mode=a}this.esqueleto.move.css("overflow","visible")},error:function(a){alert(a);this.close()},unserialize:function(d){var e=/lightbox\[([^\]]*)?\]$/i;var f={};if(d.match(/#/)){d=d.slice(0,d.indexOf("#"))}d=d.slice(d.indexOf('?')+1).split("&");$.each(d,function(){var a=this.split("=");var b=a[0];var c=a[1];if(b.match(e)){if(isFinite(c)){c=parseFloat(c)}else if(c.toLowerCase()=="true"){c=true}else if(c.toLowerCase()=="false"){c=false}f[b.match(e)[1]]=c}});return f},calculate:function(x,y){var a=this.options.maxsize.width>0?this.options.maxsize.width:this.win.width()-50;var b=this.options.maxsize.height>0?this.options.maxsize.height:this.win.height()-50;if(x>a){y=y*(a/x);x=a;if(y>b){x=x*(b/y);y=b}}else if(y>b){x=x*(b/y);y=b;if(x>a){y=y*(a/x);x=a}}return{width:parseInt(x,10),height:parseInt(y,10)}},loading:function(){var a=this.options.style;var b=this.esqueleto;var c=b.background;this.changemode('image');c.children().stop(true);c.empty();b.html.empty();b.buttons.div.hide();b.buttons.div.css("width");c.addClass(this.options.name+'-loading');if(this.visible==false){this.movebox(a["width"],a["height"]);this.resize(a["width"],a["height"])}},maximinimize:function(){var a=this;var b=a.esqueleto.buttons;var c=a.esqueleto.image;var d=a.options.name;var e={};b.max.removeClass(d+'-button-min '+d+'-button-max').addClass((a.maximized)?d+'-button-max':d+'-button-min');a.loading();a.loadimage();b.div.show();if(a.maximized){e=a.calculate(c.width,c.height)}else{e=c}a.resize(e.width,e.height);a.maximized=!a.maximized},getOptions:function(a){var a=$(a);return $.extend({},{href:a.attr("href"),rel:($.trim(a.attr("data-rel")||a.attr("rel"))),relent:a.attr("data-rel")?"data-rel":"rel",title:$.trim(a.attr("data-title")||a.attr("title")),element:a[0]},($.parseJSON((a.attr("data-options")||"{}").replace(/\'/g,'"'))||{}))},link:function(b,c){var d=$(c.element);var e=this.getOptions(d);var f=e.rel;var g=e.relent;var h=c.options;var j=[];d.blur();if(c.gallery){j=c.gallery}else if(this.utils.isEmpty(f)||f==='nofollow'){j=[e]}else{var k=[];var l=[];var m=false;$("a["+g+"], area["+g+"]",this.ownerDocument).filter("["+g+"=\""+f+"\"]").each($.proxy(function(i,a){if(d[0]===a){k.unshift(this.getOptions(a));m=true}else if(m==false){l.push(this.getOptions(a))}else{k.push(this.getOptions(a))}},this));j=k.concat(l)}$.lightbox(j,h,c.callback,d);return false},utils:{isEmpty:function(a){if(a==null)return true;if(Object.prototype.toString.call(a)==='[object String]'||$.type(a)==="array")return a.length===0}}},lightbox:function(a,b,c){var d=[];if($.LightBoxObject.utils.isEmpty(a)){return $.LightBoxObject}if($.type(a)==="string"){d=[$.extend({},{href:a},b)]}else if($.type(a)==="array"){var e=a[0];if($.type(e)==="string"){for(var i=0;i<a.length;i++){d[i]=$.extend({},{href:a[i]},b)}}else if($.type(e)==="object"){for(var i=0;i<a.length;i++){d[i]=$.extend({},b,a[i])}}}else if($.type(a)==="object"&&a[0].nodeType){d=[$.extend({},{type:"element",href:"#",element:a},b)]}return $.LightBoxObject.show(d,b,c)}});$.fn.lightbox=function(a,b){var c={"selector":this.selector,"options":a,"callback":b};return $(this).live('click',function(e){e.preventDefault();e.stopImmediatePropagation();return $.proxy($.LightBoxObject.link,$.LightBoxObject)(e,$.extend({},c,{"element":this}))})};$(function(){var a=jQuery.fn.jquery.split(".");if(a[0]>1||(a[0]==1&&a[1]>3)){$.LightBoxObject.create()}else{throw"The jQuery version that was loaded is too old. Lightbox Evolution requires jQuery 1.4+";}})})(jQuery,window,document);
*/


//////////////////////////////////////////////////
/*************************************************
**************************************************
**    kullanılmadı
**    DEVELOPER : ismail AKBUDAK  WEB & MOBIL DEVELOPER
**
**    CONTACT   :  www.ismailakbudak.com 
**    LINKEDIN  : http://www.linkedin.com/pub/ismail-akbudak/56/a57/40b
**    FACEBOOK  : https://www.facebook.com/isoakbudak
**    TWITTER   : https://twitter.com/isoakbudak
**    GOOGLE+   : https://plus.google.com/u/0/100985583645011477288/posts
**    
**    EXPLAIN   : You can use this code block free 
**                BUT LEARN, DEVELOP AND SHARE  
**                THIS IS MY PRINCIPLE
**    
**    UPDATE    : 04-11-2013 Polond - Gliwice
**
***********************************************
***********************************************///
//////////////////////////////////////////////////

/*
(function ($) { 	
	
	$('.lightbox-type').lightbox ();
	 	
	$('.growl-type').live ('click', function (e) {
		$.msgGrowl ({
			type: $(this).attr ('data-type')
			, title: 'Header'
			, text: 'Lorem ipsum dolor sit amet, consectetur ipsum dolor sit amet, consectetur.'
		});
	});
	
	
	$('.msgbox-alert').live ('click', function (e) {
		$.msgbox("The selection includes process white objects. Overprinting such objects is only useful in combination with transparency effects.");
	});
	
	$('.msgbox-info').live ('click', function (e) {
		$.msgbox("jQuery is a fast and concise JavaScript Library that simplifies HTML document traversing, event handling, animating, and Ajax interactions for rapid web development.", {type: "info"});
	});
	
	$('.msgbox-error').live ('click', function (e) {
		$.msgbox("An error 1053 ocurred while perfoming this service operation on the MySql Server service.", {type: "error"});
	});
	
	$('.msgbox-confirm').live ('click', function (e) {
		$.msgbox("Are you sure that you want to permanently delete the selected element?", {
		  type: "confirm",
		  buttons : [
		    {type: "submit", value: "Yes"},
		    {type: "submit", value: "No"},
		    {type: "cancel", value: "Cancel"}
		  ]
		}, function(result) {
		  	$("#result2").text(result);
			});
	});
	
	$('.msgbox-prompt').live ('click', function (e) {
		$.msgbox("Insert your name below:", {
		  type: "prompt"
		}, function(result) {
		  if (result) {
		    alert("Hello " + result);
		  }
		});
	});
	
})(jQuery);
*/