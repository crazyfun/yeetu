<div id="page_content">
    <div class="show_right_content">
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("domestic/travearea",array("trave_id"=>$model->trave_id));?>">返回到国内游景区</a></span><span><a href='<?php echo $this->createUrl("domestic/traveimage",array('trave_id'=>$model->trave_id,"trave_area_id"=>$model->trave_area_id));?>'>返回到国内游景区图片</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttraveimage-form',
          'action'=>$this->createUrl("domestic/inserttraveimage",array()),
	        'enableAjaxValidation'=>false,
	        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        )); ?>
    		<?php echo $form->hiddenField($model,"id");?>
    		<?php echo $form->hiddenField($model,"trave_id");?>
    		<?php echo $form->hiddenField($model,"trave_area_id");?>
    		<?php echo CHtml::hiddenField("image_ids",$str_image_id,array('id'=>'image_ids'));?>
    		  <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "国内游景区图片修改"; else echo "国内游景区图片添加"; ?></div>
    		   <div class="input_line"><div class="input_name">选择图片</div><div class="input_long_content"  style="width:100%">
    		   	  <iframe frameborder="0" src="/backend.php/images/traveimage" style="width:100%;height:480px;"></iframe>
    		   	  </iframe>
    		   	</div><div class="input_error"><?php echo $form->error($model,"image_id");?></div><div class="clear_both"></div></div>
    		 
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::button("submit",array("value"=>'提交','onclick'=>"javascript:submit_trave_images();"));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增图片",array("images/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    	<div id="float_big_image">
               <img id="show_big_image"/>
       </div>
    </div>
    
    <script language="javascript">
    	   var select_images=new Array();
    	   jQuery(document).ready(function(){
    	   	  var str_image_id="<?= $str_image_id ?>";
    	   	  if(str_image_id){
    	   	    var image_ids=str_image_id.split(",");
    	   	    for(var ii=0;ii<image_ids.length;ii++){
    	   	  	  select_images.push(image_ids[ii]);
    	   	    }
    	   	  }
    	   	  
    	   });
    	   function submit_trave_images(){
    	   	var select_images_str=select_images.join(",");
    	   	jQuery("#image_ids").val(select_images_str);
    	   	document.getElementById("inserttraveimage-form").submit();
    	  }
    </script>
