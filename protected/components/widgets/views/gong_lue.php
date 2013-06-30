<?php if(!empty($gonglue_datas)){ ?> 
 <div class="left_tj">
        <h2><img src="/css/images/lvyougonglue.jpg"/></h2>
       	<ul>
       		<?php foreach($gonglue_datas as $key => $value){
       		?>
                	<li>
                		  <div class="bbs_thread_title" <?php if($key==0) echo " style='display:none;'";?>><a href="<?php echo $value->title_href;?>" target="_blank"><?php echo Util::cs($value->title,16); ?></a></div> 
                		  <div class="bbs_thread_content" <?php if($key==0) echo " style='display:block;'";?>>
                		  	
                		  	<div class="bbs_thread_img"><?php echo $value->get_show_threads_image(); ?></div>
                		  	<div class="bbs_thread_desc">
                		  		 <div class="bbs_thread_stitle"><a href="<?php echo $value->title_href;?>" target="_blank"><?php echo $value->title; ?></a></div>
                		  		 <div class="bbs_thread_auther">作者:<?php echo $value->auther; ?></div>
                		  	
                		  	</div>
                		  	<div class="clearfix"></div>
                		  	
                		  	
                		 </div> 
	  	
                  </li>

          <?php
            }
          ?>
        </ul>
        
      </div>
<?php } ?>