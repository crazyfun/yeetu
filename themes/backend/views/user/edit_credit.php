<div id="page_content">
    <div class="show_right_content">
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("user/index");?>">返回用户管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'insertuser-form',
	        'enableAjaxValidation'=>false,
         ));
        ?>
           <?php 
              echo CHtml::hiddenField("id",$user_id,array());
           ?>
           <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
           <div class="jwy_add">用户积分修改</div>
           <div class="input_line"><div class="input_name">用户ID</div><div class="input_content"><?php echo  $user->id; ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">用户名</div><div class="input_content"><?php echo $user->user_login; ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">积分</div><div class="input_content"><?php echo $user->credit; ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">操作动作</div><div class="input_content"><?php echo $form->dropDownList($model,"credit_type",CV::$CREDIT_TYPE,array());?></div><div class="input_error"><?php echo $form->error($model,'credit_type'); ?></div><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">操作值</div><div class="input_content"><?php echo CHtml::textField("credit_value",$credit_value,array());?></div><?php echo $error_credit; ?><div class="clear_both"></div></div>
           <div class="input_line"><div class="input_name">操作描述</div><div class="input_long_content"><?php echo $form->textArea($model,"credit_desc",array());?></div><div class="input_error"><?php echo $form->error($model,'credit_desc'); ?></div><div class="clear_both"></div></div>
    		   <div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>


