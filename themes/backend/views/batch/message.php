<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchmessage-form',
          'action'=>$this->createUrl("batch/message",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	
       	  <div class="search_item"><span class="search_item_name">主题:</span><span class="search_item_input"><?php echo CHtml::textField("title",$title,array('id'=>'search_title'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">定制时间:</span><span class="search_item_input"><?php echo CHtml::textField("custom_date",$custom_date,array('onclick'=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"'.$custom_date.'"});'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">发送对象:</span><span class="search_item_input"><?php echo CHtml::textField("message",$message,array('id'=>'search_message'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">信息类型:</span><span class="search_item_input"><?php echo CHtml::dropDownList("batch_type",$batch_type,CV::$SEARCH_BATCH_TYPE,array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">发送状态:</span><span class="search_item_input"><?php echo CHtml::dropDownList("status",$status,array(''=>'发送状态','1'=>'未发送','2'=>'已发送'),array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">全部发送:</span><span class="search_item_input"><?php echo CHtml::dropDownList("is_all",$is_all,array(''=>'是否全部发送','1'=>'不是','2'=>'是'),array());?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	  <div class="operate_all"><a  href="javascript:submit_form('deletemessage-form');">删除所有</a></div>
       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletemessage-form',
          					'action'=> $this->createUrl("deletem",array()),
	        					'enableAjaxValidation'=>false,
       					  ));  ?>
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
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
                       'name'=>"id",
                       'type'=>"raw",
                       'value'=>'$data->id'
                     ),
                     array(
                       'name'=>"message",
                       'type'=>'raw',
                       'value'=>'$data->message'
                     ),
                      array(
                       'name'=>"batch_type",
                       'type'=>'raw',
                       'value'=>'CV::$BATCH_TYPE[$data->batch_type]'
                      ),
                      array(
                       'name'=>"title",
                       'type'=>'raw',
                       'value'=>'$data->title'
                     ), 
                      array(
                       'name'=>"status",
                       'type'=>'raw',
                       'value'=>'$data->get_status()'
                     ),
                     
                     array(
                       'name'=>"is_all",
                       'type'=>'raw',
                       'value'=>'$data->get_all()'
                     ),
                     array(
                       'name'=>"custom_date",
                       'type'=>'raw',
                       'value'=>'$data->custom_date'
                     ),
                     array(
                       'name'=>"send_date",
                       'type'=>'raw',
                       'value'=>'empty($data->send_date)?"":date("Y-m-d H:i:s",$data->send_date)'
                     ),
                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_message_operate()'
                      ), 

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

