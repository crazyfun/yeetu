
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("nianhui/travearea",array("trave_id"=>$model->trave_id));?>">返回到国内机+酒景区</a></span><span><a href="<?php echo $this->createUrl("nianhui/addtraveimage",array("trave_id"=>$model->trave_id,"trave_area_id"=>$model->trave_area_id));?>">增加国内机+酒景区图片</a></span></div></div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	   <div class="operate_all"><a href="javascript:submit_form('deletetraveimage-form');">删除所有</a>&nbsp;&nbsp;<a href="<?php echo $this->createUrl("nianhui/addtraveimage",array("trave_id"=>$model->trave_id,"trave_area_id"=>$model->trave_area_id));?>">修改景区图片</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetraveimage-form',
          					'action'=> $this->createUrl("deletetraveimage",array("trave_id"=>$model->trave_id,'trave_area_id'=>$model->trave_area_id)),
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
                       'name'=>"trave_area_id",
                       'type'=>'raw',
                       'value'=>'$data->Trave_area->trave_area'
                     ),

                     array(
                       'name'=>"image_id",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_image()'
                     ),

                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_traveimage_operate()'
                     ), 
                   ),
                  )); ?>
        				<?php $this->endWidget(); ?>

       	   	</div>
       	   	
       	   	<div id="float_big_image">
               <img id="show_big_image"/>
            </div>
       </div> 
    </div>


