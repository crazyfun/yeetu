 <?php
   Yii::app()->clientScript->registerScriptFile('/js/My97DatePicker/WdatePicker.js');
   if($this->beginCache("travedomestic", array('duration'=>"1"))){  
 
 ?> 
   <div class="around_right">
   <div class="DIYimg"><?php echo Util::get_ad('20') ;?></div>
   
       
   
   	<?php  
                $this->widget('Travebargain',array(
                    	 'trave_category'=>$this->trave_category,
                    	 'trave_sregion'=>$this->trave_sregion,
               	)); 
     ?> 
    <?php  
                $this->widget('Traveweekhot',array(
                    	 'trave_category'=>$this->trave_category,
                    	 'trave_sregion'=>$this->trave_sregion,
               	)); 
     ?>

	 <?php  
                $this->widget('Traverecommend',array(
                    	 'trave_category'=>$this->trave_category,
                    	 'trave_sregion'=>$this->trave_sregion,
               	)); 
     ?>
     
     
     
      <div class="around_two">
        <h2 class="title">出游联系信息</h2>
        <div class="ar-box">
        	<div class="gc_tips">
        	</div>
        	
        	<div class="gc_content">
        		
         <?php $form=$this->beginWidget('CActiveForm', array(
	         'id'=>'groupcustomize-form',
           'action'=>"",
	         'enableAjaxValidation'=>false,
         )); ?>
        		 <div class="gc_con">
        		 	  <a name="contact"></a>
        		 	   <div class="gc_tips_title">出游联系信息</div>
        		 	   
        		 	   <table class="gc_table">
        		 	   	  <tbody>
        		 	   	  	  <tr><td colspan="4"><div class="operate_result"><?php $this->widget("FlashInfo");?></div></td></tr>
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title"><b>*</b>联系人：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($model,"contact_name",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($model,'contact_name'); ?></span></td>
        		 	   	  	  	<td class="gc_title"><b>*</b>手机号码：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($model,"contact_phone",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($model,'contact_phone'); ?></span></td>
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title"><b>*</b>联系电话：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($model,"contact_tel",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($model,'contact_tel'); ?></span></td>
        		 	   	  	  	<td class="gc_title">E-mail：</td>
        		 	   	  	  	<td class="gc_input"><?php echo $form->textField($model,"contact_email",array('class'=>'gc_input_text'));?><span class="input_error"><?php echo $form->error($model,'contact_email'); ?></td>
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  
        		 	   	  	  <tr>
        		 	   	  	  	<td class="gc_title">回复时间：</td>
        		 	   	  	  	<td class="gc_input" colspan="3"><?php echo UserHmtl::get_radio_value("reply_time",CV::$GROUP_REPLY_TIME,$model->reply_time,"",false);?></td>
        		 	   	  	  	
        		 	   	  	  </tr>
        		 	   	  	  
        		 	   	  	  

        		 	   	  </tbody>
        		 	   	</table>
        		 	</div>
        		 	
        		 	<div class="gc_com">
        		 		<div class="gc_tips_title"><img id="message_arrow_img" src="/css/images/message-arrow_d.png"/>&nbsp;<span onclick="javascript:show_message();">出游信息</span></div>
        		 		<table class="gc_table" id="gc_com_message" style="display:none;">
        		 		   <tr>
        		 	   	  	  <td class="gc_title">公司名称：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"company_name",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出发城市：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->dropDownList($model,"start_region",CV::$GROUP_START_REGION,array());?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">目的地：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"end_region",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出发日期：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"start_time",array('class'=>'gc_input_text',"onclick"=>'javascript:WdatePicker({dateFmt:"yyyy-MM-dd",isShowWeek:true,startDate:"",readOnly:true});'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">人数：</td>
        		 	   	  	  <td class="gc_cinput">成人数：<?php echo $form->textField($model,"adults",array('class'=>'gc_input_text'));?>儿童数：<?php echo $form->textField($model,"childs",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">天数：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"travel_nums",array('class'=>'gc_input_text'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">出游预算：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textField($model,"travel_budget",array('class'=>'gc_input_text'));?>元/人</td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">交通工具：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("transport",CV::$GROUP_TRANSPORT,$model->transport,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"transport_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">住宿标准：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("stay",CV::$GROUP_STAY,$model->stay,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"stay_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">用餐标准：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("dinning",CV::$GROUP_DINNING,$model->dinning,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"dinning_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">导游要求：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("guide",CV::$GROUP_GUIDE,$model->guide,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"guide_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">购物安排：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("shopping",CV::$GROUP_SHOPPING,$model->shopping,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"shopping_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">会议安排：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo UserHmtl::get_radio_value("meeting",CV::$GROUP_MEETING,$model->meeting,"",false);?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title"></td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"meeting_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 	     
        		 	   	 <tr>
        		 	   	  	  <td class="gc_title">其他需求：</td>
        		 	   	  	  <td class="gc_cinput"><?php echo $form->textArea($model,"other_tips",array('class'=>'gc_input_area'));?></td>
        		 	   	 </tr>
        		 	   	 
        		 	   	 
        		 			 
        		 		</table>
        		 		
        		  </div>
        		  
        		 
        		  <div class=""><?php echo CHtml::submitButton("提交",array('class'=>'gc_submit'));?></div>
        <?php $this->endWidget(); ?>  
        	</div>
        </div>
     </div>
      

			
			

     </div>
     
     
         <div id="trave_route_calendar" style="display:none;z-index:200;" >
    	   <div class="trave_route_calendar">
             <div class="Calendar calendar_detail">
  											<div id="idCalendarPre"></div>
  											<div id="idCalendarNext"></div>
  											<span id="idCalendarYear"></span>年 <span id="idCalendarMonth"></span>月
  											<table cellspacing="0" width="100%" height="100%">
   										 	<thead>
     											 <tr class="days_week">
        										<td>日</td>
        										<td>一</td>
        										<td>二</td>
       											<td>三</td>
        										<td>四</td>
        										<td>五</td>
        										<td>六</td>
      										 </tr>
    									 </thead>
    									<tbody id="idCalendar" trave_id="">
    									</tbody>
  										</table>
										</div>
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
 <script language="javascript">
  jQuery(document).ready(function(){
           var rtreve_hover_timeout="";
    				jQuery(".trave_hover_static").hover(
     				 	function(){
      					var that=this;
      					rtreve_hover_timeout=window.setTimeout(function(){jQuery(that).find(".row_static").fadeIn("fast");},"500");
      				},
      				function(){
      					window.clearTimeout(rtreve_hover_timeout);
      					jQuery(this).find(".row_static").hide();
      				}

    				);
	

 
  }); 
  

var cale = new Calendar("idCalendar", {
  trave_date_datas:"",
	//SelectDay: new Date().setDate(10),
	onSelectDay: function(o){ o.className = "onSelect"; },
	onToday: function(o){ o.className ="onToday"; },
	onFinish: function(){
		document.getElementById("idCalendarYear").innerHTML = this.Year; document.getElementById("idCalendarMonth").innerHTML = this.Month;
		document.getElementById("idCalendarPre").innerHTML="◄"+String((parseInt(this.Month)-1)?(parseInt(this.Month)-1):12)+"月";
		document.getElementById("idCalendarNext").innerHTML=((String(parseInt(this.Month)+1)==13)?1:String(parseInt(this.Month)+1))+"月"+"►";
		//var flag = [10,15,20];
		//for(var i = 0, len = flag.length; i < len; i++){
			//this.Days[flag[i]].innerHTML = "<a href='javascript:void(0);' onclick=\"alert('日期是:"+this.Year+"/"+this.Month+"/"+flag[i]+"');return false;\">" + flag[i] + "</a>";
		//}
	}
});

jQuery("#idCalendarPre").bind("click",function(){
	var pre_date=new Date(cale.Year,cale.Month-2, 1);
	 var now_date=new Date();
	  var diff_day=Math.floor((now_date-pre_date)/(1000*60*60*24)/(28*3));
	  var click_flag=true;
    if(diff_day>=1){
    	click_flag=false;
    }
	  if(click_flag){
	  	  cale.PreMonth();
	  	  //document.getElementById("idCalendarPre").innerHTML="";
	  }
	
});
jQuery("#idCalendarNext").bind("click",function(){
	var next_date=new Date(cale.Year,cale.Month, 1);
	  var now_date=new Date();
    var diff_day=Math.floor((next_date-now_date)/(1000*60*60*24)/(28*6));
	  var click_flag=true;
    if(diff_day>=1){
    	click_flag=false;
    }
	  if(click_flag){
	  	  cale.NextMonth();
	  	  //document.getElementById("idCalendarPre").innerHTML="◄"+String((parseInt(cale.Month)-1)?(parseInt(cale.Month)-1):12)+"月";
	  	  //document.getElementById("idCalendarNext").innerHTML="";
	  }
	
});


     	
     	</script>
      <?php   
          $this->endCache(); 
        } 
     ?>
 
	  <!--around_two end-->
	  <!--around_two end-->
    