 <table cellspacing="0" class="order_table" >
	    	<thead>
	    		 <tr>
            	<th align="left">酒店房型</th>
	          	<th align="left"> 早餐</th>
	          	<th align="center" width="60">入住日期</th>
	          	<th align="center" width="70">退房日期</th>
	          	<th align="center" width="70"> 入住时间</th>
	          	<?php if(!empty($room_nums)){ ?>
	          	  <th align="center" width="70"> 数量</th>
	          	<?php } ?>
            </tr>
	    		</thead>
	      <tbody>
	      	   <?php foreach($hotel_room_datas as $key => $value){ ?>
	      	    	   <tr>
                    <td align="left"><a href="<?php echo $value->Hotels->hotel_url;?>"><?php echo $value->Hotels->hotel_name; ?>(<?php echo $value->get_room_name();?>)</a></td>
                    <td align="left"><?php echo $value->get_room_dinning();?></td>
                    <td align="center width="60""><?php echo $trave_date;?></td>
                    <td align="center" width="70"><?php  $end_date=strftime("%Y-%m-%d",(strtotime($trave_date)+(24*60*60)*$trave_route_number)); echo $end_date;  ?></td>
                    <td align="center" width="70"><?php echo $trave_route_number;?>晚</td>
                    <?php if(!empty($room_nums)){ ?>
                       <td align="center" width="70"><?php echo $room_nums;?></td>
                    <?php } ?>
                   	</tr>
                   	
             <?php } ?>
          </tbody>
        </table>	
