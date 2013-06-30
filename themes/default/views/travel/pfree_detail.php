<?php
    Yii::app()->clientScript->registerCssFile('/js/lightbox/css/jquery.lightbox-0.5.css');
    Yii::app()->clientScript->registerScriptFile('/js/lightbox/jquery.lightbox.js');
		if($this->beginCache("travepfreedetails", array('dependency'=>array(
        'class'=>'system.caching.dependencies.CDbCacheDependency',
        'sql'=>"SELECT MAX(create_time) FROM {{trave}} WHERE id='$trave_id'"
		),'varyByParam'=>array('trave_id')))){  	 
		Yii::app()->clientScript->registerScriptFile("/js/jcarousel/jquery.jcarousel.min.js"); 
		
?>
<div class="wj_mainL"><!--内容左边部分-->
    	<div class="wj_toptab">
            <div class="wj_txtu">
                <span style="float:left;"><span><?php $trave_district=new District(); $trave_sregion_data=$trave_district->get_table_datas($model->trave_sregion);$trave_region_data=$trave_district->get_table_datas($model->trave_region);echo $trave_sregion_data['district_name']."/".$trave_region_data['district_name']; ?></span><span class="wj_redtxt">编号<?php echo $model->trave_number;?></span><span>本产品由<?php if($model->trave_category=='1')  echo $model->Agency->agency_name; else echo "上海易途旅行网"; ?>提供相关服务</span></span><span style="float:right;"><div id="ckepop">
<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt" target="_blank"><img src="http://v2.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border="0" /></a>
<a class="jiathis_counter_style_margin:3px 0 0 2px"></a>
</div>
<script type="text/javascript" >
var jiathis_config={
	siteNum:15,
	sm:"email,tsina,tqq,renren,kaixin001,t163,douban,tsohu,msn,tianya,qzone,xiaoyou,mop,tieba,feixin",
	summary:"",
	hideMore:false
}
</script>
<script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END --></span>					        
            </div>
            <div><span class="detail_trave_name"><?php echo $model->trave_name;?><?php  if($model->trave_recommend=='2'){echo '<span class="characteristic_img"><img  src="/css/images/tuijian_img.png"/></span>';} if($model->trave_bargain=='2'){echo '<span class="characteristic_img"><img  src="/css/images/tejia_img.png"/></span>';} if($model->trave_hot=='2'){echo '<span class="characteristic_img"><img  src="/css/images/remai_img.png"/></span>';}?>&nbsp;<?php if($model->trave_ordain=='1'){echo '<img  src="/css/images/orderOnLine.gif"/>';}?></span><span class="web_consulting">
            	<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=306816844&site=qq&menu=yes"><img border="0" width="18" height="18" src="/css/images/qqmsg.gif" alt="点击QQ给我发消息" title="点击QQ给我发消息"></a>
             </span>
            </div>
            <div class="wj_contab">
                <div class="wj_contabl">
                    <div class="wj_ustb"> 
                    	
                   <?php  
                    	$this->widget('Traveimages',array(
                    	   'trave_id'=>$model->id,
               				 )); 
                   ?>
                   </div>  
                  
                </div>
                <div class="wj_contabr">
                    <div class="wj_xi_tab1">
                        <table cellpadding="0" cellspacing="0" width="383">
                                <tr><td height="30" align="right" width="72"><b>易途价格</b>：</td><td><span class="wj_price"><?php echo $model->get_trave_price()."元起"; ?></span>&nbsp;&nbsp;<?php if(!empty($model->coupon)){?>(每位成人可以<a href="<?php echo $this->createUrl("help/index",array('cid'=>'18','#' => 'q3')); ?>">使用优惠劵</a><span class="wj_price"><?php echo $model->coupon;?></span>元)<?php } ?></td></tr>
                                <tr><td height="30" align="right"><b>提前报名</b>：</td><td><?php echo $model->trave_application;?></td></tr>
                                <tr><td height="30" align="right"><b>网友评价</b>：</td>
                                <td>
										                 <div class="wypldiv"><?php $trave_comment=new TraveComment(); echo $trave_comment->get_trave_comments($model->id,$model->trave_category);?></div>
                                 </td>
                                </tr>
                                <tr><td height="30" align="right"><b>预订城市</b>：</td><td><?php $trave_district=new District(); $trave_sregion_data=$trave_district->get_table_datas($model->trave_sregion);echo $trave_sregion_data['district_name'];?> </td></tr>
                                <tr><td height="30" align="right"><b>出发日期</b>：</td><td><span class="wj_startdate"><?php echo $model->get_trave_details_date();?></span></td></tr>
                                <tr><td height="30" align="right"><b>往返交通</b>：</td><td><?php echo $model->trave_transportation;?></td></tr>
                                <tr><td height="30" align="right"> </td><td><!--<div class="wj_seemap"><a href="javascript:show_mapdialog();">查看地图</a></div>--></td></tr>
                        </table>
                    </div>
                </div><!--wj_contabr end-->
                
       
      <div class="clear_float"></div>
      
      
      <div id="trave_route_calendar" >
    	             <div class="trave_route_calendar">
    	             	
    	             	
    	             	<?php $trave_threads_datas=$model->get_trave_threads();
    	             	 
                       if(empty($trave_threads_datas)){ 	
                    ?>
    	             	
    		             <div class="Calendar">
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
    									<tbody id="idCalendar">
    									</tbody>
  										</table>
										</div>
                 <div class="Calendar">
  											<div id="idCalendarPre1"></div>
  											<div id="idCalendarNext1"></div>
  											<span id="idCalendarYear1"></span>年 <span id="idCalendarMonth1"></span>月
  											<table cellspacing="0">
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
    									<tbody id="idCalendar1">
    									</tbody>
  										</table>
								</div>
								
								<script language="javascript">
									  function click_trave_date(){
  	     var trave_id="<?= $model->id ?>";
          jQuery.ajax({
			     type: "GET",
			     beforeSend: function(){
			    },
			    url: "/index.php/travel/travesdate",
			    data: "trave_id="+trave_id+"&rnd="+Math.random(),
			    success: function(msg){
			      var json_obj=eval('('+msg+')');
			      if(json_obj){
			      	cale.trave_date_datas=json_obj;
			      	cale1.trave_date_datas=json_obj;
			      	cale.Draw();
			      	cale1.Draw();
			      }
			      jQuery("#idCalendar").attr("trave_id",trave_id);
			   }
			 });
  }

   /*
   function show_mapdialog(){
     var trave_sregion="<?= $trave_sregion_data['district_name'] ?>";
     var trave_region="<?= $trave_region_data['district_name'] ?>";
     var trave_id="<?= $model->id ?>";
     var frame_dialog=new FrameDialog();
     frame_dialog.show_dialog("查看地图",{"ok_button":{"name":"确定"},"cancel_button":{"name":"取消"}},{"width":760,"height":350,"FrameUrl":"/index.php/maps/index?trave_sregion="+trave_sregion+"&trave_region="+trave_region+"&trave_id="+trave_id,"overlay":true}); 
   }
   */
  var cale = new Calendar("idCalendar", {
  trave_date_datas:'',
	//SelectDay: new Date().setDate(10),
	onSelectDay: function(o){ o.className = "onSelect"; },
	onToday: function(o){ o.className ="onToday"; },
	onFinish: function(){
		document.getElementById("idCalendarYear").innerHTML = this.Year; document.getElementById("idCalendarMonth").innerHTML = this.Month;
		document.getElementById("idCalendarPre").innerHTML="◄"+String((parseInt(this.Month)-1)?(parseInt(this.Month)-1):12)+"月";
	}
});
  var current_date=new Date();
	var next_date=new Date(current_date.getFullYear(),current_date.getMonth()+2,1);
  var cale1 = new Calendar("idCalendar1", {
  Year:next_date.getFullYear(),
  Month:next_date.getMonth(),
  trave_date_datas:'',
	//SelectDay: new Date().setDate(10),
	onSelectDay: function(o){ o.className = "onSelect"; },
	onToday: function(o){ o.className ="onToday"; },
	onFinish: function(){
		document.getElementById("idCalendarYear1").innerHTML = this.Year; document.getElementById("idCalendarMonth1").innerHTML = this.Month;
		document.getElementById("idCalendarNext1").innerHTML=(String(parseInt(this.Month)+1))+"月"+"►";
	}
});
jQuery("#idCalendarPre").bind("click",function(){
	var pre_date=new Date(cale.Year,cale.Month-1, 1);
	  var now_date=new Date();
	  var diff_day=Math.floor((now_date-pre_date)/(1000*60*60*24)/(28*3));
	  var click_flag=true;
    if(diff_day>=1){
    	click_flag=false;
    }
	  if(click_flag){
	  	  cale.PreMonth();
	  	  var pre_date=new Date(cale.Year, cale.Month, 1);
	      cale1.PreDraw(pre_date);
	  }
});

jQuery("#idCalendarNext1").bind("click",function(){
	var next_date=new Date(cale1.Year,cale1.Month, 1);
	  var now_date=new Date();
    var diff_day=Math.floor((next_date-now_date)/(1000*60*60*24)/(28*6));
	  var click_flag=true;
    if(diff_day>=1){
    	click_flag=false;
    }
	  if(click_flag){
	  	  cale1.NextMonth();
	  	  cale.PreDraw(new Date(cale1.Year, cale1.Month-2, 1));
	  }
});
									
								</script>
							<?php }else{ ?>
							
							 <div class="Calendar">
  											<div id="idCalendarPre2"></div>
  											<div id="idCalendarNext2"></div>
  											<span id="idCalendarYear2"></span>年 <span id="idCalendarMonth2"></span>月
  											<table cellspacing="0">
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
    									<tbody id="idCalendar2">
    									</tbody>
  										</table>
								</div>
								
								<div class="Calendar">
									<?php
									 $this->widget('TraveT', array(  
                      'datas'=>$trave_threads_datas,
                   ));
              
              ?>
									
								</div>
								
								<script language="javascript">
									
									
									 function click_trave_date(){
  	     var trave_id="<?= $model->id ?>";
          jQuery.ajax({
			     type: "GET",
			     beforeSend: function(){
			    },
			    url: "/index.php/travel/travesdate",
			    data: "trave_id="+trave_id+"&rnd="+Math.random(),
			    success: function(msg){
			      var json_obj=eval('('+msg+')');
			      if(json_obj){
			      	
			      	cale2.trave_date_datas=json_obj;
			      	cale2.Draw();
			      }
			      jQuery("#idCalendar").attr("trave_id",trave_id);
			   }
			 });
  }
  
  
									var cale2 = new Calendar("idCalendar2", {
  trave_date_datas:"",
	//SelectDay: new Date().setDate(10),
	onSelectDay: function(o){ o.className = "onSelect"; },
	onToday: function(o){ o.className ="onToday"; },
	onFinish: function(){
		document.getElementById("idCalendarYear2").innerHTML = this.Year; document.getElementById("idCalendarMonth2").innerHTML = this.Month;
		document.getElementById("idCalendarPre2").innerHTML="◄"+String((parseInt(this.Month)-1)?(parseInt(this.Month)-1):12)+"月";
		document.getElementById("idCalendarNext2").innerHTML=((String(parseInt(this.Month)+1)==13)?1:String(parseInt(this.Month)+1))+"月"+"►";
	}
});


jQuery("#idCalendarPre2").bind("click",function(){
	
	var pre_date=new Date(cale2.Year,cale2.Month-2, 1);
	  var now_date=new Date();
	  var diff_day=Math.floor((now_date-pre_date)/(1000*60*60*24)/(28*3));
	  var click_flag=true;
    if(diff_day>=1){
    	click_flag=false;
    }
	  if(click_flag){
	  	  cale2.PreMonth();
	  }
});

	
	jQuery("#idCalendarNext2").bind("click",function(){
		var next_date=new Date(cale2.Year,cale2.Month, 1);
	  var now_date=new Date();
    var diff_day=Math.floor((next_date-now_date)/(1000*60*60*24)/(28*6));
	  var click_flag=true;
    if(diff_day>=1){
    	click_flag=false;
    }
	  if(click_flag){
	  	  cale2.NextMonth();
	  }
	});
									
								</script>
						<?php } ?>
								
								
                 <div class="clear_float"></div>
								
								</div>
								
								
             </div>
      
      <div class="DIYtour_m">
        <table class="DIYtour_m_table">
        	<?php echo CHtml::beginForm($this->createUrl("travel/travelforder"),"POST",array("id"=>'travelforder'));?>
             <?php echo CHtml::hiddenField("trave_id",$model->id);?>
             <?php echo CHtml::hiddenField("hidden_room_id","",array('id'=>'hidden_room_id'));?>
             
             <?php echo CHtml::hiddenField("hidden_hotel_id","",array('id'=>'hidden_hotel_id'));?>
             <?php echo CHtml::hiddenField("hidden_trave_route_number","",array('id'=>'hidden_trave_route_number'));?>
             <?php echo CHtml::hiddenField("hidden_total_price","",array('id'=>'hidden_total_price'));?>
             <?php echo CHtml::hiddenField('start_date_id',"",array('id'=>'start_date_id'));?>
          <tbody>
            <tr>
              <td width="104">出发时间</td>
              <td width="414">
                <?php echo $model->get_trave_details_sdate();?>
              </td>
              <td width="179" align="left">总价:<span class="wj_price" id="trave_total_price">0</span>元</td>
            </tr>
            <tr>
              <td>游客信息</td>
              <td>
               <span class="wj_startdate"><?php echo CHtml::textField("adult_nums","",array('class'=>'wj_crinput',"onkeyup"=>"javascript:isNumber(this);"));?></span><span class="wj_startdate">成人</span><span class="wj_startdate"><?php echo CHtml::textField("child_nums","",array('class'=>'wj_crinput',"onkeyup"=>"javascript:isNumber(this);"));?>儿童</span><span class="wj_startdate"><?php echo CHtml::textField("room_nums","",array('class'=>'wj_crinput',"onkeyup"=>"javascript:isNumber(this);"));?>房间</span>
                </td>
              <td id="average_price" align="right"><div class="DIYtour_price">人均价格:<span class="wj_price" id="people_total_price">0</span>元</div></td>
            </tr>
          </tbody>
          <?php echo CHtml::endForm();?>
        </table>
        
      </div>
      
      
      
      
     </div><!--wj_contab-->
    </div><!--wj_tabtop end--->
    
    
  	<div class="around_two">
      <h2 class="title">航班信息</h2> 
    <div id="trave_flight">
    	</div>
  </div>
      
  <div class="around_two">
     <h2 class="title">入住酒店</h2>   
     <div id="trave_hotels">

     </div>
  </div>
      
       <div class="around_two">
        <h2 class="title">自助游线路推荐</h2>
            <div class="DIYtour_order">
              <div class="DIYtour_price">总价：<span class="wj_price" id="trave_total_price_1">0</span>元</div>
              <span class="DIYtour_button_strong">此价格需要客服确认</span>

              <a rel="nofollow" href="javascript:submit_order_form();"><img src="/css/images/order_btn.png" /> </a>
            </div>
      </div>
     
        
                    
        <div class="wj_plane">
        	<div class="wj_tab_title">
            	<ul>
                	<li id="menu_tab_1" class="trave_tab_select"><a href="javascript:change_trave_tab(1,5);">自费项目</a></li><li id="menu_tab_2"><a href="javascript:change_trave_tab(2,5);">预订须知</a></li><li id="menu_tab_3"><a href="javascript:change_trave_tab(3,5);">付款流程</a></li><li id="menu_tab_4"><a href="javascript:change_trave_tab(4,5);">网友评论</a></li><li id="menu_tab_5"><a href="javascript:change_trave_tab(5,5);">在线咨询</a></li><div class="clear_float"></div>
                </ul>
            </div>
           <div class="wj_tabcon" id="menu_tab_desc_1" style="display:block;">
            	  <?php echo $model->trave_tour;?>
            </div>
            <div class="wj_tabcon" id="menu_tab_desc_2" style="display:none;" >
            	
            	
            	<div class="trave_descrbe_title">接待标准</div>
            	  <div class="trave_describe_content">
            	  	<?php echo $model->trave_receptionstandards;?>
            	  </div>
            	  
            	  
            	  <div class="trave_descrbe_title">预订须知</div>
            	  <div class="trave_describe_content">
            	  	<?php echo $model->trave_booknotice;?>
            	  </div>
            	  
            	   <div class="trave_descrbe_title">特色介绍</div>
            	  <div class="trave_describe_content">
            	  	<?php echo $model->trave_recommended;?>
            	  </div>
            	  
            	  <div class="trave_descrbe_title">温馨提示</div>
            	  <div class="trave_describe_content">
            	  	<?php echo $model->trave_tips;?>
            	  </div>
            	
            </div>
             <div class="wj_tabcon" id="menu_tab_desc_3" style="display:none;" >
            	  <div class="trave_descrbe_title">付款流程</div>
            	  <div class="trave_describe_content">
            	  	   <div class="flow_path">
              				<img src="/css/images/lc_img.gif" width="670" height="32" /></div>
              				<div class="flow_path"><h2 class="flow_path_h2">签约方式：</h2>
              				<p class="flow_path_p">传真签约：双方在合同上签字盖章后，通过传真进行签约。</p>
             				  <p class="flow_path_p">快递签约：易途旅游网提供快递签约、代收款服务。您确认合同并签字后完成签约。 </p>
              				<p class="flow_path_p">门市签约：地址：上海市岭南路1115号中铁大厦707
              				<p class="flow_path_p">附： <a href="/download/travelcontract/anquanxuzhi.doc">安全须知(Word)</a>&nbsp;&nbsp;<a href="/download/travelcontract/国内旅游合同.doc">上海市国内旅游合同范本(Word)</a>&nbsp;&nbsp;<a href="/download/travelcontract/出境游旅游合同.doc">上海市出境旅游合同范本(Word)</a></p>
            				</div>
            			<div class="flow_path">
            	  	 <h2 class="flow_path_h2">付款方式：</h2>
                	<div class="flow_path_bank">
                 	<h3>在线支付：</h3>
                 <ul>
                  <li><img src="/css/images/T01.gif" /></li>
                  <li ><img src="/css/images/T02.gif" /></li>
                  <li><img src="/css/images/T03.gif" /></li>
                  <li><img src="/css/images/T04.gif" /></li>
                  <li><img src="/css/images/T05.gif" /></li>
                  <li><img src="/css/images/T06.gif" /></li>
                  <li><img src="/css/images/T07.gif" /></li>
                  <li><img src="/css/images/T08.gif" /></li>
                  <li><img src="/css/images/T09.gif" /></li>
                  <li><img src="/css/images/T10.gif" /></li>
                 </ul>
              	</div>
              <div class="flow_path_pay">
                <ul>
                  <li>支付方式：支付宝，现金，网上银行，汇款，支票，刷卡。</li>
                  <li>网点支付：您可以通过便利店、邮局、药店等支付宝合作网点付款。</li>
                  <li>汇款：通过银行将相关款项汇至指定账户，户名及账号请咨询 021-56880166。</li>
                  <li>发票说明：按照国家相关规定，本产品提供“旅游费”发票，不提供其它类目发票。 <a href="<?php echo $this->createUrl("help/index",array('cid'=>'10','#' => 'q5')); ?>">如何获取发票</a></li>
                </ul>
             </div>
 
            </div>

            	</div>
            </div>
            
            
            <div class="wj_tabcon" id="menu_tab_desc_4" style="display:none;" >
            	  <div class="trave_descrbe_title">网友评论</div>
            	  <?php $this->renderDynamic(travel_comments); ?>
            </div>
            
            
            <div class="wj_tabcon" id="menu_tab_desc_5" style="display:none;" >
            	  <div class="trave_descrbe_title">在线咨询</div>
            	   <?php $this->renderDynamic(travel_consulting); ?>
            </div>
                
        </div><!--wj_plane end-->
    </div><!--内容左边部分结束-->
<?php
  $this->widget('application.extensions.tipsy.Tipsy', array(
   'trigger' => 'hover',
   'items' => array(
     array('id' => '.trave_tipsy','gravity' => 'sw','html'=>true),

  ),  
));
?>  
 <script language="javascript">
 	
 	
 	var ts = "<?= $ts ?>";
 	var trave_id="<?= $model->id ?>";
  var t_trave_date="";
 	jQuery(document).ready(function(){
 		jQuery('#gallery a').lightBox();
 		click_trave_date();
 		jQuery(".jcarousel-prev-horizontal").hover(
      function(){
        jQuery(this).addClass("jcarousel-prev-horizontal-hover");
      },
      function(){
       jQuery(this).removeClass("jcarousel-prev-horizontal-hover");
      }
    ); 
    
     jQuery(".jcarousel-next-horizontal").hover(
      function(){
        jQuery(this).addClass("jcarousel-next-horizontal-hover");
      },
      function(){
      	
       jQuery(this).removeClass("jcarousel-next-horizontal-hover");
      }
    ); 

 		var con="<?= $con ?>";
 		 if(con){
 		 	change_trave_tab(5,5);
 		 }
 		 
 		 var tc="<?= $tc ?>";
 		 if(tc){
 		 	change_trave_tab(4,5);
 		 }
 		 jQuery("#comment_on_click").click();
 		 jQuery("#consulting_on_click").click();
 		 var click_flag=false;
	 	 var active_ration="";
 		 var trave_date=get_trave_date_datas();
 		 t_trave_date=trave_date.std_value;
 		 get_trave_flight_p(trave_id,trave_date.date_key,trave_date.std_value);
 		 get_trave_hotels_p(trave_id,trave_date.std_value,1);
 		 jQuery("#select_trave_date").change(function(){
 		    	 var trave_date=get_trave_date_datas();
 		    	 
 		    	 std_value=trave_date.std_value;
 		    	 t_trave_date=trave_date.std_value;
 		    	 get_trave_flight_p(trave_id,trave_date.date_key,trave_date.std_value);
 		       get_trave_hotels_p(trave_id,std_value,1);
 		 });
 		 
 		 
 		 jQuery("#adult_nums").change(function(){
 		 	   
 		 	   calculation_free_total();
 		});
 		
 		jQuery("#child_nums").change(function(){
 		 	  calculation_free_total();
 		});
 		
 		jQuery("#room_nums").change(function(){
 			   var room_nums=jQuery("#room_nums").val();
 			   if(!room_nums){
 			   	  alert("房间数不能为空");
 			   	  return;
 			   }
 			      
 		 	   calculation_free_total();
 		});

  }); 
  
  
   function show_light_box(click_a){
  	
  	jQuery("#clicka_"+click_a).click();
  	
  } 
  
  function calculation_free_total(){
    var trave_date=get_trave_date_datas();
  	var room_price=parseInt(jQuery("#room_price").val());
  	var flight_price=parseInt(jQuery("#flight_price").val());
  	var trave_route_number=parseInt(jQuery("#trave_route_number").val());
  	var adult_nums=jQuery("#adult_nums").val()
  	var child_nums=jQuery("#child_nums").val();
  	var room_nums=jQuery("#room_nums").val();
  	if(!adult_nums)
  	   adult_nums=0;
  	if(!child_nums)
  	   child_nums=0;
  	if(!room_nums)
  	   room_nums=0;
  	if(!room_price)
  	   room_price=0;
  	if(!flight_price)
  	   flight_price=0;
  	var t_adult_nums=parseInt(adult_nums);
  	var t_child_nums=parseInt(child_nums);
  	var t_room_nums=parseInt(room_nums);
  	var t_total_nums=t_adult_nums+t_child_nums;
  	var total_price=(room_price*t_room_nums*trave_route_number)+(flight_price*t_total_nums);
  	if(!t_total_nums){
  		var people_price=0;
  	}else{
  		var people_price=Math.ceil(total_price/(t_total_nums));
  	}
  	if(!people_price){
  		people_price=0;
  	}
  	if(!total_price){
  		total_price=0;
  	}
  	jQuery("#people_total_price").html(people_price);
  	jQuery("#trave_total_price").html(total_price);
  	jQuery("#trave_total_price_1").html(total_price);
  }


  function submit_order_form(){
  	var trave_date_data=get_trave_date_datas();
  	document.getElementById("hidden_trave_route_number").value=parseInt(jQuery("#trave_route_number").val());
  	document.getElementById("hidden_room_id").value=jQuery("#room_id").val();
  	document.getElementById("hidden_hotel_id").value=jQuery("#hotel_id").val();
  	
  	document.getElementById("hidden_total_price").value=jQuery("#trave_total_price").html();
  	document.getElementById("start_date_id").value=trave_date_data.date_key;
  	var adult_nums=jQuery("#adult_nums").val();
  	var child_nums=jQuery("#child_nums").val();
  	var trave_route_number=jQuery("#trave_route_number").val();
  	var hidden_room_id=jQuery("#hidden_room_id").val();
 
  	var room_nums=jQuery("#room_nums").val();
  	if(!adult_nums)
  	   adult_nums=0;
  	if(!child_nums)
  	   child_nums=0;
  	var total_people=parseInt(adult_nums+child_nums);
  	
    if(!total_people){
    	alert('人数不能为空');
    	return;
    }
    if(!room_nums){
    	alert("房间数不能为空");
    	return;
    }
    if(!trave_route_number){
    	alert("入住晚数不能为空");
    	return;
    }
    if(!hidden_room_id){
    	alert("请选择房型");
    	return;
    }

  	submit_form("travelforder");
  }
/*
    function show_mapdialog(){
     var trave_sregion="<?= $trave_sregion_data['district_name'] ?>";
     var trave_region="<?= $trave_region_data['district_name'] ?>";
     var trave_id="<?= $model->id ?>";
     
     var frame_dialog=new FrameDialog();
     frame_dialog.show_dialog("查看地图",{"ok_button":{"name":"确定"},"cancel_button":{"name":"取消"}},{"width":760,"height":350,"FrameUrl":"/index.php/maps/index?trave_sregion="+trave_sregion+"&trave_region="+trave_region+"&trave_id="+trave_id,"overlay":true});
    
  
   }
  */ 
  
 </script>
 <?php   
   $this->endCache(); 
        } 
 ?>
