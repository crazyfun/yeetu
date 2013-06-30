<div class="print">
	<div class="p_trave_name"><?php echo $trave_order_datas->trave->trave_name; ?></div>
	<div class="p_title"><span>姓名:<?php echo $order_contact_datas->contact_name;?></span><span>出发日期:<?php echo $trave_order_datas->start_date;?></span><span>总价钱:<?php echo $trave_order_datas->total_price;?></span></div>
	<div class="p_trave_route">
		<div class="p_details_title">行程</div>
		<div class="p_details_content">
			  <?php foreach($trave_route_datas as $key => $value){ ?>
			        <div class="p_days">
                 <span class="p_route_day">第<?php echo $value->route_day;?>天:</span><?php echo $value->get_trave_details_areas(); ?>
              </div> 
              
              <div class="p_trave_route_desc">
              	  <?php echo $value->route_describe;?>
              </div>       	
              
              <div class="p_trave_hotel_desc">
              	     <div class="p_route_dinning"><span class="p_route_dinning_name">用餐:</span><span class="p_route_dinning_content"><?php echo $value->route_dining; ?></span></div>
              	     <div class="p_route_stay"><span class="p_route_stay_name">住宿:</span><span class="p_route_stay_content"><?php echo $value->route_stay; ?></span></div>    
              </div>
         <?php } ?>
     </div>

	</div>
	
	<div class="p_trave_details">
		<div class="p_details_title">接待标准:</div>
		<div class="p_details_content">
			  <?php echo $trave_order_datas->trave->trave_receptionstandards;?>
	  </div>
	  
	  <div class="p_details_title">特色推荐:</div>
		<div class="p_details_content">
			  <?php echo $trave_order_datas->trave->trave_recommended;?>
	  </div>
	  
	  
	  <div class="p_details_title">自费项目:</div>
		<div class="p_details_content">
			  <?php echo $trave_order_datas->trave->trave_tour;?>
	  </div>
	  
	  
	  <div class="p_details_title">预订须知:</div>
		<div class="p_details_content">
			  <?php echo $trave_order_datas->trave->trave_booknotice;?>
	  </div>
	  
	  <div class="p_details_title">温馨提示:</div>
		<div class="p_details_content">
			  <?php echo $trave_order_datas->trave->trave_tips;?>
	  </div>

	</div>
	<div class="p_footer"></span><?php echo Util::current_time('mysql');?></span></div>
</div>
<OBJECT id=WebBrowser classid=CLSID:8856F961-340A-11D0-A96B-00C04FD705A2 height=0 width=0 VIEWASTEXT>
</OBJECT>
<div class="input_submit" id="print_button"> 
	<input type="button" onclick="javascript:preview(1)" value="web打印"/>
	<input type=button value="打印"onclick="document.all.WebBrowser.ExecWB(6,1)" >
	<input type=button value="页面设置" onclick="document.all.WebBrowser.ExecWB(8,1)" >
	<input type=button value="打印预览" onclick="document.all.WebBrowser.ExecWB(7,1)">
<div>