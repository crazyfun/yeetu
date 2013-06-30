<div class="footer_div">
	<?php
		$Footlink=new Footlink();
		$footlink_data=$Footlink->get_footlink_content();
    foreach($footlink_data as $key => $value){
		  if($key!=0){
			  echo "|";
		  }
      echo "<a href='".Yii::app()->getController()->createUrl('statics/index',array('cid'=>$value->id))."' class='a_black12'>".$value->footlink_name."</a>";   
		}
  ?>
  </div>

