
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("footlink/index");?>">返回到底部连接管理</a></span><span><a href="<?php echo $this->createUrl("footlink/add",array());?>">增加底部链接</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchsystem-form',
          'action'=>$this->createUrl("footlink/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">底部链接名:</span><span class="search_item_input"><?php echo CHtml::textField("footlink_name",$footlink_name,array('id'=>'search_footlink_name'));?></span></div>
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
                       'name'=>"footlink_name",
                       'type'=>'raw',
                       'value'=>'$data->footlink_name'
                     ),
                      array(
                       'name'=>"footlink_order",
                       'type'=>'raw',
                       'value'=>'$data->footlink_order'
                      ),
                     array(
                       'name'=>"footlink_desc",
                       'type'=>'raw',
                       'value'=>'$data->footlink_desc'
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
                       'value'=>'$data->get_footlink_operate()'
					//	'value'=>'$data->id'
                      ), 

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

