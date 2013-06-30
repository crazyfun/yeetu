<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?php echo CHtml::encode($this->description);?>" />
	<meta name="keywords" content="<?php echo CHtml::encode($this->keywords);?>" /> 
	<?php if($this->id == "site" && $this->action->id == "index"){?>
	<meta name="alexaVerifyID" content="2Eg3PxOilCEsS5Ci_kXXnBbCttU" />
	<?php } ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <?php 
    $this->publish_assert("global","css");
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerScriptFile('/js/basic.js');
		Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
  ?>
</head>
<body>
<div id="page_body">
	<?php $this->renderPartial("../main/header",array(),false);?>
	
  <div id="page_content" class="content">
     <div class="main">
     		<div class="help_main_left">
	    		<div class="help_main_left_sid">
						<h2>联系我们</h2>
						<p>电话：021-56880166</p>
					</div>	
    		</div>
    	  <div class="help_main_right">
          <?php echo $content; ?>
    		</div>
      </div>
  </div>

 <?php
 $this->renderPartial("../main/footer",array(),false);
 ?>
</div>
</body>

</html>

