<?php
      Yii::app()->clientScript->registerScriptFile('/js/basic.js');
			Yii::app()->clientScript->registerScriptFile('/js/select_address.js');
?>
<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("hotels/index",array());?>'>返回到酒店管理</a></span></div></div>
    	
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserthotel-form',
          'action'=>$this->createUrl("hotels/addhotel",array()),
	        'enableAjaxValidation'=>false,
	        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        )); ?>
        
    		<?php echo $form->hiddenField($model,"id");?>
    		<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
          	<div class="jwy_add"><?php if($model->id) echo "酒店修改"; else echo "酒店添加"; ?></div>
    		<div class="input_line"><div class="input_name">酒店名称</div><div class="input_long_content"><?php echo $form->textField($model,"hotel_name");?></div><div class="input_error"><?php echo $form->error($model,'hotel_name'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">酒店链接</div><div class="input_long_content"><?php echo $form->textField($model,"hotel_url");?></div><div class="input_error"><?php echo $form->error($model,'hotel_url'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">酒店所在城市</div><div class="input_long_content"><input  type="hidden" id="hotel_city_id" name="hotel_city_id" value="<?php echo $model->hotel_city;?>"><input readonly id="hotel_city" onclick="javascript:select_hotel_city([{'id':'<?php echo $model->hotel_city;?>','name':'<?php echo $hotel_city_name; ?>'}]);" type="text" name="hotel_city" value="<?php echo $hotel_city_name; ?>"/></div><div class="input_error"><?php echo $form->error($model,'hotel_city'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">酒店信息</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'hotel_information',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); ?>

</div><div class="input_error"><?php echo $form->error($model,'hotel_information'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">酒店设施</div><div class="input_long_content">
        <?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'hotel_facilities',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); ?>	
        	
        	</div><div class="input_error"><?php echo $form->error($model,'hotel_facilities'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">预订须知</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'hotel_booknotice',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); 
        ?></div><div class="input_error"><?php echo $form->error($model,'hotel_booknotice'); ?></div><div class="clear_both"></div></div>
        	
        	 <div class="input_line"><div class="input_name">酒店地理位置</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model,                # Data-Model
   					"attribute"=>'hotel_address_desc',         # Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu',          # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",                      # Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",                      # Realtive Path to the Editor (from Web-Root)
          ) ); 
        ?></div><div class="input_error"><?php echo $form->error($model,'hotel_address_desc'); ?></div><div class="clear_both"></div></div>
        	
        <div class="input_line"><div class="input_name">酒店类型</div>
        	<div class="input_content"><?php  if($model->hotel_type=='1')  $checked=true; else $checked=false; echo CHtml::radioButton("hotel_type",$checked,array('value'=>'1'));?>&nbsp;国内&nbsp;&nbsp;<?php if($model->hotel_type=='2')  $checked=true; else $checked=false; echo CHtml::radioButton("hotel_type",$checked,array('value'=>'2'));?>&nbsp;国际</div>
        		<div class="input_error"><?php echo $form->error($model,'hotel_type'); ?></div><div class="clear_both"></div></div>
        	
        <div class="input_line"><div class="input_name">酒店星级</div><div class="input_long_content"><?php echo $form->dropDownList($model,"hotel_level",CV::$HOTEL_LEVEL,array()) ?></div><div class="input_error"><?php echo $form->error($model,'hotel_level'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">酒店详细地址</div><div class="input_long_content"><?php echo $form->textField($model,"hotel_address");?></div><div class="input_error"><?php echo $form->error($model,'hotel_address'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">酒店图片</div><div class="input_long_content"><?php echo $form->FileField($model,'hotel_img');?></div><div class="input_error"><?php echo $form->error($model,'hotel_img'); ?></div><div class="clear_both"></div></div>
        
        <?php if($model->id){?><div class="input_line"><div class="input_name">&nbsp;&nbsp;</div><div class="input_content"><?php echo CHtml::checkBox("select_image",1,array('checked'=>"checked")).$model->get_hotel_image();?></div></div><?php } ?>
        
    		<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"提交"));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("name"=>"reset","id"=>"reset","value"=>"重置"));?></div><div class="add_more"><?php echo CHtml::link("新增",array("hotels/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>
    
    <div id="float_big_image">
          <img id="show_big_image"/>
      </div>
    
    <script language="javascript">


     jQuery(function($) {
     
	  
	   if(jQuery(".hover_image")){ 
	  	
	   jQuery(".hover_image").hover(
       function () {
         var big_image=jQuery(this).attr("big_image");
         jQuery("#show_big_image").attr("src",big_image);
         var offset=jQuery(this).offset();
         jQuery("#float_big_image").css("top",offset.top).css("left",offset.left+40);
         jQuery("#float_big_image").fadeTo("5000", 0.9);
       },
       function () {
         jQuery("#show_big_image").attr("src","");
         jQuery("#float_big_image").hide();
       }
      ); 
    }
   }); 
    	  var selectaddress=""; 
    	 	function select_hotel_city(default_selected){
    	 		
         if(!selectaddress)
            selectaddress=new select_address();
         selectaddress.show_content({class_name:"selectaddress","default_selected":default_selected,input_id:"hotel_city",url:"/backend.php/main/district",datas:"address_category=2",suburl:"/backend.php/main/subdistrict",subdatas:"",multiple:false,multiple_max:"",onchange_function:""});
        }
    </script>

