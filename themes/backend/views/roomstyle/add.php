<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("roomstyle/index");?>">返回到酒店房型管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertroomstyle-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
           ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "酒店房型修改"; else echo "酒店房型添加"; ?></div>
           <div class="input_line"><div class="input_name">房型名称</div><div class="input_content"><?php echo $form->textField($model,"room_style");?></div><div class="input_error"><?php echo $form->error($model,'room_style'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">房型描述</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'room_style_desc',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); ?>

         </div><div class="input_error"><?php echo $form->error($model,'room_style_desc'); ?></div><div class="clear_both"></div></div>

    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("roomstyle/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


