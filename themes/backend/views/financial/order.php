<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	
    	<?php
    	   $order_static_information=$model->get_order_static_information($condition,$params,$trave_condition,$trave_params,$trave_with);
    	   /*
    	   if(empty($order_statist)){
    	   	  $order_statist=$order_static_information;
    	   }
    	   */
    	
    	?>
    	<div class="user_operate"><div class="user_operate_content"><span><span class="static_title">订单总数：</span><span class="static_content"><?php echo $order_static_information['total_order'];?></span>;<span class="static_title">订单总价:</span><span class="static_content"><?php echo $order_static_information['total_price'];?></span> ;<span class="static_title">已付款总价:</span><span class="static_content"><?php echo $order_static_information['aleady_pay'];?></span>;<span class="static_title">未付款总价:</span><span class="static_content"><?php echo $order_static_information['remain_pay'];?></span><!--;<span class="static_title">搜索总订单数:</span><span class="static_content"><?php echo $order_statist['total_order'];?></span>;<span class="static_title">搜索总价:</span><span class="static_content"><?php echo $order_statist['total_price'];?></span>;<span class="static_title">搜索已付款总价:</span><span class="static_content"><?php echo $order_statist['aleady_pay'];?></span>;<span class="static_title">搜索未付款总价:</span><span class="static_content"><?php echo $order_statist['remain_pay'];?></span></span>--></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchtrave-form',
          'action'=>'',
	        'enableAjaxValidation'=>false,
        )); ?>
          <div class="search_item"><span class="search_item_name">旅游线路名称:</span><span class="search_item_input"><?php echo CHtml::textField("trave_id",$trave_id,array("id"=>"trave_id"));?></span></div>
          <div class="search_item"><span class="search_item_name">供应商:</span><span class="search_item_input"><?php echo CHtml::textField("trave_suppliers",$trave_suppliers,array("id"=>"trave_suppliers"));?></span></div>
       	  <div class="search_item"><span class="search_item_name">订单号:</span><span class="search_item_input"><?php echo CHtml::textField("order_id",$order_id,array("id"=>"order_id")) ?></span></div>
       	  
       	  <div class="search_item"><span class="search_item_name">付款状态:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("pay_status",CV::$PAY_STATUS,$pay_status,"",$class_name=""); ?></span></div>
       	  <!--
       	  <div class="search_item"><span class="search_item_name">处理状态:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("order_status",CV::$ORDER_STATUS,$order_status,"",$class_name=""); ?></span></div>
       	  -->
       
       	  <div class="search_item"><span class="search_item_name">结算状态:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("suppliers_settle",CV::$SUPPLIERS_SETTLE,$suppliers_settle,"",$class_name=""); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">是否需要发票:</span><span class="search_item_input"><?php echo CHtml::dropDownList("is_invoice",$is_invoice,array(''=>'发票','1'=>'不需要','2'=>'需要'),array('id'=>'is_invoice'));?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?>
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$active_data_provider,
				  'ajaxUpdate'=>false,
				  'pager'=>array('class'=>'LinkListPager'),
                  'columns'=>array(
                     array(
                       'name'=>"id",
                       'type'=>"raw",
                       'value'=>'$data->id'
                     ),
                     array(
                       'name'=>"trave_id",
                       'type'=>'raw',
                       'value'=>'$data->trave->preview_trave()'
                     ),
                     array(
                       'name'=>'供应商',
                       'type'=>'raw',
                       'value'=>'$data->trave->Agency->agency_name'
                     
                     ),
                     
                     array(
                       'name'=>'adult_nums',
                       'type'=>'raw',
                       'value'=>'$data->adult_nums'
                     
                     ),
                     
                     
                     array(
                       'name'=>'child_nums',
                       'type'=>'raw',
                       'value'=>'$data->child_nums'
                     
                     ),
                     
                     
                     array(
                       'name'=>"total_price",
                       'type'=>'raw',
                       'value'=>'$data->total_price'
                     ),
                     
                     array(
                       'name'=>"coupon_value",
                       'type'=>'raw',
                       'value'=>'$data->coupon_value'
                     ),
                     
                     array(
                       'name'=>"利润",
                       'type'=>'raw',
                       'value'=>'$data->get_order_profit()'
                     ),
                     array(
                       'name'=>"未付款",
                       'type'=>'raw',
                       'value'=>'$data->get_remain_pay()'
                     ),
                     
                     array(
                       'name'=>"已付款",
                       'type'=>'raw',
                       'value'=>'$data->get_aleady_pay()'
                     ),
                     array(
                       'name'=>"order_status",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_order_status()'
                     ),
                     array(
                       'name'=>"pay_status",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_pay_status()'
                     ), 
                     array(
                       'name'=>"is_invoice",
                       'type'=>'raw',
                       'value'=>'$data->get_invoince_datas()'
                     ),
                     
                     array(
                       'name'=>'结算',
                       'type'=>'raw',
                       'value'=>'$data->get_suppliers_settle()'
                     
                     ),
                     
                     array(
                       'name'=>'操作',
                       'type'=>'raw',
                       'value'=>'$data->get_financial_operate()',
                     )
                     
                     
                   ),
                  )); ?>
       	   	</div>
       </div> 
    </div>
    
    

    






