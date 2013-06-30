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
      <div class="matter_right">
        <?php
      	if($this->beginCache("TraveFreeRegion", array('duration'=>"1"))){
              $this->widget('TraveRegion', array(  
               'trave_category'=>$this->trave_category,           
              )); 
              $this->endCache(); 
        }

        ?>
        <div class="ad"><?php echo Util::get_ad('18') ;?></div>
       <?php
      	if($this->beginCache("TravePeripheralRegion", array('duration'=>"1"))){
              $this->widget('TraveRegion', array(  
               'trave_category'=>'2',           
              )); 
             $this->endCache(); 
        }     
       ?>
        
       <?php
      	if($this->beginCache("TraveDomesticRegion", array('duration'=>"1"))){
              $this->widget('TraveRegion', array(  
               'trave_category'=>'3',           
              )); 
             $this->endCache(); 
        }     
       ?>
       
       
       
       <?php
      	if($this->beginCache("TraveNationRegion", array('duration'=>"1"))){
              $this->widget('TraveRegion', array(  
               'trave_category'=>'1',           
              )); 
             $this->endCache(); 
        }     
       ?>
       
       
       
       
       
       
       
        <!--tra_aim end-->
        <div class="clear_float"></div>
      </div>
    </div>

  </div>
</div>
   <?php $this->renderPartial("../main/footer",array(),false);?>
</div><!-- page_body -->


</body>
</html>
