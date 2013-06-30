<div id="page_content">
    <div class="show_right_content">
    	<!--û-->
    	<div class="user_operate"><div class="user_operate_content"><span><a href="<?php echo $this->createUrl("freetn/index");?>">返回到国际机+酒店</a></span><span><a href='<?php echo $this->createUrl("freetn/travedate",array('trave_id'=>$model->trave_id));?>'>返回到国际机+酒店时间</a></span></div></div>
    	
    	<div class="edit_content">
    		<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'inserttravedate-form',
          'action'=>$this->createUrl("freetn/inserttravedate",array()),
	        'enableAjaxValidation'=>false,
        )); ?>
    		<?php echo $form->hiddenField($model,"id");?>
        <?php echo $form->hiddenField($model,"trave_id");?>
       <div class="operate_result"><?php $this->widget("FlashInfo");?></div>
        	<div class="jwy_add"><?php if($model->id) echo "国际机+酒店时间修改"; else echo "国际机+酒店时间添加"; ?></div>   
    		<div class="input_line"><div class="input_name">出发日期</div><div class="input_content"><?php echo CHtml::textField("start_date",$trave_dates['s'],array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy/MM/dd",isShowWeek:true,startDate:"<?php echo $trave_dates[s];?>",readOnly:true});'));?></div><div class="input_error"><?php echo $form->error($model,'trave_date'); ?></div><div class="clear_both"></div></div>
    		<div class="input_line"><div class="input_name">日期类型</div><div class="input_content"><?php echo $form->radioButtonList($model,"date_type",array('1'=>'规律日期','2'=>'日期段'),$htmlOptions=array('separator'=>'&nbsp;','class'=>'date_type'));?></div></div>
    		<div class="input_line" id="guilv_riqi" <?php if($model->date_type=='1') echo "style='display:block'"; else echo "style='display:none;'"; ?>><div class="input_name">规律日期</div><div class="input_long_content">&nbsp;&nbsp;<?php echo UserHmtl::get_select_value('month',CV::$REGULAR_MONTH,$trave_dates['m'],"选择月",''); ?>&nbsp;&nbsp;<?php echo UserHmtl::get_select_value('day',CV::$REGULAR_DAY,$trave_dates['d'],"选择星期",''); ?></div><div class="input_error"></div><div class="clear_both"></div></div>
    		<div class="input_line" id="riqi_duan" <?php if($model->date_type=='1') echo "style='display:none'"; else echo "style='display:block;'"; ?> ><div class="input_name">日期段</div><div class="input_loang_content"><?php echo CHtml::textField("open_date",$trave_dates['open_date'],array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy/MM/dd",isShowWeek:true,startDate:"<?php echo $trave_dates[open_date];?>",readOnly:true});'));?>到<?php echo CHtml::textField("close_date",$trave_dates['close_date'],array("onclick"=>'javascript:WdatePicker({dateFmt:"yyyy/MM/dd",isShowWeek:true,startDate:"<?php echo $trave_dates[close_date];?>",readOnly:true});'));?></div><div class="input_error"></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">儿童价钱</div><div class="input_content"><?php echo $form->textField($model,"child_price",array("onkeyup"=>"javascript:isNumber(this);"));?></div><div class="input_error"><?php echo $form->error($model,'child_price'); ?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">儿童结算价</div><div class="input_content"><?php echo $form->textField($model,"fc_price",array("onkeyup"=>"javascript:isNumber(this);"));?></div><div class="input_error"><?php echo $form->error($model,'fc_price');?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">会员价钱</div><div class="input_content"><?php echo $form->textField($model,"adult_price",array("onkeyup"=>"javascript:isNumber(this);"));?></div><div class="input_error"><?php echo $form->error($model,'adult_price');?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">成人结算价</div><div class="input_content"><?php echo $form->textField($model,"fa_price",array("onkeyup"=>"javascript:isNumber(this);"));?></div><div class="input_error"><?php echo $form->error($model,'fa_price');?></div><div class="clear_both"></div></div>
        <div class="input_line"><div class="input_name">座位</div><div class="input_content"><?php echo $form->textField($model,"seats",array("onkeyup"=>"javascript:isNumber(this);"));?></div><div class="input_error"><?php echo $form->error($model,'seats');?></div><div class="clear_both"></div></div>
        <?php echo $form->hiddenField($model,"flight_id",array('id'=>'flight_id'));?>
        <div class="input_line"><div class="input_name">航班</div><div class="input_long_content"><?php echo CHtml::textField('flight_name',!empty($model->flight_id)?($model->TraveFlight->go_flight."(".$model->TraveFlight->departure."->".$model->TraveFlight->destinations.",".$model->TraveFlight->go_flight_type.",".$model->TraveFlight->go_flight_time.")"):"",array('id'=>'select_flight_name','autocomplete'=>'off'));?></div><div class="input_error"></div></div>
        
        
        <?php echo $form->hiddenField($model,"back_flight_id",array('id'=>'back_flight_id'));?>
        <div class="input_line"><div class="input_name">返程航班</div><div class="input_long_content"><?php echo CHtml::textField('back_flight_name',!empty($model->back_flight_id)?($model->B_TraveFlight->go_flight."(".$model->B_TraveFlight->departure."->".$model->B_TraveFlight->destinations.",".$model->B_TraveFlight->go_flight_type.",".$model->B_TraveFlight->go_flight_time.")"):"",array('id'=>'select_back_flight_name','autocomplete'=>'off'));?></div><div class="input_error"></div></div>
        
        
        <div class="input_line"><div class="input_name">航班组价钱</div><div class="input_content"><?php echo $form->textField($model,"flight_price",array("onkeyup"=>"javascript:isNumber(this);"));?></div><div class="input_error"></div><div class="clear_both"></div></div>
        	
    		<div class="input_line hasbgbot"><div class="edit_input_button"><div class="input_submit"><?php echo CHtml::submitButton("submit",array("value"=>'提交'));?></div><div class="input_cancel"><?php echo CHtml::resetButton("reset",array("value"=>'重置'));?></div><div class="add_more"><?php echo CHtml::link("新增",array("freetn/addtravedate",'trave_id'=>$model->trave_id));?></div><div class="clear_both"></div></div></div>
    	<?php $this->endWidget(); ?>
    	</div>
    </div>
<script language="javascript">
	jQuery(function($) {

    	  	  jQuery(".date_type").bind("click",function(){
    	  	  	var date_type_value=jQuery(this).val();
    	  	  	if(date_type_value=='1'){
    	  	  		jQuery("#guilv_riqi").show();
    	  	  		jQuery("#riqi_duan").hide();
    	  	  	}else{
    	  	  		jQuery("#guilv_riqi").hide();
    	  	  		jQuery("#riqi_duan").show();
    	  	  	}
    	  	  });
    	  	

    
    
     jQuery('#select_flight_name').autocomplete({ 
    	  serviceUrl:'/backend.php/main/compeleteflight',
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
    	  	jQuery("#flight_id").val(data.flight_id);
    	  	jQuery("#flight_back_flight").val(data.back_flight);
    	  	jQuery("#flight_total_price").val(data.total_price);
    	  }
    });
    
    jQuery('#select_flight_name').keyup(function(){
      var this_val=jQuery(this).val();
      if(!this_val){
    	   jQuery("#flight_id").val('');
      }	
    });
    jQuery('#select_back_flight_name').autocomplete({ 
    	  serviceUrl:'/backend.php/main/compeleteflight',
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
    	  	jQuery("#back_flight_id").val(data.flight_id);

    	  }
    	  // local autosugest options:
   	   //lookup: ['January', 'February', 'March', 'April', 'May'] //local lookup values 
    });
    
    jQuery('#select_back_flight_name').keyup(function(){
 
      var this_val=jQuery(this).val();
     
      if(!this_val){
    	   jQuery("#back_flight_id").val('');
      }	
  	
    });
    
  }); 
</script>

