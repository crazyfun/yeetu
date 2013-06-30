<div id="page_content">
    <div class="show_right_content">
    	
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("flights/traveflight");?>">返回到航班管理</a></span><span><a href="<?php echo $this->createUrl("flights/addtraveflight");?>">增加航班</a></span></div></div>
       
       
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchsystem-form',
          'action'=>$this->createUrl("",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
          <div class="search_item"><span class="search_item_name">机型:</span><span class="search_item_input"><?php echo CHtml::textField("flight_type",$flight_type,array('id'=>'search_flight_type'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">航班:</span><span class="search_item_input"><?php echo CHtml::textField("trave_flight",$trave_flight,array('id'=>'search_trave_flight'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">机场:</span><span class="search_item_input"><?php echo CHtml::textField("flight_airport",$flight_airport,array('id'=>'search_flight_airport'));?></span></div>
       	 <!-- <div class="search_item"><span class="search_item_name">去/回程时间:</span><span class="search_item_input"><?php echo CHtml::textField("flight_date",$flight_date,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-M-dd",isShowWeek:true,startDate:"<?php echo $flight_date;?>",readOnly:true});'));?></span></div>-->
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	<!--
       	   	   <div class="operate_all"><a href="javascript:submit_form('deletetraveflight-form');">删除所有</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetraveflight-form',
          					'action'=> $this->createUrl("deletetraveflight"),
	        					'enableAjaxValidation'=>false,
       						 )); ?>
           -->
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$model->searchdatas(),
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
                       'name'=>"departure",
                       'type'=>'raw',
                       'value'=>'$data->departure'
                     ),
                     
                     array(
                       'name'=>"destinations",
                       'type'=>'raw',
                       'value'=>'$data->destinations'
                     ),
                     array(
                       'name'=>"go_flight_type",
                       'type'=>'raw',
                       'value'=>'$data->go_flight_type'
                     ),

                     array(
                       'name'=>"go_flight",
                       'type'=>'raw',
                       'value'=>'$data->go_flight'
                     ),
                     

                     array(
                       'name'=>"go_flight_airport",
                       'type'=>'raw',
                       'value'=>'$data->go_flight_airport'
                     ),
                     
                     
                     array(
                       'name'=>"go_flight_time",
                       'type'=>'raw',
                       'value'=>'$data->go_flight_time'
                     ),
                     
                     array(
                      'name'=>'go_flight_rairport',
                      'type'=>'raw',
                      'value'=>'$data->go_flight_rairport'
                    
                    ),
                    array(
                      'name'=>'go_flight_rtime',
                      'type'=>'raw',
                      'value'=>'$data->go_flight_rtime'
                    
                    ),
                    
                    array(
                      'name'=>'go_flight_com',
                      'type'=>'raw',
                      'value'=>'$data->go_flight_com'
                    
                    ),
                    
        
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_traveflight_operate()'
                     
                     ), 
                   ),
                  )); ?>
        				<!--<?php $this->endWidget(); ?>-->
       	   	</div>
       </div> 
    </div>

