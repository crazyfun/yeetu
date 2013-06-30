function extend(subClass,superClass){
    var F = function(){};

     F.prototype = superClass.prototype;

     subClass.prototype = new F();

     subClass.prototype.constructor = subClass;

      subClass.superclass = superClass.prototype;

      if(superClass.prototype.constructor == Object.prototype.constructor){

         superClass.prototype.constructor = superClass;

      }
}
var tb_pathToImage = "/css/images/loadingAnimation.gif";
function Dialog(){
	this.title="";
	this.button="";
	this.options="";
}
Dialog.prototype={
  set_title:function(title){
  	this.title=title;
  },
  set_button:function(button){
    this.button=button;
  },
  show_dialog:function(title,button,options){
  	
  	this.title=title||"";
  	this.button=button||{};
  	this.options=options||{};
    this.render_dialog();
  },
  render_dialog:function(){

   if(this.options.overlay){
   	var window_wrapper="";
   	if(!ge("window_wrapper")){
   		window_wrapper=document.createElement("DIV");
   		var userAgent = navigator.userAgent.toLowerCase();
      if (userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox')!=-1) {
          window_wrapper.className="TB_overlayMacFFBGHack"; 
   		}else{
   			  window_wrapper.className="window_wrapperBG";
   		}
   		window_wrapper.id="window_wrapper";
   		var self=this;
   		window_wrapper.ondblclick=function(){
   			self.hide();
   		};
    }else{ 
    	window_wrapper=ge("window_wrapper");
    }
      var tb_load=document.createElement("DIV");
      tb_load.id="TB_load";
      tb_load.innerHTML='<img src="'+tb_pathToImage+'">';
      document.body.appendChild(tb_load);
      document.body.appendChild(window_wrapper);
      this.set_init();
      var self=this;
      window.setTimeout(function(){self.show();},this.options.time?this.options.time:1000);
   }else{
    	if(ge("window_wrapper")){
   		 document.body.removeChild(ge("window_wrapper"));
   	  }
   	  var tb_load=document.createElement("DIV");
      tb_load.id="TB_load";
      tb_load.innerHTML='<img src="'+tb_pathToImage+'">';
      document.body.appendChild(tb_load);
      this.set_init();
      var self=this;
      window.setTimeout(function(){self.show();},this.options.time?this.options.time:1000);
   }
  },
  set_init:function(){
  	  var content=this.render_content();
      document.body.appendChild(content);
  	  var content_obj=ge(this.options.HiddenID);
  	  ge("dialog_center").appendChild(content_obj.children[0]);
 	    //DOM.appendContent(ge("dialog_center"),content_obj.children[0]);
 	    Event.listen(ge("ok_button"),'click',this.click_ok.bind(this));
 	    Event.listen(ge("cancel_button"),'click',this.click_cancel.bind(this));
 	    Event.listen(ge("dialog_close"),'click',this.click_close.bind(this));
  		this.position();
  		//this.show();
  },
 render_content:function(){
 	var window_content="";
 	if(!ge("window_content")){
 		 window_content=document.createElement("DIV");
 		 window_content.className="window_content";
 		 window_content.id="window_content";
 		 CSS.setStyle(window_content,"width",String(this.options.width)+"px");
 		 CSS.setStyle(window_content,"height",String(this.options.height)+"px");
 	}else{
 		 if(this.options.HiddenID){
 		 	if(ge("dialog_center").children[0])
 	  	  ge(this.options.HiddenID).appendChild(ge("dialog_center").children[0]);
 	   }
 		 window_content=ge("window_content");
 		 CSS.setStyle(window_content,"width",String(this.options.width)+"px");
 		 CSS.setStyle(window_content,"height",String(this.options.height)+"px");
 	}
 	 var button_content=this.rend_button();
 	 window_content.innerHTML="<table width='100%' cellspacing='0' cellpadding='0'><tbody><tr><td class='left_top'></td><td class='mid_con'></td><td class='right_top'></td></tr><tr><td class='c_mid_con'></td><td class='c_mid_con'><div id='center_content' class='center_content'><div class='center_title' id='center_title'><span class='dialog_title' id='dialog_title'>"+this.title+"</span><span class='dialog_close' id='dialog_close'>关闭</span></div><div class='dialog_center' id='dialog_center'></div><div class='dialog_button' id='dialog_button'>"+button_content+"</div></div></td><td class='c_mid_con'></td></tr><tr><td class='left_bottom'></td><td class='mid_con'></td><td class='right_bottom'></td></tr></tbody></table>";
 	 return window_content;
 },
 rend_button:function(){
 	var button_content="<div class='button_wrapper' id='button_wrapper'><span class='ok_button'><input id='ok_button' type='button'  value='"+this.button.ok_button.name+"'/></span><span><input id='cancel_button' type='button'  value='"+this.button.cancel_button.name+"'/></span></div>";
 	return button_content;
 },
 
 click_ok:function(){
 	var func=this.button.ok_button.func;
 	if(func){
 		eval(func)
 	}else{
 	  this.hide();
 	 }
 },
 
 click_cancel:function(){
 	var func=this.button.cancel_button.func
 	if(func){
 		eval(func)
 	}else{
 	  this.hide();
 	}
 },
 click_close:function(){
 	  this.hide();
 },
 show:function(){
 	if(ge("TB_load")){
  	  	document.body.removeChild(ge("TB_load"));
  	  }
 	if(ge("window_wrapper")){
 		  jQuery("#window_wrapper").fadeIn("fast");
 		  jQuery("#window_content").fadeIn("fast");
 	}else{
 		  jQuery("#window_content").fadeIn("fast");
 	}
 	if(this.options.auto){
 		var self=this;
 		window.setTimeout(function(){self.hide();},5000);
 	}
 },
 hide:function(){
 	  if(this.options.HiddenID){
 	  	if(ge("dialog_center").children[0])
 	  	  ge(this.options.HiddenID).appendChild(ge("dialog_center").children[0]);
 	  }
 	  if(ge("window_wrapper")){
 	  	jQuery("#window_wrapper").fadeOut("fast");
 		  jQuery("#window_content").fadeOut("fast");
 	  }else{
 	  	jQuery("#window_content").fadeOut("fast");
 	  }
 },
 position:function() {
  var pagesize = getPageSize();
  var x=pagesize[0];
  var y=pagesize[1];
  if(ua.ie()<=6){
    CSS.setStyle(ge("window_content"),"left",(parseInt((x-this.options.width)/2)) + 'px');
  }else{
   	CSS.setStyle(ge("window_content"),"marginLeft",parseInt((x-this.options.width)/2) + 'px');
  }
 }
}


