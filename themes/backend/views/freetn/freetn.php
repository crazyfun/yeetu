<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("freetn/add",array());?>">增加国际机+酒店</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchtrave-form',
          'action'=>$this->createUrl("freetn/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <div class="search_item"><span class="search_item_name">显示类型:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("trave_status",array('1'=>'未发布','2'=>'已发布'),$model->trave_status,"请选择类型",$class_name=""); ?></span></div><div class="search_item"><span class="search_item_name">推荐:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("trave_recommend",array('1'=>'未推荐','2'=>'推荐'),$model->trave_recommend,"推荐类型",$class_name=""); ?></span></div>
       	  <div class="search_item"><span class="search_item_name">热卖:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("trave_hot",array('1'=>'不是热卖','2'=>'是热卖'),$trave_hot,"热卖类型",$class_name=""); ?></span></div><div class="search_item"><span class="search_item_name">特价:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("trave_bargain",array('1'=>'不是特价','2'=>'特价'),$model->trave_bargain,"特价类型",$class_name=""); ?></span></div><div class="search_item"><span class="search_item_name">&nbsp;</span><span class="search_item_input"><?php echo CHtml::textField("trave_name",$trave_name,array("id"=>"trave_name"));?></span></div>
       	  <div class="search_item"><span class="search_item_name">预定类型:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("trave_ordain",array('1'=>'立即预定'),$model->trave_ordain,"预定类型",$class_name=""); ?></span></div><div class="search_item"><span class="search_item_name">首页显示:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("show_index",array('1'=>'显示'),$model->show_index,"首页显示",$class_name=""); ?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?>
       </div>
       <!--示-->
       <div class="show_search_content">

       	   <!--示牡-->
       	   <div class="show_search_text">
                 <div class="operate_all"><a  href="javascript:submit_trave_form('deletetrave-form','/backend.php/freetn/delete');">删除所有</a>&nbsp;&nbsp;<a  href="javascript:submit_trave_form('deletetrave-form','/backend.php/freetn/publish/status/2');">批量发布</a>&nbsp;&nbsp;<a  href="javascript:submit_trave_form('deletetrave-form','/backend.php/freetn/publish/status/1');">批量不发布</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetrave-form',
          					'action'=> '',
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
                       'name'=>"trave_number",
                       'type'=>'raw',
                       'value'=>'$data->trave_number'
                     ),

                     array(
                       'name'=>"酒店",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_hotels()'
                     ),
                     array(
                       'name'=>"trave_name",
                       'type'=>'raw',
                       'value'=>'$data->preview_trave()'
                     ),
                     
                     array(
                       'name'=>'trave_suppliers',
                       'type'=>'raw',
                       'value'=>'$data->Agency->agency_name'
                     
                     ),
                     array(
                       'name'=>"出发时间",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_date()'
                     ),
                     
                     
                     array(
                       'name'=>"主要景区",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_area()'
                     ),
    
                     array(
                       'name'=>"线路价钱",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_price()'
                     ),
                     
                     array(
                       'name'=>"出行天数",
                       'type'=>'raw',
                       'value'=>'$data->trave_route_number'
                     ),
                     
                      array(
                       'name'=>"套餐",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_package()'
                     ),
                     
                     array(
                       'name'=>"图片数",
                       'type'=>'raw',
                       'value'=>'$data->cout_images()'
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
                       'value'=>'$data->get_trave_operate()'
                     
                     ), 

                   ),
                  )); ?>
        				<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>





