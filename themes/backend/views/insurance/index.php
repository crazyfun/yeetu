<div id="page_content">
	<div class="show_right_content">
		<div class="show_search_content">
			<div class="show_search_text">
				<div class="operate_result">
					<?php $this->widget("FlashInfo");?>
				</div>
				<div class="user_operate">
					<div class="user_operate_content">
						<span><a href='<?php echo $this->createUrl("add");?>'>添加保险</a></span>
					</div>
				</div><!-- /.user_operate -->
				<?php 
				
					$form=$this->beginWidget(
						'CActiveForm', 
						array(
							'id'=>'insurance',
							'action'=> $this->createUrl("delete"),
							'enableAjaxValidation'=>false,
						)
					);
					
				?>
				 
				<div class="operate_all">
					<a href="javascript:submit_form('insurance');">删除所选</a>
				</div>
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
							'type'=>'number',
							'value' => '$data->id',
						),
						array(
							'name'=>'insurance_name',
							'type'=>'raw',
							'value'=>'CHtml::link(CHtml::encode("$data->insurance_name"), Yii::app()->controller->createUrl("edit", array("id"=>$data->id)))'
						),
						array(
							'name'=>'insurance_period',
							'type'=>'raw',
							'value'=>'$data->insurance_period',
						),
						array(
							'name'=>'insurance_pice',
							'type'=>'number',
							'value'=>'$data->insurance_pice',
						),
						array(
							'name'=>'create_time',
							'type'=>'raw',
							'value'=>'date("Y-m-d H:i:s", $data->create_time)',
						),
						array(
							'header' => '操作',
							'template' => '{edit} {del}',
							'class' => 'CButtonColumn',
							'buttons' => array(
								'edit' => array(
									'label' => '编辑',
									'url' => 'Yii::app()->controller->createUrl("edit", array("id"=>$data->id))',
									'options' => array('class'=>'operate_button'),
								),
								'del' => array(
									'label' => '删除',
									'url' => 'Yii::app()->controller->createUrl("delete", array("id"=>$data->id))',
									'options' => array('onclick' => 'return confirm("你确定要删除这个保险吗？")','class'=>'operate_dbutton'),
								)
							),
						)
					),
				)); ?>
				<?php 
					$this->endWidget();
				?>
			</div><!-- /.show_search_text -->
		</div><!-- /.show_search_content -->
	</div><!-- /.show_right_content -->
</div><!-- /#page_content -->
