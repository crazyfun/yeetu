<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("tinfor/theme");?>">返回到旅游资讯主题</a></span><span><a href="<?php echo $this->createUrl("tinfor/addtheme",array());?>">增加旅游资讯主题</a></span></div></div>

       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	   <div class="operate_all"><a href="javascript:submit_form('deletetinfor-form');">删除所有</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetinfor-form',
          					'action'=> $this->createUrl("deletetheme",array()),
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
                       'name'=>"theme_name",
                       'type'=>"raw",
                       'value'=>'$data->theme_name'
                     ),

                     array(
                       'name'=>"create_id",
                       'type'=>'raw',
                       'value'=>'$data->User->user_login'
                     ),
                     array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'$data->converse_date()'
                     ),
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_infortheme_operate()'
                     ), 
                   ),
                  )); ?>
        				<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

