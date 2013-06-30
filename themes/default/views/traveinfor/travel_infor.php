<div class="wj_mainL"><!--内容左边部分-->
	<div class="travel_infor_list">
    <div class="tic_title"><?php echo $trave_infor_datas->information_title;?></div>
    <div class="tic_content"><?php echo $trave_infor_datas->information_content;?></div>
    <div class="tic_infor"><span class="tii_span">主题:<?php echo $trave_infor_datas->Infortheme->theme_name;?></span><span class="tii_span">查看次数:<?php echo $trave_infor_datas->view_numbs;?></span><span class="tii_span">发布人:<?php echo $trave_infor_datas->User->user_login;?></span><span class="tii_span">发布时间:<?php echo date('Y-m-d H:i:s',$trave_infor_datas->create_time);?></span></div>
  </div>
     <?php
      	if($this->beginCache("Traveinfo_recommend", array('duration'=>"1"))){
              $this->widget('Traveinfo_recommend', array(  
                          
              )); 
             $this->endCache(); 
        }     
       ?>

	   <?php
      	if($this->beginCache("Traveinfo_new", array('duration'=>"1"))){
              $this->widget('Traveinfo_new', array(  
      
              )); 
             $this->endCache(); 
        }     
       ?>  
</div>

     
     

   
   
   

