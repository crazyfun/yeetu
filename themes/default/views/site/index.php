<div class="content">
    <div class="main_con">
    	<div class="main_left">
    		<?php
      	if($this->beginCache("HTravelSearch", array('duration'=>"1"))){
                  $this->widget('HTravelSearch', array(             
              ));
             $this->endCache(); 
        }
       ?>
    		
        <?php
              $this->widget('HotList', array(  
              )); 
     
       ?> 	
       
       
      <?php
      	if($this->beginCache("HTravePeripheralRegion", array('duration'=>"1"))){
              $this->widget('HTraveRegion', array(  
               'trave_category'=>'2',
              ));
             $this->endCache();
        }
       ?>
       <?php
      	if($this->beginCache("HTraveDomesticRegion", array('duration'=>"1"))){
              $this->widget('HTraveRegion', array(  
               'trave_category'=>'3',
              ));
             $this->endCache();
        }
       ?>

       <?php
      	if($this->beginCache("HTraveNationRegion", array('duration'=>"1"))){
              $this->widget('HTraveRegion', array(  
               'trave_category'=>'1',
              )); 
             $this->endCache();
        }
       ?>     
        <?php
              $this->widget('UserOnlineSurvey', array(  
              )); 
      ?>       
        </div>

        <div class="main_right">
        	<div class="main_right_top">
        		
        		   <?php
      	       if($this->beginCache("FlashAdW", array('duration'=>"1"))){
                   $this->widget('FlashAdW', array(  
               
                  )); 
                $this->endCache(); 
              }     
           ?>
            </div><!--main_right_top end-->
            
            <?php
              $this->widget('LimitedSpecial', array(  
               
              )); 
 
            ?>

      <div class="advertise_img"><?php echo Util::get_ad('3');?></div>
      <?php
              $this->widget('TravelLatest', array(  
               'show_type'=>'1',
              )); 
       ?>
       <div class="advertise_img"><?php echo Util::get_ad('4');?></div>
        </div><!--main_right end-->
   		<div class="clear_float"></div>
    </div><!--main_con-->	
</div>



