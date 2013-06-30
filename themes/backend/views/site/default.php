<div class="default_left">
	<div class="default_title">最新未处理订单</div>
	<table class="default_order" cellspacing="0" cellpadding="0" border="1">
		 <thead>
		 	  <th>订单ID</th>
		 	  <th>线路名称</th>
		 	  <th>出发城市</th>
		 	  <th>目的地</th>
		 	  <th>出发时间</th>
		 	  <th>总价钱</th>
		 	  <th>订单状态</th>
		 	  <th>付款状态</th>
		 	  <th>下单时间</th>
		 	  <th>处理时间</th>
		 	  <th>订单者</th>
		 	  <th>操作</th>
		 	</thead>
		 <tbody>
		 	<?php foreach($trave_order_datas as $key => $value){ ?>
		 	 <tr>
		 	 	  <td><?php echo $value->id; ?></td>
		 	 	  <td><?php echo $value->trave->preview_dtrave(); ?></td>
		 	 	  <td><?php echo $value->get_trave_sregion(); ?></td>
		 	 	  <td><?php echo $value->get_trave_region(); ?></td>
		 	 	  <td><?php echo $value->start_date; ?></td>
		 	 	  <td><?php echo $value->total_price; ?></td>
		 	 	  <td><?php echo $value->get_trave_order_status(); ?></td>
		 	 	  <td><?php echo $value->get_trave_pay_status(); ?></td>
		 	 	  <td><?php echo date("Y-m-d H:i:s",$value->create_time); ?></td>
		 	 	  <td><?php echo !empty($value->operate_time)?date("Y-m-d H:i:s",$value->operate_time):"未处理";?></td>
		 	 	  <td><?php echo $value->user->user_login; ?></td>
		 	 	  <td><?php echo $value->get_default_order_operate(); ?></td>
		 	 	</tr>
		 	 <?php } ?>
		 </tbody>
		
	</table>
	
	<div class="default_title">最新未回复咨询</div>
	<table class="default_consulting" cellspacing="0" cellpadding="0" border="1">
		 <thead>
		 	  <th>咨询ID</th>
		 	  <th>线路名称</th>
		 	  <th>咨询email</th>
		 	  <th>咨询内容</th>
		 	  <th>回复内容</th>
		 	  <th>回复人</th>
		 	  <th>回复时间</th>
		 	  <th>咨询人</th>
		 	  <th>咨询时间</th>
		 	  <th>操作</th>
		 	</thead>
		 <tbody>
		 	<?php foreach($consulting_datas as $key => $value){ ?>
		 	 <tr>
		 	 	  <td><?php echo $value->id; ?></td>
		 	 	  <td><?php echo $value->Trave->preview_dtrave(); ?></td>
		 	 	  <td><?php echo $value->consulting_email; ?></td>
		 	 	  <td><?php echo Util::cs($value->consulting_content,30); ?></td>
		 	 	  <td><?php echo Util::cs($value->reply_content,30) ?></td>
		 	 	  <td><?php echo $value->get_reply_name(); ?></td>
		 	 	  <td><?php echo $value->converse_reply_date(); ?></td>
		 	 	  <td><?php echo $value->get_create_name(); ?></td>
		 	 	  <td><?php echo $value->converse_date(); ?></td>
		 	 	  <td><?php echo $value->get_default_operate(); ?></td>
		 	 	</tr>
		 	 <?php } ?>
		 </tbody>
		
	</table>
	
	
	
</div>
