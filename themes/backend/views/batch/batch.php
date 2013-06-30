<div id="page_content">
	<div class="show_right_content">
		<div class="show_search_content">
			<div class="show_search_text">
				<div class="operate_result">
					<?php $this->widget("FlashInfo");?>
				</div>
				<div class="user_operate">
					<div class="user_operate_content">
						<span>
							<?php if($this->action->id=="email"){ ?>
							  <a href='<?php echo $this->createUrl("edite");?>'>添加邮件</a>
							<?php }else{ ?>
							  <a href='<?php echo $this->createUrl("editp");?>'>添加短信</a>
							
						  <?php } ?>
							  
						</span>
					</div>
				</div>
				<?php 
				if($this->action->id=="email"){
					$form=$this->beginWidget(
						'CActiveForm', 
						array(
							'id'=>'batch_form',
							'action'=> $this->createUrl("deletee"),
							'enableAjaxValidation'=>false,
						)
					);
				}else{
					$form=$this->beginWidget(
						'CActiveForm', 
						array(
							'id'=>'batch_form',
							'action'=> $this->createUrl("deletep"),
							'enableAjaxValidation'=>false,
						)
					);
					
				}
					
				?>
				
				<div class="operate_all">
					<a href="javascript:submit_form('batch_form');">删除所选</a>
				</div>
				
				<?php 
					$this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$active_data_provider,
				  'ajaxUpdate'=>false,
				  'pager'=>array('class'=>'LinkListPager'),
					'columns'=>array(
					 array(
						  'class'=>'CCheckBoxColumn',
						  'selectableRows' => 2,
						  'checkBoxHtmlOptions' => array('name'=>'id[]'),
					  ),
						array(
							'name'=>'id',
							'type'=>'number',
							'value' => '$data->id',
						),
						array(
							'name'=>'title',
							'type'=>'raw',
							'value'=>'$data->title'
						),
						
						array(
						  'name'=>'create_id',
						  'type'=>'raw',
						  'value'=>'$data->User->user_login'
						),
						
						array(
							'name'=>'create_time',
							'type'=>'raw',
							'value'=>'date("Y-m-d H:i:s", $data->create_time)',
						),
						
						array(
							'name'=>'操作',
							'type'=>'raw',
							'value'=>'$data->get_operate()',
						),
				   )
			
				)); ?>
				<?php 
					$this->endWidget();
				?>
			</div>
		</div>
	</div>
</div>

<script language="javascript">
	 function send_message(message_id,message_type){
  	
  	show_messagedialog(message_id,message_type);
  	
  }
</script>
