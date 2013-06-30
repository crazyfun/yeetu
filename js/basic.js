//页面加载
jQuery(document).ready(function(){
	if(ua.ie())
      DD_belatedPNG.fix('div, ul, img, li, input , a');
	 jQuery("input[type='text'],input[type='password'],textarea").focus(function(){ 
      jQuery(this).addClass("input_select"); 
   }).hover(
     function(){
     	jQuery(this).addClass("input_select_hover"); 
     },
     function(){
     	
     	jQuery(this).removeClass("input_select_hover"); 
    }
   ); 
   jQuery("input[type='text'],input[type='password'],textarea").blur(function(){         
               jQuery(this).removeClass("input_select"); 
   });
    
    //qa
    jQuery(".ask_classify_select").change(function(){
    	
        jQuery("#filter_by_cat").trigger("click");
    });
    
    
    jQuery(".newest_box1").hover(
      function(){
      	
      	jQuery(this).addClass("newest_box1_hover");
     },
      function(){
      	jQuery(this).removeClass("newest_box1_hover");
     }
    
    );
    
    
    jQuery(".Recommended>ul>li").hover(
      function(){
      	jQuery(this).addClass("newest_box1_hover");
     },
      function(){
      	jQuery(this).removeClass("newest_box1_hover");
     }
    
    );
    
    var treve_hover_timeout="";
    jQuery(".trave_hover").hover(
      function(){
      	var that=this;
      	treve_hover_timeout=window.setTimeout(function(){jQuery(that).find(".trave_hover_details").fadeIn("fast");},"500");
      },
      function(){
      	window.clearTimeout(treve_hover_timeout);
      	jQuery(this).find(".trave_hover_details").hide();
      }
    
    
    );
    
    
     jQuery(".flash_right_ad_i").hover(
      function(){
      	jQuery(this).fadeTo("fast",1);
      },
      function(){
      	jQuery(this).fadeTo("fast",0.9);
      }
    );
    
    
    jQuery(".bbs_thread_title").hover(
      function(){
      	jQuery(".bbs_thread_title").show();
        jQuery(this).hide();
        jQuery(".bbs_thread_content").hide();
      	jQuery(this).next(".bbs_thread_content").show();
      },
      
      function(){
      	
      }
    
    );
    
    jQuery(".bbs_thread_ytitle").hover(
      function(){
      	jQuery(".bbs_thread_ytitle").show();
        jQuery(this).hide();
        jQuery(".bbs_thread_ycontent").hide();
      	jQuery(this).next(".bbs_thread_ycontent").show();
      },
      
      function(){
      	
      }
    
    );
  
    
    jQuery("#answer").bind("click",function(){
        var serialize_values=jQuery("#answer_form").serialize();
        jQuery.ajax({
            type: "POST",
            beforeSend: function(){
            },
            url: window.location.href,
            processData:true,
            data: serialize_values+"&rnd="+Math.random(),
            dataType:'json',
            success: function(data){
                var code = data.code;
                if(code == 1){
                    //未登录
                    var params = combine_login_page_params(data.params);
                    if(confirm(data.msg)){
                        window.location.href="index.php?r=site/login"+params;
                    }
                }else if(code == 2){
                    //成功提交
                //    jQuery("#answers_list").load("index.php?r=qa/view&id="+data.params.qid);
				//	show_tip_dialog("提示",data.msg);
					window.location.reload();
                    jQuery("#answer_content").val("");
                    jQuery("#remaining_words_count").html(1000).css({'color':'green'});
                }else if(code == 3){
                    //错误
                    jQuery("#msg").html(data.msg);
                }
            }
        });
        return false;
    });

    jQuery(".best_answer").bind('click',function(){
        var _dom = jQuery(this);
        var form = _dom.parent();
        var serialize_values=form.serialize();
        var url = form.attr('action');
        jQuery.ajax({
            type: "GET",
            beforeSend: function(){
            },
            url: url,
            processData:true,
            data: serialize_values+"&rnd="+Math.random(),
            dataType:'text',
            success: function(data){
                if(data == 1){
                    window.location.reload();
                }
            }
        });
    });

    jQuery(".ding").bind('click',function(){
        var _dom = jQuery(this);
        var form = _dom.parent();
        var serialize_values=form.serialize();
        var url = form.attr('action');
        jQuery.ajax({
            type: "GET",
            beforeSend: function(){
            },
            url: url,
            processData:true,
            data: serialize_values+"&rnd="+Math.random(),
            dataType:'text',
            success: function(data){
                var n = parseInt(data);
                if(n){
                    _dom.before("<span style='color:#FF4400;font-size:14px;padding-left:10px;'>顶("+n+")</span>").remove();
                }
            }
        });

        return false;
    });
   if(document.getElementById('search_trave_name')){
    jQuery('#search_trave_name').autocomplete({ 
    	  serviceUrl:'/index.php/site/compeletetrave',
    	  minChars:1, 
    	  delimiter: /(,|;)\s*/, 
    	  maxHeight:400,
    	  width:185,
    	  zIndex: 9999,
    	  deferRequestBy: 0, 
    	 // params: { country:'Yes' }, //aditional parameters
    	  noCache: true, 
    	  onSelect: function(value, data){
    	
    	  }
    });
   }
jQuery("#choose_select").toggle(
    function(){
       jQuery("#choose_select").addClass("choose_district_on");
       jQuery("#choose_content").slideDown('fast',function(){ 
       });
    },
    function(){
    	jQuery("#choose_content").slideUp("fast",function(){
 	   		jQuery("#choose_select").removeClass("choose_district_on");
 	    });
    }
 	);
 	jQuery("#hover_stage").hover(
 	  function(){	
 	  },
 	  function(){
 	   	jQuery("#choose_content").slideUp("fast",function(){
 	   		jQuery("#choose_select").removeClass("choose_district_on");
 	    });
 	  }
 	);
 	
 	
 	
 	jQuery(".validate_input").live("focus",function(){
  		  	var siblings=jQuery(this).siblings(".input_error");
  		  	var show_content=siblings.attr("show_content");
  		  	siblings.html(show_content); 
  		  }).live("blur",function(){
  		  	var input_id=jQuery(this).attr("id");
  		  	 var input_value=jQuery(this).val();
  		  	 var siblings=jQuery(this).siblings(".input_error");
  		  	 
  		  	   if(input_id=="User_password"){
            		if(input_value){
            		 if(input_value.gblen()<6){
            		 	siblings.html("<div class='errorMessage'>密码不能小于6个字符</div>");
            		 	return false;
            		}else{
            		   siblings.html("<div class='loading_progress'><img src='/css/images/login_io.gif'></div>");
            		   return false;
            		 }
            	 }else{
            	 	siblings.html("<div class='errorMessage'>密码不能为空</div>");
            	 	return false;
            	 }
            	}else if(input_id=="User_con_password"){
            		 var password=jQuery("#User_password").val();
            		 if(!input_value){
            		 	 siblings.html("<div class='errorMessage'>确认密码不能为空</div>");
            		 	return false;
            		 }else if(input_value!=password){
            		 	siblings.html("<div class='errorMessage'>确认密码输入错误</div>");
            		 	return false;
            		 }else{
            		 	siblings.html("<div class='loading_progress'><img src='/css/images/login_io.gif'></div>");
            		 	return false;
            		}
            	/*}else if(input_id=="User_user_phone"){
            		  if(!input_value){
            		  	siblings.html("<div class='errorMessage'>手机号码为空</div>");
            		  	return false;
            		  }
            		 
            		  else if(!is_phone(input_value,'cell')){
            		  	 	siblings.html("<div class='errorMessage'>手机号码格式不正确</div>");
            		  	  return false;
            		   }
            		
            		  else{
            		  	siblings.html("<div class='loading_progress'><img src='/css/images/login_io.gif'></div>");
            		   	return false;
            		  }
            		  */
            		
            	}else if(input_id=="User_user_login"){
                if(!input_value){
            		 siblings.html("<div class='errorMessage'>用户名不能为空</div>");
            		 return false;
            		}
            	}else if(input_id=="User_email"){
            		if(!input_value){
            		 siblings.html("<div class='errorMessage'>电子邮件不能为空</div>");
            		 return false;
            		}
            	}
  		  	       jQuery.ajax({
                   type: "POST",
                   beforeSend: function(){
            	       siblings.html("<div class='loading_progress'><img src='/css/images/progress.gif'></div>");
                   },
                  url:"/index.php/site/registeverification",
                  processData:true,
                  data: "valide_type="+input_id+"&input_value="+input_value+"&rnd="+Math.random(),
                  dataType:'json',
                  success: function(data){
                     if(data.json_type=="Y"){
                	      siblings.html("<div class='loading_progress'><img src='/css/images/login_io.gif'></div>");
                     }else{
                	      siblings.html("<div class='errorMessage'>"+data.json_content+"</div>");
                      }
                   }
  		           });
  		       
  		  });
  		  
  		  
  		  
  		  
   jQuery(".search_condition_span").hover(
       function(){
       	 
       	 jQuery(this).addClass("search_condition_span_hover");
       },
      
      function(){
      	jQuery(this).removeClass("search_condition_span_hover");
      }
    );
    
    jQuery(".search_sclist").hover(
      function(){
      	jQuery(this).removeClass("bgcolor");
      	jQuery(this).addClass("bgcolor_hover");
      },
      function(){
      	jQuery(this).removeClass("bgcolor_hover");
      	jQuery(this).addClass("bgcolor");
      }
    );
    
   if(document.getElementById('trave_name_input')){
    jQuery('#trave_name_input').autocomplete({ 
    	  serviceUrl:'/index.php/search/compeletetrave',
    	  minChars:1, 
    	  delimiter: /(,|;)\s*/, 
    	  maxHeight:400,
    	  width:100,
    	  zIndex: 9999,
    	  deferRequestBy: 0, 
    	 // params: { country:'Yes' }, //aditional parameters
    	  noCache: true, 

    	  onSelect: function(value, data){
    	
    	  }
    });
   }


   jQuery("#detailed_infor_down").toggle(
        function () {
			if(jQuery(this).hasClass('down')){
				jQuery(this).removeClass('down').addClass('up');
			}else {
				jQuery(this).removeClass('up').addClass('down');
			}
			
        	var search_condition_display=jQuery("#a_search_condition").css("display");
        	if(search_condition_display=="none"){
            jQuery("#a_search_condition").fadeIn('fast');
            jQuery("#search_advance_flag").val('1');
          }else{
         	  jQuery("#a_search_condition").fadeOut('fast');
            jQuery("#search_advance_flag").val('');
            jQuery("#search_trave_route_number").val('');
            jQuery("#search_budget").val('');
            jQuery("#search_trave_linetype").val('');
            jQuery("#search_tcid").val('');
            jQuery("#search_advance_flag").val('');
          }
        },
        function () {
			if(jQuery(this).hasClass('down')){
				jQuery(this).removeClass('down').addClass('up');
			}else {
				jQuery(this).removeClass('up').addClass('down');
			}
          var search_condition_display=jQuery("#a_search_condition").css("display");
        	if(search_condition_display=="none"){
            jQuery("#a_search_condition").fadeIn('fast');
            jQuery("#search_advance_flag").val('1');
          }else{
         	  jQuery("#a_search_condition").fadeOut('fast');
            jQuery("#search_advance_flag").val('');
            jQuery("#search_trave_route_number").val('');
            jQuery("#search_budget").val('');
            jQuery("#search_trave_linetype").val('');
            jQuery("#search_tcid").val('');
            jQuery("#search_advance_flag").val('');
          }
        }
     );
     
    jQuery("#trave_region").toggle(
        	   function(){
        	   	 if(jQuery("#trave_region_content").css("display")=="none"){
        	   	     var search_trave_category=jQuery("#search_trave_category").val();
   	   	           get_category_condition(search_trave_category);
        		       jQuery("#trave_region_content").fadeIn("fast");
        		    }else{
        			    jQuery("#trave_region_content").fadeOut("fast");
        		    }
        	  },
        	  function(){
        	  	if(jQuery("#trave_region_content").css("display")=="none"){
        	  	  var search_trave_category=jQuery("#search_trave_category").val();
   	   	        get_category_condition(search_trave_category);
        		    jQuery("#trave_region_content").fadeIn("fast");
        		  }else{
        			  jQuery("#trave_region_content").fadeOut("fast");
        		  }
        	  }
        	
        );
        	
        jQuery("#trave_region_content_close").live("click",function(){
            jQuery("#trave_region_content").fadeOut("fast");
        	});
        	
        	
        jQuery("#search_trave_category").live("change",function(){
   	   	  	  var trave_category=jQuery(this).val();
   	   	  	  if(trave_category=='4'){
   	   	  	  	jQuery("#trt_item_condition").hide();
   	   	  	  	get_category_condition_content(trave_category);
   	   	  	  	
   	   	  	  }else{
   	   	  	  	 jQuery("#trt_item_condition").show();
   	   	  	     get_category_condition(trave_category);
   	   	  	  }
   	   	  });
   	   jQuery(".search_sclist:even").addClass("bgcolor_even");   
   	   jQuery(".around_trave_date").live('click',function () {
         var trave_id=jQuery(this).attr("trave_id");
          jQuery.ajax({
			     type: "GET",
			     beforeSend: function(){
			    },
			    url: "/index.php/travel/travesdate",
			    data: "trave_id="+trave_id+"&rnd="+Math.random(),
			    dataType:'json',
			    success: function(msg){
			      var json_obj=msg;
			      if(json_obj){
			      	cale.trave_date_datas=json_obj;
			      	cale.Draw();
			      }
			      jQuery("#idCalendar").attr("trave_id",trave_id);
			      show_min_dialog();
			   }
			 });
 
      
    }); 

    	jQuery(".rating-wrap>ul>li>a").hover(
  			function (){
  				  active_ration=jQuery(".active_rating");
  				  active_ration.removeClass("active_rating");
		        jQuery(this).addClass("active_rating");
		        jQuery("#hint").html(jQuery(this).attr("title"));
		        click_flag=false;
		        jQuery(this).click(function(){
   						 click_flag=true;
   						 var total_rating=jQuery(this).attr("rating_value");
   						 jQuery("#total_rating").val(total_rating);
   						 active_ration="";
   					});
  			},
  			function () {
   					if(!click_flag){
		           jQuery(this).removeClass("active_rating");
		           jQuery("#hint").html("点击星星为线路打分");
		         }
		         
		        active_ration.addClass("active_rating");
		        
  			}
	 ); 
	 
	 
	 jQuery(".img_cut").hover(
		function(){
			 var this_obj=jQuery(this);
       var preview_obj=jQuery(this).next(".img_preview");
       var preview_width=preview_obj.width();
       var preview_height=preview_obj.height();
       var this_width=this_obj.width();
       var this_height=this_obj.height();
       var offset=this_obj.offset();
       preview_obj.css('left',(offset.left+this_width/2)-(preview_width)/2);
       preview_obj.css('top',(offset.top+this_height/2)-(preview_height)/2); 	    
			 jQuery(preview_obj, this).fadeIn("fast");
			}, 
		function(){
			var preview_obj=jQuery(this).next(".img_preview");
			preview_obj.mouseout( function(event){ 
				  var result=jQuery.contains(preview_obj.get()[0],event.relatedTarget);
				  if(!result){
				  	jQuery(preview_obj, this).fadeOut("fast");
				  }
				  

				}); 
		} 
	);
	
	jQuery(".user_code_type").each(function(i){
          var code_index=jQuery(this).attr("code_index");
  		  	var select_value=jQuery(this).val();
  		  	switch(select_value){
       	  	 case '1':
       	  	    jQuery("#user_code_content_"+String(code_index)).show();
       	  	    jQuery("#user_birthday_content_"+String(code_index)).hide();
       	  	   break;
       	  	 default:
       	  	   jQuery("#user_birthday_content_"+String(code_index)).show();
       	  	   break;
       	  }
       });
       
   jQuery(".user_code_type").live("change",function(){
       	  var code_index=jQuery(this).attr("code_index");
       	  var select_value=jQuery(this).val();
       	  switch(select_value){
       	  	 case '1':
       	  	    jQuery("#user_code_content_"+String(code_index)).show();
       	  	    jQuery("#user_birthday_content_"+String(code_index)).hide();
       	  	   break;
       	  	 default:
       	  	   jQuery("#user_birthday_content_"+String(code_index)).show();
       	  	   break;
       	  }
       	});
});
var Class = {
  create: function() {
    return function() {
      this.initialize.apply(this, arguments);
    }
  }
}

  //dialog.js
  
  
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

