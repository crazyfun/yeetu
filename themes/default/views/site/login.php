 <div class="login_l">
    <div class="reg">
    	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'userlogin-form',
          'action'=>$this->createUrl("site/login",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
        
        <?php echo CHtml::hiddenField("login_type",$login_type,array()); ?>
      <table border="0" width="550">
        <tbody>
          <tr>
            <td colspan="2" class="reg_title" style="padding-bottom:10px">易途旅游网会员登录</td>
          </tr>
          <tr><td colspan="2"><?php $this->widget("FlashInfo");?></td></tr>
          <tr>
            <td width="82"><strong>登录帐号：</strong></td>
            <td width="508"><?php echo $form->textField($model,"user_login",array('class'=>'gm_login_input'));?><span class="input_error"><?php echo $form->error($model,'user_login'); ?></span><br />
             </td>
          </tr>
          <tr>
            <td><strong>密　　码：</strong></td>
            <td><?php echo $form->passwordField($model,"password",array('class'=>'gm_login_input'));?><span class="input_error"><?php echo $form->error($model,'password'); ?></span><br />
            </td>
          </tr>
          <tr>
            <td><strong>验 证 码：</strong></td>
            <td><?php echo $form->textField($model,"verification_code",array('class'=>'gm_login_input')); ?>&nbsp;<a onclick="document.getElementById('__code__').src = '<?php echo Yii::app()->request->baseUrl;?>/index.php/site/imagecode?id=' + ++ts; return false"><img id="__code__" src="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/imagecode?id=<?= $ts ?>" /></a><span class="input_error"><?php echo $form->error($model,'verification_code'); ?></span></td>
          </tr>
          
          <tr>
            <td></td>
            <td><?php echo $form->checkBox($model,'rememberme');?>&nbsp;&nbsp;两周内不再登录<br />
             </td>
          </tr>
                    
          <tr>
            <td></td>
            <td> <?php echo CHtml::imageButton("/css/images/login_bt.gif",array("class"=>"f_l"));?>&nbsp;&nbsp;<a href="<?php echo $this->createUrl("site/forgotpassword") ?>" class="font1" rel="nofollow">找回密码</a> </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
            	<div class="gm_login_bottom">
               <p>还不是易途旅游网会员？<a href="<?php echo $this->createUrl("register/index"); ?>" rel="nofollow">请立即免费注册</a></p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <?php $this->endWidget(); ?>
    </div>
  </div>
     
  <div class="login_r">
    <div class="login_r_t"></div>
    <div class="login_r_tilte">
      <h2>易途旅游网会员可以享有</h2>
    </div>
    <div class="login_r_m">
    	<ul>
      	<div><img src="/css/images/login_io.gif "/><li>累积消费记录并获得抵押券，提高会员等级，享受更多特权</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>每周获得会员邮件周刊，最新、最热旅游线路尽在掌握</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>每逢重大节日或促销活动，您将会获得专题活动邮件，特价信息、优惠线路绝不错过</li></div>
      </ul>
    </div>
    <div class="login_r_tilte">
      <h2>我们的承诺</h2>
    </div>
    <div class="login_r_m">
    	<ul>
      	<div><img src="/css/images/login_io.gif "/><li>即时电话回访追踪您的旅游感受，改进我们的服务质量</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>随时为您解答各种的疑惑，聆听您的意见</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>严密保管您的个人资料，绝不泄露您的信息</li></div>
      </ul>
    </div>
    <div class="login_r_b"></div>
  </div>
  <div class="line_box1"></div>
  
<script language="javascript">
	ts = "<?= $ts ?>";
</script>
