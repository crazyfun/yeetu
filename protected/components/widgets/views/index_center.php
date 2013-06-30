    <div class="main_m">
    	
      <div class="newest">
        <h2 class="newest_h2_title"><img height="32" width="90" src="/css/images/index_01.jpg"/></h2>
        <?php
              $this->widget('TravelLatest', array(  
               'show_type'=>'1',
              )); 
       ?>

      </div>
      	  
      <div class="newest">
        <h2 class="newest_h2_title"><img height="32" width="90" src="/css/images/index_02.jpg"/></h2>
        <?php
              $this->widget('TravelLatest', array(  
               'show_type'=>'2',
              )); 
       ?>

      </div>
      <div class="newest">
        <h2 class="newest_h2_title"><img height="32" width="90" src="/css/images/index_03.jpg"/></h2>
        <?php
              $this->widget('TravelLatest', array(  
               'show_type'=>'3',
              )); 
       ?>
      </div>
     <div class="Recommended">
<div class="travel_infor_more"><a href="<?php echo Yii::app()->getController()->createUrl("travel/peripheral"); ?>">更多»</a></div>
       	<h3 class="title"><?php echo Yii::app()->getController()->trave_sregion_name;?>出发周边旅游线路热门推荐</h3>
       	
       	<div class="Recommended_pic"><?php echo Util::get_ad('1') ;?></div>
       	<?php
              $this->widget('TravelHotRecommend', array(  
               'trave_category'=>'2',
              )); 
        ?> 
     </div>
     		
     		
    <div class="Recommended">
	<div class="travel_infor_more"><a href="<?php echo Yii::app()->getController()->createUrl("travel/domestic"); ?>">更多»</a></div>
       	<h3 class="title"><?php echo Yii::app()->getController()->trave_sregion_name;?>出发国内旅游线路热门推荐</h3>
       	<div class="Recommended_pic"><?php echo Util::get_ad('2') ;?></div>
       	<?php
              $this->widget('TravelHotRecommend', array(  
               'trave_category'=>'3',
              )); 
        ?> 
     </div>
     		
     		
     <div class="Recommended">
	 <div class="travel_infor_more"><a href="<?php echo Yii::app()->getController()->createUrl("travel/nation"); ?>">更多»</a></div>
       	<h3 class="title"><?php echo Yii::app()->getController()->trave_sregion_name;?>出发出境旅游线路热门推荐</h3>
       	<div class="Recommended_pic"><?php echo Util::get_ad('3') ;?></div>
       	<?php
              $this->widget('TravelHotRecommend', array(  
               'trave_category'=>'1',
              )); 
        ?> 
     </div>
     		
     <div class="Recommended">
	 <div class="travel_infor_more"><a href="<?php echo Yii::app()->getController()->createUrl("travel/free"); ?>">更多»</a></div>
       	<h3 class="title"><?php echo Yii::app()->getController()->trave_sregion_name;?>出发自助游线路热门推荐</h3>
       	<div class="Recommended_pic"><?php echo Util::get_ad('4') ;?></div>
       	<?php
              $this->widget('TravelHotRecommend', array(  
               'trave_category'=>'5',
              )); 
        ?> 
     </div>
     		
     		
      <div class="Recommended">
	  <div class="travel_infor_more"><a href="<?php echo Yii::app()->getController()->createUrl("travel/group"); ?>">更多»</a></div>
       	<h3 class="title"><?php echo Yii::app()->getController()->trave_sregion_name;?>出发公司旅游线路热门推荐</h3>
       	<div class="Recommended_pic"><?php echo Util::get_ad('5') ;?></div>
       	<?php
              $this->widget('TravelHotRecommend', array(  
               'trave_category'=>'4',
              )); 
        ?> 
     </div>
     
     
     

     <div class="Recommended">
       	<h3 class="title"><?php echo Yii::app()->getController()->trave_sregion_name;?>出发热门评论旅游线路</h3>
       	<div class="Recommended_pic"><?php echo Util::get_ad('7') ;?></div>
       	<?php
              $this->widget('CommentLatest', array(  
                  
              )); 
        ?> 
     </div>
 
 		

</div>