//取得DOM中,ID=b的节点; c=是否不扩展
var ge=window.ge||function(b,c){
	var a;
	if('string'!=typeof(b)){a=b;}
	else a=document.getElementById(b);
	!c&&window.NodeAugment&&NodeAugment.extend(a);
	return a;
};

//得到页面的宽和高
 function getPageSize(){
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight;
	arrayPageSize = [w,h];
	return arrayPageSize;
}
//判断是否为空
function empty(obj){
	 if(obj){
	  if(obj instanceof Array){return obj.length==0;}
	  else if(obj instanceof Object){
		  for(var i in obj){return false;}
		  return true;
	  }else{return !obj;}
	 }else{
	 	 return false;
	 }
}
//判断对象是否包含任一个对象
function contains(parobj,childobj){
	while(!empty(childobj)){
		if(parobj==childobj)
		{
		   return true;
		}
		else
		{
			if(childobj){
		   childobj=childobj.parentNode;
		   contains(parobj,childobj);
		  }else{
		  	return false;
		  }
		 }
	}
	return false;
} 

//随机数
function rand32(){
	return Math.random();
}
/* 返回当前时间 */
function getTime(date)
{
 if(date == null)
 {
  date = new Date();
 }
 var y = date.getFullYear();
 var M = date.getMonth() + 1;
 var d = date.getDate();
 var h = date.getHours();
 var m = date.getMinutes();
 var s = date.getSeconds();
 var S = date.getTime()%1000;

 var html = y + "-";

 if(M < 10)
 {
  html += "0";
 }
 html += M + "-";

 if(d < 10)
 {
  html += "0";
 }
 html += d + " ";

 if(h < 10)
 {
  html += "0";
 }
 html += h + ":";

 if(m < 10)
 {
  html += "0";
 }
 html += m + ":";

 if(s < 10)
 {
  html += "0";
 }
 html += s;
 
 html += " ";

 if(S < 100)
 {
  html += "0";
 }

 if(S < 10)
 {
  html += "0";
 }

 html += S;

 return html;
}



String.prototype.gblen = function() {   
    var len = 0;   
    for (var i=0; i<this.length; i++) {   
 
            if (this.charCodeAt(i) >= 224) //如果ASCII位高与224，
            {
               //根据UTF-8编码规范，将3个连续的字符计为单个字符
                len = len + 3; //实际Byte计为3
                
            } else if (this.charCodeAt(i) >= 192) //如果ASCII位高与192，
            {
                 //根据UTF-8编码规范，将2个连续的字符计为单个字符
                len = len + 2; //实际Byte计为2
               
            } else if (this.charCodeAt(i) >= 65 && this.charCodeAt(i) <= 90) //如果是大写字母，
            {
                len = len + 1; //实际的Byte数仍计1个
                
            } else //其他情况下，包括小写字母和半角标点符号，
            { 
                len = len + 1; //实际的Byte数计1个
            }
               
    } 
    
    return len;   
}   
String.prototype.gbtrim = function(len, s) {   
    var str = '';   
    var sp  = s || '';   
    var len2 = 0;   
    for (var i=0; i<this.length; i++) { 
    	
    	     if (this.charCodeAt(i) >= 224) //如果ASCII位高与224，
            {
               //根据UTF-8编码规范，将3个连续的字符计为单个字符
                len2 = len2 + 3; //实际Byte计为3
                
            } else if (this.charCodeAt(i) >= 192) //如果ASCII位高与192，
            {
                 //根据UTF-8编码规范，将2个连续的字符计为单个字符
                len2= len2 + 2; //实际Byte计为2
               
            } else if (this.charCodeAt(i) >= 65 && this.charCodeAt(i) <= 90) //如果是大写字母，
            {
                len2 = len2 + 1; //实际的Byte数仍计1个
                
            } else //其他情况下，包括小写字母和半角标点符号，
            { 
                len2 = len2 + 1; //实际的Byte数计1个
            }
 
    }   
    if (len2 <= len) {   
        return this;   
    }   
    len2 = 0;   
    len  = (len > sp.length) ? len-sp.length: len; 
    for (var i=0; i<this.length; i++) {   
        if (this.charCodeAt(i)>127 || this.charCodeAt(i)==94) {   
            len2 += 2;   
        } else {   
            len2 ++;   
        }   
        //if (len2 > len) {   
           // str += sp;   
            //break;   
        //}   
        //str += this.charAt(i);   
    } 
    
    if(len2 > len){
    	str+=this.charAt(0);
    	str+=sp;
    	str+=this.charAt(this.length-1);
    }  
    return str;   
} 

String.prototype.trimn=function()
{

     return this.replace(/[\r|\n]/g,"");
     
}

String.prototype.ltrim=function()
{
     return this.replace(/(^\s*)/g,'');
}

String.prototype.rtrim=function()
{
     return this.replace(/(\s*$)/g,'');
}

Array.prototype.find_key=function(id){
	  var len=this.length;
	  for(var ii=0;ii<len;ii++){
	  	if(this[ii].id==id){
	  		return ii;
	  	}
	  }
	  return false;
}

Array.prototype.find_value=function(value){
   var len=this.length;
   for(var ii=0;ii<len;ii++){
     if(this[ii]==value){
       return ii+1;	
    }	
  }
  return false;
}
//移除数组中的一个指定索引
Array.prototype.remove=function(remove_key){
	var temp_array=new Array();
	var len=this.length;
	remove_key=parseInt(remove_key);
	for(var ii=0;ii<len;ii++){
		if(ii!=remove_key){
			temp_array.push(this[ii]);
		}
	}
	return temp_array;
}

function strLeft(s,n){
	return s.slice(0, n)
}

