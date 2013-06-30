<div class="left_box_phone reg">
  	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'register-form',
          'action'=>$this->createUrl("register/registe",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
        <?php echo CHtml::hiddenField('step','2',array());?>
       <?php echo $form->hiddenField($model,"user_phone");  ?>
       <?php echo $form->hiddenField($model,"user_login");  ?>
       <?php echo $form->hiddenField($model,"password");  ?>
       <?php echo $form->hiddenField($model,"con_password");  ?>
       <?php echo $form->hiddenField($model,"email");  ?>
       <?php echo $form->hiddenField($model,"real_name");  ?>
       <?php echo $form->hiddenField($model,"user_sex");  ?>
       <?php echo $form->hiddenField($model,"user_address");  ?>
       <?php echo $form->hiddenField($model,"user_zip");  ?>
       <?php echo $form->hiddenField($model,"agreement");  ?>
    
    <table width="100%" border="0" align="center">
      <tbody>
        <tr>
          <td colspan="2" class="reg_title" style="padding-bottom:10px">我们已经给您手机发送了验证码，五分钟内自动过期请查收并按提示完成注册步骤。</td>
        </tr>
        <tr>
          <td colspan="2" style="padding-bottom:10px"><div id="user_phone_tip"></div></td>
        </tr>
        <tr>
          <td width="50"><strong>手　　机：</strong></td>
          <td width="310">
              <?php echo $model->user_phone;?>
          </td>
        </tr>

        <tr>
          <td><strong>验 证 码：</strong></td>
          <td><?php echo $form->textField($model,"user_phone_verification",array('class'=>'gm_login_input'));?><span class="input_error"><?php echo $form->error($model,'user_phone_verification'); ?></span>  
          </td>
        </tr>
        
        <tr>
          <td></td>
          <td><input name="image" type="image" class="f_l" src="/css/images/login_x_bt.gif" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <?php $this->endWidget(); ?>
  </div> 
  
  
  <div class="login_r">
    <div class="login_r_t"></div>
    <div class="login_r_tilte">
      <h2>易途会员可以享有</h2>
    </div>
    <div class="login_r_m">
    	<ul>
      	<div><img src="/css/images/login_io.gif "/><li>累积消费记录并获得现金抵用劵，提高会员等级，享受更多特权</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>每周获得会员邮件周刊，最新、最热旅游线路尽在掌握</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>每逢重大节日或促销活动，您将会获得专题活动邮件，特价信息、优惠线路绝不错过</li></div>
      </ul>
    </div>
    <div class="login_r_tilte">
      <h2>我们的承诺</h2>
    </div>
    <div class="login_r_m">
    	<ul>
      	<div> <img src="/css/images/login_io.gif "/><li>即时电话回访追踪您的旅游感受，改进我们的服务质量</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>随时为您解答各种的疑惑，聆听您的意见</li></div>
      	<div><img src="/css/images/login_io.gif "/><li>严密保管您的个人资料，绝不泄露您的信息</li></div>
      </ul>
    </div>
    <div class="login_r_b"></div>
  </div>
  <div class="line_box1"></div>
