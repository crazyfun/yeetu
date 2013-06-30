            <!--抵用券-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">增加抵用券</span></h3>
                    <div class="wjtab_con_w">
                        <div class="wjtabc">
                        	<div class="wjtotalpay">
                            	抵用券金额：<span class="wjLight"><?php echo $user_datas->coupon; ?>元 </span>
                          </div>
                          
                          <div>
                          <?php $form=$this->beginWidget('CActiveForm', array(
	       									 'id'=>'editemail-form',
          								 'action'=>$this->createUrl("user/addcoupon",array()),
	        								 'enableAjaxValidation'=>false,
       									 )); ?>
                    		<table cellpadding="0" cellspacing="0">
                    			<tr><td height="30" align="right" valign="bottom">输入抵用劵编号：</td><td valign="bottom"><?php echo $form->textField($model,"coupon_number");?><span class="input_error"><?php echo $form->error($model,'coupon_number'); ?></span></td></tr>
                          <tr><td>&nbsp;</td><td height="60" valign="middle"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"确认","class"=>"wjsubmit"));?></td></tr>
                         </table>
                         <?php $this->endWidget(); ?>
                          	
                          </div>
                    	</div>
                    </div>
                </div>
            	<!--抵用券-->