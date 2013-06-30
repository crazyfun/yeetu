               <?php Yii::app()->clientScript->registerScriptFile('/js/My97DatePicker/WdatePicker.js');?>
                <!--抵用券-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">用户积分</span></h3>
                    <div class="wjtab_con_w">
                        <div class="wjtabc">
                        	<div class="wjtotalpay">
                            	用户积分：<span class="wjLight"><?php echo $user_datas->credit; ?></span>
                            </div>
                            <div class="coupon_order">
                            	
                        <?php echo CHtml::form($this->createUrl($this->action->id), 'POST')?>
                        	<?php echo CHtml::hiddenField("time_sort",$time_sort); ?>
                        	<?php echo CHtml::hiddenField("value_sort",$value_sort); ?>
                        	<table class="htj_table">
				              		  <tr>
				              		   <td  style="width:200px">操作动作:<?php echo CHtml::dropDownList("credit_type",$credit_type,CV::$CREDIT_TYPE,array());?></td>
				                     <td  style="width:200px">时间:<?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM",isShowWeek:true,startDate:"'.$create_time.'"});', 'class'=>'htj_table_input'));?></td>
				                     <td  style="width:100px"><input type="submit" value="搜 &nbsp;索" class="htj_table_sbtn" /></td>
				                     <td class="padding_credit"><span class="<?php echo (($value_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("",array('value_sort'=>(($value_sort=="DESC")?"ASC":"DESC"),'credit_type'=>$credit_type,'create_time'=>$create_time)); ?>" rel="nofollow">积分
				                     	</a></span><span class="<?php echo (($time_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("",array('time_sort'=>(($time_sort=="DESC")?"ASC":"DESC"),'credit_type'=>$credit_type,'create_time'=>$create_time)); ?>" rel="nofollow">时间</a></span></td>
				                    </tr>
				                 </table>
				                <?php echo CHtml::endForm(); ?>

				              </div>
                            <table cellpadding="0" cellspacing="0" class="wjtablebor" border="1">
                                <thead>
                                    <th width="80">操作动作</th><th width="100" >操作前积分</th><th width="50">积分</th><th width="100" >操作后积分</th><th width="150" >时间</th><th>操作描述</th>
                              </thead>
                              <tbody>
                                <?php foreach($credit_consume_datas as $key => $value){ ?>
                                <tr>
                                    <td><?php $credit_type_datas=CV::$CREDIT_TYPE; echo $credit_type_datas[$value->credit_type];?></td>
                                    <td><?php echo $value->credit_before;?></td>
                                    <td><?php echo $value->credit_value;?></td>
                                    <td><?php echo $value->credit_after;?></td>
                                    <td><?php echo date("Y-m-d H:i:s",$value->create_time);?></td>
                                    <td><?php echo $value->credit_desc;?></td>
                                </tr>                                 	
                              <?php } ?>
                            </tbody>
                              
                            </table>
                            <div><?php  $this->widget('CLinkPager',array('pages'=>$pages));?></div>

                    	</div>
                    </div>
                </div>
            	<!--抵用券-->
