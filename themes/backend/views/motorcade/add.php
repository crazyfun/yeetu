<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("motorcade/index");?>">返回到车队管理</a></span></div></div>
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
           <div class="jwy_add"><?php if($model->id) echo "车队修改"; else echo "车队添加"; ?></div>
           <div class="input_line"><div class="input_name">车队名称</div><div class="input_content"><?php echo $form->textField($model,"motorcade_name",array());?>
		   </div><div class="input_error"><?php echo $form->error($model,'motorcade_name'); ?></div>
		   <div class="clear_both"></div>
		   </div>

           <div class="input_line"><div class="input_name">车队负责人</div><div class="input_content"><?php echo $form->textField($model,"motorcade_link",array());?></div><div class="input_error"><?php echo $form->error($model,'motorcade_link'); ?></div>
		   <div class="clear_both"></div>
		   </div>

		   <div class="input_line"><div class="input_name">车队联系电话</div><div class="input_content"><?php echo $form->textField($model,"motorcade_phone",array());?></div><div class="input_error"><?php echo $form->error($model,'motorcade_phone'); ?></div>
		   <div class="clear_both"></div>
		   </div>

		   <div class="input_line"><div class="input_name">传真</div><div class="input_content"><?php echo $form->textField($model,"motorcade_fax",array());?>
		   </div><div class="input_error"><?php echo $form->error($model,'motorcade_fax'); ?></div>
		   <div class="clear_both"></div>
		   </div>
		   <div class="input_line"><div class="input_name">QQ/MSN</div><div class="input_content"><?php echo $form->textField($model,"motorcade_qq",array());?>
		   </div><div class="input_error"><?php echo $form->error($model,'motorcade_qq'); ?></div>
		   <div class="clear_both"></div>
		   </div>
			

           <div class="input_line"><div class="input_name">备注</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'motorcade_desc',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); ?>

         </div><div class="input_error"><?php echo $form->error($model,'motorcade_desc'); ?></div><div class="clear_both"></div></div>

    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("motorcade/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


