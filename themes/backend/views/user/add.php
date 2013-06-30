<div id="page_content">
    <div class="show_right_content">
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("user/index");?>">返回到用户管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertuser-form',
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo $form->hiddenField($model,"id");
              if(!empty($model->id)){
              	$readonly=" readonly ";
              }else{
              	$readonly="";
              }
           ?>
           
           
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add"><?php if($model->id) echo "会员修改"; else echo "会员添加"; ?></div>
           <div class="input_line"><div class="input_name">用户名</div><div class="input_content"><?php echo $form->textField($model,"user_login",array('readonly'=>$readonly));?></div><div class="input_error"><?php echo $form->error($model,'user_login'); ?></div><div class="input_name">邮件</div><div class="input_content"><?php echo $form->textField($model,"email",array());?></div><div class="input_error"><?php echo $form->error($model,'email'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">手机</div><div class="input_content"><?php echo $form->textField($model,"user_phone",array());?></div><div class="input_error"><?php echo $form->error($model,'user_phone'); ?></div><div class="input_name">固定电话</div><div class="input_content"><?php echo $form->textField($model,"user_telephone",array());?></div><div class="input_error"><?php echo $form->error($model,'user_telephone'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">真实姓名</div><div class="input_content"><?php echo $form->textField($model,"real_name",array());?></div><div class="input_error"><?php echo $form->error($model,'real_name'); ?></div><div class="input_name">昵称</div><div class="input_content"><?php echo $form->textField($model,"nice_name",array());?></div><div class="input_error"><?php echo $form->error($model,'nice_name'); ?></div><div class="input_name">生日</div><div class="input_content"><?php echo $form->textField($model,"user_birthday",array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $model->user_birthday;?>"});'));?></div><div class="input_error"><?php echo $form->error($model,'user_birthday'); ?></div><div class="clear_both"></div></div>

           <div class="input_line"><div class="input_name">性别</div><div class="input_content"><?php echo $form->dropDownList($model,"user_sex",array('1'=>'男','2'=>'女'),array());?></div><div class="input_error"><?php echo $form->error($model,'user_sex'); ?></div>
           <div class="input_name">用户类型</div><div class="input_content"><?php echo  $form->dropDownList($model,"status",array('1'=>'普通用户','2'=>'管理员'),array());?></div><div class="input_error"><?php echo $form->error($model,'status'); ?></div>	
           <div class="clear_both"></div>
           <div class="input_name">会员等级</div><div class="input_content"><?php echo $form->dropDownList($model,"level",CV::$USER_LEVEL_SEARCH,array());?></div><div class="input_error"><?php echo $form->error($model,'level'); ?></div>	
           <div class="input_name">旅游资讯</div><div class="input_content"><?php echo $form->dropDownList($model,"agreement_free",array(''=>'不接受','1'=>'接受'),array());?></div><div class="input_error"><?php echo $form->error($model,'agreement_free'); ?></div>	
           <div class="input_name">邮箱验证</div><div class="input_content"><?php echo $form->dropDownList($model,"email_validate",array('1'=>'未验证','2'=>'已验证'),array());?></div><div class="input_error"><?php echo $form->error($model,'email_validate'); ?></div>	

           <div class="clear_both"></div></div>
           		
           <div class="input_line"><div class="input_name">积分</div><div class="input_content"><?php echo $form->textField($model,"credit",array('readonly'=>$readonly));?></div><div class="input_error"><?php echo $form->error($model,'credit'); ?></div>
           <div class="input_name">优惠券</div><div class="input_content"><?php echo $form->textField($model,"coupon",array('readonly'=>$readonly));?></div><div class="input_error"><?php echo $form->error($model,'coupon'); ?></div>
           <div class="clear_both"></div></div>
           		
           <div class="input_line"><div class="input_name">地址</div><div class="input_content"><?php echo $form->textField($model,"user_address",array());?></div><div class="input_error"><?php echo $form->error($model,'user_address'); ?></div>
           <div class="input_name">邮编</div><div class="input_content"><?php echo $form->textField($model,"user_zip",array());?></div><div class="input_error"><?php echo $form->error($model,'user_zip'); ?></div>
           <div class="clear_both"></div></div>
           	
           	<?php if(!empty($model->id)){?>
           	<div class="input_line">
           	  <div class="input_name">用户登录IP</div><div class="input_content"><?php echo $model->login_ip;?></div>
              <div class="input_name">用户注册IP</div><div class="input_content"><?php echo $model->registe_ip;?></div>
              <div class="input_name">用户登录时间</div><div class="input_content"><?php echo date('Y-m-d H:i:s',$model->login_time);?></div>
              <div class="clear_both"></div>
              <div class="input_name">用户注册时间</div><div class="input_content"><?php echo date('Y-m-d H:i:s',$model->create_time);?></div>
             </div>
           	<?php } ?>

    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("user/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


