<div id="page_content">
	<div class="show_right_content">
	
		<div class="user_operate">
					<div class="user_operate_content">
						<span><a href='<?php echo $this->createUrl("help/help_add");?>'>添加帮助文章</a></span>
					</div>
		</div><!-- /.user_operate -->
				
				
		<div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchtrave-form',
          'action'=>$this->createUrl("",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
          <div class="search_item"><span class="search_item_name">帮助主题:</span><span class="search_item_input"><?php echo CHtml::textField("help_type",$help_type,array("id"=>"help_type")) ?></span></div>
       	  <div class="search_item"><span class="search_item_name">帮助标题/帮助内容:</span><span class="search_item_input"><?php echo CHtml::textField("title",$title,array("id"=>"title")) ?></span></div>
       	  
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?>
       </div>
       		  
		<div class="show_search_content">
       		  
			<div class="show_search_text">
				<?php 
					$form=$this->beginWidget(
						'CActiveForm', 
						array(
							'id'=>'help_form',
							'action'=> $this->createUrl("delete"),
							'enableAjaxValidation'=>false,
						)
					);
				?>
				<div class="operate_all">
					<a href="javascript:submit_form('help_form');">删除所选</a>
					<a href='<?php echo $this->createUrl("help/index")?>'>查看所有</a>
				</div>
				<?php 
					$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$model->search(),
					'ajaxUpdate'=>false,
					'pager'=>array('class'=>'LinkListPager'),

					//'filter'=>$model,
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
							'name'=>'title',
							'type'=>'raw',
							'value'=>'CHtml::link(CHtml::encode("$data->title"), $data->get_edit_url())'
						),
						array(
							'name'=>'type',
							'type'=>'raw',
							'value'=>'CHtml::link(CHtml::encode($data->type->name), $data->get_type_url())',
						),
						array(
							'name'=>'create_time',
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
