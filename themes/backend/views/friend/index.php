<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("friend/add");?>">增加友情链接</a></span></div></div>
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
                  <?php $this->widget('zii.widgets.grid.CGridView', array(
                  'dataProvider'=>$dataProvider,
				  'ajaxUpdate'=>false,
				  'pager'=>array('class'=>'LinkListPager'),
                  'columns'=>array(
                     array(
                       'name'=>"id",
                       'type'=>"raw",
                     ),
                     array(
                       'name'=>"name",
                       'type'=>'raw',
                     ),
                      array(
                       'name'=>"link",
                       'type'=>'raw',
                      ),
					  array(
                       'name'=>"display",
                       'type'=>'raw',
                      ),
                      array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_friend_operate()'
                      ),
                   ),
                  )); ?>
       	   	</div>
    </div>

