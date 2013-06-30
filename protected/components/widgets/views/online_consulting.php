 <div class="left_zx">
       	<h2><span class="left_tj_title">在线咨询</span> 
        </h2>
                <ul>
                	<?php foreach($consulting_datas as $key => $value){ ?>
                	  <li>
                    	  <div class="left_zx_w"><a href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value->trave_id,'con'=>true)); ?>"><?php echo Util::cs($value->consulting_content,20);?></a></div>
                        <div class="left_zx_d"><?php echo Util::cs($value->reply_content,18);?></div>
                    </li>
                  
                   <?php } ?>
                    
        </ul>
        </div><!--left_zx end-->