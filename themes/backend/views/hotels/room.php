
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("hotels/addroom",array('hotel_id'=>$hotel_id));?>">增加酒店房型</a></span></div></div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	   <div class="operate_all"><a  href="javascript:submit_form('deletetrave-form');">删除所有</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetrave-form',
          					'action'=> $this->createUrl("deleteroom",array()),
	        					'enableAjaxValidation'=>false,
       						 )); ?>

                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$active_data_provider,
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
                       'name'=>"hotel_id",
                       'type'=>'raw',
                       'value'=>'$data->get_hotel_name()'
                     ),
                     
                     array(
                       'name'=>"room_name",
                       'type'=>'raw',
                       'value'=>'$data->get_room_name()'
                     ),

                     array(
                       'name'=>"room_bed",
                       'type'=>'raw',
                       'value'=>'$data->get_room_bed()'
                     ),
                     
                     array(
                       'name'=>'room_people',
                       'type'=>'raw',
                       'value'=>'$data->get_room_people()'
                     
                     ),
                     
                     array(
                       'name'=>'room_yprice',
                       'type'=>'raw',
                       'value'=>'$data->room_yprice'
                     
                     ),
                     
                     array(
                       'name'=>'room_price',
                       'type'=>'raw',
                       'value'=>'$data->room_price'
                     
                     ),
                     
                     
                     array(
                       'name'=>"room_dinning",
                       'type'=>'raw',
                       'value'=>'$data->get_room_dinning()'
                     ),

                     array(
                       'name'=>"room_broadband",
                       'type'=>'raw',
                       'value'=>'$data->get_room_broadband()'
                     ),

                     array(
                       'name'=>"create_id",
                       'type'=>'raw',
                       'value'=>'$data->get_belong_user_name()'
                     ),
 
                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'$data->converse_date()'
                     ),

                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_room_operate()'
                     
                     ), 

                   ),
                  )); ?>
        				<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

  





