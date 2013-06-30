<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("permissions/userindex");?>">返回到设置用户权限</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertsetpermissions-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
           ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add">设置用户权限</div>
               
           <div class="input_line"><div class="input_name">选择权限</div><div class="input_content">
           	   <select id="permissions" name="permissions[]" multiple="multiple" size="10" style="width:200px;">
           	   	<?php 
        
           	   	$permissions_datas=Permissions::model()->get_user_setpermissions();
           	   	$user_permissions_datas=explode(',',$model->permissions);
           	   	foreach($permissions_datas as $key => $value){
           	   		if(in_array($key,$user_permissions_datas)){
           	   			echo "<option value='".$key."' SELECTED>".$value."</option>";
           	   		}else{
           	   			echo "<option value='".$key."'>".$value."</option>";
           	   		}
           	   	}
           	   	?>
           	   	
               </select>
           </div><div class="input_error"><?php echo $form->error($model,'permissions'); ?></div><div class="clear_both"></div></div>
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("permissions/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>



