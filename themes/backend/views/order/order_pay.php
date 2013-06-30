<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchorderpay-form',
          'action'=>$this->createUrl("order/searchpay",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <div class="search_item"><span class="search_item_name">订单号:</span><span class="search_item_input"><?php echo CHtml::textField("order_id",$order_id,array("id"=>"order_id")) ?></span></div>
       	  <div class="search_item"><span class="search_item_name">外部流水号:</span><span class="search_item_input"><?php echo CHtml::textField("notify_id",$notify_id,array("id"=>"notify_id"));?></span></div>
       	  <div class="search_item"><span class="search_item_name">内部流水号:</span><span class="search_item_input"><?php echo CHtml::textField("web_notify_id",$web_notify_id,array("id"=>"web_notify_id"));?></span></div>
       	  <div class="search_item"><span class="search_item_name">支付方式:</span><span class="search_item_input"><?php echo CHtml::dropDownList("trade_type",$trade_type,CV::$PAY_STYLE,array()); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">下单时间:</span><span class="search_item_input"><?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $create_time;?>"});'));?></span></div>
       	  <div class="clear_both"></div>
       	  <div class="search_item"><span class="search_item_name">付款用户:</span><span class="search_item_input"><?php echo CHtml::textField("create_id",$create_id,array("id"=>"create_id"));?></span></div>
       	  <div class="search_item"><span class="search_item_name">操作用户:</span><span class="search_item_input"><?php echo CHtml::textField("operate_id",$operate_id,array("id"=>"operate_id"));?></span></div>
       	  
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?>
       </div>
       <!--示-->
       <div class="show_search_content">

       	   <!--示牡-->
       	   <div class="show_search_text">
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$active_data_provider,
                  'columns'=>array(
                     array(
                       'name'=>"id",
                       'type'=>"raw",
                       'value'=>'$data->id'
                     ),
                    array(
                       'name'=>"order_id",
                       'type'=>'raw',
                       'value'=>'$data->order_id'
                     ),
                     array(
                        'name'=>"web_notify_id",
                        'type'=>'raw',
                        'value'=>'$data->web_notify_id'
                     ),
                     array(
                       'name'=>"notify_id",
                       'type'=>'raw',
                       'value'=>'$data->notify_id'
                     ),
                     array(
                       'name'=>"total_fee",
                       'type'=>'raw',
                       'value'=>'$data->total_fee'
                     ),
                     array(
                       'name'=>"trade_type",
                       'type'=>'raw',
                       'value'=>'$data->get_trade_type()'
                     ),
                     array(
                       'name'=>'receive_name',
                       'type'=>'raw',
                       'value'=>'$data->receive_name'
                     ),
                     array(
                       'name'=>"receive_address",
                       'type'=>'raw',
                       'value'=>'$data->receive_address'
                     ),
                     array(
                       'name'=>"receive_zip",
                       'type'=>'raw',
                       'value'=>'$data->receive_zip'
                     ),

                     array(
                       'name'=>"receive_phone",
                       'type'=>'raw',
                       'value'=>'$data->receive_phone'
                     ),
                     array(
                       'name'=>"receive_mobile",
                       'type'=>'raw',
                       'value'=>'$data->receive_mobile'
                     ),
                     
                      array(
                       'name'=>"create_id",
                       'type'=>'raw',
                       'value'=>'$data->User->user_login'
                     ),
                     
                      array(
                       'name'=>"operate_id",
                       'type'=>'raw',
                       'value'=>'$data->get_operate_user()'
                     ),
                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),
 

                   ),
                  )); ?>
        				
       	   	</div>
       </div> 
    </div>
    
    

    






