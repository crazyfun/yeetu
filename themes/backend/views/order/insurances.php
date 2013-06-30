
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("order/insurance");?>">返回到订单保险信息</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchsystem-form',
			'action'=>$this->createUrl("order/search1",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">订单ID:</span><span class="search_item_input"><?php echo CHtml::textField("trave_order_id",$trave_order_id,array('id'=>'search_trave_order_id'));?></span></div>
		  <div class="search_item"><span class="search_item_name">线路名称:</span><span class="search_item_input"><?php echo CHtml::textField("trave_name",$trave_name,array('id'=>'search_trave_name'));?></span></div>
		  
		  <div class="search_item"><span class="search_item_name">保险:</span><span class="search_item_input"><?php $insurance=new Insurance(); echo CHtml::dropDownList("insurance_id",$insurance_id,$insurance->get_insurance_datas(),array('id'=>'search_insurance_id'));?></span></div>
		  
		  
		  <div class="search_item"><span class="search_item_name">创建者:</span><span class="search_item_input"><?php echo CHtml::textField("order_user",$order_user,array('id'=>'search_order_user'));?></span></div>
		  <div class="search_item"><span class="search_item_name">联系人:</span><span class="search_item_input"><?php echo CHtml::textField("contact_name",$contact_name,array('id'=>'search_contact_name'));?></span></div>
		  
		  
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        				//	'id'=>'deletesystem-form',
          					'action'=> $this->createUrl("delete",array()),
	        					'enableAjaxValidation'=>false,
       					  ));  ?>
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$model->searchdatas(),
				  'ajaxUpdate'=>false,
				  'pager'=>array('class'=>'LinkListPager'),

                  'columns'=>array(
					 array(
						'name'=>'trave_order_id',
						'type'=>'raw',
						'value'=>'$data->trave_order_id'
					 ),
					 array(
						'name'=>'线路名称',
						'type'=>'raw',
						'value'=>'$data->trave->preview_trave()'
					 ),
					 array(
                       'name'=>'创建者',
                       'type'=>'raw',
                       'value'=>'$data->user->user_login'
                     ),
					 array(
						'name'=>'联系人',
						'type'=>'raw',
						'value'=>'$data->main_contact==1?$data->contact_name."(<font color=red>主要</font>)":$data->contact_name'
					 ),
					 array(
						'name'=>'手机号码',
						'type'=>'raw',
						'value'=>'$data->contact_phone'
					 ),
					 array(
						'name'=>'座机号码',
						'type'=>'raw',
						'value'=>'$data->contact_telephone'
					 ),
					 array(
						'name'=>'联系人地址',
						'type'=>'raw',
						'value'=>'$data->contact_address'
					 ),
					 array(
						'name'=>'性别',
						'type'=>'raw',
						'value'=>'$data->contact_sex==1?"男":"女"'
					 ),

					 array(
						'name'=>'证件类型',
						'type'=>'raw',
						'value'=>'$data->get_contact_code_type()'
					 ),
					 
					 array(
						'name'=>'证件号码',
						'type'=>'raw',
						'value'=>'$data->contact_code'
					 ),
					 
					 array(
						'name'=>'购买保险种类',
						'type'=>'raw',
						'value'=>'$data->get_insurance_datas()'
					 ),
					 
					 array(
						'name'=>'开始时间',
						'type'=>'raw',
						'value'=>'$data->traveorder->start_date'
					 ),

           array(
              'name'=>"create_time",
              'type'=>'raw',
               'value'=>'date("Y-m-d H:i:s",$data->create_time)'
            ),
                     

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

