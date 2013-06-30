<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href='<?php echo $this->createUrl("order/index",array());?>'>返回到订单管理</a></span></div></div>
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttrave-form',
          'action'=>"",
	        'enableAjaxValidation'=>false,
        )); ?>
    		<?php 
    		  echo $form->hiddenField($model,"id");
    		  echo CHtml::hiddenField("start_date_id","",array('id'=>"start_date_id"));
    		  echo CHtml::hiddenField("start_date","",array('id'=>"start_date"));

    		?>
    		<div class="operate_result"><?php if(empty($user_error)){$this->widget("FlashInfo");}else{;$show_error="";foreach($user_error as $key => $value){if(is_array($value)){foreach($value as $key2=>$value2){$show_error.="&nbsp&nbsp;".$value2;}}else{$show_error.="&nbsp&nbsp;".$value;}} echo $show_error; }?></div>
        <div class="jwy_add"><?php if($model->id) echo "线路订单修改"; else echo "线路订单添加"; ?></div>
        <?php echo $form->hiddenField($model,"trave_id",array('id'=>'trave_id'));?>
    		<div class="input_line"><div class="input_name">线路名称</div><div class="input_long_content"><?php echo CHtml::textField('trave_name',$model->trave->trave_name,array('id'=>'select_trave_name','autocomplete'=>'off'));?></div><div class="input_error"><?php echo $form->error($model,'trave_name'); ?></div></div>
    		<?php echo $form->hiddenField($model,"create_id",array('id'=>'create_id'));?>
    	  <div class="input_line"><div class="input_name">下单用户</div><div class="input_long_content"><?php echo CHtml::textField('create_name',$model->user->user_login,array('id'=>'select_create_id','autocomplete'=>'off'));?></div><div class="input_error"><?php echo $form->error($model,'create_name'); ?></div></div>
    	  <!--<div class="input_name">关联操作员</div><div class="input_content"><?php $user=new User(); echo $form->dropDownList($model,"relation_id",$user->get_select_admin(),array()); ?></div>	-->
        <!--<div class="search_item"><span class="search_item_name">关联用户:</span><span class="search_item_input"><?php $user=new User(); echo CHtml::dropDownList("relation_id",$relation_id,$user->get_select_admin(),array()); ?></span></div>-->
    		<div class="input_line"><div class="input_name">成人价</div><div class="input_content"><?php echo $form->textField($model,"adult_price",array('id'=>'adult_price'));?></div><div class="input_error"><?php echo $form->error($model,'adult_price'); ?></div><div class="input_name">成人数</div><div class="input_content"><?php echo $form->textField($model,"adult_nums");?></div><div class="input_error"><?php echo $form->error($model,'adult_nums'); ?></div>
    		<div class="input_name">儿童价</div><div class="input_content"><?php echo $form->textField($model,"child_price",array('id'=>'child_price'));?></div><div class="input_error"><?php echo $form->error($model,'child_price'); ?></div><div class="input_name">儿童数</div><div class="input_content"><?php echo $form->textField($model,"child_nums");?></div><div class="input_error"><?php echo $form->error($model,'child_nums'); ?></div><div class="clear_both"></div>
    		
    		<div class="input_name">优惠劵</div><div class="input_content"><?php echo $form->textField($model,"coupon_value",array('id'=>'coupon_value'));?></div><div class="input_error"><?php echo $form->error($model,'coupon_value'); ?></div><div class="input_name">总价钱</div><div class="input_content"><?php echo $form->textField($model,"total_price",array('id'=>'total_price'));?></div><div class="input_error"><?php echo $form->error($model,'total_price'); ?></div>&nbsp;&nbsp;<div><a href="javascript:calculate_total()">计算总价</a></div><div class="clear_both"></div></div>
    		
    		<div class="input_line"><div class="input_name">出发时间</div><div class="input_content"><?php echo $model->start_date;?>&nbsp;&nbsp;<?php $check_flag="";if(!empty($model->start_date)){$check_flag="CHECKED='CHECKED'";}else{$check_flag="";} echo "<input type='checkbox' name='start_date_select' value='1' ".$check_flag." />"; ?></div><div class="input_content" id="select_trave_date_html"></div><div class="clear_both"></div></div>
    		
    		<div class="input_line"><div class="input_name">是否需要发票</div><div class="input_content"><?php echo $form->checkBox($model,'is_invoice',array('value'=>'1'));?>&nbsp;需要</div><div class="input_error"><?php echo $form->error($model,'is_invoice'); ?></div>
    		<?php if(!empty($model->pay_status)){ ?>
    		<div class="input_name">付款状态</div><div class="input_content"><?php $pay_status_select=CV::$PAY_STATUS;echo $pay_status_select[$model->pay_status]; ?></div>
    	 <?php } ?>
    		<div class="input_name">订单状态</div><div class="input_content"><?php echo $form->dropDownList($model,"order_status",CV::$ADD_ORDER_STATUS,array()); ?></div>	
    		<div class="input_name">支付方式</div><div class="input_content"><?php echo $form->dropDownList($model,"pay_style",CV::$PAY_STYLE,array()); ?></div>		
    		<div class="input_name">下单方式</div><div class="input_content"><?php echo $form->dropDownList($model,"order_style",CV::$ORDER_STYLE,array()); ?></div>	
    		<div class="clear_both"></div>
    		<div class="input_name">来源地</div><div class="input_content"><?php echo $form->dropDownList($model,"order_source",CV::$ORDER_SOURCE,array()); ?></div>	
    		<div class="input_name">订单等级</div><div class="input_content"><?php echo $form->dropDownList($model,"order_level",CV::$ORDER_LEVEL,array()); ?></div>	
    	  <div class="clear_both"></div></div>
     <div class="input_line_nf">
     	 <?php $this->renderDynamic(travel_contacts,array('order_id'=>$model->id)); ?>
     </div>
  
    <div class="input_line_nf">
	       <?php $this->renderDynamic(travel_insurance,array('insurance_ids'=>$model->insurance_ids)); ?>
	  </div>
	  
   <div class="input_line_nf" id="flight_input_line" style="display:none;">
   	 <div id="trave_flight">
     </div>
   	</div>
   	

   	<div class="input_line_nf" id="hotels_input_line" style="display:none;">
   	 <div id="trave_hotels">
     </div>
   	</div>

   	 <div class="input_line"><div class="input_name">订单备注</div><div class="input_long_content">
        	<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    				"model"=>$model, # Data-Model
   					"attribute"=>'order_remark',# Attribute in the Data-Model
   					"height"=>'400px',
    				"width"=>'100%',
    				"toolbarSet"=>'Yeetu', # EXISTING(!) Toolbar (see: fckeditor.js)
    				"fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",# Path to fckeditor.php
    				"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",# Realtive Path to the Editor (from Web-Root)
          )); ?>
       </div><div class="input_error"><?php echo $form->error($model,'order_remark'); ?></div><div class="clear_both"></div></div>
   	
 
    	<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("name"=>"submit","id"=>"submit","value"=>"提交"));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("name"=>"reset","id"=>"reset","value"=>"重置"));?><?php if(!empty($model->id)){ ?><input type="button" value="打印订单" onclick="javascript:window.open('<?php echo Yii::app()->homeUrl; ?>/backend.php/order/orderprint/id/<?php echo $model->id ?>','打印订单','');" class="operate_button"/><?php } ?></div><div class="add_more"><?php echo CHtml::link("新增",array("nation/add"));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>
    
