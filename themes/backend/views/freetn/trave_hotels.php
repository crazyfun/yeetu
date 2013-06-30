<?php
      Yii::app()->clientScript->registerScriptFile('/js/basic.js');
			Yii::app()->clientScript->registerScriptFile('/js/select_address.js');
			Yii::app()->clientScript->registerScriptFile('/js/watermarkinput.js');
?>
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("freetn/index",array());?>">返回到国际机+酒店</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchth-form',
          'action'=>$this->createUrl("freetn/searchth",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
         <?php echo CHtml::hiddenField("trave_id",$trave_id,array());?>
       	 <div class="search_item"><span class="search_item_name">酒店名称</span><span class="search_item_input"><?php echo CHtml::textField("hotel_name",$model->hotel_name,array("id"=>"hotel_name"));?></span></div>
       	 
       	 <div class="search_item"><span class="search_item_name">酒店所在城市</span><span class="search_item_input"><input  type="hidden" id="hotel_city_id" name="hotel_city_id" value="<?php echo $model->hotel_city;?>"><input readonly id="hotel_city" onclick="javascript:select_hotel_city();" type="text" name="hotel_city" value="<?php echo $hotel_city_name; ?>"/></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?>
       </div>
       <!--示-->
       <div class="show_search_content">
           
       	   <!--示牡-->
       	   <div class="show_search_text">
     
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$active_data_provider,
				  'ajaxUpdate'=>false,
				  'pager'=>array('class'=>'LinkListPager'),

                  'columns'=>array(
					  array(
						  'class'=>'CCheckBoxColumn',
						  'name'=>'id',
						  'value'=>'$data->id',
						  'selectableRows' => 2,
						  'checkBoxHtmlOptions' => array('name'=>'id[]'),
					  ),
                     array(
                       'name'=>"id",
                       'type'=>"raw",
                       'value'=>'$data->id'
                     ),

                     array(
                       'name'=>"线路名称",
                       'type'=>"raw",
                       'value'=>'$data->get_trave_name('.$trave_id.')'
                     ),
                     
                     array(
                       'name'=>"hotel_name",
                       'type'=>'raw',
                       'value'=>'$data->hotel_name'
                     ),
                     
                     array(
                       'name'=>"hotel_city",
                       'type'=>'raw',
                       'value'=>'$data->get_hotel_city()'
                     ),

                     array(
                       'name'=>"hotel_type",
                       'type'=>'raw',
                       'value'=>'$data->get_hotel_type()'
                     ),
                     
                     array(
                       'name'=>'hotel_level',
                       'type'=>'raw',
                       'value'=>'$data->get_hotel_level()'
                     
                     ),
                     array(
                       'name'=>"hotel_address",
                       'type'=>'raw',
                       'value'=>'$data->hotel_address'
                     ),


       
                     
                     array(
                       'name'=>"hotel_img",
                       'type'=>'raw',
                       'value'=>'$data->get_hotel_image()'
                     ),

                     array(
                       'name'=>"create_id",
                       'type'=>'raw',
                       'value'=>'$data->get_belong_user_name()'
                     ),
 
                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'$data->converse_date()'
                     ),

                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_hotel_operate('.$trave_id.')'
                     
                     ), 

                   ),
                  )); ?>
        				
       	   	</div>
       </div> 
    </div>
    <div id="float_big_image">
          <img id="show_big_image"/>
      </div>
    
  <script language="javascript">
     jQuery(function($) {
     	
     	jQuery("#hotel_name").Watermark("酒店名称");
	   
	     jQuery('#search_submit').click(function() {
	       if( jQuery("#hotel_name").val() == "酒店名称" ) jQuery("#hotel_name").val('');
	     });
	     
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
    	 function select_hotel_city(){
         if(!selectaddress)
            selectaddress=new select_address();
         selectaddress.show_content({class_name:"selectaddress",input_id:"hotel_city",url:"/backend.php?r=main/district",datas:"address_category=2",suburl:"/backend.php?r=main/subdistrict",subdatas:"",multiple:false,multiple_max:"",onchange_function:""});
       }
   
   </script>





