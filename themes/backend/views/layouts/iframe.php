<?php
  //$this->check_login("",CV::RETURN_ADMIN_INDEX,array()); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script>
      var managemenu = null;
    </script>
    <?php    
	  Yii::app()->clientScript->registerCssFile('/css/admin.css');
		Yii::app()->clientScript->registerCssFile('/js/autocompleted/styles.css');
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerScriptFile('/js/basic.js');
		Yii::app()->clientScript->registerScriptFile('/js/manage_menu.js');
		Yii::app()->clientScript->registerScriptFile('/js/select_address.js');
		Yii::app()->clientScript->registerScriptFile('/js/watermarkinput.js');
		Yii::app()->clientScript->registerScriptFile('/js/trave.js');
		Yii::app()->clientScript->registerScriptFile('/js/admin.js');
		Yii::app()->clientScript->registerScriptFile('/js/admin_menu.js');
		Yii::app()->clientScript->registerScriptFile('/js/My97DatePicker/WdatePicker.js');
		Yii::app()->clientScript->registerScriptFile("/js/autocompleted/jquery.autocomplete-min.js");
    ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>


	   <?php echo $content;?>

</body>
</html>


