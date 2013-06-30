<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php  
	   Yii::app()->clientScript->registerCssFile('/css/admin.css');
	?>
</head>
<body>
	 <div class="mainhd">
<div class="uinfo">
<p>您好, <em><?php echo Yii::app()->user->getName(); ?></em> [ <a target="_top" href="/backend.php/site/logout">退出</a> ]</p>
</div>

<div class="nav">


</div>
</div>
</body>
</html>