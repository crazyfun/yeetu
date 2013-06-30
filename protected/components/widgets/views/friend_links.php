
<div class="friend_links">
            
            <div class="friend_links_content"><span>友情链接:</span>
            	<?php if(!empty($links) && count($links) > 0){?>
            	    <?php foreach($links as $link){
													echo CHtml::link($link->name,$link->link,array('class'=>'flink','target'=>'_blank'));
												}
									?>

            	<?php } ?>
            </div>
</div>
