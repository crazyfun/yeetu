   jQuery(function($) {
       var trave_name_val=jQuery("#trave_name").val();
	     jQuery("#trave_name").Watermark("线路编号/线路名称/旅行社名称");
	     if(trave_name_val&&(trave_name_val!="线路编号/线路名称/旅行社名称")){
	     	  jQuery("#trave_name").val(trave_name_val);
	     }
	     jQuery('#search_submit').click(function() {
	       if( $("#trave_name").val() == "线路编号/线路名称/旅行社名称" ) $("#trave_name").val('');
	     });
	  
	  if(jQuery(".hover_image")){ 
	  	
	   jQuery(".hover_image").hover(
       function () {
       	 
         var big_image=jQuery(this).attr("big_image");
         jQuery("#show_big_image").attr("src",big_image);
         var offset=jQuery(this).offset();
         jQuery("#float_big_image").css("top",offset.top).css("left",offset.left+75);
         jQuery("#float_big_image").fadeTo("5000", 0.9);
       },
       function () {
         jQuery("#show_big_image").attr("src","");
         jQuery("#float_big_image").hide();
       }
      ); 
    }
   }); 
   
  selectaddress="";
	function select_city(default_selected){
   if(!selectaddress)
     selectaddress=new select_address();
   selectaddress.show_content({class_name:"selectaddress","default_selected":default_selected,input_id:"trave_region",url:"/backend.php/main/district",datas:"address_category=2",suburl:"/backend.php/main/subdistrict",subdatas:"",multiple:false,multiple_max:"",onchange_function:""});
}

 function select_linetype(default_selected){
 	 
 	  if(!selectaddress)
     selectaddress=new select_address();
   selectaddress.show_content({class_name:"selectaddress","default_selected":default_selected,input_id:"trave_linetype",url:"/backend.php/main/line",datas:"",suburl:"/backend.php/main/subline",subdatas:"",multiple:true,multiple_max:"",onchange_function:""});
}
	function select_scity(){
   if(!selectaddress)
     selectaddress=new select_address();
   selectaddress.show_content({class_name:"selectaddress",input_id:"trave_region",url:"/backend.php/main/district",datas:"address_category=2",suburl:"/backend.php/main/subdistrict",subdatas:"",multiple:false,multiple_max:"",onchange_function:""});
}


	function select_sregion(){
   if(!selectaddress)
     selectaddress=new select_address();
   selectaddress.show_content({class_name:"selectaddress",input_id:"trave_sregion",url:"/backend.php/main/district",datas:"address_category=2",suburl:"/backend.php/main/subdistrict",subdatas:"",multiple:false,multiple_max:"",onchange_function:""});
}


function select_trave_hotels(default_selected){
	 if(!selectaddress)
     selectaddress=new select_address();
   selectaddress.show_content({class_name:"selectaddress","default_selected":default_selected,input_id:"trave_hotels",url:"/backend.php/main/travehotel",datas:"",suburl:"/backend.php/main/subtravehotel",subdatas:"",multiple:true,multiple_max:"",onchange_function:""});
	
}

function select_ad_sregion(){
	   if(!selectaddress)
	     selectaddress=new select_address();
	   selectaddress.show_content({class_name:"selectaddress",input_id:"trave_sregion",url:"/backend.php/main/sregion",datas:"address_category=2",suburl:"/backend.php/main/subsregion",subdatas:"",multiple:true,multiple_max:"",onchange_function:""});
}

	function select_fenzhan(default_selected){

   if(!selectaddress)
     selectaddress=new select_address();
   selectaddress.show_content({class_name:"selectaddress","default_selected":default_selected,input_id:"region",url:"/backend.php/main/district",datas:"address_category=2",suburl:"/backend.php/main/subdistrict",subdatas:"",multiple:false,multiple_max:"",onchange_function:""});
}


//增加trave_area
 function add_trave_area(trave_id,trave_route){
  	var trave_area_text=document.getElementById("add_trave_route").value;

  	if(trave_area_text){
  	  jQuery.ajax({
			   type: "POST",
			   beforeSend: function(){
			   },
			   url:"/backend.php/main/ajaxtarea",
			   data: "trave_area="+trave_area_text+"&trave_id="+trave_id+"&trave_route="+trave_route+"&rnd="+Math.random(),
			   dataType:'json',
			   success: function(msg){  
			   	var json_obj=msg;
			   	if(json_obj.result=="N"){
			   		alert("景点名称已存在");
			   	}else{
			   		document.getElementById("trave_route_select").innerHTML=json_obj.result;
			   	}
         }
			});
		}else{
			 alert("景点名称为空");
		}
  	
  }
  
  function submit_trave_form(form_id,form_url){
  	document.getElementById(form_id).action=form_url;
  	document.getElementById(form_id).submit();
  }
  
