<?php
	if(!empty($trave_bargin_detail)){
?>

<div class="around_two">
        <h2 class="title"><a href="">
        	<?php 
        	  $trave_category_name="";
        	  switch($trave_category){
        	  	case '1':
        	  	  $trave_category_name="出境旅游特价产品";
        	  	  break;
        	  	case '2':
        	  	  $trave_category_name="周边旅游特价产品";
        	  	  break;
        	  	case '3':
        	  	  $trave_category_name="国内旅游特价产品";
        	  	  break;
        	  	case '4':
        	  	  $trave_category_name="公司旅游特价产品";
        	  	  break;
        	  	case '5':
        	  	  $trave_category_name="自由行特价产品";
        	  	  break;
        	  	default:
        	  	  break;
        	  	
        	  }
        	  echo $trave_category_name;
        	?>
        	
        	
        	
        	</a></h2>
        	
       <div class="ar-box"> 	
       <?php 
          	   $trave_comment=new TraveComment();
          	   foreach($trave_bargin_detail as $key => $value){	
      ?>
	  	   <div class='b_trave_wrapp'>
        		<div class='b_trave_img'><?php echo $trave->get_trave_first_image($value->id);?></div>
        		<div class='b_trave_desc'>
        			<div class='b_trave_name'>
        				<a title="<?php echo $value->trave_name; ?>" href='<?php echo $this->controller->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>' target='_blank' title='<?php echo $value->trave_name;?>'><?php echo $value->trave_name;?>
			          </a>
			         </div>
			         <div class='b_trave_content'>
			         	
			         	<table class="b_trave_content_table">
			         		<tbody>
			         			<tr>
			         				 
			         				 <td class="b_trave_order_td">
			         				 		订单数:<span class='around_price'><?php echo ($value->trave_numbers > $value->system_indent)?$value->trave_numbers : $value->system_indent;?></span>
			         				 	</td>
			         				 	
			         				 <td class="b_around_satisf_td">
			         				 	<span class="b_around_satisf"><?php echo $trave_comment->get_trave_b_satisfied($value->id);?></span>
			         				 </td>
			         				 
			         				 <td class="b_around_price_td">
			         				 	  易途价:<span class='around_price'><?php if($this->trave_category=='4') echo "一团一议"; else echo Util::enlarge_first($trave->get_trave_price($value->id))."元起";?></span>
			         				 </td>
			         				 	
			         				 	<td class="b_order_a_td">
			         				 		  <a title='立即预订'  href='<?php echo $this->controller->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>' target='_blank' title='<?php echo $value->trave_name;?>' target='_blank'>立即预订</a>
			         				 	</td>
			         			</tr>
			         			<tr>
			         				<td colspan="4">
			         					  <div class="trave_more_shot_des">
			         					  	  <?php echo Util::cs($value->trave_shot_desc,200);?>
			         					  </div>
			         				</td>
			         			</tr>
			         			
			         		</tbody>
			         		
			         	</table>

               </div>
        
             </div>
             <div class='clear_float'></div>
          </div>
	  	<?php } ?>
	  		</div>
      </div>
	  <?php }?>
