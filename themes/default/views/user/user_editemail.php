
         <!--邮件订阅修改邮箱-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">修改邮箱</span></h3>
                	<div class="wjgivep">
                        <div class="wjprocess_bar">
                        	<table cellpadding="0" cellspacing="0" width="100%"><tr><td class="wjnow_step" width="280" height="26" valign="middle">输入您的新邮箱</td><td valign="middle">激活您的新邮箱</td><td valign="middle">完成</td></tr></table>
                        </div>
                        
                        <?php $form=$this->beginWidget('CActiveForm', array(
	       									 'id'=>'editemail-form',
          								 'action'=>$this->createUrl("user/editemail",array()),
	        								 'enableAjaxValidation'=>false,
       									 )); ?>
                    		<table cellpadding="0" cellspacing="0">
                    			<tr><td height="60" width="245" align="right" valign="bottom">您当前设置的邮箱：</td><td valign="bottom"><span class="wjLight"><?php echo $user_datas->email;?></span></td></tr>
                    			<tr><td height="30" align="right" valign="bottom">新邮箱：</td><td valign="bottom"><?php echo $form->textField($model,"email");?><span class="input_error"><?php echo $form->error($model,'email'); ?></span></td></tr>
                                <tr><td>&nbsp;</td><td height="60" valign="middle"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"确认","class"=>"wjsubmit"));?></td></tr>
                         </table>
                         <?php $this->endWidget(); ?>
                		</div>
                </div>
         <!--邮件订阅修改邮箱结束-->
      