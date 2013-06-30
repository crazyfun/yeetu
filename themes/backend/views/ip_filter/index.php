<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("ip_filter/add");?>">增加限制IP</a></span></div></div>
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
                       'name'=>"ip_address",
                       'type'=>'raw',
                     ),
                      array(
                       'name'=>"expire_time",
                       'type'=>'raw',
					   'value'=>'$data->expire_time==0?(CV::$IP_NEVER_EXPIRE):date("Y-m-d H:i:s",$data->expire_time)'
                      ),
                      array(
                       'name'=>"create_time",
                       'type'=>'raw',
                       'value'=>'date("Y-m-d H:i:s",$data->create_time)'
                     ),
					 array(
						'name'=>"status",
						'type'=>'raw',
						'value'=>'CV::$IP_STATUS[$data->status]'
					 ),
					 array(
						'name'=>"create_id",
						'type'=>'raw',
						'value'=>'$data->User->user_login'
					 ),
                     array(
                       'name'=>"操作",
                       'type'=>'raw',
                       'value'=>'$data->get_ip_operate()'
                      ),
                   ),
                  )); ?>
       	   	</div>
    </div>

