              <?php 
                  Yii::app()->clientScript->registerScriptFile('/js/My97DatePicker/WdatePicker.js');
                ?>
                <!--个人资料-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">修改个人资料</span></h3>
                     <div class="wjtab_con">
                        <div class="wjgrgx"><b>个人资料更新</b></div>
                        <table width="780" cellpadding="0" cellspacing="0">
                            <tr><td width="94" align="right"><span class="wjcard">会员ID</span>：</td><td align="left"><?php echo $user_datas->id;?></td></tr>
                            <tr><td align="right"><span class="wjcard">邮箱</span>：</td><td align="left" class="wjtelnums"><span><?php echo $user_datas->email;?></span><a href="<?php echo $this->createUrl('user/editemail'); ?>" rel="nofollow">[修改]</a><?php if($user_datas->email_validate!='2'){ ?>&nbsp;&nbsp;<a href="javascript:send_validate_email('<?php echo $user_datas->id;?>');">[验证邮箱]</a><?php } ?></td></tr>
                        </table>
                        <div class="wjdashed"></div>
                        <?php $form=$this->beginWidget('CActiveForm', array(
	       									 'id'=>'editin-form',
          								 'action'=>$this->createUrl("user/editin",array()),
	        								 'enableAjaxValidation'=>false,
       									 )); ?>
       									
           	     				<div class="operate_result"><?php $this->widget("FlashInfo");?></div>
             					
                        <table width="780" cellpadding="0" cellspacing="0">
                            <tr><td width="94" align="right"><span class="wjcard">真实姓名</span>：</td><td align="left"><?php echo $form->textField($model,"real_name");?><span class="input_error"><?php echo $form->error($model,'real_name'); ?></span></td></tr>
                            <tr><td align="right"><span class="wjcard">昵称</span>：</td><td align="left"><?php echo $form->textField($model,"nice_name");?><span class="input_error"><?php echo $form->error($model,'nice_name'); ?></span></td></tr>
                            <tr><td align="right"><span class="wjcard">性别</span>：</td><td align="left"><?php  if($model->user_sex=='1')  $checked=true; else $checked=false; echo CHtml::radioButton("user_sex",$checked,array('value'=>'1'));?>&nbsp;男&nbsp;&nbsp;<?php if($model->user_sex=='2')  $checked=true; else $checked=false; echo CHtml::radioButton("user_sex",$checked,array('value'=>'2'));?>&nbsp;女</td></tr>
                            <tr><td align="right"><span class="wjcard">生日</span>：</td><td align="left"><?php echo $form->textField($model,"user_birthday",array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-M-dd",isShowWeek:true,startDate:"<?php echo $model->user_birthday;?>",readOnly:true});'));?><span class="input_error"><?php echo $form->error($model,'user_birthday'); ?></span></td></tr>
                            <tr><td align="right"><span class="wjcard">手机号码</span>：</td><td align="left"><?php echo $form->textField($model,"user_phone");?><span class="input_error"><?php echo $form->error($model,'user_phone'); ?></span></td></tr>
                            <tr><td align="right"><span class="wjcard">固定电话</span>：</td><td align="left"><?php echo $form->textField($model,"user_telephone");?><span class="input_error"><?php echo $form->error($model,'user_telephone'); ?></span></td></tr>
                            <tr><td align="right"><span class="wjcard">联系地址</span>：</td><td align="left"><?php echo $form->textField($model,"user_address");?><span class="input_error"><?php echo $form->error($model,'user_address'); ?></span></td></tr>
                            <tr><td align="right"><span class="wjcard">邮编</span>：</td><td align="left"><?php echo $form->textField($model,"user_zip");?><span class="input_error"><?php echo $form->error($model,'user_zip'); ?></span></td></tr>
                            <tr><td align="right">&nbsp;</td><td align="left" height="50" valign="middle"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"更新个人资料","class"=>"wjamend"));?></td></tr>
                        </table>
                         <?php $this->endWidget(); ?>
                    </div>
                </div>
                
                <div id="show_operate_tips" style="display:none;" >
    	           <div id="show_operate_tips_content" class="show_operate_tips">
    	           </div>	
    	        </div>
                <!--个人资料结束-->
      