                    <?php
                      switch($trave_category){
                      	case '1':
                    ?><?php $nation_region=$trave->get_condition_trave_region($search_condition);
                		   	foreach($nation_region as $key => $value){
                		  ?>
                        <div class="travel_region_title"><a href="javascript:select_district('','1','出境游','');">出境游</a>-<a style="font-size:12px;" href="javascript:select_district('<?php echo $value['district_id'];?>','1','<?php echo $value['district_name'];?>','1');"><?php echo $value['district_name'];?></a></div>
                		   	   	   <div class="travel_region_catagory">
                		   	   	   	    <div class="trave_region_line"> 
                		   	   	   	   	    <div class="travel_region_city">
                		   	   	   	   	    	<?php
                		   	   	   	   	    	    $district_value=$value['district_value'];
                		   	   	   	   	    	    foreach($district_value as $key1 => $value1){
                		   	   	   	   	    	?>
                		   	   	   	   	    	    <div class="travel_region_city_name"><a href="javascript:select_district('<?php echo $value1['id'];?>','1','<?php echo $value1['name'];?>','');"><?php echo $value1['name'];?></a></div>
                		   	   	   	   	    	<?php  	
                		   	   	   	   	    	    }
                		   	   	   	   	    	?>
                		   	   	   	   	    </div>
                		   	   	   	   	</div>
                		   	   	   	    
                		   	   	   </div>
                       <?php } ?>  
                    <?php
                      	  break;
                      	case '2':
                      	
                    ?>
                    <?php $peripheral_category=$trave->get_condition_trave_category($search_condition);
                		   	   	   	     foreach($peripheral_category as $key => $value){
                		?>
                       <div class="travel_region_title"><a href="javascript:select_district('','2','周边游','');">周边游</a>-<a style="font-size:12px;" href="javascript:select_district('<?php echo $value['district_id'];?>','2','<?php echo $value['district_name'];?>','1');"><?php echo $value['district_name'];?></a></div>
   	                  <div class="travel_region_catagory">
                		   	   	   	   
                		   	   	   	    <div class="trave_region_line"> 
                		   	   	   	   	  
                		   	   	   	   	    <div class="travel_region_city">
                		   	   	   	   	    	<?php
                		   	   	   	   	    	    $category_value=$value['district_value'];
                		   	   	   	   	    	    foreach($category_value as $key1 => $value1){
                		   	   	   	   	    	?>
                		   	   	   	   	    	    <div class="travel_region_city_name"><a href="javascript:select_district('<?php echo $value1['id'];?>','2','<?php echo $value1['name'];?>','');"><?php echo $value1['name'];?></a></div>
                		   	   	   	   	    	<?php  	
                		   	   	   	   	    	    }
                		   	   	   	   	    	?>
                		   	   	   	   	    </div>
                		   	   	   	   	</div>
                		   	   	   	   
                		   	   	   </div>	
                		   	   	<?php } ?>
                    <?php
                      	   break;
                      	case '3':
                    ?>
                     <?php $domestic_region=$trave->get_condition_trave_region($search_condition);
                		   	   	   	       foreach($domestic_region as $key => $value){
                		   	   	   	    ?>
                         <div class="travel_region_title"><a href="javascript:select_district('','3','国内游','');">国内游</a>-<a style="font-size:12px;" href="javascript:select_district('<?php echo $value['district_id'];?>','3','<?php echo $value['district_name'];?>','1');"><?php echo $value['district_name'];?></a></div>
                		   	   	   <div class="travel_region_catagory">
                		   	   	   	    <div class="trave_region_line"> 
                		   	   	   	   	 
                		   	   	   	   	    <div class="travel_region_city"">
                		   	   	   	   	    	<?php
                		   	   	   	   	    	    $district_value=$value['district_value'];
                		   	   	   	   	    	    foreach($district_value as $key1 => $value1){
                		   	   	   	   	    	?>
                		   	   	   	   	    	    <div class="travel_region_city_name"><a href="javascript:select_district('<?php echo $value1['id'];?>','3','<?php echo $value1['name'];?>','');"><?php echo $value1['name'];?></a></div>
                		   	   	   	   	    	<?php  	
                		   	   	   	   	    	    }
                		   	   	   	   	    	?>
                		   	   	   	   	    </div>
                		   	   	   	   	</div>
                		   	   	   </div>
                		   	   	    <?php } ?>
                    <?php
                      	   break;
                      	case '4':
                      	
                    ?>
                       <div class="travel_region_title"><a href="javascript:select_district('','4','团队旅游','');">团队旅游</a></div>
                		   	   	   <div class="travel_region_catagory">

                		   	   	   	   <?php $peripheral_category=$trave->get_travel_region('4');
                		   	   	   	     foreach($peripheral_category as $key => $value){
                		   	   	   	    ?>
                		   	   	   	    <div class="trave_region_line"> 
                		   	   	   	   	    <div class="travel_region_province"><a href="javascript:select_district('<?php echo $value['district_id'];?>','4','<?php echo $value['district_name'];?>','1');"><?php echo $value['district_name'];?></a></div>
                		   	   	   	   	    <div class="travel_region_city_group">
                		   	   	   	   	    	<?php
                		   	   	   	   	    	    $category_value=$value['district_value'];
                		   	   	   	   	    	    foreach($category_value as $key1 => $value1){
                		   	   	   	   	    	?>
                		   	   	   	   	    	    <div class="travel_region_city_name"><a href="javascript:select_district('<?php echo $value1['id'];?>','4','<?php echo $value1['name'];?>','');"><?php echo $value1['name'];?></a></div>
                		   	   	   	   	    	<?php  	
                		   	   	   	   	    	    }
                		   	   	   	   	    	?>
                		   	   	   	   	    </div>
                		   	   	   	   	</div>
                		   	   	   	   	<?php } ?>
                		   	   	   </div>
                    <?php
                      	   break;
                      	case '5':
                     ?>
                      <?php $free_region=$trave->get_condition_trave_region($search_condition);
                		   	   	   	     foreach($free_region as $key => $value){
                		   	   	   	    ?>
                          <div class="travel_region_title"><a href="javascript:select_district('','5','自助游','');">自助游</a>-<a style="font-size:12p;x" href="javascript:select_district('<?php echo $value['district_id'];?>','5','<?php echo $value['district_name'];?>','1');"><?php echo $value['district_name'];?></a></div>
                		   	   	   <div class="travel_region_catagory">
                		   	   	   	    <div class="trave_region_line"> 
                		   	   	   	   	    <div class="travel_region_city">
                		   	   	   	   	    	<?php
                		   	   	   	   	    	    $district_value=$value['district_value'];
                		   	   	   	   	    	    foreach($district_value as $key1 => $value1){
                		   	   	   	   	    	?>
                		   	   	   	   	    	    <div class="travel_region_city_name"><a href="javascript:select_district('<?php echo $value1['id'];?>','5','<?php echo $value1['name'];?>','');"><?php echo $value1['name'];?></a></div>
                		   	   	   	   	    	<?php  	
                		   	   	   	   	    	    }
                		   	   	   	   	    	?>
                		   	   	   	   	    </div>
                		   	   	   	   	</div>
                		   	   	   	    
                		   	   	   </div>
                         <?php } ?>
                     <?php
                      	   break;
                      }
                    ?>
