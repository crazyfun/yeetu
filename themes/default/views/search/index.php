  <div class="around_right">    
     <div class="search_sc">
     	<?php echo CHtml::beginForm(Yii::app()->getController()->createUrl("search/index"),"GET",array("id"=>'searchform'));?>
     	 <div class="t_search_condition">
        <?php
             echo CHtml::hiddenField("trave_route_number",$trave_route_number,array('id'=>'search_trave_route_number'));
             echo CHtml::hiddenField("budget",$budget,array('id'=>'search_budget'));
             //echo CHtml::hiddenField("trave_linetype",$trave_linetype,array('id'=>'search_trave_linetype'));
             echo CHtml::hiddenField("trave_characteristic",$trave_characteristic,array('id'=>"search_trave_characteristic"));
             echo CHtml::hiddenField("advance_flag",$advance_flag,array('id'=>'search_advance_flag'));
             echo CHtml::hiddenField("did",$did,array('id'=>"hidden_fdistrict_id"));
             echo CHtml::hiddenField("tcid",$tcid,array('id'=>'hidden_trave_category'));
             echo CHtml::hiddenField("pdid",$pdid,array('id'=>'hidden_pfdistrict_id'));     		
         ?>
     	 	<div class="d_search_condition">
     	  	<span>出发地：</span><?php echo CHtml::dropDownList("trave_sregion",$trave_sregion,$sregion_datas,array('class'=>'search_sc_select'));?>
        	<span style="width:185px;margin:0;padding:0;"><span>目的地：</span>
        	 <?php echo CHtml::textField("trave_region",$trave_region,array('class'=>'search_sc_input','id'=>'trave_region','readonly'=>"true"));?>
        	 <div class="search_trave_region_content" id="trave_region_content">
                		   	<div class="trave_region_content_top"><img src="/css/images/tn_search_bg1.gif" /></div>
                		   	<div class="trave_region_content_wrapp">
                		   		
                		   		<div class="trave_region_content_close" id="trave_region_content_close"><img src="/css/images/tn_close.gif" /></div>

                           <div class="trave_region_top">
                           	   <div class="trt_item">
                           	   	   <span class="trt_title">线路类型:</span>
                           	   	   <span class="trt_content">
                           	   	   	  <?php echo CHtml::dropDownList("search_trave_category","",CV::$TIP_TRAVE_CATEGORY,array('id'=>"search_trave_category"));?>
                                   </span>
                           	   </div>
                           	   
                           	   <div class="trt_item" id="trt_item_condition">
                           	   	   <span class="trt_title">搜索条件:</span>
                           	   	   <span class="trt_content" id="trt_condition_content">
                           	   	   	
                           	   	   </span>
                           	   </div>
                           	   
                           	   <div class="trave_region_content_cancel" id="trave_region_content_cancel"><a href="javascript:cancel_district();">取消选择</a></div>
       
                           	</div>
                		   	   <div class="trave_region_center" id="trave_region_center">
                		   	   	  
                		   	   	  
                		   	   	   
                		   	   	</div>
                		   	   	
                		   	   	<div class="trave_region_content_bottom" id="trave_region_content_bottom"></div>
                		   	</div>         		   	
                		   </div>   
          </span>      		   
                		   
                		   
        	<span>关键词：</span>
        	    <?php echo CHtml::textField("trave_name",$trave_name,array('class'=>'search_sc_input','id'=>'trave_name_input'));?>
        	<input type="image" src="/css/images/search_bn.gif" class="search_scbtn" /> 
        	
        </div>
        
       </div>
       <div class="t_search_advance">
        <span style="margin-top:12px;margin-left:10px;"><a href="#" class="detailed_infor_down  <?php if($advance_flag) echo "up"; else echo "down";?>" id="detailed_infor_down">高级搜索</a></span>
       </div>
       <div class="clear_float"></div>
       <div class="a_search_condition" id="a_search_condition" style="<?php if($advance_flag) echo "display:block"; else echo "display:none";?>">
        	   <div class="advance_search_item"><span class="search_condition_title">类型：</span>
        	   	<?php $s_trave_category=CV::$SEARCH_TRAVE_CATEGORY; 
        	   	  foreach($s_trave_category as $key => $value){
        	   	?>
        	   	  <span class="search_condition_span <?php if($tcid==$key) echo "search_condition_span_select";?>"><a href="javascript:select_tcid_advance('<?php echo $key;?>','hidden_trave_category');"><?php echo $value;?></a></span>
        	   	<?php } ?>
        	   </div>
        	   <div class="clear_float"></div>
        	   <div class="advance_search_item"><span class="search_condition_title" >价格：</span>
        	   	<?php 
        	   	  $s_budget_datas=CV::$BUDGET_DATAS;
        	   	  foreach($s_budget_datas as $key => $value){  
        	   	?>
        	   	   <span class="search_condition_span <?php if($budget==$key) echo "search_condition_span_select";?>"><a href="javascript:select_advance('<?php echo $key;?>','budget');"><?php echo $value;?></a></span>
        	   	
        	   	<?php
        	   	  }
        	   	?>
        	   </div>
        	   <div class="clear_float"></div>
        	   <div class="advance_search_item"><span class="search_condition_title">天数：</span>
        	   <?php $s_trave_route_number=CV::$TRAVE_ROUTE_NUMBER;
        	      foreach($s_trave_route_number as $key => $value){
        	   ?>
        	     <span class="search_condition_span <?php if($trave_route_number==$key) echo "search_condition_span_select";?>"><a href="javascript:select_advance('<?php echo $key;?>','trave_route_number');"><?php echo $value;?></a></span>
        	   <?php
        	     }
        	   ?>
        	  </div>	
        	  <div class="clear_float"></div>
        	  <div class="advance_search_item"><span class="search_condition_title">特色：</span>
				<div class="tese_cds">
        	  	<?php
        	  	   $category=new Category();
        	  	   $t_trave_characteristic=$category->get_trave_characteristic();
        	  	   $trave_characteristic_arr=array();
        	  	   if(!empty($trave_characteristic))
        	  	     $trave_characteristic_arr=explode(',',$trave_characteristic);
        	  	   foreach($t_trave_characteristic as $key => $value){
        	  	?>
        	  	   <span class="search_condition_span <?php if(empty($trave_characteristic_arr)){ if(empty($key))  echo "search_condition_span_select";}else{if(in_array($key,$trave_characteristic_arr)) echo "search_condition_span_select"; }?>"><a href="javascript:select_characteristic_advance('<?php echo $key;?>','trave_characteristic');"><?php echo $value;?></a></span>
        	  <?php } ?>
			  </div>
        	  <div class="clear_float"></div>
        	  </div>
       </div>
       <?php echo CHtml::endForm();?>
      </div>
      <?php if(empty($trave_dataProvider->itemCount)){ ?>
        <div class="search_scbox1">很抱歉，易途暂时没有推出此线路。以下是易途专家精选的旅游线路，可能会给您带来惊喜哦！</div>
      <?php } ?>
      <div class="search_scbox">
      	<div class="search_order">
      	   <span class="<?php echo (($time_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("search/index",array('time_sort'=>(($time_sort=="DESC")?"ASC":"DESC"),'did'=>$did,'trave_sregion'=>$trave_sregion,'trave_region'=>$trave_region,'budget'=>$budget,'trave_name'=>$trave_name,'trave_route_number'=>$trave_route_number,'trave_characteristic'=>$trave_characteristic,'tcid'=>$tcid,'advance_flag'=>$advance_flag,'pdid'=>$pdid,'ismore'=>$ismore,'recommend_line'=>$recommend_line)); ?>">价钱</a></span><span class="<?php echo (($order_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("search/index",array('order_sort'=>(($order_sort=="DESC")?"ASC":"DESC"),'did'=>$did,'trave_sregion'=>$trave_sregion,'trave_region'=>$trave_region,'budget'=>$budget,'trave_name'=>$trave_name,'trave_route_number'=>$trave_route_number,'trave_characteristic'=>$trave_characteristic,'tcid'=>$tcid,'advance_flag'=>$advance_flag,'pdid'=>$pdid,'ismore'=>$ismore,'recommend_line'=>$recommend_line)); ?>">订单</a></span><span class="<?php echo (($pub_sort=="DESC")?"asc":"desc"); ?>"><a href="<?php echo $this->createUrl("search/index",array('pub_sort'=>(($pub_sort=="DESC")?"ASC":"DESC"),'did'=>$did,'trave_sregion'=>$trave_sregion,'trave_region'=>$trave_region,'budget'=>$budget,'trave_name'=>$trave_name,'trave_route_number'=>$trave_route_number,'trave_characteristic'=>$trave_characteristic,'tcid'=>$tcid,'advance_flag'=>$advance_flag,'pdid'=>$pdid,'ismore'=>$ismore,'recommend_line'=>$recommend_line)); ?>">发布时间</a></span>                		                		
		    </div>
      	      <?php 
                if(!empty($trave_dataProvider->itemCount)){
                  $this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$trave_dataProvider,
												'itemView'=>'trave_search_item',
												'ajaxUpdate'=>false,
										));
								}else{
									
									$this->widget('zii.widgets.CListView',array(
												'dataProvider'=>$trave_recomment_dataProvider,
												'itemView'=>'trave_search_item',
												'ajaxUpdate'=>false,
										));
								}
							?>
      </div>
</div>
<?php
  $this->widget('application.extensions.tipsy.Tipsy', array(
   'trigger' => 'hover',
   'items' => array(
     array('id' => '.trave_tipsy','gravity' => 'sw','html'=>true),

  ),  
));
?> 
    <!--ask_right end-->
 <script language="javascript">
   var select_characteristic=[];
   jQuery(document).ready(function(){
   	var pub_sort="<?= $pub_sort ?>";
   	var tem_select_characteristic="<?= $trave_characteristic ?>";
   	if(tem_select_characteristic)
   	  select_characteristic=tem_select_characteristic.split(",");
    
     
   });
</script>
