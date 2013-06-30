<div id="footer">
<!-- footlink -->
     <div class="footer_div">
	 <?php
		$Footlink=new Footlink();

		$footlink_data=$Footlink->get_footlink_content();

        foreach($footlink_data as $key => $value){
		  if($key!=0){
			  echo "|";
		  }
          echo "<a href='".Yii::app()->homeUrl."/statics/index?cid=".$value->id."' class='a_black12'>".$value->footlink_name."</a>";
		}

/*
		foreach($footlink_data as $key=>$value){
			$order[].=$value['footlink_order'];
			
		}
		$or=count($order); 
		$fdata=count($footlink_data);

		for($j=0;$j<=$key;$j++){
			for($i=0;$i<=$or;$i++){
				
				if($order[$j]==$i){
					echo "<a href='' class='a_black12'>".$footlink_data[$i]['footlink_name']."</a>";
					if($j!=$key){
						echo "|";
					}
				echo $order[$j];
				}
			}
		}
*/
	 ?>
	 </div>

<!-- end footlink -->
     <div class="footer_div">Copyright&copy; 2010-2019 GirlMen All Rights Reserved</div>
     <div class="footer_div">隐私保护
       <h1 class="foot_h1"><a href="" class="a_black12" target="_blank">易途网</a></h1>
       版权所有<a href="" class="a_black12" target="_blank">鄂ICP备10011451号</a>
     </div>
  </div>