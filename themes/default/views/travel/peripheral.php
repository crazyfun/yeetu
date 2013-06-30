 <?php
   if($this->beginCache("travedomestic", array('duration'=>"1"))){  
  
 ?> 
   
   <div class="around_right">
   	
   <div class="DIYimg"><?php echo Util::get_ad('8') ;?></div>
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
	  	 // document.getElementById("idCalendarPre").innerHTML="";
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
    