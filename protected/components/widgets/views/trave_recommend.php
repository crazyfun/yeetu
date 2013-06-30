	  <!--around_two end-->
      <div class="around_two">
        <h2 class="title">近期推荐线路</h2>
        <?php 
            $trave_comment=new TraveComment();
            foreach($trave_recommend as $key => $value){
        ?>
            	 <div class="around_list_desc">
            	    <span class="cat_more"><A href="<?php echo Yii::app()->getController()->createUrl('search/index',array('did'=>$value['district_id'],'tcid'=>$this->trave_category,'pdid'=>'1','ismore'=>'1'));?>" >更多»</A></span>
            	    <span><A href="" ><?php echo $value['district_name'];?></A></span>
            	 </div>
        				<table class="around_table" >
          			<tr class="around_tr">
            			<th width="65" style="text-align:center;">编号</th>
           			  <th width="80">易途价</th>
            			<th class="lb2">路线</th>
            			<th class="lb2" width="40">订单</th>
            			<th class="lb2" width="80">评价</th>
            			<th class="lb2" style="text-align:center; width:65px;">团期</th>
          		</tr>
          		<tbody>
          		
          		<?php 
          			$district_value=$value['district_value'];
          			foreach($district_value as $key1 => $value1){
          	  ?>
          			<tr id="travel_content_<?php echo $value1->id;?>">
          			    <td style="text-align:center;">
          			       <span class="around_no"><?php echo $value1->trave_number;?></span>
          			    </td>
          			    <td>
          			      <span class="around_price"><?php $trave_price=$trave->get_trave_price($value1->id); echo Util::enlarge_first($trave_price);?>元起</span>
          			    </td>
          			    <td>
          			    	<div class="trave_hover_static">
          			       <a class="around_name" title="<?php echo $value1->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl('travel/detail',array('id'=>$value1->id,'n'=>$value1->trave_title));?>" target="_blank">
          			           <span class="around_name_bold"><?php echo Util::cs($value1->trave_name,22);?></span>
          			       </a>
          			       <div class="row_static">
          			       <div class="trave_recommend_hover">
          			        <div class="r_trave_hover_di"><?php echo $value1->get_trave_hover_image($value1->id);?></div>
                    	   <div class="rr_trave_hover_dd">
                    	     	 <div class="r_trave_hover_ds"><?php echo $value1->trave_shot_desc;?></div>
                    	     	 <div class="r_trave_hover_dp"><span class="rr_trave_hover_price">订单数:<?php echo ($value1->trave_numbers > $value1->system_indent)?$value1->trave_numbers : $value1->system_indent;?>&nbsp;&nbsp;易途价:<?php if($value1->trave_category=='4') echo "一团一议"; else echo Util::enlarge_first($trave_price)."元起";?>&nbsp;&nbsp;</span><span class="r_trave_hover_order"><a title="<?php echo $value1->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value1->id,'n'=>$value1->trave_title))?>"><img src="/css/images/guzhen/ordernow.gif"></a></span></div> 	 
                    	  </div>
                    	 </div>
                    	</div>
          			      </div>
          			   </td>
          			   <td>
          			       <span class="around_price"><?php echo ($value1->trave_numbers > $value1->system_indent)? $value1->trave_numbers : $value1->system_indent;?></span>
          			   </td>
          			   <td>
          			     <span class="around_satisf"><?php echo $trave_comment->get_trave_satisfied($value1->id);?>
          			     </span>
          			   </td>
          			   <td align="center">
          			      <span class="around_trave_date" trave_id="<?php echo $value1->id;?>">查看团期</span>
          			   </td>
          			 </tr> 
          		<?php } ?>
          		</tbody>
          	</table>
         <?php
            }
         ?>
		
      </div>
      

      
      
      

      
