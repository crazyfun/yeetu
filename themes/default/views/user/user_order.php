               <?php Yii::app()->clientScript->registerScriptFile('/js/My97DatePicker/WdatePicker.js');?>
               <!--我的订单-->
                <div style="display:block;">
                    <h3 class="wjabout"><span class="sp">我的订单</span></h3>
                    <div class="wjtab_con_w">
                        <ul class="wjorder">
                            <li class="all_li11"><a href="<?php echo $this->createUrl('user/order',array()) ?>" <?php if($order_status=='') echo "class='choose_a'"; ?> rel="nofollow">所有订单<span>（<?php echo $trave_order_nums['all_nums'];?>）</span></a></li>
                            <li class="all_li22"><a href="<?php echo $this->createUrl('user/order',array('order_status'=>'1')) ?>" <?php if($order_status=='1') echo "class='choose_a'"; ?> rel="nofollow">进行中的订单<span>（<?php echo $trave_order_nums['ordering_nums'];?>）</span></a></li>                 
                            <li class="all_li33"><a href="<?php echo $this->createUrl('user/order',array('order_status'=>'2')) ?>" <?php if($order_status=='2') echo "class='choose_a'"; ?> rel="nofollow">预定成功的订单<span>（<?php echo $trave_order_nums['success_nums'];?>）</span></a></li>
                            <li class="all_li22"><a href="<?php echo $this->createUrl('user/order',array('order_status'=>'3')) ?>" <?php if($order_status=='3') echo "class='choose_a'"; ?> rel="nofollow">已取消的订单<span>（<?php echo $trave_order_nums['failed_nums'];?>）</span></a></li>
                        	<div class="clear_float"></div>
                        </ul>
                        <div class="wjtabc">
                        	<?php echo CHtml::form($this->createUrl($this->action->id), 'get')?>
                        	<?php echo CHtml::hiddenField('order_status',$order_status);?>
                        	<table class="htj_table">
				              <tr>
				                <td width="200px;">
				                下单时间: <?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy/MM",isShowWeek:true,startDate:"'. $create_time . '"});', 'class'=>'htj_table_input'));?>
				               </td>

				                <td width="240px;">线路名称:<?php echo CHtml::textField('s', $s, array('class'=>'htj_table_input'))?></td>
				                <td><input type="submit" value="搜&nbsp;&nbsp;索" class="htj_table_sbtn" /></td>
				                
				                <td class="padding_order" style="width:337px;"><span class="<?php echo (($value_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("",array('value_sort'=>(($value_sort=="DESC")?"ASC":"DESC"),'create_time'=>$create_time,'s'=>$s,'order_status'=>$order_status)); ?>" rel="nofollow">价格</a></span><span class="<?php echo (($operate_time_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("",array('operate_time_sort'=>(($operate_time_sort=="DESC")?"ASC":"DESC"),'create_time'=>$create_time,'s'=>$s,'order_status'=>$order_status)); ?>" rel="nofollow">处理时间</a></span><span class="<?php echo (($time_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("",array('time_sort'=>(($time_sort=="DESC")?"ASC":"DESC"),'create_time'=>$create_time,'s'=>$s,'order_status'=>$order_status)); ?>" rel="nofollow">下单时间</a></span></td>
				              </tr>
				            </table>
				            <?php echo CHtml::endForm(); ?>
                            <table cellpadding="0" cellspacing="0" class="wjtablebor" border="1">
                                <tr>
                                    <th width="60">订单编号</th><th width="70">下单时间</th><th>产品名称</th><th width="75">价格</th><th width="60">订单状态</th><th width="70">付款状态</th><th width="102">操作</th>
                                </tr>
                                <?php foreach($trave_order_datas as $key => $value){?>
                                <tr>
                                    <td><?php echo $value->id;?></td><td><?php echo date("Y-m-d H:i:s",$value->create_time);?></td><td><a title="<?php echo $value->trave->trave_name?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value->trave_id,'n'=> $value->trave->trave_title)) ?>"><?php echo Util::cs($value->trave->trave_name,16); ?></a></td><td><span style="color:#ff6600;"><?php echo $value->total_price;?>元</span></td><td><?php echo $value->get_order_status(); ?></td><td><?php echo $value->get_trave_pay_status();?></td><td><div class="wjtjac"><?php echo $value->get_order_operate("",$order_status); ?></div></td>
                                </tr>
                              <?php } ?>
                            </table>
                            <div><?php  $this->widget('CLinkPager',array('pages'=>$pages));?></div>
                            <div class="wjLight">注：在线预定成功付款后，预定状态处理大约需要10分钟，请您耐心等待。</div>
                    	</div>
                    </div>
                </div>
                <!--我的订单结束-->
