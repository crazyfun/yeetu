<div class="message_item">
	  <div class="message_logo"><img src="<?php echo $data->get_user_head(50,50,$data->id);?>"/></div>
	  <div class="message_desc">
	     <div class="message_title"><?php echo $data->user_login;?></div> 	
	 	   <div class="message_operate">
	 	      <?php echo CHtml::checkBox("message_check",false,array('class'=>'message_checkbox','message_id'=>$data->id));?>	
	 	   </div>
	  </div>
</div>