<!--head end-->
  <div class="left_box reg">
  	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'forgotpassword-form',
          'action'=>$this->createUrl("site/sendphone",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
        
        <?php echo CHtml::hiddenField("step","2");?>
        <?php echo $form->hiddenField($model,"user_phone",array());?>
    <table width="420" border="0" align="right">
      <tbody>
        <tr>
          <td colspan="2" class="reg_title" style="padding-bottom:10px">通过手机找回密码</td>
        </tr>
        <tr>
          <td colspan="2" style="padding-bottom:10px"><div id="user_phone_tip"></div></td>
        </tr>
        <tr>
          <td width="80"><strong>手　　机：</strong></td>
          <td width="310"><?php echo $model->user_phone;?>
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
  <div class="right_box reg">
  	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'forgotpassword-form',
          'action'=>$this->createUrl("site/sendemail",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
        
     
    <table width="420" border="0" align="right">
      <tbody>
        <tr>
          <td colspan="2" class="reg_title" style="padding-bottom:10px">通过邮箱找回密码</td>
        </tr>
        <tr>
          <td width="80"><strong>邮　　箱：</strong></td>
          <td width="330"><?php echo $form->textField($model,"email",array('class'=>'gm_login_input'));?><span class="input_error"><?php echo $form->error($model,'email'); ?></span>
              <br />
          </td>
        </tr>
        <tr>
          <td></td>
          <td><input name="image2" type="image" class="f_l" src="/css/images/login_x_bt.gif" />
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
  <div class="line_box1"></div>