<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("images/index",array());?>">返回到图片管理</a></span><span><a href="<?php echo $this->createUrl("images/add",array());?>">增加图片</a></span></div></div>
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchimages-form',
          'action'=>$this->createUrl("",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">图片名称:</span><span class="search_item_input"><?php echo CHtml::textField("image_title",$image_title,array('id'=>'search_image_title'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">图片分类:</span><span class="search_item_input"><?php $image_category_class=new ImageCategory(); echo CHtml::DropDownList("image_category",$image_category,$image_category_class->get_category_select(),array());?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       	       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">

       	   	 <?php 
       	   	  $this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$active_dataprovider,
												'itemView'=>'show_images',
												'ajaxUpdate'=>false,
										));
						?>


       	   	</div>
       	   	
       	   	<div id="float_big_image">
               <img id="show_big_image"/>
            </div>
       </div> 
      </div>
    </div>






