<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("images/category");?>">返回到图片分类管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'addc-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
           ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "图片分类修改"; else echo "图片分类添加"; ?></div>
           <div class="input_line"><div class="input_name">图片分类名称</div><div class="input_content"><?php echo $form->textField($model,"category_title",array('readonly'=>$readonly));?></div><div class="input_error"><?php echo $form->error($model,'category_title'); ?></div><div class="clear_both"></div></div>
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("images/category"));?></div><div class="clear_both"></div></div></div>
    	  <?php $this->endWidget(); ?>
    	</div>
    </div>


