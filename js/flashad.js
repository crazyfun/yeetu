function flashad(options){
  this.options=options;
  this.current_id=0;
  this.datas_length="";
  
}
flashad.prototype={
  rend_ad:function(){
  	var content="";
  	var adview=this.options.adview;
  	var datas=this.options.datas;
  	var pic_width=this.options.pic_width;
  	var pic_heihgt=this.options.pic_heihgt;
  	var text_height=this.options.text_height;
  	var show_time=this.options.show_time;
  	var auto=this.options.auto;
  	var auto_time=this.options.auto_time||2000;
  	var text_show=this.options.text_show;
  	var datas_length=datas.length;
  	this.datas_length=datas_length;
  	var text_width=(pic_width/datas_length)-1;
  	content+="<div class='f_wrapper'><div class='f_wrapperimg'>";
  	for(var ii=0;ii<datas_length;ii++){
  		var data=datas[ii];
  		var display_flag="none";
  		if(ii==0){
  			display_flag="block";
  		}
  		content+="<div class='f_apic' style='height:"+pic_heihgt+"px;width:"+pic_width+"px;display:"+display_flag+";' id='f_"+String(ii)+"'><a href='"+data.ad_link+"' target='_blank'><img src='"+data.ad_src+"' width='"+pic_width+"' height='"+pic_heihgt+"'/></a></div>";
  	}
  	content+="</div>";
  	if(text_show){
  	 content+="<div class='f_banner'>";
  	 for(var ii=0;ii<datas_length;ii++){
  		 var data=datas[ii];
  		 var add_class="";
  		 if(ii==0){
  		 	  add_class="f_name_select";
  		  }
  		 content+="<div class='f_name "+add_class+"' id='n_"+String(ii)+"' style='width:"+text_width+"px;height:"+text_height+"px;'>"+data.ad_name+"</div>";
  	 }
  	 content+="</div>";
   }
  	content+="</div>";
  	
  	
    self=this;
  	jQuery("#"+adview).html(content);
  	if(text_show){
  	 jQuery(".f_name").click(function(){
  		var click_this=jQuery(this);
  		var n_id=click_this.attr("id");
  		var i_ids=n_id.split("_");
  		self.show(i_ids[1]);
  		if(self.auto_timeout){
  		  window.clearTimeout(self.auto_timeout);
  		  self.auto_timeout=window.setTimeout(self.autoscroll,auto_time);
  	  }
  	}).hover(function(){jQuery(this).addClass("f_name_select_hover");},function(){jQuery(this).removeClass("f_name_select_hover");});
  	}

  	if(auto){
  		self.auto_timeout=window.setTimeout(self.autoscroll,auto_time);
  	}
  },
  
  show:function(i_id){
  	var img_id="f_"+String(i_id);
  	var name_id="n_"+String(i_id);
  	jQuery(".f_apic").hide();
  	jQuery("#"+img_id).fadeIn(this.options.show_time); 
  	if(this.options.text_show){
  	 jQuery(".f_name_select").removeClass("f_name_select");
  	 jQuery("#"+name_id).addClass("f_name_select");
  	}
  	this.current_id=i_id;
  	
  },
  
  autoscroll:function(){
  	var datas_length=self.datas_length;
  	for(var ii=0;ii<datas_length;ii++){
  		var img_id="f_"+String(ii);
  		jQuery("#".img_id).hide();
  	}
  	var show_id="";
  	if(parseInt(self.current_id)<(datas_length-1)){
  		 show_id=parseInt(self.current_id)+1;
  	}else{
  		 show_id=0;
  	}
  	self.show(show_id);
  	self.auto_timeout=window.setTimeout(self.autoscroll,self.options.auto_time);
  	
  }
	
}