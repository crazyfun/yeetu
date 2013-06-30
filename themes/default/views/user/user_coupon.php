               <?php Yii::app()->clientScript->registerScriptFile('/js/My97DatePicker/WdatePicker.js');?>
                <!--抵用券-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">抵用券</span></h3>
                    <div class="wjtab_con_w">
                        <div class="wjtabc">
                        	<div class="wjtotalpay">
                            	<span class="coupon_operate">抵用券金额：<span class="wjLight"><?php echo $user_datas->coupon; ?>元 </span><a  href="<?php echo $this->createUrl("user/addcoupon",array());?>" rel="nofollow">输入抵用券编号充值</a></span>
                            	<span class="wjrf"><span class="<?php if($coupon_status=='1') echo 'wjtjac'; else echo '';  ?>"><a href="<?php echo $this->createUrl("",array('coupon_status'=>'1')) ?>" rel="nofollow">抵用券获得</a></span>&nbsp;|&nbsp;<span class="<?php if($coupon_status=='2') echo 'wjtjac'; else echo '';  ?>"><a href="<?php echo $this->createUrl("",array('coupon_status'=>'2')) ?>" rel="nofollow">抵用券消费</a></span></span>
                            </div>
                            <div class="clear_float"></div>
                            <div class="coupon_order">
                          <?php echo CHtml::form($this->createUrl($this->action->id), 'POST')?>
                        	<?php echo CHtml::hiddenField("coupon_status",$coupon_status); ?>
                        	<?php echo CHtml::hiddenField("time_sort",$time_sort); ?>
                        	<?php echo CHtml::hiddenField("value_sort",$value_sort); ?>
                        	<table class="htj_table">
				              		  <tr>
				                     <td style="width:160px;">时间:<?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM",isShowWeek:true,startDate:"'.$create_time.'"});', 'class'=>'htj_table_input'));?></td>
				                     <td style="width:100px;"><input type="submit" value="搜&nbsp;&nbsp;索" class="htj_table_sbtn" /></td>
				                     <td class="padding_coupon"><span class="<?php echo (($value_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("",array('coupon_status'=>$coupon_status,'create_time'=>$create_time,'value_sort'=>(($value_sort=="DESC")?"ASC":"DESC"))); ?>" rel="nofollow">金额</a></span><span class="<?php echo (($time_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("",array('coupon_status'=>$coupon_status,'create_time'=>$create_time,'time_sort'=>(($time_sort=="DESC")?"ASC":"DESC"))); ?>" rel="nofollow">时间</a></span></td>
				                    </tr>
				                 </table>
				                <?php echo CHtml::endForm(); ?>

				              </div>
                           <?php if($coupon_status=='1'){ ?>
                            <table cellpadding="0" cellspacing="0" class="wjtablebor" border="1">
                                <thead>
                                    <th width="80">编号</th><th width="100">操作前金额</th><th width="50">金额</th><th width="100">操作后金额</th><th width="100">有效期至</th><th width="120" >获得时间</th><th width="80">获得方式</th><th>获得描述</th>
                                
                              </thead>
                              <tbody>
                                <?php foreach($coupon_consume_datas as $key => $value){ ?>
                                <tr>
                                    <td><?php echo $value->Coupon->coupon_number;?></td>
                                    <td><?php echo $value->coupon_before;?></td>
                                    <td><?php echo $value->coupon_value;?></td>
                                    <td><?php echo $value->coupon_after;?></td>
                                    <td><?php echo $value->Coupon->expiration_date;?></td>
                                    <td><?php echo date("Y-m-d H:i:s",$value->create_time);?></td>
                                    <td><?php echo $value->get_coupon_category();?></td>
                                    <td><?php echo $value->coupon_desc;?></td>
                                </tr>                                 	
                              <?php } ?>
                            </tbody>
                            </table>
                             <div><?php $this->widget('CLinkPager',array('pages'=>$pages));?></div>
                        <?php }else{ ?>
                          <table cellpadding="0" cellspacing="0" class="wjtablebor" border="1">
                                <thead>
                                   <th width="100">操作前金额</th><th width="50">金额</th><th width="100">操作后金额</th><th width="120">消费时间</th><th width="80">消费方式</th><th>消费描述</th>
                                </thead>
                                <tbody>
                                <?php foreach($coupon_consume_datas as $key => $value){ ?>
                                <tr>
                                	  <td><?php echo $value->coupon_before;?></td>
                                    <td><?php echo $value->coupon_value;?></td>
                                    <td><?php echo $value->coupon_after;?></td>
                                    <td><?php echo date("Y-m-d H:i:s",$value->create_time);?></td>
                                    <td><?php echo $value->get_coupon_category();?></td>
                                    <td><?php echo $value->coupon_desc;?></td>
                                </tr>                                 	
                              <?php } ?>
                              </tbody>
                            </table>
                          <div><?php  $this->widget('CLinkPager',array('pages'=>$pages));?></div>
                          <?php } ?>
                    	</div>
                    </div>
                </div>
            	<!--抵用券-->
     
    