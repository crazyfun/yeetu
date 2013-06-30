<?php
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
<div class="clone_main">
 <?php if(empty($trave_id)){ ?>
      未选择旅游线路
<?php }else{ ?>
	<?php echo CHtml::beginForm($this->createUrl(""),"POST",array("id"=>'travelorder'));?>
	<?php echo CHtml::hiddenField("trave_id",$trave_id);?>
	 <div class="clone_select">
	 		<div class="clone_trave_category">
	 	  		 线路类型:<?php echo CHtml::dropDownList("clone_trave_category",$clone_trave_category,CV::$TIP_TRAVE_CATEGORY,array('id'=>"clone_trave_category"));?>
	 	  </div>
      <div class="package_content" id="free_package_content">
      	  自由行套餐:<?php echo CHtml::dropDownList("clone_trave_package",$clone_trave_package,CV::$PACKAGE,array('id'=>"clone_trave_package"));?>
      </div>
      
      <div class="package_content" id="free_category_content">
      	  自由行类型:<?php echo CHtml::dropDownList("clone_free_category",$clone_free_category,array('1'=>'国内','2'=>'国际'),array('id'=>"clone_free_category"));?>
      </div>
      
      
   </div>
	 <div class="clone_operate"><span class="ok_button"><input type="submit" name="clone_ok" value="确定" id="ok_button"></span></div>
	 <?php echo CHtml::endForm();?>
 <?php } ?>
</div>

 <script language="javascript">
	jQuery(function($) {
		 var trave_category=jQuery("#clone_trave_category").val();
		 if(trave_category=='5'){
   	   	 jQuery("#free_package_content").show();
   	   	 jQuery("#free_category_content").show();
   	 }else{
   	   	 jQuery("#free_package_content").hide();
   	   	 jQuery("#free_category_content").hide();
   	   	  	     
   	 }
		 jQuery("#clone_trave_category").change(function(){
   	   	  	  var trave_category=jQuery(this).val();
   	   	  	  if(trave_category=='5'){
   	   	  	  	jQuery("#free_package_content").show();
   	   	  	  	jQuery("#free_category_content").show();
   	   	  	  }else{
   	   	  	  	 jQuery("#free_package_content").hide();
   	   	  	  	 jQuery("#free_category_content").hide();
   	   	  	     
   	   	  	  }
   	 });
  })
   	 
   	 
</script>