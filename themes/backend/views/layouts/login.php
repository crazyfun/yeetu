<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php 
		Yii::app()->clientScript->registerCssFile('/css/admin.css');
		Yii::app()->clientScript->registerCoreScript('jquery');
    ?>
	<?php echo $loadresource; ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body id="userlogin_body">  
 <div id="page_body">
    <?php echo $content;?>
</div><!-- page_body -->
</body>
</html>
