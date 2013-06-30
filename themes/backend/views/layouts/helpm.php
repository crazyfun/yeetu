<?php
  //$this->check_login("",CV::RETURN_ADMIN_INDEX,array()); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
	<frameset ROWS="50,*" FRAMESPACING='0'>
        <frame FRAMESPACING='0' name="top" frameborder="1" BORDERCOLOR="#EAF4FB" width="100%" height="100%" src="/backend.php/helpmanual/help/help/top" scrolling="NO">
        <frameset cols="160,*" FRAMESPACING='0'>
        	<frame FRAMESPACING='0' name="left"  width="100%" height="100%" frameborder="1" BORDERCOLOR="#EAF4FB" src="/backend.php/helpmanual/help/help/left" scrolling="NO">
        	<frame FRAMESPACING='0' name="right" width="100%" height="100%" frameborder="1" BORDERCOLOR="#EAF4FB"  src="/backend.php/helpmanual/help/help/right" scrolling="Yes">
        </frameset> 
  </frameset>
</html>


