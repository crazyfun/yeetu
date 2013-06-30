<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("importpedit");?>">添加信息</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchphone-form',
          'action'=>$this->createUrl("importp",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">客户名称:</span><span class="search_item_input"><?php echo CHtml::textField("name",$name,array('id'=>'search_name'));?></span></div>
          <div class="search_item"><span class="search_item_name">联系方式:</span><span class="search_item_input"><?php echo CHtml::textField("phone",$phone,array('id'=>'search_phone')); ?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	  <div class="operate_all"><a href="javascript:submit_form('batch_form');">删除所选</a>&nbsp;&nbsp;<a href="javascript:excel_import('ImportPhone');"><img alt="" width="100" height="15" src="/css/images/excel.gif" style="border: 0pt none;"></a></div>
       	   	    <?php 
			
					        $form=$this->beginWidget('CActiveForm', array(
							       'id'=>'batch_form',
							       'action'=> $this->createUrl("importpdelete"),
							       'enableAjaxValidation'=>false,
						        )
					        );
				
				?>
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
							'type'=>'raw',
							'value' => '$data->name',
						),
						array(
							'name'=>'phone',
							'type'=>'raw',
							'value'=>'$data->phone'
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




