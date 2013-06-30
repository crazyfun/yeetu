    <div class="help_main_left_sid">
        <h2>热门线路</h2>
        <ul>
        	<?php 
          foreach($hot_datas as $key => $value){ 
		      ?>
				   <li><a title="<?php echo $value->trave_name;?>" href="<?php echo $this->controller->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title)); ?>"><?php echo Util::cs($value->trave_name,12);?></a></li>
			   <?php } ?>
        </ul>
      </div>
