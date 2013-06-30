<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("consulting/index");?>">返回到在线咨询</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertconsulting-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
              echo CHtml::hiddenField("create_time",empty($create_time)?$model->create_time:$create_time,array());
            ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          <div class="jwy_add"><?php if($model->id) echo "在线咨询回复修改"; else echo "在线咨询添加"; ?></div>
           <div class="input_line"><div class="input_name">咨询用户</div><div class="input_long_content"><?php echo CHtml::textField("create_name",empty($create_name)?$model->get_create_name():$create_name,array('readonly'=>'readonly')) ?> </div><div class="input_error"><?php echo $form->error($model,'create_id'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">线路名称</div><div class="input_long_content"><?php echo CHtml::textField("trave_name",empty($trave_name)?$model->Trave->trave_name:$trave_name,array('readonly'=>'readonly')) ?> </div><div class="input_error"><?php echo $form->error($model,'trave_id'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">回复Email</div><div class="input_long_content"><?php echo CHtml::textField("consulting_email",$model->consulting_email,array('readonly'=>'readonly')) ?></div><div class="input_error"><?php echo $form->error($model,'consulting_email')?></div><div class="clear_both"></div></div>           
           <div class="input_line"><div class="input_name">在线咨询内容</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'consulting_content',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          )); ?>
          </div><div class="input_error"><?php echo $form->error($model,'consulting_content'); ?></div><div class="clear_both"></div></div>
          	
          	
         <div class="input_line"><div class="input_name">回复内容</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'reply_content',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          )); ?>
          </div><div class="input_error"><?php echo $form->error($model,'reply_content'); ?></div><div class="clear_both"></div></div>
          	
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'回复'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


