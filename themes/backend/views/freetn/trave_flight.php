<div id="page_content">
    <div class="show_right_content">
    	
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("freetn/index");?>">返回到国际机+酒店</a></span><span><a href="<?php echo $this->createUrl("freetn/addtraveflight",array("trave_id"=>$model->trave_id));?>">增加国际机+酒店航班</a></span></div></div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	   <div class="operate_all"><a href="javascript:submit_form('deletetraveflight-form');">删除所有</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetraveflight-form',
          					'action'=> $this->createUrl("deletetraveflight",array("trave_id"=>$model->trave_id)),
	        					'enableAjaxValidation'=>false,
       						 )); ?>

                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$model->searchdatas(),
				  'ajaxUpdate'=>false,
				  'pager'=>array('class'=>'LinkListPager'),
                  'columns'=>array(
					  array(
						  'class'=>'CCheckBoxColumn',
						  'name'=>'id',
						  'value'=>'$data->id',
						  'selectableRows' => 2,
						  'checkBoxHtmlOptions' => array('name'=>'id[]'),
					  ),
                   array(
                       'name'=>"id",
                       'type'=>"raw",
                       'value'=>'$data->id'
                     ),
                     array(
                       'name'=>"trave_id",
                       'type'=>'raw',
                       'value'=>'$data->Trave->trave_name'
                     ),
                     array(
                       'name'=>"go_flight",
                       'type'=>'raw',
                       'value'=>'$data->go_flight'
                     ),
                     
                     array(
                       'name'=>"gtransfer_flight",
                       'type'=>'raw',
                       'value'=>'$data->gtransfer_flight'
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
                       'name'=>"back_flight",
                       'type'=>'raw',
                       'value'=>'$data->back_flight'
                     ),

                     array(
                       'name'=>"btransfer_flight",
                       'type'=>'raw',
                       'value'=>'$data->btransfer_flight'
                     ),
                     
                     array(
                       'name'=>"back_flight_airport",
                       'type'=>'raw',
                       'value'=>'$data->go_flight_airport'
                     ),
                     
                     
                     array(
                       'name'=>"back_flight_time",
                       'type'=>'raw',
                       'value'=>'$data->go_flight_time'
                     ),
                     
                     array(
                       'name'=>"total_price",
                       'type'=>'raw',
                       'value'=>'$data->total_price'
                     ),
                     array(
                       'name'=>"start_date",
                       'type'=>'raw',
                       'value'=>'$data->start_date'
                     ),
                     array(
                       'name'=>"end_date",
                       'type'=>'raw',
                       'value'=>'$data->end_date'
                     ),
                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'$data->converse_date()'
                     ),
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_traveflight_operate()'
                     
                     ), 
                   ),
                  )); ?>
        				<?php $this->endWidget(); ?>

       	   	</div>

       	
       </div> 
    	
    	
    </div>

