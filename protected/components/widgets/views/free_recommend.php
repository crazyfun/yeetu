<div class="around_two">
        <h2 class="title"><a href="">自助游线路推荐</a></h2>
        <table class="around_table">
          <tr class="around_tr">
            <th width="65" style="text-align:center;">编号</th>
            <th width="80">易途价</th>
            <th class="lb2">路线</th>
            <th class="lb2" width="40">订单</th>
            <th class="lb2" width="80">满意</th>
            <th class="lb2" width="65" style="text-align:center;">团期</th>
          </tr>
          <tbody>
          	<?php 
          	   $trave_comment=new TraveComment();
          	   foreach($trave_free_datas as $key => $value){	
          	?>
          	   	  <tr id="travel_content_<?php echo $value->id;?>">
          	   	  	<td style="text-align:center;">
          	   	  		<span class="around_no"><?php echo $value->trave_number;?></span>
          	   	  	</td>
          	   	  	<td>
          	   	  		<span class="around_price"><?php echo Util::enlarge_first($trave->get_trave_price($value->id)); ?>元起</span>
          	   	  	</td>
          	   	  	<td>
          	   	  		<a class="around_name" title="<?php echo $value->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl('travel/detail',array('id'=>$value->id,'n'=>$value->trave_title));?>" target="_blank"><span class="around_name_bold"><?php echo $value->trave_name;?></a>
          	   	    </td>
          	   	    <td>
          	   	    	<span class="around_price"><?php echo $value->trave_numbers;?></span>
          	   	    </td>
				            <td>
				            	<span class="around_satisf"><? echo $trave_comment->get_trave_satisfied($value->id);?></span>
				           </td>
				           <td style="text-align:center;">
				           	  <span class="around_trave_date" trave_id="<?php echo $value->id;?>">查看团期</span>
				           </td>
				         </tr>
          	
          <?php } ?>
          </tbody>
        </table>
      </div>