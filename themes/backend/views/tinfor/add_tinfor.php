<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("tinfor/index");?>">返回到旅游资讯</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttinfor-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php echo $form->hiddenField($model,"id");?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          <div class="jwy_add"><?php if($model->id) echo "旅游资讯修改"; else echo "旅游资讯添加"; ?></div>
           <div class="input_line"><div class="input_name">旅游资讯主题</div><div class="input_long_content"><?php $infor_theme=new InforTheme();$select_value=$infor_theme->get_infor_theme_select(); echo $form->dropDownList($model,"information_theme",$select_value);?></div><div class="input_error"><?php echo $form->error($model,'information_theme'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">旅游资讯名称</div><div class="input_long_content"><?php echo $form->textField($model,"information_title");?></div><div class="input_error"><?php echo $form->error($model,'information_title'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">旅游资讯推荐</div><div class="input_content"><?php echo $form->checkBox($model,"information_recommend",array('value'=>'1'));?>推荐</div><div class="input_error"><?php echo $form->error($model,'information_recommend'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">旅游资讯排序</div><div class="input_content"><?php echo $form->textField($model,"information_sort");?></div><div class="input_error">&nbsp;&nbsp;数字越小越在前<?php echo $form->error($model,'information_sort'); ?></div><div class="clear_both"></div></div>
           
            <div class="input_line"><div class="input_name">旅游资讯简短描述</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'information_desc',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          )); ?>
          </div><div class="input_error"><?php echo $form->error($model,'information_desc'); ?></div><div class="clear_both"></div></div>
          	
          	
           <div class="input_line"><div class="input_name">旅游资讯内容</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'information_content',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          )); ?>
          </div><div class="input_error"><?php echo $form->error($model,'information_content'); ?></div><div class="clear_both"></div></div>
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("tinfor/addtinfor"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


