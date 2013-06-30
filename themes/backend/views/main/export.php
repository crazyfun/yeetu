<?php  $attributeLabels=$model->attributeLabels();
       unset($attributeLabels['id']);
       unset($attributeLabels['station_id']);
?>
<div id="page_content">
    <div class="show_right_content">
    <!--编辑框-->	
    	<div class="edit_content">
    		<?php 
    		  $form=$this->beginWidget('CActiveForm', array('id'=>'','action'=>"",'enableAjaxValidation'=>false,'htmlOptions'=>array('enctype'=>'multipart/form-data')));//'enctype'=>'multipart/form-data');
        ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           
           <div class="jwy_add">配置信息</div>
           <div class="input_line"><div class="input_name">导出字段:</div><div class="input_content"> 
                <?php echo CHtml::checkBoxList("attributes","",$attributeLabels,array('class'=>'export_rules')); ?>
           	</div>
           	<div class="input_error">
                <?php echo $errors['attributes'];?>
           	</div>
           </div>
	         
	         <div class="input_line hasbgbot">
				       <div class="edit_input_button"><input type="submit" class="input_submit" value="确定" name="button_ok"/><input type="reset" class="input_cancel" value="取消" name="button_reset"/></div>
			     </div>
	   
    	<?php $this->endWidget(); ?>
    	</div>
    	 <!--编辑框end-->	
    </div>
</div>
    
    



    
    
    
    
    



