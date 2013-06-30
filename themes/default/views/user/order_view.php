
<!--我的订单-->
<div style="display:block;">
<h3 class="wjabout"><span class="sp">查看订单#<?php echo $trave_order_datas->id;?>:
<a href="<?php echo $this->createUrl("travel/detail",array('id'=>$trave_order_datas->trave_id,'n'=>$trave_order_datas->trave->trave_title)); ?>" class="order_bt" ><?php echo $trave_order_datas->trave->trave_name;?></a>
</span></h3>
 <div class="wjtab_con_w">
	  	
	<!--
    <div class="order_title">订单信息</div>
	-->
	  <div class="view_order_box"><h2>订单信息</h2>
	    <table  cellspacing="0" class="view_order_table">
            <tr>
            	<th width="100" align="center">订单号</th>
              <!--<th width="200" align="center">线路名称</th>-->
              <th width="100" align="center">出发城市</th>
              <th width="88" align="center">目的地</th>
              <th width="88" align="center">出发时间</th>
              <th width="80" align="center">成人数</th>
              <th width="80" align="center">儿童数</th>
              <th width="110" align="center">总价钱</th>
              <th width="110" align="center">已付款</th>
              <th width="100" align="center">下单时间</th>
              <th width="100" align="center">处理时间</th>
              <th width="100" align="center">订单状态</th>
            </tr>
            <tr>
            	<td align="center"><?php echo $trave_order_datas->id;?></td>
	
              <td align="center"><?php echo $trave_order_datas->get_trave_sregion();?></td>
              <td align="center"><?php echo $trave_order_datas->get_trave_region();?></td>
              <td align="center"><span><?php echo date('Y-m-d',strtotime($trave_order_datas->start_date));?></span></td>
              <td align="center"><?php echo $trave_order_datas->adult_nums;?></td>
              <td align="center"><?php echo $trave_order_datas->child_nums;?></td>
              <td align="center"><?php echo $trave_order_datas->total_price;?>元</td>
              <td align="center"><?php $aleady_pay=$trave_order_datas->get_aleady_pay(); echo empty($aleady_pay)?'0':$aleady_pay;?>元</td>
              <td align="center"><?php echo empty($trave_order_datas->create_time)?'':date('Y-m-d H:i:s',$trave_order_datas->create_time);?></td>
              <td align="center"><?php echo empty($trave_order_datas->operate_time)?'-':date('Y-m-d H:i:s',$trave_order_datas->operate_time);?></td>
              <td align="center"><?php echo $trave_order_datas->get_order_status(); ?></td>
            </tr>
        </table>
		<!-- order_tab end -->
      </div>
      
      
      <div class="view_order_box"><h2>机票信息</h2>
	         		<?php $this->renderDynamic(travel_flight,array('start_date'=>$trave_order_datas->start_date,'trave_id'=>$trave_order_datas->trave_id,'start_date_id'=>$trave_order_datas->start_date_id)); ?>
	    		<!-- order_box end -->	
	   </div>
	   
	      
	      
	      
	    <?php if(!empty($trave_order_datas->room_id)){?>  
	      <div class="view_order_box"><h2>酒店信息</h2>
	          <?php $this->renderDynamic(travel_hotels,array('room_id'=>$trave_order_datas->room_id,'start_date'=>$trave_order_datas->start_date,'trave_route_number'=>$trave_order_datas->trave_route_number,'room_nums'=>$trave_order_datas->room_nums)); ?>
	    <!-- order_box end -->	
	      </div>
	    <?php  
	     } 
	    ?>
	    
	  <?php if(!empty($trave_order_datas->insurance_ids)){?>  
	      <div class="view_order_box"><h2>保险信息</h2>
	          <?php $this->renderDynamic(travel_insurance,array('insurance_ids'=>$trave_order_datas->insurance_ids,'adult_nums'=>$trave_order_datas->adult_nums,'child_nums'=>$trave_order_datas->child_nums)); ?>
	      </div>
	    <?php  
	     } 
	    ?>
    <?php $this->renderDynamic(travel_contacts,array('order_id'=>$trave_order_datas->id)); ?>      
   </div>
</div>
                <!--我的订单结束-->
     
<?php
  $this->widget('application.extensions.tipsy.Tipsy', array(
   'trigger' => 'hover',
   'items' => array(
     array('id' => '.trave_tipsy','gravity' => 'sw','html'=>true),

  ),  
));
?> 
