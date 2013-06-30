    
<ul class="wj_pl">
   <li>
       <div class="wjtourist">
            <div class="comment_user_img"><img src='<?php $user=new User();echo $user->get_user_head(50,50,$data->create_id); ?>'/></div>
            <div class="comment_user_desc">
              <div class="cud_top"><table class="tc_top"><tbody><tr><td>发表于<?php echo date("Y-m-d H:i:s",$data->create_time);?></td><td><?php echo $data->get_rating();?></td><td><?php  echo $data->User->user_login; ?></td></tr></tbody></table>
              </div>
             
              <div class="clear_float"></div>
              <div class="cud_bottom">
                <?php echo $data->comment_content; ?>
              </div>
           </div> 
        </div>
   </li>
</ul>


                    
                 
