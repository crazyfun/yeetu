<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("motorcade/index");?>">返回到车队管理</a></span><span><a href='<?php echo $this->createUrl("motorcade/car",array("motorcade_id"=>$motorcade_id));?>'>返回到车队车辆管理</a></span></div></div>
    
    	<div class="edit_content">
    		
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttravearea-form',
			'action'=>$this->createUrl("motorcade/insertcar",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
           <?php echo $form->hiddenField($model,"id");?>
		   <?php echo CHtml::hiddenField("motorcade_id",$motorcade_id);?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>

          <div class="jwy_add"><?php if($model->id) echo "车辆信息修改"; else echo "车辆信息添加"; ?></div>
		<?php if($motorcade_id){?>
		  <div class="input_line"><div class="input_name">车队名称</div><div class="input_content">
		  <?php
			echo $form->hiddenField($model,'motorcade_id',array('value'=>$motorcade_id));
			echo $model->get_motorcade_name($motorcade_id);
		  ?>
		  </div><div class="clear_both"></div></div>
		<?php }?>
           <div class="input_line"><div class="input_name">车辆车牌号</div><div class="input_content"><?php echo $form->textField($model,"car_num");?></div><div class="input_error"><?php echo $form->error($model,'car_num'); ?></div><div class="clear_both"></div></div>

		   <div class="input_line"><div class="input_name">车辆型号</div><div class="input_content"><?php echo $form->textField($model,"car_type");?></div><div class="input_error"><?php echo $form->error($model,'car_type'); ?></div><div class="clear_both"></div></div>

           <div class="input_line"><div class="input_name">车辆司机</div><div class="input_content"><?php echo $form->textField($model,"car_driver");?></div><div class="input_error"><?php echo $form->error($model,'car_driver'); ?></div><div class="clear_both"></div></div>


           <div class="input_line"><div class="input_name">司机电话</div><div class="input_content"><?php echo $form->textField($model,"driver_phone");?></div><div class="input_error"><?php echo $form->error($model,'driver_phone'); ?></div><div class="clear_both"></div></div>


           <div class="input_line"><div class="input_name">线路名称</div><div class="input_content"><?php echo $form->textField($model,"trave");?></div><div class="input_error"><?php echo $form->error($model,'trave'); ?></div><div class="clear_both"></div></div>


           <div class="input_line"><div class="input_name">价格</div><div class="input_content"><?php echo $form->textField($model,"price");?></div><div class="input_error"><?php echo $form->error($model,'price'); ?></div><div class="clear_both"></div></div>

		   <div class="input_line"><div class="input_name">车辆使用日期</div><div class="input_content"><?php echo $form->textField($model,"use_date");?></div><div class="input_error"><?php echo $form->error($model,'use_date'); ?></div><div class="clear_both"></div></div>

           <div class="input_line"><div class="input_name">车辆描述</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'car_desc',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); ?>
         </div><div class="input_error"><?php echo $form->error($model,'car_desc'); ?></div><div class="clear_both"></div></div>
         	 	 
        <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("motorcade/addcar",'motorcade_id'=>$model->motorcade_id));?></div><div class="clear_both"></div></div></div>
 
    	
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


