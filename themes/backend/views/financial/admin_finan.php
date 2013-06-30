<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("financial/order",array());?>'>返回到财务管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'financial-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
        )); ?>
    		<?php echo $form->hiddenField($model,"id");?>
    		<?php echo CHtml::hiddenField("order_id",$order_id);?>
    		<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    		<div class="jwy_add">供应商结算</div>
    		<div class="input_line"><div class="input_name">总结算金额</div><div class="input_content">
    			 <?php echo $total_pay;?>
    		</div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">已结算金额</div><div class="input_content">
    			
    			<?php echo $already_pay;?>
    		</div><div class="clear_both"></div></div>
    			
    		<div class="input_line"><div class="input_name">需结算金额</div><div class="input_content">
    			 <?php echo $remain_pay;?>
    			
    		</div><div class="clear_both"></div></div>
    			
   	    <div class="input_line"><div class="input_name">结算金额</div><div class="input_content"><?php echo CHtml::textField("finan_price",$remain_pay,array()); ?></div><div class="input_error"><?php echo $form->error($model,'finan_price'); ?></div><div class="clear_both"></div></div>
        

    	<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"提交"));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("name"=>"reset","id"=>"reset","value"=>"重置"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>



