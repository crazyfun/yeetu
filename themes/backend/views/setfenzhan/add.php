<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("setfenzhan/index");?>">返回到分站列表</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertuser-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
           ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "分站修改"; else echo "分站添加"; ?></div>
           <div class="input_line"><div class="input_name">分站名</div><div class="input_long_content"><input  type="hidden" id="region_id" name="region_id" value="<?php echo $model->region_id;?>"><input readonly id="region" onclick="javascript:select_fenzhan([{'id':'<?php echo $model->region_id;?>','name':'<?php echo $model->District->district_name; ?>'}]);" type="text" name="region" value="<?php echo $model->District->district_name; ?>"/></div><div class="input_error"><?php echo $form->error($model,'region_id'); ?></div><div class="clear_both"></div></div>
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


