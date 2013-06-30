<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>
<div id="user_login">
<dl>
  <dd id="user_top">
  <ul>
    <li class="user_top_l"></li>
    <li class="user_top_c"></li>
    <li class="user_top_r"></li>
  </ul>
 </dd>
  <dd id="user_main">
  	
  <ul>
    <li class="user_main_l"></li>
    <li class="user_main_c">
    	
    	<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
    )); ?>
    <div class="error_summary"><?php echo $form->errorSummary($model); ?></div>
    <div class="user_main_box">
    	
    <ul>
      <li class="user_main_text">分站： </li>
      <li class="user_main_input">
         <?php 
          $sregion_datas=Cfenzhan::model()->get_fenzhan_login();
		      echo $form->dropDownList($model,"permissions_type",$sregion_datas,array());
		    ?>
		  </li>
    </ul>
    
    <ul>
      <li class="user_main_text">用户名/邮件： </li>
      <li class="user_main_input"><?php echo $form->textField($model,"user_login",array("class"=>"TxtUserNameCssClass"));?> </li>
    </ul>
    <ul>
      <li class="user_main_text">密 码： </li>
      <li class="user_main_input"><?php echo $form->passwordField($model,"password",array("class"=>"TxtPasswordCssClass"));?></li>
    </ul>
 
    <ul>
    	<li class="user_main_text">验证码：</li>
    	<li class="user_main_input"><?php echo $form->textField($model,"verification_code",array('class'=>'gm_login_input')); ?></li>
    	
    </ul>
    <ul>
    	 <div class="user_verification"><a onclick="document.getElementById('__code__').src = '<?php echo Yii::app()->request->baseUrl;?>/backend.php/site/imagecode?id=' + ++ts; return false"><img id="__code__" src="<?php echo $this->createUrl("site/imagecode",array('id'=>$ts));?>" /></a></div>
    </ul>
    <ul>
      <li class="user_main_text"></li>
      <li class="user_main_input"><?php echo $form->checkBox($model,'rememberme');?>&nbsp;&nbsp;两周内不再登录</li>
    </ul>
      
    </div>
    <div class="user_main_box_r">
     <ul> 
        <li class="umainbg" style="float:left;" ><INPUT value="" class=IbtnEnterCssClass id=IbtnEnter style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"  type="submit" name=IbtnEnter> </li>
     </ul>
    </div>
    <?php $this->endWidget(); ?>
    </li>
   </ul>
    </dd>
    <dd id=user_bottom>
      <ul>
       <li class=user_bottom_l></li>
       <li class=user_bottom_c><SPAN style="MARGIN-TOP: 40px;"><span style="margin-right:20px;">易途旅行社</span><a href="<?php echo Yii::app()->homeUrl;?>">易途旅游网</a></span></li>
       <li class=user_bottom_r></li>
      </ul>
    </dd>
  </dl>
   
</div>

<script language="javascript">
	ts = "<?= $ts ?>";
</script>