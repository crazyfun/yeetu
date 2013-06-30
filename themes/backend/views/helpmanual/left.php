<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php  
	   Yii::app()->clientScript->registerCssFile('/css/admin.css');
	   Yii::app()->clientScript->registerCoreScript('jquery');
	?>
</head>
<body>
	 <div class="menutd" style="height:100%;">
	  <div class="hmenu" id="hleftmenu">
	    <ul id="menu_global" style="overflow: visible;">
	    	<li>
	    		<div class="hparent">
	    			 <a class="child_menu">后台登录</a>
	    			 <div class="h_extend"><img class="h_extend_i" src="/css/images/add.gif" width="19" height="18"/></div>
	    		</div>
	    		<div class="hchild" style="display:none;">
	    			 <ul class="hchild_ul">
	    			     <li><a  href="/backend.php/helpmanual/help/help/login" target="right">后台登录入口</a></li>	
	    			     
	    			 </ul>
	    	  </div>
	      </li>
	      
	      <li>
	    		<div class="hparent">
	    			 <a class="child_menu" target="right">线路</a>
	    			 <div class="h_extend"><img class="h_extend_i" src="/css/images/add.gif" width="19" height="18"/></div>
	    		</div>
	    		<div class="hchild" style="display:none;">
	    			 <ul class="hchild_ul">
	    			     <li><a  href="/backend.php/helpmanual/help/help/addtrave" target="right">添加线路</a></li>
	    			     <li><a href="/backend.php/helpmanual/help/help/traveregion" target="right">线路目的地始发地设置</a></li>	
	    			     <li><a href="/backend.php/helpmanual/help/help/traveroute" target="right">行程内容编辑</a></li>
	    			     <li><a href="/backend.php/helpmanual/help/help/travetime" target="right">出发时间编辑</a></li>
	    			     <li><a href="/backend.php/helpmanual/help/help/traveimage" target="right">景点图片的编辑</a></li>
	    			     <li><a href="/backend.php/helpmanual/help/help/travemanage" target="right">线路管理</a></li>
	    			 </ul>
	    	  </div>
	      </li>
	      
	      
	    </ul>
   </div>
  </div>
  <script language="javascript">
  	   jQuery(document).ready(function(){
  	       	jQuery(".h_extend_i").bind('click',function(){
  	       		 var hchild_display=jQuery(this).parent().parent().parent().find(".hchild").css("display");
  	       		
  	       		 if(hchild_display=="none"){
  	       		  jQuery(this).attr("src","/css/images/sub.gif");
  	       		  jQuery(this).parent().parent().parent().find(".hchild").show();
  	       		 }else{
  	       		 	jQuery(this).attr("src","/css/images/add.gif");
  	       		  jQuery(this).parent().parent().parent().find(".hchild").hide();
  	       		 }
  	       		
  	       	});
  	       	jQuery(".hchild_ul>li>a").bind("click",function(){
  	       		 jQuery(".tabon").removeClass("tabon");
  	       		 jQuery(this).addClass("tabon");
  	       		 
  	       		
  	       	});
  	   	
  	   });
  </script>
</body>
</html>