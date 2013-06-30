<div id="page_content">
    <div class="show_right_content">
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchsystem-form',
          'action'=>$this->createUrl("",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">关键字:</span><span class="search_item_input"><?php echo CHtml::textField("search_content",$search_content,array('id'=>'search_search_content'));?></span></div>
       	  <div class="search_item"><span class="search_item_name">IP/地址:</span><span class="search_item_input"><?php echo CHtml::textField("search_ip",$search_ip,array('id'=>'search_search_ip'));?></span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	  <div class="operate_all"><a  href="javascript:submit_form('deletekeywords-form');">删除所有</a></div>
       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletekeywords-form',
          					'action'=> $this->createUrl("deletek",array()),
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
                       'name'=>"search_content",
                       'type'=>'raw',
                       'value'=>'$data->search_content'
                     ),
                      array(
                       'name'=>"search_nums",
                       'type'=>'raw',
                       'value'=>'$data->search_nums'
                      ),
                     array(
                       'name'=>"search_ip",
                       'type'=>'raw',
                       'value'=>'$data->search_ip'
                     ), 
                      array(
                       'name'=>"search_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->search_time)'
                     ), 
                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

