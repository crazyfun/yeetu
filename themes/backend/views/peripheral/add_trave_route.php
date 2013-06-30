
<div id="page_content">
    <div class="show_right_content">
    	
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("peripheral/index");?>">返回到周边游</a></span><span><a href='<?php echo $this->createUrl("peripheral/traveroute",array('trave_id'=>$model->trave_id));?>'>返回到周边游行程</a></span></div></div>

    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttraveroute-form',
          'action'=>$this->createUrl("peripheral/inserttraveroute",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
    		<?php echo $form->hiddenField($model,"id");?>
    		<?php echo $form->hiddenField($model,"trave_id");?>
    		   <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
               <div class="jwy_add"><?php if($model->id) echo "周边游行程修改"; else echo "周边游行程添加"; ?></div>
    		   <div class="input_line"><div class="route_day">第<?php echo $form->textField($model,"route_day",array("onkeyup"=>"javascript:isNumber(this);"));?>天</div><div class="input_error"><?php echo $form->error($model,'route_day'); ?></div><div class="clear_both"></div></div>   
           <div class="input_line"><div class="input_name">主要景点</div><div class="input_long_content"><?php echo CHtml::textField("add_trave_route","",array("id"=>"add_trave_route"));?></div><div class="input_error"></div><div><a href="javascript:add_trave_area('<?= $model->trave_id ?>','<?= $model->trave_route ?>');">增加景点</a></div><div class="clear_both"></div></div> 
           <div class="input_line"><div class="input_name">&nbsp;</div><div class="input_long_content"><div id="trave_route_select"><?php $travearea=new Travearea;$trave_area_op=$travearea->get_trave_area_op($model->trave_id);$trave_area_select=explode(',',$model->trave_route); echo UserHmtl::get_select_multiple_value("trave_route",$trave_area_op,$trave_area_select,"","","5");?></div></div><div class="input_error"><?php echo $form->error($model,"trave_route");?></div><div class="clear_both"></div></div>   
           <!--<div class="input_line"><div class="input_name">参考航班</div><div class="input_long_content"><?php echo $form->textField($model,"route_flight");?></div><div class="input_error"><?php echo $form->error($model,"route_flight");?></div><div class="clear_both"></div></div>   -->
           <div class="input_line"><div class="input_name">详情</div><div class="input_long_content">
           	
           	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                
   					"attribute"=>'route_describe',        
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',        
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",       
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                     
				  )); 
			?>
        
        </div><div class="input_error"><?php echo $form->error($model,"route_describe");?></div><div class="clear_both"></div></div>   
           <div class="input_line"><div class="input_name">住宿</div><div class="input_long_content"><?php echo $form->textField($model,"route_stay");?></div><div class="input_error"><?php echo $form->error($model,"route_stay");?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">餐饮</div><div class="input_long_content"><?php echo $form->textField($model,"route_dining");?></div><div class="input_error"><?php echo $form->error($model,"route_dining");?></div><div class="clear_both"></div></div>
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("peripheral/addtraveroute",'trave_id'=>$model->trave_id));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


