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
		Yii::app()->clientScript->registerCssFile('/css/admin_menu.css');
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
<div id="page_body">
   <div id="page_header"><div class="header_con"></div></div><!--page_header-->
   <div id="page_content">
      <div class="Ad_content">
			<a name="up"></a>
          <!--内容header部分-->
          <div class="Ad_header">
			<?php $this->widget("TopMenu");?>
          </div>

		 <div class="menu_breadcrumbs"> <?php $this->widget('zii.widgets.CBreadcrumbs', array(
								'links'=>$this->breadcrumbs,
		)); ?>
		</div>

          <table width="100%" background="#C5EBFE">
          	<tr>
                <td>
                  <div class="Ad_right">
				
					<?php echo $content;?>
					<a name="down"/>
					<a href="#up" style="float:right;"/>up</a>
                  </div>
                  </td>
              </tr>
          </table>
      </div> 
   </div>
</div><!-- page_body -->
</body>
</html>


