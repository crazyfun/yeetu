<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("coupon/index");?>">返回到抵用劵管理</a></span><span><a href="<?php echo $this->createUrl("coupon/add",array());?>">增加抵用劵</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchcoupon-form',
          'action'=>$this->createUrl("coupon/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">抵用劵编号:</span><span class="search_item_input"><?php echo CHtml::textField("coupon_number",$config_name,array('id'=>'search_coupon_number'));?></span></div>
       	  
       	  <div class="search_item"><span class="search_item_name">抵用劵使用:</span><span class="search_item_input"><?php echo CHtml::dropDownList("coupon_status",$coupon_status,array(''=>'抵用劵使用','1'=>'未使用','2'=>'已使用'),array('id'=>'search_coupon_number'));?></span></div>
       	  
       	  <div class="search_item"><span class="search_item_name">抵用劵使用时间:</span><span class="search_item_input"><?php echo CHtml::textField("user_time",$user_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"'.$user_time.'"});', 'class'=>'htj_table_input'));?></span></div>
       	  
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	  <div class="operate_all"><a  href="javascript:submit_form('deletecoupon-form');">删除所有</a></div>
       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletecoupon-form',
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
                       'name'=>"coupon_number",
                       'type'=>'raw',
                       'value'=>'$data->coupon_number'
                     ),
                      array(
                       'name'=>"coupon_desc",
                       'type'=>'raw',
                       'value'=>'$data->coupon_desc'
                      ),
                     array(
                       'name'=>"coupon_price",
                       'type'=>'raw',
                       'value'=>'$data->coupon_price'
                     ), 
                     
                     array(
                        'name'=>"expiration_date",
                        'type'=>'raw',
                        'value'=>'$data->expiration_date'
                     ),
                     array(
                       'name'=>"coupon_status",
                       'type'=>'raw',
                       'value'=>'$data->get_coupon_status()'
                     ),
                     
                     array(
                       'name'=>"user_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->user_time)'
                     ),
                      array(
                       'name'=>"create_id",
                       'type'=>'raw',
                       'value'=>'$data->User->user_login'
                     ), 
                      array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_coupon_operate()'
                      ), 

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

