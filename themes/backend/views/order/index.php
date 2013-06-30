<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("order/add",array());?>">增加订单</a></span><span><a href="<?php echo $this->createUrl("order/search",array('pay_order_status'=>'3'));?>">已取消订单</a></span><span><a href="<?php echo $this->createUrl("order/search",array('pay_order_status'=>'2'));?>">正式订单</a></span><span><a href="<?php echo $this->createUrl("order/search",array('pay_order_status'=>'1'));?>">未处理订单</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchtrave-form',
          'action'=>$this->createUrl("order/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <div class="search_item"><span class="search_item_name">订单号:</span><span class="search_item_input"><?php echo CHtml::textField("order_id",$order_id,array("id"=>"order_id")) ?></span></div>
       	  <div class="search_item"><span class="search_item_name">下单用户ID/用户名称:</span><span class="search_item_input"><?php echo CHtml::textField("create_id",$create_id,array("id"=>"create_id"));?></span></div>
       	  <div class="search_item"><span class="search_item_name">下单时间:</span><span class="search_item_input"><?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $create_time;?>"});'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">处理时间:</span><span class="search_item_input"><?php echo CHtml::textField("operate_time",$operate_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $operate_time;?>"});'));?></span></div>
       	  <div class="clear_both"></div>
       	  <!--<div class="search_item"><span class="search_item_name">关联用户:</span><span class="search_item_input"><?php $user=new User(); echo CHtml::dropDownList("relation_id",$relation_id,$user->get_select_admin(),array()); ?></span></div>-->
       	  <div class="search_item"><span class="search_item_name">线路类型:</span><span class="search_item_input"><?php echo CHtml::dropDownList("trave_category",$trave_category,CV::$TRAVE_CATEGORY,array('id'=>'trave_category'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">线路编号/线路名称/旅行社名称</span><span class="search_item_input"><?php echo CHtml::textField("trave_name",$trave_name,array("id"=>"trave_name"));?></span></div>
       	  <div class="clear_both"></div>
       	  <div class="search_item"><span class="search_item_name">处理状态:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("order_status",CV::$ORDER_STATUS,$order_status,"",$class_name=""); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">付款状态:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("pay_status",CV::$PAY_STATUS,$pay_status,"",$class_name=""); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">付款方式:</span><span class="search_item_input"><?php echo CHtml::dropDownList("pay_style",$pay_style,CV::$PAY_STYLE,array()); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">订单等级:</span><span class="search_item_input"><?php echo CHtml::dropDownList("order_level",$order_level,CV::$ORDER_LEVEL,array()); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">下单方式:</span><span class="search_item_input"><?php echo CHtml::dropDownList("order_style",$order_style,CV::$ORDER_STYLE,array()); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">来源地:</span><span class="search_item_input"><?php echo CHtml::dropDownList("order_source",$order_source,CV::$ORDER_SOURCE,array()); ?></span></div>
       	  <div class="clear_both"></div>
       	  <div class="search_item"><span class="search_item_name">总价钱:</span><span class="search_item_input"><?php echo CHtml::dropDownList("total_price",$total_price,CV::$ORDER_PRICE,array('id'=>'total_price'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">是否需要发票:</span><span class="search_item_input"><?php echo CHtml::dropDownList("is_invoice",$is_invoice,array(''=>'发票','1'=>'不需要','2'=>'需要'),array('id'=>'is_invoice'));?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?>
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	<!--
       	   	<div class="operate_all"><a  href="javascript:submit_form('deletetrave-form');">删除所有</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetrave-form',
          					'action'=> $this->createUrl("delete",array()),
	        					'enableAjaxValidation'=>false,
       						 )); ?>
       						 
       						 -->
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$active_data_provider,
				  'ajaxUpdate'=>false,
				  'pager'=>array('class'=>'LinkListPager'),
				  
				  
                  'columns'=>array(
                  /*
                  array(
						  'class'=>'CCheckBoxColumn',
						  'name'=>'id',
						  'value'=>'$data->id',
						  'selectableRows' => 2,
						  'checkBoxHtmlOptions' => array('name'=>'id[]'),
					  ),
					  */
					  
					  
                     array(
                       'name'=>"id",
                       'type'=>"raw",
                       'value'=>'$data->id'
                     ),
                    array(
                       'name'=>"线路类别",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_category()'
                     ),
                     array(
                       'name'=>"trave_id",
                       'type'=>'raw',
                       'value'=>'$data->trave->preview_trave()'
                     ),
                     array(
                       'name'=>"出发城市",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_sregion()'
                     ),
                     array(
                       'name'=>"目的地",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_region()'
                     ),
                      array(
                       'name'=>"联系人",
                       'type'=>'raw',
                       'value'=>'$data->get_pay_contacter()'
                     ),
                     
                      array(
                       'name'=>"联系电话",
                       'type'=>'raw',
                       'value'=>'$data->get_pay_contacter_phone()'
                     ),
                     
                     
                     array(
                       'name'=>'start_date',
                       'type'=>'raw',
                       'value'=>'$data->start_date'
                     ),
                     array(
                       'name'=>"adult_nums",
                       'type'=>'raw',
                       'value'=>'$data->adult_nums'
                     ),
                     array(
                       'name'=>"child_nums",
                       'type'=>'raw',
                       'value'=>'$data->child_nums'
                     ),

                     array(
                       'name'=>"total_price",
                       'type'=>'raw',
                       'value'=>'$data->total_price'
                     ),
                     
                     array(
                       'name'=>"未付款",
                       'type'=>'raw',
                       'value'=>'$data->get_remain_pay()'
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
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),
                     
                     array(
                       'name'=>'operate_time',
                       'type'=>'raw',
                       'value'=>'!empty($data->operate_time)?date("Y-m-d H:i:s",$data->operate_time):"未处理"'
                     ),

                     array(
                       'name'=>'create_id',
                       'type'=>'raw',
                       'value'=>'$data->user->user_login'
                     ),
                 
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_admin_order_operate()'
                     ), 
                   ),
                  )); ?>
                 <!-- <?php $this->endWidget(); ?>-->
        				
       	   	</div>
       </div> 
    </div>
