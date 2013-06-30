<div id="page_content">
    <div class="show_right_content">
    	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("order/index",array());?>'>返回到订单管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttrave-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
        )); ?>
    		<?php echo $form->hiddenField($model,"id");?>
    		<?php echo CHtml::hiddenField("order_id",$order_id,array());?>
    		<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    		<div class="jwy_add">订单付款</div>
    		<div class="input_line"><div class="input_name">可支付金额</div><div class="input_content">
    		   <?php
    		     $trave_order=new Traveorder();
    		     $remain_pay=$trave_order->get_remain_pay($order_id);
    		     echo $remain_pay;
    		   ?>	
    			
    		 </div><div class="clear_both"></div></div>
   	    <div class="input_line"><div class="input_name">支付金额</div><div class="input_content"><?php echo $form->textField($model,"total_fee",array()); ?></div><div class="input_error"><?php echo $form->error($model,'total_fee'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">支付方式</div><div class="input_content"><?php echo $form->dropDownList($model,"trade_type",CV::$ADMIN_PAY_STYLE,array()); ?></div><div class="input_error"><?php echo $form->error($model,'trade_type'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">付款人名称</div><div class="input_content"><?php echo $form->textField($model,"receive_name",array()); ?></div><div class="input_error"><?php echo $form->error($model,'receive_name'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">付款人地址</div><div class="input_content"><?php echo $form->textField($model,"receive_address",array()); ?></div><div class="input_error"><?php echo $form->error($model,'receive_address'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">付款人邮编</div><div class="input_content"><?php echo $form->textField($model,"receive_zip",array()); ?></div><div class="input_error"><?php echo $form->error($model,'receive_zip'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">付款人电话号码</div><div class="input_content"><?php echo $form->textField($model,"receive_phone",array()); ?></div><div class="input_error"><?php echo $form->error($model,'receive_phone'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">付款人手机号码</div><div class="input_content"><?php echo $form->textField($model,"receive_mobile",array()); ?></div><div class="input_error"><?php echo $form->error($model,'receive_mobile'); ?></div><div class="clear_both"></div></div>
    	<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"提交"));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("name"=>"reset","id"=>"reset","value"=>"重置"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>
