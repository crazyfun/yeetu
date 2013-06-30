<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("nation/index");?>">返回到境外游</a></span><span><a href='<?php echo $this->createUrl("nation/travearea",array('trave_id'=>$model->trave_id));?>'>返回到境外游景区</a></span></div></div>
    	
    	<div class="edit_content">
    		
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttravearea-form',
          'action'=>$this->createUrl("nation/inserttravearea",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
           <?php echo $form->hiddenField($model,"id");?>
           <?php echo $form->hiddenField($model,"trave_id");?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          <div class="jwy_add"><?php if($model->id) echo "境外游景区修改"; else echo "境外游景区添加"; ?></div>
           <div class="input_line"><div class="input_name">线路景区名称</div><div class="input_content"><?php echo $form->textField($model,"trave_area");?></div><div class="input_error"><?php echo $form->error($model,'trave_area'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">是否导入景区图片</div><div class="input_content"><?php echo CHtml::checkBox("import_image",$import_image,array());?></div><div class="input_error"></div><div class="clear_both"></div></div>    		   
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("nation/addtravearea",'trave_id'=>$model->trave_id));?></div><div class="clear_both"></div></div></div>
 
    	
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


