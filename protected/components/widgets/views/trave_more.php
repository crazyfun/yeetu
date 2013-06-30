	  <!--around_two end-->
      <div class="around_two">
        
        	<h2 class="title"><span class="travel_more_title">
        	<?php
        	   $district=new District();
  		       $district_datas=$district->get_table_datas($province_id,array());
  		       echo $district_datas->district_name;
        	?></span>旅游线路</h2>
        <?php 
            $trave_comment=new TraveComment();
            foreach($trave_more as $key => $value){
        ?>
            	 <div class="around_list_desc">
            	    <span><A href="" ><?php echo $value['district_name'];?></A></span>
            	 </div>
        				
        				<table class="around_table" >
        				<thead class="around_tr">
          			
            			<th width="65" style="text-align:center;">编号</th>
           			  <th width="80">易途价</th>
            			<th class="lb2">路线</th>
            			<th class="lb2" width="40">订单</th>
            			<th class="lb2" width="80">评价</th>
            			<th class="lb2" style="text-align:center; width:65px;">团期</th>
          		</thead>        	
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
          			      <span class="around_price"><?php echo Util::enlarge_first($trave->get_trave_price($value1->id));?>元起</span>
          			    </td>
          			    <td>
          			       <a class="around_name" title="<?php echo $value1->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl('travel/detail',array('id'=>$value1->id,'n'=>$value1->trave_name));?>" target="_blank">
          			           <span class="around_name_bold"><?php echo $value1->trave_name;?></span>
          			       </a>
          			       <div class="trave_more_shot_des1">
          			       	
          			       	<?php echo Util::cs($value1->trave_shot_desc,100);?>
          			      </div>
          			   </td>
          			   <td>
          			       <span class="around_price"><?php echo Util::enlarge_first($value1->trave_numbers);?></span>
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
      
      <?php
  $this->widget('application.extensions.tipsy.Tipsy', array(
   'trigger' => 'hover',
   'items' => array(
     array('id' => '.trave_tipsy','gravity' => 'sw','html'=>true),

  ),  
));
?> 