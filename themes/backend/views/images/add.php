<div id="page_content">
    <div class="show_right_content">
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("images/index",array());?>">返回到图片管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertimages-form',
          'action'=>$this->createUrl("add",array()),
	        'enableAjaxValidation'=>false,
	        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        )); ?>
    		<?php echo $form->hiddenField($model,"id");?>
    		  <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "图片修改"; else echo "图片添加"; ?></div>
    		   <div class="input_line"><div class="input_name">图片名称</div><div class="input_long_content"><?php echo $form->textField($model,"image_title");?></div><div class="input_error"><?php echo $form->error($model,"image_title");?></div><div class="clear_both"></div></div>
    		   <div class="input_line"><div class="input_name">图片分类</div><div class="input_long_content"><?php $image_category_class=new ImageCategory(); echo $form->DropDownList($model,"image_category",$image_category_class->get_category_select(),array());?></div><div class="input_error"><?php echo $form->error($model,"image_category");?></div><div class="clear_both"></div></div>
    		   <div class="input_line"><div class="input_name">上传图片</div><div class="input_long_content"><?php echo $form->FileField($model,'image_src');?></div><div class="input_error"><?php echo $form->error($model,"image_src");?></div><div class="clear_both"></div></div>
    		   <?php if($model->id){ ?><div class="input_line"><div class="input_name">&nbsp;&nbsp;</div><div class="input_content"><?php  echo CHtml::checkBox("select_image",1,array('checked'=>"checked")).$model->get_image();?></div></div><?php } ?>
           <div class="input_line"><div class="input_name">图片描述</div><div class="input_long_content">
           	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'image_desc',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); 
        ?>
        </div><div class="input_error"><?php echo $form->error($model,"image_desc");?></div><div class="clear_both"></div></div>   
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("images/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    	<div id="float_big_image">
               <img id="show_big_image"/>
       </div>
    </div>
