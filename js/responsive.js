/*jslint browser: true*/
/*global $, jQuery*/

jQuery(document).ready(function ($) {

    // Switch from desktop to mobile menu and vice-versa
    $("#site-navigation .menu").tinyNav({
        header: tijara.tinyNavHeader,
        indent: tijara.tinyNavIndent
    });
    $(".tinynav").wrap( "<div class='mobile-only inline'></div>" );

    //Switch mobile fields on label click
    $('label[for="s"], label[for="tinynav1"]').click( function () {
        if($(this).hasClass('white')) {
            return;
        } else {
            $('#s, #tinynav1').toggle('fast');
            $('label[for="s"], label[for="tinynav1"]')
                .toggleClass('white')
                .toggleClass('gray')
            ;
        }
    });
});

/*! http://tinynav.viljamis.com v1.1 by @viljamis */
(function(a,k,g){a.fn.tinyNav=function(l){var c=a.extend({active:"selected",header:"",indent:"- ",label:""},l);return this.each(function(){g++;var h=a(this),b="tinynav"+g,f=".l_"+b,e=a("<select/>").attr("id",b).addClass("tinynav "+b);if(h.is("ul,ol")){""!==c.header&&e.append(a("<option/>").text(c.header));var d="";h.addClass("l_"+b).find("a").each(function(){d+='<option value="'+a(this).attr("href")+'">';var b;for(b=0;b<a(this).parents("ul, ol").length-1;b++)d+=c.indent;d+=a(this).text()+"</option>"}); e.append(d);c.header||e.find(":eq("+a(f+" li").index(a(f+" li."+c.active))+")").attr("selected",!0);e.change(function(){k.location.href=a(this).val()});a(f).after(e);c.label&&e.before(a("<label/>").attr("for",b).addClass("tinynav_label "+b+"_label").append(c.label))}})}})(jQuery,this,0);
