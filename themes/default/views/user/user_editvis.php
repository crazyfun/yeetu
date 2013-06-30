         <!--添加配送地址-->
 				<div style="display:block;">
                    <h3 class="wjabout"><span class="sp"><a href="#">管理游客信息</a> > <?php if(!empty($model->id)) echo "编辑游客信息";else echo "添加游客信息"; ?></span></h3>
                    <div class="wjtab_con_w">
                        <div class="wjtabc">
                        	<?php $form=$this->beginWidget('CActiveForm', array(
	       									 'id'=>'editvis-form',
          								 'action'=>$this->createUrl("user/editvis",array()),
	        								 'enableAjaxValidation'=>false,
       									 )); ?>
       									 
       									    <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
                            <table cellpadding="0" cellspacing="0" class="wjcon_tableb">
                            	<?php echo CHtml::hiddenField("id",$model->id,array()); ?>
                              <tr>
                                   <td width="100" align="right"><span class="wjLight">*</span>收件人：</td><td><?php echo $form->textField($model,"contact_name");?><span class="input_error"><?php echo $form->error($model,'contact_name'); ?></span></td>
                              </tr>
                              <tr>
                                   <td align="right"><span class="wjLight">*</span>配送地址：</td>
                                   <td><?php echo $form->textField($model,"contact_address");?><span class="input_error"><?php echo $form->error($model,'contact_address'); ?></span></td>
                              </tr>
                              <tr>
                                   <td align="right">邮编：</td><td><?php echo $form->textField($model,"contact_zip");?><span class="input_error"><?php echo $form->error($model,'contact_zip'); ?></span></td>
                              </tr>       
                              <tr>
                                   <td align="right"><span class="wjLight">*</span>邮件：</td><td><?php echo $form->textField($model,"contact_email");?><span class="input_error"><?php echo $form->error($model,'contact_email'); ?></span></td>
                              </tr>                              	
                            	<tr>
                                   <td align="right">手机：</td><td><?php echo $form->textField($model,"contact_phone");?><span class="input_error"><?php $error_contact_phone=$form->error($model,'contact_phone'); if(empty($error_contact_phone)) echo "手机和固定电话至少填一项";  else echo $error_contact_phone; ?></span></td>
                               </tr>
                               <tr>
                                   <td align="right">固定电话：</td><td><?php echo $form->textField($model,"area_code");?> - <?php echo $form->textField($model,"contact_telephone");?><span class="input_error"><?php echo $form->error($model,'contact_telephone'); ?></span></td>
                               </tr>
                               <tr>
                                    <td>&nbsp;</td><td><input type="submit" value="确 定" class="wjamend"></td>
                               </tr>
                            </table>
                             <?php $this->endWidget(); ?>
                    	</div>
                    </div>
                </div>		
            	<!--添加配送地址-->
      