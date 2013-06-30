
 <div id="step3" class="step"></div>
  <!-- step end -->
  <div class="order_main">
    <div class="order_main1">
    	  <?php
    	    	echo CHtml::beginForm($this->createUrl(""),"POST",array("id"=>'insertorder',"name"=>'insertorder'));
    	    	echo CHtml::hiddenField("travel_action","2",array('id'=>'hidden_travel_action'));
          	echo CHtml::hiddenField("token_key",$token_key);
            echo CHtml::hiddenField("trave_id",$trave_id,array('id'=>'trave_id'));
            echo CHtml::hiddenField("hidden_adult_nums",$adult_nums,array('id'=>'hidden_adult_nums'));
            echo CHtml::hiddenField("hidden_child_nums",$child_nums,array('id'=>'hidden_child_nums'));
            echo CHtml::hiddenField('hidden_room_nums',$room_nums,array('id'=>'hidden_room_nums'));
            echo CHtml::hiddenField("hidden_start_date",$select_trave_date,array('id'=>'hidden_start_date'));
            echo CHtml::hiddenField("hidden_room_id",$hidden_room_id,array('id'=>'hidden_room_id'));
            echo CHtml::hiddenField("hidden_hotel_id",$hidden_hotel_id,array('id'=>'hidden_hotel_id'));
            echo CHtml::hiddenField("hidden_trave_route_number",$hidden_trave_route_number,array('id'=>'hidden_trave_route_number'));
            echo CHtml::hiddenField("hidden_total_price",$hidden_total_price,array('id'=>'hidden_total_price'));
            echo CHtml::hiddenField("hidden_insurance_ids",$insurance_ids,array('id'=>'hidden_insurance_ids'));
          	echo CHtml::hiddenField("travel_people_json",$travel_people_json,array('id'=>$travel_people_json));
          	echo CHtml::hiddenField('start_date_id',$start_date_id,array('id'=>'start_date_id'));
          
          
          
        ?>   
	<div class="clear_float"></div>
    <div class="order_title">订单信息</div>
	  <div class="order_box"><h2>线路信息</h2>
	    <table  cellspacing="0" class="order_table">
            <tr>
              <th width="440" align="left">线路名称</th>
              <th width="95" align="center">出发城市</th>
              <th width="88" align="center">出发时间</th>
              <th width="122" align="center">出游人数</th>
            </tr>
            <tr>
              <td>
                <?php echo $trave_datas->trave_name;?></td>
              <td align="center"><?php $trave_district=new District(); $trave_sregion_data=$trave_district->get_table_datas($trave_datas->trave_sregion);echo $trave_sregion_data['district_name'];?></td>
              <td align="center" class="order_date"><span><?php echo date('Y-m-d',strtotime($select_trave_date));?></span></td>
              <td align="center"><?php echo $adult_nums+$child_nums;?></td>
            </tr>
        </table>
		<!-- order_tab end -->
      </div>
      
      
     <div class="order_box"><h2>优惠信息</h2>
	    <table cellspacing="0" class="order_table">
	    <tr><td colspan="5" style="text-align:center;"><?php $this->widget("FlashInfo");?></td></tr>
		  <tr>
        <th align="left" width="400">名称 </th>
        <th align="center"width="80" >可抵用余额 </th>
		    <th align="center"width="70" >当前余额 </th>
		    <th align="center" width="100">操作 </th>
		    <th align="center" width="100">小计</th>
	      </tr>
          <tr>
            <td>抵用劵<span class="cred"><?php echo $trave_datas->get_coupon_describe(); ?></span></td>
            <td><span class="o_price"><?php echo $total_coupon_value;?></span>元</td>
            <td align="center"><span class="o_price"><?php echo $user_datas->coupon;?></span>元</td>
            <td align="center" valign="middle"><a href="<?php echo $this->createUrl("user/addcoupon"); ?>">充值</a></td>
            <td align="center"><span class="o_price" >抵用<?php echo CHtml::textField("coupon_value",$coupon_value,array('onkeyup'=>'javascript:isNumber(this);','style'=>'width:30px;')) ?>元</td>
          </tr>
        </table>	
		  <!-- order_box end -->	
	  </div>
	  
	  
      
      
      <div class="order_box"><h2>机票信息</h2>
	         <?php $this->renderDynamic(travel_flight); ?>
	    <!-- order_box end -->	
	      </div>
	      
	      
	      
	      
	      <div class="order_box"><h2>酒店信息</h2>
	          <?php $this->renderDynamic(travel_hotels); ?>
	    <!-- order_box end -->	
	      </div>
	      
	  

	  <?php if(!empty($insurance_ids)){?>
     <div class="order_box"><h2>保险信息</h2>
	          <?php $this->renderDynamic(travel_insurance,array('insurance_ids'=>$insurance_ids,'adult_nums'=>$adult_nums,'child_nums'=>$child_nums)); ?>
	    </div>
	   <?php } ?>
	 
	    
	    
	    
	  <div class="order_price">总价：<span class="order_show"><?php echo $hidden_total_price;?></span>元</div>
	  <div class="order_line"></div>
	  <div class="order_title">联系人与游客信息</div>
	  <div class="order_box">
	    <h2>联系人</h2>
	    <table  cellspacing="0" class="order_table">
          <tr>
            <th width="113" align="left">姓名</th>
            <th width="155" align="center">手机</th>
            <th width="172" align="center">邮箱</th>
            <th width="130" align="center">固定电话</th>
            <th align="center">联系地址</th>
          </tr>
          <tr>
            <td><?php echo $travel_people[0]['real_name'];?></td>
            <td align="center"><?php echo $travel_people[0]['user_phone'];?></td>
            <td align="center" class="order_date"><span><?php echo $travel_people[0]['email'];?></span></td>
            <td align="center"><?php echo empty($travel_people[0]['area_code'])?"":($travel_people[0]['area_code']."-").$travel_people[0]['user_telephone'];?></td>
            <td align="center"><?php echo $travel_people[0]['user_address'];?></td>
          </tr>
        </table>
	    <!-- order_tab end -->
      </div>  
	  <div class="order_box">
        <h2>游客信息</h2>
	    <table  cellspacing="0" class="order_table">
          <tr>
            <th width="113" align="left">姓名</th>
            <th width="135" align="center">证件类型</th>
            <th align="center">证件号码</th>
            <th width="64" align="center">性别</th>
            <th width="114" align="center">手机</th>
          </tr>
          
          <?php foreach($travel_people as $key => $value){
          	 if($key!=0){
          ?>
          <tr>
            <td><?php echo $value['real_name'];?></td>
            <td align="center"><?php $code_type_array=CV::$CODE_TYPE; echo $code_type_array[$value['code_type']]; ?></td>
            <td align="center" class="order_date"><span><?php echo $value['user_code'];?></span></td>
            <td align="center"><?php $sex_array=array('1'=>'男','2'=>'女'); echo $sex_array[$value['user_sex']]; ?></td>
            <td align="center"><?php echo $value['user_phone'];?></td>
          </tr>

        <?php }} ?>
        </table>
	    <!-- order_tab end -->
      </div>
	  <div class="order_title">其它信息</div>
	  <div class="order_box">
	    <h2>订单备注:</h2>
	      <?php echo CHtml::textArea("order_remark",$order_remark,array("class"=>"table_textarea"));?>
	      <!-- order_tab end -->
      </div>
	  <div class="order_warn">
        <p>温馨提醒<br />
        	
        	<?php $trave=new Trave(); $trave_datas=$trave->get_table_datas($trave_id);echo $trave_datas->trave_tips; ?>
        
      </div>
	  <div class="order_line"></div> 
	  <div class="order_nest">
		  <input type="submit" value="下一步"/>
      </div>
      
      <?php echo CHtml::endForm();?>
	  <div class="clear_float"></div>
    </div>
  </div>
  <div class="line_box1"></div>
        <?php
  $this->widget('application.extensions.tipsy.Tipsy', array(
   'trigger' => 'hover',
   'items' => array(
     array('id' => '.trave_tipsy','gravity' => 'sw','html'=>true),

  ),  
));
?>
  