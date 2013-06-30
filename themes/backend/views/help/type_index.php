<div id="page_content">
	<div class="show_right_content">
	
		<div class="user_operate">
			<div class="user_operate_content">
				<span><a href='<?php echo $this->createUrl("help/type_add");?>'>添加帮助类别</a></span>
			</div>
		</div><!-- /.user_operate -->
				
     <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchtrave-form',
          'action'=>$this->createUrl("",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
          <div class="search_item"><span class="search_item_name">帮助主题:</span><span class="search_item_input"><?php echo CHtml::textField("type_name",$type_name,array("id"=>"type_name")) ?></span></div>       	  
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?>
       </div>
       				
		<div class="show_search_content">
			<div class="show_search_text">
				<div class="operate_all">
					<a  href="javascript:submit_form('helptype_form');">删除所选</a>
				</div>
				<?php 
					$form=$this->beginWidget(
						'CActiveForm', 
						array(
							'id'=>'helptype_form',
							'action'=> $this->createUrl("delete"),
							'enableAjaxValidation'=>false,
						)
					);
				?>
				<?php 
					$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$model->search(),
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
							'name'=>'name',
							'type'=>'raw',
							'value'=>'CHtml::link(CHtml::encode($data->name), $data->get_edit_url())'
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
