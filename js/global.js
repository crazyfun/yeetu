//提交form_id的表单
function submit_form(form_id){
	document.getElementById(form_id).submit();
}

//选择所有
/*
 function selectallcheck(){
   	 var check_flag=document.getElementById("allcheck").checked;
   	 if(check_flag){
   	 	 jQuery(".itemcheckbox").attr("checked",true);
   	 }else{
   	 	 jQuery(".itemcheckbox").attr("checked",false);
   	 }
   }
   */
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
			            sub_address_html+="<div><span>"+sub_category.category_name+"</span>&nbsp;&nbsp;<span class='dz_pic'><a href=\"javascript:show_sub_category('"+String(sub_category.id)+"');\">查看子地址</a></span>&nbsp;&nbsp;<span class='xg_pic'><a href=\"/backend.php?r=category/add&id="+sub_category.id+"\">修改</a></span>&nbsp;&nbsp;<span class='sc_pic'><a href=\"javascript:delete_category('"+String(sub_category.id)+"');\">删除</a></span></div>";
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
			            sub_address_html+="<div><span>"+sub_district.district_name+"</span>&nbsp;&nbsp;<span class='dz_pic'><a href=\"javascript:show_sub_district('"+String(sub_district.id)+"');\">查看子地址</a></span>&nbsp;&nbsp;<span class='xg_pic'><a href=\"/backend.php?r=district/add&id="+sub_district.id+"\">修改</a></span>&nbsp;&nbsp;<span class='sc_pic'><a href=\"javascript:delete_district('"+String(sub_district.id)+"');\">删除</a></span></div>";
                  sub_address_html+="<div id=\"sub_address_"+String(sub_district.id)+"\" class='sub_address' is_request='1'>";
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
  		var select_trave_date=get_select_value("select_trave_date");
  		if(!select_trave_date){
  			 alert("出发日期不能为空");
  			 return false;

  		}
  		document.getElementById("hidden_adult_nums").value=document.getElementById("adult_nums").value;
  		document.getElementById("hidden_child_nums").value=document.getElementById("child_nums").value;
  		document.getElementById("hidden_start_date").value=get_select_value("select_trave_date");
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
		if(!is_phone(user_phone,'cell')){
			alert('手机号码格式不正确');
		}
	}
	//验证座机
	function check_telephone(user_phone){
		var area_code=document.getElementById("user_area_code").value;
		if(!area_code){
			  alert('请选择区号');
		}else{
			if(area_code&&!is_phone(area_code+"-"+user_phone,"tele")){
				alert('固定电话格式不正确');
			}
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
function check_cardid(card)
{
//校验长度，类型
if((iscardno(card) === false)&&(checkprovince(card) === false)&&(checkbirthday(card) === false)&&(checkparity(card) === false))
{
alert('您输入的身份证号码不正确');
return false;
}
return true;
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
//
function upload_user_head(){

	var userhead=document.getElementById("userhead-form");
	var userhead_clone=userhead.cloneNode(true);
	userhead_clone.id="userhead-form_submit";
	
	document.getElementById("hidden_iframe").contentWindow.document.getElementById("hidden_userhead-form").appendChild(userhead_clone);
	document.getElementById("hidden_iframe").contentWindow.document.getElementById("userhead-form_submit").submit();
	
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

jQuery(document).ready(function(){
    //qa
    jQuery(".ask_classify_select").change(function(){
        jQuery("#filter_by_cat").trigger("click");
    });
});

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
  	var verification_code=document.getElementById("consulting_verification_code").value;
  	if(!verification_code){
  		alert("验证码不能为空");
  		return false;
  	}
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
			   type: "GET",
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
			   	  	 jQuery("#trave_consulting_datas").load("index.php?r=travel/consultingdatas",{'trave_id':trave_id});
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
  	var verification_code=document.getElementById("verification_code").value;
  	if(!verification_code){
  		alert("验证码不能为空");
  		return false;
  	}
  	if(comment_content_value){
  		var len=comment_content_value.length;
  		if(len>100){
  			alert("评论内容不能大于100个字");
  		}else{
  		lock_disabled("trave_comment_button","发表评论中....");
  	jQuery.ajax({
			   type: "GET",
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
			   	  	jQuery("#trave_comment_datas").load("index.php?r=travel/commentdatas",{'trave_id':trave_id});
			   	  	show_tip_dialog("评论成功","评论成功");
			   	  }else{
               show_tip_dialog("评论失败",json_obj.result);
			   	  }
			   	  document.getElementById("verification_code").value="";
			   	  jQuery("#comment_on_click").click();
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
			   type: "GET",
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
