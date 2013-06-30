<div id="page_content">
	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("qa/index",array());?>'>返回到问答列表</a></span></div></div>
	<div class="show_right_content">
		
		<div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchqa-form',
          'action'=>$this->createUrl("qa/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       
       	  <div class="search_item"><span class="search_item_name">标题:</span><span class="search_item_input"><?php echo CHtml::textField("subject",$subject,array("id"=>"subject"));?></span></div>
		  <div class="search_item"><span class="search_item_name">用户:</span><span class="search_item_imput"><?php echo CHtml::textField("user_name",$user_name,array("id"=>"user_name"));?></span></div>
		  <div class="search_item"><span class="search_item_name">状态:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("status",array('1'=>'未解决','3'=>'已解决','4'=>'已关闭'),$model->status,"问题状态",$class_name=""); ?></span></div>
		  <div class="search_item"><span class="search_item_name">分类:</span><span class="search_item_input"><?php echo UserHmtl::get_select_value("category_id",array('1'=>'国内旅游','2'=>'出境旅游','3'=>'周边旅游','4'=>'自助旅游','5'=>'其他'),$model->category_id,"问题类型",$class_name=""); ?></span></div> 
		 
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?>
       </div>
		<div class="show_search_content">
			<div class="show_search_text">
				<div class="operate_result">
					<?php $this->widget("FlashInfo");?>
				</div>
				<?php 
					$form=$this->beginWidget(
						'CActiveForm', 
						array(
							'id'=>'question_form',
							'action'=> $this->createUrl("qa/delete_question"),
							'enableAjaxValidation'=>false,
						)
					);
				?>
				<div class="operate_all">
					<a href="javascript:submit_form('question_form');">删除所选</a>
				</div>
				<?php 
					$this->widget('zii.widgets.grid.CGridView', array(
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
							'name'=>'id',
							'type'=>'text',
							'value' => '$data->id'
						),
						array(
							'name'=>'subject',
							'type'=>'raw',
							'value'=>'CHtml::link(CHtml::encode("$data->subject"), $data->get_admin_edit_url())'
						),
						array(
							'name'=>'user_id',
							'type'=>'raw',
							'value'=>'$data->user->user_login',
						),
						array(
							'name' => 'status',
							'type' => 'raw',
							'value' => '$data->get_status_image()',
						),
						array(
							'name' => 'category_id',
							'type' => 'raw',
							'value' => '$data->category->name',
						),
						array(
							'name' => 'views',
							'type' => 'number',
							'value' => '$data->views',
						),
						array(
							'name' => 'answer_count',
							'type' => 'number',
							'value' => '$data->answer_count',
						),
						array(
							'name'=>'create_time',
							'type' => 'raw',
							'value'=>'date("Y-m-d H:i:s", $data->create_time)'
						),
						array(
							'name'=>'操作',
							'type'=>'raw',
							'value'=>'$data->get_operate_links()'
						),
					),
				)); ?>
				<?php 
					$this->endWidget();
				?>
			</div><!-- /.show_search_text -->
		</div><!-- /.show_search_content -->
	</div><!-- /.show_right_content -->
</div><!-- /#page_content -->
