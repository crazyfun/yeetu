<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php 
		$this->publish_assert("global","css");
		Yii::app()->clientScript->registerScriptFile('/js/basic.js');
		Yii::app()->clientScript->registerCoreScript('jquery');
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
      	if($this->beginCache("TravelSearch", array('duration'=>"1"))){
                  $this->widget('TravelSearch', array(             
              )); 
             $this->endCache(); 
        } 
                 
       ?>
        <?php
          if($this->trave_category=='1'){
          	echo "<div class='ad'>".Util::get_ad('28')."</div>";
          }else if($this->trave_category=='2'){
          	echo "<div class='ad'>".Util::get_ad('26')."</div>";
          }else if($this->trave_category=='3'){
          	echo "<div class='ad'>".Util::get_ad('27')."</div>";
          }else if($this->trave_category=='4'){
          	echo "<div class='ad'>".Util::get_ad('30')."</div>";
          }else if($this->trave_category=='5'){
          	echo "<div class='ad'>".Util::get_ad('18')."</div>";
          }
        ?>
  
        
        <?php
     
      	if($this->beginCache("Trave".ucfirst($this->action->id)."Region", array('duration'=>"1"))){
              $this->widget('TraveRegion', array(  
               'trave_category'=>$this->trave_category,           
              )); 
              $this->endCache(); 
         }
           
        
       ?>
       
       <?php
      	if($this->beginCache("TravelPractical", array('duration'=>"1"))){
              $this->widget('TravelPractical', array(  
                 'type_id'=>'24',
              )); 
              $this->endCache(); 
         }
       ?>
       
        <!--tra_aim end-->
     

		
   
        
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
