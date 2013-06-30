
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("ad/index");?>">返回到广告管理</a></span><span><a href="<?php echo $this->createUrl("ad/add",array());?>">增加广告</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchad-form',
          'action'=>$this->createUrl("ad/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">出发城市:</span><span class="search_item_input">
       	  	       	  	
       	  	<?php 
                $sregion_datas=Cfenzhan::model()->get_fenzhan_permissions_search();
		            echo CHtml::dropDownList("ad_sregion_id",$ad_sregion_id,$sregion_datas,array());
		       ?>
		     
       	  	</span>
       	  	</div>
       	  <div class="search_item"><span class="search_item_name">广告位:</span><span class="search_item_input"><?php echo CHtml::dropDownList("ad_area_id",$ad_area_id,$model->get_areas_list(),array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">广告类型:</span><span class="search_item_input"><?php echo CHtml::dropDownList("ad_type",$ad_type,CV::$AD_TYPE,array()); ?></span></div>
       	  
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	  <div class="operate_all"><a  href="javascript:submit_form('deletesystem-form');">删除所有</a></div>
       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletesystem-form',
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
                       'name'=>"ad_sregion_id",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_sregion_by_ids()'
                     ),
                      array(
                       'name'=>"ad_area_id",
                       'type'=>'raw',
                       'value'=>'$data->get_ad_area_name()'
                      ),
                     array(
                       'name'=>"ad_type",
                       'type'=>'raw',
                       'value'=>'$data->get_ad_type()'
                     ), 
                     array(
                       'name'=>'ad_content',
                       'type'=>'raw',
                       'value'=>'$data->ad_content',
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
                       'value'=>'$data->get_ad_operate()'
                      ), 

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

