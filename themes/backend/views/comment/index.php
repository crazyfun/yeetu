<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("comment/index");?>">返回到评论管理</a></span></div></div>
    	<!--淼?-->
       <div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchcomment-form',
          'action'=>$this->createUrl("comment/search",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">线路名称:</span><span class="search_item_input"><?php echo CHtml::textField("trave_name",$trave_name,array('id'=>'search_trave_name'));?></span></div>
          <div class="search_item"><span class="search_item_name">乱评论:</span><span class="search_item_input"><?php echo CHtml::checkBox("shit_comment",$shit_comment,array('value'=>'1')); ?></span></div>
          <div class="search_item"><span class="search_item_name">评论时间:</span><span class="search_item_input"><?php echo CHtml::textField("create_time",$create_time,array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"<?php echo $create_time; ?>",readOnly:true});'));?></span></div>
          <div class="clear_both"></div>
       	  <div class="search_item"><span class="search_item_name">总体评分:</span><span class="search_item_input"><?php echo CHtml::dropDownList("comment_total",$comment_total,CV::$SEARCH_RATING_VALUES,array());?></span></div>
       	  <div class="search_item"><span class="search_item_name">景点评分:</span><span class="search_item_input"><?php echo CHtml::dropDownList("comment_scape",$comment_scape,CV::$SEARCH_RATING_VALUES,array());?></span></div>
          <div class="search_item"><span class="search_item_name">购物评分:</span><span class="search_item_input"><?php echo CHtml::dropDownList("comment_shop",$comment_shop,CV::$SEARCH_RATING_VALUES,array());?></span></div>
          <div class="search_item"><span class="search_item_name">住宿评分:</span><span class="search_item_input"><?php echo CHtml::dropDownList("comment_stay",$comment_stay,CV::$SEARCH_RATING_VALUES,array());?></span></div>
          <div class="search_item"><span class="search_item_name">用餐评分:</span><span class="search_item_input"><?php echo CHtml::dropDownList("comment_dining",$comment_dining,CV::$SEARCH_RATING_VALUES,array());?></span></div>
          <div class="search_item"><span class="search_item_name">车辆评分:</span><span class="search_item_input"><?php echo CHtml::dropDownList("comment_cat",$comment_cat,CV::$SEARCH_RATING_VALUES,array());?></span></div>
          <div class="search_item"><span class="search_item_name">导游评分:</span><span class="search_item_input"><?php echo CHtml::dropDownList("comment_guide",$comment_guide,CV::$SEARCH_RATING_VALUES,array());?></span></div>
          <div class="search_item"><span class="search_item_name">客服评分:</span><span class="search_item_input"><?php echo CHtml::dropDownList("comment_server",$comment_server,CV::$SEARCH_RATING_VALUES,array());?></span></div>

       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	  <div class="operate_all"><a  href="javascript:submit_form('deletecomment-form');">删除所有</a></div>
       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletecomment-form',
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
                       'name'=>"trave_id",
                       'type'=>'raw',
                       'value'=>'$data->Trave->preview_trave()'
                     ),
                     
                     array(
                       'name'=>"comment_total",
                       'type'=>'raw',
                       'value'=>'$data->get_trave_admin_satisfied()'
                      ),
                      
                      
                      array(
                       'name'=>"comment_content",
                       'type'=>'raw',
                       'value'=>'$data->comment_content'
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
                       'value'=>'$data->get_comment_operate()'
                      ), 

                   ),
                  )); ?>
               	<?php $this->endWidget(); ?>
       	   	</div>
       </div> 
    </div>