//转换字符为html用的字符串,(替换 & " ' < > 为特殊字符)
function htmlspecialchars(a){
	if(typeof(a)=='undefined'||a===null||!a.toString)return '';
	if(a===false){return '0';}
	else if(a===true)return '1';
	//替换 & " ' < > 为特殊字符
	return a.toString().replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#039;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}
//替换换行为<br />
function htmlize(a){return htmlspecialchars(a).replace(/\n/g,'<br />');}
function escape_js_quotes(a){
	if(typeof(a)=='undefined'||!a.toString)return '';
	return a.toString().replace(/\\/g,'\\').replace(/\n/g,'\n').replace(/\r/g,'\r').replace(/"/g,'\x22').replace(/'/g,'\'').replace(/</g,'\x3c').replace(/>/g,'\x3e').replace(/&/g,'\x26');
}
function setCookie(a,b,d,e){
	if(d){
		var f=new Date();
		var c=new Date();
		c.setTime(f.getTime()+d);
	}
	document.cookie=a+"="+encodeURIComponent(b)+"; "+(d?"expires="+c.toGMTString()+"; ":"")+"path="+(e||'\/')+"; domain="+window.location.hostname.replace(/^.*(\.facebook\..*)$/i,'$1');
}
function clearCookie(a){document.cookie=a+"=; expires=Sat, 01 Jan 2000 00:00:00 GMT; "+"path=\/; domain="+window.location.hostname.replace(/^.*(\.facebook\..*)$/i,'$1');}
function getCookie(d){var e=d+"=";var b=document.cookie.split(';');for(var c=0;c<b.length;c++){var a=b[c];while(a.charAt(0)==' ')a=a.substring(1,a.length);if(a.indexOf(e)==0)return decodeURIComponent(a.substring(e.length,a.length));}return null;}
function copy_properties(b,c){
	b=b||{};
	c=c||{};
	for(var a in c)b[a]=c[a];
	if(c.hasOwnProperty&&c.hasOwnProperty('toString')&&(typeof c.toString!='undefined')&&(b.toString!==c.toString))b.toString=c.toString;
	return b;
}
var ua={
	ie:function(){return ua._populate()||this._ie;},
	firefox:function(){return ua._populate()||this._firefox;},
	opera:function(){return ua._populate()||this._opera;},
	safari:function(){return ua._populate()||this._safari;},
	safariPreWebkit:function(){return ua._populate()||this._safari<500;},
	chrome:function(){return ua._populate()||this._chrome;},
	windows:function(){return ua._populate()||this._windows;},
	osx:function(){return ua._populate()||this._osx;},
	linux:function(){return ua._populate()||this._linux;},
	iphone:function(){return ua._populate()||this._iphone;},
	_populated:false,
	_populate:function(){
		if(ua._populated)return;
		ua._populated=true;
		var a=/(?:MSIE.(\d+\.\d+))|(?:(?:Firefox|GranParadiso|Iceweasel).(\d+\.\d+))|(?:Opera(?:.+Version.|.)(\d+\.\d+))|(?:AppleWebKit.(\d+(?:\.\d+)?))/.exec(navigator.userAgent);
		var c=/(Mac OS X)|(Windows)|(Linux)/.exec(navigator.userAgent);
		var b=/\b(iPhone|iP[ao]d)/.exec(navigator.userAgent);
		if(a){
			ua._ie=a[1]?parseFloat(a[1]):NaN;
			if(ua._ie>=8&&!window.HTMLCollection)ua._ie=7;
			ua._firefox=a[2]?parseFloat(a[2]):NaN;
			ua._opera=a[3]?parseFloat(a[3]):NaN;
			ua._safari=a[4]?parseFloat(a[4]):NaN;
			if(ua._safari){
				a=/(?:Chrome\/(\d+\.\d+))/.exec(navigator.userAgent);
				ua._chrome=a&&a[1]?parseFloat(a[1]):NaN;
			}else ua._chrome=NaN;
		}else ua._ie=ua._firefox=ua._opera=ua._chrome=ua._safari=NaN;
		if(c){ua._osx=!!c[1];ua._windows=!!c[2];ua._linux=!!c[3];}
		else ua._osx=ua._windows=ua._linux=false;
		ua._iphone=b;
	}
};


/*********************************
	URI类
*********************************/
function URI(a){
	if(a===window)return;
	//创建URI的实例
	if(this===window)	return new URI(a||window.location.href);
	this.parse(a||'');
}
copy_properties(URI,{
	//取得URI,a=false 取得当前win的URI;  =true 取得当前真实的URI(PageTransitions类)
	getRequestURI:function(a,b){
		a=a===undefined||a;
		if(a&&window.PageTransitions&&PageTransitions.isInitialized()){return PageTransitions.getCurrentURI(!!b).getQualifiedURI();}
		else return new URI(window.location.href);
	},
	getMostRecentURI:function(){
		if(window.PageTransitions&&PageTransitions.isInitialized()){return PageTransitions.getMostRecentURI().getQualifiedURI();}
		else return new URI(window.location.href);
	},
	expression:/(((\w+):\/\/)([^\/:]*)(:(\d+))?)?([^#?]*)(\?([^#]*))?(#(.*))?/,
	arrayQueryExpression:/^(\w+)((?:\[\w*\])+)=?(.*)/,
	explodeQuery:function(g){
		if(!g)return {};
		var h={};
		g=g.replace(/%5B/ig,'[').replace(/%5D/ig,']');
		g=g.split('&');
		for(var b=0,d=g.length;b<d;b++){
			var e=g[b].match(URI.arrayQueryExpression);
			if(!e){
				var j=g[b].split('=');
				h[URI.decodeComponent(j[0])]=j[1]===undefined?null:URI.decodeComponent(j[1]);
			}else{
				var c=e[2].split(/\]\[|\[|\]/).slice(0,-1);
				var f=e[1];
				var k=URI.decodeComponent(e[3]||'');
				c[0]=f;
				var i=h;
				for(var a=0;a<c.length-1;a++)
					if(c[a]){
						if(i[c[a]]===undefined)if(c[a+1]&&!c[a+1].match(/\d+$/)){i[c[a]]={};}
						else i[c[a]]=[];
						i=i[c[a]];
					}else{
						if(c[a+1]&&!c[a+1].match(/\d+$/)){i.push({});}
						else i.push([]);
						i=i[i.length-1];
					}
					if(i instanceof Array&&c[c.length-1]==''){i.push(k);}
					else i[c[c.length-1]]=k;
			}
		}
		return h;
	},
	//将query数组转变为直对的字串
	implodeQuery:function(f,e,a){
		e=e||'';
		if(a===undefined)a=true;
		var g=[];
		if(f===null||f===undefined){g.push(a?URI.encodeComponent(e):e);}
		else if(f instanceof Array){
			for(var c=0;c<f.length;++c)
				try{if(f[c]!==undefined)g.push(URI.implodeQuery(f[c],e?(e+'['+c+']'):c));}
				catch(b){}
		}else if(typeof(f)=='object'){
			if(DOM.isNode(f)){g.push('{node}');}
			else for(var d in f)
				try{if(f[d]!==undefined)g.push(URI.implodeQuery(f[d],e?(e+'['+d+']'):d));}
				catch(b){}
		}else if(a){g.push(URI.encodeComponent(e)+'='+URI.encodeComponent(f));}
		else g.push(e+'='+f);
		return g.join('&');
	},
	encodeComponent:function(d){
		var c=String(d).split(/([\[\]])/);
		for(var a=0,b=c.length;a<b;a+=2)c[a]=window.encodeURIComponent(c[a]);
		return c.join('');
	},
	decodeComponent:function(a){return window.decodeURIComponent(a.replace(/\+/g,' '));}
});

copy_properties(URI.prototype,{
	//解析URL的组成
	parse:function(b){
		var a=b.toString().match(URI.expression);
		copy_properties(this,{
			protocol:a[3]||'',	//协议
			domain:a[4]||'',		//
			port:a[6]||'',
			path:a[7]||'',
			query_s:a[9]||'',   //在?之后
			fragment:a[11]||''	//在#之后
		});
		return this;
	},
	setProtocol:function(a){this.protocol=a;return this;},
	getProtocol:function(){return this.protocol;},
	setQueryData:function(a){this.query_s=URI.implodeQuery(a);return this;},
	addQueryData:function(a){return this.setQueryData(copy_properties(this.getQueryData(),a));},
	//删除URI中query的某个值
	removeQueryData:function(b){
		if(!(b instanceof Array))b=[b];
		var d=this.getQueryData();
		for(var a=0,c=b.length;a<c;++a)delete d[b[a]];
		return this.setQueryData(d);
	},
	getQueryData:function(){return URI.explodeQuery(this.query_s);},
	setFragment:function(a){this.fragment=a;return this;},
	getFragment:function(){return this.fragment;},
	setDomain:function(a){this.domain=a;return this;},
	getDomain:function(){return this.domain;},
	setPort:function(a){this.port=a;return this;},
	getPort:function(){return this.port;},
	setPath:function(a){this.path=a;return this;},
	getPath:function(){return this.path.replace(/^\/+/,'\/');},
	toString:function(){
		var a='';
		this.protocol&&(a+=this.protocol+':\/\/');
		this.domain&&(a+=this.domain);
		this.port&&(a+=':'+this.port);
		if(this.domain&&!this.path)a+='\/';
		this.path&&(a+=this.path);
		this.query_s&&(a+='?'+this.query_s);
		this.fragment&&(a+='#'+this.fragment);
		return a;
	},
	valueOf:function(){return this.toString();},
	//判断domain,是不是Facebook的
	isFacebookURI:function(){
		if(!URI._facebookURIRegex)URI._facebookURIRegex=new RegExp('(^|\.)facebook\.('+env_get('tlds').join('|')+')([^.]*)$','i');
		return !this.domain||URI._facebookURIRegex.test(this.domain);
	},
	//判断Quickling类在活动中,且此uri是可以活动的页面
	isQuicklingEnabled:function(){return window.Quickling&&Quickling.isActive()&&Quickling.isPageActive(this);},
	getRegisteredDomain:function(){
		if(!this.domain)return '';
		if(!this.isFacebookURI())return null;
		var b=this.domain.split('.');
		var a=b.indexOf('facebook');
		return b.slice(a).join('.');
	},
	getTld:function(f){
		if(!this.domain)return '';
		var d=this.domain.split('.');
		var e=d[d.length-1];
		if(f)return e;
		var c=env_get('tlds');
		if(c.indexOf(e)==-1)
			for(var a=0;a<c.length;++a){
				var b=c[a];
				if(new RegExp(b+'$').test(this.domain)){e=b;break;}
			}
		return e;
	},
	//取得不合格的URI,仅有path後的URI /path?query#fragment
	getUnqualifiedURI:function(){
		return new URI(this).setProtocol(null).setDomain(null).setPort(null);
	},
	//取得合格的URI,Domain必须完整
	getQualifiedURI:function(){
		var b=new URI(this);
		if(!b.getDomain()){
			//补充缺少的Domain数据
			var a=URI();
			b.setProtocol(a.getProtocol()).setDomain(a.getDomain()).setPort(a.getPort());
		}
		return b;
	},
	//判断a是否与当前window的uri相同(Protocol,Domain),协议与域名是否相同
	isSameOrigin:function(a){
		var b=a||window.location.href;
		if(!(b instanceof URI))b=new URI(b.toString());
//		if(this.getProtocol()&&this.getProtocol()!=b.getProtocol())return false;
//		if(this.getDomain()&&this.getDomain()!=b.getDomain())return false;
		return true;
	},
	go:function(a){goURI(this,a);},
	setSubdomain:function(b){
		var c=new URI(this).getQualifiedURI();
		var a=c.getDomain().split('.');
		if(a.length<=2){a.unshift(b);}
		else a[0]=b;
		return c.setDomain(a.join('.'));
	},
	getSubdomain:function(){
		if(!this.getDomain())return '';
		var a=this.getDomain().split('.');
		if(a.length<=2){return '';}
		else return a[0];
	}
});

window.CSS=window.CSS||{
	hasClass:function(b,a){return (' '+ge(b,true).className+' ').indexOf(' '+a+' ')>-1;},
	addClass:function(b,a){
		b=ge(b,true);
		if(a&&!CSS.hasClass(b,a))b.className=b.className?(b.className+' '+a):a;
		return b;
	},
	
	//设置不透明度
		setOpacity:function(element,opacity){
			element=ge(element);
			var opaque=(opacity==1);
			try{element.style.opacity=(opaque?'':''+opacity);}
			catch(ignored){}
			try{element.style.filter=(opaque?'':'alpha(opacity='+(opacity*100)+')');}
			catch(ignored){}
		},
		//取得对象的透明度
		getOpacity:function(element){
			element=ge(element);
			var opacity=CSS.getStyle(element,'filter');
			var val=null;
			if(opacity&&(val=/(\d+(?:\.\d+)?)/.exec(opacity))){return parseFloat(val.pop())/100;}
			else if(opacity=CSS.getStyle(element,'opacity')){return parseFloat(opacity);}
			else{return 1.0;}
		},
		//设置对象的样式
	setStyle:function(element,name,value){
			element.style[name]=value;
			return element;
		},
		//取得对象的样式
  getStyle:function(element,property){
			element=ge(element);
			function hyphenate(property){return property.replace(/[A-Z]/g,function(match){return'-'+match.toLowerCase();});}
			if(window.getComputedStyle){return window.getComputedStyle(element,null).getPropertyValue(hyphenate(property));}
			if(document.defaultView&&document.defaultView.getComputedStyle){
				var computedStyle=document.defaultView.getComputedStyle(element,null);
				if(computedStyle) return computedStyle.getPropertyValue(hyphenate(property));
				if(property=="display") return"none";
				Util.error("Can't retrieve requested style %q due to a bug in Safari",property);
			}
			if(element.currentStyle){return element.currentStyle[property];}
			return element.style[property];
		},
		
			
	removeClass:function(b,a){
		b=ge(b,true);
		b.className=b.className.replace(new RegExp('(^|\\s)'+a+'(?=\\s|$)','g'),' ');
		return b;
	},

	toggleClass:function(b,a){
		return (CSS.hasClass(b,a)?CSS.removeClass:CSS.addClass)(b,a);
	},
	//设置不透明度(小飞)
	setOpacity:function(element,opacity){
		element=ge(element);
		var opaque=(opacity==1);
		try{element.style.opacity=(opaque?'':''+opacity);}
		catch(ignored){}
		try{element.style.filter=(opaque?'':'alpha(opacity='+(opacity*100)+')');}
		catch(ignored){}
	},
	//取得对象的透明度(小飞)
	getOpacity:function(element){
		element=ge(element);
		var opacity=CSS.getStyle(element,'filter');
		var val=null;
		if(opacity&&(val=/(\d+(?:\.\d+)?)/.exec(opacity))){return parseFloat(val.pop())/100;}
		else if(opacity=CSS.getStyle(element,'opacity')){return parseFloat(opacity);}
		else{return 1.0;}
	},
	//设置对象的样式(小飞)
	setStyle:function(element,name,value){
		element.style[name]=value;
		return element;
	},
	//取得对象的样式(小飞)
	getStyle:function(element,property){
		element=ge(element);
		function hyphenate(property){return property.replace(/[A-Z]/g,function(match){return'-'+match.toLowerCase();});}
		if(window.getComputedStyle){return window.getComputedStyle(element,null).getPropertyValue(hyphenate(property));}
		if(document.defaultView&&document.defaultView.getComputedStyle){
			var computedStyle=document.defaultView.getComputedStyle(element,null);
			if(computedStyle) return computedStyle.getPropertyValue(hyphenate(property));
			if(property=="display") return"none";
			Util.error("Can't retrieve requested style %q due to a bug in Safari",property);
		}
		if(element.currentStyle){return element.currentStyle[property];}
		return element.style[property];
	}
};


//提交form_id的表单
function submit_form(form_id){
	document.getElementById(form_id).submit();
}
//选择所有
 function selectallcheck(){
   	 var check_flag=document.getElementById("allcheck").checked;
   	 if(check_flag){
   	 	 jQuery(".itemcheckbox").attr("checked",true);
   	 }else{
   	 	 jQuery(".itemcheckbox").attr("checked",false);
   	 }
   }
//判断是否是数字  不是数字删除 
function isNumber(obj){
	   if(isNaN(obj.value))
	       obj.value="";
}
//线路分类
 function show_sub_category(parent_category_id){
			  var is_request=jQuery("#sub_address_"+String(parent_category_id)).attr("is_request");
			  if(is_request=='1'){
			  jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
				  jQuery('#sub_address_'+String(parent_category_id)).html("<div class='loading_progress'><img  src='/css/images/progress.gif'></div>");
			   },
			   url: "/backend.php/category/subcategory",
			   data: "parent_category_id="+parent_category_id+"&rnd="+Math.random(),
			   dataType:'json',
			   success: function(msg){
			     var json_obj=msg;
			     if(json_obj){
			      var json_obj_len=json_obj.length;
			      var sub_address_html="";
			      for(var ii=0;ii<json_obj_len;ii++){
			          var sub_category=json_obj[ii]
			       
			          if(sub_category){
			            sub_address_html+="<div><span>"+sub_category.category_name+"</span>&nbsp;&nbsp;<span class='dz_pic'><a class='operate_button' href=\"javascript:show_sub_category('"+String(sub_category.id)+"');\">查看子地址</a></span>&nbsp;&nbsp;<span class='xg_pic'><a class='operate_button' href=\"/backend.php/category/add?id="+sub_category.id+"\">修改</a></span>&nbsp;&nbsp;<span class='sc_pic'><a class='operate_dbutton' href=\"javascript:delete_category('"+String(sub_category.id)+"');\">删除</a></span></div>";
                  sub_address_html+="<div id=\"sub_address_"+String(sub_category.id)+"\" class='sub_address' is_request='1'>";
                  sub_address_html+="</div>";
			          }
			      }
			      var sub_address_div=document.getElementById("sub_address_"+String(parent_category_id));
			      sub_address_div.innerHTML=sub_address_html;
			      sub_address_div.style.display="block";
			      jQuery("#sub_address_"+String(parent_category_id)).attr("is_request","2");
			      
			   }
			  }
			 });
			 }else{
			     var sub_address_div=document.getElementById("sub_address_"+String(parent_category_id));
			     if(sub_address_div.style.display=="block"){
			       sub_address_div.style.display="none";
			     }else{
			       sub_address_div.style.display="block";
			     }
			 }
			}
			
			function delete_category(id){
			   document.getElementById("delete_category_id").value=id;
			   document.getElementById("categorydelete-form").submit();
			}
			
//线路区域	
	function show_sub_district(parent_district_id){
			  var is_request=jQuery("#sub_address_"+String(parent_district_id)).attr("is_request");
			  if(is_request=='1'){
			  jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
				  jQuery('#sub_address_'+String(parent_district_id)).html("<div class='loading_progress'><img  src='/css/images/progress.gif'></div>");
			   },
			   url: "/backend.php/district/subdistrict",
			   data: "parent_district_id="+parent_district_id+"&rnd="+Math.random(),
			   dataType:'json',
			   success: function(msg){
			      var json_obj=msg;
			     if(json_obj){
			      var json_obj_len=json_obj.length;
			      var sub_address_html="";
			      for(var ii=0;ii<json_obj_len;ii++){
			          var sub_district=json_obj[ii]
			          if(sub_district){
			            sub_address_html+="<div><span>"+sub_district.district_name+"</span>&nbsp;&nbsp;<span class='dz_pic'><a class='operate_button' href=\"javascript:show_sub_district('"+String(sub_district.id)+"');\">查看子地址</a></span>";
			            if(sub_district.edit_flag)
			              sub_address_html+="&nbsp;&nbsp;<span class='xg_pic'><a class='operate_button' href=\"/backend.php/district/add/id/"+sub_district.id+".html\">修改</a></span>&nbsp;&nbsp;<span class='sc_pic'><a class='operate_dbutton' href=\"/backend.php/district/delete/id/"+sub_district.id+".html\">删除</a></span>";		       
                  sub_address_html+="</div><div id=\"sub_address_"+String(sub_district.id)+"\" class='sub_address' is_request='1'>";
                  sub_address_html+="</div>";
			          }
			      }
			      var sub_address_div=document.getElementById("sub_address_"+String(parent_district_id));
			      sub_address_div.innerHTML=sub_address_html;
			      sub_address_div.style.display="block";
			      jQuery("#sub_address_"+String(parent_district_id)).attr("is_request","2");
			   }
			  }
			 });
			 }else{
			     var sub_address_div=document.getElementById("sub_address_"+String(parent_district_id));
			     if(sub_address_div.style.display=="block"){
			       sub_address_div.style.display="none";
			     }else{
			       sub_address_div.style.display="block";
			     }
			 }
			
			}
