<div id="page_content">
	<div class="show_right_content">
		<div class="show_search_content">
			<div class="show_search_text">
				<div class="operate_result">
					<?php $this->widget("FlashInfo");?>
				</div>
				<div class="user_operate">
					<div class="user_operate_content">
						<span><a href='<?php echo $this->createUrl("add");?>'>添加邮件模板</a></span>
					</div>
				</div><!-- /.user_operate -->
				<?php 
				/*
					$form=$this->beginWidget(
						'CActiveForm', 
						array(
							'id'=>'email_template_form',
							'action'=> $this->createUrl("delete"),
							'enableAjaxValidation'=>false,
						)
					);
					*/
				?>
				<!-- 
				<div class="operate_all">
					<a href="javascript:submit_form('email_template_form');">删除所选</a>
				</div>
				 -->
				<?php 
					$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$model->search(),
				  'ajaxUpdate'=>false,
				  'pager'=>array('class'=>'LinkListPager'),
					'columns'=>array(
						array(
							'name'=>'id',
							'type'=>'number',
							'value' => '$data->id',
						),
						array(
							'name'=>'email_templates_name',
							'type'=>'raw',
							'value'=>'CHtml::link(CHtml::encode("$data->email_templates_name"), Yii::app()->controller->createUrl("edit", array("id"=>$data->id)))'
						),
						array(
							'name'=>'create_time',
							'type'=>'raw',
							'value'=>'date("Y-m-d H:i:s", $data->create_time)',
						),
						array(
							'header' => '模板类型',
							'type' => 'text',
							'value' => '$data->create_id != 0 ? "自定义" : "系统自带"',
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
									'visible' => '$data->create_id != 0', //隐藏系统自带的模板删除链接
									'options' => array('onclick' => 'return confirm("你确定要删除这个邮件模板吗？")','class'=>'operate_dbutton'),
								)
							),
						)
					),
				)); ?>
				<p style="text-align: right">模板类型为系统的不能被删除</p>
				<?php 
					/*$this->endWidget();*/
				?>
			</div><!-- /.show_search_text -->
		</div><!-- /.show_search_content -->
	</div><!-- /.show_right_content -->
</div><!-- /#page_content -->
