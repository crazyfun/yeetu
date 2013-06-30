<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("category/index",array());?>'>返回到线路分类</a></span></div></div>
    	<div class="edit_content">
    		
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertcategory-form',
          'action'=>$this->createUrl("category/addcategory",array()),
          
	        'enableAjaxValidation'=>false,
        )); ?>
        
    		<?php echo $form->hiddenField($model,"id");?>
    		<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          	<div class="jwy_add"><?php if($model->id) echo "线路分类修改"; else echo "线路分类添加"; ?></div>
    		<div class="input_line"><div class="input_name">线路分类名称:</div><div class="input_content"><?php echo $form->textField($model,"category_name");?></div><div class="input_error"><?php echo $form->error($model,'category_name'); ?></div><div class="clear_both"></div></div>
			<div class="input_line"><div class="input_name">前台排序:</div><div class="input_content"><?php echo $form->textField($model,"sort_id");?></div><div class="input_error"><?php echo $form->error($model,'sort_id'); ?></div><div class="clear_both"></div></div>
			<div class="input_line"><div class="input_name">线路分类父类:</div><div class="input_content"><?php echo UserHmtl::get_select_value("parent_id",$model->get_select_op(),$model->parent_id,"请选择父类",$class_name="");?></div><div class="input_error"><?php echo $form->error($model,'parent_id'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("category/add"));?></div><div class="clear_both"></div><div class="clear_both"></div></div></div>
    	 <?php $this->endWidget(); ?>
    	</div>
    </div>
