<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("gcustomize/index");?>">返回到公司定制管理</a></span><span><a href="<?php echo $this->createUrl("gcustomize/add",array());?>">增加公司定制</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchgcustomize-form',
          'action'=>$this->createUrl("",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">出发时间:</span><span class="search_item_input"><?php echo CHtml::textField("start_time",$start_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $start_time;?>"});'));?></span></div>
       	  
       	  <div class="search_item"><span class="search_item_name">出发城市:</span><span class="search_item_input"><?php echo CHtml::dropDownList("start_region",$start_region,CV::$GROUP_START_REGION,array());?></span></div>
       	  
       	  <div class="search_item"><span class="search_item_name">目的地:</span><span class="search_item_input"><?php echo CHtml::textField("end_region",$end_region,array('id'=>'search_end_region'));?></span></div>
       	  
       	  <div class="search_item"><span class="search_item_name">联系人/联系手机:</span><span class="search_item_input"><?php echo CHtml::textField("contact_name",$contact_name,array('id'=>'search_contact_name'));?></span></div>
       	  
       	  <div class="search_item"><span class="search_item_name">公司名称:</span><span class="search_item_input"><?php echo CHtml::textField("company_name",$company_name,array('id'=>'search_company_name'));?></span></div>
       	  <div class="clear_both"></div>
       	  <div class="search_item"><span class="search_item_name">提交时间:</span><span class="search_item_input"><?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $create_time;?>"});'));?></span></div>

       	  
       	  <div class="search_item"><span class="search_item_name">处理状态:</span><span class="search_item_input"><?php echo CHtml::dropDownList("status",$status,CV::$CUSTOMIZESTATUS,array());?></span></div>
       	  
       	  
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	  <div class="operate_all"><a  href="javascript:submit_form('deletegcustomize-form');">删除所有</a></div>
       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletegcustomize-form',
          					'action'=> $this->createUrl("delete",array()),
	        					'enableAjaxValidation'=>false,
       					  ));  ?>
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
                       'name'=>"contact_name",
                       'type'=>'raw',
                       'value'=>'$data->contact_name'
                     ),
                      array(
                       'name'=>"contact_phone",
                       'type'=>'raw',
                       'value'=>'$data->contact_phone'
                      ),
                     array(
                       'name'=>"contact_tel",
                       'type'=>'raw',
                       'value'=>'$data->contact_tel'
                     ), 
                      array(
                       'name'=>"contact_email",
                       'type'=>'raw',
                       'value'=>'$data->contact_email'
                     ), 
                      array(
                       'name'=>"reply_time",
                       'type'=>'raw',
                       'value'=>'$data->get_reply_time()'
                     ),
                     
                     array(
                       'name'=>"company_name",
                       'type'=>'raw',
                       'value'=>'$data->company_name'
                     ),
                     
                     
                     array(
                       'name'=>"start_region",
                       'type'=>'raw',
                       'value'=>'$data->get_start_region()'
                     ),
                     
                     
                     array(
                       'name'=>"end_region",
                       'type'=>'raw',
                       'value'=>'$data->end_region'
                     ),
                     
                     array(
                       'name'=>"start_time",
                       'type'=>'raw',
                       'value'=>'$data->start_time'
                     ),
                     
                     
                     array(
                       'name'=>"adults",
                       'type'=>'raw',
                       'value'=>'$data->adults'
                     ),
                     
                     
                     array(
                       'name'=>"childs",
                       'type'=>'raw',
                       'value'=>'$data->childs'
                     ),
                     
                     
                     array(
                       'name'=>"travel_nums",
                       'type'=>'raw',
                       'value'=>'$data->travel_nums'
                     ),
                     
                     array(
                       'name'=>"travel_budget",
                       'type'=>'raw',
                       'value'=>'$data->travel_budget'
                     ),
                     array(
                       'name'=>"status",
                       'type'=>'raw',
                       'value'=>'$data->get_customize_status()'
                     ),
                     
                     array(
                       'name'=>"operate_id",
                       'type'=>'raw',
                       'value'=>'$data->OUser->user_login'
                     ),
                     
                     
                     array(
                       'name'=>"operate_time",
                       'type'=>'raw',
                       'value'=>'empty($data->operate_time)?"":date("Y-m-d",$data->operate_time)'
                     ),

                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),
                     
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_customize_operate()'
                      ), 

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

