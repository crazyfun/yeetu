
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("setfenzhan/index");?>">返回到分站列表</a></span><span><a href="<?php echo $this->createUrl("setfenzhan/add",array());?>">增加分站</a></span></div></div>

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
                       'name'=>"region_id",
                       'type'=>'raw',
                       'value'=>'$data->District->district_name',
                     ),
           
                     array(
                       'name'=>'status',
                       'type'=>'raw',
                       'value'=>'$data->get_status()',
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
                       'value'=>'$data->get_fenzhan_operate()'
                      ), 

                   ),
                  )); ?>
 
       	   	</div>
       </div> 
    </div>

