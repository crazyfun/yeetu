             <?php $trave_comment=new TraveComment();?>
             <div class="special_offer" style="margin-top:12px;">
            	<div class="spe_top"><div class="t_title1">限时特价<span><a href="javascript:change_limit_tab(1,3);">周边</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:change_limit_tab(2,3);">国内</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:change_limit_tab(3,3);">出境</a></span></div></div>
   
            		<div id="menu_tab_desc_1" style="display:block;">
            			<?php foreach($peripheral_trave_datas as $key => $value){ ?>
            			
          <div class='b_home_trave_wrapp'>
        		<div class='b_trave_img'><?php echo $trave->get_trave_first_image($value->id);?></div>
        		<div class='b_home_trave_desc'>
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
			         				 	
			         				 <td class="b_home_around_satisf_td">
			         				 	<span class="b_around_satisf"><?php echo $trave_comment->get_trave_b_satisfied($value->id);?></span>
			         				 </td>
			         				 
			         				 <td class="b_around_price_td">
			         				 	  易途价:<span class='around_price'><?php if($value->trave_category=='4') echo "一团一议"; else echo Util::enlarge_first($trave->get_trave_price($value->id))."元起";?></span>
			         				 </td>
			         				 	
			         				 	<td class="b_order_a_td">
			         				 		  <a title='立即预订'  href='<?php echo $this->controller->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>' target='_blank' title='<?php echo $value->trave_name;?>' target='_blank'>立即预订</a>
			         				 	</td>
			         			</tr>
			         			<tr>
			         				<td colspan="4">
			         					  <div class="trave_home_more_shot_des">
			         					  	  <?php echo $value->trave_shot_desc;?>
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
            			
                <div class="travel_infor_more1"><a href="<?php echo Yii::app()->getController()->createUrl("travel/bargain"); ?>">更多»</a></div>
            		</div>
            		
            		<div id="menu_tab_desc_2" style="display:none;">
            			   
               <?php foreach($domestic_trave_datas as $key => $value)
                  { 
               	?>
          <div class='b_home_trave_wrapp'>
        		<div class='b_trave_img'><?php echo $trave->get_trave_first_image($value->id);?></div>
        		<div class='b_home_trave_desc'>
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
			         				 	
			         				 <td class="b_home_around_satisf_td">
			         				 	<span class="b_around_satisf"><?php echo $trave_comment->get_trave_b_satisfied($value->id);?></span>
			         				 </td>
			         				 
			         				 <td class="b_around_price_td">
			         				 	  易途价:<span class='around_price'><?php if($value->trave_category=='4') echo "一团一议"; else echo Util::enlarge_first($trave->get_trave_price($value->id))."元起";?></span>
			         				 </td>
			         				 	
			         				 	<td class="b_order_a_td">
			         				 		  <a title='立即预订'  href='<?php echo $this->controller->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>' target='_blank' title='<?php echo $value->trave_name;?>' target='_blank'>立即预订</a>
			         				 	</td>
			         			</tr>
			         			<tr>
			         				<td colspan="4">
			         					  <div class="trave_home_more_shot_des">
			         					  	  <?php echo $value->trave_shot_desc;?>
			         					  </div>
			         				</td>
			         			</tr>
			         			
			         		</tbody>
			         		
			         	</table>

               </div>
        
             </div>
             <div class='clear_float'></div>
          </div>
                    
                <?php
                  }
                ?>  
               
                <div class="travel_infor_more1"><a href="<?php echo Yii::app()->getController()->createUrl("travel/bargain"); ?>">更多»</a></div>
            		</div>
            		<div id="menu_tab_desc_3" style="display:none;">
            			
            			    <?php foreach($nation_trave_datas as $key => $value)
                  { 
               	?>
          <div class='b_home_trave_wrapp'>
        		<div class='b_trave_img'><?php echo $trave->get_trave_first_image($value->id);?></div>
        		<div class='b_home_trave_desc'>
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
			         				 	
			         				 <td class="b_home_around_satisf_td">
			         				 	<span class="b_around_satisf"><?php echo $trave_comment->get_trave_b_satisfied($value->id);?></span>
			         				 </td>
			         				 
			         				 <td class="b_around_price_td">
			         				 	  易途价:<span class='around_price'><?php if($value->trave_category=='4') echo "一团一议"; else echo Util::enlarge_first($trave->get_trave_price($value->id))."元起";?></span>
			         				 </td>
			         				 	
			         				 	<td class="b_order_a_td">
			         				 		  <a title='立即预订'  href='<?php echo $this->controller->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>' target='_blank' title='<?php echo $value->trave_name;?>' target='_blank'>立即预订</a>
			         				 	</td>
			         			</tr>
			         			<tr>
			         				<td colspan="4">
			         					  <div class="trave_home_more_shot_des">
			         					  	  <?php echo $value->trave_shot_desc;?>
			         					  </div>
			         				</td>
			         			</tr>
			         			
			         		</tbody>
			         		
			         	</table>

               </div>
        
             </div>
             <div class='clear_float'></div>
          </div> 
                <?php
                  }
                ?>  
                 
                <div class="travel_infor_more1"><a href="<?php echo Yii::app()->getController()->createUrl("travel/bargain"); ?>">更多»</a></div>
            		</div>  	
            </div><!--special_offer end-->
 
