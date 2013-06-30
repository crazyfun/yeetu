<?php 
           Yii::app()->clientScript->registerScriptFile('/js/guoqingtheme/jcarousel/jquery.jcarousel.min.js');
           Yii::app()->clientScript->registerCssFile('/js/guoqingtheme/jcarousel/skins/tango/skin.css');
?>
<div class="main-con">
    <div class="main-banner"><img src="/css/images/guoqing_theme/banner_pic.jpg" /></div>
    <div class="desk_con"></div>
    <div class="main_detail">
        <div class="detail-left">
            <div class="de_part1">
                <h2>十一旅游目的地推荐</h2>
                
                <dl>
                  <dt><a href="javascript:void();">周边游</a></dt>	
              
                <?php
                 $trave=Trave::model();
                 $trave_region=$trave->get_guoqing_trave_category('2');
                 foreach($trave_region as $key => $value){
                		  $district_value=$value['district_value'];
                		  foreach($district_value as $key1 => $value1){
                ?>
                      <dd><a href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value1['id'],'tcid'=>'2'))?>"><?php echo $value1['name'];?></a></dd>
                 <?php } ?>
                <div class="clear_float"></div>
               <?php } ?>
               </dl>
               
               
               
                <dl>
                  <dt><a href="javascript:void();">国内游</a></dt>	
                
                <?php
                 $trave=Trave::model();
                 $trave_region=$trave->get_guoqing_travel_region('3');
                 foreach($trave_region as $key => $value){
                 ?>
                 
                     <dd><a class="city_a" href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value['district_id'],'tcid'=>'3','pdid'=>'1'))?>"><?php echo $value['district_name'];?></a></dd>
                     <?php
                		  $district_value=$value['district_value'];
                		  foreach($district_value as $key1 => $value1){
                ?>
                      <dd><a href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value1['id'],'tcid'=>'3'))?>"><?php echo $value1['name'];?></a></dd>
                   
                 <?php } ?>

                
                <div class="clear_float"></div>
               <?php } ?>
               </dl>
               
               <dl>
                  <dt><a href="javascript:void();">出境游</a></dt>	
               
                <?php
                $trave=Trave::model();
                 $trave_region=$trave->get_guoqing_travel_region('1');
                 foreach($trave_region as $key => $value){
                 ?>
                
                     <dd><a class="city_a" href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value['district_id'],'tcid'=>'1','pdid'=>'1'))?>"><?php echo $value['district_name'];?></a></dd>
                     <?php
                		  $district_value=$value['district_value'];
                		  foreach($district_value as $key1 => $value1){
                ?>
                      <dd><a href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value1['id'],'tcid'=>'1'))?>"><?php echo $value1['name'];?></a></dd>
                   
                 <?php } ?>

                
                <div class="clear_float"></div>
               <?php } ?>
               </dl>
                <dl>
                  <dt><a href="javascript:void();">自驾游</a></dt>	
                
                <?php
                $trave=Trave::model();
                 $trave_region=$trave->get_guoqing_travel_region('5');
                 foreach($trave_region as $key => $value){
                 ?>
                 
                     <dd><a class="city_a" href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value['district_id'],'tcid'=>'5','pdid'=>'1'))?>"><?php echo $value['district_name'];?></a></dd>
                     <?php
                		  $district_value=$value['district_value'];
                		  foreach($district_value as $key1 => $value1){
                ?>
                      <dd><a href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value1['id'],'tcid'=>'5'))?>"><?php echo $value1['name'];?></a></dd>
                   
                 <?php } ?>

                
                <div class="clear_float"></div>
               <?php } ?>
               </dl>
            </div>
            <!--de_part1 end-->

        </div>
        <div class="detail-right">
            <div class="rightpan"> 
                <!--幻灯 开始-->
                <div class="slider">
                    <div class="stit"> <span></span>
                        <h3> 十一特惠产品</h3>
                    </div>
                    <div class="slider-box infiniteCarousel">
                        <div class="wrapper" style="overflow: hidden;">
                            <ul  id="mycarousel" class="jcarousel-skin-tango">
                            	
                           <?php
                        	   $trave=Trave::model();
                        	   
                        	   $trave_datas=$trave->findAll(array("condition"=>"trave_status=:trave_status AND  trave_name LIKE '%国庆特惠%' AND recycle=0 ",'params'=>array(':trave_status'=>'2')));
                        
                        	   foreach($trave_datas as $key => $value){
                        	   	
                        	?>
                        	
                        			 <li class="cloned">
                                    <div> <a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"> <img alt="<?php echo $value['trave_name']; ?>" src="<?php echo $trave->get_first_image($value['id']);?>" style="width: 180px; height: 135px;"></a>
                                        <p> <a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"><?php  echo Util::cs($value['trave_name'],15); ?></a> <span class="money money01"><i>￥</i><b><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></b></span></p>
                                    </div>
                                </li>
                        	
                        	
                           <?php } ?>
                               
                               
                                
                                
                            </ul>
                            
                            
                            <div class="clear_float"> </div>
                        </div>
                      </div>
                </div>
                <!--幻灯 结束--> 
                <!--线路列表 开始-->
                
                <div class="listpan">
                    <div class="list-tit" style="border-top: 1px solid #d62010;">
                        <h3> 国内游旅游线路推荐</h3>
                    </div>
                    <div class="list-box">
                        <ul>
                        	
                        	<?php
                        	   $trave=Trave::model();
                        	   
                        	   $trave_datas=$trave->findAll(array("condition"=>"trave_status=:trave_status AND trave_category=:trave_category AND (trave_name LIKE '%国庆%' OR trave_name LIKE '%十一%') AND recycle=0 AND trave_recommend=:trave_recommend",'params'=>array(':trave_status'=>'2',':trave_category'=>'3',':trave_recommend'=>'2')));
                        
                        	   foreach($trave_datas as $key => $value){
                        	?>
                        	
                        	<?php if($key == '0'){ ?>
                        	<li class="li01">
                                <div class="m"> <a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"> <img src="<?php echo $trave->get_first_image($value['id']);?>" style="width: 143px; height: 108px;"></a></div>
                                <div class="t">
                                    <dl>
                                        <dt><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"><?php echo $value['trave_name']; ?></a></dt>
                                        <dd> <span class="money"><i>￥</i><b><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></b></span>
                                            <p><?php echo $value['trave_shot_desc'];?></p>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="clear_float"> </div>
                            </li>
                            
                         <?php }else{ ?>
                         
                             <li>
                                <dl>
                                    <dt><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"><?php echo $value['trave_name']; ?></a></dt>
                                    <dd> <span class="money"><i>￥</i><b><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></b></span> <span><?php echo $value['trave_shot_desc'];?></span></dd>
                                </dl>
                            </li>
                         
                         
                       <?php } ?>   
                            
                        	
                        	
                        <?php } ?>
                            
                            
          
                            
                        </ul>
                        <div class="clear_float"> </div>
                    </div>
                </div>
                <div class="listpan">
                    <div class="list-tit">
                        <h3> 周边旅游线路推荐</h3>
                    </div>
                    <div class="list-box">
                        <ul>
                           <?php
                             $trave=Trave::model();
                             
                        	   $trave_datas=$trave->findAll(array("condition"=>"trave_status=:trave_status AND trave_category=:trave_category AND (trave_name LIKE '%国庆%' OR trave_name LIKE '%十一%') AND recycle=0 AND trave_recommend=:trave_recommend",'params'=>array(':trave_status'=>'2',':trave_category'=>'2',':trave_recommend'=>'2')));
                        	   foreach($trave_datas as $key => $value){
                        	?>
                        	
                        	<?php if($key == '0'){ ?>
                        	<li class="li01">
                                <div class="m"> <a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"> <img src="<?php echo $trave->get_first_image($value['id']);?>" style="width: 143px; height: 108px;"></a></div>
                                <div class="t">
                                    <dl>
                                        <dt><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"><?php echo $value['trave_name']; ?></a></dt>
                                        <dd> <span class="money"><i>￥</i><b><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></b></span>
                                            <p><?php echo $value['trave_shot_desc'];?></p>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="clear_float"> </div>
                            </li>
                            
                         <?php }else{ ?>
                         
                             <li>
                                <dl>
                                    <dt><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"><?php echo $value['trave_name']; ?></a></dt>
                                    <dd> <span class="money"><i>￥</i><b><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></b></span> <span><?php echo $value['trave_shot_desc'];?></span></dd>
                                </dl>
                            </li>
                         
                         
                       <?php } ?>   
                            
                        	
                        	
                        <?php } ?>
                        </ul>
                        <div class="clear_float"> </div>
                    </div>
                </div>
                <div class="listpan">
                    <div class="list-tit">
                        <h3> 出境游旅游线路推荐</h3>
                    </div>
                    <div class="list-box">
                        <ul>
                              <?php
                              $trave=Trave::model();
                        	   $trave_datas=$trave->findAll(array("condition"=>"trave_status=:trave_status AND trave_category=:trave_category AND (trave_name LIKE '%国庆%' OR trave_name LIKE '%十一%') AND recycle=0 AND trave_recommend=:trave_recommend",'params'=>array(':trave_status'=>'2',':trave_category'=>'1',':trave_recommend'=>'2')));
                        	   foreach($trave_datas as $key => $value){
                        	?>
                        	
                        	<?php if($key == '0'){ ?>
                        	<li class="li01">
                                <div class="m"> <a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"> <img src="<?php echo $trave->get_first_image($value['id']);?>" style="width: 143px; height: 108px;"></a></div>
                                <div class="t">
                                    <dl>
                                        <dt><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"><?php echo $value['trave_name']; ?></a></dt>
                                        <dd> <span class="money"><i>￥</i><b><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></b></span>
                                            <p><?php echo $value['trave_shot_desc'];?></p>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="clear_float"> </div>
                            </li>
                            
                         <?php }else{ ?>
                         
                             <li>
                                <dl>
                                    <dt><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"><?php echo $value['trave_name']; ?></a></dt>
                                    <dd> <span class="money"><i>￥</i><b><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></b></span> <span><?php echo $value['trave_shot_desc'];?></span></dd>
                                </dl>
                            </li>
                         
                         
                       <?php } ?>   
                            
                        	
                        	
                        <?php } ?>
                        </ul>
                        <div class="clear_float"> </div>
                    </div>
                </div>
                <div class="listpan">
                    <div class="list-tit">
                        <h3> 自助游旅游线路推荐</h3>
                    </div>
                    <div class="list-box" style="border-bottom: 1px solid #d62010;">
                        <ul>
                          <?php
                          	$trave=Trave::model();
                        	   $trave_datas=$trave->findAll(array("condition"=>"trave_status=:trave_status AND trave_category=:trave_category AND (trave_name LIKE '%国庆%' OR trave_name LIKE '%十一%') AND recycle=0 AND trave_recommend=:trave_recommend",'params'=>array(':trave_status'=>'2',':trave_category'=>'5',':trave_recommend'=>'2')));
                        	   foreach($trave_datas as $key => $value){
                        	?>
                        	
                        	<?php if($key == '0'){ ?>
                        	<li class="li01">
                                <div class="m"> <a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"> <img src="<?php echo $trave->get_first_image($value['id']);?>" style="width: 143px; height: 108px;"></a></div>
                                <div class="t">
                                    <dl>
                                        <dt><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"><?php echo $value['trave_name']; ?></a></dt>
                                        <dd> <span class="money"><i>￥</i><b><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></b></span>
                                            <p><?php echo $value['trave_shot_desc'];?></p>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="clear_float"> </div>
                            </li>
                            
                         <?php }else{ ?>
                         
                             <li>
                                <dl>
                                    <dt><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>" target="_blank"><?php echo $value['trave_name']; ?></a></dt>
                                    <dd> <span class="money"><i>￥</i><b><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元起";?></b></span> <span><?php echo $value['trave_shot_desc'];?></span></dd>
                                </dl>
                            </li>
                         
                         
                       <?php } ?>   
                            
                        	
                        	
                        <?php } ?>
                        </ul>
                        <div class="clear_float"> </div>
                    </div>
                </div>
                
                <!--线路列表 结束--> 
            </div>
        </div>
        <!--detail-right end-->
        <div class="clear_float"></div>
    </div>
</div>


<script language="javascript">
	jQuery(function(){  
            //为ul设置jCarousel插件  
            jQuery("#mycarousel").jcarousel({
            	'auto':3,
            	'wrap':'circular'
            });  
        });  
</script>