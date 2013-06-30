<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("cicerone/index");?>">返回到导游管理</a></span></div></div>
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
           <div class="jwy_add"><?php if($model->id) echo "导游修改"; else echo "导游添加"; ?></div>
           <div class="input_line">
				<div class="input_name">导游姓名</div>
				<div class="input_content"><?php echo $form->textField($model,"cicerone_name",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'cicerone_name'); ?></div>
				<div class="clear_both"></div>
			</div>
           <div class="input_line">
				<div class="input_name">导游性别</div>
				<div class="input_content"><?php echo $form->textField($model,"cicerone_sex",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'cicerone_sex'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">导游身份证号</div>
				<div class="input_content"><?php echo $form->textField($model,"cicerone_id",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'cicerone_id'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">住宅地址</div>
				<div class="input_content"><?php echo $form->textField($model,"cicerone_address",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'cicerone_address'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">电话</div>
				<div class="input_content"><?php echo $form->textField($model,"cicerone_phone",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'cicerone_phone'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">导游证号</div>
				<div class="input_content"><?php echo $form->textField($model,"cicerone_num",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'cicerone_num'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line"><div class="input_name">导游描述</div>
				<div class="input_long_content">
				<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
						"model"=>$model,                # Data-Model
						"attribute"=>'cicerone_desc',         # Attribute in the Data-Model
						"height"=>'400px',
						"width"=>'100%',
						"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
						"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
						"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
										# Additional Parameter (Can't configure a Toolbar dynamicly)
			  ) ); ?></div>
				<div class="input_error"><?php echo $form->error($model,'cicerone_desc'); ?></div>
				<div class="clear_both"></div>
		 </div>
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("cicerone/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


