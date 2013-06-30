function select_address(){
}
select_address.prototype={
	//显示选择的div
	//configs input_id,address_category,multiple,address_class_name 
	 show_content:function(configs){
	 	 this.class_name=configs.class_name;
	 	
	   this.input_id=configs.input_id;
	   this.multiple=configs.multiple;
	   this.multiple_max=configs.multiple_max;
	   this.url=configs.url;
	   this.datas=configs.datas;
	   this.suburl=configs.suburl;
	   this.subdatas=configs.subdatas;
	   this.onchange_function=configs.onchange_function;
	   var default_selected=configs.default_selected;
	   
	   this.return_address=new Array();
	   if(default_selected){
	   	 var default_selected_len=default_selected.length;

	   	 for(var ii=0;ii<default_selected_len;ii++){
	 
	   	 	 var address_json={"address_id":default_selected[ii].id,"address_name":default_selected[ii].name};
	   	 	 this.return_address.push(address_json);
	   	}
	  }
	 	if(!this.wrapper_div){
	 	 //大div
	 	 this.wrapper_div=document.createElement("DIV");
	 	 this.wrapper_div.id="wrapper_div";
	 	 this.wrapper_div.style.position="absolute";
	 	 this.wrapper_div.className="wrapper_div";
	  }
	  if(!this.title_wrapper_div){
		  this.title_wrapper_div=document.createElement("DIV");
		  this.title_wrapper_div.id="title_wrapper_div";
		  this.title_wrapper_div.className="title_wrapper_div";
		  this.wrapper_div.appendChild(this.title_wrapper_div);
	  }
	  if(!this.parent_wrapper_div){
	 	 //父地址div
	 	 this.parent_wrapper_div=document.createElement("DIV");
	 	 this.parent_wrapper_div.id="parent_wrapper_div";
	 	 this.parent_wrapper_div.className="parent_wrapper";
	 	 this.wrapper_div.appendChild(this.parent_wrapper_div);
	 	}
	 	if(!this.self_wrapper_div){
	 	 //选项div
	 	 this.self_wrapper_div=document.createElement("DIV");
	 	 this.self_wrapper_div.id="self_wrapper_div";
	 	 this.self_wrapper_div.className="self_wrapper";
	 	 this.wrapper_div.appendChild(this.self_wrapper_div);
	 	}
	 	if(!this.close_button){
	 	 //关闭按钮
	 	 this.close_button=document.createElement("INPUT");
	 	 this.close_button.type="button";
	 	 this.close_button.className="close_button";
	   this.close_button.value="关闭";
	   this.close_button.id="address_close";
	   var self=this;
	    jQuery("#address_close").live('click',function(){
 	       	  self.close_wrapper();
 	    }); 
 	       	
 	       	
	   //Event.listen(this.close_button,'click',this.close_wrapper.bind(this));
	 	 this.wrapper_div.appendChild(this.close_button);
	 	}
	 	 document.body.appendChild(this.wrapper_div);
	 	 var offset=jQuery("#"+this.input_id).offset();
	 	 this.wrapper_div.style.top=offset.top+32+"px";
	 	 this.wrapper_div.style.left=offset.left+"px";
	 	 jQuery("#wrapper_div").fadeIn("slow"); 
	 	 jQuery("#self_wrapper_div").hide();
	 	 this.show_parent();
	 },
	 
   //关闭的响应函数
	 close_wrapper:function(){
	 	
	 	if(this.return_address!=""){
	 	 var address_name="";
	 	 var return_address_len=this.return_address.length;
	 	 for(var ii=0;ii<return_address_len;ii++){
	 	 	  if(!address_name)
	 	 	     address_name+=this.return_address[ii].address_name;
	 	 	  else
	 	 	  	 address_name+=","+this.return_address[ii].address_name;
	 	}
	 	
	 	var input_ids="";
	 	if(document.getElementById(this.input_id+"_id")){
	 		input_ids=document.getElementById(this.input_id+"_id");
	 	}else{
	   input_ids=document.createElement("INPUT");
	 	 input_ids.type="hidden";
	   input_ids.id=this.input_id+"_id";
	   input_ids.name=this.input_id+"_id";
	  }
	  var address_ids="";
	  for(var ii=0;ii<return_address_len;ii++){
	  	if(!address_ids)
	  	   address_ids+=this.return_address[ii].address_id;
	  	else
	  		 address_ids+=","+this.return_address[ii].address_id;
	  }
	  input_ids.value=address_ids;
	  
	  document.getElementById(this.input_id).parentNode.appendChild(input_ids);
	 	 jQuery("#"+this.input_id).val(address_name);
	 	 
	 	 if(this.onchange_function){
	  	var onchange_string=this.onchange_function+"()";
	  	eval(onchange_string);
	  	
	  }
	 }
	 	 jQuery("#wrapper_div").fadeOut("slow");
	 	 
	 },
	 //显示父地址
	 show_parent:function(){
	 	    this.parent_wrapper_div.innerHTML="";
	 	    this.self_wrapper_div.innerHTML="";
	 	    var multiple=this.multiple;
	 	    var that=this;
	 	    jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
	          jQuery("#parent_wrapper_div").html("<div class='loading_progress'><img  src='/css/images/progress.gif'></div>");
			   },
			   url: this.url,
			   data: this.datas+"&rnd="+Math.random(),
			   success: function(msg){
            var json_obj=eval('('+msg+')');
            var parent_address=json_obj.parent_address;
            var self_address=json_obj.self_address;

            //有父地址
            if(String(parent_address).trimn()){
            	var result_str="";
            	var parent_address_len=parent_address.length;
            	for(var ii=0;ii<parent_address_len;ii++){
            		result_str+="<span id='parent_address_"+parent_address[ii].id+"' class='parent_item'><a  href=\"javascript:"+that.class_name+".show_child('"+parent_address[ii].id+"');\">"+parent_address[ii].name+"</a></span>";
            	}
            	jQuery("#parent_wrapper_div").html(result_str);
            	jQuery("#parent_wrapper_div").fadeIn("fast");
            //没有父地址
            }else{
            	var result_str="";
            	var self_address_len=self_address.length;
            	
            	//多选
            	if(multiple){
            		for(var ii=0;ii<self_address_len;ii++){
            		   result_str+="<span id='child_address_"+self_address[ii].id+"' class='child_item'><input type='checkbox' onclick=\"javascript:"+that.class_name+".click_check_box('"+self_address[ii].id+"','"+self_address[ii].name+"')\" name='check_item' id='checkbox_"+self_address[ii].id+"'><a><label  for='checkbox_"+self_address[ii].id+"'>"+self_address[ii].name+"</label></a></span>";
            	  }
    
            	 //单选
            	}else{
            		
            	  for(var ii=0;ii<self_address_len;ii++){
            		   result_str+="<span id='child_address_"+self_address[ii].id+"' class='child_item'><a href=\"javascript:"+that.class_name+".show_address('"+self_address[ii].id+"','"+self_address[ii].name+"');\">"+self_address[ii].name+"</a></span>";
            	  }
              }
            	jQuery("#parent_wrapper_div").html(result_str);
            	jQuery("#parent_wrapper_div").fadeIn("fast");
           
            	   that.setdefaultselect();
            }                
         }
			});
	 },
	 //显示子地址
	 show_child:function(address_id){
	 	    
	 	    var multiple=this.multiple;
	 	    jQuery(".parent_item>a").css("color","");
        jQuery("#parent_address_"+String(address_id)+">a").css("color","#ff0000");
        var that=this;
	 	    jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
			   	  jQuery("#self_wrapper_div").html("<div class='loading_progress'><img  src='/css/images/progress.gif'></div>");
			   },
			   url: this.suburl,
			   data: "address_id="+address_id+"&"+this.subdatas+"&rnd="+Math.random(),
			   success: function(msg){
              var json_obj=eval('('+msg+')');
              var self_address=json_obj.self_address;
              var self_address_len=self_address.length;
              if(self_address_len){
              var result_str="";

            	//多选
            	if(multiple){
            		for(var ii=0;ii<self_address_len;ii++){
            		   result_str+="<span id='child_address_"+self_address[ii].id+"' class='child_item'><input type='checkbox' onclick=\"javascript:"+that.class_name+".click_check_box('"+self_address[ii].id+"','"+self_address[ii].name+"')\" name='check_item' id='checkbox_"+self_address[ii].id+"'><a><label for='checkbox_"+self_address[ii].id+"'>"+self_address[ii].name+"</label></a></span>";
            	  }
            	  
            	//单选
            	}else{
            	  for(var ii=0;ii<self_address_len;ii++){
            		   result_str+="<span id='child_address_"+self_address[ii].id+"' class='child_item'><a href=\"javascript:"+that.class_name+".show_address('"+self_address[ii].id+"','"+self_address[ii].name+"');\">"+self_address[ii].name+"</a></span>";
            	  }
              }
            	jQuery("#self_wrapper_div").html(result_str);
            	jQuery("#self_wrapper_div").fadeIn("fast");
            	
            	that.setdefaultselect();
            	
            }else{
            	  jQuery("#self_wrapper_div").hide();
            }
           }
         
			 });
	 },
	 //点击地址项
	 show_address:function(address_id,address_name){
	 	  jQuery(".child_item>a").css("color","");
	 	  jQuery("#child_address_"+String(address_id)+">a").css("color","#ff0000");
	 	  
	 	  if(!this.find_address_id(address_id)){
	 	  	this.return_address=new Array();
	 	    var address_json={"address_id":address_id,"address_name":address_name};
	 	    this.return_address.push(address_json);
	 	  }
	 },
	 //点击多选项
	 click_check_box:function(address_id,address_name){
	 	if(this.multiple_max){
	 		 var return_address_len=this.return_address.length;
	 		 var check_flag=jQuery("#checkbox_"+String(address_id)).attr("checked");

	 		 if((return_address_len>=this.multiple_max)&&check_flag){
	 		 	  alert("最多选择"+this.multiple_max+"个");
	 		 	  jQuery("#checkbox_"+String(address_id)).attr("checked",false);
	 		 }else{
	 		 	 jQuery("#child_address_"+String(address_id)+">a").css("color","#ff0000");
	 	     if(check_flag){
	 		   if(!this.find_address_id(address_id)){
	 	 	     var address_json={"address_id":address_id,"address_name":address_name};
	 	  	  this.return_address.push(address_json);
	 	     }
	 	   }else{
	 		   jQuery("#child_address_"+String(address_id)+">a").css("color","");
	 		   this.remove_address_id(address_id);
	 	   }
	 	 }
	 		
	 	}else{
	 		   jQuery("#child_address_"+String(address_id)+">a").css("color","#ff0000");
	 	     var check_flag=jQuery("#checkbox_"+String(address_id)).attr("checked");
	 	     if(check_flag){
	 		   if(!this.find_address_id(address_id)){
	 	 	     var address_json={"address_id":address_id,"address_name":address_name};
	 	  	  this.return_address.push(address_json);
	 	     }
	 	   }else{
	 		   jQuery("#child_address_"+String(address_id)+">a").css("color","");
	 		   this.remove_address_id(address_id);
	 	   }
	 		
	 	}
	 	
	 	

	 },
	 //判断地址数组中是否有address_id
	 find_address_id:function(address_id){
	 	  var return_address_len=this.return_address.length;
	 	  var return_flag=false;
	 	  for(var ii=0;ii<return_address_len;ii++){
	 	  	   if(this.return_address[ii].address_id==address_id)
	 	  	      return_flag=ii+1;
	 	  }
	 	  return return_flag;
	 },
	 //移除地址数组中含有address_id的选项
	 remove_address_id:function(address_id){
	 	   var address_index=this.find_address_id(address_id);
	 	   if(address_index)
	 	      this.return_address.splice(address_index-1,1);
	 },
	 
	 setdefaultselect:function(){
	 	   if(this.return_address){
	 	   	  var return_address_len=this.return_address.length;
	 	   	  for(var ii=0;ii<return_address_len;ii++){
	 	   	  	if(this.multiple){
	 	   	  	 if(document.getElementById("checkbox_"+String(this.return_address[ii].address_id))){
	 	   	  	   jQuery("#child_address_"+String(this.return_address[ii].address_id)+">a").css("color","#ff0000");
	 	   	  	   document.getElementById("checkbox_"+String(this.return_address[ii].address_id)).checked=true;
	 	   	  	 
	 	   	  	}
	 	   	  }else{
	 	   	  	jQuery("#child_address_"+String(this.return_address[ii].address_id)+">a").css("color","#ff0000");
	 	   	  }
	 	   	 }
	 	  }
	 }
	 
	 
}