<script language="javascript">
	var trave_category="<?= $model->trave->trave_category ?>";
	var free_package="<?= $model->trave->is_package ?>";
	var room_id="<?= $model->room_id ?>";
	var room_nums="<?= $model->room_nums ?>";
	var trave_route_number="<?= $model->trave_route_number ?>";
	var start_date="<?= $model->start_date ?>";
	jQuery(function($) {
    jQuery('#select_create_id').autocomplete({ 
    	  serviceUrl:'/backend.php/main/compeleteuser',
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
    	  	jQuery("#create_id").val(data.user_id);
    	  }
    	  // local autosugest options:
   	   //lookup: ['January', 'February', 'March', 'April', 'May'] //local lookup values 
    });
  
  
   jQuery('#select_create_id').keyup(function(){
 
      var this_val=jQuery(this).val();
     
      if(!this_val){
    	   jQuery("#create_id").val('');
      }	
  	
    });
    
    
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
    	  	trave_id=data.trave_id;
    	  	trave_category=data.trave_category;
    	  	free_package=data.trave_package;
          get_trave_date();
    	  }
    	  // local autosugest options:
   	   //lookup: ['January', 'February', 'March', 'April', 'May'] //local lookup values 
    });
   get_trave_date();
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
   
   
   function get_trave_date(){
   	var trave_id=jQuery("#trave_id").val();
   	if(parseInt(trave_id)){
  	jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
			   	  jQuery("#select_trave_date_html").html("<div class='ajax_tip_content'>加载出发时间中...</div>");
			   },
			   url: "/backend.php/main/travedate",
			   data: "trave_id="+trave_id+"&start_date="+start_date+"&rnd="+Math.random(),
			   success: function(msg){
           jQuery("#select_trave_date_html").html(msg);
           select_strave_date();
           change_select_trave_date();
           jQuery("#select_trave_date").unbind();
           jQuery("#select_trave_date").bind("change",function(){
           	 change_select_trave_date();
           	 get_trave_flight();
    	  		 get_trave_hotels();
           });
           get_trave_flight();
    	  	 get_trave_hotels();
			  }
			 });
		}
  } 
  
  function change_select_trave_date(){
    	var trave_date_data=get_trave_date_datas();
  		var select_trave_date=trave_date_data.std_value;
  		var date_key=trave_date_data.date_key;
  		if(free_package!='2'){
  			var adult_price=trave_date_data.adult_price;
  		  var child_price=trave_date_data.child_price;
  		  if(adult_price)
           document.getElementById("adult_price").value=adult_price;
        if(child_price)
           document.getElementById("child_price").value=child_price;
      } 
      if(select_trave_date)
  		   document.getElementById("start_date").value=select_trave_date;
  	  if(date_key)
  		   document.getElementById("start_date_id").value=date_key;
  		
  }
  
  
   function get_trave_flight(){
    var trave_id=jQuery("#trave_id").val();
    var trave_date_data=get_trave_date_datas();
  	jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
				  jQuery("#trave_flight").html("<div class='ajax_tip_content'>加载线路航班中...</div>");
			   },
			   url: "/backend.php/main/traveflight",
			   data: "trave_id="+trave_id+"&date_key="+trave_date_data.date_key+"&rnd="+Math.random(),
			   success: function(msg){
			     var json_obj=msg;
           jQuery("#trave_flight").html(json_obj);
           jQuery("#flight_input_line").show();
			  }
			 });
  }
  function get_trave_hotels(){
  	var trave_id=jQuery("#trave_id").val();
  	jQuery.ajax({
			   type: "GET",
			   beforeSend: function(){
				  jQuery("#trave_hotels").html("<div class='ajax_tip_content'>加载线路酒店中...</div>");
			   },
			   url: "/backend.php/main/travehotels",
			   data: "trave_id="+trave_id+"&room_id="+room_id+"&trave_route_number="+trave_route_number+"&room_nums="+room_nums+"&rnd="+Math.random(),
			   success: function(msg){
			     var json_obj=msg;
           jQuery("#trave_hotels").html(json_obj);
           jQuery("#hotels_input_line").show();
			  }
			 });
  }
  
  function select_strave_date(){
  
  	var select_trave_date=document.getElementById("select_trave_date");
  	var std_options=select_trave_date.options;
  	var op_length=std_options.length;
  	for(var ii=0;ii<op_length;ii++){
  		var op_value=std_options[ii].value;
  		if(op_value==start_date){
  			select_trave_date.selectedIndex=ii;
  		}
  	}
  }
  
  
  function calculate_total(){
  	var adult_price=document.getElementById("adult_price").value||0;
  	var adult_nums=document.getElementById("Traveorder_adult_nums").value||0;
  	var child_price=document.getElementById("child_price").value||0;
  	var child_nums=document.getElementById("Traveorder_child_nums").value||0;
  	var coupon_value=document.getElementById("coupon_value").value||0;
  	var total_nums=parseInt(adult_nums)+parseInt(child_nums);
  	var insance_total_price=0;
  	jQuery(".insurance_check").each(function(){
          var check_flag=jQuery(this).attr("checked");
          if(check_flag){
          	var insance_price=jQuery(this).attr("price")||0;
          	insance_total_price+=parseInt(insance_price)*total_nums;
          }
     }); 
     var adult_total_price=parseInt(adult_price)*parseInt(adult_nums);
     var child_total_price=parseInt(child_price)*parseInt(child_nums);
     var total_price=0;
  	if(trave_category=='5'){
  		 if(free_package=='1'){
  		 	  total_price=adult_total_price+child_total_price+insance_total_price;
  		 }else{
  		 	  var trave_route_number=document.getElementById("trave_route_number").value||0;
  		 	  var room_nums=document.getElementById("room_nums").value||0;
  		 	  var flight_price=document.getElementById("flight_price").value||0;
  		 	  var flight_total_price=parseInt(flight_price)*total_nums;
  		 	  var room_price=0;
  		 	  jQuery(".check_hotel").each(function(){
  		 	  	 var check_flag=jQuery(this).attr("checked");
  		 	  	 if(check_flag){
  		 	  	 	 room_price=jQuery(this).attr("room_price")||0;
  		 	  	 }
  		 	  });
  		 	  var hotel_total_price=parseInt(room_nums)*parseInt(room_price)*parseInt(trave_route_number);
  		 	  total_price=hotel_total_price+insance_total_price+flight_total_price;
  		 }
  		
  	}else{
  	   total_price=adult_total_price+child_total_price+insance_total_price;
  	}
  	total_price=total_price-parseInt(coupon_value);
  	document.getElementById("total_price").value=total_price;
  }
</script>