//删除区域			
function delete_district(id){
		document.getElementById("delete_district_id").value=id;
		document.getElementById("districtdelete-form").submit();
}

//改变线路主页面的tab选项
function change_trave_tab(current_page,total_page){
	if(current_page){
		for(var ii=1;ii<=total_page;ii++){
		   jQuery("#menu_tab_desc_"+String(ii)).hide();
		   jQuery("#menu_tab_"+String(ii)).removeClass("trave_tab_select");
		} 
		jQuery("#menu_tab_desc_"+String(current_page)).fadeIn("fast");
		jQuery("#menu_tab_"+String(current_page)).addClass("trave_tab_select");
		jQuery("#menu_tab_0").removeClass("trave_tab_select");
		
	}
}

function change_route_tab(current_page,total_page){
	if(current_page){
		for(var ii=1;ii<=total_page;ii++){
		   jQuery("#route_tab_desc_"+String(ii)).hide();
		   jQuery("#route_tab_"+String(ii)).removeClass("route_tab_select");
		} 
		jQuery("#route_tab_desc_"+String(current_page)).fadeIn("fast");
		jQuery("#route_tab_"+String(current_page)).addClass("route_tab_select");
		jQuery("#route_tab_all").removeClass("route_tab_select");
	
		
	}
	
}

function change_route_tab_all(total_page){
	for(var ii=1;ii<=total_page;ii++){
		   jQuery("#route_tab_desc_"+String(ii)).show();
		   jQuery(".route_tab_select").removeClass("route_tab_select");
		}
  jQuery("#route_tab_all").addClass("route_tab_select"); 
}




//首页显示特价
function change_limit_tab(current_page,total_page){
		for(var ii=1;ii<=total_page;ii++){
		   jQuery("#menu_tab_desc_"+String(ii)).hide();
		   jQuery("#menu_tab_"+String(ii)).removeClass("limit_tab_select");
		} 
		jQuery("#menu_tab_desc_"+String(current_page)).fadeIn("fast");
		jQuery("#menu_tab_"+String(current_page)).addClass("limit_tab_select");
}


//tab
function change_tab(current_page,total_page){
		for(var ii=1;ii<=total_page;ii++){
		   jQuery("#menu_tab_desc_"+String(ii)).hide();
		   jQuery("#menu_tab_"+String(ii)).removeClass("tab_select");
		} 
		jQuery("#menu_tab_desc_"+String(current_page)).fadeIn("fast");
		jQuery("#menu_tab_"+String(current_page)).addClass("tab_select");
}

//点击轮转图片是显示大图
function show_big_trave_image(obj){
	var big_image_src=obj.getAttribute("big_image");
	jQuery("#big_trave_image").attr("src",big_image_src);
}

//获得select的选择值
function get_select_value(select_id){
	var select_obj="";
	if(typeof(select_id)=="string"){
	   var select_obj=document.getElementById(select_id);
	}else{
		 select_obj=select_id;
	}
	var select_indexed=select_obj.selectedIndex;
	if(select_indexed!=-1){
	var select_value=select_obj.options[select_indexed].value;
	return select_value;
}
}
 //选择保险
function select_insurance(insurance_id,insurance_price){
  		var select_insurance=document.getElementById("select_insurance_"+insurance_id);
  		var select_value=get_select_value(select_insurance);
  		if(select_value=='2'){
  			var total_nums=parseInt(adult_nums)+parseInt(child_nums);
  			var total_price=insurance_price*total_nums;
  			document.getElementById("insurance_total_price_"+insurance_id).innerHTML=total_price;
  			var tem_json={"id":insurance_id,"value":insurance_price};
  			insurance_obj.push(tem_json);
  		}else{
  			  document.getElementById("insurance_total_price_"+insurance_id).innerHTML="0";
  			  var find_id=insurance_obj.find_key(insurance_id);
  			  insurance_obj.remove(find_id);
  		}
  		calculate_total_price();
  	}
  	//计算总价钱
  	function calculate_total_price(){
  		
  		var select_trave_date=document.getElementById("select_trave_date");
  	  var select_indexed=select_trave_date.selectedIndex;
  	  
  	  if(select_indexed!=-1){
  	  	
  	  var select_options=select_trave_date.options[select_indexed];
	    var std_value=select_options.value;
	    var adult_price=select_options.getAttribute("adult_price");
	    var child_price=select_options.getAttribute("child_price");
	   
	  }else{
	  	var adult_price=0;
	  	var child_price=0;
	  }
	    
	    if(!child_price)
	       child_price=adult_price;  
	    document.getElementById("hidden_adult_price").value=adult_price;
	    document.getElementById("hidden_child_price").value=child_price;
     	
	    var total_price=parseInt(adult_price)*parseInt(adult_nums)+parseInt(child_price)*parseInt(child_nums);
	    jQuery(".o_price").each(function(){
         total_price+=parseInt(jQuery(this).html());
      }); 
	    document.getElementById("order_show").innerHTML=total_price;
  	}
  	
  	
  	
  	 //选择自由行保险
function select_f_insurance(insurance_id,insurance_price){
  		var select_insurance=document.getElementById("select_insurance_"+insurance_id);
  		var select_value=get_select_value(select_insurance);
  		if(select_value=='2'){
  			var total_nums=parseInt(adult_nums)+parseInt(child_nums);
  		
  			var total_price=insurance_price*total_nums;
  			document.getElementById("insurance_total_price_"+insurance_id).innerHTML=total_price;
  			var tem_json={"id":insurance_id,"value":insurance_price};
  			insurance_obj.push(tem_json);
  		}else{
  			  document.getElementById("insurance_total_price_"+insurance_id).innerHTML="0";
  			  var find_id=insurance_obj.find_key(insurance_id);
  			  insurance_obj.remove(find_id);
  		}
  		calculate_f_total_price();
  	}
  	//计算自由行总价钱
  	function calculate_f_total_price(){
  		
	    var total_price=parseInt(jQuery("#hidden_total_price").val());
	    jQuery(".o_price").each(function(){
         total_price+=parseInt(jQuery(this).html());
      }); 
	    document.getElementById("order_show").innerHTML=total_price;
  	}
  	
  	
  	
  	
  	//发送订单信息
  	function send_order_info(){
  		var adult_nums=document.getElementById("adult_nums").value;
  		if(!adult_nums){
  			  alert("成人数不能为空");
  			  return false;
 		
  		}
  		
  		var trave_date_data=get_trave_date_datas();
  		var select_trave_date=trave_date_data.std_value;
  		var date_key=trave_date_data.date_key;
  		if(!select_trave_date){
  			 alert("出发日期不能为空");
  			 return false;

  		}
  		document.getElementById("hidden_adult_nums").value=document.getElementById("adult_nums").value;
  		document.getElementById("hidden_child_nums").value=document.getElementById("child_nums").value;
  		document.getElementById("hidden_start_date").value=get_select_value("select_trave_date");
  		document.getElementById("hidden_total_price").value=document.getElementById("order_show").innerHTML;
  		document.getElementById("start_date_id").value=date_key;
  		
  		var len=insurance_obj.length;
  		var insurance_ids="";
  		for(var ii=0;ii<len;ii++){
  			  if(!insurance_ids)
  			     insurance_ids=insurance_obj[ii].id;
  			  else
  			  	 insurance_ids+=","+insurance_obj[ii].id;
      }
  		document.getElementById("hidden_insurance_ids").value=insurance_ids;
  		document.getElementById("travelinfo").submit();
  	}
  	
  	
   	
  	//发送自由行订单信息
  	function send_f_order_info(){
  		document.getElementById("hidden_total_price").value=document.getElementById("order_show").innerHTML;
  		var len=insurance_obj.length;
  		var insurance_ids="";
  		for(var ii=0;ii<len;ii++){
  			  if(!insurance_ids)
  			     insurance_ids=insurance_obj[ii].id;
  			  else
  			  	 insurance_ids+=","+insurance_obj[ii].id;
      }
  		document.getElementById("hidden_insurance_ids").value=insurance_ids;
  		document.getElementById("travelfinfo").submit();
  	}
  	
  	
  	
  //点击日历选择开始时间	
 function select_trave_date(trave_date){
	var select_trave_date=document.getElementById("select_trave_date");
	var trave_date_options=select_trave_date.options;
	var len=trave_date_options.length;
	for(var ii=0;ii<len;ii++){
		if(trave_date_options[ii].value==trave_date){
			  trave_date_options[ii].selected="SELECTED";
		}
	}
}
	//复制联系人的信息
	function cope_user_datas(){
	  document.getElementById("user_real_name_1").value=document.getElementById("user_real_name").value;
	  document.getElementById("user_phone_1").value=document.getElementById("user_phone").value;
	}
	//验证手机号码
	function check_phone(user_phone){
		/*
		if(!is_phone(user_phone,'cell')){
			alert('手机号码格式不正确');
		}
		*/
		return true;
	}
	//验证座机
	function check_telephone(user_phone){
		var area_code=document.getElementById("user_area_code").value;
		if(!area_code){
			  alert('请选择区号');
		}else{
			/*
			if(area_code&&!is_phone(area_code+"-"+user_phone,"tele")){
				alert('固定电话格式不正确');
			}
			*/
			return true;
		}
	}
	
	//验证email
	function check_email(user_email){
		if(!is_email(user_email)){
			alert("邮箱格式不正确");
		}
	}
	
//验证号码时候是手机号码或者电话号码$phone_type:All:全部验证 cell:手机 tele:座机 tc:小灵通
  function is_phone(user_phone,phone_type){
  	
  	/*
    	switch(phone_type){
    		case 'tele':
    		    //手机号码验证规则
    	     var telephone=user_phone.match(/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/);
    	     if(telephone)
    	        return true;
    	     else
    	        return false;
    		   break;
    		case 'cell':
    		   //座机验证规则
    	    var cell_phone =user_phone.match(/(?:13\d{1}|1[548][0173689])\d{8}$/);
    	    if(cell_phone)
    	      return true;
    	    else
    	      return false;
    		   break;
    		case 'tc':
    		   	//小灵通验证规则
          	var tcphone=user_phone.match(/^1[3,5]\d{9}$/);
          	if(tcphone)
          	  return true;
          	else
          	  return false;
    		   break;
    		default:
    		   //手机号码验证规则
    	    var telephone=user_phone.match(/^(((\d{3}))|(\d{3}-))?((0\d{2,3})|0\d{2,3}-)?[1-9]\d{6,8}$/);
        	//座机验证规则
        	var cell_phone=user_phone.match(/(?:13\d{1}|1[548][0173689])\d{8}$/);
        	//小灵通验证规则
         	var tcphone=user_phone.match(/^1[3,5]\d{9}$/);
         	if((cell_phone)||(telephone)||(tcphone)){
         		return true;
         	}else{
         		return false;
         	}
    		   break;
    	}
    	*/
    	return true;
    } 
    //验证用户email
    function is_email(user_email){
    	  var user_email_flag=user_email.match(/^([a-z0-9+_]|\-|\.)+@(([a-z0-9_]|\-)+\.)+[a-z]{2,6}$/i);
    	  if(user_email_flag)
    	     return true;
    	  else
    	  	 return false;
    }
    
     
