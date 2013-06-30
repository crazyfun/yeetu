<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("tinfor/index");?>">返回到旅游资讯</a></span><span><a href="<?php echo $this->createUrl("tinfor/add",array());?>">增加旅游资讯</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchtinfor-form',
          'action'=>$this->createUrl("tinfor/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">资讯名称:</span><span class="search_item_input"><?php echo CHtml::textField("information_title",$model->information_title);?></span></div>
       	   <div class="search_item"><span class="search_item_name">发布人:</span><span class="search_item_input"><?php echo CHtml::textField("create_name",$create_name);?></span></div><div class="search_item"><span class="search_item_name">资讯主题:</span><span class="search_item_input"><?php  $infor_theme=new InforTheme();$select_value=$infor_theme->get_infor_theme_select(); echo CHtml::dropDownList("information_theme",$information_theme,$select_value,array());?></span></div>
       	   <div class="search_item"><span class="search_item_name">推荐资讯:</span><span class="search_item_input"><?php echo CHtml::checkBox("information_recommend",$information_recommend,array('value'=>'1'));?>推荐</span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	   <div class="operate_all"><a href="javascript:submit_form('deletetinfor-form');">删除所有</a></div>
       	   	    	<?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletetinfor-form',
          					'action'=> $this->createUrl("delete",array()),
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
                       'name'=>"information_sort",
                       'type'=>'raw',
                       'value'=>'$data->information_sort'
                     ),
                     
                     
                      array(
                       'name'=>"information_theme",
                       'type'=>'raw',
                       'value'=>'$data->get_infor_theme()'
                     ),
                     
                     
                     array(
                       'name'=>"information_title",
                       'type'=>'raw',
                       'value'=>'$data->information_title'
                     ), 
                     
                      array(
                       'name'=>"information_desc",
                       'type'=>'raw',
                       'value'=>'$data->information_desc'
                     ), 
                     
                      
                     array(
                       'name'=>"information_content",
                       'type'=>'raw',
                       'value'=>'Util::cs($data->information_content,30)'
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
                       'value'=>'$data->get_tinfor_operate()'
                     ), 
                   ),
                  )); ?>
        				<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

