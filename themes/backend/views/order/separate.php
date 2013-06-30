<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("order/index",array());?>'>返回到订单管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttrave-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
        )); ?>
    		<?php echo $form->hiddenField($model,"id");?>
    		<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
    		<div class="jwy_add">拆单付款</div>
   	    <div class="input_line"><div class="input_name">总价钱</div><div class="input_content"><div id="separate_total_price"><?php echo $model->total_price; ?></div></div></div>
    		<div class="input_line"><div class="input_name">拆单数</div><div class="input_content"><?php echo $form->textField($model,"separate_nums",array());?></div><div class="input_error"><?php echo $form->error($model,'separate_nums'); ?></div><div>总价钱除以拆单数商和余数分别做为拆单价钱</div></div>
    		
    		<?php $order_separate=new OrderSeparate();$separate_price=$order_separate->get_table_datas("",array('order_id'=>$model->id)); 
    		 if(!empty($separate_price)){ ?>
    		
    		<div class="input_line"><div class="input_name">拆单价钱</div>
    			  <?php foreach($separate_price as $key => $value){ ?>
    			     <div class="input_content" style="width:50px;">
    			     	  <?php echo $value->separate_price; ?>
    			     	</div>
    			  <?php } ?>
    		</div>
    	<?php } ?>
 
    	<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"提交"));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("name"=>"reset","id"=>"reset","value"=>"重置"));?></div><div class="add_more"><?php echo CHtml::link("新增",array("nation/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>