//验证身份证号码    
var vcity={ 
	11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",
	21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",
	33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",
	42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",
	51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",
	63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"
};
function check_cardid(card,ii)
{

	var code_type=document.getElementById("code_type_"+String(ii));
	var code_select=code_type.options[code_type.selectedIndex].value;
	if(code_select=='1'){
//校验长度，类型
	if((iscardno(card) === false)&&(checkprovince(card) === false)&&(checkbirthday(card) === false)&&(checkparity(card) === false))
	{
		alert('您输入的身份证号码不正确');
		return false;
	}
		return true;
	}
}

//检查号码是否符合规范，包括长度，类型
function iscardno(card)
{
//身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符x
var reg = /(^\d{15}$)|(^\d{17}(\d|x)$)/;
if(reg.test(card) === false)
{
return false;
}

return true;
}

//取身份证前两位,校验省份
function checkprovince(card)
{
var province = card.substr(0,2);
if(vcity[province] == undefined)
{
return false;
}
return true;
}

//检查生日是否正确
function checkbirthday(card)
{
var len = card.length;
//身份证15位时，次序为省（3位）市（3位）年（2位）月（2位）日（2位）校验位（3位），皆为数字
if(len == '15')
{
var re_fifteen = /^(\d{6})(\d{2})(\d{2})(\d{2})(\d{3})$/;
var arr_data = card.match(re_fifteen);
var year = arr_data[2];
var month = arr_data[3];
var day = arr_data[4];
var birthday = new date('19'+year+'/'+month+'/'+day);
return verifybirthday('19'+year,month,day,birthday);
}
//身份证18位时，次序为省（3位）市（3位）年（4位）月（2位）日（2位）校验位（4位），校验位末尾可能为x
if(len == '18')
{
var re_eighteen = /^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|x)$/;
var arr_data = card.match(re_eighteen);
var year = arr_data[2];
var month = arr_data[3];
var day = arr_data[4];
var birthday = new Date(year+'/'+month+'/'+day);
return verifybirthday(year,month,day,birthday);
}
return false;
}

//校验日期
function verifybirthday(year,month,day,birthday)
{
var now = new Date();
var now_year = now.getFullYear();
//年月日是否合理
if(birthday.getFullYear() == year && (birthday.getMonth() + 1) == month && birthday.getDate() == day)
{
//判断年份的范围（3岁到100岁之间)
var time = now_year - year;
if(time >= 3 && time <= 100)
{
return true;
}
return false;
}
return false;
}

//校验位的检测
function checkparity(card)
{
//15位转18位
card = changefivteentoeighteen(card);
var len = card.length;
if(len == '18')
{
var arrint = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
var arrch = new Array('1', '0', 'x', '9', '8', '7', '6', '5', '4', '3', '2');
var cardtemp = 0, i, valnum;
for(i = 0; i < 17; i ++)
{
cardtemp += card.substr(i, 1) * arrint[i];
}
valnum = arrch[cardtemp % 11];
if (valnum == card.substr(17, 1))
{
return true;
}
return false;
}
return false;
}

//15位转18位身份证号
function changefivteentoeighteen(card)
{
if(card.length == '15')
{
var arrint = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
var arrch = new Array('1', '0', 'x', '9', '8', '7', '6', '5', '4', '3', '2');
var cardtemp = 0, i;
card = card.substr(0, 6) + '19' + card.substr(6, card.length - 6);
for(i = 0; i < 17; i ++)
{
cardtemp += card.substr(i, 1) * arrint[i];
}
card += arrch[cardtemp % 11];
return card;
}
return card;
}


//显示剩余的字符
function remaining_word(input_word,words_nums,show_words){
	var input_word_obj="";
	if((typeof input_word) == "string"){
		  input_word_obj=document.getElementById(input_word);
	}else{
		  input_word_obj=input_word;
	}
  var input_word_obj_value=input_word_obj.value;
  var input_word_len=input_word_obj_value.length;
  if(input_word_len>=words_nums){
  
     document.getElementById(show_words).innerHTML="<b><font color='#FF0000'>0</font></b>";
    
  }else{
     document.getElementById(show_words).innerHTML=String(parseInt(words_nums)-parseInt(input_word_len));
  }
}

//显示剩余的字符
function remaining_travelconsulting_word(input_word,words_nums,show_words){
	var input_word_obj="";
	if((typeof input_word) == "string"){
		  input_word_obj=document.getElementById(input_word);
	}else{
		  input_word_obj=input_word;
	}
  var input_word_obj_value=input_word_obj.value;
  var input_word_len=input_word_obj_value.length;
  if(input_word_len>=words_nums){
  
     document.getElementById(show_words).innerHTML="<b><font color='#FF0000'>0</font></b>";
    
  }else{
     document.getElementById(show_words).innerHTML=String(parseInt(words_nums)-parseInt(input_word_len));
  }
}

//显示用户的提示信息
function show_tip_dialog(title,tips_contents){
	 var dialog=new Dialog();
	 document.getElementById("show_operate_tips_content").innerHTML=tips_contents;
   dialog.show_dialog(title,{"ok_button":{"name":"确定"},"cancel_button":{"name":"取消"}},{"width":300,"height":600,"HiddenID":"show_operate_tips","overlay":false,'time':'500','auto':true});
}

function upload_user_head(){
	var fileForm = new Object();
 var head_img = document.getElementById("head_img").value;
 if(head_img!= "") {
   var form = document.getElementById("userhead-form");
 form.target = "my_head";
 var sid = Math.random();
 form.action = "/index.php/user/headiframe?rnd="+sid;
 form.submit();
 }else{
 document.getElementById("show_upload_message").innerHTML="请选择您要上传的图片";
 }
 document.getElementById("show_upload_message").innerHTML="正在处理中.....";
}
//上传个人头像回调函数
function head_callback(img_src){
	   document.getElementById("user_head_img").src=img_src;
	   document.getElementById("user_head_center").src=img_src;
	   document.getElementById("show_upload_message").innerHTML="修改头像成功";
	
}
//订阅免费邮件服务
function subscribe(s_type){
	    jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
				  jQuery('#waiting').html("正在处理中...");
			   },
			   url: "/index.php/user/subscribe",
			   data: "s_type="+s_type+"&rnd="+Math.random(),
			   dataType:'json',
			   success: function(msg){
			   	var json_obj=msg;
			   	if(s_type){
			   		if(json_obj.result=="success"){
			   			 jQuery("#cancel_subscribe").show();
			   			 jQuery("#ok_subscribe").hide();
			   			 jQuery("#email_subscribe_desc").html("已经");
			   			
			   		}
			   	}else{
			   		if(json_obj.result=="success"){
			   			jQuery("#ok_subscribe").show();
			   			jQuery("#cancel_subscribe").hide();
			   			jQuery("#email_subscribe_desc").html("未");
			   		}
			   	}
			    jQuery('#waiting').html(json_obj.content);
			  }
			 });
}


//锁定button
function lock_disabled(id,msg){
	var obj="";
	if(typeof(id)== "string"){
		obj=jQuery("#"+id);
	}else{
		obj=id;
	}
	obj.val(msg);
  obj.attr("disabled",true);
	
}
//解锁button
function unlock_disabled(id,msg){
	
	var obj="";
	if(typeof(id)== "string"){
		obj=jQuery("#"+id);
	}else{
		obj=id;
	}
	obj.val(msg);
  obj.attr("disabled",false);

}

//组合ajax提交时，未登录的话，跳转到登录页面链接的参数
function combine_login_page_params(params){
    var str = "";
    if(params){
        for(var key in params){
            str += "&" + key + "=" + params[key];
        }
    }
    return str;
}


