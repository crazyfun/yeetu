
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("hotel/index");?>">返回到酒店管理</a></span><span><a href="<?php echo $this->createUrl("hotel/add",array());?>">增加酒店</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchsystem-form',
          'action'=>$this->createUrl("hotel/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">酒店名:</span><span class="search_item_input"><?php echo CHtml::textField("hotel_name",$hotel_name,array('id'=>'search_hotel_name'));?></span></div>
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
          					'action'=> $this->createUrl("delete",array()),
	        				'enableAjaxValidation'=>false,
       					  ));  ?>
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
                       'name'=>"hotel_name",
                       'type'=>'raw',
                       'value'=>'$data->hotel_name'
                     ),
                     
                     array(
                       'name'=>"hotel_level",
                       'type'=>'raw',
                       'value'=>'$data->get_hotel_level()'
                     ),
                     
					 array(
                       'name'=>"hotel_address",
                       'type'=>"raw",
                       'value'=>'$data->hotel_address'
                     ),
					 array(
						'name'=>"hotel_phone",
						'type'=>"raw",
						'value'=>'$data->hotel_phone',
					 ),
					 array(
						'name'=>"hotel_fax",
						'type'=>"raw",
						'value'=>'$data->hotel_fax',
					 ),
                     array(
                       'name'=>"hotel_link",
                       'type'=>'raw',
                       'value'=>'$data->hotel_link'
                     ),
                      array(
                       'name'=>"mark_price",
                       'type'=>'raw',
                       'value'=>'$data->mark_price'
                      ),
					  array(
                       'name'=>"resale_price",
                       'type'=>'raw',
                       'value'=>'$data->resale_price'
                     ),
                      array(
                       'name'=>"pingri_price",
                       'type'=>'raw',
                       'value'=>'$data->pingri_price'
                      ),
                      array(
                       'name'=>"zhoumo_price",
                       'type'=>'raw',
                       'value'=>'$data->zhoumo_price'
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
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_hotel_operate()'
					//	'value'=>'$data->id'
                      ), 

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

