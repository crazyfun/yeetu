<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("sights/index");?>">返回到景区管理</a></span></div></div>
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
           <div class="jwy_add"><?php if($model->id) echo "景区修改"; else echo "景区添加"; ?></div>
           <div class="input_line">
				<div class="input_name">景区名称</div>
				<div class="input_content"><?php echo $form->textField($model,"sights_name",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'sights_name'); ?></div>
				<div class="clear_both"></div>
			</div>
           <div class="input_line">
				<div class="input_name">景区地址</div>
				<div class="input_content"><?php echo $form->textField($model,"sights_address",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'sights_address'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">景区电话</div>
				<div class="input_content"><?php echo $form->textField($model,"sights_phone",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'sights_phone'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">联系人</div>
				<div class="input_content"><?php echo $form->textField($model,"linkman",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'linkman'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">挂牌价格</div>
				<div class="input_content"><?php echo $form->textField($model,"mark_price",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'mark_price'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">散客价格</div>
				<div class="input_content"><?php echo $form->textField($model,"resale_price",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'resale_price'); ?></div>
				<div class="clear_both"></div>
			</div>
			<div class="input_line">
				<div class="input_name">团队价格</div>
				<div class="input_content"><?php echo $form->textField($model,"group_price",array());?></div>
				<div class="input_error"><?php echo $form->error($model,'group_price'); ?></div>
				<div class="clear_both"></div>
			</div>
           <div class="input_line"><div class="input_name">景区描述</div>
				<div class="input_long_content">
				<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
						"model"=>$model,                # Data-Model
						"attribute"=>'sights_desc',         # Attribute in the Data-Model
						"height"=>'400px',
						"width"=>'100%',
						"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
						"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
						"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
			  ) ); ?></div>
				<div class="input_error"><?php echo $form->error($model,'sights_desc'); ?></div>
				<div class="clear_both"></div>
		 </div>
		 <div class="input_line"><div class="input_name">备注</div>
				<div class="input_long_content">
				<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
						"model"=>$model,                # Data-Model
						"attribute"=>'sights_comment',         # Attribute in the Data-Model
						"height"=>'400px',
						"width"=>'100%',
						"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
						"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
						"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
			  ) ); ?></div>
				<div class="input_error"><?php echo $form->error($model,'sights_comment'); ?></div>
				<div class="clear_both"></div>
		 </div>

    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("sights/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