//发送在线咨询表单
function submit_consulting(form_id){
	  
	  var serialize_values=jQuery("#"+form_id).serialize();
  	var comment_content_value=document.getElementById("consulting_content").value;
  	var consulting_email=document.getElementById("consulting_email").value;
  	//var verification_code=document.getElementById("consulting_verification_code").value;
  	//if(!verification_code){
  		//alert("验证码不能为空");
  		//return false;
  	//}
  	if(!consulting_email){
  		alert("邮箱不能为空");
  		return false;
  	}else{
  		if(!is_email(consulting_email)){
			   alert("邮箱格式不正确");
			   return false;
		 }
  	}
  
  	if(comment_content_value){
  		var len=comment_content_value.length;
  		if(len>3000){
  			alert("评论内容不能大于3000个字");
  		}else{
  		lock_disabled("consulting_buttong","咨询中....");
  	jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
				  //jQuery('#sub_address_'+String(parent_category_id)).html("<div class='loading_progress'><img  src='/css/images/progress.gif'></div>");
			   },
			   url: "/index.php/travel/consulting",
			   processData:true,
			   data: serialize_values+"&rnd="+Math.random(),
			   dataType:'json',
			   success: function(msg){
			   	  var json_obj=msg;
			   	  if(json_obj.result=="success"){
			   	  	 jQuery("#trave_consulting_datas").load("/index.php/travel/consultingdatas",{'trave_id':trave_id});
			   	  	 show_tip_dialog("咨询成功","咨询成功");
			   	  }else{
               show_tip_dialog("咨询失败",json_obj.result);
			   	  }
			   	  document.getElementById("consulting_verification_code").value="";
			   	  jQuery("#consulting_on_click").click();
			   	  unlock_disabled("consulting_buttong","我要咨询");
			   }
	  });
	 }
  }else{
  	 alert("评论内容不能为空"); 
  }
}
function submit_serial_form(form_id){
  	var serialize_values=jQuery("#"+form_id).serialize();
  	var comment_content_value=document.getElementById("comment_content").value;
  	//var verification_code=document.getElementById("verification_code").value;
  	//if(!verification_code){
  		//alert("验证码不能为空");
  		//return false;
  	//}
  	if(comment_content_value){
  		var len=comment_content_value.length;
  		if(len>100){
  			alert("评论内容不能大于100个字");
  		}else{
  		lock_disabled("trave_comment_button","发表评论中....");
  	jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
				  //jQuery('#sub_address_'+String(parent_category_id)).html("<div class='loading_progress'><img  src='/css/images/progress.gif'></div>");
			   },
			   url: "/index.php/travel/travelcomments",
			   processData:true,
			   data: serialize_values+"&rnd="+Math.random(),
			   dataType:'json',
			   success: function(msg){
			   	  var json_obj=msg;
			   	  if(json_obj.result=="success"){
			   	  	jQuery("#trave_comment_datas").load("/index.php/travel/commentdatas",{'trave_id':trave_id});
			   	  	show_tip_dialog("评论成功","评论成功");
			   	  }else{
               show_tip_dialog("评论失败",json_obj.result);
			   	  }
			   	  document.getElementById("verification_code").value="";
			   	  jQuery("#comment_on_click").click();
			   	  unlock_disabled("trave_comment_button","发表评论");
			   }
	  });
	 }
  }else{
  	 alert("评论内容不能为空"); 
  }
  }

  function submit_survey_form(form_id){
  	var serialize_values=jQuery("#"+form_id).serialize();
  	jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
				  //jQuery('#sub_address_'+String(parent_category_id)).html("<div class='loading_progress'><img  src='/css/images/progress.gif'></div>");
			   },
			   url: "/index.php/site/survey",
			   processData:true,
			   data: serialize_values+"&rnd="+Math.random(),
			   dataType:'json',
			   success: function(msg){
			   	  var json_obj=msg;
			   	  if(json_obj.result=="success"){
			   	   	 jQuery("#onlinesurvey_success").fadeIn("fast");
	
			   	   	 window.setTimeout(function(){jQuery("#onlinesurvey_success").fadeOut("fast");},5000);
			   	  }else{
			   	  	 jQuery("#onlinesurvey_failed").fadeIn("fast");
			   	  	 
			   	  	 window.setTimeout(function(){jQuery("#onlinesurvey_failed").fadeOut("fast");},5000);
			   	  }
			   	 
			   }
	  });
  }
  
  
  //发送ajax邮箱验证邮件
  
  function send_validate_email(user_id){
  	jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
				  
			   },
			   url: "/index.php/site/validatemail",
			   processData:true,
			   data: "user_id="+user_id+"&rnd="+Math.random(),
			   dataType:'json',
			   success: function(msg){
			   	  var json_obj=msg;
			   	  if(json_obj.result=="Y"){
			   	  
			   	   	show_tip_dialog("邮件验证","验证邮件已经发送成功，请查收邮件并完成邮箱验证");
			   	  }else{
			   	  	show_tip_dialog("邮件验证","验证邮件发送失败，请重新验证");
			   	  }
			   }
	  });
  	
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
      window_wrapper.className="TB_overlayMacFFBGHack"; 
   		window_wrapper.id="window_wrapper";
   		var self=this;
   		window_wrapper.ondblclick=function(){
   			self.hide();
   		};
    }else{ 
    	window_wrapper=ge("window_wrapper");
    }
    
    if(ua.ie()<=6){
       //针对于ie6遮住select
       var hiddeniframe=document.createElement('iframe');
       hiddeniframe.frameborder=0;
       hiddeniframe.tabindex=-1;
       hiddeniframe.src="";
       hiddeniframe.className="hiddeniframe";
       window_wrapper.appendChild(hiddeniframe);
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
 	    var self=this;
 	    if(this.button.ok_button.name){
 	       jQuery("#ok_button").bind('click',function(){
 	       	  self.click_ok();
 	       });
 	    }

 	    if(this.button.cancel_button.name){
 	       jQuery("#cancel_button").bind('click',function(){
 	       	  self.click_close();
 	       	}); 
 	    }
 	    
 	    jQuery("#dialog_close").bind('click',function(){
 	    
 	    	self.click_close();
 	    })
 	       
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
 	 if(ua.ie()<=6){
       window_content.innerHTML="<iframe frameborder='0' tabindex='-1' src='' class='hiddeniframe'></iframe><table width='100%' cellspacing='0' cellpadding='0'><tbody><tr><td class='left_top'></td><td class='mid_con'></td><td class='right_top'></td></tr><tr><td class='c_mid_con'></td><td class='c_mid_con'><div id='center_content' class='center_content'><div class='center_title' id='center_title'><span class='dialog_title' id='dialog_title'>"+this.title+"</span><span class='dialog_close' id='dialog_close'>关闭</span></div><div class='dialog_center' id='dialog_center'></div><div class='dialog_button' id='dialog_button'>"+button_content+"</div></div></td><td class='c_mid_con'></td></tr><tr><td class='left_bottom'></td><td class='mid_con'></td><td class='right_bottom'></td></tr></tbody></table>";
   }else{ 
 	   window_content.innerHTML="<table width='100%' cellspacing='0' cellpadding='0'><tbody><tr><td class='left_top'></td><td class='mid_con'></td><td class='right_top'></td></tr><tr><td class='c_mid_con'></td><td class='c_mid_con'><div id='center_content' class='center_content'><div class='center_title' id='center_title'><span class='dialog_title' id='dialog_title'>"+this.title+"</span><span class='dialog_close' id='dialog_close'>关闭</span></div><div class='dialog_center' id='dialog_center'></div><div class='dialog_button' id='dialog_button'>"+button_content+"</div></div></td><td class='c_mid_con'></td></tr><tr><td class='left_bottom'></td><td class='mid_con'></td><td class='right_bottom'></td></tr></tbody></table>";
 	 }
 	 return window_content;
 },
 rend_button:function(){
 
 	var button_content="<div class='button_wrapper' id='button_wrapper'>";
 	if(this.button.ok_button.name)
 	    button_content+="<span class='ok_button'><input id='ok_button' type='button'  value='"+this.button.ok_button.name+"'/></span>";
 	if(this.button.cancel_button.name)
 	    button_content+="<span><input id='cancel_button' type='button'  value='"+this.button.cancel_button.name+"'/></span>";   
 	button_content+="</div>";
 
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
      var self=this;
       if(this.button.ok_button.name){
 	       jQuery("#ok_button").bind('click',function(){
 	       	  self.click_ok();
 	       });
 	    }

 	    if(this.button.cancel_button.name){
 	       jQuery("#cancel_button").bind('click',function(){
 	       	  self.click_close();
 	       	}); 
 	    }
 	    
 	    jQuery("#dialog_close").bind('click',function(){
 	    	self.click_close();
 	    })
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
 
 
 //travel_route_calendar.js
 
var Extend = function(destination, source) {
    for (var property in source) {
        destination[property] = source[property];
    }
    return destination;
}


var Calendar = Class.create();
Calendar.prototype = {
  initialize: function(container, options) {
	this.Container = document.getElementById(container);//容器(table结构)
	this.Days = [];//日期对象列表
	
	this.SetOptions(options);
	this.trave_date_datas=this.options.trave_date_datas||"";
	this.Year = this.options.Year || new Date().getFullYear();
	this.Month = this.options.Month || new Date().getMonth() + 1;
	this.SelectDay = this.options.SelectDay ? new Date(this.options.SelectDay) : null;
	this.onSelectDay = this.options.onSelectDay;
	this.onToday = this.options.onToday;
	this.onFinish = this.options.onFinish;	
	
	this.Draw();
  },
  //设置默认属性
  SetOptions: function(options) {
	this.options = {//默认值
		Year:			0,//显示年
		Month:			0,//显示月
		trave_date_datas: null,
		SelectDay:		null,//选择日期
		onSelectDay:	function(){},//在选择日期触发
		onToday:		function(){},//在当天日期触发
		onFinish:		function(){}//日历画完后触发
	};
	Extend(this.options, options || {});
  },
  //当前月
  NowMonth: function() {
	this.PreDraw(new Date());
  },
  //上一月
  PreMonth: function() {
	this.PreDraw(new Date(this.Year, this.Month - 2, 1));
  },
  //下一月
  NextMonth: function() {
	this.PreDraw(new Date(this.Year, this.Month, 1));
  },
  //上一年
  PreYear: function() {
	this.PreDraw(new Date(this.Year - 1, this.Month - 1, 1));
  },
  //下一年
  NextYear: function() {
	this.PreDraw(new Date(this.Year + 1, this.Month - 1, 1));
  },
  //根据日期画日历
  PreDraw: function(date) {
	//再设置属性
	this.Year = date.getFullYear(); this.Month = date.getMonth() + 1;
	//重新画日历
	this.Draw();
  },
  //画日历
  Draw: function() {
  
	//用来保存日期列表
	var arr = [];
	//用当月第一天在一周中的日期值作为当月离第一天的天数
	for(var i = 1, firstDay = new Date(this.Year, this.Month - 1, 1).getDay(); i <= firstDay; i++){ arr.push(0); }
	//用当月最后一天在一个月中的日期值作为当月的天数
	for(var i = 1, monthDay = new Date(this.Year, this.Month, 0).getDate(); i <= monthDay; i++){ arr.push(i); }
	//清空原来的日期对象列表
	this.Days = [];
	//插入日期
	var frag = document.createDocumentFragment();
	while(arr.length){
		//每个星期插入一个tr
		var row = document.createElement("tr");
		//每个星期有7天
		for(var i = 1; i <= 7; i++){
			var cell = document.createElement("td"); cell.innerHTML = "&nbsp;";
			if(arr.length){
				var d = arr.shift();
				if(d){
					var on = new Date(this.Year, this.Month - 1, d);
					cell.innerHTML=this.contact_d(d);
					this.Days[d] = cell;
					//判断是否今日
					this.IsSame(on, new Date()) && this.onToday(cell);
					//判断是否选择日期
					this.SelectDay && this.IsSame(on, this.SelectDay) && this.onSelectDay(cell);
				}
			}
			row.appendChild(cell);
		}
		frag.appendChild(row);
	}
	
	//先清空内容再插入(ie的table不能用innerHTML)
	while(this.Container.hasChildNodes()){ this.Container.removeChild(this.Container.firstChild); }
	this.Container.appendChild(frag);
	//附加程序
	this.onFinish();
  },
  
  contact_d:function(d){
  	var tem_date=this.Year+"/"+((this.Month <=9)?("0"+String(this.Month )):String(this.Month ))+"/"+((d<=9)?("0"+String(d)):String(d));
  	var json_obj=this.trave_date_datas;
  	var len=json_obj.length;
  	for(var ii=0;ii<len;ii++){
  		
  		if(json_obj[ii].trave_date==tem_date){
  			 if(this.Year>=new Date().getFullYear()){
  			 	if(this.Year==new Date().getFullYear()){
  				 if(this.Month==new Date().getMonth()+1){
				 			if(d >=new Date().getDate()){
						 	 	   d+="<div class='calendar_trave_date' id='t_"+json_obj[ii].trave_date+"'><a href=\"javascript:select_trave_date('"+json_obj[ii].trave_date+"')\">￥"+json_obj[ii].trave_price+"起</a></div><div class='trave_seats'>"+json_obj[ii].seats+"</div>";
							}else{
						 	 	  d="<div class='text_999999'>"+d+"<div class='calendar_trave_date'>￥"+json_obj[ii].trave_price+"起</div><div class='trave_seats'>"+json_obj[ii].seats+"</div></div>";
			  			}
					 }else{
					 	   if(this.Month<new Date().getMonth()+1){
							    d="<div class='text_999999'>"+d+"<div class='calendar_trave_date'>￥"+json_obj[ii].trave_price+"起</div><div class='trave_seats'>"+json_obj[ii].seats+"</div></div>";
						   }else{
						   	 	d+="<div class='calendar_trave_date' id='t_"+json_obj[ii].trave_date+"'><a href=\"javascript:select_trave_date('"+json_obj[ii].trave_date+"')\">￥"+json_obj[ii].trave_price+"起</a></div><div class='trave_seats'>"+json_obj[ii].seats+"</div>";
						  } 
					}
				 }else{
				 	  d+="<div class='calendar_trave_date' id='t_"+json_obj[ii].trave_date+"'><a href=\"javascript:select_trave_date('"+json_obj[ii].trave_date+"')\">￥"+json_obj[ii].trave_price+"起</a></div><div class='trave_seats'>"+json_obj[ii].seats+"</div>";
				 }
  			}else{
						d="<div class='text_999999'>"+d+"<div class='calendar_trave_date'>￥"+json_obj[ii].trave_price+"起</div><div class='trave_seats'>"+json_obj[ii].seats+"</div></div>";
  			}  
  		}else{
  			if(this.Year>=new Date().getFullYear()){
  				 if(this.Year==new Date().getFullYear()){
  				  if(this.Month==new Date().getMonth()+1){
				 			if(d <new Date().getDate()){
						 	 	  d="<div class='text_999999'>"+d+"</div>";  
							}
					 }else{
						if(this.Month<new Date().getMonth()+1){
							  d="<div class='text_999999'>"+d+"</div>";  
						}
					 }
					}
  			}else{
  		     d="<div class='text_999999'>"+d+"</div>";
  			} 
  		}
  	}
  	return d;
  },
  //判断是否同一日
  IsSame: function(d1, d2) {
	   return (d1.getFullYear() == d2.getFullYear() && d1.getMonth() == d2.getMonth() && d1.getDate() == d2.getDate());
  } 
}

var send_phone_nums=0;
//user_login.js
function get_phone_verification(value_id){
   	var user_phone=jQuery("#"+value_id).val();
   	if(user_phone){
   		//if(!is_phone(user_phone,"")){
   			//jQuery('#user_phone_tip').html("手机号码格式不正确");
   			
   		//}else{
   			
   	  if(send_phone_nums<3){
   		jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
				  jQuery('#user_phone_tip').html("<div class='loading_progress'><img src='/css/images/progress.gif'></div>");
			   },
			   url: "/index.php/site/phoneverification",
			   data: "user_phone="+jQuery("#"+value_id).val()+"&rnd="+Math.random(),
			   success: function(msg){
			   	  jQuery("#user_phone_tip").html(msg);
			   	  jQuery("#hidden_user_phone").val(user_phone);
			   	  send_phone_nums++;
			  }
	  	});
	  	
	    }else{
	    	jQuery('#user_phone_tip').html("申请次数不能超过3次");
	    }
	   //} 
		}else{
			jQuery('#user_phone_tip').html("手机号码不能为空");
		}
  }
  
  
  

  
  
  
  //加入收藏和设为首页
          function addCookie(url,name) {　
　　　　　　　　　　　 if (document.all) {
　　　　　　　　　　　　　　window.external.addFavorite(url, name);
　　　　　　　　　　　 }
　　　　　　　　　　　 else if (window.sidebar) {
　　　　　　　　　　　      window.sidebar.addPanel(name, url, "");
　　　　　　　　　　　 }
　　　　　　　 }
　　　　　　　 function setHomepage(url) {　
　　　　　　　　　　　 if (document.all) {
　　　　　　　　　　　　　　　 document.body.style.behavior = 'url(#default#homepage)';
　　　　　　　　　　　　　　　 document.body.setHomePage(url);

　　　　　　　　　　　 }
　　　　　　　　　　　 else if (window.sidebar) {
　　　　　　　　　　　　　　　 if (window.netscape) {
　　　　　　　　　　　　　　　　　　　 try {
　　　　　　　　　　　　　　　　　　　　　　　 netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
　　　　　　　　　　　　　　　　　　　 }
　　　　　　　　　　　　　　　　　　　 catch (e) {
　　　　　　　　　　　　　　　　　　　　　　　 alert("该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true");
　　　　　　　　　　　　　　　　　　　 }
　　　　　　　　　　　　　　　 }
　　　　　　　　　　　　　　　 var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
　　　　　　　　　　　　　　　 prefs.setCharPref('browser.startup.homepage', url);
　　　　　　　　　　　 }
　　　　　　　 } 


//获取线路日期选择项
  function get_trave_date_datas(){
  	  var select_trave_date=document.getElementById("select_trave_date");
  	  var select_indexed=select_trave_date.selectedIndex;
  	  
  	  if(select_indexed!=-1){
  	   var select_options=select_trave_date.options[select_indexed];
	     var std_value=select_options.value;
	     var adult_price=select_options.getAttribute("adult_price");
	     var child_price=select_options.getAttribute("child_price");
	     var date_key=select_options.getAttribute("date_key");
	    }
	   return {'std_value':std_value,'adult_price':adult_price,"child_price":child_price,'date_key':date_key};
  }

function isIFrameSelf(){
 try{
	 if(window.top ==window){
	 	 return false;
	 }else{
		 return true;
	 }
  }catch(e){
  	return true;
  	}
 }
function toHome(){ 
	if(!isIFrameSelf()){
		 window.location.href="http://www.41ly.cn/";
	}
}



//显示中元会员协议
function show_agreement_dialog(){
     var dialog=new Dialog();
     dialog.show_dialog("中元会员协议",{"ok_button":{"name":""},"cancel_button":{"name":""}},{"width":760,"height":550,"HiddenID":"member_agreement","overlay":true});
   }

