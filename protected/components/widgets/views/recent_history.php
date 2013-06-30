  
  
  
  <div class="help_main_left_sid">
        <h2>最近浏览的线路</h2>
        <ul>
          <?php foreach($trave_history as $key => $value){ ?>
				   <li><a title="<?php echo $value->Trave->trave_name;?>" href="<?php echo $this->controller->createUrl("travel/detail",array('id'=>$value->Trave->id,'n'=>$value->Trave->trave_title)); ?>"><?php echo Util::cs($value->Trave->trave_name,12);?></a></li>
				
			    <?php } ?>
			
        </ul>
      </div>
