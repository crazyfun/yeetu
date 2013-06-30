  <div class="traveinfor_main_left_sid_new">
  <div>
        <h2>最新资讯</h2>
        <ul>
          <?php foreach($traveinfo_new as $key => $value){ ?>
				   <li><a title="<?php echo $value->information_title;?>" href="<?php echo $this->controller->createUrl("traveinfor/details",array('id'=>$value->id,'n'=>$value->information_title)); ?>"><?php echo Util::cs($value->information_title,25);?></a></li>
				
			    <?php } ?>
        </ul>
      </div>
	  </div>