              <!--修改密码-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">修改密码</span></h3>
                    <div class="wjtab_con_w">
                        <div class="wjtabc">
                        	<?php 
                        	$form=$this->beginWidget('CActiveForm', array(
	       									 'id'=>'password-form',
          								 'action'=>$this->createUrl("user/password",array()),
	        								 'enableAjaxValidation'=>false,
       									 )); ?>
       									  <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
                        	<table cellpadding="0" cellspacing="0" class="wjsc">
                            	<tr><td width="100" height="30" valign="bottom" align="right">当前密码：</td><td valign="bottom" ><?php echo $form->passwordField($model,"user_password");?><span class="input_error"><?php echo $form->error($model,'user_password'); ?></span></td></tr>
                            	<tr><td align="right">新密码：</td><td><?php echo $form->passwordField($model,"password");?><span class="input_error"><?php echo $form->error($model,'password'); ?></span></td></tr>
                            	<tr><td align="right">确认新密码：</td><td><?php echo $form->passwordField($model,"con_password");?><span class="input_error"><?php echo $form->error($model,'con_password'); ?></span></td></tr>
                            	<tr><td>&nbsp;</td><td height="60" valign="middle"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"修改密码","class"=>"wjsubmit"));?></td></tr>
                          </table>
                        <?php $this->endWidget(); ?>
                    	</div>
                    </div>
                </div>
            	<!--修改密码-->
