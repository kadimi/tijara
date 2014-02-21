/*jslint browser: true*/
/*global $, jQuery*/

jQuery(document).ready(function ($) {

    // Remove unwanted generated spans
    $('span.generated', 'header').remove();
    $('.nocollapse .generated', '#sidebar').remove();

    // Toggle visibility of sidebar contents when titles are clicked 
    $("#sidebar :not(.nocollapse) .widget-title").each(function () {
    
        // vars
        var widget_id = $(this).closest('aside').attr('id');
        
        // functions
        function widget_expand(widget_id) {
            $('#'+widget_id)
                .addClass('expanded')
                .removeClass('collapsed')
                .find('.widget-contents')
                .slideDown('fast')
            ;
            $.cookie(widget_id, 'expanded', { expires : 90 });
        }

        function widget_collapse(widget_id) {
            $('#'+widget_id)
                .find('.widget-contents')
                .slideUp('fast', function () {
                    $(this)
                        .parent()
                        .addClass('collapsed')
                        .removeClass('expanded')
                    ;
                })
            ;
            $.cookie(widget_id, 'collapsed', { expires : 90 });
        }

        // Show/hide depending on cookies
        if($.cookie(widget_id) == 'collapsed')
            widget_collapse(widget_id);
        else if($.cookie(widget_id) == 'expanded')
            widget_expand(widget_id);
        
        // Add click event
        $(this).click(function () {
            if($(this).siblings('.widget-contents:visible').length)
                widget_collapse(widget_id);
            else
                widget_expand(widget_id);
        });
    });

    // Remove woocommerce comment star rating
    // $('#commentform .comment-form-rating').hide();

    // Add other rating stars
    //$(document).on('load', document, function () {
        $('[id^="star_"]').each(function (index) {
            $(this).raty({
                scoreName: 'rating_' + (index + 1),
                path: tijara.templateUrl + '/js/img',
                size : 24,
                starOff : 'star-off-big.png',
                starOn : 'star-on-big.png',
            });
        });
    //});

    // Require ratings if applicable
    if(woocommerce_params.review_rating_required == 'yes') {
        $('body').on('submit', '#commentform', function() {
            $ratings_unfilled = $(this)
                .find("[name^='rating_']")
                .filter ( function () {
                    return !(1
                        && $.isNumeric($(this).val()) 
                        && $(this).val().match(/^[1-5]$/)
                    );
                });
            if ($ratings_unfilled.length) {
                alert(woocommerce_params.i18n_required_rating_text);
                return false;
            }
        });
    }

});

/*!
 * jQuery Cookie Plugin v1.3.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function(a,b,c){function e(a){return a}function f(a){return g(decodeURIComponent(a.replace(d," ")))}function g(a){return 0===a.indexOf('"')&&(a=a.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\")),a}function h(a){return i.json?JSON.parse(a):a}var d=/\+/g,i=a.cookie=function(d,g,j){if(g!==c){if(j=a.extend({},i.defaults,j),null===g&&(j.expires=-1),"number"==typeof j.expires){var k=j.expires,l=j.expires=new Date;l.setDate(l.getDate()+k)}return g=i.json?JSON.stringify(g):g+"",b.cookie=[encodeURIComponent(d),"=",i.raw?g:encodeURIComponent(g),j.expires?"; expires="+j.expires.toUTCString():"",j.path?"; path="+j.path:"",j.domain?"; domain="+j.domain:"",j.secure?"; secure":""].join("")}for(var m=i.raw?e:f,n=b.cookie.split("; "),o=d?null:{},p=0,q=n.length;q>p;p++){var r=n[p].split("="),s=m(r.shift()),t=m(r.join("="));if(d&&d===s){o=h(t);break}d||(o[s]=h(t))}return o};i.defaults={},a.removeCookie=function(b,c){return null!==a.cookie(b)?(a.cookie(b,null,c),!0):!1}})(jQuery,document);

/**
 * StyleFix 1.0.3 & PrefixFree 1.0.7
 * @author Lea Verou
 * MIT license
 */