//选择搜索条件
    function select_district(district_id,trave_category,district_name,is_parent){
        jQuery("#hidden_fdistrict_id").val(district_id);
        jQuery("#hidden_trave_category").val(trave_category);
        jQuery("#trave_region").val(district_name);
        jQuery("#hidden_pfdistrict_id").val(is_parent);
        jQuery("#trave_region_content").fadeOut("fast");
        		
     }
        	
   //取消搜索条件     	
      function cancel_district(){
        jQuery("#hidden_fdistrict_id").val('');
        jQuery("#hidden_trave_category").val('');
        jQuery("#trave_region").val('');
        jQuery("#hidden_pfdistrict_id").val('');
        jQuery("#trave_region_content").fadeOut("fast");
        		
      }

//获得搜索条件的分类的内容
function get_category_condition_content(trave_category,search_condition){
    	       var trave_region_center=jQuery('#trave_region_center');
    	      jQuery.ajax({
			                type: "GET",
			                beforeSend: function(){
				                 trave_region_center.html("<div class='loading_progress'><img  src='/css/images/progress.gif'></div>");
			                },
			                url: "/index.php/site/searchregion",
			                data: "search_condition="+search_condition+"&trave_category="+trave_category+"&rnd="+Math.random(),
			                dataType:'html',
			                success: function(msg){
			                   trave_region_center.html(msg);
			               }
			      });
}
//获得搜索条件的分类的信息
function get_category_condition(trave_category){
           jQuery.ajax({
			          type: "GET",
			          beforeSend: function(){},
			          url: "/index.php/site/searchcondition",
			          data: "trave_category="+trave_category+"&rnd="+Math.random(),
			          dataType:'json',
			          success: function(msg){
                    var json_array=msg;
                    var len=json_array.length;
                    var select_html="<select name='search_condition' id='search_condition'>";
                    for(var ii=0;ii<len;ii++){
                    	select_html+="<option value='"+json_array[ii].id+"'>"+json_array[ii].name+"</option>";
                    }
                    select_html+="</select>";
                    jQuery("#trt_condition_content").html(select_html);
                    var search_trave_condition=jQuery("#search_condition").val();
   	   	            get_category_condition_content(trave_category,search_trave_condition);	  
                    jQuery("#search_condition").unbind("change");
                    jQuery("#search_condition").bind("change",function(){
                    var search_condition=jQuery(this).val();
                    get_category_condition_content(trave_category,search_condition);
        	        });  
			         }
			        });	
}

//选择特色
function select_characteristic_advance(svalue,search_type){
   	if(svalue){
   	 var find_id=select_characteristic.find_value(svalue);
  
   	 if(find_id){
   	  	select_characteristic=select_characteristic.remove(find_id-1);
   	 }else{
   		  select_characteristic.push(svalue);
   	 }
   }else{
   	    select_characteristic=[];
   }
   	 document.getElementById("search_"+search_type).value=select_characteristic.join(',');
   	document.getElementById("searchform").submit();
  }
 function select_advance(svalue,search_type){
   	 document.getElementById("search_"+search_type).value=svalue;
   	 document.getElementById("searchform").submit();
 }
   
function select_tcid_advance(svalue,search_type){
   	 document.getElementById(search_type).value=svalue;
   	 document.getElementById("searchform").submit();
}




     //点击日历选择开始时间	
 function select_trave_date(trave_date){
	var select_trave_date=document.getElementById("select_trave_date");
	var trave_date_options=select_trave_date.options;
	var len=trave_date_options.length;
	for(var ii=0;ii<len;ii++){
		if(trave_date_options[ii].value==trave_date){
			  trave_date_options[ii].selected="SELECTED";
		}
	}
}


//显示线路的出发日期
  function show_min_dialog(){
  	 var min_dialog=new Dialog();
     min_dialog.show_dialog("出发日期详情",{"ok_button":{"name":"确定","func":""},"cancel_button":{"name":"取消","func":""}},{"width":480,"height":550,"HiddenID":"trave_route_calendar","overlay":true});
  }
  
  //显示线路详情的出发日期
  function show_dialog(){
     var dialog=new Dialog();
     dialog.show_dialog("出发日期详情",{"ok_button":{"name":"确定"},"cancel_button":{"name":"取消"}},{"width":760,"height":550,"HiddenID":"trave_route_calendar","overlay":true});
   }

  
  
  //获得酒店航班
    function get_trave_flight(trave_id,trave_date,std_value){
  	jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
				  jQuery("#trave_flight").html("<div class='ajax_tip_content'>加载线路航班中...</div>");
			   },
			   url: "/index.php/travel/traveflight",
			   data: "trave_id="+trave_id+"&trave_date="+trave_date+"&std_value="+std_value+"&rnd="+Math.random(),
			   success: function(msg){
			     var json_obj=msg;
           jQuery("#trave_flight").html(json_obj);
           calculation_free_total();
			  }
			 });
  }

//获得酒店信息
  function get_trave_hotels(trave_id,trave_date,limit){
  	jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
				  jQuery("#trave_hotels").html("<div class='ajax_tip_content'>加载线路酒店中...</div>");
			   },
			   url: "/index.php/travel/travehotels",
			   data: "trave_id="+trave_id+"&trave_date="+trave_date+"&limit="+limit+"&rnd="+Math.random(),
			   success: function(msg){
			     var json_obj=msg;
           jQuery("#trave_hotels").html(json_obj);
           calculation_free_total();
			  }
			 });
  }
  //显示公司旅游的定制信息
 function show_message(){
     	  	var com_message=jQuery("#gc_com_message");
     	  	var com_message_display=com_message.css("display");
     	  	var arrow_img=jQuery("#message_arrow_img");
     	  	if(com_message_display=="none"){
     	  		com_message.show();
     	  		arrow_img.attr('src',"/css/images/message-arrow.png");
     	  		
     	  	}else{
     	  		com_message.hide();
     	  		arrow_img.attr('src',"/css/images/message-arrow_d.png");
     	  	}
}

//显示酒店描述的更多
function show_hotel_information(hotel_key){
     	 jQuery("#hotel_information_"+hotel_key).hide();
     	 jQuery("#hotel_information_more_"+hotel_key).show();
     	   	
}

//显示酒店描述的更多
function hide_hotel_information(hotel_key){
     	 jQuery("#hotel_information_"+hotel_key).show();
     	 jQuery("#hotel_information_more_"+hotel_key).hide();
     	   	
}




  //获得用户选择的酒店
  function get_select_hotel(){
  	            jQuery('.check_hotel').unbind('click');
            	  jQuery('.check_hotel').bind('click',function(){
            	    var hotel_id=jQuery(this).attr("hotel_id");
            	    var room_price=jQuery(this).attr("room_price");
            	    var room_id=jQuery(this).attr("room_id");
            	    jQuery("#hotel_id").val(hotel_id);
            	    jQuery("#room_price").val(room_price);
            	    jQuery("#room_id").val(room_id);
            	    calculation_free_total();
            	 })
  }
  
  
  
  //输入酒店的晚数
  function change_trave_route_number(){
  	jQuery("#trave_route_number_select").unbind( "change");
  	jQuery("#trave_route_number_select").bind("change",function(){
  		var trave_route_number=jQuery(this).val();
  		jQuery("#trave_route_number").val(trave_route_number);
  		if(!trave_route_number){
  			alert("入住晚数不能为空");
  			jQuery("#room_end_date").html('');
  			return;
  		}
  		var room_begin_date=jQuery("#room_begin_date").html();
  	  var tem_end_date=new Date(room_begin_date.substr(0,4),room_begin_date.substr(5,2),room_begin_date.substr(8,2));
  	  var end_date=new Date(tem_end_date.getFullYear(),tem_end_date.getMonth()-1,tem_end_date.getDate()+parseInt(jQuery(this).val()));
  	  jQuery("#room_end_date").html(getTime(end_date).substr(0,10));
  	  calculation_free_total();
  	}); 
  }
  
  
  
    //获得套餐的航班
    function get_trave_flight_p(trave_id,trave_date,std_value){
  	jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
				  jQuery("#trave_flight").html("<div class='ajax_tip_content'>加载线路航班中...</div>");
			   },
			   url: "/index.php/travel/traveflight",
			   data: "trave_id="+trave_id+"&trave_date="+trave_date+"&std_value="+std_value+"&rnd="+Math.random(),
			   success: function(msg){
			     var json_obj=msg;
           jQuery("#trave_flight").html(json_obj);
           calculation_free_total();
			  }
			 });
  }
  //获得套餐的酒店
  function get_trave_hotels_p(trave_id,trave_date,limit){
  	jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
				  jQuery("#trave_hotels").html("<div class='ajax_tip_content'>加载线路酒店中...</div>");
			   },
			   url: "/index.php/travel/travehotels",
			   data: "trave_id="+trave_id+"&trave_date="+trave_date+"&limit="+limit+"&rnd="+Math.random(),
			   success: function(msg){
			     var json_obj=msg;
           jQuery("#trave_hotels").html(json_obj);
           change_trave_route_number_p();
           get_select_hotel_p();
           calculation_free_total();
			  }
			 });
  }
  
  //获得用户选择的酒店
  function get_select_hotel_p(){
  	            jQuery('.check_hotel').unbind('click');
            	  jQuery('.check_hotel').bind('click',function(){
            	    var hotel_id=jQuery(this).attr("hotel_id");
            	    var room_price=jQuery(this).attr("room_price");
            	    var room_id=jQuery(this).attr("room_id");
            	    jQuery("#hotel_id").val(hotel_id);
            	    jQuery("#room_price").val(room_price);
            	    jQuery("#room_id").val(room_id);
            	    calculation_free_total();
            	 })
  }
  //输入酒店的晚数
  function change_trave_route_number_p(){
  	jQuery("#trave_route_number_select").unbind( "change");
  	jQuery("#trave_route_number_select").bind("change",function(){
  		var trave_route_number=jQuery(this).val();
  		jQuery("#trave_route_number").val(trave_route_number);
  		if(!trave_route_number){
  			alert("入住晚数不能为空");
  			jQuery("#room_end_date").html('');
  			return;
  		}
  		var room_begin_date=jQuery("#room_begin_date").html();
  	  var tem_end_date=new Date(room_begin_date.substr(0,4),room_begin_date.substr(5,2),room_begin_date.substr(8,2));
  	  var end_date=new Date(tem_end_date.getFullYear(),tem_end_date.getMonth()-1,tem_end_date.getDate()+parseInt(jQuery(this).val()));
  	  jQuery("#room_end_date").html(getTime(end_date).substr(0,10));
  	  calculation_free_total();
  	}); 
  }
  
  //显示克隆线路的弹窗
  function show_clonedialog(trave_id){
     var frame_dialog=new FrameDialog();
     frame_dialog.show_dialog("克隆线路",{"ok_button":{},"cancel_button":{}},{"width":300,"height":150,"FrameUrl":"/backend.php/main/clone?trave_id="+trave_id,"overlay":false}); 
   }
   
   
   //显示发送信息的弹窗
  function show_messagedialog(message_id,message_type){
  	var frame_dialog=new FrameDialog();
     frame_dialog.show_dialog("发送信息",{"ok_button":{},"cancel_button":{}},{"width":800,"height":400,"FrameUrl":"/backend.php/main/message?message_id="+message_id+"&message_type="+message_type,"overlay":true}); 
  }
  
  
   //显示发送信息的弹窗
  function show_importpdialog(message_id){
  	var frame_dialog=new FrameDialog();
     frame_dialog.show_dialog("发送信息",{"ok_button":{},"cancel_button":{}},{"width":800,"height":400,"FrameUrl":"/backend.php/main/importp?message_id="+message_id,"overlay":true}); 
  }
   
   

