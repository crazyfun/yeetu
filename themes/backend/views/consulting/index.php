<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("consulting/index");?>">返回到在线咨询</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchtinfor-form',
          'action'=>$this->createUrl("consulting/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">线路名称:</span><span class="search_item_input"><?php echo CHtml::textField("trave_name",$trave_name);?></span></div><div class="search_item"><span class="search_item_name">咨询内容/回复内容:</span><span class="search_item_input"><?php echo CHtml::textField("consulting_title",$consulting_title);?></span></div>
       	  <div class="search_item"><span class="search_item_name">咨询人:</span><span class="search_item_input"><?php echo CHtml::textField("create_name",$create_name);?></span></div>
       	  <div class="search_item"><span class="search_item_name">回复人:</span><span class="search_item_input"><?php echo CHtml::textField("reply_name",$reply_name);?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	   <div class="operate_all"><a href="javascript:submit_form('deletetconsulting-form');">删除所有</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetconsulting-form',
          					'action'=> $this->createUrl("delete",array()),
	        					'enableAjaxValidation'=>false,
       						 )); ?>

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
                       'name'=>"trave_id",
                       'type'=>'raw',
                       'value'=>'$data->Trave->preview_trave()'
                     ),
                     array(
                       'name'=>"consulting_email",
                       'type'=>'raw',
                       'value'=>'$data->consulting_email'
                     ),  
                     array(
                       'name'=>"consulting_content",
                       'type'=>'raw',
                       'value'=>'Util::cs($data->consulting_content,30)'
                     ),
                     
                     
                     array(
                       'name'=>"reply_content",
                       'type'=>'raw',
                       'value'=>'Util::cs($data->reply_content,30)'
                     ),
                     
                     array(
                       'name'=>"reply_id",
                       'type'=>'raw',
                       'value'=>'$data->get_reply_name()'
                     ),
                     
                     array(
                       'name'=>"reply_time",
                       'type'=>'raw',
                       'value'=>'$data->converse_reply_date()'
                     ),
                     
                     
                     array(
                       'name'=>"create_id",
                       'type'=>'raw',
                       'value'=>'$data->get_create_name()'
                     ),
                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'$data->converse_date()'
                     ),
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_consulting_operate()'
                     ), 
                   ),
                  )); ?>
        				<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

