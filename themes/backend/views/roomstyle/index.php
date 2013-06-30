
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("roomstyle/index");?>">返回到房型管理</a></span><span><a href="<?php echo $this->createUrl("roomstyle/add",array());?>">增加房型</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchroomstyle-form',
          'action'=>$this->createUrl("roomstyle/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">房型名:</span><span class="search_item_input"><?php echo CHtml::textField("room_style",$room_style,array('id'=>'search_room_style'));?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	<!--
       	   	  <div class="operate_all"><a  href="javascript:submit_form('deleteroomstyle-form');">删除所有</a></div>
       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deleteroomstyle-form',
          					'action'=> $this->createUrl("delete",array()),
	        					'enableAjaxValidation'=>false,
       					  ));  ?>
       			-->
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$model->searchdatas(),
                  'columns'=>array(
                  /*
                    array(
                       "name"=>CHtml::checkBox("allcheck","",array("id"=>"allcheck","onclick"=>"javascript:selectallcheck();")),
                       'type'=>'raw',
                       "value"=>'CHtml::checkBox("id[]","",array("class"=>"itemcheckbox","value"=>$data->id))'
                     ),
                     */
                     array(
                       'name'=>"id",
                       'type'=>"raw",
                       'value'=>'$data->id'
                     ),
                     array(
                       'name'=>"room_style",
                       'type'=>'raw',
                       'value'=>'$data->room_style'
                     ),
                      array(
                       'name'=>"room_style_desc",
                       'type'=>'raw',
                       'value'=>'$data->room_style_desc'
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
                       'value'=>'$data->get_room_style_operate()'
                      ), 
                   ),
                  )); ?>
               	<!--<?php $this->endWidget(); ?>-->
       	   	</div>
       </div> 
    </div>

