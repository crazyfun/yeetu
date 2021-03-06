<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php 
		$this->publish_assert("global","css");
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerScriptFile('/js/basic.js');
		Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
    ?>
	<meta name="description" content="<?php echo CHtml::encode($this->description);?>">
	<meta name="keywords" content="<?php echo CHtml::encode($this->keywords);?>">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="page_body">
	
  
	<?php $this->renderPartial("../main/header",array(),false);?>
	

  <div id="page_content" class="content">
     <div class="main">
   
     	
     	<?php echo $content; ?>
     	
      <div class="main_r">
      	
      
      <?php
      if(!Yii::app()->user->isGuest){	
      	if($this->beginCache("RecentHistory", array('duration'=>"1"))){
              $this->widget('RecentHistory', array(             
              )); 
             $this->endCache(); 
        } 
       }     
       ?>
       
       
       <?php
          	if($this->beginCache("SearchRecommend", array('duration'=>"1"))){
              $this->widget('SearchRecommend', array(             
              )); 
             $this->endCache(); 
           } 
       ?>
       
      
      
       <?php
          	if($this->beginCache("SearchHot", array('duration'=>"1"))){
              $this->widget('SearchHot', array(             
              )); 
             $this->endCache(); 
           } 
       ?>
   
      </div>
    </div>

</div>
  
  
 <?php $this->renderPartial("../main/footer",array(),false);?>
  
  
</div><!-- page_body -->

</body>
</html>
