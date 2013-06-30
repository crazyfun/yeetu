 <div class="travel_infor"><div class="travel_infor_more"><a href="<?php echo Yii::app()->getController()->createUrl("traveinfor/index"); ?>">更多»</a></div>
        <h2><img src="/css/images/lvyouzixun.jpg"/></h2>
       	<ul>
       		<?php foreach($trave_info_datas as $key => $value){
       		?>
                	<li><span class="trave_info_title"><a title="<?php echo $value->information_title;?>" href="<?php echo Yii::app()->getController()->createUrl("traveinfor/details",array('id'=>$value->id)); ?>"><?php echo Util::cs($value->information_title,10); ?></span><span class="trave_info_time"><?php echo date('m-d',$value->create_time);?></span></a></li>

          <?php
            }
          ?>
        </ul>
        
      </div>