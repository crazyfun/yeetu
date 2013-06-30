<div class="order_title">酒店信息</div>
<?php if($is_package=='2'){ ?>
<div class="trave_order_hotels">
	<div class="input_name">入住晚数</div><div class="input_content"><?php echo CHtml::textField("trave_route_number",$trave_route_number,array());?></div>
	<div class="input_name">房间数</div><div class="input_content"><?php echo CHtml::textField("room_nums",$room_nums,array());?></div>
</div>

<?php } ?>
<div class="clear_both"></div>
  <table cellspacing="0" class="view_order_table" >
	    	<thead>
	    		 <tr>
            	<th align="left">酒店房型</th>
            	<th align="left">床型</th>
            	<th align="left">宽带</th>
            	<th align="left">居住人数</th>
	          	<th align="left">早餐</th>
	          	<th align="left">挂牌价 </th>
            	<th align="left">易途价 </th>
	          	<?php if($is_package=='2'){ ?><th align="center" width="70">操作</th><?php } ?>
            </tr>
	    		</thead>
	      <tbody>
	      	   <?php foreach($hotel_room_datas as $key => $value){ ?>
	      	    	   <tr>
                    <td align="left"><?php echo $value->Hotels->hotel_name; ?>(<?php echo $value->get_room_name();?>)</td>
                    <td align="left"><?php echo $value->get_room_bed();?></td>
                    <td align="left"><?php echo $value->get_room_broadband();?></td>
                    <td align="left"><?php echo $value->get_room_people();?></td>
                    <td align="left"><?php echo $value->get_room_dinning();?></td>
                    <td align="left"><?php echo $value->room_price;?></td>
                    <td align="left"><?php echo $value->room_yprice;?></td>
                    <?php if($is_package=='2'){ ?><td align="center" width="70"><span class="hotel_radio"><?php if($room_id==$value->id) $checked=true; else $checked=false; echo CHtml::radioButton("check_hotel",$checked,array('id'=>'check_hotel_'.$value->id,'room_id'=>$value->id,'hotel_id'=>$value->hotel_id,'room_price'=>$value->room_yprice,'value'=>$value->id,'class'=>'check_hotel'));?></span></td><?php } ?>
                   	</tr>	
             <?php } ?>
          </tbody>
        </table>	
