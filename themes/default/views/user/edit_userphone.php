
         <!--邮件订阅修改邮箱-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">修改手机号码</span></h3>
                    <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
                	<div class="wjgivep">
     
                        <?php $form=$this->beginWidget('CActiveForm', array(
	       									 'id'=>'edituserphone-form',
          								 'action'=>'',
	        								 'enableAjaxValidation'=>false,
       									 )); ?>
                    		<table cellpadding="0" cellspacing="0">
                    			<tr><td height="60" width="245" align="right" valign="bottom">您当前设置的手机号码：</td><td valign="bottom"><span class="wjLight"><?php echo $user_datas->user_phone;?></span></td></tr>
                    			<tr><td height="30" align="right" valign="bottom">新手机号码：</td><td valign="bottom"><?php echo $form->textField($model,"user_phone");?><span class="input_error"  id="user_phone_tip"><?php echo $form->error($model,'user_phone'); ?></span><span><a href="javascript:get_phone_verification('User_user_phone');">获取验证码</a></span></td></tr>
                    			
                    			<tr>
                             <td height="30" align="right" valign="bottom"><strong>手机验证码：</strong></td>
                             <td valign="bottom"><?php echo $form->textField($model,"user_phone_verification",array('class'=>'gm_login_input'));?><span class="input_error"><?php echo $form->error($model,'user_phone_verification'); ?></span></td>
                           </tr>
        
        
                                <tr><td>&nbsp;</td><td height="60" valign="middle"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"确认","class"=>"wjsubmit"));?></td></tr>
                         </table>
                         <?php $this->endWidget(); ?>
                		</div>
                </div>
         <!--邮件订阅修改邮箱结束-->
      