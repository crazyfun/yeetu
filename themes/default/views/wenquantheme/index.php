	<?php 
           Yii::app()->clientScript->registerScriptFile('/js/wenquantheme/jcarousel/jquery.jcarousel.min.js');
           Yii::app()->clientScript->registerCssFile('/js/wenquantheme/jcarousel/skins/tango/skin.css');
?>
	<div class="main_Con">
    	<div class="topCon">
            <div id="slides" class="slider"><!--滚动图片开始-->
                    <div class="slides_container" style="overflow: hidden; position: relative; display: block;">
                      
                      <div class="slides_control" style="position: relative; width: 1893px; height: 310px; left: -631px;"><div class="slide" style="position: absolute; top: 0px; left: 631px; z-index: 0; display: block;">
                        <img id="wrapper_image" width="631px" height="310px" src="/css/images/wenquan_theme/slider01.jpg">
                        <div style="bottom: 0px;" class="caption" id="wrapper_image_title">
                          <p>武义 沁温泉</p>
                        </div>
                      </div>

                    </div>
  
                    </div>
                    
                    <div class="pages">
                       
        
                            <ul  id="mycarousel" class="jcarousel-skin-tango pagination">
                        			 <li class="thumb_image current" index="0"><img width="130px" height="100px" src="/css/images/wenquan_theme/thumb01.jpg"></li>
                          		 <li class="thumb_image" index="1"><img width="130px" height="100px" src="/css/images/wenquan_theme/thumb02.jpg"></li>
                          		 <li class="thumb_image" index="2"><img width="130px" height="100px" src="/css/images/wenquan_theme/thumb03.jpg"></li>
                         			 <li class="thumb_image" index="3"><img width="130px" height="100px" src="/css/images/wenquan_theme/thumb04.jpg"></li>

                            </ul>
  
                    </div>
             </div><!--滚动图片结束-->
             <div class="infor">
                <div><img src="/css/images/wenquan_theme/r_top_img.jpg" /></div>
                <h2 class="r_top_title"></h2>
                <p>
                    温泉热浴不仅可使肌肉、关节松弛，
    消除疲劳；还可扩张血管，促进血液
    循环，加速人体新陈代谢。此外，大
    多数温泉中都含有丰富的化学物质，对
    人体有一定的帮助。</p>
                    <p>
      比如，温泉中的碳酸钙对改善体质、
    恢复体力有相当的作用；而温泉所含丰
    富的钙、钾、氡等成分对调整心脑血管
    疾病，治疗糖尿病、痛风、神经痛、关
    节炎等均有一定效果；而硫磺泉则可软
    化角质，含钠元素的碳酸水有漂白软化
    肌肤的效果。
                </p>
             </div><!--infor end-->
             <div class="clear_float"></div>
         </div><!--topCon end-->
         <div class="line_Con">
         	<div class="line_Con_title"><div><a href="<?php echo $this->createUrl("search/index",array('trave_name'=>'温泉'));?>">更多></a></div></div>
         	<div class="list_tab">
            	<table cellpadding="0" cellspacing="0" width="100%">
                	<colgroup>
                    	<col width="120" />
                        <col width="" />
                        <col width="180" />
                        <col width="150" />
                    </colgroup>
                    
             <?php
               $trave=Trave::model();
               $trave_datas=$trave->get_travel_data_by_ids(array(array('id'=>'323','image'=>''),array('id'=>'316','image'=>''),array('id'=>'319','image'=>''),array('id'=>'320','image'=>''),array('id'=>'322','image'=>''),array('id'=>'267','image'=>''),array('id'=>'58','image'=>''),array('id'=>'59','image'=>''),array('id'=>'60','image'=>'')));
               foreach($trave_datas as $key => $value){
               	  if(!empty($value)){
            ?>	

                	<tr class="<?php if($key%2==0) echo 'even'; else echo 'odd';?>">
                    	<td><div class="list_img_con"><img src="<?php echo $value['image'];?>" /></div></td>
                        <td>
                        	<div class="line_t"><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>"><?php echo $value['trave_name'];?></a></div>
                        	<div class="line_detail"><?php echo $value['trave_shot_desc'];?></div>
                            
                        </td>
                        <td><span class="pay_span">￥<?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></span></td>
                    	<td><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" class="yd_bt"></a></td>
                    </tr>
                <?php
                   } 
                  } 
                ?>    
                    
                   
                </table>
            </div>
         </div><!--line_Con end-->
    </div><!--main_Con end-->
<script language="javascript">
	     jQuery(function(){  
            //为ul设置jCarousel插件  
            jQuery("#mycarousel").jcarousel({
            	'auto':4,
            	'wrap':'circular'
            });  
            var slide_images=new Array('/css/images/wenquan_theme/slider01.jpg','/css/images/wenquan_theme/slider02.jpg','/css/images/wenquan_theme/slider03.jpg','/css/images/wenquan_theme/slider04.jpg');
            var slide_titles=new Array('武义 沁温泉','汤山 圣泉温泉','汤山 颐尚温泉','宁海 森林温泉');
            jQuery(".thumb_image").bind("click",function(){
            	 var index=jQuery(this).attr("index");
            	 jQuery(".current").removeClass("current");
            	 jQuery(this).addClass("current");
            	 jQuery("#wrapper_image").attr("src",slide_images[index]);
            	 jQuery("#wrapper_image_title").html(slide_titles[index]);
            	
            });
        }); 
        
       
</script>