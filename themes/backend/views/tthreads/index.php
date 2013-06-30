
<div id="page_content">
    <div class="show_right_content">
    	<!--没-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("tthreads/index");?>">返回到线路游记/攻略管理</a></span><span><a href="<?php echo $this->createUrl("tthreads/add",array());?>">增加线路游记/攻略</a></span></div></div>
    	
    	<div class="search_content">
       	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'searchthreads-form',
          'action'=>$this->createUrl("",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
       	  <?php echo CHtml::hiddenField("id",$model->id);?>
       	  <div class="search_item"><span class="search_item_name">线路名称:</span><span class="search_item_input">
           <?php 
                echo CHtml::hiddenField("trave_id",$trave_id,array('id'=>'trave_id'));
                echo CHtml::textField('trave_name',$trave_name,array('id'=>'select_trave_name','autocomplete'=>'off'));
		       ?>
       	  </span></div>
       	  <div class="search_item"><span class="search_item_name">游记/攻略名称:</span><span class="search_item_input">
           <?php 
               
                echo CHtml::textField('title',$title,array('id'=>'title'));
		       ?>
       	  </span></div>
       	  <div class="search_button"><span class="search_button_submit"><?php echo CHtml::submitButton("submit",array("name"=>"search_submit","id"=>"search_submit","value"=>"搜索"));?></span><span class="search_button_reset"><?php echo CHtml::resetButton("reset",array("name"=>"search_reset","id"=>"search_reset","value"=>"重置"));?></span></div><div class="clear_both"></div>
       	<?php $this->endWidget(); ?> 
       </div>
       
       
       
    	<!--淼?-->
       <div class="search_content">

       </div>
       <!--示-->
       <div class="show_search_content">
       	   <!--示牡-->
       	   <div class="show_search_text">
       	   	  <div class="operate_all"><a  href="javascript:submit_form('deletethreads-form');">删除所有</a></div>
       	   	    <?php $form=$this->beginWidget('CActiveForm', array(
	        					'id'=>'deletethreads-form',
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
                       'value'=>'$data->Trave->trave_name'
                      ),
                     
                      array(
                       'name'=>"title",
                       'type'=>'raw',
                       'value'=>'$data->title'
                     ),
                     array(
                       'name'=>'short_desc',
                       'type'=>'raw',
                       'value'=>'$data->short_desc'
                     ),
                     
                     array(
                       'name'=>"auther",
                       'type'=>'raw',
                       'value'=>'$data->auther'
                     ),
                     
                     array(
                       'name'=>"title_href",
                       'type'=>'raw',
                       'value'=>'$data->title_href'
                      ),

                    

                     array(
                       'name'=>"image_src",
                       'type'=>'raw',
                       'value'=>'$data->get_threads_image()'
                     ),

                     array(
                       'name'=>'sort',
                       'type'=>'raw',
                       'value'=>'$data->sort',
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
                       'value'=>'$data->get_threads_operate()'
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
    
    
    <script language="javascript">
		jQuery(function($) {
	  // Your code using failsafe $ alias here...
    	 jQuery('#select_trave_name').autocomplete({ 
    	  serviceUrl:'/backend.php/main/compeletetrave',
    	  minChars:1, 
    	  delimiter: /(,|;)\s*/, // regex or character
    	  maxHeight:400,
    	  width:490,
    	  zIndex: 9999,
    	  deferRequestBy: 0, //miliseconds
    	 // params: { country:'Yes' }, //aditional parameters
    	  noCache: true, //default is false, set to true to disable caching
    	  // callback function:
    	  onSelect: function(value, data){
    	  	jQuery("#trave_id").val(data.trave_id);
    	  }
    	  // local autosugest options:
   	   //lookup: ['January', 'February', 'March', 'April', 'May'] //local lookup values 
    });
  
   
   jQuery('#select_trave_name').keyup(function(){
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery("#trave_id").val('');
    	   trave_id='';
    	   trave_category='';
    	   free_package='';
      }	
  	
    });
    
  });
</script>

