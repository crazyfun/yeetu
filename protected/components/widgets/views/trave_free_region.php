       <div class="search_line">
          <h2 class="search_line_t">自助游目的地</h2>
          <div class="user_line_m">
          	<?php 
          	      $trave=new Trave();
                  $trave_domestic_region=$trave->get_free_trave_distrinct('1');
            ?>
            <div class="cat_list"> 
                <div class="cat_list_left"><div class="free_domestic"></div></div>
                <div class="cat_list_right">
                <?php
                		 foreach($trave_domestic_region as $key => $value){
                		 	$district_value=$value['district_value'];
                		  foreach($district_value as $key1 => $value1){
                ?>
                <div class="cat_list_item"><a href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value1['id'],'tcid'=>$trave_category))?>"><?php echo $value1['name'];?></a></div>
                <?php  	
                 }
                }
                ?>
               </div> 
          </div>  
          <div class="clear_float"></div>		   	   	   	   	
           <?php 
                  $trave_nation_region=$trave->get_free_trave_distrinct('2');
            ?>
            <div class="cat_list"> 
                <div class="cat_list_left"><div class="free_nation"></div></div>
                <div class="cat_list_right">
                <?php
                		  foreach($trave_nation_region as $key => $value){
                		   $district_value=$value['district_value'];
                		   foreach($district_value as $key1 => $value1){
                ?>
                <div class="cat_list_item"><a href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value1['id'],'tcid'=>$trave_category))?>"><?php echo $value1['name'];?></a></div>
                <?php  	
                 }
                }
                ?>
               </div>
          </div>  
          <div class="clear_float"></div>		   	   	   	   	
          </div>
          <div class="search_line_b"></div>
        </div>
        <!--search_line end-->
