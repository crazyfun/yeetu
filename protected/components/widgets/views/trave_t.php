<?php if(!empty($datas)){ ?> 
 <div class="trave_threads">

        <h2 style="color:#ff6600;font-size:12px;">特别推荐</h2>
       	<ul>
       		<?php foreach($datas as $key => $value){
       		?>
                	<li class="trave_threads_li <?php if($key%2==0) echo "bgcolor_even";else echo "bgcolor"; ?>">

                		  <div class="bbs_thread_tcontent">
                		  	<div class="bbs_thread_img"><?php echo $value->get_show_threads_image(); ?></div>
                		  	<div class="bbs_thread_desc">
                		  		 <div class="bbs_thread_stitle"><a href="<?php echo $value->title_href;?>" target="_blank"><?php echo $value->title; ?></a></div>
                		  		 <div class="bbs_thread_sd"><?php echo $value->short_desc; ?></div>
                		  	</div>
                		  	
                		 </div> 
	  	                <div class="clearfix"></div>
                  </li>

          <?php
            }
          ?>
        </ul>
        
      </div>

<?php } ?>


<script language="javascript">
	
	  jQuery(".trave_threads_li").hover(
      function(){
      	jQuery(this).removeClass("bgcolor");
      	jQuery(this).addClass("bgcolor_hover");
      },
      function(){
      	jQuery(this).removeClass("bgcolor_hover");
      	jQuery(this).addClass("bgcolor");
      }
    );
</script>

