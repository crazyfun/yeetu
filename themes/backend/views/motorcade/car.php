
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("motorcade/index");?>">返回到车队管理</a></span><span><a href="<?php echo $this->createUrl("motorcade/addcar",array("motorcade_id"=>$motorcade_id));?>">增加此车队车辆</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchsystem-form',
			'action'=>$this->createUrl("searchcar",array("motorcade_id"=>$motorcade_id)),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item">
		  <span class="search_item_name">车牌号:</span><span class="search_item_input"><?php echo CHtml::textField("car_num",$car_num,array('id'=>'search_car_num'));?></span>

		  <span class="search_item_name">驾驶员电话</span><span class="search_item_input"><?php echo CHtml::textField("driver_phone",$driver_phone,array('id'=>'search_driver_phone'));?></span>

		  <span class="search_item_name">线路名称</span><span class="search_item_input"><?php echo CHtml::textField("trave",$trave,array('id'=>'search_trave'));?></span>
		  </div>

       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	  <div class="operate_all"><a  href="javascript:submit_form('deletesystem-form');">删除所有</a></div>

       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        				'id'=>'deletesystem-form',
          					'action'=> $this->createUrl("deletecar",array("motorcade_id"=>$motorcade_id)),
	        				'enableAjaxValidation'=>false,
       					  ));  ?>
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$model->searchdatas(),
	//			  'dataProvider'=>$car_datas,
                  'columns'=>array(
                    array(
                       "name"=>CHtml::checkBox("allcheck","",array("id"=>"allcheck","onclick"=>"javascript:selectallcheck();")),
                       'type'=>'raw',
                       "value"=>'CHtml::checkBox("id[]","",array("class"=>"itemcheckbox","value"=>$data->id))'
                     ),
                     array(
                       'name'=>"id",
                       'type'=>"raw",
                       'value'=>'$data->id'
                     ),
                     array(
                       'name'=>"motorcade_id",
                       'type'=>'raw',
                       'value'=>'$data->Motorcade->motorcade_name'
                     ),
                      array(
                       'name'=>"car_driver",
                       'type'=>'raw',
                       'value'=>'$data->car_driver'
                      ),
					  array(
                       'name'=>"car_num",
                       'type'=>'raw',
                       'value'=>'$data->car_num'
                      ),
					  array(
						'name'=>"car_type",
						'type'=>'raw',
						'value'=>'$data->car_type'
					  ),
					   array(
                       'name'=>"driver_phone",
                       'type'=>'raw',
                       'value'=>'$data->driver_phone'
                      ),
                     array(
                       'name'=>"trave",
                       'type'=>'raw',
                       'value'=>'$data->trave'
                     ), 
                      array(
                       'name'=>"price",
                       'type'=>'raw',
                       'value'=>'$data->price'
                     ),
					 array(
						'name'=>"status",
						'type'=>'raw',
						'value'=>'$data->get_settle_status()'
					 ),
					 array(
						'name'=>"car_desc",
						'type'=>'raw',
						'value'=>'$data->car_desc'
					 ),
					 array(
						'name'=>"use_date",
						'type'=>'raw',
						'value'=>'$data->use_date'
					 ),
                      array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_car_operate()'
                      ), 

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

