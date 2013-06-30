    
<ul class="wj_pl">
   <li>
       <div class="wjtourist">
           <?php if(!empty($data->create_id)){ ?>
           
           <div class="comment_user_img"><img src='<?php $user=new User();echo $user->get_user_head(50,50,$data->create_id); ?>'/><div class="cud_top"><?php  echo $data->User->user_login; ?></div></div>
           <div class="comment_user_desc">
           	  
          <?php }else{ ?>
          	<div class="comment_user_img"><img src='<?php $user=new User();echo $user->get_user_head(50,50,$data->create_id); ?>'/><div class="cud_top">游客</div></div>
          	
          	<div class="comment_user_desc">
          		  
          <?php } ?>
           
           
           
          <div class="clear_float"></div>
          <div class="cud_bottom">
            <div><span class="ci_titel">咨询内容:</span><span>(发表于</span><span><?php echo date("Y-m-d H:i:s",$data->create_time);?>)</span><span class="ci_content"><?php echo $data->consulting_content; ?></span></div>
            
            <?php if(!empty($data->reply_content)){?>
              <div><span class="ci_titel">客服回复:</span><span class="ci_content"><?php echo $data->reply_content; ?></span></div>
              <!-- <div class="cr_content"><span class="ci_titel">回复人:</span><?php echo $data->get_reply_name(); ?><span class="ci_titel">回复时间:</span><?php echo date('Y-m-d H:i:s',$data->reply_time);?></div> -->
           <?php }?>
          </div>
            	
            	</div>
            
        </div>

   </li>
</ul>
       
                 
