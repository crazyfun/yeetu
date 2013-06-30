       <div class="locality">
          <h2>
          	<?php 
        	  $trave_category_name="";
        	  switch($trave_category){
        	  	case '1':
        	  	  $trave_category_name="<img src='/css/images/chujinglvyou.jpg' width='120' heihgt='30'/>";
        	  	  break;
        	  	case '2':
        	  	  $trave_category_name="<img src='/css/images/zhoubianlvyou.jpg' width='120' heihgt='30'/>";
        	  	  break;
        	  	case '3':
        	  	  $trave_category_name="<img src='/css/images/guoneilvyou.jpg' width='120' heihgt='30'/>";
        	  	  break;
        	  	case '4':
        	  	  $trave_category_name="<img src='/css/images/gongsilvyou.jpg' width='120' height='30'/>";
        	  	  break;
        	  	case '5':
        	  	  $trave_category_name="<img src='/css/images/ziyouxxing.jpg' width='120' height='30'/>";
        	  	  break;
        	  	default:
        	  	  break;
        	  	
        	  }
        	echo $trave_category_name;
        	?></h2>
          <div class="locality_box">
          	<?php 
          	      $trave=new Trave();
          	      if($trave_category=='2'){
                     $trave_region=$trave->get_trave_category($trave_category);
                	}else{
                		 $trave_region=$trave->get_travel_region($trave_category);
          	       
          	      }
                	foreach($trave_region as $key => $value){
            ?>
            <dl> 
                <dt><a href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value['district_id'],'tcid'=>$trave_category,'pdid'=>'1'))?>"><?php echo $value['district_name'];?></a></dt>
               
                <?php
                		  $district_value=$value['district_value'];
                		  foreach($district_value as $key1 => $value1){
                ?>
                <dd><a href="<?php echo Yii::app()->getController()->createUrl("search/index",array('did'=>$value1['id'],'tcid'=>$trave_category))?>"><?php echo $value1['name'];?></a></dd>		   	   	   	   	    	
                <?php  	
                }
                ?>
          </dl>  		   	   	   	   	
        <?php } ?>

          </div>
        </div>