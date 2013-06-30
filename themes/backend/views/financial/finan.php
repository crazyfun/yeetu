<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchorderpay-form',
          'action'=>$this->createUrl("Financial/searchf",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <div class="search_item"><span class="search_item_name">订单号:</span><span class="search_item_input"><?php echo CHtml::textField("order_id",$order_id,array("id"=>"order_id")) ?></span></div>
       	  <div class="search_item"><span class="search_item_name">线路名称:</span><span class="search_item_input"><?php echo CHtml::textField("trave_id",$trave_id,array("id"=>"trave_id")) ?></span></div>
       	  <div class="search_item"><span class="search_item_name">供应商名称:</span><span class="search_item_input"><?php echo CHtml::textField("agency_id",$agency_id,array("id"=>"agency_id")) ?></span></div>
       	  <div class="search_item"><span class="search_item_name">下单时间:</span><span class="search_item_input"><?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $create_time;?>"});'));?></span></div>
       	  <div class="clear_both"></div>
       	  <div class="search_item"><span class="search_item_name">操作用户:</span><span class="search_item_input"><?php echo CHtml::textField("create_id",$create_id,array("id"=>"create_id"));?></span></div>
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
                       'name'=>"order_id",
                       'type'=>'raw',
                       'value'=>'$data->order_id'
                     ),
                     array(
                        'name'=>"trave_id",
                        'type'=>'raw',
                        'value'=>'$data->Trave->preview_trave()'
                     ),
                     array(
                       'name'=>"agency_id",
                       'type'=>'raw',
                       'value'=>'$data->Agency->agency_name'
                     ),
                     array(
                       'name'=>"finan_price",
                       'type'=>'raw',
                       'value'=>'$data->finan_price'
                     ), 
                      array(
                       'name'=>"create_id",
                       'type'=>'raw',
                       'value'=>'$data->User->user_login'
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
    
    

    






