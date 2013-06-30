<div class="around_two">
        <h2 class="title"><a href="">本周热卖线路排行</a></h2>
        <table class="around_table">
          <tr class="around_tr">
            <th width="65" style="text-align:center;">图片</th>
            <th width="80">易途价</th>
            <th class="lb2">路线</th>
            <th class="lb2" width="40">订单</th>
            <th class="lb2" width="80">满意</th>
            <th class="lb2" width="65" style="text-align:center;">团期</th>
          </tr>
          <tbody>
          	<?php 
          	   $trave_comment=new TraveComment();
          	   foreach($trave_week_datas as $key => $value){	
          	?>
          	   	  <tr id="travel_content_<?php echo $value->id;?>">
          	   	  	<td style="text-align:center;padding:2px 2px;">
          	   	  		<span class="around_no"><span class="newest_trave_box1_img"><?php echo $trave->get_trave_first_image($value->id);?></span></span>
          	   	  	</td>
          	   	  	<td>
          	   	  		<span class="around_price"><?php $trave_price=$trave->get_trave_price($value->id);if($this->trave_category=='4') echo "一团一议"; else echo Util::enlarge_first($trave_price)."元起"; ?></span>
          	   	  	</td>
          	   	  	<td>
          	   	  		<div class="trave_hover_static">
          			       <a class="around_name" title="<?php echo $value->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl('travel/detail',array('id'=>$value->id,'n'=>$value->trave_title));?>" target="_blank">
          			           <span class="around_name_bold"><?php echo Util::cs($value->trave_name,24);?></span>
          			       </a>
          			       <div class="row_static">
          			       <div class="trave_recommend_hover">
          			        <div class="r_trave_hover_di"><?php echo $value->get_trave_hover_image($value->id);?></div>
                    	   <div class="rr_trave_hover_dd">
                    	     	 <div class="r_trave_hover_ds"><?php echo $value->trave_shot_desc;?></div>
                    	     	 <div class="r_trave_hover_dp"><span class="rr_trave_hover_price">订单数:<?php echo ($value->trave_numbers > $value->system_indent)?$value->trave_numbers : $value->system_indent;?>&nbsp;&nbsp;易途价:<?php if($value->trave_category=='4') echo "一团一议"; else echo Util::enlarge_first($trave_price)."元起";?>&nbsp;&nbsp;</span><span class="r_trave_hover_order"><a title="<?php echo $value->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title))?>"><img src="/css/images/guzhen/ordernow.gif"></a></span></div> 	 
                    	  </div>
                    	 </div>
                    	</div>
          			      </div>

          	   	    </td>
          	   	    <td>
          	   	    	<span class="around_price"><?php echo ($value->trave_numbers > $value->system_indent)?$value->trave_numbers : $value->system_indent;?></span>
          	   	    </td>
				            <td>
				            	<span class="around_satisf"><?php echo $trave_comment->get_trave_satisfied($value->id);?></span>
				           </td>
				           <td style="text-align:center;">
				           	  <span class="around_trave_date" trave_id="<?php echo $value->id;?>">查看团期</span>
				           </td>
				         </tr>
          	
          <?php } ?>
          </tbody>
        </table>
      </div>