//iepngfix
var DD_belatedPNG={ns:"DD_belatedPNG",imgSize:{},delay:10,nodesFixed:0,createVmlNameSpace:function(){document.namespaces&&!document.namespaces[this.ns]&&document.namespaces.add(this.ns,"urn:schemas-microsoft-com:vml")},createVmlStyleSheet:function(){var a;a=document.createElement("style");a.setAttribute("media","screen");document.documentElement.firstChild.insertBefore(a,document.documentElement.firstChild.firstChild);if(a.styleSheet){a=a.styleSheet;a.addRule(this.ns+"\\:*","{behavior:url(#default#VML)}");
a.addRule(this.ns+"\\:shape","position:absolute;");a.addRule("img."+this.ns+"_sizeFinder","behavior:none; border:none; position:absolute; z-index:-1; top:-10000px; visibility:hidden;");this.screenStyleSheet=a;a=document.createElement("style");a.setAttribute("media","print");document.documentElement.firstChild.insertBefore(a,document.documentElement.firstChild.firstChild);a=a.styleSheet;a.addRule(this.ns+"\\:*","{display: none !important;}");a.addRule("img."+this.ns+"_sizeFinder","{display: none !important;}")}},
readPropertyChange:function(){var a,c,b;a=event.srcElement;if(a.vmlInitiated){if(event.propertyName.search("background")!=-1||event.propertyName.search("border")!=-1)DD_belatedPNG.applyVML(a);if(event.propertyName=="style.display"){c=a.currentStyle.display=="none"?"none":"block";for(b in a.vml)if(a.vml.hasOwnProperty(b))a.vml[b].shape.style.display=c}event.propertyName.search("filter")!=-1&&DD_belatedPNG.vmlOpacity(a)}},vmlOpacity:function(a){if(a.currentStyle.filter.search("lpha")!=-1){var c=a.currentStyle.filter;
c=parseInt(c.substring(c.lastIndexOf("=")+1,c.lastIndexOf(")")),10)/100;a.vml.color.shape.style.filter=a.currentStyle.filter;a.vml.image.fill.opacity=c}},handlePseudoHover:function(a){setTimeout(function(){DD_belatedPNG.applyVML(a)},1)},fix:function(a){if(this.screenStyleSheet){var c;a=a.split(",");for(c=0;c<a.length;c++)this.screenStyleSheet.addRule(a[c],"behavior:expression(DD_belatedPNG.fixPng(this))")}},applyVML:function(a){a.runtimeStyle.cssText="";this.vmlFill(a);this.vmlOffsets(a);this.vmlOpacity(a);
a.isImg&&this.copyImageBorders(a)},attachHandlers:function(a){var c,b,e,d,f;c=this;b={resize:"vmlOffsets",move:"vmlOffsets"};if(a.nodeName=="A"){e={mouseleave:"handlePseudoHover",mouseenter:"handlePseudoHover",focus:"handlePseudoHover",blur:"handlePseudoHover"};for(d in e)if(e.hasOwnProperty(d))b[d]=e[d]}for(f in b)if(b.hasOwnProperty(f)){e=function(){c[b[f]](a)};a.attachEvent("on"+f,e)}a.attachEvent("onpropertychange",this.readPropertyChange)},giveLayout:function(a){a.style.zoom=1;if(a.currentStyle.position==
"static")a.style.position="relative"},copyImageBorders:function(a){var c,b;c={borderStyle:true,borderWidth:true,borderColor:true};for(b in c)if(c.hasOwnProperty(b))a.vml.color.shape.style[b]=a.currentStyle[b]},vmlFill:function(a){if(a.currentStyle){var c,b,e;c=a.currentStyle;for(b in a.vml)if(a.vml.hasOwnProperty(b))a.vml[b].shape.style.zIndex=c.zIndex;a.runtimeStyle.backgroundColor="";a.runtimeStyle.backgroundImage="";b=true;if(c.backgroundImage!="none"||a.isImg){if(a.isImg)a.vmlBg=a.src;else{a.vmlBg=
c.backgroundImage;a.vmlBg=a.vmlBg.substr(5,a.vmlBg.lastIndexOf('")')-5)}e=this;if(!e.imgSize[a.vmlBg]){b=document.createElement("img");e.imgSize[a.vmlBg]=b;b.className=e.ns+"_sizeFinder";b.runtimeStyle.cssText="behavior:none; position:absolute; left:-10000px; top:-10000px; border:none; margin:0; padding:0;";b.attachEvent("onload",function(){this.width=this.offsetWidth;this.height=this.offsetHeight;e.vmlOffsets(a)});b.src=a.vmlBg;b.removeAttribute("width");b.removeAttribute("height");document.body.insertBefore(b,
document.body.firstChild)}a.vml.image.fill.src=a.vmlBg;b=false}a.vml.image.fill.on=!b;a.vml.image.fill.color="none";a.vml.color.shape.style.backgroundColor=c.backgroundColor;a.runtimeStyle.backgroundImage="none";a.runtimeStyle.backgroundColor="transparent"}},vmlOffsets:function(a){var c,b,e,d,f,h;c=a.currentStyle;b={W:a.clientWidth+1,H:a.clientHeight+1,w:this.imgSize[a.vmlBg].width,h:this.imgSize[a.vmlBg].height,L:a.offsetLeft,T:a.offsetTop,bLW:a.clientLeft,bTW:a.clientTop};e=b.L+b.bLW==1?1:0;d=function(g,
l,m,i,j,k){g.coordsize=i+","+j;g.coordorigin=k+","+k;g.path="m0,0l"+i+",0l"+i+","+j+"l0,"+j+" xe";g.style.width=i+"px";g.style.height=j+"px";g.style.left=l+"px";g.style.top=m+"px"};d(a.vml.color.shape,b.L+(a.isImg?0:b.bLW),b.T+(a.isImg?0:b.bTW),b.W-1,b.H-1,0);d(a.vml.image.shape,b.L+b.bLW,b.T+b.bTW,b.W,b.H,1);d={X:0,Y:0};if(a.isImg){d.X=parseInt(c.paddingLeft,10)+1;d.Y=parseInt(c.paddingTop,10)+1}else for(f in d)d.hasOwnProperty(f)&&this.figurePercentage(d,b,f,c["backgroundPosition"+f]);a.vml.image.fill.position=
d.X/b.W+","+d.Y/b.H;f=c.backgroundRepeat;h={T:1,R:b.W+e,B:b.H,L:1+e};c={X:{b1:"L",b2:"R",d:"W"},Y:{b1:"T",b2:"B",d:"H"}};if(f!="repeat"||a.isImg){d={T:d.Y,R:d.X+b.w,B:d.Y+b.h,L:d.X};if(f.search("repeat-")!=-1){f=f.split("repeat-")[1].toUpperCase();d[c[f].b1]=1;d[c[f].b2]=b[c[f].d]}if(d.B>b.H)d.B=b.H;a.vml.image.shape.style.clip="rect("+d.T+"px "+(d.R+e)+"px "+d.B+"px "+(d.L+e)+"px)"}else a.vml.image.shape.style.clip="rect("+h.T+"px "+h.R+"px "+h.B+"px "+h.L+"px)"},figurePercentage:function(a,c,b,
e){var d,f;f=true;d=b=="X";switch(e){case "left":case "top":a[b]=0;break;case "center":a[b]=0.5;break;case "right":case "bottom":a[b]=1;break;default:if(e.search("%")!=-1)a[b]=parseInt(e,10)/100;else f=false}a[b]=Math.ceil(f?c[d?"W":"H"]*a[b]-c[d?"w":"h"]*a[b]:parseInt(e,10));a[b]%2===0&&a[b]++;return a[b]},fixPng:function(a){a.style.behavior="none";var c,b,e,d,f;if(!(a.nodeName=="BODY"||a.nodeName=="TD"||a.nodeName=="TR")){a.isImg=false;if(a.nodeName=="IMG")if(a.src.toLowerCase().search(/\.png$/)!=
-1){a.isImg=true;a.style.visibility="hidden"}else return;else if(a.currentStyle.backgroundImage.toLowerCase().search(".png")==-1)return;c=DD_belatedPNG;a.vml={color:{},image:{}};b={shape:{},fill:{}};for(d in a.vml)if(a.vml.hasOwnProperty(d)){for(f in b)if(b.hasOwnProperty(f)){e=c.ns+":"+f;a.vml[d][f]=document.createElement(e)}a.vml[d].shape.stroked=false;a.vml[d].shape.appendChild(a.vml[d].fill);a.parentNode.insertBefore(a.vml[d].shape,a)}a.vml.image.shape.fillcolor="none";a.vml.image.fill.type="tile";
a.vml.color.fill.on=false;c.attachHandlers(a);c.giveLayout(a);c.giveLayout(a.offsetParent);a.vmlInitiated=true;c.applyVML(a)}}};if(ua.ie()==6){try{document.execCommand("BackgroundImageCache",false,true)}catch(r){}DD_belatedPNG.createVmlNameSpace();DD_belatedPNG.createVmlStyleSheet()};

//轮转的flash广告
function slide_flashad(options){
  this.options=options;
  this.current_id=0;
  this.datas_length="";
  this.click_name=true;
  
}

slide_flashad.prototype={
	rend_ad:function(){
		var content="";
  	var pic_width=this.options.pic_width;
  	var pic_heihgt=this.options.pic_heihgt;
  	var text_height=this.options.text_height;
  	var show_time=this.options.show_time||1000;
  	var auto=this.options.auto;
  	var auto_time=this.options.auto_time||2000;
  	var text_show=this.options.text_show;
  	this.datas_length=this.options.datas_length;
  	var text_width=(pic_width/this.datas_length);
  	var imgw=this.options.imgw;
  	var namew=this.options.namew;
  	jQuery("."+imgw).css('width',(parseInt(this.datas_length)*parseInt(pic_width))+"px");
  	if(text_show){
  		jQuery("."+namew).css('top',pic_heihgt+"px").css('left','0px');
  		jQuery("."+namew+">.f_name").css('width',text_width+"px").css('height',text_height+"px");

   }
    var self=this;
  	if(text_show){
  	 jQuery(".f_name").click(function(){
  	 	if(self.click_name){
  		var click_this=jQuery(this);
  		var n_id=click_this.attr("id");
  		var i_ids=n_id.split("_");
  		self.show(i_ids[1]);
  		if(self.auto_timeout){
  		  window.clearTimeout(self.auto_timeout);
  		  self.auto_timeout=window.setTimeout(function(){self.autoscroll();},auto_time);
  	  }
  	 }
  	}).hover(function(){jQuery(this).addClass("f_name_select_hover");},function(){jQuery(this).removeClass("f_name_select_hover");});
  	}
  	if(auto){
  		jQuery(document).ready(function(){
  		  self.auto_timeout=window.setTimeout(function(){self.autoscroll();},auto_time);
  		});
  	}
		
	},
	
	show:function(i_id){
  	var name_id="n_"+String(i_id);
  	this.slide_animate(i_id);
  	if(this.options.text_show){
  	 jQuery(".f_name_select").removeClass("f_name_select");
  	 jQuery("#"+name_id).addClass("f_name_select");
  	}
  	this.current_id=i_id;
	},
	slide_animate:function(i_id){
	 var f_wrapperimg=jQuery("."+this.options.imgw);
	 var i_left=parseInt(f_wrapperimg.css("left"));
	 this.click_name=false;
	 var self=this;
	 if(i_id<=this.current_id){
	 	var slide_left=i_left+((this.current_id-i_id)*this.options.pic_width);
	 	f_wrapperimg.animate( {left:slide_left},{queue:false,duration:this.options.show_time,complete:function(){self.click_name=true;}});
	 }else{
			var slide_left=i_left-((i_id-this.current_id)*this.options.pic_width);
	 	  f_wrapperimg.animate( {left:slide_left},{queue:false,duration:this.options.show_time,complete:function(){self.click_name=true;}});
	 	 
	 }
	},
	
	autoscroll:function(i_id){
		 var self=this;//闭包
  	var datas_length=self.datas_length;
  	var show_id="";
  	if(parseInt(self.current_id)<(datas_length-1)){
  		 show_id=parseInt(self.current_id)+1;
  	}else{
  		 show_id=0;
  	}
  	self.show(show_id);
  	self.auto_timeout=window.setTimeout(function(){self.autoscroll();},self.options.auto_time);
		
	}
	
}




function fade_flashad(options){
	this.options=options;
  this.current_id=0;
  this.datas_length="";
  this.click_name=true;
}
extend(fade_flashad,slide_flashad);

fade_flashad.prototype.rend_ad=function(){
 		var content="";
 		var pic_width=this.options.pic_width;
  	var pic_heihgt=this.options.pic_heihgt;
  	var text_height=this.options.text_height;
  	var show_time=this.options.show_time||1000;
  	var auto=this.options.auto;
  	var auto_time=this.options.auto_time||2000;
  	var text_show=this.options.text_show;
  	this.datas_length=this.options.datas_length;
  	var text_width=(pic_width/this.datas_length);
  	var namew=this.options.namew;
  	if(text_show){
  		jQuery("."+namew).css('top',pic_heihgt+"px").css('left','0px');
  		jQuery("."+namew+">.f_name").css('width',text_width+"px").css('height',text_height+"px");
    }
    var self=this;
  	if(text_show){
  	 jQuery(".f_name").click(function(){
  	 	if(self.click_name){
  		var click_this=jQuery(this);
  		var n_id=click_this.attr("id");
  		var i_ids=n_id.split("_");
  		self.show(i_ids[1]);
  		if(self.auto_timeout){
  		  window.clearTimeout(self.auto_timeout);
  		  self.auto_timeout=window.setTimeout(function(){self.autoscroll();},auto_time);
  	  }
  	 }
  	}).hover(function(){jQuery(this).addClass("f_name_select_hover");},function(){jQuery(this).removeClass("f_name_select_hover");});
  	}
  	if(auto){
  		jQuery(document).ready(function(){
  		  self.auto_timeout=window.setTimeout(function(){self.autoscroll();},auto_time);
  		});
  	}
 
 };
 
 
fade_flashad.prototype.slide_animate=function(i_id){
	
	   
	   var f=jQuery("#f_"+i_id);
     var c_f=jQuery("#f_"+this.current_id);
     var datas_length=this.options.datas_length;
     if(datas_length==1){
     	  c_f.hide();
        f.fadeIn(this.options.show_time,function(){});
    }else{
     var rand=rand32()*10;
	   if(0<=rand&&rand<=3){
	     f.slideDown(this.options.show_time,function(){c_f.hide();});
	   }else if(3<rand&&rand<=6){
	   	 f.css("left",-this.options.pic_width);
       f.show();
       f.animate( {left:0},{queue:false,duration:this.options.show_time,complete:function(){}});
       c_f.animate( {left:this.options.pic_width},{queue:false,duration:this.options.show_time,complete:function(){jQuery(this).hide();jQuery(this).css("left",0);}});
	   }else{
	   	  c_f.hide();
        f.fadeIn(this.options.show_time,function(){});
	   }
	 }
 
};

function close_left(){
	jQuery("#ad_left").hide();
}

function close_right(){
	jQuery("#ad_right").hide();
}


 
 
 














	







