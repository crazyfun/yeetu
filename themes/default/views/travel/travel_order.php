
  <!--head end-->
  <div id="step1" class="step"></div>
  <!-- step end -->
  <div class="order_main">
    <div class="order_main1">
    	
    	
    <?php  
       echo CHtml::beginForm($this->createUrl("travel/travelinfo"),"POST",array("id"=>'travelinfo'));
       echo CHtml::hiddenField("trave_id",$model->id);
       echo CHtml::hiddenField("hidden_adult_nums","",array('id'=>'hidden_adult_nums'));
       echo CHtml::hiddenField("hidden_child_nums","",array('id'=>'hidden_child_nums'));
       echo CHtml::hiddenField("hidden_start_date","",array('id'=>'hidden_start_date'));
       echo CHtml::hiddenField("hidden_adult_price","",array('id'=>'hidden_adult_price'));
       echo CHtml::hiddenField("hidden_child_price","",array('id'=>'hidden_child_price'));
       echo CHtml::hiddenField("hidden_total_price","",array('id'=>'hidden_total_price'));
       echo CHtml::hiddenField("hidden_insurance_ids","",array('id'=>'hidden_insurance_ids'));
       echo CHtml::hiddenField('start_date_id',"",array('id'=>'start_date_id'));
       echo CHtml::endForm();
   ?>
	 <div class="clear_float"></div>
      <div class="order_title">订单信息</div>
	  <div class="order_box"><h2>线路信息</h2>
	    <table  cellspacing="0" class="order_table">
            <tr>
              <th align="left">线路名称</th>
              <th width="95" align="center">出发城市</th>
              <th width="250" align="center">出发时间</th>
              <th width="180" align="center">出游人数</th>
            </tr>
            <tr>
              <td><a href="<?php echo $this->createUrl("travel/detail",array('id'=>$model->id,'n'=>$model->trave_title)) ?>" class="order_bt" ><?php echo Util::cs($model->trave_name,18);?></a></td>
              <td align="center"><?php $trave_district=new District(); $trave_sregion_data=$trave_district->get_table_datas($model->trave_sregion);echo $trave_sregion_data['district_name'];?></td>
              <td align="center" class="order_date"><span><?php echo $model->get_trave_details_sdate($select_trave_date);?></span></td>
              <td align="center">
			  	<div><?php echo CHtml::textField("adult_nums",$adult_nums,array("id"=>"adult_nums"));?>&nbsp;成人</div>
			  	<div><?php echo CHtml::textField("child_nums",$child_nums,array("id"=>"child_nums"));?>&nbsp;儿童</div>
              </td>
            </tr>
        </table>
		<div class="order_tab">
			<div class="wj_plane">			
				<div class="order_tab">              
                  <ul> 
                      <li id="menu_tab_1" class="trave_tab_select tab_select"><a href="javascript:change_tab(1,3);">接待标准</a></li>
                      <li id="menu_tab_2"><a href="javascript:change_tab(2,3);">特色推荐</a></li>
                      <li id="menu_tab_3"><a href="javascript:change_tab(3,3);">自费项目</a></li>
                  	  <div class="clear_float"></div>
                  </ul>
		  	 	</div>
             </div>
		  <div id="menu_tab_desc_1"  class="tabcon" style="display:block;">
		   <div class="tab_inner">
         <?php echo $model->trave_receptionstandards;?>
		   </div>
		  </div>
		  <div id="menu_tab_desc_2"  class="tabcon">
		   <div class="tab_inner">
         <?php echo $model->trave_recommended;?>
		   </div>
		  </div>
		  <div id="menu_tab_desc_3"  class="tabcon">
		    <div class="tab_inner">
          <?php echo $model->trave_tour;?>
		   </div>
		  </div>
		  
		  
		</div>
		<!-- order_tab end -->
	  </div>
	  <div class="order_box"><h2>保险信息</h2>
	    <table cellspacing="0" class="order_table" >
	    	<thead>
	    		 <tr>
            	<th align="left">保险名称</th>
	          	<th align="left"> 说明</th>
	          	<th align="center" width="60">保险期限</th>
	          	<th align="center" width="70">单价</th>
	          	<th align="center" width="70"> 购买人数</th>
	          	<th align="center" width="70"> 小计</th>
            </tr>
	    		
	    		</thead>
	      <tbody>
	      	<?php $insurance=new Insurance();
	      	    $insurance_datas=$insurance->get_table_datas();
	      	    $return_str="";
	      	    foreach($insurance_datas as $key => $value){
	      	    	
	      	?>
	      	    	  
	      	    	   <tr>
                    <td><div class="insurance_name" style="padding:5px 10px;"><div class="click_tip"><a class="trave_tipsy" title="<?php echo $value->insurance_describe;?>"><?php echo $value->insurance_name;?></a></div></div></td>
                    <td align="left"><?php echo $value->insurance_explain; ?></td>
                    <td align="center"><?php echo $value->insurance_period;?></td>
                    <td align="center"><span class="order_o_price"><?php echo $value->insurance_pice;?></span>元/人</td>
                    <td align="center" style="padding:0px 3px;">
                    <?php echo CHtml::dropDownList("select_insurance","",array('1'=>'不购买','2'=>'每人一份'),array("id"=>"select_insurance_".$value->id,'onchange'=>"javascript:select_insurance('".$value->id."','".$value->insurance_pice."');")); ?>
                   </td><td align="center"><span id="insurance_total_price_<?php echo $value->id;?>" class="o_price">0</span></td>
                   	
                   	</tr>
        
	      	<?php } ?>
          </tbody>
        </table>	
        	
	    <!-- order_box end -->	
	  </div>
	  
	  
	  
	  <div class="order_price">总价：<span class="order_show" id="order_show"></span>元</div>
	  <div class="order_line"></div>
	  <div class="order_nest order_nest">
       
		    <input onclick="javascript:send_order_info();" type="button" value="下一步"/>
      </div>
	  <div class="clear_float"></div>
    </div>
  </div>
  <div class="line_box1"></div>
    <?php
  $this->widget('application.extensions.tipsy.Tipsy', array(
   'trigger' => 'hover',
   'items' => array(
     array('id' => '.trave_tipsy','gravity' => 'sw','html'=>true),

  ),  
));
?>
  
  <script language="javascript">

  	var adult_nums="";
  	var child_nums="";
  	var insurance_obj=[];
  //页面加载
  	jQuery(function($) {
  		adult_nums="<?= $adult_nums ?>"||0;
  		child_nums="<?= $child_nums ?>"||0;
  		calculate_total_price();
  		
  		
  		       	
   jQuery("#adult_nums").keyup(function(){
      	 isNumber(jQuery(this).get()[0]);
      	
      }).change(function(){
      	  var tem_adult_nums=jQuery(this).val();
      	  if(!tem_adult_nums){
      	  	adult_nums=0;
      	  }else{
      	  	adult_nums=tem_adult_nums;
      	  }
   
      	  var len=insurance_obj.length;
      	  if(len){
      	    for(var ii=0;ii<len;ii++){
      	  	   select_insurance(insurance_obj[ii].id,insurance_obj[ii].value);
      	    }
      	  }else{
      	  	calculate_total_price();
      	  	
      	  }
      });
      jQuery("#child_nums").keyup(function(){
      	 isNumber(jQuery(this).get()[0]);
      	
      }).change(function(){
      	  var tem_child_nums=jQuery(this).val();
      	  if(!tem_child_nums)
      	    child_nums=0;
      	  else
      	  	child_nums=tem_child_nums;
      	  var len=insurance_obj.length;
      	  if(len){
      	  	for(var ii=0;ii<len;ii++){
      	  	 	select_insurance(insurance_obj[ii].id,insurance_obj[ii].value);
      	  	}
      	  }else{
      	  	  calculate_total_price();
      	  }
      });
  
     jQuery("#select_trave_date").change(function(){
      	calculate_total_price();
      });
      

    }); 
   
  	
  </script>