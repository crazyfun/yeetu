<div class="sch_line">
            	<div class="sch_l_title">线路搜索</div>
            	<div class="sch_l_con">
            		<?php echo CHtml::beginForm(Yii::app()->getController()->createUrl("search/index"),"GET",array("id"=>'searchform'));?>
                	<?php echo CHtml::hiddenField("did","",array('id'=>"hidden_fdistrict_id"));?>
                 	<?php echo CHtml::hiddenField("tcid","",array('id'=>'hidden_trave_category'));?>
                 		<?php echo CHtml::hiddenField("pdid","",array('id'=>'hidden_pfdistrict_id'));?>
                	<table cellpadding="0" cellspacing="0" width="100%">
                    	<tr>
                        	<td width="80" align="right">出发城市：</td>
                            <td>
                            	<div class="sel_con">
                                	<?php 
                 	 								 	$search_trave_sregion=$this->controller->trave_sregion;
                 	  								echo CHtml::dropDownList("trave_sregion",$search_trave_sregion,$sregion_datas,array('class'=>'search_select'));
                 	 								?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                        	<td align="right">目的地：</td>
                            <td>
                            	<div class="sel_con">
                            		<div class="trave_region_wrapp">
                            			
                                	<input readonly type="text" name="trave_region" id="trave_region" class="s_txt_put"/>
                                	
                                	
                     <div class="trave_region_content" id="trave_region_content">
                     	<div class="trave_region_content_rightr"><img src="/css/images/tn_search_bgr.gif"/></div>
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
  
                		
                                </div>
                            </td>
                        </tr>
                        <tr><td align="right">预算：</td><td><?php echo CHtml::dropDownList("budget",'',CV::$BUDGET_DATAS,array('class'=>'search_select'));?></td></tr>
                    	<tr><td>&nbsp;</td><td><input type="submit" class="sub_seach_line" value=""></td></tr>
                    </table>
                    <?php echo CHtml::endForm();?>
                </div>
            </div>
             
   <script language="javascript">
   	   jQuery(document).ready(function(){
   	   	  
   	   	  jQuery("#search_trave_category").change(function(){
   	   	  	  var trave_category=jQuery(this).val();
   	   	  	  if(trave_category=='4'){
   	   	  	  	jQuery("#trt_item_condition").hide();
   	   	  	  	get_category_condition_content(trave_category);
   	   	  	  	
   	   	  	  }else{
   	   	  	  	 jQuery("#trt_item_condition").show();
   	   	  	     get_category_condition(trave_category);
   	   	  	  }
   	   	  });
   	   	
        	jQuery("#trave_region_content_close").bind("click",function(){
            jQuery("#trave_region_content").fadeOut("fast");
        	});

 });
   
     function get_category_condition(trave_category){
           jQuery.ajax({
			          type: "GET",
			          beforeSend: function(){},
			          url: "/index.php/site/searchcondition",
			          data: "trave_category="+trave_category+"&rnd="+Math.random(),
			          dataType:'json',
			          success: function(msg){
                    var json_array=msg;
                    var len=json_array.length;
                    var select_html="<select name='search_condition' id='search_condition'>";
                    for(var ii=0;ii<len;ii++){
                    	select_html+="<option value='"+json_array[ii].id+"'>"+json_array[ii].name+"</option>";
                    }
                    select_html+="</select>";
                    jQuery("#trt_condition_content").html(select_html);
                    var search_trave_condition=jQuery("#search_condition").val();
   	   	            get_category_condition_content(trave_category,search_trave_condition);	  
                    jQuery("#search_condition").unbind("change");
                    jQuery("#search_condition").bind("change",function(){
                    var search_condition=jQuery(this).val();
                    get_category_condition_content(trave_category,search_condition);
        	        });  
			         }
			        });	
    }
    
    
    function get_category_condition_content(trave_category,search_condition){
    	       var trave_region_center=jQuery('#trave_region_center');
    	      jQuery.ajax({
			                type: "GET",
			                beforeSend: function(){
				                 trave_region_center.html("<div class='loading_progress'><img  src='/css/images/progress.gif'></div>");
			                },
			                url: "/index.php/site/searchregion",
			                data: "search_condition="+search_condition+"&trave_category="+trave_category+"&rnd="+Math.random(),
			                dataType:'html',
			                success: function(msg){
			                   trave_region_center.html(msg);
			               }
			      });
       }

</script>