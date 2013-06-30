<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("user/index");?>">返回到会员管理</a></span><span><a href="<?php echo $this->createUrl("user/add",array());?>">增加会员</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchuser-form',
          'action'=>$this->createUrl("user/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">用户名:</span><span class="search_item_input"><?php echo CHtml::textField("user_login",$user_login,array('id'=>'search_user_login'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">手机号码:</span><span class="search_item_input"><?php echo CHtml::textField("user_phone",$user_phone,array('id'=>'search_user_phone'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">激活:</span><span class="search_item_input"><?php echo CHtml::dropDownList("user_active",$user_active,array(''=>'是否激活','1'=>'未激活','2'=>'已激活'),array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">管理员:</span><span class="search_item_input"><?php echo CHtml::dropDownList("status",$status,array(''=>'是否是管理员','1'=>'普通用户','2'=>'管理员'),array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">用户等级:</span><span class="search_item_input"><?php echo CHtml::dropDownList("level",$level,CV::$USER_LEVEL,array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">注册时间:</span><span class="search_item_input"><?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $create_time; ?>",readOnly:true});'));?></span></div>
       	  
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
                       'name'=>"user_login",
                       'type'=>'raw',
                       'value'=>'$data->user_login'
                     ),
                      array(
                       'name'=>"email",
                       'type'=>'raw',
                       'value'=>'$data->email'
                      ),
                     array(
                       'name'=>"user_phone",
                       'type'=>'raw',
                       'value'=>'$data->user_phone'
                     ), 
                      array(
                       'name'=>"real_name",
                       'type'=>'raw',
                       'value'=>'$data->real_name'
                     ), 

                      array(
                       'name'=>"nice_name",
                       'type'=>'raw',
                       'value'=>'$data->nice_name'
                     ), 
                     
                      array(
                       'name'=>"user_sex",
                       'type'=>'raw',
                       'value'=>'$data->get_user_sex()'
                     ), 
                      array(
                       'name'=>"user_active",
                       'type'=>'raw',
                       'value'=>'$data->get_user_active()'
                     ),  
                     array(
                       'name'=>"coupon",
                       'type'=>'raw',
                       'value'=>'$data->coupon'
                     ), 
                     array(
                       'name'=>"credit",
                       'type'=>'raw',
                       'value'=>'$data->credit'
                     ), 
                     array(
                       'name'=>"level",
                       'type'=>'raw',
                       'value'=>'$data->get_user_level()'
                     ), 
                      array(
                       'name'=>"status",
                       'type'=>'raw',
                       'value'=>'$data->get_user_status()'
                     ),   
                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_user_operate()'
                     ), 
                   ),
                  )); ?>
        				
       	   	</div>
       </div> 
    </div>

