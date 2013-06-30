<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("category/add",array());?>'>增加线路分类</a></span></div></div>
    	  <?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'categorydelete-form',
          'action'=>$this->createUrl("category/delete",array()),
         
	        'enableAjaxValidation'=>false,
        )); ?>

        <input type="hidden" name="id" id="delete_category_id" value=""/>
       <?php $this->endWidget(); ?>
    	<!--淼?-->
       <div class="search_content">
       	
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'categorysearch-form',
          'action'=>$this->createUrl("category/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
        
       	 	 
       	   <div class="search_item"><span class="search_item_name">线路分类名称</span><span class="search_item_input"><input type="text" name="category_name" value="<?php echo $category_name;?>"></span></div>
       	   <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	 <?php $this->endWidget(); ?>
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">

       	   <?php foreach($model as $key => $value){?>
            <div class="ktvplay">
              <div class="countrydiv"><span class="name"><b><?php echo $value->category_name;?></b></span>&nbsp;&nbsp;<span class="dz_pic"><a class="operate_button" href="javascript:show_sub_category('<?php echo $value->id;?>');">查看子地址</a></span>&nbsp;&nbsp;<span class="xg_pic"><a class="operate_button" href="<?php echo $this->createUrl('category/add',array('id'=>$value->id));?>">修改</a></span>&nbsp;&nbsp;<span class="sc_pic"><a class="operate_dbutton" href="javascript:delete_category('<?php echo $value->id;?>');">删除</a></span></div>
              <div id="sub_address_<?php echo $value->id;?>" class="sub_address" is_request="1"></div>
            </div>
     
           <?php } ?>

       	   	</div>
       </div> <!-- -->
    	
    	
    </div>