function FrameDialog(){
	Dialog.call(this);

	 
}
extend(FrameDialog,Dialog);

	FrameDialog.prototype.set_init=function(){
  	  var content=this.render_content();
      document.body.appendChild(content);
 	    Event.listen(ge("ok_button"),'click',this.click_ok.bind(this));
 	    Event.listen(ge("cancel_button"),'click',this.click_cancel.bind(this));
 	    Event.listen(ge("dialog_close"),'click',this.click_close.bind(this));
  		this.position();
  };
  

  
  
 FrameDialog.prototype.render_content=function(){
 	var window_content="";
 	if(!ge("window_content")){
 		 window_content=document.createElement("DIV");
 		 window_content.className="window_content";
 		 window_content.id="window_content";
 		 CSS.setStyle(window_content,"width",String(this.options.width)+"px");
 		 CSS.setStyle(window_content,"height",String(this.options.height)+"px");
 	}else{

 		 window_content=ge("window_content");
 		 CSS.setStyle(window_content,"width",String(this.options.width)+"px");
 		 CSS.setStyle(window_content,"height",String(this.options.height)+"px");
 	}
 	 var button_content=this.rend_button();
 	 window_content.innerHTML="<table width='100%' cellspacing='0' cellpadding='0'><tbody><tr><td class='left_top'></td><td class='mid_con'></td><td class='right_top'></td></tr><tr><td class='c_mid_con'></td><td class='c_mid_con'><div id='center_content' class='center_content'><div class='center_title' id='center_title'><span class='dialog_title' id='dialog_title'>"+this.title+"</span><span class='dialog_close' id='dialog_close'>关闭</span></div><div class='dialog_center' id='dialog_center'><iframe frameborder='0' class='dialog_iframe' style='width:"+(this.options.width-60)+"px;height:"+this.options.height+"px;' src='"+this.options.FrameUrl+"'></iframe></div><div class='dialog_button' id='dialog_button'>"+button_content+"</div></div></td><td class='c_mid_con'></td></tr><tr><td class='left_bottom'></td><td class='mid_con'></td><td class='right_bottom'></td></tr></tbody></table>";
 	 return window_content;
 };
 
 
 FrameDialog.prototype.hide=function(){
 	  if(ge("window_wrapper")){
 	  	jQuery("#window_wrapper").fadeOut("fast");
 		  jQuery("#window_content").fadeOut("fast");
 	  }else{
 	  	jQuery("#window_content").fadeOut("fast");
 	  }
 };
	




