
<div id="page_content">
    <div class="show_right_content">
    	
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("peripheral/index");?>">返回到周边游</a></span><span><a href="<?php echo $this->createUrl("peripheral/addtraveroute",array("trave_id"=>$model->trave_id));?>">增加周边游行程</a></span></div></div>

       <!--示-->
       <div class="show_search_content">

       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	   <div class="operate_all"><a href="javascript:submit_form('deletetraveroute-form');">删除所有</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetraveroute-form',
          					'action'=> $this->createUrl("deletetraveroute",array("trave_id"=>$model->trave_id)),
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
                       'name'=>"route_day",
                       'type'=>'raw',
                       'value'=>'$data->get_route_day()'
                     ),

                     array(
                       'name'=>"route_describe",
                       'type'=>'raw',
                       'value'=>'$data->route_describe'
                     ),
                     
                     
                     
                     array(
                       'name'=>"trave_route",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_areas()'
                     ),
                     
                     array(
                       'name'=>"route_stay",
                       'type'=>'raw',
                       'value'=>'$data->route_stay'
                     ),
                     
                     array(
                       'name'=>"route_dining",
                       'type'=>'raw',
                       'value'=>'$data->route_dining'
                     ),
                     
                     
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_traveroute_operate()'
                     
                     ), 
                   
                     
                   ),
                  )); ?>
        				<?php $this->endWidget(); ?>

       	   	</div>

       	
       </div> 
    	
    	
    </div>


