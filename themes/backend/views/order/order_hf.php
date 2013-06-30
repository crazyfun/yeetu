<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("order/add",array());?>">增加订单</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchtrave-form',
          'action'=>$this->createUrl("",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <div class="search_item"><span class="search_item_name">订单号:</span><span class="search_item_input"><?php echo CHtml::textField("order_id",$order_id,array("id"=>"order_id")) ?></span></div>
       	  <div class="search_item"><span class="search_item_name">线路编号/线路名称/旅行社名称</span><span class="search_item_input"><?php echo CHtml::textField("trave_name",$trave_name,array("id"=>"trave_name"));?></span></div>
       	  <div class="search_item"><span class="search_item_name">处理状态:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("order_status",CV::$ORDER_STATUS,$order_status,"",$class_name=""); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">付款状态:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("pay_status",CV::$PAY_STATUS,$pay_status,"",$class_name=""); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">下单用户ID/用户名称:</span><span class="search_item_input"><?php echo CHtml::textField("create_id",$create_id,array("id"=>"create_id"));?></span></div>
       	  <div class="search_item"><span class="search_item_name">下单时间:</span><span class="search_item_input"><?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $create_time;?>"});'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">处理时间:</span><span class="search_item_input"><?php echo CHtml::textField("operate_time",$operate_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $operate_time;?>"});'));?></span></div>
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
                       'name'=>'start_date',
                       'type'=>'raw',
                       'value'=>'$data->start_date'
                     ),
                     
                     
                     array(
                       'name'=>'去程航班',
                       'type'=>'raw',
                       'value'=>'$data->get_start_date_flight()'
                     ),
                     
                      array(
                       'name'=>'回程航班',
                       'type'=>'raw',
                       'value'=>'$data->get_back_start_date_flight()'
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
                       'name'=>'create_id',
                       'type'=>'raw',
                       'value'=>'$data->user->user_login'
                     ),
                     
                      array(
                       'name'=>'operate_time',
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->operate_time)'
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
