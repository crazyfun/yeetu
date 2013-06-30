<?php
  //$this->check_login("",CV::RETURN_ADMIN_INDEX,array()); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <?php    
		Yii::app()->clientScript->registerCssFile('/css/admin.css');
		Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerScriptFile('/js/basic.js');
		Yii::app()->clientScript->registerScriptFile('/js/manage_menu.js');
		Yii::app()->clientScript->registerScriptFile('/js/select_address.js');
		Yii::app()->clientScript->registerScriptFile('/js/watermarkinput.js');
		Yii::app()->clientScript->registerScriptFile('/js/trave.js');
		Yii::app()->clientScript->registerScriptFile('/js/admin.js');
		Yii::app()->clientScript->registerScriptFile('/js/admin_menu.js');
		Yii::app()->clientScript->registerScriptFile('/js/My97DatePicker/WdatePicker.js');
		Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
		
				Yii::app()->clientScript->registerCssFile("/js/jbox/Skins2/Green/jbox.css");
    Yii::app()->clientScript->registerScriptFile('/js/jbox/jquery.jBox-2.3.min.js');
    Yii::app()->clientScript->registerScriptFile('/js/jbox/i18n/jquery.jBox-zh-CN.js');
    ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="page_body">
  <!-- <div id="page_header"><div class="header_con"></div></div>-->
<div id="page_content">
<table height="100%" cellspacing="0" cellpadding="0" width="100%">
<tbody><tr>
<td height="50" colspan="2">
<div class="mainhd">
<div class="uinfo">
<p>您好, <em><?php echo Yii::app()->user->getName(); ?></em> [ <a target="_top" href="/backend.php/site/logout">退出</a> ]</p>
</div>

<div class="nav">
<ul id="topmenu">
	
	<?php $this->widget("TopMenu");?>
	
</ul>

<div class="navbd">
	
	
</div>

</div>
</div>
</td>
</tr>
<tr>
<td width="160" valign="top" class="menutd">
<div class="menu" id="leftmenu">
	 <ul style="overflow: visible;" id="menu_global">	    
	 </ul> 
</div>
</td>
<td width="100%" valign="top" id="mainframes" class="mask">
	<iframe scrolling="yes" height="100%" frameborder="0" width="100%" style="overflow: visible;"  name="main" id="rightframe" src=""></iframe>
</td>
</tr>
</tbody>
</table>
<div id="custombarpanel" class="custombar" style="width: 1252px;">	
</div>
</div>
</div>
<script language="javascript">
	jQuery(function(){
		window.setInterval("get_travel_order()",60000);		
	});
	function get_travel_order(){
		jQuery.ajax({
			   type: "get",
			   beforeSend: function(){
			   },
			   url:"/backend.php/main/ajaxorder",
			   data: "rnd="+Math.random(),
			   dataType:'json',
			   success: function(msg){  
			   	var json_obj=msg;
			   	if(json_obj.result=="N"){
			   		
			   	}else{
			   		jQuery.jBox.messager(json_obj.result, '订单提示');
			   	}
         }
			});
	}
</script>
</body>
</html>


