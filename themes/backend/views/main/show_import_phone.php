<div class="phone_item">
	     <div class="message_title"><?php echo $data->name;?></div> 	
	     <div class="message_title"><?php echo $data->phone;?></div>
	 	   <div class="message_operate">
	 	      <?php echo CHtml::checkBox("message_check",false,array('class'=>'message_checkbox','message_id'=>$data->id));?>
	 	   </div>

</div>