<div class="banner-con"><img src="/css/images/tejia_theme/banner_3.jpg"></div>
    <div class="panic-title1"><div>&nbsp;</div></div>
    <div class="panic_buy">
        <div class="ul-con">
            <ul>
            <?php
               $trave=Trave::model();
               $trave_datas=$trave->get_travel_data_by_ids(array(array('id'=>'266','image'=>''),array('id'=>'267','image'=>''),array('id'=>'32','image'=>''),array('id'=>'14','image'=>''),array('id'=>'30','image'=>''),array('id'=>'31','image'=>'')));
               foreach($trave_datas as $key => $value){
            ?>	
            	
            	<li>
                	<div class="shade_con">
                    	<div class="border_con"> 
                            <div class="pic-show"><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>"><img src="<?php echo $value['image'];?>" /></a></div>
                            <div class="travel_name"><a title="<?php echo $value['trave_name']; ?>" href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>"><?php echo $value['trave_name'];?></a></div>      
                            <div class="buy-bt-con">
                                <div class="price-detail">
                                    <a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value['id'],'n'=>$value['trave_title'])); ?>"></a>
                                    <div class="price_num"><?php if($value['trave_category']=='4') echo "一团一议"; else echo Util::enlarge_first($trave->get_trave_price($value['id']))."元";?></div>
                                    <div class="discount">立定立减<strong><font color="#ff6600"><?php echo $value['coupon'];?></font></strong>元</div>
                                </div>
                                <div class="original_price">
                                    <div class="ori_p">&nbsp;</div>
                                    <div class="have_buy"><strong><?php echo ($value['trave_numbers'] > $value['system_indent'])?$value['trave_numbers'] : $value['system_indent'];?></strong>人已购买</div>
                                </div>
                            </div>
                   		</div>
                        <div class="shade-bottom"></div>
                    </div>
                </li> 	
            <?php } ?>

            </ul>
            <div class="clear_float"></div>
        </div>
	</div><!--panic_buy end-->
    <?php
       $trave=new Trave();
			 $trave_sregion=Yii::app()->getController()->trave_sregion;
			 $nation_trave_datas=$trave->get_limited_special('1',$trave_sregion);
			 $domestic_trave_datas=$trave->get_limited_special('3',$trave_sregion);
			 $peripheral_trave_datas=$trave->get_limited_special('2',$trave_sregion);
    ?>
   <?php if(!empty($peripheral_trave_datas)){ ?>
    <!--<div class="ad-pic-con"><img src="/css/images/tejia_theme/ad_pic1.jpg" /></div>-->
    <div class="panic-title2"><div>&nbsp;</div></div>
	<div class="travel-line">
    	<table cellpadding="0" cellspacing="0" width="100%">
        	 <tr><th width="470">路线</th><th class="th-left" width="150">易途价</th><th class="th-left" width="80">立定即减</th><th class="th-left" width="80">预定人数</th><th class="th-left">抢购</th></tr>
        	  <?php foreach((array)$peripheral_trave_datas as $key => $value){ ?>
               <tr><td><div class="line-detail"><a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>"  title='<?php echo $value->trave_name;?>'><?php echo $value->trave_name;?></a></div></td><td><strong><?php echo Util::enlarge_first($trave->get_trave_price($value->id));?>元起</strong></td><td><strong><?php echo $value->coupon; ?>元</strong></td><td><strong><?php echo ($value->trave_numbers > $value->system_indent)?$value->trave_numbers : $value->system_indent;?>人</strong></td><td><div class="but-bt-con"><a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>" title='<?php echo $value->trave_name;?>'></a></div></td></tr>	
          <?php } ?>
            
            
        </table>
    </div>
    <?php } ?>
    
    <?php if(!empty($domestic_trave_datas)){ ?> 
     <!--<div class="ad-pic-con"><img src="/css/images/tejia_theme/ad_pic1.jpg" /></div>-->
    <div class="panic-title3"><div>&nbsp;</div></div>
	<div class="travel-line">
    	<table cellpadding="0" cellspacing="0" width="100%">
        	 <tr><th width="470">路线</th><th class="th-left" width="150">易途价</th><th class="th-left" width="80">立定即减</th><th class="th-left" width="80">预定人数</th><th class="th-left">抢购</th></tr>
        	  <?php foreach((array)$domestic_trave_datas as $key => $value){ ?>
               <tr><td><div class="line-detail"><a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>"  title='<?php echo $value->trave_name;?>'><?php echo $value->trave_name;?></a></div></td><td><strong><?php echo Util::enlarge_first($trave->get_trave_price($value->id));?>元起</strong></td><td><strong><?php echo $value->coupon; ?>元</strong></td><td><strong><?php echo ($value->trave_numbers > $value->system_indent)?$value->trave_numbers : $value->system_indent;?>人</strong></td><td><div class="but-bt-con"><a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>" title='<?php echo $value->trave_name;?>'></a></div></td></tr>	
          <?php } ?>

        </table>
    </div>
   <?php } ?>
   <?php if(!empty($nation_trave_datas)){ ?> 
    <!--<div class="ad-pic-con"><img src="/css/images/tejia_theme/ad_pic1.jpg" /></div>-->
    <div class="panic-title4"><div>&nbsp;</div></div>
	<div class="travel-line">
    	<table cellpadding="0" cellspacing="0" width="100%">
        	 <tr><th width="470">路线</th><th class="th-left" width="150">易途价</th><th class="th-left" width="80">立定即减</th><th class="th-left" width="80">预定人数</th><th class="th-left">抢购</th></tr>
        	  <?php foreach((array)$nation_trave_datas as $key => $value){ ?>
               <tr><td><div class="line-detail"><a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>"  title='<?php echo $value->trave_name;?>'><?php echo $value->trave_name;?></a></div></td><td><strong><?php echo Util::enlarge_first($trave->get_trave_price($value->id));?>元起</strong></td><td><strong><?php echo $value->coupon; ?>元</strong></td><td><strong><?php echo ($value->trave_numbers > $value->system_indent)?$value->trave_numbers : $value->system_indent;?>人</strong></td><td><div class="but-bt-con"><a href="<?php echo $this->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>" title='<?php echo $value->trave_name;?>'></a></div></td></tr>	
          <?php } ?>
            
            
        </table>
    </div>
    <?php } ?>  
    
    
  