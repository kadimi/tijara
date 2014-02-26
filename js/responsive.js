jQuery(document).ready(function ($) {

    "use strict";

    // Switch from desktop to mobile menu and vice-versa
    $("#site-navigation .menu").tinyNav({
        header: tijara.tinyNavHeader,
        indent: tijara.tinyNavIndent
    });
    $(".tinynav").wrap("<div class='mobile-only inline'></div>");

    //Switch mobile fields on label click
    $('label[for="s"], label[for="tinynav1"]').click(function () {
        if ($(this).hasClass('white')) {
            return;
        }
        $('#s, #tinynav1').toggle('fast');
        $('label[for="s"], label[for="tinynav1"]')
            .toggleClass('white')
            .toggleClass('gray');
    });
    
    // Expand menu on label click
    $('label[for="tinynav1"]').click(function () {
        $("#tinynav1").simulate('mousedown');
    });

    // Swipe sidebar in
    $("#sidebar:not(.expanded)").bind('click touchstart', function () {
        $('#sidebar').addClass('expanded');
    });


});

/*! http://tinynav.viljamis.com v1.1 by @viljamis */
(function(a,k,g){a.fn.tinyNav=function(l){var c=a.extend({active:"selected",header:"",indent:"- ",label:""},l);return this.each(function(){g++;var h=a(this),b="tinynav"+g,f=".l_"+b,e=a("<select/>").attr("id",b).addClass("tinynav "+b);if(h.is("ul,ol")){""!==c.header&&e.append(a("<option/>").text(c.header));var d="";h.addClass("l_"+b).find("a").each(function(){d+='<option value="'+a(this).attr("href")+'">';var b;for(b=0;b<a(this).parents("ul, ol").length-1;b++)d+=c.indent;d+=a(this).text()+"</option>"}); e.append(d);c.header||e.find(":eq("+a(f+" li").index(a(f+" li."+c.active))+")").attr("selected",!0);e.change(function(){k.location.href=a(this).val()});a(f).after(e);c.label&&e.before(a("<label/>").attr("for",b).addClass("tinynav_label "+b+"_label").append(c.label))}})}})(jQuery,this,0);

/*
 * jquery.simulate - simulate browser mouse and keyboard events
 *
 * Copyright (c) 2009 Eduardo Lundgren (eduardolundgren@gmail.com)
 * and Richard D. Worth (rdworth@gmail.com)
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) 
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 */
(function(e){e.fn.extend({simulate:function(c,d){return this.each(function(){var b=e.extend({},e.simulate.defaults,d||{});new e.simulate(this,c,b)})}});e.simulate=function(c,d,b){this.target=c;this.options=b;/^drag$/.test(d)?this[d].apply(this,[this.target,b]):this.simulateEvent(c,d,b)};e.extend(e.simulate.prototype,{simulateEvent:function(c,d,b){var a=this.createEvent(d,b);this.dispatchEvent(c,d,a,b);return a},createEvent:function(c,d){if(/^mouse(over|out|down|up|move)|(dbl)?click$/.test(c))return this.mouseEvent(c,
d);if(/^key(up|down|press)$/.test(c))return this.keyboardEvent(c,d)},mouseEvent:function(c,d){var b,a=e.extend({bubbles:!0,cancelable:"mousemove"!=c,view:window,detail:0,screenX:0,screenY:0,clientX:0,clientY:0,ctrlKey:!1,altKey:!1,shiftKey:!1,metaKey:!1,button:0,relatedTarget:void 0},d);e(a.relatedTarget);e.isFunction(document.createEvent)?(b=document.createEvent("MouseEvents"),b.initMouseEvent(c,a.bubbles,a.cancelable,a.view,a.detail,a.screenX,a.screenY,a.clientX,a.clientY,a.ctrlKey,a.altKey,a.shiftKey,
a.metaKey,a.button,a.relatedTarget||document.body.parentNode)):document.createEventObject&&(b=document.createEventObject(),e.extend(b,a),b.button={0:1,1:4,2:2}[b.button]||b.button);return b},keyboardEvent:function(c,d){var b,a=e.extend({bubbles:!0,cancelable:!0,view:window,ctrlKey:!1,altKey:!1,shiftKey:!1,metaKey:!1,keyCode:0,charCode:0},d);if(e.isFunction(document.createEvent))try{b=document.createEvent("KeyEvents"),b.initKeyEvent(c,a.bubbles,a.cancelable,a.view,a.ctrlKey,a.altKey,a.shiftKey,a.metaKey,
a.keyCode,a.charCode)}catch(g){b=document.createEvent("Events"),b.initEvent(c,a.bubbles,a.cancelable),e.extend(b,{view:a.view,ctrlKey:a.ctrlKey,altKey:a.altKey,shiftKey:a.shiftKey,metaKey:a.metaKey,keyCode:a.keyCode,charCode:a.charCode})}else document.createEventObject&&(b=document.createEventObject(),e.extend(b,a));void 0!==e.browser&&(e.browser.msie||e.browser.opera)&&(b.keyCode=0<a.charCode?a.charCode:a.keyCode,b.charCode=void 0);return b},dispatchEvent:function(c,d,b){c.dispatchEvent?c.dispatchEvent(b):
c.fireEvent&&c.fireEvent("on"+d,b);return b},drag:function(c){var d=this.findCenter(this.target),b=this.options;c=Math.floor(d.x);var d=Math.floor(d.y),a=b.dx||0,b=b.dy||0,e=this.target,f={clientX:c,clientY:d};this.simulateEvent(e,"mousedown",f);f={clientX:c+1,clientY:d+1};this.simulateEvent(document,"mousemove",f);f={clientX:c+a,clientY:d+b};this.simulateEvent(document,"mousemove",f);this.simulateEvent(document,"mousemove",f);this.simulateEvent(e,"mouseup",f)},findCenter:function(c){c=e(this.target);
var d=c.offset();return{x:d.left+c.outerWidth()/2,y:d.top+c.outerHeight()/2}}});e.extend(e.simulate,{defaults:{speed:"sync"},VK_TAB:9,VK_ENTER:13,VK_ESC:27,VK_PGUP:33,VK_PGDN:34,VK_END:35,VK_HOME:36,VK_LEFT:37,VK_UP:38,VK_RIGHT:39,VK_DOWN:40})})(jQuery);
