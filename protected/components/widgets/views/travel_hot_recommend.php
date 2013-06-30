

<ul>
  <?php foreach($trave_hot_recommend as $key => $value){?>
          <li>
          	<div class="io<?php echo $key+1;?> trave_recommend_img"></div>
          	<div class="trave_recommend_title trave_hover">
          	<a title="<?php echo $value->trave_name; ?>" href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title))?>"><?php echo Util::cs($value->trave_name,23);?></a><?php if($value->trave_category=='4'){ echo "一团一议"; }else{ echo Util::enlarge_first($value->adult_price)."起";}?>
             <div class="trave_hover_details">
                    	  <div class="r_trave_hover_di"><?php echo $value->get_trave_hover_image($value->id);?></div>
                    	   <div class="r_trave_hover_dd">
                    	     	 <div class="r_trave_hover_ds"><?php echo Util::cs($value->trave_shot_desc,35);?></div>
                    	     	 <div class="r_trave_hover_dp"><span class="r_trave_hover_price">订单数:<?php echo ($value->trave_numbers > $value->system_indent)?$value->trave_numbers : $value->system_indent;?>&nbsp;&nbsp;价钱:<?php if($value->trave_category=='4') echo "一团一议"; else echo Util::enlarge_first($value->adult_price)."元起";?>&nbsp;&nbsp;</span><span class="r_trave_hover_order"><a title="<?php echo $value->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title))?>"><img src="/css/images/guzhen/ordernow.gif"></a></span></div> 	 
                    	  </div>
               </div>	   
            </div>
            <div class="clearfix"></div>
          </li>
      
  <?php } ?>
</ul>
