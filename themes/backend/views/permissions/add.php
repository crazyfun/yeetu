<?php
   Yii::app()->clientScript->registerScriptFile('/js/Managepermission.js');
?>
<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("permissions/index");?>">返回到权限管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertpermissions-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
           ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "权限修改"; else echo "权限添加"; ?></div>
           <div class="input_line"><div class="input_name">权限名</div><div class="input_content"><?php if(!empty($model->id)) echo $model->permissions_name; else echo $form->textField($model,"permissions_name",array());?></div><div class="input_error"><?php echo $form->error($model,'permissions_name'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">权限值</div>
           	    <?php $this->widget('PermissionsVars', array(
  	  	  	        'menu'=>$model->get_user_permissions(),
	                  'permissions_value'=>$model->permissions_value,
		           
	               )); ?>
           	
           	<div class="input_error"><?php echo $form->error($model,'permissions_value'); ?></div><div class="clear_both"></div></div>
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("permissions/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>
    
<script language="javascript">
  var managepermission="";
  jQuery(document).ready(function(){
     managepermission=new Managepermission();
  });
</script>


