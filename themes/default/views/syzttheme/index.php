
	<div class="banner_con"><img src="/css/images/syzt_theme/banner.jpg" /></div>
    <div class="con-top-div"><div class="top-left-bg"></div><div class="top-right-bg"></div></div>
	<div class="con-middle-div">
    	<div class="con_top"></div>
    			
        <div class="con_middle">
        	<ul>
        		 <?php
               $trave=Trave::model();
               $trave_datas=$trave->get_travel_data_by_ids(array(array('id'=>'49','image'=>''),array('id'=>'25','image'=>''),array('id'=>'1','image'=>''),array('id'=>'75','image'=>''),array('id'=>'295','image'=>''),array('id'=>'275','image'=>'')));
               foreach($trave_datas as $key => $value){
            ?>	
            	<li>
                	<div class="li-top"></div>
                    <div class="li-main">
                		<div class="li-pic-con"><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>"><img src="<?php echo $value['image'];?>" /></a></div>
                		<div class="li-txt-title"><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>"><?php echo $value['trave_name'];?></a></div>
                		<div class="favorable"><?php echo Util::cs($value['trave_shot_desc'],16);?></div>
                    	<div class="remain"><span class="span_1">立定立减<span><?php echo $value['coupon'];?>元</span></span><span class="span_2">已预定<?php echo ($value['trave_numbers'] > $value['system_indent'])?$value['trave_numbers'] : $value['system_indent'];?>人</span></div>
                    	<div class="price_con"><span><?php if($value['trave_category']=='4') echo "一团一议"; else echo $trave->get_trave_price($value['id'])."元";?></span><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>">&nbsp;</a></div>
                	</div>
                </li>
                
             <?php } ?>
               
            </ul>
            <div class="clear_float"></div>
        </div>
        <div class="con_bottom"></div>

    