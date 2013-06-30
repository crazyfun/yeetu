<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("user/cconsume");?>">返回到抵用劵明细</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchconsume-form',
          'action'=>'',
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">用户名:</span><span class="search_item_input"><?php echo CHtml::textField("user_login",$user_login,array('id'=>'search_user_login'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">操作动作:</span><span class="search_item_input"><?php echo CHtml::dropDownList("coupon_type",$coupon_type,CV::$CREDIT_TYPE,array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">操作描述:</span><span class="search_item_input"><?php echo CHtml::textField("coupon_desc",$coupon_desc,array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">消费类型:</span><span class="search_item_input"><?php echo CHtml::dropDownList("coupon_category",$coupon_category,CV::$COUPON_CATEGORY,array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">抵用劵编号:</span><span class="search_item_input"><?php echo CHtml::textField("coupon_number",$coupon_number,array());?></span></div><div class="clear_both"></div>
       	  <div class="search_item"><span class="search_item_name">操作时间:</span><span class="search_item_input"><?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $create_time; ?>",readOnly:true});'));?></span></div>
       	  
       	  
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$model->searchdatas(),
				  'ajaxUpdate'=>false,
				  'pager'=>array('class'=>'LinkListPager'),
                  'columns'=>array(
                     array(
                       'name'=>"id",
                       'type'=>"raw",
                       'value'=>'$data->id'
                     ),
                     
                      array(
                       'name'=>"coupon_category",
                       'type'=>'raw',
                       'value'=>'$data->get_coupon_category()'
                     ),
                     
                     array(
                       'name'=>"抵用劵编号",
                       'type'=>'raw',
                       'value'=>'$data->Coupon->coupon_number'
                     ),
                     
                     
                     array(
                       'name'=>"coupon_type",
                       'type'=>'raw',
                       'value'=>'$data->get_coupon_type()'
                     ),
                      array(
                       'name'=>"coupon_before",
                       'type'=>'raw',
                       'value'=>'$data->coupon_before'
                      ),
                     array(
                       'name'=>"coupon_value",
                       'type'=>'raw',
                       'value'=>'$data->coupon_value'
                     ), 
                     array(
                       'name'=>"coupon_after",
                       'type'=>'raw',
                       'value'=>'$data->coupon_after'
                     ), 
                     
                     array(
                       'name'=>"抵用劵",
                       'type'=>'raw',
                       'value'=>'$data->User->coupon'
                     ), 

                     array(
                       'name'=>"coupon_desc",
                       'type'=>'raw',
                       'value'=>'$data->coupon_desc'
                     ), 
                     
                      array(
                       'name'=>"user_id",
                       'type'=>'raw',
                       'value'=>'$data->User->user_login'
                     ), 
                     
                     array(
                       'name'=>"create_id",
                       'type'=>'raw',
                       'value'=>'$data->get_user_login($data->create_id)'
                     ),
                     
                     
                      array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),


                   ),
                  )); ?>
               	
       	   	</div>
       </div> 
    </div>

