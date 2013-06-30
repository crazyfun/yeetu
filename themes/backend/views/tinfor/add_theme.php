<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("tinfor/theme");?>">返回到资讯主题</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttinfor-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php echo $form->hiddenField($model,"id");?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "资讯主题修改"; else echo "资讯主题添加"; ?></div>
           <div class="input_line"><div class="input_name">资讯主题名称</div><div class="input_long_content"><?php echo $form->textField($model,"theme_name");?></div><div class="input_error"><?php echo $form->error($model,'theme_name'); ?></div><div class="clear_both"></div></div>
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("tinfor/addtheme"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


