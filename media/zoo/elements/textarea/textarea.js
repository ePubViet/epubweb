/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

(function($){var Plugin=function(){};$.extend(Plugin.prototype,{name:"ElementRepeatableTextarea",initialize:function(element){var list=element.find("ul.repeatable-list");list.find("li.hidden").each(function(){$(this).find("*").each(function(){if($(this).attr("name")){$(this).data("name",$(this).attr("name"));$(this).attr("name","")}})});element.delegate("span.delete","click",function(){$(this).closest("li.repeatable-element").fadeOut(200,function(){$(this).addClass("hidden");$(this).find("*").each(function(){if($(this).attr("name")){$(this).attr("name","")}})})});element.find("p.add a").bind("click",function(){var editor=$(list.find("li.hidden").get(0)).removeClass("hidden");editor.find("*").each(function(){if($(this).data("name"))$(this).attr("name",$(this).data("name"))});editor.find("div.repeatable-content").effect("highlight",{},1e3);if(list.find("li.hidden").length==0)$(this).parent().hide()})}});$.fn[Plugin.prototype.name]=function(){var args=arguments;var method=args[0]?args[0]:null;return this.each(function(){var element=$(this);if(Plugin.prototype[method]&&element.data(Plugin.prototype.name)&&method!="initialize"){element.data(Plugin.prototype.name)[method].apply(element.data(Plugin.prototype.name),Array.prototype.slice.call(args,1))}else if(!method||$.isPlainObject(method)){var plugin=new Plugin;if(Plugin.prototype["initialize"]){plugin.initialize.apply(plugin,$.merge([element],args))}element.data(Plugin.prototype.name,plugin)}else{$.error("Method "+method+" does not exist on jQuery."+Plugin.name)}})}})(jQuery);