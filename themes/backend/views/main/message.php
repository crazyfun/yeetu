<?php
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
<?php if(!empty($active_dataprovider)){ ?>
<div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchuser-form',
          'action'=>$this->createUrl("",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
        <?php echo CHtml::hiddenField("message_id",$message_id);?>
	      <?php echo CHtml::hiddenField("message_type",$message_type);?>
       	  <div class="search_item"><span class="search_item_name">用户名/ID:</span><span class="search_item_input"><?php echo CHtml::textField("user_login",$user_login,array('id'=>'search_user_login'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">手机号码:</span><span class="search_item_input"><?php echo CHtml::textField("user_phone",$user_phone,array('id'=>'search_user_phone'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">邮箱:</span><span class="search_item_input"><?php echo CHtml::textField("email",$email,array('id'=>'search_email'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">激活:</span><span class="search_item_input"><?php echo CHtml::dropDownList("user_active",$user_active,array(''=>'是否激活','1'=>'未激活','2'=>'已激活'),array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">管理员:</span><span class="search_item_input"><?php echo CHtml::dropDownList("status",$status,array(''=>'是否是管理员','1'=>'普通用户','2'=>'管理员'),array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">用户等级:</span><span class="search_item_input"><?php echo CHtml::dropDownList("level",$level,CV::$USER_LEVEL,array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">注册时间:</span><span class="search_item_input"><?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $create_time; ?>",readOnly:true});'));?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
<div class="message_main">
 <?php if(empty($message_id)){ ?>
      未选择发送的信息ID
<?php }else{ ?>
	<?php echo CHtml::beginForm($this->createUrl(""),"POST",array("id"=>'message_form','onsubmit'=>'javascript:submit_message();'));?>
	<?php echo CHtml::hiddenField("message_id",$message_id);?>
	<?php echo CHtml::hiddenField("message_type",$message_type);?>
	<?php echo CHtml::hiddenField("message_select","",array('id'=>'message_select'));?>
	 
	 <div class="message_select">
       <?php 
       	   	  $this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$active_dataprovider,
												'itemView'=>'show_message',
												'ajaxUpdate'=>ture,
												'afterAjaxUpdate'=>'update_success',
										));
						?>
      
      
   </div>
   <div class="clear_both"></div>
   
   <div class="custom_date_select">发送时间：<input type="text" name="custom_date" value="<?php echo $custom_date;?>" readonly onclick='javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $custom_date;?>"});'/><span class="message_tip">根据此时间在当天的早上9：00钟定时发送信息，未填则为立即发送</span></div>
   <div class="custom_date_select">全部发送:<input type="checkbox" name="is_all" value="1"/><span class="message_tip">如果选择则给所有用户发送信息(慎用)</span></div>
	 <div class="message_submit"><span class="ok_button"><input type="submit" name="message_ok" value="确定" id="ok_button"></span></div>
	 <?php echo CHtml::endForm();?>
 <?php } ?>
</div>

 <script language="javascript">
 	var select_messages=new Array();
 	function update_success(id, data){
 		 	jQuery(".message_checkbox").each(function(){
    	   	  	var message_id=jQuery(this).attr("message_id");
    	   	  	if(select_messages.find_value(message_id)){
    	   	  		jQuery(this).attr("checked",true);
    	   	  	} 
    });
 	}
	jQuery(function($) {
       
		   jQuery(".message_checkbox").live("click",function(){
            	   var checked_flag=jQuery(this).attr("checked");
            	   var message_id=jQuery(this).attr("message_id");
            	   var push_key=select_messages.find_value(message_id);
            	   
            	   if(checked_flag){
            	   	 if(!push_key)
            	      select_messages.push(message_id);
            	   }else{
            	   	 if(push_key)
            	   	  select_messages.splice(push_key-1,1);
            	   }
            	   
         });
  })
  
  function submit_message(){
  	var select_messages_join=select_messages.join(",");
  	jQuery("#message_select").val(select_messages_join);
  	return true;
  }
</script>

<?php } ?>