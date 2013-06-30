    <div class="help_main_left_sid">
        <h2>推荐线路</h2>
        <ul>
        	
      <?php 
				
				foreach($recommend_datas as $key => $value){ 
		?>
				   <li><a title="<?php echo $value->trave_name;?>" href="<?php echo Yii::app()->getController()->createUrl("travel/detail",array('id'=>$value->id,'n'=>$value->trave_title))?>"><?php echo Util::cs($value->trave_name,12);?></a></li>
				
			<?php } ?>
			
        </ul>
     </div>
