
        <div class="DIYtour_m2">  
        <?php echo CHtml::hiddenField("hotel_id","",array('id'=>'hotel_id'));?>
        <?php echo CHtml::hiddenField("trave_route_number",$trave_route_number,array('id'=>'trave_route_number'));?>
        <?php echo CHtml::hiddenField("room_price","",array('id'=>'room_price'));?>
        <?php echo CHtml::hiddenField("room_id","",array('id'=>'room_id'));?>
        <table>
          <tbody>
            <tr>
              <td>入住日期：<span  class="room_begin_date" id="room_begin_date"><?php echo $trave_date;?></span>
              </td>
              <td>住<?php echo CHtml::textField("trave_route_number_select",$trave_route_number,array('id'=>'trave_route_number_select','class'=>'trave_route_number_select',"onkeyup"=>"javascript:isNumber(this);"));?>晚
              </td>
              <td>退房日期：<span class="room_end_date" id="room_end_date"><?php $end_date=strftime("%Y-%m-%d",(strtotime($trave_date)+(24*60*60)*$trave_route_number)); echo $end_date; ?></span>
              </td>
            </tr>
          </tbody>
        </table>
        </div>
        <?php foreach($trave_hotels_datas as $key => $value){ ?> 
        <div>
        	<div class="ho_title"><h4><a href="<?php echo $value->hotel_url;?>" target="_blank"><?php echo $value->hotel_name;?></a></h4></div>
          <table class="DIYtour_m3_table">
            <tbody>
              <tr>
                <td valign="top" style="padding-top:10px;"><?php echo $value->get_travel_hotel_image();?></td>
                
                <td>
                	<table>
                		<tbody>
                			<tr id="hotel_information_<?php echo $key;?>">
                				<td align="top">
                					<?php echo Util::cs($value->hotel_information,180); ?>
                          <div class="htinm"><a href="javascript:show_hotel_information('<?php echo $key;?>');">更多描述»</a></div>
                				<td>
                			</tr>
                			
                			 <tr id="hotel_information_more_<?php echo $key;?>" style="display:none;">
              	         <td  align="top" class="hotel_info_txt"><?php echo $value->hotel_information; ?><div class="htinm"><a href="javascript:hide_hotel_information('<?php echo $key;?>');">隐藏»</a></div></td>
                       </tr>
                       
                      
                			
                		</tbody>
                	</table>
                </td>
              </tr>
              
               <tr>
                   <td colspan="2">
                       	  	  <?php $hotel_rooms=$value->get_hotel_rooms();?>
                    <table class="DIYtour_m4_table">
                      <tbody>
                        <tr>
                          <th class="hotel_t1">房型</th>
                          <th class="hotel_t2">早餐</th>
                          <th class="hotel_t3">床型</th>
                          <th class="hotel_t4">宽带</th>
                          <th class="hotel_t5">可住人数</th>
                          <th class="hotel_t6">易途价</th>
                        </tr>
                       
                       <?php foreach($hotel_rooms as $key1 => $value1){ ?>

                        <tr>
                          <td class="hotel_t1"><?php echo $value1->get_room_name();?></td>
                          <td class="hotel_t2"><?php echo $value1->get_room_dinning();?></td>
                          <td class="hotel_t3"><?php echo $value1->get_room_bed();?></td>
                          <td class="hotel_t4"><?php echo $value1->get_room_broadband();?></td>
                          <td class="hotel_t5"><?php echo $value1->get_room_people();?></td>
                          <td class="hotel_t6"><span class="room_yprice"><?php echo $value1->room_yprice;?>元</span><span class="hotel_radio"><?php echo CHtml::radioButton("check_hotel","",array('id'=>'check_hotel_'.$value1->id,'room_id'=>$value1->id,'hotel_id'=>$value1->hotel_id,'room_price'=>$value1->room_yprice,'class'=>'check_hotel'));?></span></td>
             
                        </tr>
                        
                      <?php } ?>
                       
                      </tbody>
                    </table>

                 
                       	  </td>
                       	
                      </tr>
            </tbody>
          </table>
          
        </div>
      <?php } ?>
      <div class="DIYtour_bnt"><a href="javascript:get_trave_hotels(trave_id,t_trave_date,'')"><img src="/css/images/DIY_btn3.gif" width="107" height="24" /></a></div>
<script language="javascript">
	jQuery(document).ready(function(){
		
		
	});
</script>