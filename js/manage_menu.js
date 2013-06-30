function Managemenu(){
	this.options={};
	this.iframe="";
	this.history_link="";
	this.tabs=new Array();
}
Managemenu.prototype={
	init:function(options){
		this.set_options(options);
		this.class_name=this.options.class_name;
		var iframe_id=this.options.iframe_id;
		var history_link_id=this.options.history_link_id;
		if(iframe_id)
		   this.iframe=document.getElementById(iframe_id);
		else
		   this.iframe=document.getElementById("right_content");
		if(history_link_id)
		   this.history_link=document.getElementById(history_link_id);
		 else
		 	 this.history_link=document.getElementById("history_link");
	},
	set_options:function(options){
		this.options=options;
	},
	show_right_content:function(key,value,url,is_click){
		
	  this.set_iframe_url(url);
		if(!is_click)
		   this.set_history_tab(key,value,url);
	},
	show_sub_item:function(key,value){
		var submenu=document.getElementById("submenu_"+String(key));
		var subitem_button=document.getElementById("subitem_button_"+String(key));
		if(submenu.style.display=="block"){
			submenu.style.display="none";
			subitem_button.innerHTML='<span class="jia"><span>';
		}else{
			submenu.style.display="block";
			subitem_button.innerHTML='<span class="jian"><span>';
		}
	},
	set_iframe_url:function(url){
		this.iframe.src=url||"";
	},
	set_history_tab:function(key,value,url){
		var tab_key=this.is_tab_exist(key);
		if(tab_key){
			tab_key=tab_key-1;
			this.show_right_content(this.tabs[tab_key].key,this.tabs[tab_key].value,this.tabs[tab_key].url,true);
		}else{
		 var right_content_tab=document.getElementById("right_content_tab");
		 var tab_li=document.createElement("LI");
		 tab_li.className="right_content_tab_li";
		 tab_li.id="right_content_tab_li_"+key;
		 var tab_text_a=document.createElement("A");
		 tab_text_a.href="javascript:"+this.class_name+".show_right_content('"+key+"','"+value+"','"+url+"','','');";
		 var tab_text=document.createElement('SPAN');
		 tab_text.className="li_text";
		 tab_text.innerHTML=value;
		 tab_text_a.appendChild(tab_text);
		 var tab_delete=document.createElement('SPAN');
		 tab_delete.innerHTML="×";
		 tab_delete.className="li_delete";
		 var that=this;
		 tab_delete.onclick=function(){
			 right_content_tab.removeChild(tab_li);
			 that.remove_tab(key);
			 var classname=this.parentNode.className;
			 if(classname=="right_content_tab_li_select"){
			 	that.set_iframe_url("");
			 }
		 }
		 tab_li.appendChild(tab_text_a);
		 tab_li.appendChild(tab_delete);
		 right_content_tab.appendChild(tab_li);
		 var json_obj={"key":key,"value":value,"url":url};
		 this.tabs.push(json_obj);
	 }
	 	jQuery(".right_content_tab_li_select").attr("class","right_content_tab_li");
		document.getElementById("right_content_tab_li_"+key).className="right_content_tab_li_select";
	},
	is_tab_exist:function(key){
		var len=this.tabs.length;
		for(var ii=0;ii<len;ii++){
			if(this.tabs[ii].key===key){
				return ii+1;
			}
		}
		return false;
	},
	remove_tab:function(key){
		var return_array=new Array();
		var tab_key=this.is_tab_exist(key);
		var len=this.tabs.length;
		for(var ii=0;ii<len;ii++){
			if(ii!=tab_key-1){
				return_array.push(this.tabs[ii]);
			}
		}
		this.tabs=return_array;
	}
}
function Clock() {
	var date = new Date();
	this.year = date.getFullYear();
	this.month = date.getMonth() + 1;
	this.date = date.getDate();
	this.day = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六")[date.getDay()];
	this.hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
	this.minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
	this.second = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();

	this.toString = function() {
		return "现在是:" + this.year + "年" + this.month + "月" + this.date + "日 " + this.hour + ":" + this.minute + ":" + this.second + " " + this.day; 
	};
	this.toSimpleDate = function() {
		return this.year + "-" + this.month + "-" + this.date;
	};
	
	this.toDetailDate = function() {
		return this.year + "-" + this.month + "-" + this.date + " " + this.hour + ":" + this.minute + ":" + this.second;
	};
	
	this.display = function(ele) {
		var clock = new Clock();
		ele.innerHTML = clock.toString();
		window.setTimeout(function() {clock.display(ele);}, 1000);
	};
}