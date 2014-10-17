/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

(function($){var Plugin=function(){};Plugin.prototype=$.extend(Plugin.prototype,{name:"Update",options:{msgPerformingUpdate:"Performing Update...",msgFinished:"Update successfull...Reload page to continue working.",msgError:"Error during update. Please visit the YOOtheme support forums."},initialize:function(form,options){this.options=$.extend({},this.options,options);var $this=this;this.form=form;form.find("button.update").bind("click",function(){$(this).parent().remove();$this.step()})},step:function(){var form=this.form;var $this=this;$.ajax({url:form.attr("action"),type:"post",datatype:"json",data:form.serialize(),beforeSend:function(){$this.addMessage($this.options.msgPerformingUpdate,"loading")},success:function(data){try{data=$.parseJSON(data)}catch(e){data={error:true,message:data}}form.find("div.message-box").find("div.message").last().removeClass("loading");if(data.error){$this.addMessage(data.message,"error")}else{$this.addMessage(data.message);if(data["continue"]){$this.step()}else{$this.addMessage($this.options.msgFinished,"success")}}},error:function(jqXHR,error){form.find("div.message-box").find("div.message").last().removeClass("loading");$this.addMessage(error,"error")}})},addMessage:function(message,addClass){var message=$('<div class="message">').text(message).appendTo(this.form.find("div.message-box"));if(addClass)message.addClass(addClass)}});$.fn[Plugin.prototype.name]=function(){var args=arguments;var method=args[0]?args[0]:null;return this.each(function(){var element=$(this);if(Plugin.prototype[method]&&element.data(Plugin.prototype.name)&&method!="initialize"){element.data(Plugin.prototype.name)[method].apply(element.data(Plugin.prototype.name),Array.prototype.slice.call(args,1))}else if(!method||$.isPlainObject(method)){var plugin=new Plugin;if(Plugin.prototype["initialize"]){plugin.initialize.apply(plugin,$.merge([element],args))}element.data(Plugin.prototype.name,plugin)}else{$.error("Method "+method+" does not exist on jQuery."+Plugin.name)}})}})(jQuery);