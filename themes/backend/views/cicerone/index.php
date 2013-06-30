
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("cicerone/index");?>">返回到导游管理</a></span><span><a href="<?php echo $this->createUrl("cicerone/add",array());?>">增加导游</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchsystem-form',
          'action'=>$this->createUrl("cicerone/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">导游姓名:</span><span class="search_item_input"><?php echo CHtml::textField("cicerone_name",$cicerone_name,array('id'=>'search_cicerone_name'));?></span></div>
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
                       'name'=>"cicerone_name",
                       'type'=>'raw',
                       'value'=>'$data->cicerone_name'
                     ),
					 array(
                       'name'=>"cicerone_sex",
                       'type'=>'raw',
                       'value'=>'$data->cicerone_sex'
                     ),
                     array(
                       'name'=>"cicerone_id",
                       'type'=>'raw',
                       'value'=>'$data->cicerone_id'
                     ),
                      array(
                       'name'=>"cicerone_address",
                       'type'=>'raw',
                       'value'=>'$data->cicerone_address'
                      ),
					  array(
                       'name'=>"cicerone_phone",
                       'type'=>'raw',
                       'value'=>'$data->cicerone_phone'
                     ),
                      array(
                       'name'=>"cicerone_num",
                       'type'=>'raw',
                       'value'=>'$data->cicerone_num'
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
                       'value'=>'$data->get_cicerone_operate()'
					//	'value'=>'$data->id'
                      ), 

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

