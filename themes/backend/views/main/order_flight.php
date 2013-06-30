      <?php if(!empty($trave_flight_datas->id)){ ?>
      <div class="order_title">航班信息</div>
      <table cellspacing="0" class="view_order_table">
        	<thead>
	    		 <tr>
	          	<th class="t_f_2">出发地-目的地</th>
	          	<th class="t_f_3">航空公司</th>
	          	<th class="t_f_4">机型</th>
	          	<th class="t_f_5">航班</th>
	          	<th class="t_f_6">起飞时间</th>
	          	<th class="t_f_7">起飞地点</th>
	          	<th class="t_f_8">抵达时间</th>
	          	<th class="t_f_9">抵达地点</th>
	          	<?php if($is_package=='2'){ ?><th class="">航班价钱</th><?php } ?>
	          	
            </tr>
	    		</thead>
              <tbody>
              	<?php echo CHtml::hiddenField("flight_price",$flight_price,array('id'=>'flight_price'));?>

                <tr>
                  <td class="t_f_2"><span class="flight_content"><?php echo $trave_flight_datas->departure;?> - <?php echo $trave_flight_datas->destinations;?></span></td>
                  <td class="t_f_3"><span class="flight_content"><?php echo $trave_flight_datas->go_flight_com;?></span></td>
                  <td class="t_f_4"><span class="flight_content">
                  <?php if(!empty($trave_flight_datas->go_flight_type)){
                  	 echo $trave_flight_datas->go_flight_type;
                  }else{
                  	 echo "电询";
                  }
                  ?>	
                  </span></td>
                  <td class="t_f_5"><span class="flight_content"><?php echo $trave_flight_datas->go_flight;?></span>(参考)</td>
                  <td class="t_f_6"><span class="flight_content"><?php echo $trave_flight_datas->go_flight_time;?></span></td>
                  <td class="t_f_7"><span class="flight_content"><?php echo $trave_flight_datas->go_flight_airport;?></span></td>
                  <td class="t_f_8"><span class="flight_content"><?php echo $trave_flight_datas->go_flight_rtime;?></span></td>
                   <td class="t_f_8"><span class="flight_content"><?php echo $trave_flight_datas->go_flight_rairport;?></span></td>
                  <?php if($is_package=='2'){ ?><td class=""><span class="flight_content"><?php echo $flight_price;?></span></td><?php } ?>
                </tr>
                
         
                <?php if(!empty($back_trave_flight_datas->id)){ ?>
                <tr>
                  <td class="t_f_2"><span class="flight_content"><?php echo $back_trave_flight_datas->departure;?> - <?php echo $back_trave_flight_datas->destinations;?></span></td>
                  <td class="t_f_3"><span class="flight_content"><?php echo $back_trave_flight_datas->go_flight_com;?></span></td>
                  <td class="t_f_4"><span class="flight_content">
                  <?php if(!empty($back_trave_flight_datas->go_flight_type)){
                  	 echo $back_trave_flight_datas->go_flight_type;
                  }else{
                  	 echo "电询";
                  }
                  ?>	
                  </span></td>
                  <td class="t_f_5"><span class="flight_content"><?php echo $back_trave_flight_datas->go_flight;?></span>(参考)</td>
                  <td class="t_f_6"><span class="flight_content"><?php echo $back_trave_flight_datas->go_flight_time;?></span></td>
                  <td class="t_f_7"><span class="flight_content"><?php echo $back_trave_flight_datas->go_flight_airport;?></span></td>
                  <td class="t_f_8"><span class="flight_content"><?php echo $back_trave_flight_datas->go_flight_rtime;?></span></td>
                   <td class="t_f_8"><span class="flight_content"><?php echo $trave_flight_datas->go_flight_rairport;?></span></td>
                  <td class=""><span class="flight_content"></span></td>
                </tr>
                
              <?php } ?>
              
              </tbody>
            </table>
            
          <?php } ?>

    