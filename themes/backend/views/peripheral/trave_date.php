<div id="page_content">
    <div class="show_right_content">
    	
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("peripheral/index");?>">返回到周边游</a></span><span><a href="<?php echo $this->createUrl("peripheral/addtravedate",array("trave_id"=>$model->trave_id));?>">增加周边游时间</a></span></div></div>

    	<!--淼?-->
       <div class="search_content">
       	
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchtravedate-form',
          'action'=>$this->createUrl("peripheral/searchtravedate",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("trave_id",$model->trave_id);?>
       	  <div class="search_item"><span class="search_item_name">线路出发时间:</span><span class="search_item_input"><?php echo CHtml::textField("start_date",$start_date,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy/M/dd",isShowWeek:true,startDate:"<?php echo $start_date;?>"});'));?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?>
       </div>
       
       <!--示-->
       <div class="show_search_content">

       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	   <div class="operate_all"><a href="javascript:submit_form('deletetravedate-form');">删除所有</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetravedate-form',
          					'action'=> $this->createUrl("deletetravedate",array("trave_id"=>$model->trave_id)),
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
                       'value'=>'$data->Trave->trave_name'
                     ),
                     
                     array(
                       'name'=>"trave_date",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_date_name()'
                     ),
                     
                     
                     array(
                       'name'=>"trave_price",
                       'type'=>'raw',
                       'value'=>'$data->get_price_detals()'
                     ),
                     
                    array(
                       'name'=>"seats",
                       'type'=>'raw',
                       'value'=>'$data->seats'
                     ),

                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'$data->converse_date()'
                     ),
                     
                     
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_travedate_operate()'
                     
                     ), 
                   
                     
                   ),
                  )); ?>
        				<?php $this->endWidget(); ?>

       	   	</div>

       	
       </div> 
    	
    	
    </div>