(function(){function t(e,t){return[].slice.call((t||document).querySelectorAll(e))}if(!window.addEventListener)return;var e=window.StyleFix={link:function(t){try{if(t.rel!=="stylesheet"||t.hasAttribute("data-noprefix"))return}catch(n){return}var r=t.href||t.getAttribute("data-href"),i=r.replace(/[^\/]+$/,""),s=(/^[a-z]{3,10}:/.exec(i)||[""])[0],o=(/^[a-z]{3,10}:\/\/[^\/]+/.exec(i)||[""])[0],u=/^([^?]*)\??/.exec(r)[1],a=t.parentNode,f=new XMLHttpRequest,l;f.onreadystatechange=function(){f.readyState===4&&l()};l=function(){var n=f.responseText;if(n&&t.parentNode&&(!f.status||f.status<400||f.status>600)){n=e.fix(n,!0,t);if(i){n=n.replace(/url\(\s*?((?:"|')?)(.+?)\1\s*?\)/gi,function(e,t,n){return/^([a-z]{3,10}:|#)/i.test(n)?e:/^\/\//.test(n)?'url("'+s+n+'")':/^\//.test(n)?'url("'+o+n+'")':/^\?/.test(n)?'url("'+u+n+'")':'url("'+i+n+'")'});var r=i.replace(/([\\\^\$*+[\]?{}.=!:(|)])/g,"\\$1");n=n.replace(RegExp("\\b(behavior:\\s*?url\\('?\"?)"+r,"gi"),"$1")}var l=document.createElement("style");l.textContent=n;l.media=t.media;l.disabled=t.disabled;l.setAttribute("data-href",t.getAttribute("href"));a.insertBefore(l,t);a.removeChild(t);l.media=t.media}};try{f.open("GET",r);f.send(null)}catch(n){if(typeof XDomainRequest!="undefined"){f=new XDomainRequest;f.onerror=f.onprogress=function(){};f.onload=l;f.open("GET",r);f.send(null)}}t.setAttribute("data-inprogress","")},styleElement:function(t){if(t.hasAttribute("data-noprefix"))return;var n=t.disabled;t.textContent=e.fix(t.textContent,!0,t);t.disabled=n},styleAttribute:function(t){var n=t.getAttribute("style");n=e.fix(n,!1,t);t.setAttribute("style",n)},process:function(){t('link[rel="stylesheet"]:not([data-inprogress])').forEach(StyleFix.link);t("style").forEach(StyleFix.styleElement);t("[style]").forEach(StyleFix.styleAttribute)},register:function(t,n){(e.fixers=e.fixers||[]).splice(n===undefined?e.fixers.length:n,0,t)},fix:function(t,n,r){for(var i=0;i<e.fixers.length;i++)t=e.fixers[i](t,n,r)||t;return t},camelCase:function(e){return e.replace(/-([a-z])/g,function(e,t){return t.toUpperCase()}).replace("-","")},deCamelCase:function(e){return e.replace(/[A-Z]/g,function(e){return"-"+e.toLowerCase()})}};(function(){setTimeout(function(){t('link[rel="stylesheet"]').forEach(StyleFix.link)},10);document.addEventListener("DOMContentLoaded",StyleFix.process,!1)})()})();(function(e){function t(e,t,r,i,s){e=n[e];if(e.length){var o=RegExp(t+"("+e.join("|")+")"+r,"gi");s=s.replace(o,i)}return s}if(!window.StyleFix||!window.getComputedStyle)return;var n=window.PrefixFree={prefixCSS:function(e,r,i){var s=n.prefix;n.functions.indexOf("linear-gradient")>-1&&(e=e.replace(/(\s|:|,)(repeating-)?linear-gradient\(\s*(-?\d*\.?\d*)deg/ig,function(e,t,n,r){return t+(n||"")+"linear-gradient("+(90-r)+"deg"}));e=t("functions","(\\s|:|,)","\\s*\\(","$1"+s+"$2(",e);e=t("keywords","(\\s|:)","(\\s|;|\\}|$)","$1"+s+"$2$3",e);e=t("properties","(^|\\{|\\s|;)","\\s*:","$1"+s+"$2:",e);if(n.properties.length){var o=RegExp("\\b("+n.properties.join("|")+")(?!:)","gi");e=t("valueProperties","\\b",":(.+?);",function(e){return e.replace(o,s+"$1")},e)}if(r){e=t("selectors","","\\b",n.prefixSelector,e);e=t("atrules","@","\\b","@"+s+"$1",e)}e=e.replace(RegExp("-"+s,"g"),"-");e=e.replace(/-\*-(?=[a-z]+)/gi,n.prefix);return e},property:function(e){return(n.properties.indexOf(e)?n.prefix:"")+e},value:function(e,r){e=t("functions","(^|\\s|,)","\\s*\\(","$1"+n.prefix+"$2(",e);e=t("keywords","(^|\\s)","(\\s|$)","$1"+n.prefix+"$2$3",e);return e},prefixSelector:function(e){return e.replace(/^:{1,2}/,function(e){return e+n.prefix})},prefixProperty:function(e,t){var r=n.prefix+e;return t?StyleFix.camelCase(r):r}};(function(){var e={},t=[],r={},i=getComputedStyle(document.documentElement,null),s=document.createElement("div").style,o=function(n){if(n.charAt(0)==="-"){t.push(n);var r=n.split("-"),i=r[1];e[i]=++e[i]||1;while(r.length>3){r.pop();var s=r.join("-");u(s)&&t.indexOf(s)===-1&&t.push(s)}}},u=function(e){return StyleFix.camelCase(e)in s};if(i.length>0)for(var a=0;a<i.length;a++)o(i[a]);else for(var f in i)o(StyleFix.deCamelCase(f));var l={uses:0};for(var c in e){var h=e[c];l.uses<h&&(l={prefix:c,uses:h})}n.prefix="-"+l.prefix+"-";n.Prefix=StyleFix.camelCase(n.prefix);n.properties=[];for(var a=0;a<t.length;a++){var f=t[a];if(f.indexOf(n.prefix)===0){var p=f.slice(n.prefix.length);u(p)||n.properties.push(p)}}n.Prefix=="Ms"&&!("transform"in s)&&!("MsTransform"in s)&&"msTransform"in s&&n.properties.push("transform","transform-origin");n.properties.sort()})();(function(){function i(e,t){r[t]="";r[t]=e;return!!r[t]}var e={"linear-gradient":{property:"backgroundImage",params:"red, teal"},calc:{property:"width",params:"1px + 5%"},element:{property:"backgroundImage",params:"#foo"},"cross-fade":{property:"backgroundImage",params:"url(a.png), url(b.png), 50%"}};e["repeating-linear-gradient"]=e["repeating-radial-gradient"]=e["radial-gradient"]=e["linear-gradient"];var t={initial:"color","zoom-in":"cursor","zoom-out":"cursor",box:"display",flexbox:"display","inline-flexbox":"display",flex:"display","inline-flex":"display",grid:"display","inline-grid":"display","min-content":"width"};n.functions=[];n.keywords=[];var r=document.createElement("div").style;for(var s in e){var o=e[s],u=o.property,a=s+"("+o.params+")";!i(a,u)&&i(n.prefix+a,u)&&n.functions.push(s)}for(var f in t){var u=t[f];!i(f,u)&&i(n.prefix+f,u)&&n.keywords.push(f)}})();(function(){function s(e){i.textContent=e+"{}";return!!i.sheet.cssRules.length}var t={":read-only":null,":read-write":null,":any-link":null,"::selection":null},r={keyframes:"name",viewport:null,document:'regexp(".")'};n.selectors=[];n.atrules=[];var i=e.appendChild(document.createElement("style"));for(var o in t){var u=o+(t[o]?"("+t[o]+")":"");!s(u)&&s(n.prefixSelector(u))&&n.selectors.push(o)}for(var a in r){var u=a+" "+(r[a]||"");!s("@"+u)&&s("@"+n.prefix+u)&&n.atrules.push(a)}e.removeChild(i)})();n.valueProperties=["transition","transition-property"];e.className+=" "+n.prefix;StyleFix.register(n.prefixCSS)})(document.documentElement);

/*!
 * jQuery Raty - A Star Rating Plugin
 * ------------------------------------------------------------------
 *
 * jQuery Raty is a plugin that generates a customizable star rating.
 *
 * Licensed under The MIT License
 *
 * @version	2.5.2
 * @since  2010.06.11
 * @author	 Washington Botelho
 * @documentation  wbotelhos.com/raty
 *
 * ------------------------------------------------------------------
 *
 *  <div id="star"></div>
 *
 *  $('#star').raty();
 *
 */
;(function(b){var a={init:function(c){return this.each(function(){a.destroy.call(this);this.opt=b.extend(true,{},b.fn.raty.defaults,c);var e=b(this),g=["number","readOnly","score","scoreName"];a._callback.call(this,g);if(this.opt.precision){a._adjustPrecision.call(this)}this.opt.number=a._between(this.opt.number,0,this.opt.numberMax);this.opt.path=this.opt.path||"";if(this.opt.path&&this.opt.path.charAt(this.opt.path.length-1)!=="/"){this.opt.path+="/"}this.stars=a._createStars.call(this);this.score=a._createScore.call(this);a._apply.call(this,this.opt.score);var f=this.opt.space?4:0,d=this.opt.width||(this.opt.number*this.opt.size+this.opt.number*f);if(this.opt.cancel){this.cancel=a._createCancel.call(this);d+=(this.opt.size+f)}if(this.opt.readOnly){a._lock.call(this)}else{e.css("cursor","pointer");a._binds.call(this)}if(this.opt.width!==false){e.css("width",d)}a._target.call(this,this.opt.score);e.data({settings:this.opt,raty:true})})},_adjustPrecision:function(){this.opt.targetType="score";this.opt.half=true},_apply:function(c){if(c&&c>0){c=a._between(c,0,this.opt.number);this.score.val(c)}a._fill.call(this,c);if(c){a._roundStars.call(this,c)}},_between:function(e,d,c){return Math.min(Math.max(parseFloat(e),d),c)},_binds:function(){if(this.cancel){a._bindCancel.call(this)}a._bindClick.call(this);a._bindOut.call(this);a._bindOver.call(this)},_bindCancel:function(){a._bindClickCancel.call(this);a._bindOutCancel.call(this);a._bindOverCancel.call(this)},_bindClick:function(){var c=this,d=b(c);c.stars.on("click.raty",function(e){c.score.val((c.opt.half||c.opt.precision)?d.data("score"):this.alt);if(c.opt.click){c.opt.click.call(c,parseFloat(c.score.val()),e)}})},_bindClickCancel:function(){var c=this;c.cancel.on("click.raty",function(d){c.score.removeAttr("value");if(c.opt.click){c.opt.click.call(c,null,d)}})},_bindOut:function(){var c=this;b(this).on("mouseleave.raty",function(d){var e=parseFloat(c.score.val())||undefined;a._apply.call(c,e);a._target.call(c,e,d);if(c.opt.mouseout){c.opt.mouseout.call(c,e,d)}})},_bindOutCancel:function(){var c=this;c.cancel.on("mouseleave.raty",function(d){b(this).attr("src",c.opt.path+c.opt.cancelOff);if(c.opt.mouseout){c.opt.mouseout.call(c,c.score.val()||null,d)}})},_bindOverCancel:function(){var c=this;c.cancel.on("mouseover.raty",function(d){b(this).attr("src",c.opt.path+c.opt.cancelOn);c.stars.attr("src",c.opt.path+c.opt.starOff);a._target.call(c,null,d);if(c.opt.mouseover){c.opt.mouseover.call(c,null)}})},_bindOver:function(){var c=this,d=b(c),e=c.opt.half?"mousemove.raty":"mouseover.raty";c.stars.on(e,function(g){var h=parseInt(this.alt,10);if(c.opt.half){var f=parseFloat((g.pageX-b(this).offset().left)/c.opt.size),i=(f>0.5)?1:0.5;h=h-1+i;a._fill.call(c,h);if(c.opt.precision){h=h-i+f}a._roundStars.call(c,h);d.data("score",h)}else{a._fill.call(c,h)}a._target.call(c,h,g);if(c.opt.mouseover){c.opt.mouseover.call(c,h,g)}})},_callback:function(c){for(var d in c){if(typeof this.opt[c[d]]==="function"){this.opt[c[d]]=this.opt[c[d]].call(this)}}},_createCancel:function(){var e=b(this),c=this.opt.path+this.opt.cancelOff,d=b("<img />",{src:c,alt:"x",title:this.opt.cancelHint,"class":"raty-cancel"});if(this.opt.cancelPlace=="left"){e.prepend("&#160;").prepend(d)}else{e.append("&#160;").append(d)}return d},_createScore:function(){return b("<input />",{type:"hidden",name:this.opt.scoreName}).appendTo(this)},_createStars:function(){var e=b(this);for(var c=1;c<=this.opt.number;c++){var f=a._getHint.call(this,c),d=(this.opt.score&&this.opt.score>=c)?"starOn":"starOff";d=this.opt.path+this.opt[d];b("<img />",{src:d,alt:c,title:f}).appendTo(this);if(this.opt.space){e.append((c<this.opt.number)?"&#160;":"")}}return e.children("img")},_error:function(c){b(this).html(c);b.error(c)},_fill:function(d){var m=this,e=0;for(var f=1;f<=m.stars.length;f++){var g=m.stars.eq(f-1),l=m.opt.single?(f==d):(f<=d);if(m.opt.iconRange&&m.opt.iconRange.length>e){var j=m.opt.iconRange[e],h=j.on||m.opt.starOn,c=j.off||m.opt.starOff,k=l?h:c;if(f<=j.range){g.attr("src",m.opt.path+k)}if(f==j.range){e++}}else{var k=l?"starOn":"starOff";g.attr("src",this.opt.path+this.opt[k])}}},_getHint:function(d){var c=this.opt.hints[d-1];return(c==="")?"":(c||d)},_lock:function(){var d=parseInt(this.score.val(),10),c=d?a._getHint.call(this,d):this.opt.noRatedMsg;b(this).data("readonly",true).css("cursor","").attr("title",c);this.score.attr("readonly","readonly");this.stars.attr("title",c);if(this.cancel){this.cancel.hide()}},_roundStars:function(e){var d=(e-Math.floor(e)).toFixed(2);if(d>this.opt.round.down){var c="starOn";if(this.opt.halfShow&&d<this.opt.round.up){c="starHalf"}else{if(d<this.opt.round.full){c="starOff"}}this.stars.eq(Math.ceil(e)-1).attr("src",this.opt.path+this.opt[c])}},_target:function(f,d){if(this.opt.target){var e=b(this.opt.target);if(e.length===0){a._error.call(this,"Target selector invalid or missing!")}if(this.opt.targetFormat.indexOf("{score}")<0){a._error.call(this,'Template "{score}" missing!')}var c=d&&d.type=="mouseover";if(f===undefined){f=this.opt.targetText}else{if(f===null){f=c?this.opt.cancelHint:this.opt.targetText}else{if(this.opt.targetType=="hint"){f=a._getHint.call(this,Math.ceil(f))}else{if(this.opt.precision){f=parseFloat(f).toFixed(1)}}if(!c&&!this.opt.targetKeep){f=this.opt.targetText}}}if(f){f=this.opt.targetFormat.toString().replace("{score}",f)}if(e.is(":input")){e.val(f)}else{e.html(f)}}},_unlock:function(){b(this).data("readonly",false).css("cursor","pointer").removeAttr("title");this.score.removeAttr("readonly","readonly");for(var c=0;c<this.opt.number;c++){this.stars.eq(c).attr("title",a._getHint.call(this,c+1))}if(this.cancel){this.cancel.css("display","")}},cancel:function(c){return this.each(function(){if(b(this).data("readonly")!==true){a[c?"click":"score"].call(this,null);this.score.removeAttr("value")}})},click:function(c){return b(this).each(function(){if(b(this).data("readonly")!==true){a._apply.call(this,c);if(!this.opt.click){a._error.call(this,'You must add the "click: function(score, evt) { }" callback.')}this.opt.click.call(this,c,b.Event("click"));a._target.call(this,c)}})},destroy:function(){return b(this).each(function(){var d=b(this),c=d.data("raw");if(c){d.off(".raty").empty().css({cursor:c.style.cursor,width:c.style.width}).removeData("readonly")}else{d.data("raw",d.clone()[0])}})},getScore:function(){var d=[],c;b(this).each(function(){c=this.score.val();d.push(c?parseFloat(c):undefined)});return(d.length>1)?d:d[0]},readOnly:function(c){return this.each(function(){var d=b(this);if(d.data("readonly")!==c){if(c){d.off(".raty").children("img").off(".raty");a._lock.call(this)}else{a._binds.call(this);a._unlock.call(this)}d.data("readonly",c)}})},reload:function(){return a.set.call(this,{})},score:function(){return arguments.length?a.setScore.apply(this,arguments):a.getScore.call(this)},set:function(c){return this.each(function(){var e=b(this),f=e.data("settings"),d=b.extend({},f,c);e.raty(d)})},setScore:function(c){return b(this).each(function(){if(b(this).data("readonly")!==true){a._apply.call(this,c);a._target.call(this,c)}})}};b.fn.raty=function(c){if(a[c]){return a[c].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof c==="object"||!c){return a.init.apply(this,arguments)}else{b.error("Method "+c+" does not exist!")}}};b.fn.raty.defaults={cancel:false,cancelHint:"Cancel this rating!",cancelOff:"cancel-off.png",cancelOn:"cancel-on.png",cancelPlace:"left",click:undefined,half:false,halfShow:true,hints:["bad","poor","regular","good","gorgeous"],iconRange:undefined,mouseout:undefined,mouseover:undefined,noRatedMsg:"Not rated yet!",number:5,numberMax:20,path:"",precision:false,readOnly:false,round:{down:0.25,full:0.6,up:0.76},score:undefined,scoreName:"score",single:false,size:16,space:true,starHalf:"star-half.png",starOff:"star-off.png",starOn:"star-on.png",target:undefined,targetFormat:"{score}",targetKeep:false,targetText:"",targetType:"hint",width:undefined}})(jQuery);
